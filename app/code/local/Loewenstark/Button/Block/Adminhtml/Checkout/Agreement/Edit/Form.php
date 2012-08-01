<?php

class Loewenstark_Button_Block_Adminhtml_Checkout_Agreement_Edit_Form
extends Mage_Adminhtml_Block_Checkout_Agreement_Edit_Form {
    protected function _prepareForm()
    {
        parent::_prepareForm();
        $form = $this->getForm();        
        
        $fieldset = $form->getElement('base_fieldset');
        $fieldset->addField('is_required', 'select', array(
            'label'     => Mage::helper('lws_button')->__('Required'),
            'title'     => Mage::helper('lws_button')->__('Required'),
            'note'      => Mage::helper('lws_button')->__('Display Checkbox on Frontend'),
            'name'      => 'is_required',
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('lws_button')->__('Yes'),
                '0' => Mage::helper('lws_button')->__('No'),
            ),
        ));
        
        $model  = Mage::registry('checkout_agreement');
        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);
        
        return $this;
    }
}