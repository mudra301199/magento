<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('salesman_form');
        $this->setTitle(Mage::helper('salesman')->__('Salesman Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_salesman');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );


        $form->setHtmlIdPrefix('salesman_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('salesman')->__('Salesman Information'), 'class' => 'fieldset-wide'));

        if ($model->getSalesmanId()) {
            $fieldset->addField('salesman_id', 'hidden', array(
                'name' => 'salesman_id',
            ));
        }

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'first_name',
            'label'     => Mage::helper('salesman')->__('First Name'),
            'title'     => Mage::helper('salesman')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'last_name',
            'label'     => Mage::helper('salesman')->__('Last Name'),
            'title'     => Mage::helper('salesman')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('salesman')->__('Email'),
            'title'     => Mage::helper('salesman')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'name'      => 'gender',
            'label'     => Mage::helper('salesman')->__('Gender'),
            'title'     => Mage::helper('salesman')->__('Gender'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('salesman')->__('Male'),
                '2' => Mage::helper('salesman')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'mobile',
            'label'     => Mage::helper('salesman')->__('Mobile No'),
            'title'     => Mage::helper('salesman')->__('Mobile No'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => Mage::helper('salesman')->__('Status'),
            'title'     => Mage::helper('salesman')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('salesman')->__('Active'),
                '2' => Mage::helper('salesman')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'company',
            'label'     => Mage::helper('salesman')->__('Company'),
            'title'     => Mage::helper('salesman')->__('Company'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}