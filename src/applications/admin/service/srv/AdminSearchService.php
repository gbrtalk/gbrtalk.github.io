<?php
class AdminSearchService {
	private $_keyword;
	private $_menus = array();
	
	/**
	 * ���캯��
	 * @param string $keyword 
	 * @param array $menus  �û�ӵ�з���Ȩ�޵Ĳ˵�����
	 */
	public function __construct($keyword,$menus) {
		$this->_keyword = $keyword;
		$this->_initMenus($menus);
	}
	
	/**
	 * ��ʼ���˵�
	 * @param array $menus 
	 * @param int $level �ò˵��Ĳ㼶
	 */
	private function _initMenus($menus,$level = 1) {
		foreach ($menus as $v) {
			if ($v['url'] && $v['name'] && $v['id']) {
				$this->_menus[$v['id']] = array(
					'url' => $v['url'],
					'name' => $v['name'],
					'parent' => $v['parent'],
					'level' => $level
				);
			}
			if ($v['items']) {
				$this->_initMenus($v['items'], $level + 1);
			}
		}
	}
	
	/**
	 * ִ������
	 * @return array
	 */
	public function search() {
		$result = array();
		//$resource = Wind::getComponent('i18n');
		$parser = Wekit::load('ADMIN:service.srv.AdminSearchLangParserService');
		$texts = $parser->parseSearchLang();
		foreach ($this->_menus as $k1 => $v1) {
			list($s1, $t1) = $this->_check($v1['name']);
			if ($s1) {
				$v1['name'] = $t1;
				$result[$k1] = $v1;
			}
			//$desc = $resource->getMessage("ADMIN:search.{$k}");
			$desc = $texts[$k1];
			if ($desc) {
				$subItems = array();
				$matchMain = false;
				if (is_array($desc['items'])) {
					foreach ($desc['items'] as $v) {
						list($s, $t) = $this->_check($v);
						if ($s) {
							$result[$k1]['items'][] = $t;
							$matchMain = true;
						}
					}
				}
				if (count($desc) > 1) {//����
					foreach ($desc as $k2 => $v2) {
						if ($k2 == 'items') continue;
						$tmp = array();
						if ($v2['items']) {
							foreach ($v2['items'] as $v3) {
								list($s, $t) = $this->_check($v3);
								$s && $tmp['items'][] = $t;
							}
							if ($tmp['items']) {
								$tmp['name'] = $k2;
								$tmp['url'] = $v2['url'];
							}
						}
						$tmp && $subItems[] = $tmp;
					}
				}
				if ($matchMain || $subItems) {
					$tmp = null;
					if (!$s1) {
						$result[$k1]['items'] && $tmp = $result[$k1]['items'];
						$v1['name'] = $t1;
						$result[$k1] = $v1;
					}
					$result[$k1]['sub'] = $subItems;
					$tmp && $result[$k1]['items'] = $tmp;
				}
			}
		}
		return $result;
	}
	
	/**
	 * ����Ƿ����Ǳ�����
	 * @param string $string 
	 * @return array
	 */
	private function _check($string) {
		$s = false;
		$t = $string;
		if (strpos(strtolower($string), strtolower($this->_keyword)) !== false) {
			$s = true;
			$t = str_replace($this->_keyword, '<font color="red">' . $this->_keyword . '</font>', $string);
		}
		return array($s, $t);
	}
}