<?php

namespace NTTData\Company\Controller\Adminhtml\Employees;

use Magento\Backend\App\Action;

class Edit extends \Magento\Backend\App\Action
{

    protected $resultPageFactory;

    public function __construct(
        Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $model = $this->_objectManager->create(\NTTData\Company\Model\Employee::class);

        if($id){
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('Employee not exist'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend( $id ? __('Edit employee') : __('Add employee'));
        $resultPage->setActiveMenu('NTTData_Company::company');

        return $resultPage;
    }
}
