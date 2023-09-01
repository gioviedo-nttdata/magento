<?php
namespace NTTData\Company\Model\ResourceModel\Specialty;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\Specialty::class,
            \NTTData\Company\Model\ResourceModel\Specialty::class
        );
    }
}
