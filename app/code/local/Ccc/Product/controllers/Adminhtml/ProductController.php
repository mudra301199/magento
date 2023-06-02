<?php
class Ccc_Product_AdminHtml_ProductController extends Mage_Adminhtml_Controller_Action
{
    protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('product/product')
            ->_addBreadcrumb(Mage::helper('product')->__('Product'), Mage::helper('product')->__('Product'))
            ->_addBreadcrumb(Mage::helper('product')->__('Manage Products'), Mage::helper('product')->__('Manage Products'))
        ;
        return $this;
    }

	public function indexAction()
    {
        $this->_title($this->__('Product'))
             ->_title($this->__('Manage Product'));

        $this->_initAction();
        $grid = $this->getLayout()->createBlock('product/adminhtml_product');
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
        $this->_title($this->__('Product'))
             ->_title($this->__('Add New Products'))
             ->_title($this->__('Manage Product'));

        // get id and model
        $id = $this->getRequest()->getParam('product_id');
        $model = Mage::getModel('product/product');

        // check id 
        if ($id) {
            $model->load($id);
            if (! $model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(
                    Mage::helper('product')->__('This Product no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Product'));

        // set data
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (! empty($data)) {
            $model->setData($data);
        }

        // Register model to use later in blocks
        Mage::register('adminhtml_product', $model);

        // edit form
        $this->_initAction()
            ->_addBreadcrumb(
                $id ? Mage::helper('product')->__('Edit Product')
                    : Mage::helper('product')->__('New Product'),
                $id ? Mage::helper('product')->__('Edit Product')
                    : Mage::helper('product')->__('New Product'));

        $edit = $this->getLayout()->createBlock('product/adminhtml_product_edit');
        $this->getLayout()->getBlock('content')->append($edit, 'edit');
        $this->renderLayout();
    }

    public function saveAction()
    {
        // check if data sent
        if ($data = $this->getRequest()->getPost()) {
            //init model and set data
            $model = Mage::getModel('product/product');

            if ($id = $this->getRequest()->getParam('product_id')) {
                $model->load($id);
            }

            $model->setData($data);

            Mage::dispatchEvent('product_prepare_save', array('page' => $model, 'request' => $this->getRequest()));

            // try to save it
            try {
                // save the data
                $model->save();

                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('product')->__('The Product has been saved.'));
                // clear previously saved data from session
                Mage::getSingleton('adminhtml/session')->setFormData(false);
                // check if 'Save and Continue'
                if ($this->getRequest()->getParam('back')) {
                    $this->_redirect('*/*/edit', array('product_id' => $model->getId(), '_current'=>true));
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
                    Mage::helper('product')->__('An error occurred while saving the product.'));
            }

            $this->_getSession()->setFormData($data);
            $this->_redirect('*/*/edit', array('product_id' => $this->getRequest()->getParam('product_id')));
            return;
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        // check if we know what should be deleted
        if ($id = $this->getRequest()->getParam('product_id')) {
            $title = "";
            try {
                // init model and delete
                $model = Mage::getModel('product/product');
                $model->load($id);
                $title = $model->getTitle();
                $model->delete();
                // display success message
                Mage::getSingleton('adminhtml/session')->addSuccess(
                    Mage::helper('product')->__('The product has been deleted.'));
                // go to grid
                Mage::dispatchEvent('adminhtml_product_on_delete', array('title' => $title, 'status' => 'success'));
                $this->_redirect('*/*/');
                return;

            } catch (Exception $e) {
                Mage::dispatchEvent('adminhtml_product_on_delete', array('title' => $title, 'status' => 'fail'));
                // display error message
                Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
                // go back to edit form
                $this->_redirect('*/*/edit', array('product_id' => $id));
                return;
            }
        }
        // display error message
        Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Unable to find a product to delete.'));
        // go to grid
        $this->_redirect('*/*/');
    }

    public function massDeleteAction()
    {
        $productIds = $this->getRequest()->getParam('product_id');
        if (!is_array($productIds)) {
            Mage::getSingleton('adminhtml/session')->addError(Mage::helper('product')->__('Please select item(s)'));
        } else {
            try {
                foreach ($productIds as $productId) {
                $product = Mage::getModel('product/product')->load($productId);
                $product->delete();
                }
                Mage::getSingleton('adminhtml/session')->addSuccess(
                Mage::helper('product')->__('Total of %d record(s) were successfully deleted',
                count($productIds))
            );
        } catch (Exception $e) {
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
        }
        }
        $this->_redirect('*/*/index');
    }
}