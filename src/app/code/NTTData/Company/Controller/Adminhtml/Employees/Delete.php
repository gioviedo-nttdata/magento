<?php

namespace NTTData\Company\Controller\Adminhtml\Employees;

class Delete extends \Magento\Backend\App\Action
{
   
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        $errorMsg = __('Error');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\NTTData\Company\Model\Employee::class);
                $model->load($id);
                $model->delete();
                $nombre = $model->getName();
                $this->messageManager->addSuccess(__('Employee %1 remove.',$nombre));
                $errorMsg = "";
            } catch (\Exception $e) {
                $errorMsg = $e->getMessage();
            }
        }

        if($errorMsg) $this->messageManager->addError($errorMsg);
        return $resultRedirect->setPath('*/*/');
    }
}
