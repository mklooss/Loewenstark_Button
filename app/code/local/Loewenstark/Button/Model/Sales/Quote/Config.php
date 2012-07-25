<?php

class Loewenstark_Button_Model_Sales_Quote_Config
extends Mage_Sales_Model_Quote_Config
{
    
    CONST CACHE_VARIABLE = "quote_config_attributes";
    
    /**
     * @see Mage_Sales_Model_Quote_Config::getProductAttributes
     * @description Caching hinzugefügt
     * 
     * @return array Product Attributes
     **/
    public function getProductAttributes()
    {
        $cache = Mage::getSingleton('core/cache');
        $result = $cache->load(self::CACHE_VARIABLE);
        if(empty($result)) {
            $result = $this->_getProductAttributesCollection();
            $cache->save(implode(",",$result), self::CACHE_VARIABLE, array("config"), null);
        } else {
            $result = explode(",", $result);
        }
        return $result;
    }
    
    /**
     * get IsVisibleOnCheckout Attributes
     * 
     * @return array Product Attributes
    **/
    protected function _getProductAttributesCollection() {
        $result = (array) parent::getProductAttributes();
        $collection = Mage::getResourceModel('catalog/product_attribute_collection')->setItemObjectClass('catalog/resource_eav_attribute');
        $collection->getSelect()->distinct(true);
        $collection->addFieldToFilter('additional_table.is_visible_on_checkout', array('gt' => 0));
        $collection->addFieldToFilter('attribute_code', array('nin' => $result));
        $attributes = $collection->load();
        
        foreach($attributes as $attribute) {
            $result[] = $attribute->getAttributeCode();
        }
        
        return $result;
    }
}