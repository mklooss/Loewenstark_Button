<?php

$installer = $this;
/* @var $installer Loewenstark_Button_Model_Installer */

$installer->startSetup();

$installer->run("
    ALTER TABLE `{$installer->getTable('checkout/agreement')}`
        ADD `is_required` SMALLINT( 5 ) NOT NULL DEFAULT '1' COMMENT 'Agreement is Required'");

$installer->endSetup();