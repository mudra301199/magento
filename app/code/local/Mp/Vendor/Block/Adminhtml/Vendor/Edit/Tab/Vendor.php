<?php
class Mp_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Vendor extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_vendor');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('vendor_form', array('legend'=>Mage::helper('vendor')->__('Vendor Information')));

        $fieldset->addField('name', 'text', array(
            'name'      => 'vendor[name]',
            'label'     => Mage::helper('vendor')->__('Name'),
            'title'     => Mage::helper('vendor')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'vendor[email]',
            'label'     => Mage::helper('vendor')->__('Email'),
            'title'     => Mage::helper('vendor')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('password', 'text', array(
            'name'      => 'vendor[password]',
            'label'     => Mage::helper('vendor')->__('Password'),
            'title'     => Mage::helper('vendor')->__('Password'),
            'required'  => true,
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
        
        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}