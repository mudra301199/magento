<?php
class Mp_Salesman_Block_Adminhtml_Salesman_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('salesmanGrid');
        $this->setDefaultSort('salesman_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('salesman/salesman')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()  
    {
        $this->addColumn('salesman_id', array(
            'header'    => Mage::helper('salesman')->__('Salesman Id'),
            'align'     => 'left',
            'index'     => 'salesman_id',
        ));

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('salesman')->__('First Name'),
            'align'     => 'left',
            'index'     => 'first_name'
        ));

        $this->addColumn('last_name', array(
            'header'    => Mage::helper('salesman')->__('Last Name'),
            'align'     => 'left',
            'index'     => 'last_name',
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('salesman')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('gender', array(
            'header'    => Mage::helper('salesman')->__('Gender'),
            'align'     => 'left',
            'index'     => 'gender',
        ));

        $this->addColumn('mobile', array(
            'header'    => Mage::helper('salesman')->__('Mobile'),
            'align'     => 'left',
            'index'     => 'mobile'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('salesman')->__('Status'),
            'align'     => 'left',
            'index'     => 'status',
        ));

        $this->addColumn('company', array(
            'header'    => Mage::helper('salesman')->__('Company'),
            'align'     => 'left',
            'index'     => 'company'
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('salesman')->__('Create Date'),
            'align'     => 'left',
            'index'     => 'created_at'
        ));
        
        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('salesman')->__('Update Date'),
            'align'     => 'left',
            'index'     => 'updated_at'
        ));
        

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('salesman_id');
        $this->getMassactionBlock()->setFormFieldName('salesman_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('salesman')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('salesman')->__('Are you sure?')
        ));
         
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('salesman_id' => $row->getId()));
    }  
}