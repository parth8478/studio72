<?php
class Custom_Registration_Model_Mysql4_Registration extends Mage_Core_Model_Mysql4_Abstract
{
    protected function _construct()
    {
        $this->_init("registration/registration", "designer_register_id");
    }
}