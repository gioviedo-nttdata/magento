<?php

namespace NTTData\Practice\Block\Product;

class ProductList extends \Magento\Framework\View\Element\Template
{
	protected $_productCollectionFactory;
	protected $_helper;

	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
		\NTTData\Practice\Helper\Data $helper)
	{
		parent::__construct($context);
		$this->_productCollectionFactory = $productCollectionFactory;
		$this->_helper = $helper;
	}

	public function getCollection(){
		$orderBy = $this->_helper->getOrderField();
		$order = $this->_helper->getOrderDirection();
		$limit = $this->_helper->getLimit();

		$products = $this->_productCollectionFactory->create();
        $products->addAttributeToSelect('*');
        $products->addAttributeToSort($orderBy, $order);
        $products->setPageSize($limit)->load();

		return $products;
	}

	public function enableModule(){
		return $this->_helper->getEnabled();
	}
}