<?php
namespace common\modules\shipping;

use common\modules\shipping\Shipping;
use backend\components\SidebarMenu;

return [
    'id' => 'shipping',
    'class' => Shipping::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/shipping' => '/shipping/shipping/index',
               
            ]
        
    ]
];