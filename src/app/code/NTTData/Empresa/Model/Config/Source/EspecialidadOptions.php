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

        foreach($items as $item){
            $options[] = [
                            'value' => $item->getEspecialidadId(),
                            'label' => $item->getEspecialidadNombre()
                        ];
        }

        return $options;
    }
}