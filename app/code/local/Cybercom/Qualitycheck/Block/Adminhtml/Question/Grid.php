<?php

class Cybercom_Qualitycheck_Block_Adminhtml_Question_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('question_id');
        $this->setId('adminhtmlQuestionGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('qualitycheck/question')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('question_id',
            array(
                'header'=> $this->__('Question Id'),
                'align' =>'center',
                'width' => '50px',
                'index' => 'question_id'
            )
        );

        $this->addColumn('question',
            array(
                'header'=> $this->__('Question'),
                'index' => 'question'
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('question_id'=>$row->getId()));
    }
}