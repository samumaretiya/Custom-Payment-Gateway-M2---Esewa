define(
    [
		'Magento_Checkout/js/view/payment/default',
		'Magento_Checkout/js/model/full-screen-loader',
        'jquery',
    ],
    function (Component, fullScreenLoader, $ ) {
   
		'use strict';

        return Component.extend({
            
			defaults: {
                template: 'Samumaretiya_Esewa/payment/esewa-form'
            },

            getCode: function() {
                return 'samumaretiya_esewa';
            },
			
			/*placeOrder: function (data, event) {
				var self = this;

				if (event) {
					event.preventDefault();
				}
				$('#esewaform').submit();
				fullScreenLoader.startLoader();
				return false;
			},
			*/
		});
    }
);
