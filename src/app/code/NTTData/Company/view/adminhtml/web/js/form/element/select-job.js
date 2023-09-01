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
            let selectSpecialty = uiRegistry.get('index = specialty_id');
            let urlAjax =  url.build('/admin/company/employees/specialtyoptions/');
            let initVal = selectSpecialty.value();

            $.ajax({
                url: urlAjax,
                type: 'POST',
                dataType: 'json',
                data: {
                    'job_id': value,
                    form_key: window.FORM_KEY
                },
                success: function(result){
                    selectSpecialty.options([]);
                    $.each(result, function (index, value) {
                        selectSpecialty.options.push({
                            value: value.value,
                            label: value.label
                        });
                    });

                    selectSpecialty.value(initVal);
                }
            });
            return this._super();
        },
    });
});