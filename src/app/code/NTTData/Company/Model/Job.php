<?php

namespace NTTData\Company\Model;

use Magento\Framework\Model\AbstractModel;

class Job extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\NTTData\Company\Model\ResourceModel\Job::class);
    }
}
