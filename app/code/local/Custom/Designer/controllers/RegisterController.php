<?php

class Custom_Designer_RegisterController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Register as a Designer'));
        $this->renderLayout();
    }
    
}