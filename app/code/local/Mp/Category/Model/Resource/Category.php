<?php
class Mp_category_Model_Resource_category extends Mage_Core_Model_Resource_Db_Abstract
{
	protected function _construct()
	{
		$this->_init('category/category', 'category_id');
	}
}