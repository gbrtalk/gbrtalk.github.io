<?php
/**
 * ��̨�û�������
 *
 * ��̨�û�������,ְ��:<ol>
 * <li>login,�û���¼</li>
 * <li>logout,�û��˳�</li>
 * <li>isLogin,�û��Ƿ��ѵ�¼</li>
 * </ol>
 *
 * @author Qiong Wu <papa0924@gmail.com> 2011-10-17
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: AdminUserService.php 24131 2013-01-22 05:55:40Z yishuo $
 * @package admin
 * @subpackage library.service
 */
class AdminUserService {
	const FOUNDER = 'founder';
	const USER = 'user';
	protected $cookieName = 'AdminUser';
	private $_founder = null;

	/**
	 * �����û�ID��ȡ�û��б�,֧���������int
	 *
	 * @param array|int $uids
	 * @return array|PwError
	 */
	public function getUserByUids($uids) {
		if (is_array($uids))
			return $this->loadUserService()->getUserByUids($uids);
		else
			return $this->loadUserService()->getUserByUid($uids);
	}

	/**
	 * �����û������ж��û��ĺϷ���
	 *
	 * �Ϸ��û�����true���Ƿ��û�����false
	 *
	 * @param string $username        	
	 * @return array
	 */
	public function verifyUserByUsername($username) {
		if (empty($username)) return array();
		return $this->loadUserService()->getUserByName($username);
	}

	/**
	 * ��֤�û��Ƿ��з��ʲ˵���Ȩ��
	 *
	 * @param AdminUserBo $user �û�ID
	 * @param string $m ·����ϢModule
	 * @param string $c ·����ϢController
	 * @param string $a ·����ϢAction
	 * @return true Error
	 */
	public function verifyUserMenuAuth($user, $m, $c, $a) {
		$_menus = $this->getAuths($user);
		if ($_menus === '-1') return true;
		if (empty($_menus) || !is_array($_menus)) return new PwError('ADMIN:menu.fail.allow');
		/* @var $menuService AdminMenuService */
		$menuService = Wekit::load('ADMIN:service.srv.AdminMenuService');
		$authStruts = $menuService->getMenuAuthStruts();
		$authKeys = array();
		if (isset($authStruts[$m][$c]['_all'])) $authKeys += $authStruts[$m][$c]['_all'];
		if (isset($authStruts[$m][$c][$a])) $authKeys += $authStruts[$m][$c][$a];
		foreach ($authKeys as $_key)
			if (in_array($_key, $_menus)) return true;
		return new PwError('ADMIN:menu.fail.allow');
	}

	/**
	 * �����û�ID,��ȡ����û���ȫ����̨Ȩ�޲˵�.
	 *
	 * ����ֵ����:<pre>
	 * 1. -1 ����Ȩ��
	 * 2. array()		û���κ�Ȩ��
	 * 3. array('home') ֻ��home�˵�Ȩ��
	 * </pre>
	 *
	 * @param AdminUserBo $user        	
	 * @return array PwError -1
	 */
	public function getAuths($user) {
		list($uid, $username) = array($user->uid, $user->username);
		if ($this->loadFounderService()->isFounder($username)) return '-1';
		
		/* @var $authDS AdminAuth */
		$authService = Wekit::load('ADMIN:service.AdminAuth');
		$userAuths = $authService->findByUid($uid);
		if (empty($userAuths['roles'])) return array();
		
		$roles = explode(',', $userAuths['roles']);
		/* @var $roleService AdminRole */
		$roleService = Wekit::load('ADMIN:service.AdminRole');
		$roles = $roleService->findRolesByNames($roles);
		if ($roles instanceof PwError) return new PwError('ADMIN:fail');
		
		$_tmp = '';
		foreach ($roles as $role) {
			$_tmp .= $role['auths'] . ',';
		}
		return empty($_tmp) ? array() : explode(',', trim($_tmp, ','));
	}

	/**
	 * ��̨�û���¼����
	 *
	 * ��̨�û���¼����,�������û�����.������Ϣ:<code>
	 * $loginInfo: AdminUser
	 * </code>
	 *
	 * @param string $username �û���
	 * @param string $password ����
	 * @return boolean
	 */
	public function login($username, $password) {
		$srv = $this->loadFounderService();
		if (!$srv->isFounder($username)) {
			$srv = $this->loadManagerService();
		}
		if (($result = $srv->login($username, $password)) instanceof PwError) {
			return $result;
		}
		Pw::setCookie($this->cookieName, Pw::encrypt(implode("\t", $result)), 1800);
		return true;
	}

	public function isLogin() {
		if (!($userCookie = Pw::getCookie('AdminUser'))) {
			return array();
		}
		list($type, $uid, $password) = explode("\t", Pw::decrypt($userCookie));
		if ($type == AdminUserService::FOUNDER) {
			$srv = $this->loadFounderService();
		} else {
			$srv = $this->loadManagerService();
		}
		Pw::setCookie('AdminUser', $userCookie, 1800);
		return $srv->isLogin($uid, $password);
	}

	/**
	 * ��̨�û��˳�����
	 *
	 * @return boolean
	 */
	public function logout() {
		return Pw::setCookie($this->cookieName, '', -1);
	}

	/**
	 * @return IAdminUserDependenceService
	 */
	public function loadUserService() {
		$userService = Wind::getComponent('adminUserService');
		if ($userService instanceof IAdminUserDependenceService) return $userService;
		throw new PwDependanceException('admin.userservice', 
			array('{service}' => __CLASS__, '{userservice}' => 'IAdminUserDependenceService'));
	}

	/**
	 * @return AdminFounderService
	 */
	private function loadFounderService() {
		return Wekit::load('ADMIN:service.srv.AdminFounderService');
	}

	private function loadManagerService() {
		return Wekit::load('ADMIN:service.srv.AdminManagerService');
	}
}
?>