<?php

namespace NTTData\Practice\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
        protected $_localeResolver;
		protected $_scopeConfig;
        
        public function __construct(\Magento\Framework\App\Helper\Context $context, 
			\Magento\Framework\Locale\ResolverInterface $localeResolver,
			\Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
		{
			parent::__construct($context);
			$this->_localeResolver = $localeResolver;
			$this->_scopeConfig = $scopeConfig;
		}

		const GROUP_TEST = 'practice/test/';

		public function getConfig($config_path){
            return $this->_scopeConfig->getValue($config_path, ScopeInterface::SCOPE_STORE);
        }

		public function getEnabled(){
            return $this->getConfig(self::GROUP_TEST . 'enabled');
        }

		public function getLimit(){
            return $this->getConfig(self::GROUP_TEST . 'limit');
        }

		public function getOrderField(){
            return $this->getConfig(self::GROUP_TEST . 'order_field');
        }

		public function getOrderDirection(){
            return $this->getConfig(self::GROUP_TEST . 'order_direction');
        }

		public function getStoreConfig(){
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