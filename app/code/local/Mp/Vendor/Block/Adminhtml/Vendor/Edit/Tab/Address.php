<?php
class Mp_Vendor_Block_Adminhtml_Vendor_Edit_Tab_Address extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_vendor_address');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('address_form', array('legend'=>Mage::helper('vendor')->__('Vendor Address Information'), 'class' => 'fieldset-wide'));

        $fieldset->addField('address', 'text', array(
            'name'      => 'address[address]',
            'label'     => Mage::helper('vendor')->__('Address'),
            'title'     => Mage::helper('vendor')->__('Address'),
            'required'  => true,
        ));

        $fieldset->addField('postal_code', 'text', array(
            'name'      => 'address[postal_code]',
            'label'     => Mage::helper('vendor')->__('Postal Code'),
            'title'     => Mage::helper('vendor')->__('Postal Code'),
            'required'  => true,
        ));

        $fieldset->addField('city', 'text', array(
            'name'      => 'address[city]',
            'label'     => Mage::helper('vendor')->__('City'),
            'title'     => Mage::helper('vendor')->__('City'),
            'required'  => true,
        ));

        $fieldset->addField('country', 'select', array(
            'label' => Mage::helper('vendor')->__('Country'),
            'class' => 'required-entry',
            'values' => Mage::getModel('vendor/vendor')->getCountryOptions(),
            'required' => true,
            'name' => 'address[country]',
            'values'    => Mage::getModel('directory/country')->getResourceCollection()
                            ->loadByStore()
                            ->toOptionArray(),
            'onchange'  => 'getStates(this.value)',
        ));

        $stateOptions = array();
        $fieldset->addField('state', 'select', array(
            'label'    => 'State',
            'name'     => 'address[state]',
            'values'   => $stateOptions,
            'required' => true
        ));

        $countryField = $form->getElement('country');
        $registry = Mage::registry('adminhtml_vendor_address')->getData();
        $countryField->setValue($registry['country']);
        $countryField->setAfterElementHtml('
            <script type="text/javascript">
                document.observe("dom:loaded", function() {
                    getStates("' . $registry['country'] . '");
                });
                function getStates(countryId) {
                    var url = \'' . $this->getUrl('vendor/adminhtml_vendor/states') . '\';
                    
                    var stateElement = $("state");
                    new Ajax.Request(url, {
                        method: "post",
                        parameters: {
                            country_id: countryId
                        },
                        onSuccess: function(response) {
                            var stateOptions = JSON.parse(response.responseText);
                            var optionsHtml = "";
                            stateOptions.forEach(function(option) {
                                optionsHtml += "<option value=\"" + option.value + "\"";
                                if (option.value == "' . $registry['state'] . '") {
                                    optionsHtml += " selected";
                                }
                                optionsHtml += ">" + option.label + "</option>";
                            });
                            stateElement.update(optionsHtml);
                        },
                        onFailure: function() {
                            stateElement.update("");
                        }
                    });
                }
            </script>
        ');

        if ( Mage::getSingleton('adminhtml/session')->getvendorData() ){
            $form->setValues(Mage::getSingleton('adminhtml/session')->getvendorData());
            Mage::getSingleton('adminhtml/session')->setvendorData(null);
        } elseif ( Mage::registry('adminhtml_vendor_address') ) {
            $form->setValues(Mage::registry('adminhtml_vendor_address')->getData());
        }

        return parent::_prepareForm();
    }
}