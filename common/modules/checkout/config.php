<?php
namespace common\modules\checkout;

use common\modules\checkout\Checkout;


return [
    'id' => 'checkout',
    'class' => Checkout::className(), 
    'urlManagerRules' => [
        
        'frontend'=>[
                '/cart' => '/checkout/cart/index',
                '/cart/index' => '/checkout/cart/index',
                '/cart/add' => '/checkout/cart/add',
                '/cart/remove-item' => '/checkout/cart/remove-item',
                '/cart/updatequantity' => '/checkout/cart/updatequantity',
                '/checkout/onepage' => '/checkout/onepage/index',
                '/checkout/onepage/setshipping' => '/checkout/onepage/setshipping',
                '/checkout/onepage/return' => '/checkout/onepage/return',
                '/checkout/onepage/paynimoreturn' => '/checkout/onepage/paynimoreturn',
                '/checkout/onepage/cancel' => '/checkout/onepage/cancel',
                '/checkout/success' => '/checkout/success/index', 
                '/checkout/onepage/ordersessioncheck' => '/checkout/onepage/ordersessioncheck',
                '/checkout/onepage/getordersession' => '/checkout/onepage/getordersession',
               
            ]
        
    ]    
];