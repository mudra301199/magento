<?php
class Ccc_User_Model_Resource_User extends Mage_Core_Model_Resource_Db_Abstract
{
	protected function _construct()
	{
		$this->_init('user/user', 'user_id');
	}
}