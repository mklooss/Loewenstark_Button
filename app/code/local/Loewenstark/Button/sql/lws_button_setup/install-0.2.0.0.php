<?php

$installer = $this;
/* @var $installer Loewenstark_Button_Model_Installer */

$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('catalog/eav_attribute'),
    'is_visible_on_checkout',
    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
        'comment'   => 'Visible in Checkout'
    )
);

$installer->endSetup();