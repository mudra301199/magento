<?php
class Mp_Brand_Block_Brand extends Mage_Core_Block_Template
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getBrands()
	{
		return Mage::getModel('brand/brand')->getCollection()->addOrder('sort_order','ASC');
	}
	public function getBrand()
    {
        $id = $this->getRequest()->getParam('id');
        return Mage::getModel('brand/brand')->getCollection()->addFieldToFilter('brand_id', $id);
    }

    public function getProducts()
    {
        $brandAttributeCode = 'brand'; // Replace with your brand attribute code
        $brandAttribute = Mage::getSingleton('eav/config')->getAttribute('catalog_product', $brandAttributeCode);

        $brandValue = $this->getRequest()->getParam('id'); // Replace with your desired brand attribute value (integer)
        $productCollection = Mage::getModel('catalog/product')->getCollection()
            ->addAttributeToFilter($brandAttributeCode, $brandValue)
            ->getAllIds();
        $categoryId = $this->getRequest()->getParam('category');
        
        $products = Mage::getModel('catalog/product')->getCollection()
            ->addIdFilter($productCollection)
            ->addCategoryFilter(Mage::getModel('catalog/category')->load($categoryId))
            ->addAttributeToSelect('*');
        return $products;
    }

    public function getProductUrl($product)
    {
        
    $rewriteCollection = Mage::getModel('core/url_rewrite')->getCollection()
    ->addFieldToFilter('product_id', array('in' => $productIds))
    ->addFieldToFilter('is_system', 1);
    }

    public function getCategory()
    {
        $categories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('name')
            ->addIsActiveFilter();

        return $categories;
    }
}