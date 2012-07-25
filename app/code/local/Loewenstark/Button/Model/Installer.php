<?php

if (version_compare(Mage::getVersion(), '1.6', '<')) {
// use old installer
class Loewenstark_Button_Model_Installer
    extends Mage_Catalog_Model_Resource_Eav_Mysql4_Setup
    {} // empty
} else {
    class Loewenstark_Button_Model_Installer
    extends Mage_Eav_Model_Entity_Setup
    {} // empty
}