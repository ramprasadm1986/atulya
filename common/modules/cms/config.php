<?php
namespace common\modules\cms;

use common\modules\cms\Cms;
use backend\components\SidebarMenu;

return [
    'id' => 'cms',
    'class' => Cms::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/cms/page' => '/cms/page/index',
                '/cms/block' => '/cms/block/index',
               
            ]
        
    ]
];