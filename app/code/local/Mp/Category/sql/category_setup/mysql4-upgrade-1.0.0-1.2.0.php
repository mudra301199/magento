<?php
$installer = new Mage_Eav_Model_Entity_Setup('core_setup');
$installer->startSetup();
$installer->addAttribute('catalog_category', 'featured_category', array(
    'group'                       => 'General Information',
    'type'                        => 'int',
    'backend'                     => '',
    'frontend'                    => '',
    'input'                       => 'select',
    'label'                       => 'Featured Category',
    'class'                       => '',
    'source'                      => 'eav/entity_attribute_source_boolean',
    'sort_order'                  => '100',
    'required'                    => 0,
    'visible'                     => 1,
    'user_defined'                => 1,
    'searchable'                  => 1,
    'filterable'                  => 1,
    'visible_on_front'            => 1,
    'visible_in_advanced_search'  => 0,
    'is_html_allowed_on_front'    => 1,
    'comparable'                  => ''
));

$installer->endSetup();