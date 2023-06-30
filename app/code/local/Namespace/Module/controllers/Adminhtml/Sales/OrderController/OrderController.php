<?php
require_once 'Mage/Adminhtml/controllers/Sales/OrderController.php';

class Namespace_Module_Adminhtml_Sales_OrderController extends Mage_Adminhtml_Sales_OrderController
{
    public function editAction()
    {
        $this->_initOrder();
        
        // Set the custom block
        $this->getLayout()->getBlock('sales_order_edit')->setChild(
            'form',
            $this->getLayout()->createBlock('module/adminhtml_sales_order_edit_tab_info')
        );
        
        $this->loadLayout()
             ->_addContent($this->getLayout()->createBlock('adminhtml/sales_order_edit'))
             ->_addLeft($this->getLayout()->createBlock('adminhtml/sales_order_edit_tabs'))
             ->renderLayout();
    }
}
