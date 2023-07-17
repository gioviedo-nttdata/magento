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

	public function execute()
	{
		$products = $this->_productCollectionFactory->create();
        $products->addAttributeToSelect(['entity_id','name','image']);
        $products->addAttributeToSort('name', 'desc');
        $products->setPageSize(10)->load();
		foreach ($products as $product) {
			$productId = $product->getId();
			$productName = $product->getName();
			$productImage = $product->getData('image');
			echo "Product ID: $productId<br>Product name: $productName<br>Product image: $productImage<br><br>";
		}

		die();
	}
}