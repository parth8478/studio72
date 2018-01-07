<?php
	
class Custom_Registration_Block_Adminhtml_Registration_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
		public function __construct()
		{

				parent::__construct();
				$this->_objectId = "designer_register_id";
				$this->_blockGroup = "registration";
				$this->_controller = "adminhtml_registration";
				$this->_updateButton("save", "label", Mage::helper("registration")->__("Save Item"));
				$this->_updateButton("delete", "label", Mage::helper("registration")->__("Delete Item"));

				$this->_addButton("saveandcontinue", array(
					"label"     => Mage::helper("registration")->__("Save And Continue Edit"),
					"onclick"   => "saveAndContinueEdit()",
					"class"     => "save",
				), -100);



				$this->_formScripts[] = "

							function saveAndContinueEdit(){
								editForm.submit($('edit_form').action+'back/edit/');
							}
						";
		}

		public function getHeaderText()
		{
				if( Mage::registry("registration_data") && Mage::registry("registration_data")->getId() ){

				    return Mage::helper("registration")->__("Edit Item '%s'", $this->htmlEscape(Mage::registry("registration_data")->getId()));

				} 
				else{

				     return Mage::helper("registration")->__("Add Item");

				}
		}
}