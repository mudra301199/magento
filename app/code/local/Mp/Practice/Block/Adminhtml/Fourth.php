<?php
class Mp_Practice_Block_Adminhtml_Fourth extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'practice';
        $this->_controller = 'adminhtml_fourth';
        $this->_headerText = Mage::helper('practice')->__('Fourth Task');
        parent::__construct();
        $this->_removeButton('add');
    }

    public function _prepareLayout()
    {
        parent::_prepareLayout();

        $this->addButton('show_query', array(
            'label'   => Mage::helper('product')->__('Show Query'),
            'onclick' => "setLocation('{$this->getUrl('practice/adminhtml_query/fourthQuery')}')",
            'class'   => 'show_query',
        ));

        return $this;
    }

}