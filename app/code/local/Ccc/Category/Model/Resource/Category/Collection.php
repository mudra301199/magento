<?php
class Ccc_category_Model_Resource_category_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
	{
		parent::_construct();
		$this->_init('category/category');
	}
}