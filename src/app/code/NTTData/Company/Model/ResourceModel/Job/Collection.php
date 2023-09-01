<?php
namespace NTTData\Company\Model\ResourceModel\Job;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\Job::class,
            \NTTData\Company\Model\ResourceModel\Job::class
        );
    }
}
