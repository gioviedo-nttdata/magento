<?php

namespace NTTData\Api\Block\Pokemon;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_pokeApi;
	protected $_helper;
	protected $_storeManager;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context, 
		\NTTData\Api\Service\Api\PokeApi $pokeApi, 
		\NTTData\Api\Helper\Data $helper,
		\Magento\Store\Model\StoreManagerInterface $storeManager)
	{
		parent::__construct($context);

		$this->_pokeApi = $pokeApi;
		$this->_helper = $helper;
		$this->_storeManager = $storeManager;
	}

	public function getDataPokemon(){
		$data['pokemon_arr'] = $this->_pokeApi->getAll();
		$data['message'] = $this->_pokeApi->getMessage();
		return $data;
	}

	public function isEnabled(){
		return $this->_helper->getEnabled();
	}

	public function showInStore(){
		return  $this->_storeManager->getStore()->getCode() == 'pokemon';
	}

}