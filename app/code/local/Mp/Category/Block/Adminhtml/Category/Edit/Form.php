<?php
class Mp_category_Block_Adminhtml_category_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('category_form');
        $this->setTitle(Mage::helper('category')->__('category Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_category');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );


        $form->setHtmlIdPrefix('category_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('category')->__('category Information'), 'class' => 'fieldset-wide'));

        if ($model->getcategoryId()) {
            $fieldset->addField('category_id', 'hidden', array(
                'name' => 'category_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('category')->__('Name'),
            'title'     => Mage::helper('category')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => Mage::helper('category')->__('Status'),
            'title'     => Mage::helper('category')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('category')->__('Active'),
                '2' => Mage::helper('category')->__('Inactive'),
            ),
        ));

        $fieldset->addField('description', 'text', array(
            'name'      => 'description',
            'label'     => Mage::helper('category')->__('Description'),
            'title'     => Mage::helper('category')->__('Description'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}