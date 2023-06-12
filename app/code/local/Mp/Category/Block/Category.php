<?php
class Mp_category_Block_category extends Mage_Core_Block_Template
{
	
	public function getCategories()
    {
         $categories = Mage::getModel('catalog/category')
            ->getCollection()
            ->addAttributeToSelect('image')
            ->addAttributeToSelect('name')
            ->addAttributeToSelect('is_active')
            ->addFieldToFilter('is_active', 1)
            ->addIsActiveFilter();
        return $categories;
    }

    public function getCategoryUrl($category)
    {
        $categoryId = $category->entity_id; 
        $storeId = Mage::app()->getStore()->getId();
        $categoryUrl = Mage::getModel('core/url_rewrite')
            ->getResource()
            ->getRequestPathByIdPath('category/' . $categoryId, $storeId);

        return $categoryUrl;
    }
}
?>