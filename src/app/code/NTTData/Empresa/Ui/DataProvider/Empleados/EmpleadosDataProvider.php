<?php

namespace NTTData\Empresa\Ui\DataProvider\Empleados;

use NTTData\Empresa\Model\ResourceModel\Empleados\CollectionFactory;

class EmpleadosDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $collection;

    public function __construct(
        CollectionFactory $collectionFactory,
        $name,
        $primaryFieldName,
        $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        $collection = $collectionFactory->create();
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
        $this->collection = $collectionFactory->create();
        //$this->collection->addFieldToFilter('puesto', 'Programador');
    }
}