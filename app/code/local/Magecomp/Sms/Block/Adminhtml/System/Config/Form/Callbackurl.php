<?php

class Magecomp_Sms_Block_Adminhtml_System_Config_Form_Callbackurl extends Mage_Adminhtml_Block_System_Config_Form_Field
{
    /*
     * Set template
     */
    protected function _construct()
    {
        parent::_construct();
		$this->setTemplate('sms/system/config/Callbackurl.phtml');
    }
	/**
     * Return element html
     *
     * @param  Varien_Data_Form_Element_Abstract $element
     * @return string
     */
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        return $this->_toHtml();
    }
	
	/**
     * Generate button html
     *
     * @return string
     */
	

 }