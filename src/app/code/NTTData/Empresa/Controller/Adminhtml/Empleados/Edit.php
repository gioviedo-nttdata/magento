<?php

namespace NTTData\Empresa\Controller\Adminhtml\Empleados;

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
        $model = $this->_objectManager->create(\NTTData\Empresa\Model\Empleado::class);

        if($id){
            $model->load($id);
            if (!$model->getId()) {
                $this->messageManager->addError(__('Empleado no existe'));
                $resultRedirect = $this->resultRedirectFactory->create();
                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend( $id ? __('Editar empleado') : __('Agregar empleado'));
        $resultPage->setActiveMenu('NTTData_Empresa::empresa');

        return $resultPage;
    }
}
