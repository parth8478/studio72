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


//class Custom_Designer_Block_Designer extends Custom_Designer_Block_Abstract
class Custom_Designer_Block_Designer extends Mage_Core_Block_Template
{
    public function getPosts()
    {
        $collection = $this->_prepareCollection();
        //parent::_processCollection($collection);
        return $collection;
    }

    protected function _prepareLayout()
    {
        
    }

    protected function _prepareCollection()
    {
        if (!$this->getData('cached_collection')) {
            $sortOrder = $this->getCurrentOrder();
            $sortDirection = $this->getCurrentDirection();
            $collection = Mage::getModel('designer/designer')->getCollection();
            //$collection->setOrder($collection->getConnection()->quote($sortOrder), $sortDirection);
            $collection->setPageSize(5);

            $this->setData('cached_collection', $collection);
        }
        return $this->getData('cached_collection');
    }


    public function getCurrentDirection()
    {
        $dir = $this->getRequest()->getParam('dir');

        if (in_array($dir, array('asc', 'desc'))) {
            return $dir;
        }

        return Mage::helper('blog')->defaultPostSort(Mage::app()->getStore()->getId());
    }
    public function getDesigner($id){
        $collection = Mage::getModel('designer/designer')->getCollection();
        $collection->addFieldToFilter('designer_id',$id);
        return $collection;
    }
}