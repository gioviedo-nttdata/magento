<?php
namespace NTTData\Company\Model\ResourceModel\HealthInsuranceType;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\HealthInsuranceType::class,
            \NTTData\Company\Model\ResourceModel\HealthInsuranceType::class
        );
    }
}
