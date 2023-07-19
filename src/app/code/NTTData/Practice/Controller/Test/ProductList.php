<?php
namespace NTTData\Practice\Controller\Test;

class ProductList extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_productCollectionFactory;
	protected $_helper;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
		\NTTData\Practice\Helper\Data $helper)
	{
		$this->_pageFactory = $pageFactory;
		$this->_productCollectionFactory = $productCollectionFactory;
		$this->_helper = $helper;
		return parent::__construct($context);
	}

	public function getCollection(){
		$products = $this->_productCollectionFactory->create();
        $products->addAttributeToSelect(['entity_id','name','image']);
        $products->addAttributeToSort('name', 'desc');
        $products->setPageSize(10)->load();
		return $products;
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