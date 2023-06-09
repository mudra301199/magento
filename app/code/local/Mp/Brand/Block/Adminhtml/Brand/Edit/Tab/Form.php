<?php
class Mp_Brand_Block_Adminhtml_Brand_Edit_Tab_Form extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form();
        $this->setForm($form);
        $fieldset = $form->addFieldset('brand_form',array('legend'=>Mage::helper('brand')->__('brand Information')));

        $fieldset->addField('url_key', 'text', array(
            'label' => Mage::helper('brand')->__('URL Key'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'brand[url_key]',
        ));

        $fieldset->addField('name', 'text', array(
            'label' => Mage::helper('brand')->__('Name'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'brand[name]',
        ));

        $fieldset->addField('image', 'file', array(
            'label' => Mage::helper('brand')->__('Brand Image'),
            'name' => 'image',
        ));

        $fieldset->addField('banner', 'file', array(
            'label' => Mage::helper('brand')->__('Brand Banner'),
            'name' => 'banner',
        ));

        $fieldset->addField('description', 'textarea', array(
            'label' => Mage::helper('brand')->__('Description'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'brand[description]',
        ));

        $fieldset->addField('sort_order', 'text', array(
            'label' => Mage::helper('brand')->__('Sort Order'),
            'class' => 'required-entry',
            'required' => true,
            'name' => 'brand[sort_order]',
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