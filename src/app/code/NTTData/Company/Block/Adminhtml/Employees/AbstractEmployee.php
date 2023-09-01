<?php

namespace NTTData\Company\Block\Adminhtml\Employees;

class AbstractEmployee extends \Magento\Backend\Block\Widget
{

    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getEmployee(){
        return $this->_coreRegistry->registry('current_employee');
    }

    public function getDataEmployee()
    {
        return $this->getEmployee()->getData();
    }

    public function getPersonalInfo(){
        return $this->getEmployee()->getPersonalInfo();
    }

    public function getEmploymentInfo(){
        return $this->getEmployee()->getEmploymentInfo();
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

}
