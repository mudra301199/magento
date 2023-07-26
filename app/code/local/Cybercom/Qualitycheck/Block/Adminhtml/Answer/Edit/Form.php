 <?php
class Cybercom_Qualitycheck_Block_Adminhtml_Answer_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('answer_form');
        $this->setTitle(Mage::helper('qualitycheck')->__('Answer Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_answer');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('answer_id' => $this->getRequest()->getParam('answer_id'))),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data'
        ));


        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('qualitycheck')->__('Answer Information'), 'class' => 'fieldset-wide'));

        if ($model->getAnswerId()) {
            $fieldset->addField('answer_id', 'hidden', array(
                'name' => 'answer_id',
            ));
        }

        $fieldset->addField('question_id', 'select', array(
            'name'      => 'question_id',
            'label'     => Mage::helper('qualitycheck')->__('Question'),
            'title'     => Mage::helper('qualitycheck')->__('Question'),
            'values'    => Mage::helper('qualitycheck')->getRelatedModelOptions(),
            'required'  => true,
        ));

        $fieldset->addField('answer', 'text', array(
            'name'      => 'answer',
            'label'     => Mage::helper('qualitycheck')->__('Answer'),
            'title'     => Mage::helper('qualitycheck')->__('Answer'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}