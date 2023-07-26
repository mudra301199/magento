<?php
class Cybercom_Qualitycheck_Block_Adminhtml_Answer_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'answer_id';
        $this->_blockGroup = 'qualitycheck';
        $this->_controller = 'adminhtml_answer';
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('qualitycheck')->__('Save Answer'));
        $this->_updateButton('delete', 'label', Mage::helper('qualitycheck')->__('Delete Answer'));

    }
}
?>