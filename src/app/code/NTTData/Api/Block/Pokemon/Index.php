<?php

namespace NTTData\Api\Block\Pokemon;

class Index extends \Magento\Framework\View\Element\Template
{
	protected $_pokeApi;
	protected $_helper;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context, 
		\NTTData\Api\Service\Api\PokeApi $pokeApi, 
		\NTTData\Api\Helper\Data $helper)
	{
		parent::__construct($context);

		$this->_pokeApi = $pokeApi;
		$this->_helper = $helper;
	}

	public function getDataPokemon(){
		$data['pokemon_arr'] = $this->_pokeApi->getAll();
		$data['message'] = $this->_pokeApi->getMessage();
		return $data;
	}

	public function isEnabled(){
		return $this->_helper->getEnabled();
	}

}