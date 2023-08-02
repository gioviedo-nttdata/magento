<?php

namespace NTTData\Empresa\Controller\Adminhtml\Empleados;

class EspecialidadOptions extends \Magento\Backend\App\Action
{
    protected $resultJsonFactory;
    protected $collectionFactory;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \NTTData\Empresa\Model\ResourceModel\Especialidad\CollectionFactory $collectionFactory

    ){
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->collectionFactory = $collectionFactory;
    }

    public function execute(){
        $id_puesto = $this->getRequest()->getParam('id_puesto');
        
        $options = [];
        $options[] = [
            'value' => '',
            'label' => __('Seleccione una opciòn')
        ];

        $items = $this->collectionFactory->create();
        $items->addFieldToFilter('id_puesto',$id_puesto);

        foreach($items as $item){
            $options[] = [
                            'value' => $item->getId(),
                            'label' => $item->getNombre()
                        ];
        }

        return  $this->resultJsonFactory->create()->setData($options);
    }
}