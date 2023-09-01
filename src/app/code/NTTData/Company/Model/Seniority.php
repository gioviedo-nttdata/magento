<?php

namespace NTTData\Company\Model;

use Magento\Framework\Model\AbstractModel;

class Seniority extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NTTData\Company\Model\ResourceModel\Seniority::class);
    }
}
