<?php
namespace NTTData\Api\Model\ResourceModel\Pokemon;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Api\Model\Pokemon::class,
            \NTTData\Api\Model\ResourceModel\Pokemon::class
        );
    }
}
