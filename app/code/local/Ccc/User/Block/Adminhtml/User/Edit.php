<?php
class Ccc_User_Block_Adminhtml_User_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'user_id';
        $this->_blockGroup = 'user';
        $this->_controller = 'adminhtml_user';
        $this->_headerText = Mage::helper('user')->__('Edit Container');
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('user')->__('Save User'));
        $this->_updateButton('delete', 'label', Mage::helper('user')->__('Delete User'));

    }

    // public function getHeaderText()
    // {
    //     if (Mage::registry('adminhtml_user')->getId()) {
    //         return Mage::helper('user')->__("Edit User '%s'", $this->escapeHtml(Mage::registry('adminhtml_user')->getTitle()));
    //     } else {
    //         return Mage::helper('user')->__('New User');
    //     }
    // }
}