<?php
class Mp_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_vendor_address');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('address_form', array('legend'=>Mage::helper('vendor')->__('Vendor Address Information'), 'class' => 'fieldset-wide'));

        $fieldset->addField('address', 'text', array(
            'name'      => 'address[address]',
            'label'     => Mage::helper('vendor')->__('Address'),
            'title'     => Mage::helper('vendor')->__('Address'),
            'required'  => true,
        ));

        $fieldset->addField('city', 'text', array(
            'name'      => 'address[city]',
            'label'     => Mage::helper('vendor')->__('City'),
            'title'     => Mage::helper('vendor')->__('City'),
            'required'  => true,
        ));

        $fieldset->addField('state', 'text', array(
            'name'      => 'address[state]',
            'label'     => Mage::helper('vendor')->__('State'),
            'title'     => Mage::helper('vendor')->__('State'),
            'required'  => true,
        ));

        $fieldset->addField('country', 'text', array(
            'name'      => 'address[country]',
            'label'     => Mage::helper('vendor')->__('Country'),
            'title'     => Mage::helper('vendor')->__('Country'),
            'required'  => true,
        ));

        $fieldset->addField('zipcode', 'text', array(
            'name'      => 'address[zipcode]',
            'label'     => Mage::helper('vendor')->__('Zip Code'),
            'title'     => Mage::helper('vendor')->__('Zip Code'),
            'required'  => true,
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}