<?php

$installer = $this;
/* @var $installer Loewenstark_Button_Model_Installer */

$installer->startSetup();

$installer->run("ALTER TABLE  `{$installer->getTable('catalog/eav_attribute')}` ADD  `is_visible_on_checkout` SMALLINT( 5 ) NOT NULL DEFAULT  '0';");

$installer->endSetup();