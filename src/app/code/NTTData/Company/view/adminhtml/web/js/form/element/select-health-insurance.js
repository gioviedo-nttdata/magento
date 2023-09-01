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
            let selectHealthInsuranceTypes = uiRegistry.get('index = health_insurance_type_id');
            let urlAjax =  url.build('/admin/company/employees/healthinsurancetypeoptions/');
            let initVal = selectHealthInsuranceTypes.value();

            $.ajax({
                url: urlAjax,
                type: 'POST',
                dataType: 'json',
                data: {
                    'health_insurance_id': value,
                    form_key: window.FORM_KEY
                },
                success: function(result){
                    selectHealthInsuranceTypes.options([]);
                    $.each(result, function (index, value) {
                        selectHealthInsuranceTypes.options.push({
                            value: value.value,
                            label: value.label
                        });
                    });

                    selectHealthInsuranceTypes.value(initVal);
                }
            });
            return this._super();
        },
    });
});