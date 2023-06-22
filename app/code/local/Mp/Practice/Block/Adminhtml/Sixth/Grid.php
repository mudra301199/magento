<?php
class Mp_Practice_Block_Adminhtml_Sixth_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
   public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('name');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel('customer/customer_collection')
            ->addAttributeToSelect('*');

        // echo "<pre>"; print_r($collection); die();

        $collection->getSelect()
            ->joinLeft(
                array('orders' => $collection->getTable('sales/order')),
                'e.entity_id = orders.customer_id',
                array('order_count' => 'COUNT(orders.entity_id)')
            )
            ->group('e.entity_id')
            ->order('order_count DESC');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('product')->__('Customer Id'),
            'align'     => 'left',
            'index'     => 'entity_id'
        ));

        $this->addColumn('firstname', array(
            'header'    => Mage::helper('product')->__('Customer Name'),
            'align'     => 'left',
            'index'     => 'firstname'
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('product')->__('Customer Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('order_count', array(
            'header'    => Mage::helper('product')->__('Order Count'),
            'align'     => 'left',
            'index'     => 'order_count'
        ));

        return parent::_prepareColumns();
    }
}