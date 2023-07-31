<?php

namespace NTTData\Empresa\Model;

use Magento\Framework\Model\AbstractModel;

class Puesto extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NTTData\Empresa\Model\ResourceModel\Puesto::class);
    }
}
