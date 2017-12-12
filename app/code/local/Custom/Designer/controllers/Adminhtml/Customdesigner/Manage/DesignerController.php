<?php
/**
 * aheadWorks Co.
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the EULA
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://ecommerce.aheadworks.com/AW-LICENSE.txt
 *
 * =================================================================
 *                 MAGENTO EDITION USAGE NOTICE
 * =================================================================
 * This software is designed to work with Magento community edition and
 * its use on an edition other than specified is prohibited. aheadWorks does not
 * provide extension support in case of incorrect edition use.
 * =================================================================
 *
 * @category   AW
 * @package    AW_Blog
 * @version    tip
 * @copyright  Copyright (c) 2010-2012 aheadWorks Co. (http://www.aheadworks.com)
 * @license    http://ecommerce.aheadworks.com/AW-LICENSE.txt
 */


class Custom_Designer_Adminhtml_Customdesigner_Manage_DesignerController extends Mage_Adminhtml_Controller_Action
{
    public function preDispatch()
    {
        parent::preDispatch();
    }

    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('admin/designer/designers');
    }

    protected function _initAction()
    {
        $this
            ->loadLayout()
            ->_setActiveMenu('designer/designer')
        ;

        return $this;
    }

    public function indexAction()
    {
        $this->displayTitle('Designers');
        $this
            ->_initAction()
            ->renderLayout()
        ;
    }

    public function editAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('designer/designer')->load($id);
        if ($model->getId() || $id == 0) {
            $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
            if (!empty($data)) {
                $model->setData($data);
            }

            Mage::register('designer_data', $model);

            $this->loadLayout();
            $this->_setActiveMenu('designer/designers');
            $this->displayTitle('Edit Designer');

            $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);

            $this
                ->_addContent($this->getLayout()->createBlock('designer/manage_designer_edit'))
                ->_addLeft($this->getLayout()->createBlock('designer/manage_designer_edit_tabs'))
            ;

            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);

            $this->renderLayout();
        } else {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('designer')->__('Designer does not exist'));
            $this->_redirect('*/*/');
        }
    }

    public function newAction()
    {
        $id = $this->getRequest()->getParam('id');
        $model = Mage::getModel('designer/designer')->load($id);

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }
        
        
        Mage::register('designer_data', $model);

        $this->loadLayout();
        $this->_setActiveMenu('designer/designers');
        $this->displayTitle('Add new designer');

        $this->getLayout()->getBlock('head')->setCanLoadExtJs(true);
        
        $this
            ->_addContent($this->getLayout()->createBlock('designer/manage_designer_edit'))
            ->_addLeft($this->getLayout()->createBlock('designer/manage_designer_edit_tabs'))
        ;
        $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        $this->renderLayout();
    }

    public function duplicateAction()
    {
        $oldIdentifier = $this->getRequest()->getParam('identifier');
        $i = 1;
        $newIdentifier = $oldIdentifier . $i;
        while (Mage::getModel('designer/post')->loadByIdentifier($newIdentifier)->getData()) {
            $newIdentifier = $oldIdentifier . ++$i;
        }
        $this->getRequest()->setPost('identifier', $newIdentifier);
        $this->_forward('save');
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {
            $model = Mage::getModel('designer/designer');
            
            
            
            if(isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
                try {   
                    $uploader = new Varien_File_Uploader('image');
                    
                    $uploader->setAllowedExtensions(array('jpg','jpeg','gif','png'));
                    $uploader->setAllowRenameFiles(true);
                    
                    // Set the file upload mode 
                    // false -> get the file directly in the specified folder
                    // true -> get the file in the product like folders 
                    //  (file.jpg will go in something like /media/f/i/file.jpg)
                    $uploader->setFilesDispersion(false);
                            
                    // We set media as the upload dir
                    $path = Mage::getBaseDir('media') . DS . 'designer' . DS;
                    $result = $uploader->save($path, $_FILES['image']['name'] );
                    
                    //this way the name is saved in DB
                    $data['image'] = 'designer/'. $result['file'];
                } catch (Exception $e) {
              
                }           
            } else {
                if(isset($data['image']['delete']) && $data['image']['delete'] == 1) {
                     $data['image'] = '';
                } else {
                    unset($data['image']);
                }
            }
            
            
            try {
                $format = Mage::app()->getLocale()->getDateTimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_MEDIUM);
                if (isset($data['created_time']) && $data['created_time']) {
                    $dateFrom = Mage::app()->getLocale()->date($data['created_time'], $format);
                    $model->setCreatedTime(Mage::getModel('core/date')->gmtDate(null, $dateFrom->getTimestamp()));
                    $model->setUpdateTime(Mage::getModel('core/date')->gmtDate());
                } else {
                    $model->setCreatedTime(Mage::getModel('core/date')->gmtDate());
                }

                if ($this->getRequest()->getParam('user') == null) {
                    $model
                        ->setUser(
                            Mage::getSingleton('admin/session')->getUser()->getFirstname() . " " . Mage::getSingleton(
                                'admin/session'
                            )->getUser()->getLastname()
                        )
                        ->setUpdateUser(
                            Mage::getSingleton('admin/session')->getUser()->getFirstname() . " " . Mage::getSingleton(
                                'admin/session'
                            )->getUser()->getLastname()
                        )
                    ;
                } else {
                    $model
                        ->setUpdateUser(
                            Mage::getSingleton('admin/session')->getUser()->getFirstname() . " " . Mage::getSingleton(
                                'admin/session'
                            )->getUser()->getLastname()
                        )
                    ;
                }
                
                $model
                ->setData($data)
                ->setId($this->getRequest()->getParam('id'))
            ;

                $model->save();

                
                    Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('designer')->__('Designer was successfully saved.')
                );
                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('id' => $model->getId()));
                    return;
                }
                $this->_redirect('*/*/');
                return;
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                Mage::getSingleton('adminhtml/session')->setFormData($data);
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('designer')->__('Unable to find designer to save'));
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        $postId = (int)$this->getRequest()->getParam('id');
        if ($postId) {
            try {
                $this->_postDelete($postId);
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__('Post was successfully deleted')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('id' => $this->getRequest()->getParam('id')));
            }
        }
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $blogIds = $this->getRequest()->getParam('designer');
        if (!is_array($blogIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('adminhtml')->__('Please select post(s)'));
        } else {
            try {
                foreach ($blogIds as $postId) {
                    $this->_postDelete($postId);
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('adminhtml')->__(
                        'Total of %d record(s) were successfully deleted', count($blogIds)
                    )
                );
            } catch (Exception $e) {
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function _postDelete($postId)
    {
        $model = Mage::getModel('designer/designer')->load($postId);
        $model->delete();
    }

    public function massStatusAction()
    {
        $blogIds = $this->getRequest()->getParam('blog');
        if (!is_array($blogIds)) {
            Mage::getSingleton('adminhtml/session')->addError($this->__('Please select post(s)'));
        } else {
            try {

                foreach ($blogIds as $blogId) {
                    $blog = Mage::getModel('blog/blog')
                        ->load($blogId)
                        ->setStatus($this->getRequest()->getParam('status'))
                        ->setStores('')
                        ->setIsMassupdate(true)
                        ->save()
                    ;
                }
                $this->_getSession()->addSuccess(
                    $this->__('Total of %d record(s) were successfully updated', count($blogIds))
                );
            } catch (Exception $e) {

                $this->_getSession()->addError($e->getMessage());
            }
        }
        $this->_redirect('*/*/index');
    }

    protected function displayTitle($data = null, $root = 'Designer')
    {
        if (!Mage::helper('blog')->magentoLess14()) {
            if ($data) {
                if (!is_array($data)) {
                    $data = array($data);
                }
                foreach ($data as $title) {
                    $this->_title($this->__($title));
                }
                $this->_title($this->__($root));
            } else {
                $this->_title($this->__('Designer'))->_title($root);
            }
        }
        return $this;
    }
}