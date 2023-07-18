<?php
namespace NTTData\Practice\Block\Product;
class ProductList extends \Magento\Framework\View\Element\Template
{
	public function __construct(\Magento\Framework\View\Element\Template\Context $context)
	{
		parent::__construct($context);
	}

	public function getClass()
    {
        return __(get_class($this));
    }
}