<?php

namespace NTTData\Empresa\Block\Adminhtml\Empleados\Edit;

use Magento\Backend\Block\Widget\Context;

abstract class GenericButton
{

    protected $context;

    public function __construct(Context $context)
    {
        $this->context = $context;
    }
}

