<?php
namespace common\modules\system;

use common\modules\system\System;
use backend\components\SidebarMenu;

return [
    'id' => 'system',
    'class' => System::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/module/settings' => '/system/module/index',
               
            ]
        
    ]
];