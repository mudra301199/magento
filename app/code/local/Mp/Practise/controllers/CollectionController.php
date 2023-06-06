<?php
class Mp_Practise_CollectionController extends Mage_Core_Model_Message_Abstract
{
    
    protected function indexAction()
    {
        echo "<pre>";
        echo 111;
        $messageCollection = new Mage_Core_Model_Message_Collection();
        // print_r($messageCollection); 
        // print_r(get_class_methods($messageCollection));
        // print_r($messageCollection->add('successfull'));
        // print_r($messageCollection->addMessage('working'));
    }
}
?>