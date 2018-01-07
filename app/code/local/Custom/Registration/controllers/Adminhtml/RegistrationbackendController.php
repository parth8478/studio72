<?php
class Custom_Registration_Adminhtml_RegistrationbackendController extends Mage_Adminhtml_Controller_Action
{

	protected function _isAllowed()
	{
		//return Mage::getSingleton('admin/session')->isAllowed('registration/registrationbackend');
		return true;
	}

	public function indexAction()
    {
       $this->loadLayout();
	   $this->_title($this->__("Designer Registration"));
	   $this->renderLayout();
    }
}