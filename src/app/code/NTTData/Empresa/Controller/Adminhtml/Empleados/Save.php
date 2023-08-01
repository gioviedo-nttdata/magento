<?php

namespace NTTData\Empresa\Controller\Adminhtml\Empleados;

use Magento\Backend\App\Action;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{
 
    protected $dataPersistor;

    public function __construct(
        Action\Context $context,
    ) {
        parent::__construct($context);
    }

    public function execute(){
        $data = $this->getRequest()->getPostValue();
        $resultRedirect = $this->resultRedirectFactory->create();
        $model = \Magento\Framework\App\ObjectManager::getInstance()->get(\NTTData\Empresa\Model\EmpleadoFactory::class)->create();

        if($data){
            $msg = 'Empleado editado correctamente';
            $fechaNac = new \DateTime($data['fecha_nacimiento']);
            $data['fecha_nacimiento'] = $fechaNac->format('Y-m-d');
            if (empty($data['id'])) {
                $data['id'] = null;
                $msg = 'Empleado agregado correctamente';
            }

            $model->setData($data);
            $model->save();

            $this->messageManager->addSuccessMessage(__($msg));
        }
       
        return $resultRedirect->setPath('*/*/');
    }
}
