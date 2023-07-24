<?php

namespace NTTData\Practice\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;

class OrderField implements OptionSourceInterface
{

    protected $_catalogConfig;

    public function __construct(\Magento\Catalog\Model\Config $catalogConfig){
        $this->_catalogConfig = $catalogConfig;
    }

    //se traen los atributos con la clase de magento que ya se encarga de crear la collection y aplicarle los filtros correspondientes
    public function toOptionArray(){

        $options = [];
        $attributes = $this->_catalogConfig->getAttributeUsedForSortByArray();

        foreach($attributes as $code => $label){
            $options[] = [
                            'value' => $code,
                            'label' => $label
                        ];
        }

        return $options;
    }

}