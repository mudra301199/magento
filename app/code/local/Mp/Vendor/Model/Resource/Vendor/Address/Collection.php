<?php
class Mp_Vendor_Model_Resource_Vendor_Address_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
	{
		$this->_init('vendor/vendor_address');
	}
}