<?php
class Mp_Practise_AbstractController extends Mage_Core_Controller_Front_Action
{
    
    protected function indexAction()
    {
        echo "<pre>";
        $template = Mage::getBlock('Block_Template');
        $template = new Mage_Adminhtml_Block_Template();
        $r=$template->getFormKey();
        print_r($r); 

        $r=$template->getModuleName();
        $r=$template->maliciousCodeFilter('dsadsd');
        print_r($r);

        $textList = new Mage_Core_Block_Text_List();
        print_r(get_class_methods($textList));
        print_r($textList->getSortedChildren());

        $abstract = new Mage_Core_Block_Abstract();
         print_r(get_class($abstract));  

    }
}
?>  