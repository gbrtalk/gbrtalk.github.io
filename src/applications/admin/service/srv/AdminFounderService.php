<?php
/**
 * ��̨��ʼ�˷�����
 *
 * @author Qiong Wu <papa0924@gmail.com>
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: codetemplates(windframework_docs_zend_8.0).xml 2781 2011-09-22 03:59:17Z yishuo $
 * @package wind
 */
class AdminFounderService {

	private $_founder = null;
	
	public function login($username, $password) {
		$founder = $this->getFounders();
		if (!$result = $this->checkPwd($founder[$username], $password)) {
			return new PwError('ADMIN:login.fail.user.illegal');
		}
		return array(AdminUserService::FOUNDER, $username, Pw::getPwdCode($result));
	}

	public function isLogin($username, $password) {
		if (!$this->isFounder($username)) {
			return array();
		}
		$founder = $this->getFounders();
		list($md5pwd) = explode('|', $founder[$username], 2);
		if (Pw::getPwdCode($md5pwd) != $password) {
			return array();
		}
		if (!$user = $this->loadUserService()->getUserByName($username)) {
			$user = array(
				'uid' => 0,
				'username' => $username, 
				'groupid' => 3
			);
		}
		return $user;
	}

	/**
	 * ��Ӵ�ʼ�� 
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 */
	public function add($username, $password, $email) {
		if (!$this->isWriteable()) return new PwError('ADMIN:founder.file.write.fail');
		$this->getFounders();
		if (isset($this->_founder[$username])) return new PwError(
			'ADMIN:founder.add.fail.username.duplicate');
		
		$user = $this->loadUserService()->getUserByName($username);
		if (!$password && !isset($user['password'])) return new PwError(
			'ADMIN:founder.add.fail.password.empty');
		$password || $password = $user['password'];
		
		$uid = isset($user['uid']) ? $user['uid'] : 0;
		$r = $this->loadUserService()->setUser($username, $password, $email, '3', $uid);
		if ($r instanceof PwError) return $r;
		
		$this->_founder[$username] = $this->encryptPwd($password);
		$r = $this->updateFounder();
		if ($r instanceof PwError) return $r;
		
		return true;
	}

	/**
	 * �༭��ʼ��
	 *
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @return boolean PwError
	 */
	public function edit($username, $password, $email) {
		if (!$this->isWriteable()) return new PwError('ADMIN:founder.file.write.fail');
		$this->getFounders();
		if (!isset($this->_founder[$username])) return new PwError('ADMIN:founder.edit.fail');
		
		$user = $this->loadUserService()->getUserByName($username);
		$uid = isset($user['uid']) ? $user['uid'] : 0;
		$r = $this->loadUserService()->setUser($username, $password, $email, '3', $uid);
		if ($r instanceof PwError) return $r;
		
		if ($password) {
			$this->_founder[$username] = $this->encryptPwd($password);
			$r = $this->updateFounder();
			if ($r instanceof PwError) return $r;
		}
		
		return true;
	}

	/**
	 * У������
	 *
	 * @param string $pwd1 ���ܺ�
	 * @param string $pwd2 ����ǰ
	 * @return false|pwd ����ȷ���false����ͬ�򷵻�md5pwd
	 */
	public function checkPwd($pwd1, $pwd2) {
		list($md5pwd, $salt) = explode('|', $pwd1, 2);
		if (md5($pwd2 . $salt) != $md5pwd) return false;
		return $md5pwd;
	}

	/**
	 * ��ʼ�����˼���
	 *
	 * @param string $password
	 * @return string
	 */
	public function encryptPwd($password) {
		$salt = WindUtility::generateRandStr(6);
		return md5($password . $salt) . '|' . $salt;
	}

	/**
	 * �����û���ɾ����ʼ��
	 *
	 * @param string $username
	 * @return boolean PwError
	 */
	public function del($username) {
		if (!$this->isWriteable()) return new PwError('ADMIN:founder.file.write.fail');
		$this->getFounders();
		if (!isset($this->_founder[$username])) return new PwError('ADMIN:founder.del.fail');
		unset($this->_founder[$username]);
		if (empty($this->_founder)) return new PwError('ADMIN:founder.del.fail.all');
		return $this->updateFounder();
	}

	/**
	 * �����û����鿴�Ƿ�ʼ��
	 *
	 * @param string $username
	 * @return boolean
	 */
	public function isFounder($username) {
		$founders = $this->getFounders();
		return isset($founders[$username]);
	}

	/**
	 * ��ȡ��ʼ�������ļ�
	 *
	 * @return array
	 */
	public function getFounders() {
		if ($this->_founder === null) {
			$this->_founder = include($this->getFounderFilePath());
			is_array($this->_founder) || $this->_founder = array();
		}
		return $this->_founder;
	}

	/**
	 * �жϴ�ʼ�������ļ��Ƿ��д
	 */
	public function isWriteable() {
		return is_writeable($this->getFounderFilePath());
	}

	/**
	 * ���´�ʼ����Ϣ
	 * 
	 * @return boolean PwError
	 */
	private function updateFounder() {
		$r = WindFile::savePhpData($this->getFounderFilePath(), $this->_founder);
		return $r ? $r : new PwError('ADMIN:founder.file.write.fail');
	}

	/**
	 * ��ȡ��ʼ�������ļ�
	 *
	 * @return string
	 */
	private function getFounderFilePath() {
		return Wind::getRealPath(Wekit::app()->founderPath, true);
	}

	/**
	 * @return IAdminUserDependenceService
	 */
	private function loadUserService() {
		$userService = Wind::getComponent('adminUserService');
		if ($userService instanceof IAdminUserDependenceService) return $userService;
		throw new PwDependanceException('admin.userservice', 
			array('{service}' => __CLASS__, '{userservice}' => 'IAdminUserDependenceService'));
	}
}

?>