<?php

class Cybercom_Qualitycheck_Adminhtml_QuestionController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('qualitycheck/question')
            ->_addBreadcrumb(Mage::helper('qualitycheck')->__('Question'), Mage::helper('qualitycheck')->__('Question'))
            ->_addBreadcrumb(Mage::helper('qualitycheck')->__('Manage Questions'), Mage::helper('qualitycheck')->__('Manage Questions'));
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Qualitycheck'))
             ->_title($this->__('Question'));

        $this->_initAction();
        $grid = $this->getLayout()->createBlock('qualitycheck/adminhtml_question');
        $this->getLayout()->getBlock('content')->append($grid, 'grid');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Manage question'));

        $id = $this->getRequest()->getParam('question_id');
        $model = Mage::getModel('qualitycheck/question');

        if ($id) 
        {
            $model->load($id);
            if (! $model->getId()) 
            {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('qualitycheck')->__('This Question no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Question'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('adminhtml_question', $model);

        $this->_initAction();
        $edit = $this->getLayout()->createBlock('qualitycheck/adminhtml_question_edit');
        $this->getLayout()->getBlock('content')->append($edit, 'edit');
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) 
        {
            $model = Mage::getModel('qualitycheck/question');

            if ($id = $this->getRequest()->getParam('question_id')) 
            {
                $model->load($id);
            }

            $model->setData($data);

            Mage::dispatchEvent('question_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            try 
            {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('qualitycheck')->__('The Question has been saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) 
                {
                    $this->_redirect('*/*/edit', array('question_id' => $model->getId(), '_current'=>true));
                    return;
                }
                $this->_redirect('*/*/');
                return;

            } 
            catch (Exception $e) 
            {
                $this->_getSession()->addException($e,Mage::helper('qualitycheck')->__('An error occurred while saving the question.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('question_id' => $this->getRequest()->getParam('question_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('question_id')) 
        {
            $title = "";
            try 
            {
                $model = Mage::getModel('qualitycheck/question');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('qualitycheck')->__('The question has been deleted.'));
                Mage::dispatchEvent('adminhtml_question_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;
            } 
            catch (Exception $e) 
            {
                Mage::dispatchEvent('adminhtml_question_on_delete', array('title' => $title, 'status' => 'fail'));
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('question_id' => $id));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('qualitycheck')->__('Unable to find a question to delete.'));
        $this->_redirect('*/*/');
    }
}
?>