<?php

namespace NTTData\Company\Block\Adminhtml\Employees\View\Tab;

class EmploymentInfo extends \NTTData\Company\Block\Adminhtml\Employees\AbstractEmployee implements
    \Magento\Backend\Block\Widget\Tab\TabInterface
{

    public function getTabLabel()
    {
        return __('Employment Information');
    }

    public function getTabTitle()
    {
        return __('Employment Information');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }
}
