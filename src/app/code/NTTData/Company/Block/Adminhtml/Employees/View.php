<?php

namespace NTTData\Company\Block\Adminhtml\Employees;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

class View extends \Magento\Backend\Block\Widget\Form\Container
{

    protected $_blockGroup = 'NTTData_Company';
    protected $_coreRegistry;
    protected $_context;

    public function __construct(
        Context $context,
        Registry $coreRegistry,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->_context = $context;
        parent::__construct($context, $data);
    }

    protected function _construct()
    {
        $this->_objectId = 'employee_id';
        $this->_controller = 'adminhtml_employees';
        $this->_mode = 'view';

        parent::_construct();


        $this->removeButton('back');
        $this->removeButton('reset');
        $this->removeButton('save');

        $this->addButton(
            'edit_employee',
            [
                'label' => __('Edit'),
                'class' => 'edit primary',
                'onclick' => 'setLocation(\'' . $this->getEditUrl() . '\')'
            ]
        );
    }

    public function getEditUrl()
    {
        return $this->getUrl('company/employees/edit');
    }

    public function getUrl($params = '', $params2 = [])
    {
        $params2['id'] = $this->getEmployee()->getId();
        return parent::getUrl($params, $params2);
    }

    public function getEmployee()
    {
        return $this->_coreRegistry->registry('current_employee');
    }
}
