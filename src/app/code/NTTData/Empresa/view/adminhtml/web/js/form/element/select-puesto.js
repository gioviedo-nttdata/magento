define([
    'jquery',
    'underscore',
    'uiRegistry',
    'Magento_Ui/js/form/element/select',
    'Magento_Ui/js/modal/modal',
    'mage/url'
], function ($, _, uiRegistry, select, modal, url) {
    'use strict';
    return select.extend({
        onUpdate: function (value){

            let urlAjax =  url.build('/admin/empresa/empleados/especialidadoptions/');
            
            $('select[name="id_especialidad"]').html('');
            $('select[name="id_especialidad"]').val('').trigger("change");
            $('select[name="id_especialidad"]').attr('disabled',true);

            $.ajax({
                url: urlAjax,
                type: 'POST',
                dataType: 'json',
                data: {
                    'id_puesto': value,
                    form_key: window.FORM_KEY
                },
                success: function(result){
                    $.each(result, function (index, value) {
                        $('select[name="id_especialidad"]').append($('<option>', {
                            value: value.value,
                            text: value.label
                        }));
                        $('select[name="id_especialidad"]').attr('disabled',false);
                    });
                }
            });

            return this._super();
        },
    });
});