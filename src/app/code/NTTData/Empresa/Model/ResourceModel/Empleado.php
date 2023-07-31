<?php

namespace NTTData\Empresa\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Empleado extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('nttdata_empresa_empleados', 'id');
    }
}
