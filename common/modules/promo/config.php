<?php
namespace common\modules\promo;

use common\modules\promo\Promo;
use backend\components\SidebarMenu;

return [
    'id' => 'promo',
    'class' => Promo::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/cart-price-rule/index' => '/promo/cart-price-rule/index',
                '/promo/search/product' => '/promo/search/product',
                '/promo/search/category' => '/promo/search/category',
               
            ]
        
    ]
];