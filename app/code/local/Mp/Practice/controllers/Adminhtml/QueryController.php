<?php
class Mp_Practice_Adminhtml_QueryController extends Mage_Adminhtml_Controller_Action
{
    
    public function firstAction()
    {
        // Need a list of product with these columns product name, sku, cost, price, color.
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_First');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function firstQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $tableName = $resource->getTableName('catalog/product');
        $select = $readConnection->select()
            ->from(array('p' => $tableName), array(
                'sku' => 'p.sku',
                'name' => 'pv.value',
                'cost' => 'pdc.value',
                'price' => 'pdp.value',
                'color' => 'pi.value',
            ))
            ->joinLeft(
                array('pv' => $resource->getTableName('catalog_product_entity_varchar')),
                'pv.entity_id = p.entity_id AND pv.attribute_id = 73',
                array()
            )
            ->joinLeft(
                array('pdc' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdc.entity_id = p.entity_id AND pdc.attribute_id = 81',
                array()
            )
            ->joinLeft(
                array('pdp' => $resource->getTableName('catalog_product_entity_decimal')),
                'pdp.entity_id = p.entity_id AND pdp.attribute_id = 77',
                array()
            )
            ->joinLeft(
                array('pi' => $resource->getTableName('catalog_product_entity_int')),
                'pi.entity_id = p.entity_id AND pi.attribute_id = 94',
                array()
            );
        echo "<pre>";
        echo $select;
    }

    public function secondAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Second');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function secondQueryAction()
    {
        $attributeOptions = [];

        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('ao' => $attributeOptionTable),
                array(
                    'attribute_id' => 'ao.attribute_id',
                    'option_id' => 'ao.option_id',
                    'option_name' => 'ov.value',
                )
            )
            ->joinLeft(
                array('ov' => $resource->getTableName('eav_attribute_option_value')),
                'ov.option_id = ao.option_id',
                array()
            )
            ->joinLeft(
                array('a' => $attributeTable),
                'a.attribute_id = ao.attribute_id',
                array('attribute_code' => 'a.attribute_code')
            );
        echo "<pre>";
        echo $select;
    }

    public function thirdAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Third');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function thirdQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $attributeOptionTable = $resource->getTableName('eav_attribute_option');
        $attributeTable = $resource->getTableName('eav_attribute');

