<?php

namespace NTTData\Practice\Helper;
use \Magento\Framework\App\Helper\AbstractHelper;

class Data extends AbstractHelper
{
        protected $_localeResolver;
        
        public function __construct(\Magento\Framework\App\Helper\Context $context, \Magento\Framework\Locale\ResolverInterface $localeResolver){
		parent::__construct($context);
		$this->_localeResolver = $localeResolver;
	}

        public function getStoreConfig()
        {
               return true;
        }

        public function getFormatHour(){
		$languageCode = $this->_localeResolver->getLocale();

		$languageCodes = ['es_AR', 'en_US'];

		if(!in_array($languageCode,$languageCodes)) $languageCode = $languageCodes[0];

		$timeZone = ['en_US'=>'America/New_York', 'es_AR' =>'America/Argentina/Buenos_Aires'];
		date_default_timezone_set($timeZone[$languageCode]);

		$formattedHour = ['en_US'=>date('h:i A'), 'es_AR' =>date('H:i')];
		$hour = $formattedHour[$languageCode];

		return $hour;
	}
}