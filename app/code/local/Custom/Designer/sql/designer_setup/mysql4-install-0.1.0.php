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

/* @var $installer Mage_Core_Model_Resource_Setup */
$installer = $this;

$installer->startSetup();
try {
    $installer->run("
        CREATE TABLE IF NOT EXISTS {$this->getTable('designer/designer')} (
            `designer_id` int( 11 ) unsigned NOT NULL AUTO_INCREMENT ,
            `image` varchar( 255 ) NOT NULL default '',
            `name` varchar( 255 ) NOT NULL default '',
            `city` varchar( 255 ) NOT NULL default '',
            `institute` varchar( 255 ) NOT NULL default '',
            `description` text NOT NULL ,
            `featured` TINYINT(2) NOT NULL,
            `social_link` varchar( 255 ) NOT NULL default '',
            PRIMARY KEY ( `designer_id` ) ,
            UNIQUE KEY `identifier` ( `identifier` )
        ) ENGINE = InnoDB DEFAULT CHARSET = utf8;

    ");
} catch (Exception $e) {
    Mage::logException($e);
}

$installer->endSetup();