        $select = $readConnection->select()
            ->from(
                array('at' => $attributeTable),
                array(
                    'attribute_id' => 'at.attribute_id',
                    'attribute_code' => 'at.attribute_code',
                )
            )
            ->joinLeft(
                array('oct' => $attributeOptionTable),
                'oct.attribute_id = at.attribute_id',
                array(
                    'option_count' => 'COUNT(oct.option_id)',
                )
            )
            ->group('at.attribute_id')
            ->having('COUNT(oct.option_id) > 10', 1);
        echo "<pre>";
        echo $select;
    }

    public function fourthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Fourth');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function fourthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $select = $readConnection->select()
            ->from(
                array('DD'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('DJ'=>$resource->getTableName('catalog_product_entity_varchar')),
                'DJ.entity_id = DD.entity_id AND DJ.attribute_id = 87',
                array('image' => 'DJ.value')
            )
            ->joinLeft(
                array('thumb'=>$resource->getTableName('catalog_product_entity_varchar')),
                'thumb.entity_id = DD.entity_id AND thumb.attribute_id = 89',
                array('thumbnail' => 'thumb.value')
            )
            ->joinLeft(
                array('small'=>$resource->getTableName('catalog_product_entity_varchar')),
                'small.entity_id = DD.entity_id AND small.attribute_id = 88',
                array('small' => 'small.value')
            );

        echo "<pre>";
        echo $select;
    }

    public function fifthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Fifth');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function fifthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $select = $readConnection->select()
            ->from(
                array('cpe'=> $resource->getTableName('catalog_product_entity')),
                array('entity_id','sku')
            )
            ->joinLeft(
                array('pamg'=>$resource->getTableName('catalog/product_attribute_media_gallery')),
                'pamg.entity_id = cpe.entity_id',
                array('image' => 'COUNT(pamg.value)')
            )
            ->group('cpe.entity_id');
        echo "<pre>";
        echo $select;
    }

    public function sixthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Sixth');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function sixthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $select = $readConnection->select()
            ->from(
                array('ce'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('cev'=>$resource->getTableName('customer_entity_varchar')),
                'cev.entity_id = ce.entity_id AND cev.attribute_id = 5',
                array('firstname' => 'cev.value')
            )
            ->joinLeft(
                array('so' => $resource->getTableName('sales/order')),
                'so.customer_id = cev.entity_id',
                array('order_count' => 'COUNT(so.entity_id)')
            )
            ->group('ce.entity_id');
        echo "<pre>";
        echo $select;
    }

    public function seventhAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Seventh');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function seventhQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');
        $select = $readConnection->select()
            ->from(
                array('ce'=> $resource->getTableName('customer_entity')),
                array('entity_id','email')
            )
            ->joinLeft(
                array('cev'=>$resource->getTableName('customer_entity_varchar')),
                'cev.entity_id = ce.entity_id AND cev.attribute_id = 5',
                array('firstname' => 'cev.value')
            )
            ->joinLeft(
                array('so' => $resource->getTableName('sales/order')),
                'so.customer_id = cev.entity_id',
                array('order_count' => 'COUNT(so.entity_id)')
            )
            ->joinLeft(
                array('sos' => Mage::getSingleton('core/resource')->getTableName('sales_order_status')),
                'so.status = sos.status',
                array('order_status' => 'sos.label')
            )
            ->group('ce.entity_id');
        echo "<pre>";
        echo $select;
    }

    public function eighthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Eighth');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function eighthQueryAction()
    {
        $resource = Mage::getSingleton('core/resource');
        $readConnection = $resource->getConnection('core_read');

        $select = $readConnection->select()
            ->from(array('oi' => $resource->getTableName('sales/order_item')), array())
            ->columns(array(
                'product_id' => 'oi.product_id',
                'sku' => 'oi.sku',
                'sold_quantity' => new Zend_Db_Expr('SUM(oi.qty_ordered)')
            ))
            ->group('oi.product_id');
        echo "<pre>";
        echo $select;
    }

    public function ninthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Ninth');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function ninthQueryAction()
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $tablePrefix = Mage::getConfig()->getTablePrefix();

        $select = $connection->select()
        ->from(array('e' => 'catalog_product_entity'), 'entity_id AS product_id')
        ->joinLeft(
            array('a' => 'eav_attribute'),
            'e.entity_type_id = a.entity_type_id',
            array('attribute_id', 'attribute_code')
        )
        ->joinLeft(
            array('avc' => 'catalog_product_entity_varchar'),
            'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avi' => 'catalog_product_entity_int'),
            'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avd' => 'catalog_product_entity_decimal'),
            'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avt' => 'catalog_product_entity_text'),
            'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
            array()
        )
        ->where('avc.value IS NULL AND avi.value IS NULL AND avd.value IS NULL AND avt.value IS NULL')
        ->where('a.is_user_defined = ?', 1);
        echo "<pre>";
        echo $select;
    }

    public function tenthAction()
    {
        $this->loadLayout();
        $block = $this->getLayout()->createBlock('Mp_Practice_Block_Adminhtml_Tenth');
        $this->_addContent($block);
        $this->renderLayout();
    }

    public function tenthQueryAction()
    {
        $connection = Mage::getSingleton('core/resource')->getConnection('core_read');
        $tablePrefix = Mage::getConfig()->getTablePrefix();
        $select = $connection->select()
        ->from(
            array('e' => 'catalog_product_entity'),
            array('entity_id AS product_id','sku')
        )
        ->joinLeft(
            array('a' => 'eav_attribute'),
            'e.entity_type_id = a.entity_type_id',
            array('attribute_id', 'attribute_code')
        )
        ->joinLeft(
            array('avc' => 'catalog_product_entity_varchar'),
            'e.entity_id = avc.entity_id AND avc.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avi' => 'catalog_product_entity_int'),
            'e.entity_id = avi.entity_id AND avi.attribute_id = a.attribute_id',
            array('avi.value')
        )
        ->joinLeft(
            array('avd' => 'catalog_product_entity_decimal'),
            'e.entity_id = avd.entity_id AND avd.attribute_id = a.attribute_id',
            array()
        )
        ->joinLeft(
            array('avt' => 'catalog_product_entity_text'),
            'e.entity_id = avt.entity_id AND avt.attribute_id = a.attribute_id',
            array()
        )
        ->where('avc.value IS NOT NULL OR avi.value IS NOT NULL OR avd.value IS NOT NULL OR avt.value IS NOT NULL')
        ->where('a.is_user_defined = ?', 1);
        echo "<pre>";
        echo $select;
    }
}
?>  