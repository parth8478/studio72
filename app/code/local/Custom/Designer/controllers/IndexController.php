<?php

class Custom_Designer_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->_forward('list');
    }
    
    public function listAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Designer'));
        $this->renderLayout();
    }
}