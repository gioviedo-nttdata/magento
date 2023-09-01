<?php

namespace NTTData\Company\Model;

use Magento\Framework\Model\AbstractModel;

class HealthInsuranceType extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NTTData\Company\Model\ResourceModel\HealthInsuranceType::class);
    }
}