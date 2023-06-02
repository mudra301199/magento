<?php
class Mp_Vendor_AdminHtml_VendorController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('vendor/vendor')
            ->_addBreadcrumb(Mage::helper('vendor')->__('Vendor'), Mage::helper('vendor')->__('Vendor'))
            ->_addBreadcrumb(Mage::helper('vendor')->__('Manage Vendors'), Mage::helper('vendor')->__('Manage Vendors'))
        ;
        return $this;
    }

	public function indexAction()
    {
        $this->_title($this->__('Vendor'))
             ->_title($this->__('Manage Vendor'));

        $this->_initAction();
        $grid = $this->getLayout()->createBlock('vendor/adminhtml_vendor');
        $this->getLayout()->getBlock('content')->append($grid, 'grid');

        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Vendor'))
             ->_title($this->__('Add New Vendors'))
             ->_title($this->__('Manage Vendor'));

        $id = $this->getRequest()->getParam('vendor_id');
        $model = Mage::getModel('vendor/vendor')->load($id);
        $addressModel = Mage::getModel('vendor/vendor_address')->load($id, 'vendor_id');

        if ($id) {
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vendor')->__('This Vendor no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Vendor'));

        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        Mage::register('adminhtml_vendor', $model);
        Mage::register('adminhtml_vendor_address', $addressModel);

        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('vendor')->__('Edit Vendor')
                    : Mage::helper('vendor')->__('New Vendor'),
                $id ? Mage::helper('vendor')->__('Edit Vendor')
                    : Mage::helper('vendor')->__('New Vendor'));

        $this->_addContent($this->getLayout()->createBlock(' vendor/adminhtml_vendor_edit'))
            ->_addLeft($this->getLayout()->createBlock('vendor/adminhtml_vendor_edit_tabs'));
        $this->renderLayout();
    }


    public function saveAction()
    {
        if ($data = $this->getRequest()->getPost()) {

            $model = Mage::getModel('vendor/vendor');
            $id = $this->getRequest()->getParam('vendor_id');
            $model->setData($data['vendor'])->setId($id);
            try {
                if ($model->vendor_id == NULL) {
                    $model->created_at = now();
                } else {
                    $model->updated_at = now();
                }
                
                if ($model->save()) {
                    if ($id) {
                       $addressModel = Mage::getModel('vendor/vendor_address')->load($id, 'vendor_id');
                    } else {
                       $addressModel = Mage::getModel('vendor/vendor_address');
                    }

                    $addressModel->vendor_id = $model->getId();
                    $addressModel->setData(array_merge($addressModel->getData(), $data['address']));
                    $addressModel->save();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vendor')->__('The Vendor has been saved.'));

                Mage::getSingleton('adminhtml/session')->setFormData(false);

                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('vendor_id' => $model->getId(), '_current'=>true));
                    return;
                }

                $this->_redirect('*/*/');
                return;

            } catch (Mage_Core_Exception $e) {
                $this->_getSession()->addError($e->getMessage());
            }
            catch (Exception $e) {
                $this->_getSession()->addException($e,
                    Mage::helper('vendor')->__('An error occurred while saving the vendor.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('vendor_id' => $this->getRequest()->getParam('vendor_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    
    public function deleteAction()
    {
        
        if ($id = $this->getRequest()->getParam('vendor_id')) {
            $title = "";
            try {
                
                $model = Mage::getModel('vendor/vendor');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vendor')->__('The vendor has been deleted.'));
                
                Mage::dispatchEvent('adminhtml_vendor_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_vendor_on_delete', array('title' => $title, 'status' => 'fail'));
                
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                
                $this->_redirect('*/*/edit', array('vendor_id' => $id));
                return;
            }
        }
        
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Unable to find a vendor to delete.'));
        
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $vendorIds = $this->getRequest()->getParam('vendor_id');
        if (!is_array($vendorIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Please select item(s)'));
        } else {
            try {
                foreach ($vendorIds as $vendorId) {
                $vendor = Mage::getModel('vendor/vendor')->load($vendorId);
                $vendor->delete();
                }

                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('vendor')->__('Total of %d record(s) were successfully deleted',
                count($vendorIds))
            );
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        }
        $this->_redirect('*/*/index');
    }

}