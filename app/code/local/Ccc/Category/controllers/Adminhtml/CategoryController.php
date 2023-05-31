<?php
class Ccc_category_AdminHtml_categoryController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('category/category')
            ->_addBreadcrumb(Mage::helper('category')->__('category'), Mage::helper('category')->__('category'))
            ->_addBreadcrumb(Mage::helper('category')->__('Manage categorys'), Mage::helper('category')->__('Manage categorys'))
        ;
        return $this;
    }

	public function indexAction()
    {
        $this->_title($this->__('category'))
             ->_title($this->__('Manage category'));

        $this->_initAction();
        $grid = $this->getLayout()->createBlock('category/adminhtml_category');
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
        $this->_title($this->__('category'))
             ->_title($this->__('Add New categorys'))
             ->_title($this->__('Manage category'));

        // get id and model
        $id = $this->getRequest()->getParam('category_id');
        $model = Mage::getModel('category/category');

        // check id 
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('category')->__('This category no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New category'));

        // set data
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        // Register model to use later in blocks
        Mage::register('adminhtml_category', $model);

        // edit form
        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('category')->__('Edit category')
                    : Mage::helper('category')->__('New category'),
                $id ? Mage::helper('category')->__('Edit category')
                    : Mage::helper('category')->__('New category'));

        $edit = $this->getLayout()->createBlock('category/adminhtml_category_edit');
        $this->getLayout()->getBlock('content')->append($edit, 'edit');
        $this->renderLayout();
    }

    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            //init model and set data
            $model = Mage::getModel('category/category');

            if ($id = $this->getRequest()->getParam('category_id')) {
                $model->load($id);
            }

            $model->setData($data);

            Mage::dispatchEvent('category_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            // try to save it
            try {
                // save the data
                $model->save();

                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('category')->__('The category has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('category_id' => $model->getId(), '_current'=>true));
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
                    Mage::helper('category')->__('An error occurred while saving the category.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('category_id' => $this->getRequest()->getParam('category_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('category_id')) {
            $title = "";
            try {
                // init model and delete
                $model = Mage::getModel('category/category');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('category')->__('The category has been deleted.'));
                // go to grid
                Mage::dispatchEvent('adminhtml_category_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_category_on_delete', array('title' => $title, 'status' => 'fail'));
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('category_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Unable to find a category to delete.'));
        // go to grid
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $categoryIds = $this->getRequest()->getParam('category_id');
        if (!is_array($categoryIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('category')->__('Please select item(s)'));
        } else {
            try {
                foreach ($categoryIds as $categoryId) {
                $category = Mage::getModel('category/category')->load($categoryId);
                $category->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('category')->__('Total of %d record(s) were successfully deleted',
                count($categoryIds))
            );
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        }
        $this->_redirect('*/*/index');
    }
}