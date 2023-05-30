<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('vendor_form');
        $this->setTitle(Mage::helper('vendor')->__('Vendor Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_vendor');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );


        $form->setHtmlIdPrefix('vendor_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('vendor')->__('Vendor Information'), 'class' => 'fieldset-wide'));

        if ($model->getVendorId()) {
            $fieldset->addField('vendor_id', 'hidden', array(
                'name' => 'vendor_id',
            ));
        }

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'first_name',
            'label'     => Mage::helper('vendor')->__('First Name'),
            'title'     => Mage::helper('vendor')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'last_name',
            'label'     => Mage::helper('vendor')->__('Last Name'),
            'title'     => Mage::helper('vendor')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('vendor')->__('Email'),
            'title'     => Mage::helper('vendor')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'name'      => 'gender',
            'label'     => Mage::helper('vendor')->__('Gender'),
            'title'     => Mage::helper('vendor')->__('Gender'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('vendor')->__('Male'),
                '2' => Mage::helper('vendor')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'mobile',
            'label'     => Mage::helper('vendor')->__('Mobile No'),
            'title'     => Mage::helper('vendor')->__('Mobile No'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => Mage::helper('vendor')->__('Status'),
            'title'     => Mage::helper('vendor')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('vendor')->__('Active'),
                '2' => Mage::helper('vendor')->__('Inactive'),
            ),
        ));

        $fieldset->addField('company', 'text', array(
            'name'      => 'company',
            'label'     => Mage::helper('vendor')->__('Company'),
            'title'     => Mage::helper('vendor')->__('Company'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}