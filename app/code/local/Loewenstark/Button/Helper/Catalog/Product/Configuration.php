<?php

class Loewenstark_Button_Helper_Catalog_Product_Configuration
extends Mage_Catalog_Helper_Product_Configuration
{
    protected $_finished = array();
    protected $_custom_options = null;
    protected $_configurable_options = null;
    protected $_used_attributes = array();
    
    /**
     * Merge Attributes
     *
     * @see parent::getCustomOptions()
     * @param $item Mage_Catalog_Model_Product_Configuration_Item_Interface
     * @return array
    **/
    public function getCustomOptions(Mage_Catalog_Model_Product_Configuration_Item_Interface $item)
    {
        $options_parent = $this->getParentCustomOptions($item);
        $options_self = $this->getAttributes($item);
        return array_merge($options_parent,$options_self);
    }
    
    /**
     * @see parent::getCustomOptions()
     * @param $item Mage_Catalog_Model_Product_Configuration_Item_Interface
     * @return array
    **/
    protected function getParentCustomOptions(Mage_Catalog_Model_Product_Configuration_Item_Interface $item)
    {
        if(is_null($this->_custom_options))
        {
            $this->_custom_options = parent::getCustomOptions($item);
        }
        return $this->_custom_options;
    }
    
    /**
     * get Product Quote Model
     * @param $item Mage_Catalog_Model_Product_Configuration_Item_Interface 
     * @return Mage_Catalog_Model_Product
    **/
    protected function _getProduct(Mage_Catalog_Model_Product_Configuration_Item_Interface $item)
    {
        return $item->getProduct();
    }

    /**
     * get Attributes
     *
     * @param $item Mage_Catalog_Model_Product_Configuration_Item_Interface
     * @return array
    **/
	public function getAttributes(Mage_Catalog_Model_Product_Configuration_Item_Interface $item)
    {
		$itemId = $item->getId();
		if (!isset($this->_finished[$itemId])) {
			$this->_finished[$itemId] = true;
			$product = $this->_getProduct($item);
			$attributes = $this->_getAdditionalData($product);
			if (count($attributes) > 0) {
				return $attributes;
			}
		}
		return array();
	}

    /**
     * get Attribute Data
     *
     * @param $product Mage_Catalog_Model_Product
     * @return array
    **/
    protected function _getAdditionalData($product)
    {
        $data = array();
        $attributes = $product->getAttributes();
        foreach ($attributes as $attribute) {
            if ($attribute->getIsConfigurable())
            {
                continue;
            }
            if ($attribute->getIsVisibleOnCheckout()) {
                $value = $attribute->getFrontend()->getValue($product);

                if (!$product->hasData($attribute->getAttributeCode())) {
                    continue;
                } elseif ((string)$value == '') {
                    continue;
                } elseif ($attribute->getFrontendInput() == 'price' && is_string($value)) {
                    $value = Mage::app()->getStore()->convertPrice($value, true);
                }

                if (is_string($value) && strlen($value)) {
                    $data[] = array(
                        'label' => $attribute->getStoreLabel(),
                        'value' => $value,
                        'code'  => $attribute->getAttributeCode()
                    );
                }
            }
        }
        return $data;
    }
}
