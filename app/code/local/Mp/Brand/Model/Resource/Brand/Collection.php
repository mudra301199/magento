<?php
class Mp_Brand_Model_Resource_Brand_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
	protected function _construct()
	{
		parent::_construct();
		$this->_init('brand/brand');
	}
}