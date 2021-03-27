<?php
namespace backend\modules\tax;

use backend\modules\tax\Tax;
use backend\components\SidebarMenu;


return [
    'id' => 'tax',
    'class' => Tax::className(),
    'events' => [
        ['class' => SidebarMenu::className(), 'event' => SidebarMenu::REGISTER, 'callback' => [Events::className(), 'onMenuRegister']],
    ],
    'urlManagerRules' => [
        
        'backend'=>[
                '/tax-rule' => '/tax/tax-rule/index',
                '/tax-rule/update' => '/tax/tax-rule/update',
                '/tax-rule/create' => '/tax/tax-rule/create',
                '/tax-rate' => '/tax/tax-rate/index',
                '/tax-rate/update' => '/tax/tax-rate/update'
            ]
        
    ]
];