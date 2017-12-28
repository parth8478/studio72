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
    
    public function __construct()
    {
        parent::__construct();
        $collection = Mage::getModel('designer/designer')->getCollection();
        $this->setCollection($collection);
    }
    
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(5=>5,10=>10,20=>20,'all'=>'all'));
        $pager->setCollection($this->getCollection());
        $this->setChild('pager', $pager);
        $this->getCollection()->load();
        return $this;
    }
    
    public function getToolbarHtml()
    {
        return $this->getChildHtml('pager');
    }
    
    public function getPosts()
    {
        $collection = $this->_prepareCollection();
        //parent::_processCollection($collection);
        return $collection;
    }

    protected function _prepareCollection()
    {
        if (!$this->getData('cached_collection')) {
            $sortOrder = $this->getCurrentOrder();
            $sortDirection = $this->getCurrentDirection();
            $collection = Mage::getModel('designer/designer')->getCollection();
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
    public function getDesignerbyName($name){
        $collection = Mage::getModel('designer/designer')->getCollection();
        $collection->addFieldToSelect('designer_id');
        $collection->addFieldToSelect('name');
        $collection->addFieldToSelect('image');
        $collection->addFieldToFilter('name',$name);
        return $collection;
    }
}