    <?php
class Ccc_User_Block_Adminhtml_User_Edit_Tab_User extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $model = Mage::registry('adminhtml_user');

        $form = new Varien_Data_Form();
        $this->setForm($form);

        $fieldset = $form->addFieldset('user_form', array('legend'=>Mage::helper('user')->__('User Information')));

        $fieldset->addField('first_name', 'text', array(
            'name'      => 'user[first_name]',
            'label'     => Mage::helper('user')->__('First Name'),
            'title'     => Mage::helper('user')->__('First Name'),
            'required'  => true,
        ));

        $fieldset->addField('last_name', 'text', array(
            'name'      => 'user[last_name]',
            'label'     => Mage::helper('user')->__('Last Name'),
            'title'     => Mage::helper('user')->__('Last Name'),
            'required'  => true,
        ));

        $fieldset->addField('email', 'text', array(
            'name'      => 'user[email]',
            'label'     => Mage::helper('user')->__('Email'),
            'title'     => Mage::helper('user')->__('Email'),
            'required'  => true,
        ));

        $fieldset->addField('gender', 'select', array(
            'name'      => 'user[gender]',
            'label'     => Mage::helper('user')->__('Gender'),
            'title'     => Mage::helper('user')->__('Gender'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('user')->__('Male'),
                '2' => Mage::helper('user')->__('Female'),
            ),
        ));

        $fieldset->addField('mobile', 'text', array(
            'name'      => 'user[mobile]',
            'label'     => Mage::helper('user')->__('Mobile No'),
            'title'     => Mage::helper('user')->__('Mobile No'),
            'required'  => true,
        ));

        $fieldset->addField('status', 'select', array(
            'name'      => 'user[status]',
            'label'     => Mage::helper('user')->__('Status'),
            'title'     => Mage::helper('user')->__('Status'),
            'required'  => true,
            'options'   => array(
                '1' => Mage::helper('user')->__('Active'),
                '2' => Mage::helper('user')->__('Inactive'),
            ),
        ));

        $form->setValues($model->getData());

        return parent::_prepareForm();
    }
}