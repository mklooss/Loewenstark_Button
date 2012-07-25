<?php

class Loewenstark_Button_Model_AttributeEditTabMain {

    /**
     * Add "Visible on Checkout Review on Front-end" Option to Attribute Settings
    **/
    public function addOption($observer) {
        $event = $observer->getEvent();
        $form = $event->getForm();
        
        $fieldset = $form->getElement('front_fieldset');
        $yesnoSource = Mage::getModel('adminhtml/system_config_source_yesno')->toOptionArray();
        $fieldset->addField('is_visible_on_checkout', 'select', array(
            'name'     => 'is_visible_on_checkout',
            'label'    => Mage::helper('lws_button')->__('Visible on Checkout Review on Front-end'),
            'title'    => Mage::helper('lws_button')->__('Visible on Checkout Review on Front-end'),
            'values'   => $yesnoSource,
        ));
    }
    
}