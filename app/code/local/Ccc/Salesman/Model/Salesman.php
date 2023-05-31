<?php
class Ccc_Salesman_Model_Salesman extends Mage_Core_Model_Abstract
{
	public function _construct()
	{
		parent::_construct();
		$this->_init('salesman/salesman');
	}
}