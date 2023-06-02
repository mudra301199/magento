<?php
class Mp_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_salesman_address');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('address_form', array('legend'=>Mage::helper('salesman')->__('Salesman Address Information'), 'class' => 'fieldset-wide'));

        $fieldset->addField('address', 'text', array(
            'name'      => 'address[address]',
            'label'     => Mage::helper('salesman')->__('Address'),
            'title'     => Mage::helper('salesman')->__('Address'),
            'required'  => true,
        ));

        $fieldset->addField('city', 'text', array(
            'name'      => 'address[city]',
            'label'     => Mage::helper('salesman')->__('City'),
            'title'     => Mage::helper('salesman')->__('City'),
            'required'  => true,
        ));

        $fieldset->addField('state', 'text', array(
            'name'      => 'address[state]',
            'label'     => Mage::helper('salesman')->__('State'),
            'title'     => Mage::helper('salesman')->__('State'),
            'required'  => true,
        ));

        $fieldset->addField('country', 'text', array(
            'name'      => 'address[country]',
            'label'     => Mage::helper('salesman')->__('Country'),
            'title'     => Mage::helper('salesman')->__('Country'),
            'required'  => true,
        ));

        $fieldset->addField('zipcode', 'text', array(
            'name'      => 'address[zipcode]',
            'label'     => Mage::helper('salesman')->__('Zip Code'),
            'title'     => Mage::helper('salesman')->__('Zip Code'),
            'required'  => true,
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}