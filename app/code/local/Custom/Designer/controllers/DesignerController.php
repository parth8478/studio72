<?php

class Custom_Designer_DesignerController extends Mage_Core_Controller_Front_Action
{
    public function viewAction()
    {
        $this->loadLayout();
        $this->getLayout()->getBlock('head')->setTitle($this->__('Designer'));
        $this->renderLayout();
    }
    
}