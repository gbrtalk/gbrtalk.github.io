<?php
defined('WEKIT_VERSION') or exit(403);

/**
 * ��̨Ĭ�ϲ˵�������Ϣ,�˵����ø�ʽ���£�
 * һ���˵������ø�ʽ�а���: �˵�����, ·����Ϣ, �˵�ͼ��, �˵�tip, ���ڵ�, ��һ���˵�
 * �˵�:  'key' => array('�˵�����', 'Ӧ��·��', 'icon' , ' tip' ,'���ڵ�key', '��һ���˵�key'),
 *
 * <note>
 * 1. ���û����д��һ���˵���Ĭ�Ϸ����ڽڵ����.
 * 2. ���û�и��ڵ��򲢷�����'��һ���˵�֮��'.
 * 3. ���'���ڵ�','��һ���˵�'��û����ɢ��ķ����������.
 * </note>
 *
 * �ڵ㶨��: 'Key' => array('�ڵ�����', �Ӳ˵�, 'icon', 'tip' ,'���ڵ�key'),
 */
return array(
	/*========Ϊ����ʾ������̨�����˵��������=========*/
//	'offen' => array('����', array()),
//	'offen' => array('����', '', '', '', ''),


	/**=====���ÿ�ʼ�ڴ�=====**/
	'custom' => array('����', array()),
	'admin' => array('��ʼ��', array()),

	'custom_set' => array('���ò˵�', 'custom/*', '', '', 'custom'),
	'admin_founder' => array('��ʼ�˹���', 'founder/*', '', '', 'admin'),
	'admin_auth' => array('��̨Ȩ��', 'auth,role/*', '', '', 'admin'),
	'admin_safe' => array('��̨��ȫ', 'safe/*', '', '', 'admin'),

	//���ҵ����ã���ͳһ��������ϵͳ�滮����
	'_extensions' => array(
		//'config' => array('resource' => 'APPS:config.conf.configmenu.php'),//ȫ��
	),
);
/**=====���ý����ڴ�=====**/
