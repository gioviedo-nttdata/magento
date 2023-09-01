<?php

namespace NTTData\Company\Controller\Adminhtml\Employees;

class SpecialtyOptions extends \Magento\Backend\App\Action
{
    protected $resultJsonFactory;
    protected $collectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \NTTData\Company\Model\ResourceModel\Specialty\CollectionFactory $collectionFactory

    ){
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(){
        $job_id = $this->getRequest()->getParam('job_id');
        
        $options = [];

        $items = $this->collectionFactory->create();
        $items->addFieldToFilter('job_id',$job_id);

        foreach($items as $item){
            $options[] = [
                            'value' => $item->getId(),
                            'label' => $item->getName()
                        ];
        }

        return  $this->resultJsonFactory->create()->setData($options);
    }
}