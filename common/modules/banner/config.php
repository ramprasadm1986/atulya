<?php
namespace common\modules\banner;

use common\modules\banner\Banner;

use backend\components\SidebarMenu;

return [
    'id' => 'banner',
    'class' => Banner::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/banner/slide' => '/banner/slide/index',
               
            ]
        
    ]
];