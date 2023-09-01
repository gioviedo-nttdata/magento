<?php

namespace NTTData\Company\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class HealthInsuranceTypeOptions implements OptionSourceInterface
{

    protected $collectionFactory;

    public function __construct(\NTTData\Company\Model\ResourceModel\HealthInsuranceType\CollectionFactory $collectionFactory){
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray(){
        $options = [];
        $items = $this->collectionFactory->create();

        foreach($items as $item){
            $options[] = [
                            'value' => $item->getId(),
                            'label' => $item->getName()
                        ];
        }

        return $options;
    }
}