<?php
 
class Cybercom_Qualitycheck_Block_Adminhtml_Answer extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'qualitycheck';
        $this->_controller = 'adminhtml_answer';
        $this->_headerText = Mage::helper('qualitycheck')->__('Answers');
        parent::__construct();
    }
}
?>