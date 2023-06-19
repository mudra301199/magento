<?php
class Mp_Practice_Block_Adminhtml_Fourth_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
                        ->addAttributeToSelect('entity_id')
                        ->addAttributeToSelect('sku')
                        ->addAttributeToSelect('image')
                        ->addAttributeToSelect('small_image')
                        ->addAttributeToSelect('thumbnail');
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('entity_id', array(
            'header'    => Mage::helper('product')->__('Product Id'),
            'align'     => 'center',
            'index'     => 'entity_id'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('product')->__('SKU'),
            'align'     => 'center',
            'index'     => 'sku'
        ));

        $this->addColumn('image', array(
            'header'    => Mage::helper('product')->__('Base Image'),
            'align'     => 'center',
            'index'     => 'image',
            'renderer' => 'Mp_Practice_Block_Adminhtml_Fourth_Renderer'
        ));

        $this->addColumn('thumbnail', array(
            'header'    => Mage::helper('product')->__('Thumb Image'),
            'align'     => 'center',
            'index'     => 'thumbnail',
            'renderer' => 'Mp_Practice_Block_Adminhtml_Fourth_Renderer'
        ));

        $this->addColumn('small_image', array(
            'header'    => Mage::helper('product')->__('Small Image'),
            'align'     => 'center',
            'index'     => 'small_image',
            'renderer' => 'Mp_Practice_Block_Adminhtml_Fourth_Renderer'
        ));

        return parent::_prepareColumns();
    }
}