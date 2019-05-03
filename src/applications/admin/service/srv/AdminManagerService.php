<?php
/**
 * ��̨������
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
 * @version $Id: AdminManagerService.php 23734 2013-01-15 09:10:00Z jieyin $
 * @package admin
 * @subpackage library.service
 */
class AdminManagerService {

	public function login($username, $password) {
		if (!$this->loadSafeService()->ipLegal(Wind::getComponent('request')->getClientIp())) {
			return new PwError('ADMIN:login.fail.ip');
		}
		$user = $this->loadUserService()->verifyUser($username, $password);
		if ($user instanceof PwError) {
			return new PwError('ADMIN:login.fail.user.illegal');
		}

		/* @var $auth AdminAuth */
		$auth = Wekit::load('ADMIN:service.AdminAuth');
		if (!$auth->findByUid($user['uid'])) {
			return new PwError('ADMIN:login.fail.allow');
		}
		$u = $this->loadUserService()->getUserByUid($user['uid']);
		return array(AdminUserService::USER, $user['uid'], Pw::getPwdCode($u['password']));
	}

	public function isLogin($uid, $password) {
		$user = $this->loadUserService()->getUserByUid($uid);
		if (!$user) {
			return array();
		}
		if (Pw::getPwdCode($user['password']) != $password) {
			return array();
		}
		$auth = Wekit::load('ADMIN:service.AdminAuth');
		if (!$auth->findByUid($user['uid'])) {
			return array();
		}
		return $user;
	}

	/**
	 * @return AdminSafeService
	 */
	private function loadSafeService() {
		return Wekit::load('ADMIN:service.srv.AdminSafeService');
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
}
?>