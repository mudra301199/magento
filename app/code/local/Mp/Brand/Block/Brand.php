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
}