<?php

namespace NTTData\Empresa\Controller\Adminhtml\Empleados;

class Delete extends \Magento\Backend\App\Action
{
   
    public function execute()
    {
        $id = $this->getRequest()->getParam('id');
        $resultRedirect = $this->resultRedirectFactory->create();
        $errorMsg = __('Error');
        if ($id) {
            try {
                $model = $this->_objectManager->create(\NTTData\Empresa\Model\Empleado::class);
                $model->load($id);
                $model->delete();
                $nombre = $model->getNombre();
                $this->messageManager->addSuccess(__('Empleado %1 eliminado.',$nombre));
                $errorMsg = "";
            } catch (\Exception $e) {
                $errorMsg = $e->getMessage();
            }
        }

        if($errorMsg) $this->messageManager->addError($errorMsg);
        return $resultRedirect->setPath('*/*/');
    }
}
