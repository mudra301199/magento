<?php
class Mp_Practice_Block_Adminhtml_Method extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'practice';
        $this->_controller = 'adminhtml_method';
        $this->_headerText = Mage::helper('practice')->__('Method Task');
        parent::__construct();
    }

    public function _prepareLayout()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();

        // $output = $collection->getSelectCountSql();
        // getSelectCountSql():Retrieves the SQL query to count the items in the collection.

        // $output = $collection->getIterator();
        // getIterator():Retrieves an iterator for the collection.

        // $output = $collection->getSize();    
        // getSize():Returns the number of items in the collection.similar to count()

        // $output = $collection->groupByAttribute('entity_id')->getData();
        // groupByAttribute():Groups the collection by a specific attribute.

        // $output = $collection->addCategoryFilter()->getData();
        // addCategoryFilter():Adds a category filter to the collection.

        // $output = $collection->getLastItem()->getData();
        // getLastItem():Retrieves the last item in the collection.

        // $output = $collection->getFirstItem()->getData();
        // getFirstItem():Retrieves the first item in the collection.

        // $output = $collection->getSelect();
        // getSelect(): Returns the underlying SQL query for the collection(Varien_Db_Select Object)

        // $output = $collection->count();
        // count():Returns the number of items in the collection.

        // $output = $collection->load()->getData();
        // load():Loads the collection from the database.

        // $output = $collection->addOrder('created_at', 'DESC')->getData();
        // setOrder():This method is used to set the sort order for the collection. It accepts the field name and the direction ('ASC' for ascending, 'DESC' for descending) as parameters.

        // $output = $collection->addStoreFilter()->getData();
        // addStoreFilter():This method is used to filter the collection by store. It accepts the store ID or store code as a parameter.

        // $output = $collection->getFirstItem()->getData();
        // getFirstItem():Returns the first item from the collection. Useful when you only need a single result.

        // $output = $collection->setPageSize(2)->setCurPage(2)->getData(); 
        // setCurPage():Sets the current page number for the collection. Used in conjunction with setPageSize() to navigate through paginated results.

        // $output = $collection->setPageSize(2)->getData(); 
        // setPageSize():Sets the number of items to retrieve per page. Useful for implementing pagination.

        // $output = $collection->addOrder('created_at', 'DESC')->getData(); 
        // addOrder():Specifies the field and sort direction to apply when retrieving the collection.

        // $output = $collection->addAttributeToSelect('entity_id')->getData(); 
        // addAttributeToSelect():Specifies which attributes to include in the result set.

        // $output = $collection->addAttributeToFilter('type_id', 'simple')->getData();  
        // addAttributeToFilter:Adds an attribute filter to the collection.

        // $output = $collection->addFieldToFilter('sku', 112)->getData(); 
        // addFieldToFilter():Adds a filter condition to the collection.

        // $output = $collection->getData(); 
        // getData():To get data in form of array.

        echo "<pre>"; print_r($output); die();
    }

}