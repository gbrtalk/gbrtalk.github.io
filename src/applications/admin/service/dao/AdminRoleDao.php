<?php
Wind::import('ADMIN:library.AdminBaseDao');
/**
 * �û��ļ�����
 *
 * @author Qiong Wu <papa0924@gmail.com> 2011-11-12
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: AdminRoleDao.php 21801 2012-12-13 09:31:09Z yishuo $
 * @package admin
 * @subpackage service.dao
 */
class AdminRoleDao extends PwBaseDao {
	protected $_table = 'admin_role';
	protected $_dataStruct = array('id', 'name', 'auths', 'created_time', 'modified_time');

	/**
	 * ��Ӻ�̨��ɫ
	 *
	 * @param array $fields
	 * @return boolean|number
	 */
	public function add($fields) {
		if (!$fields = $this->_filterStruct($fields)) return false;
		$sql = $this->_bindTable('INSERT INTO %s SET ') . $this->sqlSingle($fields);
		return $this->getConnection()->execute($sql);
	}

	/**
	 * ɾ����̨��ɫ����
	 *
	 * @param int $id
	 * @return boolean
	 */
	public function del($id) {
		if (!$id) return false;
		$sql = $this->_bindTable('DELETE FROM %s WHERE id=?');
		$this->getConnection()->createStatement($sql)->execute(array($id));
		return true;
	}

	/**
	 * ���½�ɫ����
	 *
	 * @param array $fields
	 * @return boolean
	 */
	public function updateById($id, $fields) {
		if (!$fields = $this->_filterStruct($fields)) return false;
		$sql = $this->_bindTable('UPDATE %s SET ') . $this->sqlSingle($fields) . ' WHERE id=?';
		$this->getConnection()->createStatement($sql)->update(array($id));
		return true;
	}

	/**
	 * ��ҳ�����û���ɫ,�����ؽ���б�
	 *
	 * @param int $start
	 * @param int $count
	 * @return array
	 */
	public function find($start, $count) {
		$sql = $this->_bindTable('SELECT * FROM %s ') . $this->sqlLimit($start, $count);
		return $this->getConnection()->query($sql)->fetchAll();
	}

	/**
	 * ��������name��������
	 *
	 * @param array $names
	 * @return array
	 */
	public function findByNames($names) {
		if (!$names) return false;
		$sql = $this->_bindTable('SELECT * FROM %s WHERE name IN ') . $this->sqlImplode($names);
		return $this->getConnection()->createStatement($sql)->queryAll();
	}

	/**
	 * ���ݽ�ɫ���Ʋ���һ������
	 *
	 * @param string $name
	 * @return array
	 */
	public function findByName($name) {
		if (!$name) return false;
		$sql = $this->_bindTable('SELECT * FROM %s WHERE name=?');
		return $this->getConnection()->createStatement($sql)->getOne(array($name));
	}

	/**
	 * ��������ID��������
	 *
	 * @param array $ids
	 * @return array
	 */
	public function findByIds($ids) {
		if (!$ids) return false;
		$sql = $this->_bindTable('SELECT * FROM %s WHERE id IN ') . $this->sqlImplode($ids);
		return $this->getConnection()->createStatement($sql)->queryAll();
	}

	/**
	 * ��������ID����һ������
	 *
	 * @param int $id
	 * @return array
	 */
	public function findById($id) {
		if (!$id) return false;
		$sql = $this->_bindTable('SELECT * FROM %s WHERE id=?');
		return $this->getConnection()->createStatement($sql)->getOne(array($id));
	}
}

?>