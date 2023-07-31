<?php

namespace NTTData\Empresa\Model\ResourceModel\Empleado\Grid;

use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\Api\Search\AggregationInterface;
use NTTData\Empresa\Model\ResourceModel\Empleado\Collection as EmpleadosCollection;

class Collection extends EmpleadosCollection implements SearchResultInterface
{
    protected $aggregations;
    protected $_helper;

    public function __construct(
        \NTTData\Empresa\Helper\Data $helper,
        \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
        \Magento\Framework\Event\ManagerInterface $eventManager,
        $mainTable,
        $resourceModel,
        $model = \Magento\Framework\View\Element\UiComponent\DataProvider\Document::class,
        \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
        \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        parent::__construct(
            $entityFactory,
            $logger,
            $fetchStrategy,
            $eventManager,
            $connection,
            $resource
        );
        
        $this->_init($model, $resourceModel);
        $this->setMainTable($mainTable);
        $this->_helper = $helper;
    }

    public function getData(){
        $data = parent::getData();
        foreach ($data as &$item) {
            $item['edad'] = '';
            if (isset($item['fecha_nacimiento'])) {
                $birthdate = $item['fecha_nacimiento'];
                $age = $this->_helper->calculateAge($birthdate);
                $item['edad'] = $age;
            }
        }
        return $data;
    }

    protected function _initSelect(){
        parent::_initSelect();

        $this->getSelect()->joinLeft(
                ['secondTable' => $this->getTable('nttdata_empresa_puestos')],
                'main_table.id_puesto = secondTable.id',
                ['nombre AS puesto']
            )->joinLeft(
                ['thirdTable' => $this->getTable('nttdata_empresa_especialidades')],
                'main_table.id_especialidad = thirdTable.id',
                ['nombre AS especialidad']
            );
    }

    public function getAggregations()
    {
        return $this->aggregations;
    }

    public function setAggregations($aggregations)
    {
        $this->aggregations = $aggregations;
    }

    public function getSearchCriteria()
    {
        return null;
    }

    public function setSearchCriteria(\Magento\Framework\Api\SearchCriteriaInterface $searchCriteria = null)
    {
        return $this;
    }

    public function getTotalCount()
    {
        return $this->getSize();
    }

    public function setTotalCount($totalCount)
    {
        return $this;
    }

    public function setItems(array $items = null)
    {
        return $this;
    }
}
