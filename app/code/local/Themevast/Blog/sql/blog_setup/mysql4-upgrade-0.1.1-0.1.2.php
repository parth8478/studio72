<?php
   $installer = $this;
    $installer->startSetup();

    $installer->getConnection()
    ->addColumn($installer->getTable('blog/blog'),'avatar', array(
        'type'      => Varien_Db_Ddl_Table::TYPE_TEXT,
        'nullable'  => true,
        'length'    => 255,
        'comment'   => 'avatar'
        ));   
    $installer->endSetup();