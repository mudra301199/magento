<?php
class Mp_Vendor_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'vendor_id';
        $this->_blockGroup = 'vendor';
        $this->_controller = 'adminhtml_vendor';
        $this->_headerText = Mage::helper('vendor')->__('Edit Container');
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('vendor')->__('Save Vendor'));
        $this->_updateButton('delete', 'label', Mage::helper('vendor')->__('Delete Vendor'));

    }
}