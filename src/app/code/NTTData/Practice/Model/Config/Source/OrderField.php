<?php

namespace NTTData\Practice\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OrderField implements OptionSourceInterface
{

    protected $attributesCollection;

    public function __construct(\Magento\Catalog\Model\ResourceModel\Product\Attribute\CollectionFactory $attributesCollection){
        $this->attributesCollection = $attributesCollection;
    }

    public function toOptionArray(){
        $options = [];
        $attributes = $this->attributesCollection->create();
        $attributes->addFieldToFilter('used_for_sort_by',1);

        foreach($attributes as $attributeObj){
            $options[] = [
                            'value' => $attributeObj->getAttributeCode(),
                            'label' => $attributeObj->getFrontendLabel()
                        ];
        }

        return $options;
    }
}