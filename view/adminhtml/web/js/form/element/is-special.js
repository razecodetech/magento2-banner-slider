define([
    'jquery',
    'Magento_Ui/js/form/element/select'
], function ($, Select) {
    'use strict';

    return Select.extend({
        defaults: {
            customName: '${ $.parentName }.${ $.index }_input'
        },
        /**
         * Change currently selected option
         *
         * @param {String} id
         */
        selectOption: function(id){
            if(($("#"+id).val() == 0)||($("#"+id).val() == undefined)) {
                $('div[data-index="video"]').hide();
                $('div[data-index="image"]').show();
            } else if($("#"+id).val() == 1) {
                $('div[data-index="image"]').hide();
                $('div[data-index="video"]').show();
            }
        },
    });
});