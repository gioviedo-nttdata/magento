<?php
namespace NTTData\Company\Model\ResourceModel\HealthInsurance;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\HealthInsurance::class,
            \NTTData\Company\Model\ResourceModel\HealthInsurance::class
        );
    }
}
