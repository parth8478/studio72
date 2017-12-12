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


class Custom_Designer_Block_Manage_Designer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('designerGrid');
        $this->setDefaultSort('created_time');
        $this->setDefaultDir('desc');
        $this->setSaveParametersInSession(true);
    }

    protected function _getStore()
    {
        $storeId = (int)$this->getRequest()->getParam('store', 0);
        return Mage::app()->getStore($storeId);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('designer/designer')->getCollection();
        $store = $this->_getStore();
        if ($store->getId()) {
            $collection->addStoreFilter($store);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'designer_id',
            array(
                 'header' => Mage::helper('designer')->__('ID'),
                 'align'  => 'right',
                 'width'  => '50px',
                 'index'  => 'designer_id',
            )
        );

        $this->addColumn(
            'name',
            array(
                 'header' => Mage::helper('designer')->__('Name'),
                 'align'  => 'left',
                 'index'  => 'name',
            )
        );

//        $this->addColumn(
//            'identifier',
//            array(
//                 'header' => Mage::helper('designer')->__('Identifier'),
//                 'align'  => 'left',
//                 'index'  => 'identifier',
//            )
//        );
        
        $yesnoOptions = array('0' => 'No','1' => 'Yes');

        $this->addColumn('featured', array(
                 'header'    => Mage::helper('designer')->__('Featured'),
                 'index'     => 'featured',
                'type'      => 'options',
                'options'   => $yesnoOptions,
        ));

//        $this->addColumn(
//            'user',
//            array(
//                 'header' => Mage::helper('blog')->__('Poster'),
//                 'width'  => '150px',
//                 'index'  => 'user',
//            )
//        );
//
//        $this->addColumn(
//            'created_time',
//            array(
//                 'header'    => Mage::helper('blog')->__('Created at'),
//                 'index'     => 'created_time',
//                 'type'      => 'datetime',
//                 'width'     => '120px',
//                 'gmtoffset' => true,
//                 'default'   => ' -- '
//            )
//        );
//
//        $this->addColumn(
//            'update_time',
//            array(
//                 'header'    => Mage::helper('blog')->__('Updated at'),
//                 'index'     => 'update_time',
//                 'width'     => '120px',
//                 'type'      => 'datetime',
//                 'gmtoffset' => true,
//                 'default'   => ' -- '
//            )
//        );
//
//        $this->addColumn(
//            'status',
//            array(
//                 'header'  => Mage::helper('blog')->__('Status'),
//                 'align'   => 'left',
//                 'width'   => '80px',
//                 'index'   => 'status',
//                 'type'    => 'options',
//                 'options' => array(
//                     1 => Mage::helper('blog')->__('Enabled'),
//                     2 => Mage::helper('blog')->__('Disabled'),
//                     3 => Mage::helper('blog')->__('Hidden'),
//                 ),
//            )
//        );
//
//        $this->addColumn(
//            'action',
//            array(
//                 'header'    => Mage::helper('blog')->__('Action'),
//                 'width'     => '100',
//                 'type'      => 'action',
//                 'getter'    => 'getId',
//                 'actions'   => array(
//                     array(
//                         'caption' => Mage::helper('blog')->__('Edit'),
//                         'url'     => array('base' => '*/*/edit'),
//                         'field'   => 'id',
//                     )
//                 ),
//                 'filter'    => false,
//                 'sortable'  => false,
//                 'index'     => 'stores',
//                 'is_system' => true,
//            )
//        );

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('designer_id');
        $this->getMassactionBlock()->setFormFieldName('designer');

        $this->getMassactionBlock()->addItem(
            'delete',
            array(
                 'label'   => Mage::helper('designer')->__('Delete'),
                 'url'     => $this->getUrl('*/*/massDelete'),
                 'confirm' => Mage::helper('designer')->__('Are you sure?'),
            )
        );

//        $statuses = Mage::getSingleton('designer/status')->getOptionArray();

//        array_unshift($statuses, array('label' => '', 'value' => ''));
//        $this->getMassactionBlock()->addItem(
//            'status',
//            array(
//                 'label'      => Mage::helper('designer')->__('Change status'),
//                 'url'        => $this->getUrl('*/*/massStatus', array('_current' => true)),
//                 'additional' => array(
//                     'visibility' => array(
//                         'name'   => 'status',
//                         'type'   => 'select',
//                         'class'  => 'required-entry',
//                         'label'  => Mage::helper('designer')->__('Status'),
//                         'values' => $statuses,
//                     )
//                 )
//            )
//        );
//        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('id' => $row->getId()));
    }
}
