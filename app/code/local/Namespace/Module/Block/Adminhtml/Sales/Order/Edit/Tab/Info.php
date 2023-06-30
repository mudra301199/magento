<?php
class Namespace_Module_Block_Adminhtml_Sales_Order_Edit_Tab_Info extends Mage_Adminhtml_Block_Sales_Order_Edit_Tab_Info
{
    protected function _prepareForm()
    {
        parent::_prepareForm();
        
        $form = $this->getForm();
        $fieldset = $form->getElement('base_fieldset');
        
        // Add your custom field
        $fieldset->addField('custom_field', 'text', array(
            'name'  => 'custom_field',
            'label' => Mage::helper('module')->__('Custom Field'),
        ));
        
        return $this;
    }
}
