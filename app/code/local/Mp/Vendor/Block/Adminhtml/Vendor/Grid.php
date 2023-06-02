<?php
class Mp_Vendor_Block_Adminhtml_Vendor_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('vendorGrid');
        $this->setDefaultSort('vendor_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('vendor/vendor')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()  
    {
        $this->addColumn('vendor_id', array(
            'header'    => Mage::helper('vendor')->__('Vendor Id'),
            'align'     => 'left',
            'index'     => 'vendor_id',
        ));

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('vendor')->__('First Name'),
            'align'     => 'left',
            'index'     => 'first_name'
        ));

        $this->addColumn('last_name', array(
            'header'    => Mage::helper('vendor')->__('Last Name'),
            'align'     => 'left',
            'index'     => 'last_name',
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('vendor')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('gender', array(
            'header'    => Mage::helper('vendor')->__('Gender'),
            'align'     => 'left',
            'index'     => 'gender',
        ));

        $this->addColumn('mobile', array(
            'header'    => Mage::helper('vendor')->__('Mobile'),
            'align'     => 'left',
            'index'     => 'mobile'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('vendor')->__('Status'),
            'align'     => 'left',
            'index'     => 'status',
        ));

        $this->addColumn('company', array(
            'header'    => Mage::helper('vendor')->__('Company'),
            'align'     => 'left',
            'index'     => 'company'
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('vendor_id');
        $this->getMassactionBlock()->setFormFieldName('vendor_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('vendor')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('vendor')->__('Are you sure?')
        ));
         
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('vendor_id' => $row->getId()));
    }  
}