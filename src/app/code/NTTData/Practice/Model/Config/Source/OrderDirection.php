<?php

namespace NTTData\Practice\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OrderDirection implements OptionSourceInterface
{

    public function toOptionArray(){
            $options = [
                            [
                                'value' => 'desc',
                                'label' => 'Descendente'
                            ],
                            [
                                'value' => 'asc',
                                'label' => 'Ascendente'
                            ]
                        ];

        return $options;
    }
}