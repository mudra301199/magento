<?php
class Ccc_category_Block_Adminhtml_category_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'category_id';
        $this->_blockGroup = 'category';
        $this->_controller = 'adminhtml_category';
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('category')->__('Save category'));
        $this->_updateButton('delete', 'label', Mage::helper('category')->__('Delete category'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
    }
}