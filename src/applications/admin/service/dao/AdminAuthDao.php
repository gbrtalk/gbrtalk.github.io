<?php
Wind::import('ADMIN:library.AdminBaseDao');
/**
 * �û�Ȩ�޽�ɫ��
 *
 * @author Qiong Wu <papa0924@gmail.com> 2011-11-12
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: AdminAuthDao.php 21801 2012-12-13 09:31:09Z yishuo $
 * @package admin
 * @subpackage service.dao
 */
class AdminAuthDao extends AdminBaseDao {
	protected $_table = 'admin_auth';
	protected $_dataStruct = array(
		'id', 
		'uid', 
		'username', 
		'roles', 
		'created_time', 
		'modified_time');

	/**
	 * ����û�Ȩ��
	 * 
	 * @param array $fields
	 * @return boolean
	 */
	public function add($fields) {
		if (!$fields = $this->_filterStruct($fields)) return false;
		$sql = $this->_bindTable('INSERT INTO %s SET ') . $this->sqlSingle($fields);
		return $this->getConnection()->execute($sql);
	}

	/**
	 * �����û�Ȩ������
	 * 
	 * @param int $id ������ID
	 * @param array $auths �û�ӵ�е�Ȩ��
	 * @return boolean
	 */
	public function updateById($id, $fields) {
		if (!$fields = $this->_filterStruct($fields)) return false;
		$sql = $this->_bindTable('UPDATE %s SET ') . $this->sqlSingle($fields) . ' WHERE id=?';
		$this->getConnection()->createStatement($sql)->update(array($id));
		return true;
	}

	/**
	 * ɾ���û�Ȩ������
	 * 
	 * @param int $id
	 * @return boolean
	 */
	public function del($id) {
		$sql = $this->_bindTable('DELETE FROM %s WHERE id=?');
		$this->getConnection()->createStatement($sql)->update(array($id));
		return true;
	}

	/**
	 * ����ID���Һ�̨�û�
	 *
	 * @param int $id
	 * @return array
	 */
	public function findById($id) {
		$sql = $this->_bindTable('SELECT * FROM %s WHERE id=?');
		return $this->getConnection()->createStatement($sql)->getOne(array($id));
	}

	/**
	 * �����û�ID�����û���̨��ɫ����
	 *
	 * @param int $uid
	 * @return array
	 */
	public function findByUid($uid) {
		$sql = $this->_bindTable('SELECT * FROM %s WHERE uid=?');
		return $this->getConnection()->createStatement($sql)->getOne(array($uid));
	}

	/**
	 * �����û��������û�Ȩ��������Ϣ
	 *
	 * @param string $username �û���
	 * @return array
	 */
	public function findByUsername($username) {
		$sql = $this->_bindTable('SELECT * FROM %s WHERE username=?');
		return $this->getConnection()->createStatement($sql)->getOne(array($username));
	}

	/**
	 * ��ȡ�ܵ�����
	 * 
	 * @return number
	 */
	public function count() {
		$sql = $this->_bindTable('SELECT COUNT(*) FROM %s');
		return $this->getConnection()->createStatement($sql)->getValue();
	}

	/**
	 * ��ҳ��ȡ�û�Ȩ�����б�
	 * 
	 * @param int $start
	 * @param int $count
	 * @return array
	 */
	public function find($start, $count) {
		$sql = $this->_bindTable('SELECT * FROM %s ') . $this->sqlLimit($count, $start);
		return $this->getConnection()->query($sql)->fetchAll();
	}
}

?>