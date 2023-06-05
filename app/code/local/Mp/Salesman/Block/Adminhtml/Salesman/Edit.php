<?php
class Mp_Salesman_Block_Adminhtml_Salesman_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'salesman_id';
        $this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_salesman';
        $this->_headerText = Mage::helper('salesman')->__('Edit Container');
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('salesman')->__('Save Salesman'));
        $this->_updateButton('delete', 'label', Mage::helper('salesman')->__('Delete Salesman'));

    }

    // public function getHeaderText()
    // {
    //     if (Mage::registry('adminhtml_salesman')->getId()) {
    //         return Mage::helper('salesman')->__("Edit Salesman '%s'", $this->escapeHtml(Mage::registry('adminhtml_salesman')->getTitle()));
    //     } else {
    //         return Mage::helper('salesman')->__('New Salesman');
    //     }
    // }
}