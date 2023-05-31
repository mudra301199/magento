<?php
class Ccc_User_Block_Adminhtml_User_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('userGrid');
        $this->setDefaultSort('user_id');
        $this->setDefaultDir('DESC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('user/user')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('user_id', array(
            'header'    => Mage::helper('user')->__('User Id'),
            'align'     => 'left',
            'index'     => 'user_id',
        ));

        $this->addColumn('first_name', array(
            'header'    => Mage::helper('user')->__('First Name'),
            'align'     => 'left',
            'index'     => 'first_name'
        ));

        $this->addColumn('last_name', array(
            'header'    => Mage::helper('user')->__('Last Name'),
            'align'     => 'left',
            'index'     => 'last_name',
        ));

        $this->addColumn('email', array(
            'header'    => Mage::helper('user')->__('Email'),
            'align'     => 'left',
            'index'     => 'email'
        ));

        $this->addColumn('gender', array(
            'header'    => Mage::helper('user')->__('Gender'),
            'align'     => 'left',
            'index'     => 'gender',
        ));

        $this->addColumn('mobile', array(
            'header'    => Mage::helper('user')->__('Mobile'),
            'align'     => 'left',
            'index'     => 'mobile'
        ));

        $this->addColumn('status', array(
            'header'    => Mage::helper('user')->__('Status'),
            'align'     => 'left',
            'index'     => 'status',
        ));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('user_id');
        $this->getMassactionBlock()->setFormFieldName('user_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('user')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('user')->__('Are you sure?')
        ));
         
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('user_id' => $row->getId()));
    }  
}