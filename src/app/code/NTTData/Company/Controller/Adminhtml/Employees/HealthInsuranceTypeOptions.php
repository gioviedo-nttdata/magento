<?php

namespace NTTData\Company\Controller\Adminhtml\Employees;

class HealthInsuranceTypeOptions extends \Magento\Backend\App\Action
{
    protected $resultJsonFactory;
    protected $collectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \NTTData\Company\Model\ResourceModel\HealthInsuranceType\CollectionFactory $collectionFactory

    ){
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(){
        $health_insurance_id = $this->getRequest()->getParam('health_insurance_id');
        
        $options = [];

        $items = $this->collectionFactory->create();
        $items->addFieldToFilter('health_insurance_id',$health_insurance_id);

        foreach($items as $item){
            $options[] = [
                            'value' => $item->getId(),
                            'label' => $item->getName()
                        ];
        }

        return  $this->resultJsonFactory->create()->setData($options);
    }
}