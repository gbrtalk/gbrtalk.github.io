<?php
defined('WEKIT_VERSION') or exit(403);
/**
 * ȫ�ֲ�Ʒ��Ӧ������
 */
return array(
	'components' => array('resource' => 'CONF:components.php'),
	
	/**=====���ÿ�ʼ�ڴ�=====**/
	'web-apps' => array(
		'acloud' => array(
			'charset' => 'utf-8',
			'root-path' => 'SRC:aCloud',
			'modules' => array(
				'default' => array(
					'controller-path' => '', 
					'error-handler' => '', 
					'template-path' => '',
					'compile-path' => '',
					'theme-package' => ''
				),
			),
		),
	),
);