<?php

namespace NTTData\Empresa\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class PuestoOptions implements OptionSourceInterface
{

    protected $collectionFactory;

    public function __construct(\NTTData\Empresa\Model\ResourceModel\Puesto\CollectionFactory $collectionFactory){
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray(){
        $options = [];
        $items = $this->collectionFactory->create();

        $options[] = [
            'value' => '',
            'label' => __('Seleccione una opciòn')
        ];

        foreach($items as $item){
            $options[] = [
                            'value' => $item->getId(),
                            'label' => $item->getNombre()
                        ];
        }

        return $options;
    }
}