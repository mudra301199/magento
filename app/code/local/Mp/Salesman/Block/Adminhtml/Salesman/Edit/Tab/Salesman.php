<?php
class Mp_Salesman_Block_Adminhtml_Salesman_Edit_Tab_Salesman extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_salesman');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('salesman_form', array('legend'=>Mage::helper('salesman')->__('Salesman Information')));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'salesman[first_name]',
            'label'     => Mage::helper('salesman')->__('First Name'),
            'title'     => Mage::helper('salesman')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'salesman[last_name]',
            'label'     => Mage::helper('salesman')->__('Last Name'),
            'title'     => Mage::helper('salesman')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'salesman[email]',
            'label'     => Mage::helper('salesman')->__('Email'),
            'title'     => Mage::helper('salesman')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'name'      => 'salesman[gender]',
            'label'     => Mage::helper('salesman')->__('Gender'),
            'title'     => Mage::helper('salesman')->__('Gender'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('salesman')->__('Male'),
                '2' => Mage::helper('salesman')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'salesman[mobile]',
            'label'     => Mage::helper('salesman')->__('Mobile No'),
            'title'     => Mage::helper('salesman')->__('Mobile No'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'salesman[status]',
            'label'     => Mage::helper('salesman')->__('Status'),
            'title'     => Mage::helper('salesman')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('salesman')->__('Active'),
                '2' => Mage::helper('salesman')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'salesman[company]',
            'label'     => Mage::helper('salesman')->__('Company'),
            'title'     => Mage::helper('salesman')->__('Company'),
            'required'  => true,
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}