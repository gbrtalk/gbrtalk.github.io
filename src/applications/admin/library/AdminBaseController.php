<?php
/**
 * @author Qiong Wu <papa0924@gmail.com> 2011-10-25
 * @copyright 2003-2103 phpwind.com
 * @license http://www.windframework.com
 * @version $Id: AdminBaseController.php 28892 2013-05-29 06:41:54Z jieyin $
 * @package admin
 * @subpackage library
 */
class AdminBaseController extends WindController {

	/**
	 * ��̨��¼�û�����
	 *
	 * @var AdminUserBo
	 */
	protected $loginUser = null;

	/* (non-PHPdoc)
	 * @see WindSimpleController::beforeAction()
	 */
	public function beforeAction($handlerAdapter) {
		$this->loginUser = Wekit::getLoginUser();
		$this->setOutput($this->loginUser, 'loginUser');
	}

	/* (non-PHPdoc)
	 * @see WindSimpleController::setDefaultTemplateName()
	 */
	protected function setDefaultTemplateName($handlerAdapter) {
		$template = $handlerAdapter->getController() . '_' . $handlerAdapter->getAction();
		$this->setTemplate(strtolower($template));
	}

	/**
	 * ��ʾ��Ϣ
	 * 
	 * @param string $message ��Ϣ��Ϣ
	 * @param string $referer ��ת��ַ
	 * @param boolean $referer �Ƿ�ˢ��ҳ��
	 * @param string $action ������
	 * @see WindSimpleController::showMessage()
	 */
	protected function showMessage($message = '', $referer = '', $refresh = false) {
		$this->addMessage('success', 'state');
		$this->addMessage($this->forward->getVars('data'), 'data');
		$this->addMessage($this->forward->getVars('html'), 'html');
		$this->showError($message, $referer, $refresh);
	}

	/**
	 * ��ʾ����
	 * 
	 * @param array $error array('',array())
	 */
	protected function showError($error = '', $referer = '', $refresh = false) {
		$referer && $referer = WindUrlHelper::createUrl($referer);
		$this->addMessage($referer, 'referer');
		$this->addMessage($refresh, 'refresh');
		parent::showMessage($error);
	}
	
	/**
	 * �ж��û��Ƿ��Ǵ�ʼ��
	 *
	 * @param string $username
	 * @return boolean
	 */
	protected function isFounder($username) {
		return Wekit::load('ADMIN:service.srv.AdminFounderService')->isFounder($username);
	}

}

?>