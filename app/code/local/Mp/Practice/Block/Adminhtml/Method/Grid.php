<?php
class Mp_Practice_Block_Adminhtml_Method_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('attribute_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('catalog/product')->getCollection();
        return parent::_prepareCollection();
    }

}