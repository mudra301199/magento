<?php
class Mp_Vendor_Model_Vendor extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		$this->_init('vendor/vendor');
	}
}