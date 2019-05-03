<?php
/**
 * ��̨ϵͳ�ⲿ���������ӿڶ���
 * 
 * ��̨Ӧ����Ҫ��������ⲿ�ķ�����Ҫ�ڸýӿ��ж���
 * Ĭ����ʵ�֡�ADMIN:service.srv.do��
 * @author Qiong Wu <papa0924@gmail.com>
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: codetemplates(windframework_docs_zend_8.0).xml 2781 2011-09-22 03:59:17Z yishuo $
 * @package wind
 */
interface IAdminUserDependenceService {

	/**
	 * ���º�̨�û�ʱ����ӣ�ɾ���������û����Ӧ״ֵ̬
	 *
	 * @param boolean $status
	 * @return boolean PwError
	 */
	public function updateUserStatus($uid, $status);

	/**
	 * ��֤���û��������벢�����û���������
	 *
	 * @param string $username
	 * @param string $passwork
	 * @return PwError array
	 */
	public function verifyUser($username, $passwork);

	/**
	 * �����û�����ȡ�û���Ϣ
	 *
	 * @param string $username
	 * @return array
	 */
	public function getUserByName($username);

	/**
	 * �û����ã�����û��������޸������Ϣ������û�������������û�
	 * 
	 * @param string $username
	 * @param string $password
	 * @param string $email
	 * @param string $groupid
	 * @param string $uid
	 * @return boolean PwError
	 */
	public function setUser($username, $password, $email, $groupid = 3, $uid = 0);
	
	/**
	 * ��ȡ�û���Ϣ�б�
	 *
	 * @param array $userids
	 */
	public function getUserByUids($userids);
	
	/**
	 * �����û�ID��ȡ�û���Ϣ
	 *
	 * @param string $userid
	 * @return array['password']
	 */
	public function getUserByUid($userid);
}

?>