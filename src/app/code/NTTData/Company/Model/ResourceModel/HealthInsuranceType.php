<?php

namespace NTTData\Company\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class HealthInsuranceType extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('nttdata_company_health_insurance_types', 'id');
    }
}
