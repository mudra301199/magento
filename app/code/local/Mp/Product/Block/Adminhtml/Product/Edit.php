<?php
class Mp_Product_Block_Adminhtml_Product_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'product_id';
        $this->_blockGroup = 'product';
        $this->_controller = 'adminhtml_product';
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('product')->__('Save Product'));
        $this->_updateButton('delete', 'label', Mage::helper('product')->__('Delete Product'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
    }
}