<?php
/**
 * @author Qiong Wu <papa0924@gmail.com>
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id$
 * @package wind
 */
class AdminConfig {

	/**
	 * ���ݿռ����ֻ�ø�������Ϣ
	 *
	 * @param stirng $namespace �ռ�����
	 * @return array
	 */
	public function getConfig($namespace) {
		if (!$namespace) return array();
		return $this->_getDao()->getConfigs($namespace);
	}

	/**
	 * ���ݿռ����ֻ�ø�������Ϣ
	 *
	 * @param array $namespace �ռ�����
	 * @return array
	 */
	public function fetchConfig($namespace) {
		if (!$namespace || !is_array($namespace)) return array();
		return $this->_getDao()->fetchConfigs($namespace);
	}

	/**
	 * ��ȡĳ������
	 *
	 * @param string $namespace
	 * @param string $name
	 * @return array
	 */
	public function getConfigByName($namespace, $name) {
		if (!$namespace || !$name) return array();
		return $this->_getDao()->getConfigByName($namespace, $name);
	}

	/**
	 * ��������ģ����������Ϣ
	 *
	 * @param string $namespace ģ��ռ�
	 * @return array
	 */
	public function getValues($namespace) {
		$config = $this->_getDao()->getConfigs($namespace);
		$clear = array();
		foreach ($config as $key => $item) {
			$clear[$key] = $item['vtype'] != 'string' ? unserialize($item['value']) : $item['value'];
		}
		return $clear;
	}

	/**
	 * ��������������Ϣ
	 *
	 * @param string $namespace ģ������
	 * @param array $array ������Ϣ���� array('name' => array('value' => '', 'descrip' => '')
	 * @return boolean
	 */
	public function setConfigs($namespace, $array) {
		if (empty($namespace) || empty($array) || !is_array($array)) return false;
		foreach ($array as $key => $item) {
			$this->setConfig($namespace, $key, $item['value'], $item['descrip']);
		}
		return true;
	}

	/**
	 * ����������Ϣ
	 *
	 * @param string $namespace ����ģ��
	 * @param string $name �����������
	 * @param string $value �������ֵ
	 * @param string $decrip �����������
	 * @return boolean
	 */
	public function setConfig($namespace, $name, $value, $decrip = null) {
		if (!$namespace || !$name) return false;
		return $this->_getDao()->storeConfig($namespace, $name, $value, $decrip);
	}

	/**
	 * ɾ��������
	 *
	 * @param string $namespace �����������ռ�
	 * @return boolean
	 */
	public function deleteConfig($namespace) {
		if (!$namespace) return false;
		return $this->_getDao()->deleteConfig($namespace);
	}

	/**
	 * ɾ��������
	 *
	 * @param string $namespace �����������ռ�
	 * @param string $name ����������
	 * @return boolean
	 */
	public function deleteConfigByName($namespace, $name) {
		if (!$namespace || !$name) return false;
		return $this->_getDao()->deleteConfigByName($namespace, $name);
	}

	/**
	 * ���dao����
	 *
	 * @return PwConfigDao
	 */
	private function _getDao() {
		return Wekit::loadDao('ADMIN:service.dao.AdminConfigDao');
	}
}

?>