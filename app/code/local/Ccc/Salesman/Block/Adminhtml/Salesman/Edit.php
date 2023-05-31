<?php
class Ccc_Salesman_Block_Adminhtml_Salesman_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'salesman_id';
        $this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_salesman';
        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('salesman')->__('Save Salesman'));
        $this->_updateButton('delete', 'label', Mage::helper('salesman')->__('Delete Salesman'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);
    }
}