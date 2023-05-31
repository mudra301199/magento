<?php
class Ccc_User_Block_Adminhtml_User_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('user_form');
        $this->setTitle(Mage::helper('user')->__('User Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_user');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );


        $form->setHtmlIdPrefix('user_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('user')->__('User Information'), 'class' => 'fieldset-wide'));

        if ($model->getUserId()) {
            $fieldset->addField('user_id', 'hidden', array(
                'name' => 'user_id',
            ));
        }

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'first_name',
            'label'     => Mage::helper('user')->__('First Name'),
            'title'     => Mage::helper('user')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'last_name',
            'label'     => Mage::helper('user')->__('Last Name'),
            'title'     => Mage::helper('user')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'email',
            'label'     => Mage::helper('user')->__('Email'),
            'title'     => Mage::helper('user')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'name'      => 'gender',
            'label'     => Mage::helper('user')->__('Gender'),
            'title'     => Mage::helper('user')->__('Gender'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('user')->__('Male'),
                '2' => Mage::helper('user')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'mobile',
            'label'     => Mage::helper('user')->__('Mobile No'),
            'title'     => Mage::helper('user')->__('Mobile No'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => Mage::helper('user')->__('Status'),
            'title'     => Mage::helper('user')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('user')->__('Active'),
                '2' => Mage::helper('user')->__('Inactive'),
            ),
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}