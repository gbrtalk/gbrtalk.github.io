<?php
/**
 * ��̨ip��ȫ����
 *
 * @author Qiong Wu <papa0924@gmail.com>
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id$
 * @package wind
 */
class AdminSafeService {

	/**
	 * ��������Ip
	 * 
	 * @return boolean PwError
	 */
	public function setAllowIps($ips) {
		$ips = str_replace(array("\r\n", "\r", "\n", ";"), ",", $ips);
		$ips = trim($ips, ' ,');
		$result = $this->_loadAdminConfig()->setConfig('admin', 'ip.allow', $ips);
		if (!$result) return new PwError('ADMIN:safe.set.fail');
		return true;
	}

	/**
	 * ��ȡ����IP
	 * 
	 * @return array
	 */
	public function getAllowIps() {
		$ips = $this->_loadAdminConfig()->getConfigByName('admin', 'ip.allow');
		$ips = isset($ips['value']) ? $ips['value'] : '';
		return empty($ips) ? array() : explode(',', $ips);
	}

	/**
	 * ��֤��̨��¼ip
	 *
	 * @param string $ip
	 * @return boolean
	 */
	public function ipLegal($ip) {
		$ips = $this->getAllowIps();
		if (empty($ips)) return true;
		$ip = trim($ip);
		foreach ($ips as $v) {
			$v = trim(trim($v), '*');
			if ($v && strpos(",$ip.", ",$v.") === 0) return true;
		}
		return false;
	}

	/**
	 * @return AdminConfig
	 */
	private function _loadAdminConfig() {
		return Wekit::load('ADMIN:service.AdminConfig');
	}
}

?>