<?php
namespace NTTData\Practice\Controller\Test;

class ProductList extends \Magento\Framework\App\Action\Action
{
	protected $_pageFactory;
	protected $_productCollectionFactory;

	public function __construct(
		\Magento\Framework\App\Action\Context $context,
		\Magento\Framework\View\Result\PageFactory $pageFactory,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory)
	{
		$this->_pageFactory = $pageFactory;
		$this->_productCollectionFactory = $productCollectionFactory;
		return parent::__construct($context);
	}

	public function getCollection(){
		$products = $this->_productCollectionFactory->create();
        $products->addAttributeToSelect(['entity_id','name','image']);
        $products->addAttributeToSort('name', 'desc');
        $products->setPageSize(10)->load();
		return $products;
	}

	public function execute(){
		return $this->_pageFactory->create();
	}
}