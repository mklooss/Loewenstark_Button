<?php

class Loewenstark_Button_Helper_Catalog_Product_Configuration
extends Mage_Catalog_Helper_Product_Configuration
{
    
    var $_finished = array();
    
    /**
     * Merge Attributes
     * @see parent::getCustomOptions()
     *
    **/
    public function getCustomOptions(Mage_Catalog_Model_Product_Configuration_Item_Interface $item)
    {
        $options_parent = parent::getCustomOptions($item);
        $options_self = self::getAttributes($item);
        $options = array_merge($options_parent,$options_self);
        return $options;
    }
    
    /**
     * getProduct Model
     * @param $item Mage_Catalog_Model_Product_Configuration_Item_Interface 
     * @return Mage_Catalog_Model_Product
    **/
    protected function getProduct($item)
    {
        return $item->getProduct();
    }

    /**
     * get Attribute Data
     *
     * @param $item Mage_Catalog_Model_Product_Configuration_Item_Interface
     * @return array
    **/
	public function getAttributes($item)
    {
		$itemId = $item->getId();
		if (!isset($this->_finished[$itemId])) {
			$this->_finished[$itemId] = true;
			$product = $this->getProduct($item);
			$attributes = $this->getAdditionalData($product);
			if (count($attributes) > 0) {
				return $attributes;
			}
		}
		return array();
	}

    /**
     * get Attribute Data (Text / etc)
     *
     * @param $product Mage_Catalog_Model_Product
     * @return array
    **/
    protected function getAdditionalData($product)
    {
        $data = array();
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            if ($attribute->getIsVisibleOnCheckout()) {
                $value = $attribute->getFrontend()->getValue($product);

                if (!$product->hasData($attribute->getAttributeCode())) {
                    $value = Mage::helper('catalog')->__('N/A');
                } elseif ((string)$value == '') {
                    $value = Mage::helper('catalog')->__('No');
                } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                    $value = Mage::app()->getStore()->convertPrice($value, true);
                }

                if (is_string($value) && strlen($value)) {
                    $data[$attribute->getAttributeCode()] = array(
                        'label' => $attribute->getStoreLabel(),
                        'value' => $value,
                        'print_value' => $value,
                        'code'  => $attribute->getAttributeCode()
                    );
                }
            }
        }
        return $data;
    }
}
