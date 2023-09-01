<?php
namespace NTTData\Company\Model\ResourceModel\Seniority;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\Seniority::class,
            \NTTData\Company\Model\ResourceModel\Seniority::class
        );
    }
}
