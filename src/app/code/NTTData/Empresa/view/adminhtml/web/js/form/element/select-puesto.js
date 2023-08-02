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
        initialize: function () {
            this._super();
            let initialValue = this.value();
            if(typeof initialValue != 'undefined') this.value('No existe');
            this.value(initialValue);
        },

        onUpdate: function (value){
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
                    let initVal = $('select[name="id_especialidad"]').val();
                    
                    $('select[name="id_especialidad"]').empty();
                   
                    
                    $.each(result, function (index, value) {
                        $('select[name="id_especialidad"]').append($('<option>', {
                            value: value.value,
                            text: value.label
                        }));
                    });

                    console.log(initVal);
                    
                    if($('select[name="id_especialidad"]').find('option[value="'+ initVal + '"]').length){
                        $('select[name="id_especialidad"]').val(initVal);
                    }else{
                        $('select[name="id_especialidad"]').val('').trigger('change');
                    }
                },
                complete: function(result){
                    if(typeof value == 'undefined'){
                        $('select[name="id_especialidad"]').empty();
                        $('select[name="id_especialidad"]').val('').trigger('change');
                    }
                },
            });

            return this._super();
        },
    });
});