<?php
namespace NTTData\Company\Model\ResourceModel\Contract;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\Contract::class,
            \NTTData\Company\Model\ResourceModel\Contract::class
        );
    }
}
