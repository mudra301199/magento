<?php
class Mp_Practice_Block_Adminhtml_Ninth_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $collection = Mage::getResourceModel('catalog/product_collection')
            ->addAttributeToSelect('sku');
        

        $attributes = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('is_user_defined', 1)
            ->getItems();
        foreach ($attributes as $attribute) {
            $attributeCodes[] = $attribute->getAttributeCode();
        }

        $unassignedAttributes = array();
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToSelect('sku');
        foreach ($products as $product) {
            $productId = $product->getId();
            $sku = $product->getSku();

            foreach ($attributeCodes as $attributeCode) {
                $attribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $attributeCode);
                $attributeId = $attribute->getId();

                $resource = Mage::getResourceModel('catalog/product');
                $value = $resource->getAttributeRawValue($productId, $attributeCode, Mage::app()->getStore());

                if ($value === false || $value === null) {
                    $unassignedAttributes[] = array(
                        'product_id' => $productId,
                        'sku' => $sku,
                        'attribute_id' => $attributeId,
                        'attribute_code' => $attributeCode
                    );
                }
            }
        }
                // echo "<pre>"; print_r($unassignedAttributes); die();
        $collection = new Varien_Data_Collection();

        foreach ($unassignedAttributes as $data) {
            $row = new Varien_Object($data);
            $collection->addItem($row);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('product_id', array(
            'header'    => Mage::helper('product')->__('Product Id'),
            'align'     => 'center',
            'index'     => 'product_id'
        ));

        $this->addColumn('sku', array(
            'header'    => Mage::helper('product')->__('SKU'),
            'align'     => 'center',
            'index'     => 'sku'
        ));

        $this->addColumn('attribute_id', array(
            'header'    => Mage::helper('product')->__('Attribute Id'),
            'align'     => 'center',
            'index'     => 'attribute_id'
        ));

        $this->addColumn('attribute_code', array(
            'header'    => Mage::helper('product')->__('Attribute Code'),
            'align'     => 'center',
            'index'     => 'attribute_code'
        ));

        return parent::_prepareColumns();
    }
}