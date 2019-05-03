<?php
Wind::import('ADMIN:service.srv.helper.AdminMenuHelper');
/**
 * ��̨�˵�����
 *
 * @author Qiong Wu <papa0924@gmail.com> 2011-10-21
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: AdminMenuService.php 23734 2013-01-15 09:10:00Z jieyin $
 * @package admin
 * @subpackage service.srv
 */
class AdminMenuService {
	/**
	 * �˵��嵥
	 *
	 * @var array
	 */
	protected $menuTable = null;

	/**
	 * �����û�ID��ȡ�û�Ȩ�ޱ�
	 *
	 * ��̨�˵��洢��ʽ��Ϊ����:<code>
	 * 1. conf/mainmenu.php, ���Խ��˵�ֱ��д��mainmenu.php
	 * 2. ��չ�˵�,������չ�˵��ļ�Ϊ'menu1.php',�򽫸���չԴд��mainmenu.php �� '_extensions' �ֶ�.
	 * ��:
	 * '_extensions' => array('test1' => array('resource' =>
	 * 'ADMIN:conf.menu1.php')));
	 * ��չ�ⲿ�Ĳ˵�λ��û������,ֻҪ����չ�˵�·���������ռ�ķ�ʽ���뵽'resource'�¼���.
	 * 3. �����ݿ���չ.
	 * </code>
	 * 
	 * @example <code>
	 *          Array('admin' => Array(
	 *          'id' => admin,
	 *          'name' => admin,
	 *          'icon' => '',
	 *          'tip' => '',
	 *          'items' => Array('admin_install' => Array(...),'admin_auth' =>
	 *          Array(...)))
	 *          )
	 *          </code>
	 * @param int $uid        	
	 * @return array
	 */
	public function getMyMenus($dm) {
		/* @var $userService AdminUserService */
		$userService = Wekit::load('ADMIN:service.srv.AdminUserService');
		$myMenus = $userService->getAuths($dm);
		$menuTables = $this->getMenuTable();
		if ($myMenus !== '-1') {
			foreach ($menuTables as $key => $value)
				if (isset($value['url']) && !in_array($key, (array) $myMenus)) unset(
					$menuTables[$key]);
		}
		$menus = AdminMenuHelper::resolveMenuStruct($menuTables);
		foreach ($menus as $key => $value) {
			if (isset($value['items']) && empty($value['items'])) {
				unset($menus[$key]);
			}
		}
		return $menus;
	}

	/**
	 * ��ȡ�ҵĳ��ò˵�
	 *
	 * @param AdminUserBo $user
	 * @return array
	 */
	public function getCustomMenus(AdminUserBo $user) {
		$menuTables = $this->getMenuTable();
		/* @var $adminCustom AdminCustom */
		$adminCustom = Wekit::load('ADMIN:service.AdminCustom');
		$r = $adminCustom->findByUsername($user->username);
		$myMenus = $r ? explode(',', $r['custom']) : array();
		$return = array();
		foreach ($menuTables as $key => $value) {
			if (isset($value['url']) && in_array($key, $myMenus)) {
				$return[$key] = $value;
			}
		}
		return $return;
	}

	/**
	 * ��ò˵�����table,�ò˵��ڵ�table����չʾ�ڵ��Ĳ㼶��ϵ.
	 *
	 * @return multitype:
	 */
	public function getMenuTable() {
		if (!$menuTables = $this->_getMenuTable()) return array();
		unset($menuTables['__auths']);
		return $menuTables;
	}

	/**
	 * ��õ�ǰ�Ĳ˵�Ȩ�޽ṹ��Ϣ��
	 *
	 * @example <code>
	 *          //'default' ��Ȩ�޵�m����Ϊ��ʱ��Ϊ'default'.
	 *          'default' => Array(
	 *          'install' => Array('run' => admin_install),
	 *          'auth' => Array('_all' => admin_auth))
	 *          </code>
	 * @return array
	 */
	public function getMenuAuthStruts() {
		if (!$menusInfo = $this->_getMenuTable()) return array();
		return isset($menusInfo['__auths']) ? $menusInfo['__auths'] : array();
	}

	/**
	 * ��ò˵�����table,�ò˵��ڵ�table����չʾ�ڵ��Ĳ㼶��ϵ.
	 *
	 * �÷�������������չ�˵��������չ�˵������ļ�,�����˵��ϲ�Ϊһ�������Ĳ˵�table������.
	 * 
	 * @example <code> �ڵ��б�'admin' => array('admin', array()),
	 *          'admin_install' => array('Ӧ�ò˵���װ', 'install/run', '', '',
	 *          'admin'),
	 *          'admin_auth' => array('�˵�Ȩ��', 'auth/*', '', '', 'admin'),</code>
	 * @return array
	 */
	private function _getMenuTable() {
		if ($this->menuTable === null) {
			
			/* @var $_configParser WindConfigParser */
			$_configParser = Wind::getComponent('configParser');
			// 'ADMIN:conf.mainmenu.php'
			$mainMenuConfFile = Wind::getRealPath(Wekit::app()->menuPath, true);
			$menus = $_configParser->parse($mainMenuConfFile);
			
			/* extend menus by file */
			if (isset($menus['_extensions'])) {
				$_extensions = $menus['_extensions'];
				foreach ($_extensions as $_extName => $_ext) {
					if (!isset($_ext['resource'])) continue;
					$_tmp = Wind::getRealPath($_ext['resource'], true);
					$cacheKey .= filemtime($_tmp);
					$_extensions[$_extName]['resource'] = $_tmp;
				}
				unset($menus['_extensions']);
			} else
				$_extensions = array();
			
			$menus = PwSimpleHook::getInstance('admin_menu')->runWithFilters($menus);
			
			foreach ($_extensions as $key => $value) {
				if (!isset($value['resource'])) continue;
				$_tmp = $_configParser->parse($value['resource']);
				$menus = WindUtility::mergeArray($menus, $_tmp);
			}
			AdminMenuHelper::verifyMenuConfig($menus, $menus, $this->menuTable);
		}
		return $this->menuTable;
	}
}

?>