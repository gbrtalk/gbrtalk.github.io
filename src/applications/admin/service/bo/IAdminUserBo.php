<?php
/**
 * 用户对象接口定义
 *
 * @author Qiong Wu <papa0924@gmail.com>
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: codetemplates(windframework_docs_zend_8.0).xml 2781 2011-09-22 03:59:17Z yishuo $
 * @package wind
 */
interface IAdminUserBo {

	public function getUid();

	public function getUsername();

	public function isExists();
}

?>