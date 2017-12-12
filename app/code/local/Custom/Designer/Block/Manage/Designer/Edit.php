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


class Custom_Designer_Block_Manage_Designer_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();

        $this->_objectId = 'id';
        $this->_blockGroup = 'designer';
        $this->_controller = 'manage_designer';

        $this->_updateButton('save', 'label', Mage::helper('designer')->__('Save Designer'));
        $this->_updateButton('delete', 'label', Mage::helper('designer')->__('Delete Designer'));

        $this->_addButton(
            'saveandcontinue',
            array(
                 'label'   => Mage::helper('adminhtml')->__('Save And Continue Edit'),
                 'onclick' => 'saveAndContinueEdit()',
                 'class'   => 'save',
            ),
            -100
        );

//        if ($this->getRequest()->getParam('id')) {
//            $this->_addButton(
//                'duplicate',
//                array(
//                     'label'   => Mage::helper('designer')->__('Duplicate Designer'),
//                     'onclick' => 'duplicate()',
//                     'class'   => 'save'
//                ),
//                0
//            );
//        }

        $this->_formScripts[]
            = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('designer_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'description');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'description');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }

            function duplicate() {
                $(editForm.formId).action = '" . $this->getUrl('*/*/duplicate') . "';
                editForm.submit();
            }
        ";
    }

    public function getHeaderText()
    {
        if (Mage::registry('designer_data') && Mage::registry('designer_data')->getId()) {
            return Mage::helper('designer')->__(
                "Edit Designer '%s'", $this->escapeHtml(Mage::registry('designer_data')->getName())
            );
        } else {
            return Mage::helper('designer')->__('Add Designer');
        }
    }
}