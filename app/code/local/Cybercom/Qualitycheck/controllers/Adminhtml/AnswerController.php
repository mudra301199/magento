<?php

class Cybercom_Qualitycheck_Adminhtml_AnswerController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('qualitycheck/answer')
            ->_addBreadcrumb(Mage::helper('qualitycheck')->__('Answer'), Mage::helper('qualitycheck')->__('Answer'))
            ->_addBreadcrumb(Mage::helper('qualitycheck')->__('Manage Answers'), Mage::helper('qualitycheck')->__('Manage Answers'));
        return $this;
    }

    public function indexAction()
    {
        $this->_title($this->__('Qualitycheck'))
             ->_title($this->__('Answer'));

        $this->_initAction();
        $grid = $this->getLayout()->createBlock('qualitycheck/adminhtml_answer');
        $this->getLayout()->getBlock('content')->append($grid, 'grid');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Manage answer'));

        $id = $this->getRequest()->getParam('answer_id');
        $model = Mage::getModel('qualitycheck/answer');

        if ($id) 
        {
            $model->load($id);
            if (! $model->getId()) 
            {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('qualitycheck')->__('This Answer no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }
        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Answer'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) 
        {
            $model->setData($data);
        }

        Mage::register('adminhtml_answer', $model);

        $this->_initAction();
        $edit = $this->getLayout()->createBlock('qualitycheck/adminhtml_answer_edit');
        $this->getLayout()->getBlock('content')->append($edit, 'edit');
        $this->renderLayout();
    }

    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) 
        {
            $model = Mage::getModel('qualitycheck/answer');

            if ($id = $this->getRequest()->getParam('answer_id')) 
            {
                $model->load($id);
            }

            $model->setData($data);

            Mage::dispatchEvent('answer_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            try 
            {
                $model->save();

                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('qualitycheck')->__('The Answer has been saved.'));
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                if ($this->getRequest()->getParam('back')) 
                {
                    $this->_redirect('*/*/edit', array('answer_id' => $model->getId(), '_current'=>true));
                    return;
                }
                $this->_redirect('*/*/');
                return;

            } 
            catch (Exception $e) 
            {
                $this->_getSession()->addException($e,Mage::helper('qualitycheck')->__('An error occurred while saving the answer.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('answer_id' => $this->getRequest()->getParam('answer_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        if ($id = $this->getRequest()->getParam('answer_id')) 
        {
            $title = "";
            try 
            {
                $model = Mage::getModel('qualitycheck/answer');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                Mage::getSingleton('adminhtml/session')->addSuccess(Mage::helper('qualitycheck')->__('The answer has been deleted.'));
                Mage::dispatchEvent('adminhtml_answer_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;
            } 
            catch (Exception $e) 
            {
                Mage::dispatchEvent('adminhtml_answer_on_delete', array('title' => $title, 'status' => 'fail'));
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                $this->_redirect('*/*/edit', array('answer_id' => $id));
                return;
            }
        }
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('qualitycheck')->__('Unable to find a answer to delete.'));
        $this->_redirect('*/*/');
    }
}
?>