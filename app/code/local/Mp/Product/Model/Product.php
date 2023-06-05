<?php
class Mp_Product_Model_Product extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		parent::_construct();
		$this->_init('product/product');
	}
}