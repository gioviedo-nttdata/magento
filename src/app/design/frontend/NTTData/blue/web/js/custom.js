require(['jquery', 'mage/translate'], function($, $t) {
    'use strict';
    $(document).ready(function() {
        console.log($t('Este es un texto de traducción.'));
    });
});