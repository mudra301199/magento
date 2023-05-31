<?php
class Ccc_User_AdminHtml_UserController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
        $this->loadLayout()
            ->_setActiveMenu('user/user')
            ->_addBreadcrumb(Mage::helper('user')->__('User'), Mage::helper('user')->__('User'))
            ->_addBreadcrumb(Mage::helper('user')->__('Manage Users'), Mage::helper('user')->__('Manage Users'))
        ;
        return $this;
    }

	public function indexAction()
    {
        $this->_title($this->__('User'))
             ->_title($this->__('Manage User'));

        $this->_initAction();
        $grid = $this->getLayout()->createBlock('user/adminhtml_user');
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
        $this->_title($this->__('User'))
             ->_title($this->__('Add New Users'))
             ->_title($this->__('Manage User'));

        // get id and model
        $id = $this->getRequest()->getParam('user_id');
        $model = Mage::getModel('user/user');

        // check id 
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('user')->__('This User no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New User'));

        // set data
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        // Register model to use later in blocks
        Mage::register('adminhtml_user', $model);

        // edit form
        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('user')->__('Edit User')
                    : Mage::helper('user')->__('New User'),
                $id ? Mage::helper('user')->__('Edit User')
                    : Mage::helper('user')->__('New User'));

        $edit = $this->getLayout()->createBlock('user/adminhtml_user_edit');
        $this->getLayout()->getBlock('content')->append($edit, 'edit');
        $this->renderLayout();
    }

    /**
     * Save action
     */
    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            //init model and set data
            $model = Mage::getModel('user/user');

            if ($id = $this->getRequest()->getParam('user_id')) {
                $model->load($id);
            }

            $model->setData($data);

            Mage::dispatchEvent('user_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            // try to save it
            try {
                // save the data
                $model->save();

                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('user')->__('The User has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('user_id' => $model->getId(), '_current'=>true));
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
                    Mage::helper('user')->__('An error occurred while saving the user.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('user_id' => $this->getRequest()->getParam('user_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    /**
     * Delete action
     */
    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('user_id')) {
            $title = "";
            try {
                // init model and delete
                $model = Mage::getModel('user/user');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('user')->__('The user has been deleted.'));
                // go to grid
                Mage::dispatchEvent('adminhtml_user_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_user_on_delete', array('title' => $title, 'status' => 'fail'));
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('user_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('user')->__('Unable to find a user to delete.'));
        // go to grid
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $userIds = $this->getRequest()->getParam('user_id');
        if (!is_array($userIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('user')->__('Please select item(s)'));
        } else {
            try {
                foreach ($userIds as $userId) {
                $user = Mage::getModel('user/user')->load($userId);
                $user->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('user')->__('Total of %d record(s) were successfully deleted',
                count($userIds))
            );
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        }
        $this->_redirect('*/*/index');
    }

}