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


class Custom_Designer_Block_Manage_Designer_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('designer_form', array('legend' => Mage::helper('designer')->__('Designer information')));
//        $designer = Mage::getModel('designer/designer')->load($this->getRequest()->getParam('id'));
//        $after_html = '';
//        if($designer->getimage()){
//            $path = Mage::getBaseUrl('media')."designer/".$designer->getimage();
//            $after_html = '<a href="'.$path.'" target="_blank">
//                  <img height="22" width="22" class="small-image-preview v-middle" alt="'.$designer->getimage().'" title="'.$designer->getimage().'" id="designer_image" src="'.$path.'"/>
//                  </a>'; 
//        }

        $fieldset->addField(
            'name',
            'text',
            array(
                 'label'    => Mage::helper('designer')->__('Name'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'name',
            )
        );
        
        $fieldset->addField('image','image', array(
                 'label'    => Mage::helper('designer')->__('Image'),
                 'name'     => 'image',
            )
        );
        

        
        $fieldset->addField(
            'city',
            'text',
            array(
                 'label'    => Mage::helper('designer')->__('City'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'city',
            )
        );
        
        $fieldset->addField(
            'institute',
            'text',
            array(
                 'label'    => Mage::helper('designer')->__('Institute / Present Job details'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'institute',
            )
        );
        
        $yesnoOptions = array('0' => 'No','1' => 'Yes');
        
        $fieldset->addField(
            'featured',
            'select',
            array(
                 'label'    => Mage::helper('designer')->__('Featured'),
                 'class'    => 'required-entry',
                 'required' => false,
                 'name'     => 'featured',
                 'options'   => $yesnoOptions,
            )
        );
        
        $fieldset->addField(
            'social_link',
            'text',
            array(
                 'label'    => Mage::helper('designer')->__('Social Media Link'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'social_link',
            )
        );
        
        try {
            $config = Mage::getSingleton('cms/wysiwyg_config')->getConfig();
            $config->setData(
                Mage::helper('designer')->recursiveReplace(
                    '/designer_admin/',
                    '/' . (string)Mage::app()->getConfig()->getNode('admin/routers/adminhtml/args/frontName') . '/',
                    $config->getData()
                )
            );
        } catch (Exception $ex) {
            $config = null;
        }
        
        $fieldset->addField(
            'description',
            'editor',
            array(
                 'name'   => 'description',
                 'label'  => Mage::helper('designer')->__('Brief Description'),
                 'title'  => Mage::helper('designer')->__('Brief Description'),
                 'style'  => 'width:700px; height:400px;',
                 'config' => $config
            )
        );

        if (Mage::getSingleton('adminhtml/session')->getDesignerData()) {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getDesignerData());
            Mage::getSingleton('adminhtml/session')->setDesignerData(null);
        }elseif (Mage::registry('designer_data')) {
            $form->setValues(Mage::registry('designer_data')->getData());
        }
        return parent::_prepareForm();
    }
}