<?php

namespace NTTData\Company\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper 
{

	public function __construct(\Magento\Framework\App\Helper\Context $context) {
		parent::__construct($context);
	}

	public function calculateAge($birthdateStr){
		$currentDate = new \DateTime();
		$birthdate = new \DateTime($birthdateStr);
		$interval = $currentDate->diff($birthdate);
		return $interval->y;
	}

    public function calculateBusinessDaysInYear($year) {
        $businessDays = 0;
        for ($month = 1; $month <= 12; $month++) {
            $lastDayOfMonth = date("t", mktime(0, 0, 0, $month, 1, $year));
            for ($day = 1; $day <= $lastDayOfMonth; $day++) {
                $dayOfWeek = date("N", mktime(0, 0, 0, $month, $day, $year));
                if ($dayOfWeek >= 1 && $dayOfWeek <= 5) {
                    $businessDays++;
                }
            }
        }
        return $businessDays;
    }

    public function calculateBusinessDays($startDate, $endDate) {
        $businessDays = 0;
        $start = new \DateTime($startDate);
        $end = new \DateTime($endDate);
        $interval = new \DateInterval('P1D');
        $period = new \DatePeriod($start, $interval, $end);
        foreach ($period as $day) {
            if ($day->format('N') < 6) {
                $businessDays++;
            }
        }
        return $businessDays;
    }
    
    public function calculateVacationDays($startDate) {
        $lastDayOfCurrentYear = new \DateTime(date('Y-12-t'));
        $workedDays = $this->calculateBusinessDays($startDate, $lastDayOfCurrentYear->format('Y-m-d'));
        $currentYear = date('Y');
        $years = $workedDays / $this->calculateBusinessDaysInYear($currentYear);
        if ($years >= 20) {
            return 35;
        } elseif ($years >= 10) {
            return 28;
        } elseif ($years >= 5) {
            return 21;
        } else if ($years >= 0.5) {
            return 14;
        } else {
            return round($workedDays / 20);
        }
    }
}