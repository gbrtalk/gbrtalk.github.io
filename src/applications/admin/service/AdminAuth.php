<?php
/**
 * @author Qiong Wu <papa0924@gmail.com> 2011-11-12
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: AdminAuth.php 24131 2013-01-22 05:55:40Z yishuo $
 * @package admin
 * @subpackage service
 */
class AdminAuth {

	/**
	 * �����û������Һ�̨�û�
	 *
	 * @param string $username
	 * @return array
	 */
	public function findByUsername($username) {
		return $this->getAdminAuthDao()->findByUsername($username);
	}

	/**
	 * �����û�ID�����û��Ƿ��Ǻ�̨�û�
	 *
	 * @param int $uid
	 * @return array
	 */
	public function findByUid($uid) {
		return $this->getAdminAuthDao()->findByUid($uid);
	}

	/**
	 * ����ID���Һ�̨�û�
	 *
	 * @param int $id
	 * @return array
	 */
	public function findById($id) {
		return $this->getAdminAuthDao()->findById($id);
	}

	/**
	 * ��ҳ���Һ�̨�û�
	 *
	 * @param int $page ��ǰҳ
	 * @param int $perPgae ÿҳ��ʾ����
	 * @return array
	 */
	public function findByPage($page, $perPgae = 10) {
		$count = $this->getAdminAuthDao()->count();
		if (!$count) return array(0, array());
		$page = (int) $page;
		$countPage = ceil($count / $perPgae);
		$page = $page < 1 ? 1 : ($page > $countPage ? $countPage : $page);
		$list = $this->getAdminAuthDao()->find(($page - 1) * $perPgae, $perPgae);
		return array($count, $list, $page);
	}

	/**
	 * ɾ����̨�û�
	 *
	 * @param id $id
	 * @return PwError|boolean
	 */
	public function del($id) {
		if (!$id) return new PwError('ADMIN:auth.del.fail');
		return $this->getAdminAuthDao()->del($id);
	}

	/**
	 * �༭��̨�û�����
	 *
	 * @param int $id
	 * @param array $roles
	 * @return array
	 */
	public function edit($id, $username, $roles) {
		if (!$id) return new PwError('ADMIN:auth.edit.fail.id.illegal');
		if (!$roles) return new PwError('ADMIN:auth.add.fail.role.empty');
		$fields['username'] = $username;
		$fields['roles'] = implode(',', (array) $roles);
		$fields['modified_time'] = time();
		$this->getAdminAuthDao()->updateById($id, $fields);
		return $fields;
	}

	/**
	 * ����û���ɫ����
	 *
	 * @param string $username
	 * @param array $roles
	 * @return array|PwError
	 */
	public function add($username, $uid, $roles) {
		if (empty($username)) return new PwError('ADMIN:auth.add.fail');
		if (empty($uid)) return new PwError('ADMIN:auth.add.fail');
		if (empty($roles)) return new PwError('ADMIN:auth.add.fail.role.empty');
		if ($this->getAdminAuthDao()->findByUsername($username)) {
			return new PwError('ADMIN:auth.add.fail.username.duplicate');
		}
		$fields['uid'] = $uid;
		$fields['username'] = $username;
		$fields['roles'] = implode(',', (array) $roles);
		$fields['created_time'] = time();
		$fields['modified_time'] = time();
		$this->getAdminAuthDao()->add($fields);
		return $fields;
	}

	/**
	 * @return AdminAuthDao
	 */
	private function getAdminAuthDao() {
		return Wekit::loadDao('ADMIN:service.dao.AdminAuthDao');
	}
}

?>