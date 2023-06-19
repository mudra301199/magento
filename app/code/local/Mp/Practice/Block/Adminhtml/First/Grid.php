<?php
class Mp_Practice_Block_Adminhtml_First_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $collection = Mage::getModel('catalog/product')->getCollection()
                        ->addAttributeToSelect('name')
                        ->addAttributeToSelect('sku')
                        ->addAttributeToSelect('cost')
                        ->addAttributeToSelect('price')
                        ->addAttributeToSelect('color');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('name', array(
            'header'    => Mage::helper('product')->__('Name'),
            'align'     => 'left',
            'index'     => 'name'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('product')->__('SKU'),
            'align'     => 'left',
            'index'     => 'sku'
        ));

        $this->addColumn('cost', array(
            'header'    => Mage::helper('product')->__('Cost'),
            'align'     => 'left',
            'index'     => 'cost'
        ));

        $this->addColumn('price', array(
            'header'    => Mage::helper('product')->__('Price'),
            'align'     => 'left',
            'index'     => 'price'
        ));

        $this->addColumn('color', array(
            'header'    => Mage::helper('product')->__('Color'),
            'align'     => 'left',
            'index'     => 'color'
        ));

        return parent::_prepareColumns();
    }
}