<?php 

class Cybercom_Qualitycheck_Helper_Data extends Mage_Core_Helper_Abstract
{	
	public function getRelatedModelOptions()
    {
        $options = array();
        $collection = Mage::getModel('qualitycheck/question')->getCollection();

        foreach ($collection as $question) 
        {
            $options[] = array(
                'value' => $question->getId(),
                'label' => $question->getQuestion(),
            );
        }

        return $options;
    }   
}