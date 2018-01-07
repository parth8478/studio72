<?php

class Custom_Registration_Block_Adminhtml_Registration_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

		public function __construct()
		{
				parent::__construct();
				$this->setId("registrationGrid");
				$this->setDefaultSort("designer_register_id");
				$this->setDefaultDir("DESC");
				$this->setSaveParametersInSession(true);
		}

		protected function _prepareCollection()
		{
				$collection = Mage::getModel("registration/registration")->getCollection();
				$this->setCollection($collection);
				return parent::_prepareCollection();
		}
		protected function _prepareColumns()
		{
				$this->addColumn("designer_register_id", array(
				"header" => Mage::helper("registration")->__("ID"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "number",
				"index" => "designer_register_id",
				));
                                
                                $this->addColumn("name", array(
				"header" => Mage::helper("registration")->__("Name"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "varchar",
				"index" => "name",
				));
                                
                                $this->addColumn("field", array(
				"header" => Mage::helper("registration")->__("Field"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "varchar",
				"index" => "field",
				));
                                
                                $this->addColumn("city", array(
				"header" => Mage::helper("registration")->__("City"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "varchar",
				"index" => "city",
				));
                                
                                $this->addColumn("email", array(
				"header" => Mage::helper("registration")->__("Email"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "varchar",
				"index" => "email",
				));
                                
                                $this->addColumn("phone no", array(
				"header" => Mage::helper("registration")->__("phone_no"),
				"align" =>"right",
				"width" => "50px",
			    "type" => "varchar",
				"index" => "phone_no",
				));
                                
                
			$this->addExportType('*/*/exportCsv', Mage::helper('sales')->__('CSV')); 
			$this->addExportType('*/*/exportExcel', Mage::helper('sales')->__('Excel'));

				return parent::_prepareColumns();
		}

		public function getRowUrl($row)
		{
			   return $this->getUrl("*/*/edit", array("id" => $row->getId()));
		}


		
		protected function _prepareMassaction()
		{
			$this->setMassactionIdField('designer_register_id');
			$this->getMassactionBlock()->setFormFieldName('designer_register_ids');
			$this->getMassactionBlock()->setUseSelectAll(true);
			$this->getMassactionBlock()->addItem('remove_registration', array(
					 'label'=> Mage::helper('registration')->__('Remove Registration'),
					 'url'  => $this->getUrl('*/adminhtml_registration/massRemove'),
					 'confirm' => Mage::helper('registration')->__('Are you sure?')
				));
			return $this;
		}
			

}