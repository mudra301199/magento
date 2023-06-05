<?php
class Mp_Product_Block_Adminhtml_Product_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('product_form');
        $this->setTitle(Mage::helper('product')->__('Product Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_product');

        $form = new Varien_Data_Form(
            array('id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post')
        );


        $form->setHtmlIdPrefix('product_');

        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('product')->__('Product Information'), 'class' => 'fieldset-wide'));

        if ($model->getProductId()) {
            $fieldset->addField('product_id', 'hidden', array(
                'name' => 'product_id',
            ));
        }

        $fieldset->addField('name', 'text', array(
            'name'      => 'name',
            'label'     => Mage::helper('product')->__('Name'),
            'title'     => Mage::helper('product')->__('Name'),
            'required'  => true,
        ));

        $fieldset->addField('sku', 'text', array(
            'name'      => 'sku',
            'label'     => Mage::helper('product')->__('SKU'),
            'title'     => Mage::helper('product')->__('SKU'),
            'required'  => true,
        ));

        $fieldset->addField('cost', 'text', array(
            'name'      => 'cost',
            'label'     => Mage::helper('product')->__('Cost'),
            'title'     => Mage::helper('product')->__('Cost'),
            'required'  => true,
        ));

        $fieldset->addField('price', 'text', array(
            'name'      => 'price',
            'label'     => Mage::helper('product')->__('Price'),
            'title'     => Mage::helper('product')->__('Price'),
            'required'  => true,
        ));

        $fieldset->addField('quantity', 'text', array(
            'name'      => 'quantity',
            'label'     => Mage::helper('product')->__('Quantity'),
            'title'     => Mage::helper('product')->__('Quantity'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'status',
            'label'     => Mage::helper('product')->__('Status'),
            'title'     => Mage::helper('product')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('product')->__('Active'),
                '2' => Mage::helper('product')->__('Inactive'),
            ),
        ));

        $fieldset->addField('color', 'select', array(
            'name'      => 'color',
            'label'     => Mage::helper('product')->__('Color'),
            'title'     => Mage::helper('product')->__('Color'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('product')->__('Red'),
                '2' => Mage::helper('product')->__('Green'),
                '3' => Mage::helper('product')->__('Blue')
            ),
        ));

        $fieldset->addField('material', 'select', array(
            'name'      => 'material',
            'label'     => Mage::helper('product')->__('Material'),
            'title'     => Mage::helper('product')->__('Material'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('product')->__('Iron'),
                '2' => Mage::helper('product')->__('Steel'),
                '3' => Mage::helper('product')->__('Wood'),
                '4' => Mage::helper('product')->__('Plastic'),
            ),
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}