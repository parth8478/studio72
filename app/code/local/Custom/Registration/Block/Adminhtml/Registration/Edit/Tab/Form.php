<?php

class Custom_Registration_Block_Adminhtml_Registration_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form {

    protected function _prepareForm() {

        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset("registration_form", array("legend" => Mage::helper("registration")->__("Designer information")));
        
        $attachment = Mage::getModel('registration/registration')->load( $this->getRequest()->getParam('id') );
        $after_html = '';
        $path = Mage::getBaseUrl('media')."designer/registration/";
        $result1 = $path.$attachment->getAttachment1();
        $result2 = $path.$attachment->getAttachment2(); 

        
        $fieldset->addField(
            'name',
            'text',
            array(
                 'label'    => Mage::helper('registration')->__('Name'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'name',
            )
        );
        
        $fieldset->addField(
            'field',
            'text',
            array(
                 'label'    => Mage::helper('registration')->__('Field'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'field',
            )
        );
        
        $fieldset->addField(
            'city',
            'text',
            array(
                 'label'    => Mage::helper('registration')->__('City'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'city',
            )
        );
        
        $fieldset->addField(
            'profession',
            'text',
            array(
                 'label'    => Mage::helper('registration')->__('Profession'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'profession',
            )
        );
        
        $fieldset->addField(
            'email',
            'text',
            array(
                 'label'    => Mage::helper('registration')->__('Email'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'email',
            )
        );
        
        $fieldset->addField(
            'phone_no',
            'text',
            array(
                 'label'    => Mage::helper('registration')->__('Phone No'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'phone_no',
            )
        );
        
        $fieldset->addField('attachment1','file', array(
                 'label'    => Mage::helper('designer')->__('attachement1'),
                 'name'     => 'attachement1',
                 'after_element_html' => $result1,
            )
        );
        
        $fieldset->addField(
            'query',
            'text',
            array(
                 'label'    => Mage::helper('registration')->__('Query'),
                 'class'    => 'required-entry',
                 'required' => true,
                 'name'     => 'query',
            )
        );
        
        
        if (Mage::getSingleton("adminhtml/session")->getRegistrationData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getRegistrationData());
            Mage::getSingleton("adminhtml/session")->setRegistrationData(null);
        } elseif (Mage::registry("registration_data")) {
            $form->setValues(Mage::registry("registration_data")->getData());
        }
        return parent::_prepareForm();
    }
}
