<?php
class Mp_Salesman_AdminHtml_SalesmanController extends Mage_Adminhtml_Controller_Action
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
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Salesman'))
             ->_title($this->__('Add New Salesmans'))
             ->_title($this->__('Manage Salesman'));

        $id = $this->getRequest()->getParam('salesman_id');
        $model = Mage::getModel('salesman/salesman')->load($id);
        $addressModel = Mage::getModel('salesman/salesman_address')->load($id, 'salesman_id');

        if ($id) {
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('salesman')->__('This Salesman no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Salesman'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        Mage::register('adminhtml_salesman', $model);
        Mage::register('adminhtml_salesman_address', $addressModel);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('salesman')->__('Edit Salesman')
                    : Mage::helper('salesman')->__('New Salesman'),
                $id ? Mage::helper('salesman')->__('Edit Salesman')
                    : Mage::helper('salesman')->__('New Salesman'));

        $this->_addContent($this->getLayout()->createBlock(' salesman/adminhtml_salesman_edit'))
            ->_addLeft($this->getLayout()->createBlock('salesman/adminhtml_salesman_edit_tabs'));
        $this->renderLayout();
    }


    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('salesman/salesman');
            $id = $this->getRequest()->getParam('salesman_id');
            $model->setData($data['salesman'])->setId($id);
            try {
                if ($model->salesman_id == NULL) {
                    $model->created_at = now();
                } else {
                    $model->updated_at = now();
                }
                
                if ($model->save()) {
                    if ($id) {
                       $addressModel = Mage::getModel('salesman/salesman_address')->load($id, 'salesman_id');
                    } else {
                       $addressModel = Mage::getModel('salesman/salesman_address');
                    }

                    $addressModel->salesman_id = $model->getId();
                    $addressModel->setData(array_merge($addressModel->getData(), $data['address']));
                    $addressModel->save();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('salesman')->__('The Salesman has been saved.'));

                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('salesman_id' => $model->getId(), '_current'=>true));
                    return;
                }

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
        
        if ($id = $this->getRequest()->getParam('salesman_id')) {
            $title = "";
            try {
                
                $model = Mage::getModel('salesman/salesman');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('salesman')->__('The salesman has been deleted.'));
                
                Mage::dispatchEvent('adminhtml_salesman_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_salesman_on_delete', array('title' => $title, 'status' => 'fail'));
                
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                
                $this->_redirect('*/*/edit', array('salesman_id' => $id));
                return;
            }
        }
        
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('salesman')->__('Unable to find a salesman to delete.'));
        
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