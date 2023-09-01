<?php

namespace NTTData\Company\Block\Adminhtml\Employees\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{

    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }
}

