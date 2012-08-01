<?php

$installer = $this;
/* @var $installer Loewenstark_Button_Model_Installer */

$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('checkout/agreement'),
    'is_required',
    array(
        'type'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '1',
        'comment'   => 'Agreement is Required'
    )
);

$installer->endSetup();