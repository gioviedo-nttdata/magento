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

    protected function _initSelect()
    {
        parent::_initSelect();
    
        $this->getSelect()->joinLeft(
            ['secondTable' => $this->getTable('nttdata_empresa_puestos')],
            'main_table.id_puesto = secondTable.puesto_id'
        )->joinLeft(
            ['thirdTable' => $this->getTable('nttdata_empresa_especialidades')],
            'main_table.id_especialidad = thirdTable.especialidad_id'
        );
    
        $this->getSelect()->columns(
            [
                'edad' => new \Zend_Db_Expr('TIMESTAMPDIFF(YEAR, main_table.fecha_nacimiento, CURDATE())')
            ]
        );

        $this->addFilterToMap('edad', 'edad');
       
        return $this;
    }

    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'edad') {
            //var_dump($condition);
            $this->getSelect()->where("TIMESTAMPDIFF(YEAR, main_table.fecha_nacimiento, CURDATE()) = " . str_replace('%','',$condition['like']));
            //echo $this->getSelect()->__toString();
            return $this;
        }
    
        return parent::addFieldToFilter($field, $condition);
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
