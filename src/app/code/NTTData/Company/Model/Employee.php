<?php

namespace NTTData\Company\Model;

use Magento\Framework\Model\AbstractModel;

class Employee extends AbstractModel
{

    protected function _construct(){
        $this->_init(\NTTData\Company\Model\ResourceModel\Employee::class);
    }

    public function loadFullData($id){
        $collection = $this->getCollection();
        $collection->addFieldToFilter('main_table.id', $id);

        $employee = $collection->getFirstItem();

        $personalInfo = [
                            'ID' => $employee->getId(),
                            'Name' => $employee->getName(),
                            'Lastname' => $employee->getLastname(),
                            'Birthdate' => $employee->getBirthDate(),
                            'Age' => $employee->getAge(),
                            'Phone' => $employee->getPhone(),
                            'Address' => $employee->getAddress(),
                            'Civil status' => $employee->getCivilStatus(),
                            'Health Insurance' => $employee->getHealthInsurance()
                        ];

        $employmentInfo = [
                            'Hire date' => $employee->getHireDate(),
                            'Egress date' => $employee->getEgressDate(),
                            'Job' => $employee->getJob(),
                            'Specialty' => $employee->getSpecialty(),
                            'Seniority' => $employee->getSeniority(),
                            'Academic training' => $employee->getAcademicTraining(),
                            'Contract' => $employee->getContract(),
                            'Workload' => $employee->getWorkload(),
                            'Vacation days' => $employee->getVacationDays()
                        ];
        
        $employee->setData('personal_info',$personalInfo);
        $employee->setData('employment_info',$employmentInfo);

        return $employee;
    }
}
