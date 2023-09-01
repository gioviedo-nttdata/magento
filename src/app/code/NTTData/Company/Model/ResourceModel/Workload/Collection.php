<?php
namespace NTTData\Company\Model\ResourceModel\Workload;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\Workload::class,
            \NTTData\Company\Model\ResourceModel\Workload::class
        );
    }
}
