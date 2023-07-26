<?php

class Cybercom_Qualitycheck_Block_Adminhtml_Answer_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();

        $this->setDefaultSort('answer_id');
        $this->setId('adminhtmlAnswerGrid');
        $this->setDefaultDir('asc');
        $this->setSaveParametersInSession(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('qualitycheck/answer')->getCollection();
        $this->setCollection($collection);

        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {

        $this->addColumn('answer_id',
            array(
                'header'=> $this->__('Answer Id'),
                'align' =>'center',
                'width' => '50px',
                'index' => 'answer_id'
            )
        );

        $this->addColumn('question_id',
            array(
                'header'=> $this->__('Question'),
                'index' => 'question_id'
            )
        );

        $this->addColumn('answer',
            array(
                'header'=> $this->__('Answer'),
                'index' => 'answer'
            )
        );

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', array('answer_id'=>$row->getId()));
    }
}