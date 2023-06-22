<?php
class Mp_Practice_Block_Adminhtml_Second_Grid extends Mage_Adminhtml_Block_Widget_Grid
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
        $attributeCollection = Mage::getModel('eav/entity_attribute')
            ->getCollection();
        $attributeOptionData = array();

        foreach ($attributeCollection as $attribute) {

            $attributeId = $attribute->getAttributeId();
            $attributeCode = $attribute->getAttributeCode();

            $optionCollection = Mage::getModel('eav/entity_attribute_option')
                ->getCollection()
                ->setAttributeFilter($attributeId)
                ->setStoreFilter(0, false);

            foreach ($optionCollection as $option) {
                $optionId = $option->getOptionId();
                $optionName = $option->getValue();

                $attributeOptionData[] = array(
                    'attribute_id' => $attributeId,
                    'attribute_code' => $attributeCode,
                    'option_id' => $optionId,
                    'option_name' => $optionName
                );
        // echo "<pre>"; print_r($attributeOptionData); die();
            }
        }

        $collection = new Varien_Data_Collection();

        foreach ($attributeOptionData as $data) {
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
            'align'     => 'center',
            'index'     => 'attribute_id'
        ));

        $this->addColumn('attribute_code', array(
            'header'    => Mage::helper('product')->__('Attribute Code'),
            'align'     => 'center',
            'index'     => 'attribute_code'
        ));

        $this->addColumn('option_id', array(
            'header'    => Mage::helper('product')->__('Option Id'),
            'align'     => 'center',
            'index'     => 'option_id'
        ));

        $this->addColumn('option_name', array(
            'header'    => Mage::helper('product')->__('Option Name'),
            'align'     => 'center',
            'index'     => 'option_name'
        ));

        return parent::_prepareColumns();
    }
}