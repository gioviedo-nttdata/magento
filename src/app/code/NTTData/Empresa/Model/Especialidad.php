<?php

namespace NTTData\Empresa\Model;

use Magento\Framework\Model\AbstractModel;

class Especialidad extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NTTData\Empresa\Model\ResourceModel\Especialidad::class);
    }
}
