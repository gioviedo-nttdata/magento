<?php
namespace NTTData\Company\Model\ResourceModel\Employee;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    protected function _construct()
    {
        $this->_init(
            \NTTData\Company\Model\Employee::class,
            \NTTData\Company\Model\ResourceModel\Employee::class
        );
    }
    
    public function _initSelect()
    {
        parent::_initSelect();
    
        $this->getSelect()->joinLeft(
            ['jobsTable' => $this->getTable('nttdata_company_jobs')],
            'main_table.job_id = jobsTable.id',
            ['job' => 'name']
        )->joinLeft(
            ['specialtiesTable' => $this->getTable('nttdata_company_specialties')],
            'main_table.specialty_id = specialtiesTable.id',
            ['specialty' => 'name']
        )->joinLeft(
            ['academicTrainingTable' => $this->getTable('nttdata_company_academic_training')],
            'main_table.academic_training_id = academicTrainingTable.id',
            ['academic_training' => 'name']
        )->joinLeft(
            ['senioritiesTable' => $this->getTable('nttdata_company_seniorities')],
            'main_table.seniority_id = senioritiesTable.id',
            ['seniority' => 'name']
        )->joinLeft(
            ['workloadsTable' => $this->getTable('nttdata_company_workloads')],
            'main_table.workload_id = workloadsTable.id',
            ['workload' => 'name']
        )->joinLeft(
            ['health_insuranceTable' => $this->getTable('nttdata_company_health_insurance')],
            'main_table.health_insurance_id = health_insuranceTable.id'
        )->joinLeft(
            ['health_insuranceTypesTable' => $this->getTable('nttdata_company_health_insurance_types')],
            'main_table.health_insurance_type_id = health_insuranceTypesTable.id'
        )->joinLeft(
            ['contractsTable' => $this->getTable('nttdata_company_contracts')],
            'main_table.contract_id = contractsTable.id',
            ['contract' => 'name']
        );
    
        $this->getSelect()->columns(
            [
                'id' => new \Zend_Db_Expr("main_table.id"),
                'name' => new \Zend_Db_Expr("main_table.name"),
                'age' => new \Zend_Db_Expr('TIMESTAMPDIFF(YEAR, main_table.birth_date, CURDATE())'),
                'health_insurance' => new \Zend_Db_Expr("CONCAT(health_insuranceTable.name, ' ', health_insuranceTypesTable.name)")
            ]
        );

        $this->addFilterToMap('id', 'main_table.id');
        $this->addFilterToMap('name', 'main_table.name');
        $this->addFilterToMap('age', 'age');
       
        return $this;
    }

    public function addFieldToFilter($field, $condition = null)
    {
        if ($field === 'age') {
            $this->getSelect()->where("TIMESTAMPDIFF(YEAR, main_table.birth_date, CURDATE()) = " . str_replace('%','',$condition['like']));
            return $this;
        }
    
        return parent::addFieldToFilter($field, $condition);
    }
}
