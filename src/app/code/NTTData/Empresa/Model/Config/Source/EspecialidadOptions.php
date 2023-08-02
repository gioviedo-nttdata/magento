<?php

namespace NTTData\Empresa\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class EspecialidadOptions implements OptionSourceInterface
{

    protected $collectionFactory;

    public function __construct(\NTTData\Empresa\Model\ResourceModel\Especialidad\CollectionFactory $collectionFactory){
        $this->collectionFactory = $collectionFactory;
    }

    public function toOptionArray(){
        $options = [];
        $items = $this->collectionFactory->create();

        $options[] = [
            'value' => '',
            'label' => __('Seleccione una opcion')
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