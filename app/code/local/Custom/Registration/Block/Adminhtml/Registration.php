<?php


class Custom_Registration_Block_Adminhtml_Registration extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct()
	{

	$this->_controller = "adminhtml_registration";
	$this->_blockGroup = "registration";
	$this->_headerText = Mage::helper("registration")->__("Registration Manager");
	$this->_addButtonLabel = Mage::helper("registration")->__("Add New Item");
	parent::__construct();
	
	}

}