<?php
namespace backend\modules\product;

use backend\modules\product\Product;
use backend\components\SidebarMenu;

return [
    'id' => 'product',
    'class' => Product::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/catalog/product' => '/product/manage-product/index',
                '/catalog/product/create' => '/product/manage-product/create',
                '/catalog/product/update' => '/product/manage-product/update',
               
            ]
        
    ]
];