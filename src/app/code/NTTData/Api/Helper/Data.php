<?php

namespace NTTData\Api\Helper;

use \Magento\Framework\App\Helper\AbstractHelper;
use \Magento\Store\Model\ScopeInterface;

class Data extends AbstractHelper
{
    const CONFIG_POKEAPI = 'api/pokemon';
    protected $_scopeConfig;
    
    public function __construct(\Magento\Framework\App\Helper\Context $context,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig)
    {
        parent::__construct($context);
        $this->_scopeConfig = $scopeConfig;
    }

    public function getConfig($config_path){
        return $this->_scopeConfig->getValue($config_path, ScopeInterface::SCOPE_STORE);
    }

    public function getEnabled(){
        return $this->getConfig(self::CONFIG_POKEAPI . '/enabled');
    }

    public function getBaseURL(){
        return $this->getConfig(self::CONFIG_POKEAPI . '/base_url');
    }

    public function getEndpointAll(){
        return $this->getConfig(self::CONFIG_POKEAPI . '/endpoint_all');
    }

    public function getParams(){
        return $this->getConfig(self::CONFIG_POKEAPI . '/params');
    }
}