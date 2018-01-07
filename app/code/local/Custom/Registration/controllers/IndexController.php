<?php
class Custom_Registration_IndexController extends Mage_Core_Controller_Front_Action{
    public function IndexAction() {
      
	  $this->loadLayout();   
	  $this->getLayout()->getBlock("head")->setTitle($this->__("Register as Desginer"));
	        $breadcrumbs = $this->getLayout()->getBlock("breadcrumbs");
      $breadcrumbs->addCrumb("home", array(
                "label" => $this->__("Home Page"),
                "title" => $this->__("Home Page"),
                "link"  => Mage::getBaseUrl()
		   ));

      $breadcrumbs->addCrumb("register as desginer", array(
                "label" => $this->__("Register as Desginer"),
                "title" => $this->__("Register as Desginer")
		   ));

      $this->renderLayout(); 
	  
    }
    public function SaveAction() {
        $alldata = $this->getRequest()->getPost();
        $model = Mage::getModel("registration/registration");
        foreach($alldata as $key=>$value){
            $model->setData($key,$value);
        }
        
        /******************Attachment 1********************************************/
                $fileName = '';
                if (isset($_FILES['attachment1']['name']) && $_FILES['attachment1']['name'] != '') {

                    try {
                        $fileName       = $_FILES['attachment1']['name'];
                        $fileExt        = strtolower(substr(strrchr($fileName, ".") ,1));
                        $fileNamewoe    = rtrim($fileName, $fileExt);
                        $fileNamewoe    = rtrim($fileNamewoe,'.');
                        $fileName       = $fileNamewoe . time() . '.' . $fileExt;
 
                        $uploader       = new Varien_File_Uploader('attachment1');
                        $uploader->setAllowedExtensions(array('doc', 'docx','pdf', 'jpg', 'png', 'zip')); //add more file types you want to allow
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS . 'designer'. DS . 'registration';
                        
                        if(!is_dir($path)){
                            mkdir($path, 0777, true);
                        }
                        $uploader->save($path . DS, $fileName );
                        $model->setData('attachment1',$fileName);
 
                    } catch (Exception $e) {
                        Mage::getSingleton('customer/session')->addError($e->getMessage());
                        $error = true;
                    }
                }
                /**********Attachment1****************************************************/
                
                /******************Attachment 2********************************************/
                $fileName = '';
                if (isset($_FILES['attachment2']['name']) && $_FILES['attachment2']['name'] != '') {

                    try {
                        $fileName       = $_FILES['attachment2']['name'];
                        $fileExt        = strtolower(substr(strrchr($fileName, ".") ,1));
                        $fileNamewoe    = rtrim($fileName, $fileExt);
                        $fileNamewoe    = rtrim($fileNamewoe,'.');
                        $fileName       = $fileNamewoe . time() . '.' . $fileExt;
                        
                        $uploader       = new Varien_File_Uploader('attachment2');
                        $uploader->setAllowedExtensions(array('doc', 'docx','pdf', 'jpg', 'png', 'zip')); //add more file types you want to allow
                        $uploader->setAllowRenameFiles(false);
                        $uploader->setFilesDispersion(false);
                        $path = Mage::getBaseDir('media') . DS . 'designer'. DS . 'registration';
                        
                        if(!is_dir($path)){
                            mkdir($path, 0777, true);
                        }
                        $uploader->save($path . DS, $fileName );
                        $model->setData('attachment2',$fileName);
 
                    } catch (Exception $e) {
                        Mage::getSingleton('customer/session')->addError($e->getMessage());
                        $error = true;
                    }
                }
                /**********Attachment1****************************************************/
        $model->save();
        Mage::getModel('core/session')->addSuccess('Thank you for registering with us.Admin will contact you soon.');
        $this->_redirect('*/*/');
    }
}