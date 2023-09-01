<?php

namespace NTTData\Company\Block\Adminhtml\Employees\View;

class Tabs extends \Magento\Backend\Block\Widget\Tabs
{

    protected $_coreRegistry = null;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Backend\Model\Auth\Session $authSession,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $jsonEncoder, $authSession, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('company_employees_view_tabs');
        $this->setDestElementId('company_employees_view');
        $this->setTitle(__('Employee View'));
    }
}
