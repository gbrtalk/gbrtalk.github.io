<?php
defined('WEKIT_VERSION') || exit('Forbidden');
Wind::import('ADMIN:library.AdminBaseDao');
/**
 * ��̨���ù���
 *
 * @author Qiong Wu <papa0924@gmail.com>
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id$
 * @package wind
 */
class AdminConfigDao extends AdminBaseDao {
	protected $_table = 'admin_config';
	
	/**
	 * ���ݿռ����ֻ�ø�������Ϣ
	 *
	 * @param stirng $namespace �ռ�����
	 * @return array
	 */
	public function getConfigs($namespace) {
		$sql = $this->_bindTable('SELECT * FROM %s WHERE namespace=?');
		$smt = $this->getConnection()->createStatement($sql);
		return $smt->queryAll(array($namespace), 'name');
	}
	
	/**
	 * ���ݿռ����ֻ�ø�������Ϣ
	 *
	 * @param array $namespace �ռ���������
	 * @return array
	 */
	public function fetchConfigs($namespace) {
		$sql = $this->_bindSql('SELECT * FROM %s WHERE namespace IN %s', $this->getTable(), $this->sqlImplode($namespace));
		$rst = $this->getConnection()->query($sql);
		return $rst->fetchAll();
	}
	
	/**
	 * ��ȡĳ������
	 *
	 * @param string $namespace
	 * @param string $name
	 * @return array
	 */
	public function getConfigByName($namespace, $name) {
		$sql = $this->_bindTable('SELECT * FROM %s WHERE namespace=? AND name=?');
		$smt = $this->getConnection()->createStatement($sql);
		return $smt->getOne(array($namespace, $name));
	}
	
	/**
	 * ��������������
	 *
	 * @param array $data �����õ�������
	 * @return boolean
	 */
	public function storeConfigs($data) {
		foreach ($data as $value) {
			$this->storeConfig($value['namespace'], $value['name'], $value['value']);
		}
		return true;
	}
	
	/**
	 * �洢������
	 *
	 * @param string $namespace �����������ռ�
	 * @param string $name ��������
	 * @param mixed $value �������ֵ
	 * @param string $descrip ����������
	 * @return boolean
	 */
	public function storeConfig($namespace, $name, $value, $descrip = null) {
		$array = array();
		list($array['vtype'], $array['value']) = $this->_toString($value);
		isset($descrip) && $array['description'] = $descrip;
		if ($this->getConfigByName($namespace, $name)) {
			$sql = $this->_bindSql('UPDATE %s SET %s WHERE namespace=? AND name=?', $this->getTable(), $this->sqlSingle($array));
			$smt = $this->getConnection()->createStatement($sql);
			$result = $smt->update(array($namespace, $name));
		} else {
			$array['name'] = $name;
			$array['namespace'] = $namespace;
			$sql = $this->_bindSql('INSERT INTO %s SET %s', $this->getTable(), $this->sqlSingle($array));
			$result = $this->getConnection()->execute($sql);
		}
		return $result;
	}
	
	/**
	 * ɾ��������
	 *
	 * @param string $namespace �����������ռ�
	 * @return boolean
	 */
	public function deleteConfig($namespace) {
		$sql = $this->_bindTable('DELETE FROM %s WHERE namespace=?');
		$smt = $this->getConnection()->createStatement($sql);
		$result = $smt->update(array($namespace));
		return $result;
	}
	
	/**
	 * ɾ��������
	 *
	 * @param string $namespace �����������ռ�
	 * @param string $name ����������
	 * @return boolean
	 */
	public function deleteConfigByName($namespace, $name) {
		$sql = $this->_bindTable('DELETE FROM %s WHERE namespace=? AND name=?');
		$smt = $this->getConnection()->createStatement($sql);
		$result = $smt->update(array($namespace, $name));
		return $result;
	}
	
	/**
	 * ������ת��Ϊ�ַ���
	 *
	 * @param mixed $value �����������
	 * @return array ���ش��������ݣ���һ����������ݵ����ͣ��ڶ�����������ݴ��������ݴ�
	 */
	private function _toString($value) {
		$vtype = 'string';
		if (is_array($value)) {
			$value = serialize($value);
			$vtype = 'array';
		} elseif (is_object($value)) {
			$value = serialize($value);
			$vtype = 'object';
		}
		return array($vtype, $value);
	}
	
	
	
}
?>