<?php
namespace NTTData\Empresa\Model\ResourceModel\Puesto;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Empresa\Model\Puesto::class,
            \NTTData\Empresa\Model\ResourceModel\Puesto::class
        );
    }
}
