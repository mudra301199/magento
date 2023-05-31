<?php
class Ccc_Salesman_AdminHtml_SalesmanController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('salesman/salesman')
            ->_addBreadcrumb(Mage::helper('salesman')->__('Salesman'), Mage::helper('salesman')->__('Salesman'))
            ->_addBreadcrumb(Mage::helper('salesman')->__('Manage Salesmans'), Mage::helper('salesman')->__('Manage Salesmans'))
        ;
        return $this;
    }

	public function indexAction()
    {
        $this->_title($this->__('Salesman'))
             ->_title($this->__('Manage Salesman'));

        $this->_initAction();
        $grid = $this->getLayout()->createBlock('salesman/adminhtml_salesman');
        $this->getLayout()->getBlock('content')->append($grid, 'grid');
        $this->renderLayout();
    }

    public function newAction()
    {
        // common form for add & edit
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Salesman'))
             ->_title($this->__('Add New Salesmans'))
             ->_title($this->__('Manage Salesman'));

        // get id and model
        $id = $this->getRequest()->getParam('salesman_id');
        $model = Mage::getModel('salesman/salesman');

        // check id 
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('salesman')->__('This Salesman no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Salesman'));

        // set data
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        // Register model to use later in blocks
        Mage::register('adminhtml_salesman', $model);

        // edit form
        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('salesman')->__('Edit Salesman')
                    : Mage::helper('salesman')->__('New Salesman'),
                $id ? Mage::helper('salesman')->__('Edit Salesman')
                    : Mage::helper('salesman')->__('New Salesman'));

        $edit = $this->getLayout()->createBlock('salesman/adminhtml_salesman_edit');
        $this->getLayout()->getBlock('content')->append($edit, 'edit');
        $this->renderLayout();
    }

    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            //init model and set data
            $model = Mage::getModel('salesman/salesman');

            if ($id = $this->getRequest()->getParam('salesman_id')) {
                $model->load($id);
            }

            $model->setData($data);

            Mage::dispatchEvent('salesman_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            // try to save it
            try {
                // save the data
                $model->save();

                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('salesman')->__('The Salesman has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('salesman_id' => $model->getId(), '_current'=>true));
                    return;
                }
                // go to grid
                $this->_redirect('*/*/');
                return;

            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
            catch (Exception $e) {
                $this->_getSession()->addException($e,
                    Mage::helper('salesman')->__('An error occurred while saving the salesman.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('salesman_id' => $this->getRequest()->getParam('salesman_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('salesman_id')) {
            $title = "";
            try {
                // init model and delete
                $model = Mage::getModel('salesman/salesman');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('salesman')->__('The salesman has been deleted.'));
                // go to grid
                Mage::dispatchEvent('adminhtml_salesman_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_salesman_on_delete', array('title' => $title, 'status' => 'fail'));
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('salesman_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Unable to find a salesman to delete.'));
        // go to grid
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $salesmanIds = $this->getRequest()->getParam('salesman_id');
        if (!is_array($salesmanIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Please select item(s)'));
        } else {
            try {
                foreach ($salesmanIds as $salesmanId) {
                $salesman = Mage::getModel('salesman/salesman')->load($salesmanId);
                $salesman->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('salesman')->__('Total of %d record(s) were successfully deleted',
                count($salesmanIds))
            );
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        }
        $this->_redirect('*/*/index');
    }
}