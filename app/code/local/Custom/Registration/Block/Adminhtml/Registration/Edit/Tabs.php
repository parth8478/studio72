<?php
class Custom_Registration_Block_Adminhtml_Registration_Edit_Tabs extends Mage_Adminhtml_Block_Widget_Tabs
{
		public function __construct()
		{
				parent::__construct();
				$this->setId("registration_tabs");
				$this->setDestElementId("edit_form");
				$this->setTitle(Mage::helper("registration")->__("Item Information"));
		}
		protected function _beforeToHtml()
		{
				$this->addTab("form_section", array(
				"label" => Mage::helper("registration")->__("Item Information"),
				"title" => Mage::helper("registration")->__("Item Information"),
				"content" => $this->getLayout()->createBlock("registration/adminhtml_registration_edit_tab_form")->toHtml(),
				));
				return parent::_beforeToHtml();
		}

}
