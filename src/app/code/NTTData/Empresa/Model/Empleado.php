<?php

namespace NTTData\Empresa\Model;

use Magento\Framework\Model\AbstractModel;

class Empleado extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NTTData\Empresa\Model\ResourceModel\Empleado::class);
    }
}
