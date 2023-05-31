<?php
class Ccc_category_Block_Adminhtml_category extends Mage_Adminhtml_Block_Widget_Grid_Container
{
	public function __construct()
    {
        $this->_blockGroup = 'category';
        $this->_controller = 'adminhtml_category';
        $this->_headerText = Mage::helper('category')->__('Manage categorys');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('category')->__('Add New category'));
        } else {
            $this->_removeButton('add');
        }

    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('category/adminhtml_category/' . $action);
    }   
}