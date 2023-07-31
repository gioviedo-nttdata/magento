<?php

namespace NTTData\Empresa\Ui\Component\Listing\Column\Empleados;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Escaper;
use Magento\Framework\UrlInterface;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;

class Actions extends Column
{

    const CMS_URL_PATH_EDIT = 'empresa/empleados/edit';
    const CMS_URL_PATH_DELETE = 'empresa/empleados/delete';

    protected $urlBuilder;
    private $escaper;

    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        $this->urlBuilder = $urlBuilder;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }

    public function prepareDataSource(array $dataSource){
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $name = $this->getData('name');
                if (isset($item['id'])) {
                    $item[$name]['edit'] = [
                        'href' => $this->urlBuilder->getUrl(self::CMS_URL_PATH_EDIT, ['id' => $item['id']]),
                        'label' => __('Editar')
                    ];
                    $nombre = $this->getEscaper()->escapeHtml($item['nombre']);
                    $item[$name]['delete'] = [
                        'href' => $this->urlBuilder->getUrl(self::CMS_URL_PATH_DELETE, ['id' => $item['id']]),
                        'label' => __('Eliminar'),
                        'confirm' => [
                            'title' => __('Eliminar a %1', $nombre),
                            'message' => __('Estas seguro de eliminar a %1?', $nombre)
                        ]
                    ];
                }
            }
        }

        return $dataSource;
    }

    private function getEscaper(){
        if (!$this->escaper) {
            $this->escaper = ObjectManager::getInstance()->get(Escaper::class);
        }
        return $this->escaper;
    }
}
