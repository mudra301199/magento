<?php
$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn($installer->getTable('sales/order'), 'custom_field', array(
        'type'    => Varien_Db_Ddl_Table::TYPE_TEXT,
        'length'  => 255,
        'nullable' => true,
        'comment' => 'Custom Field'
    ));

$installer->endSetup();
