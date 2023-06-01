<?php
class Ccc_User_Block_Adminhtml_User_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_user_address');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('address_form', array('legend'=>Mage::helper('user')->__('User Address Information'), 'class' => 'fieldset-wide'));

        $fieldset->addField('address', 'text', array(
            'name'      => 'address[address]',
            'label'     => Mage::helper('user')->__('Address'),
            'title'     => Mage::helper('user')->__('Address'),
            'required'  => true,
        ));

        $fieldset->addField('city', 'text', array(
            'name'      => 'address[city]',
            'label'     => Mage::helper('user')->__('City'),
            'title'     => Mage::helper('user')->__('City'),
            'required'  => true,
        ));

        $fieldset->addField('state', 'text', array(
            'name'      => 'address[state]',
            'label'     => Mage::helper('user')->__('State'),
            'title'     => Mage::helper('user')->__('State'),
            'required'  => true,
        ));

        $fieldset->addField('country', 'text', array(
            'name'      => 'address[country]',
            'label'     => Mage::helper('user')->__('Country'),
            'title'     => Mage::helper('user')->__('Country'),
            'required'  => true,
        ));

        $fieldset->addField('zipcode', 'text', array(
            'name'      => 'address[zipcode]',
            'label'     => Mage::helper('user')->__('Zip Code'),
            'title'     => Mage::helper('user')->__('Zip Code'),
            'required'  => true,
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}