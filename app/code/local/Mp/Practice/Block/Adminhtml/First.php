<?php
class Mp_Practice_Block_Adminhtml_First extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'practice';
        $this->_controller = 'adminhtml_first';
        $this->_headerText = Mage::helper('practice')->__('First Task');
        parent::__construct();
        $this->_removeButton('add');
    }

    public function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->addButton('show_query', array(
            'label'   => Mage::helper('product')->__('Show Query'),
            'onclick' => "setLocation('{$this->getUrl('practice/adminhtml_query/firstQuery')}')",
            'class'   => 'show_query',
        ));

        return $this;
    }

}