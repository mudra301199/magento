<?php

class Cybercom_Qualitycheck_Model_Resource_Answer extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {  
        $this->_init('qualitycheck/answer', 'answer_id');
    }  
}