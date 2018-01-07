<?php

class Custom_Registration_Adminhtml_RegistrationController extends Mage_Adminhtml_Controller_Action
{
		protected function _isAllowed()
		{
		//return Mage::getSingleton('admin/session')->isAllowed('registration/registration');
			return true;
		}

		protected function _initAction()
		{
				$this->loadLayout()->_setActiveMenu("registration/registration")->_addBreadcrumb(Mage::helper("adminhtml")->__("Registration  Manager"),Mage::helper("adminhtml")->__("Registration Manager"));
				return $this;
		}
		public function indexAction() 
		{
			    $this->_title($this->__("Registration"));
			    $this->_title($this->__("Manager Registration"));

				$this->_initAction();
				$this->renderLayout();
		}
		public function editAction()
		{			    
			    $this->_title($this->__("Registration"));
				$this->_title($this->__("Registration"));
			    $this->_title($this->__("Edit Item"));
				
				$id = $this->getRequest()->getParam("id");
				$model = Mage::getModel("registration/registration")->load($id);
				if ($model->getId()) {
					Mage::register("registration_data", $model);
					$this->loadLayout();
					$this->_setActiveMenu("registration/registration");
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Registration Manager"), Mage::helper("adminhtml")->__("Registration Manager"));
					$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Registration Description"), Mage::helper("adminhtml")->__("Registration Description"));
					$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);
					$this->_addContent($this->getLayout()->createBlock("registration/adminhtml_registration_edit"))->_addLeft($this->getLayout()->createBlock("registration/adminhtml_registration_edit_tabs"));
					$this->renderLayout();
				} 
				else {
					Mage::getSingleton("adminhtml/session")->addError(Mage::helper("registration")->__("Item does not exist."));
					$this->_redirect("*/*/");
				}
		}

		public function newAction()
		{

		$this->_title($this->__("Registration"));
		$this->_title($this->__("Registration"));
		$this->_title($this->__("New Item"));

        $id   = $this->getRequest()->getParam("id");
		$model  = Mage::getModel("registration/registration")->load($id);

		$data = Mage::getSingleton("adminhtml/session")->getFormData(true);
		if (!empty($data)) {
			$model->setData($data);
		}

		Mage::register("registration_data", $model);

		$this->loadLayout();
		$this->_setActiveMenu("registration/registration");

		$this->getLayout()->getBlock("head")->setCanLoadExtJs(true);

		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Registration Manager"), Mage::helper("adminhtml")->__("Registration Manager"));
		$this->_addBreadcrumb(Mage::helper("adminhtml")->__("Registration Description"), Mage::helper("adminhtml")->__("Registration Description"));


		$this->_addContent($this->getLayout()->createBlock("registration/adminhtml_registration_edit"))->_addLeft($this->getLayout()->createBlock("registration/adminhtml_registration_edit_tabs"));

		$this->renderLayout();

		}
		public function saveAction()
		{

			$post_data=$this->getRequest()->getPost();


				if ($post_data) {

					try {

						

						$model = Mage::getModel("registration/registration")
						->addData($post_data)
						->setId($this->getRequest()->getParam("id"))
						->save();

						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Registration was successfully saved"));
						Mage::getSingleton("adminhtml/session")->setRegistrationData(false);

						if ($this->getRequest()->getParam("back")) {
							$this->_redirect("*/*/edit", array("id" => $model->getId()));
							return;
						}
						$this->_redirect("*/*/");
						return;
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						Mage::getSingleton("adminhtml/session")->setRegistrationData($this->getRequest()->getPost());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					return;
					}

				}
				$this->_redirect("*/*/");
		}



		public function deleteAction()
		{
				if( $this->getRequest()->getParam("id") > 0 ) {
					try {
						$model = Mage::getModel("registration/registration");
						$model->setId($this->getRequest()->getParam("id"))->delete();
						Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item was successfully deleted"));
						$this->_redirect("*/*/");
					} 
					catch (Exception $e) {
						Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
						$this->_redirect("*/*/edit", array("id" => $this->getRequest()->getParam("id")));
					}
				}
				$this->_redirect("*/*/");
		}

		
		public function massRemoveAction()
		{
			try {
				$ids = $this->getRequest()->getPost('designer_register_ids', array());
				foreach ($ids as $id) {
                      $model = Mage::getModel("registration/registration");
					  $model->setId($id)->delete();
				}
				Mage::getSingleton("adminhtml/session")->addSuccess(Mage::helper("adminhtml")->__("Item(s) was successfully removed"));
			}
			catch (Exception $e) {
				Mage::getSingleton("adminhtml/session")->addError($e->getMessage());
			}
			$this->_redirect('*/*/');
		}
			
		/**
		 * Export order grid to CSV format
		 */
		public function exportCsvAction()
		{
			$fileName   = 'registration.csv';
			$grid       = $this->getLayout()->createBlock('registration/adminhtml_registration_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
		} 
		/**
		 *  Export order grid to Excel XML format
		 */
		public function exportExcelAction()
		{
			$fileName   = 'registration.xml';
			$grid       = $this->getLayout()->createBlock('registration/adminhtml_registration_grid');
			$this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
		}
}
