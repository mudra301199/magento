<?php
class Cybercom_Qualitycheck_Block_Adminhtml_Question_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'question_id';
        $this->_blockGroup = 'qualitycheck';
        $this->_controller = 'adminhtml_question';
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('qualitycheck')->__('Save Question'));
        $this->_updateButton('delete', 'label', Mage::helper('qualitycheck')->__('Delete Question'));

    }
}
?>