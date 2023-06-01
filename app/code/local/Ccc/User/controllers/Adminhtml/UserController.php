<?php
class Ccc_User_AdminHtml_UserController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
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
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('User'))
             ->_title($this->__('Add New Users'))
             ->_title($this->__('Manage User'));

        $id = $this->getRequest()->getParam('user_id');
        $model = Mage::getModel('user/user')->load($id);
        $addressModel = Mage::getModel('user/user_address')->load($id, 'user_id');

        if ($id) {
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('user')->__('This User no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New User'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        Mage::register('adminhtml_user', $model);
        Mage::register('adminhtml_user_address', $addressModel);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('user')->__('Edit User')
                    : Mage::helper('user')->__('New User'),
                $id ? Mage::helper('user')->__('Edit User')
                    : Mage::helper('user')->__('New User'));

        $this->_addContent($this->getLayout()->createBlock(' user/adminhtml_user_edit'))
            ->_addLeft($this->getLayout()->createBlock('user/adminhtml_user_edit_tabs'));
        $this->renderLayout();
    }


    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('user/user');
            $id = $this->getRequest()->getParam('user_id');
            $model->setData($data['user'])->setId($id);
            try {
                if ($model->user_id == NULL) {
                    $model->created_at = now();
                } else {
                    $model->updated_at = now();
                }
                
                if ($model->save()) {
                    if ($id) {
                       $addressModel = Mage::getModel('user/user_address')->load($id, 'user_id');
                    } else {
                       $addressModel = Mage::getModel('user/user_address');
                    }

                    $addressModel->user_id = $model->getId();
                    $addressModel->setData(array_merge($addressModel->getData(), $data['address']));
                    $addressModel->save();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('user')->__('The User has been saved.'));

                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('user_id' => $model->getId(), '_current'=>true));
                    return;
                }

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

    
    public function deleteAction()
    {
        
        if ($id = $this->getRequest()->getParam('user_id')) {
            $title = "";
            try {
                
                $model = Mage::getModel('user/user');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('user')->__('The user has been deleted.'));
                
                Mage::dispatchEvent('adminhtml_user_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_user_on_delete', array('title' => $title, 'status' => 'fail'));
                
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                
                $this->_redirect('*/*/edit', array('user_id' => $id));
                return;
            }
        }
        
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('user')->__('Unable to find a user to delete.'));
        
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