<?php

class Magecomp_Sms_Model_Mysql4_Smsregisterotp_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('sms/smsregisterotp');
    }
}