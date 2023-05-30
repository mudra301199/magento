<?php
class Ccc_Vendor_AdminHtml_VendorController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        // load layout, set active menu and breadcrumbs
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
        // common form for add & edit
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Vendor'))
             ->_title($this->__('Add New Vendors'))
             ->_title($this->__('Manage Vendor'));

        // get id and model
        $id = $this->getRequest()->getParam('vendor_id');
        $model = Mage::getModel('vendor/vendor');

        // check id 
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('vendor')->__('This Vendor no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Vendor'));

        // set data
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        // Register model to use later in blocks
        Mage::register('adminhtml_vendor', $model);

        // edit form
        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('vendor')->__('Edit Vendor')
                    : Mage::helper('vendor')->__('New Vendor'),
                $id ? Mage::helper('vendor')->__('Edit Vendor')
                    : Mage::helper('vendor')->__('New Vendor'));

        $edit = $this->getLayout()->createBlock('vendor/adminhtml_vendor_edit');
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
            $model = Mage::getModel('vendor/vendor');

            if ($id = $this->getRequest()->getParam('vendor_id')) {
                $model->load($id);
            }

            $model->setData($data);

            Mage::dispatchEvent('vendor_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            // try to save it
            try {
                // save the data
                $model->save();

                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vendor')->__('The Vendor has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('vendor_id' => $model->getId(), '_current'=>true));
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
                    Mage::helper('vendor')->__('An error occurred while saving the vendor.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('vendor_id' => $this->getRequest()->getParam('vendor_id')));
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
        if ($id = $this->getRequest()->getParam('vendor_id')) {
            $title = "";
            try {
                // init model and delete
                $model = Mage::getModel('vendor/vendor');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('vendor')->__('The vendor has been deleted.'));
                // go to grid
                Mage::dispatchEvent('adminhtml_vendor_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_vendor_on_delete', array('title' => $title, 'status' => 'fail'));
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('vendor_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('vendor')->__('Unable to find a vendor to delete.'));
        // go to grid
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