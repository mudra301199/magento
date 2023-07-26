<?php
 
class Cybercom_Qualitycheck_Block_Adminhtml_Question extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'qualitycheck';
        $this->_controller = 'adminhtml_question';
        $this->_headerText = Mage::helper('qualitycheck')->__('Questions');
        parent::__construct();
    }
}
?>