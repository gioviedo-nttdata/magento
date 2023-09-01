<?php

namespace NTTData\Company\Controller\Adminhtml\Employees;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
 
    protected $dataPersistor;
    protected $helper;

    public function __construct(
        Action\Context $context,
        \NTTData\Company\Helper\Data $helper
    ) {
        parent::__construct($context);
        $this->helper = $helper;
    }

    public function execute(){
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $model = \Magento\Framework\App\ObjectManager::getInstance()->get(\NTTData\Company\Model\EmployeeFactory::class)->create();

        if($data){
            $msg = __('Employee edited successfully');

            if (empty($data['id'])) {
                $data['id'] = null;
                $data['hire_date'] = $data['hire_date'] ? $data['hire_date'] : date('Y-m-d');
                $data['vacation_days'] = $this->helper->calculateVacationDays($data['hire_date']);
                $msg = __('Employee added successfully');
            }

            $model->setData($data);
            $model->save();

            $this->messageManager->addSuccessMessage(__($msg));
        }
       
        return $resultRedirect->setPath('*/*/');
    }
}
