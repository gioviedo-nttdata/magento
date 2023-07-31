<?php
namespace NTTData\Empresa\Model\ResourceModel\Empleado;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Empresa\Model\Empleado::class,
            \NTTData\Empresa\Model\ResourceModel\Empleado::class
        );
    }
}
