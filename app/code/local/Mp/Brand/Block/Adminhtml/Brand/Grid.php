<?php
class Mp_Brand_Block_Adminhtml_Brand_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('brandGrid');
        $this->setDefaultSort('brand_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('brand_id');
        $this->getMassactionBlock()->setFormFieldName('brand_id');
         
        $this->getMassactionBlock()->addItem('delete', array(
        'label'=> Mage::helper('brand')->__('Delete'),
        'url'  => $this->getUrl('*/*/massDelete', array('' => '')),
        'confirm' => Mage::helper('brand')->__('Are you sure?')
        ));
         
        return $this;
    }

   protected function _prepareCollection()
    {
        // echo "<pre>";
        // print_r(Mage::getModel('brand/brand')->getCollection());die;
        $collection = Mage::getModel('brand/brand')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('brand_id', array(
            'header'    => Mage::helper('brand')->__('Brand Id'),
            'align'     => 'left',
            'index'     => 'brand_id',
        ));

        $this->addColumn('name', array(
            'header'    => Mage::helper('brand')->__('Brand Name'),
            'align'     => 'left',
            'index'     => 'name'
        )); 
        $this->addColumn('image', array(
            'header'    => Mage::helper('brand')->__('Brand Image'),
            'align'     => 'left',
            'index'     => 'image',
            'renderer'=>'Mp_Brand_Block_Adminhtml_Brand_Grid_Renderer_Grid'
        ));

        $this->addColumn('description', array(
            'header'    => Mage::helper('brand')->__('Description'),
            'align'     => 'left',
            'index'     => 'description'
        ));
        $this->addColumn('created_at', array(
            'header'    => Mage::helper('brand')->__('Created_at'),
            'align'     => 'left',
            'index'     => 'created_at'
        ));
        $this->addColumn('updated_at', array(
            'header'    => Mage::helper('brand')->__('updated_at'),
            'align'     => 'left',
            'index'     => 'updated_at'
        ));

        return parent::_prepareColumns();
    }
    
    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('brand_id' => $row->getId()));
    }
   
}