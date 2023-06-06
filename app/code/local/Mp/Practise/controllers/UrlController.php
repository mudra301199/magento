<?php
class Mp_Practise_UrlController extends Mage_Core_Controller_Front_Action
{
    
    protected function indexAction()
    {
        echo "<pre>";
        $url = new Mage_Core_Model_Url();
        print_r(get_class_methods($url));
        // print_r($url->getDefaultControllerName()); //to getting preser default  controller name in that const
        // print_r($url->getDefaultActionName());

        // $url->setActionName('hello');
        // print_r($url->getActionPath());
        // print_r($url->getRouteUrl());
        // print_r($url->checkCookieDomains());
        // print_r($url->flagDirty());
        // print_r($url->getControllerName());
        // print_r($url->getRouteParams());
        // print_r($url->dataHasChangedFor());
        // $url->setId('1');
        // print_r($url->getId());
        // print_r($url->getFragment());
        // print_r($url->getUrl());
        // print_r($url->getRebuiltUrl('practise/url'));
        
    }
}
?> 