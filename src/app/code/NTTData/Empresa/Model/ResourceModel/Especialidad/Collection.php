<?php
namespace NTTData\Empresa\Model\ResourceModel\Especialidad;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Empresa\Model\Especialidad::class,
            \NTTData\Empresa\Model\ResourceModel\Especialidad::class
        );
    }
}
