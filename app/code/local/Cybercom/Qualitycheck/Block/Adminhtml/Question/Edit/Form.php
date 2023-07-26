 <?php
class Cybercom_Qualitycheck_Block_Adminhtml_Question_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('question_form');
        $this->setTitle(Mage::helper('qualitycheck')->__('Question Information'));
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_question');

        $form = new Varien_Data_Form(array(
            'id'        => 'edit_form',
            'action'    => $this->getUrl('*/*/save', array('question_id' => $this->getRequest()->getParam('question_id'))),
            'method'    => 'post',
            'enctype'   => 'multipart/form-data'
        ));


        $fieldset = $form->addFieldset('base_fieldset', array('legend'=>Mage::helper('qualitycheck')->__('Question Information'), 'class' => 'fieldset-wide'));

        if ($model->getQuestionId()) {
            $fieldset->addField('question_id', 'hidden', array(
                'name' => 'question_id',
            ));
        }

        $fieldset->addField('question', 'text', array(
            'name'      => 'question',
            'label'     => Mage::helper('qualitycheck')->__('Question'),
            'title'     => Mage::helper('qualitycheck')->__('Question'),
            'required'  => true,
        ));

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }
}