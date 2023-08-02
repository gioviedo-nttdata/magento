define([
    'jquery',
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal',
    'mage/url',
    'domReady!'
], function ($, _, uiRegistry, select, modal, url) {
    'use strict';
    return select.extend({
        initialize: function () {
            this._super();
            let initialValue = this.value();
            if(typeof initialValue != 'undefined') this.onUpdate(initialValue);
            return this;
        },
        onUpdate: function (value){
            let selectEspecialidad = uiRegistry.get('index = id_especialidad');
            let urlAjax =  url.build('/admin/empresa/empleados/especialidadoptions/');

            $.ajax({
                url: urlAjax,
                type: 'POST',
                dataType: 'json',
                data: {
                    'id_puesto': value,
                    form_key: window.FORM_KEY
                },
                success: function(result){
                    selectEspecialidad.options([]);
                    $.each(result, function (index, value) {
                        selectEspecialidad.options.push({
                            value: value.value,
                            label: value.label
                        });
                    });
                }
            });
            return this._super();
        },
    });
});