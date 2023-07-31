<?php

namespace NTTData\Empresa\Controller\Adminhtml\Empleados;

use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action\Context;
use Magento\Ui\Component\MassAction\Filter;
use NTTData\Empresa\Model\ResourceModel\Empleado\CollectionFactory;

class PromedioEdad extends \Magento\Backend\App\Action
{
    protected $filter;
    protected $collectionFactory;
    protected $_NTTDataHelper;

    public function __construct(\NTTData\Empresa\Helper\Data $_NTTDataHelper, Context $context, Filter $filter, CollectionFactory $collectionFactory)
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
	
        $edades = [];
        foreach ($collection as $emp) {
            $edades[] = $this->_NTTDataHelper->calculateAge($emp->getFecha_nacimiento());
        }

        $promedio = array_sum($edades) / $collectionSize;

        $this->messageManager->addSuccess(__('El promedio de edad es %1', (int) $promedio));


        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
}
