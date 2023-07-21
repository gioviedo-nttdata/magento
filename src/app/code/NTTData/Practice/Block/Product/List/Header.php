<?php
namespace NTTData\Practice\Block\Product\List;
class Header extends \NTTData\Practice\Block\Product\ProductList
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context,
		\Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $productCollectionFactory,
		\NTTData\Practice\Helper\Data $helper,)
	{
		parent::__construct($context, $productCollectionFactory, $helper);
	}
}