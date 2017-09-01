define(
    [
		'Magento_Checkout/js/view/payment/default',
		'Magento_Checkout/js/model/full-screen-loader',
        'jquery',
		'mage/url',
		
    ],
    function (Component, fullScreenLoader, $ ,url) {
   
		'use strict';
		 
		var url = url.build('esewa/index/index');
        
		return Component.extend({
            
			defaults: {
                template: 'Samumaretiya_Esewa/payment/esewa-form'
            },

            getCode: function() {
                return 'samumaretiya_esewa';
            },
			placeOrder: function (data, event) {
				fullScreenLoader.startLoader();
				window.location.href = url;
			},
		});
    }
);
