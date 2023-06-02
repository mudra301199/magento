<?php
class Mp_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Vendor extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_vendor');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('vendor_form', array('legend'=>Mage::helper('vendor')->__('Vendor Information')));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'vendor[first_name]',
            'label'     => Mage::helper('vendor')->__('First Name'),
            'title'     => Mage::helper('vendor')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'vendor[last_name]',
            'label'     => Mage::helper('vendor')->__('Last Name'),
            'title'     => Mage::helper('vendor')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'vendor[email]',
            'label'     => Mage::helper('vendor')->__('Email'),
            'title'     => Mage::helper('vendor')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'name'      => 'vendor[gender]',
            'label'     => Mage::helper('vendor')->__('Gender'),
            'title'     => Mage::helper('vendor')->__('Gender'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('vendor')->__('Male'),
                '2' => Mage::helper('vendor')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'vendor[mobile]',
            'label'     => Mage::helper('vendor')->__('Mobile No'),
            'title'     => Mage::helper('vendor')->__('Mobile No'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'vendor[status]',
            'label'     => Mage::helper('vendor')->__('Status'),
            'title'     => Mage::helper('vendor')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('vendor')->__('Active'),
                '2' => Mage::helper('vendor')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'vendor[company]',
            'label'     => Mage::helper('vendor')->__('Company'),
            'title'     => Mage::helper('vendor')->__('Company'),
            'required'  => true,
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}