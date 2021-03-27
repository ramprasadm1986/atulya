<?php
namespace backend\modules\file_manager;

use backend\modules\file_manager\FileManager;
use backend\components\SidebarMenu;

return [
    'id' => 'filemanager',
    'class' => FileManager::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/file-manager' => '/filemanager/file-manager/index',
                '/file-manager/frame' => '/filemanager/file-manager/frame',
               
               
            ]
        
    ]
];