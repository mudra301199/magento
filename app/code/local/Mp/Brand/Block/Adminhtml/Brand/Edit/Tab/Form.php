<?php
class Mp_Brand_Block_Adminhtml_Brand_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('brand_form',array('legend'=>Mage::helper('brand')->__('brand Information')));
        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('brand')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'brand[name]',
        ));

        $fieldset->addField('image', 'file', array(
            'label' => Mage::helper('brand')->__('Image'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'image',
        ));

        $fieldset->addField('description', 'textarea', array(
            'label' => Mage::helper('brand')->__('Description'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'brand[description]',
        ));

        if ( Mage::getSingleton('adminhtml/session')->getbrandData() )
        {
            $form->setValues(Mage::getSingleton('adminhtml/session')->getbrandData());
            Mage::getSingleton('adminhtml/session')->setbrandData(null);
        } elseif ( Mage::registry('brand_data') ) {
            $form->setValues(Mage::registry('brand_data')->getData());
        }

        return parent::_prepareForm();
    }
}