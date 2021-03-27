<?php
namespace common\modules\order;

use common\modules\order\Order;
use backend\components\SidebarMenu;

return [
    'id' => 'order',
    'class' => Order::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/orders' => '/order/orders/index',
                '/orders/processing' => '/order/orders/processing',
                '/orders/readytoship' => '/order/orders/readytoship',
                '/orders/shipped' => '/order/orders/shipped',
                '/orders/pending' => '/order/orders/pending',
                '/orders/view' => '/order/orders/view',
                '/orders/invoice' => '/order/orders/invoice',
                '/orders/shippinglist' => '/order/orders/shippinglist',
                '/orders/shiplabel' => '/order/orders/shiplabel',
                '/orders/packagingslip' => '/order/orders/packagingslip',
               
               
            ]
        
    ]
];