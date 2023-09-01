<?php
namespace NTTData\Company\Model\ResourceModel\AcademicTraining;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\AcademicTraining::class,
            \NTTData\Company\Model\ResourceModel\AcademicTraining::class
        );
    }
}
