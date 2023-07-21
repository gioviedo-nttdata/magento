<?php

namespace NTTData\Practice\Controller\Test;

use \Magento\Framework\App\Config\ScopeConfigInterface;

class ProductList extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_helper;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\NTTData\Practice\Helper\Data $helper)
	{
		$this->_pageFactory = $pageFactory;
		$this->_helper = $helper;
		return parent::__construct($context);
	}

	public function getTitle(){
		$hour = $this->_helper->getFormatHour();
		return __("Ahora siendo las %1, estoy aprendiendo traducciones", $hour);
	}

	public function execute(){
		$page = $this->_pageFactory->create();
		$page->getConfig()->getTitle()->set($this->getTitle());
		return $page;
	}
}