<?php

namespace NTTData\Empresa\Helper;

use Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper 
{

	public function __construct(\Magento\Framework\App\Helper\Context $context)
	{
		parent::__construct($context);
	}

	public function calculateAge($birthdateStr){
		$currentDate = new \DateTime();
		$birthdate = new \DateTime($birthdateStr);
		$interval = $currentDate->diff($birthdate);
		return $interval->y;
	}
}