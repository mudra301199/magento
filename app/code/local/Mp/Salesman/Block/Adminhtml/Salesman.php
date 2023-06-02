<?php
class Mp_Salesman_Block_Adminhtml_Salesman extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'salesman';
        $this->_controller = 'adminhtml_salesman';
        $this->_headerText = Mage::helper('salesman')->__('Manage Salesmans');

        parent::__construct();

        if ($this->_isAllowedAction('save')) {
            $this->_updateButton('add', 'label', Mage::helper('salesman')->__('Add New Salesman'));
        } else {
            $this->_removeButton('add');
        }
    }

    protected function _isAllowedAction($action)
    {
        return Mage::getSingleton('admin/session')->isAllowed('salesman/adminhtml_salesman/' . $action);
    }
}