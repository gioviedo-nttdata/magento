<?php

namespace NTTData\Practice\Block\Time;

class Hour extends \Magento\Framework\View\Element\Template
{
	protected $_helper;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context, \NTTData\Practice\Helper\Data $helper){
		parent::__construct($context);
		$this->_helper = $helper;
	}

	public function getFormatHour(){
		return $this->_helper->getFormatHour();
	}
}