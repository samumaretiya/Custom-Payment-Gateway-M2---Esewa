define(
    [
        'uiComponent',
        'Magento_Checkout/js/model/payment/renderer-list'
    ],
    function (
        Component,
        rendererList
    ) {
        'use strict';
        rendererList.push(
            {
                type: 'samumaretiya_esewa',
                component: 'Samumaretiya_Esewa/js/view/payment/method-renderer/esewa-method'
            }
        );
        /** Add view logic here if needed */
        return Component.extend({});
    }
);