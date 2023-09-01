<?php

namespace NTTData\Company\Controller\Adminhtml\Employees;

use Magento\Backend\App\Action;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\Registry;


class View extends Action
{
    protected $resultPageFactory;
    protected $coreRegistry;
    protected $employee;

    public function __construct(Action\Context $context, PageFactory $resultPageFactory, Registry $coreRegistry, \NTTData\Company\Model\EmployeeFactory $employee
    ) 
    {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->resultPageFactory = $resultPageFactory;
        $this->employee = $employee;
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $employee = $this->employee->create();
        $employee = $employee->loadFullData($id);
        $this->coreRegistry->register('current_employee', $employee);
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Employee View'));
        return $resultPage;
    }
}
