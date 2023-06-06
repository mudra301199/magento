<?php
class Mp_Practise_ResourceController extends Mage_Core_Controller_Front_Action
{
    
    protected function indexAction()
    {
        echo "<pre>";
        $resource = new Mage_Core_Model_Resource();
        // print_r(get_class_methods($resource));
        // print_r($resource->getConnection('pratice'));
        // print_r($resource->getConnections());
        // print_r($resource->getConnectionTypeInstance('practice'));
        // print_r($resource->getEntity('practice','resource'));
        // print_r($resource)
        // print_r($resource->getTableName('resource'));
        // print_r($resource->createConnection('practice','resource','index'));
        // print_r($resource->getAutoUpdate());
        // print_r($resource->getIdxName());
        // print_r($resource->);       
        die();     
    }
}
?>