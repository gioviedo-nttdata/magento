<?php

namespace NTTData\Company\Controller\Adminhtml\Employees;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use NTTData\Company\Model\ResourceModel\Employee\CollectionFactory;

class AverageAge extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $collectionFactory;
    protected $_NTTDataHelper;

    public function __construct(\NTTData\Company\Helper\Data $_NTTDataHelper, Context $context, Filter $filter, CollectionFactory $collectionFactory)
    {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->_NTTDataHelper = $_NTTDataHelper;
        parent::__construct($context);
    }
	
	
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        if(!count($collection)) $collection = $this->collectionFactory->create();
        $collectionSize = $collection->getSize();
	
        $ages = [];
        foreach ($collection as $emp) {
            $ages[] = $this->_NTTDataHelper->calculateAge($emp->getBirth_date());
        }

        $average = array_sum($ages) / $collectionSize;

        $this->messageManager->addSuccess(__('The average age is %1', (int) $average));


        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
