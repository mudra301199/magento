<?php
class Mp_Practice_Block_Adminhtml_Third_Grid extends Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practiceAdminhtmlPracticeGrid');
        $this->setDefaultSort('attribute_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $attributes = Mage::getResourceModel('catalog/product_attribute_collection')
            ->addFieldToFilter('frontend_input', array('in' => array('select', 'multiselect')))
            ->addFilter('is_user_defined', 1);

        $attributeList = array();

        foreach ($attributes as $attribute) {
            $attributeId = $attribute->getAttributeId();
            $attributeCode = $attribute->getAttributeCode();

            $attributeModel = Mage::getModel('catalog/resource_eav_attribute')->load($attributeId);
            $optionCount = $attributeModel->getSource()->getAllOptions(false);

            if (count($optionCount) > 10) {
                $attributeList[] = array(
                    'attribute_id' => $attributeId,
                    'attribute_code' => $attributeCode,
                    'option_count' => count($optionCount)
                );
            }
        }
        $collection = new Varien_Data_Collection();

        foreach ($attributeList as $data) {
            $row = new Varien_Object($data);
            $collection->addItem($row);
        }
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $baseUrl = $this->getUrl();

        $this->addColumn('attribute_id', array(
            'header'    => Mage::helper('product')->__('Attribute Id'),
            'align'     => 'left',
            'index'     => 'attribute_id'
        ));

        $this->addColumn('attribute_code', array(
            'header'    => Mage::helper('product')->__('Attribute Code'),
            'align'     => 'left',
            'index'     => 'attribute_code'
        ));

        $this->addColumn('option_count', array(
            'header'    => Mage::helper('product')->__('Option Count'),
            'align'     => 'left',
            'index'     => 'option_count'
        ));

        return parent::_prepareColumns();
    }
}