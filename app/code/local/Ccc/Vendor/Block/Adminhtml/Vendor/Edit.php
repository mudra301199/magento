<?php
class Ccc_Vendor_Block_Adminhtml_Vendor_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
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

    // public function getHeaderText()
    // {
    //     if (Mage::registry('adminhtml_vendor')->getId()) {
    //         return Mage::helper('vendor')->__("Edit Vendor '%s'", $this->escapeHtml(Mage::registry('adminhtml_vendor')->getTitle()));
    //     } else {
    //         return Mage::helper('vendor')->__('New Vendor');
    //     }
    // }
}