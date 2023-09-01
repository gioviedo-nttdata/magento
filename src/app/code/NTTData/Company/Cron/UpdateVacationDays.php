<?php

namespace NTTData\Company\Cron;

use NTTData\Company\Model\ResourceModel\Employee\CollectionFactory as EmployeeCollectionFactory;

class UpdateVacationDays
{

    protected $employeeCollectionFactory;
    protected $helper;

    public function __construct(
        EmployeeCollectionFactory $employeeCollectionFactory,
        \NTTData\Company\Helper\Data $helper
    ) {
        $this->employeeCollectionFactory = $employeeCollectionFactory;
        $this->helper = $helper;
    }

    public function execute(){
        $employees = $this->employeeCollectionFactory->create();
        foreach ($employees as $employee) {
            $hireDate = $employee->getHireDate();
            $vacationDays = $this->helper->calculateVacationDays($hireDate);
            $employee->setVacationDays($vacationDays);
            $employee->save();
        }
    }
}