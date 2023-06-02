<?php
class Ccc_category_Model_category extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		parent::_construct();
		$this->_init('category/category');
	}
}