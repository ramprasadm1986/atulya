<?php
namespace backend\modules\category;

use backend\modules\category\Category;
use backend\components\SidebarMenu;

return [
    'id' => 'category',
    'class' => Category::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/catalog/category' => '/category/manage-category/index',
               
            ]
        
    ]
];