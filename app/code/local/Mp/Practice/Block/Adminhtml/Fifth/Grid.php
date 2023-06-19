<?php
class Mp_Practice_Block_Adminhtml_Fifth_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('attribute_id');
        $this->setDefaultDir('ASC');
    }

   protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('*');

        $collection->getSelect()->joinLeft(
            array('mg' => $collection->getTable('catalog/product_attribute_media_gallery')),
            'mg.entity_id = e.entity_id',
            array('media_count' => 'COUNT(mg.value_id)')
        );

        $collection->getSelect()->group('e.entity_id');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('sku', array(
            'header'    => Mage::helper('product')->__('SKU'),
            'align'     => 'center',
            'index'     => 'sku'
        ));

        $this->addColumn('media_count', array(
            'header'    => Mage::helper('product')->__('Image Count'),
            'align'     => 'center',
            'index'     => 'media_count'
        ));

        return parent::_prepareColumns();
    }
}