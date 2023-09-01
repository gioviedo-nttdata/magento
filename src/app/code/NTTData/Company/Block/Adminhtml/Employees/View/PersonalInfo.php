<?php

namespace  NTTData\Company\Block\Adminhtml\Employees\View;

class PersonalInfo extends \NTTData\Company\Block\Adminhtml\Employees\AbstractEmployee
{

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        array $data = []
    ) {
        parent::__construct($context, $registry, $data);
    }
}
