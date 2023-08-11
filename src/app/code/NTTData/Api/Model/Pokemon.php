<?php

namespace NTTData\Api\Model;

use Magento\Framework\Model\AbstractModel;

class Pokemon extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NTTData\Api\Model\ResourceModel\Pokemon::class);
    }
}
