<?php
namespace NTTData\Empresa\Model\ResourceModel\Empleados;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Empresa\Model\Empleados::class,
            \NTTData\Empresa\Model\ResourceModel\Empleados::class
        );
    }
}
