<?php
namespace common\modules\review;

use common\modules\review\Review;
use backend\components\SidebarMenu;

return [
    'id' => 'review',
    'class' => Review::className(),
    'urlManagerRules' => [
        
        'frontend'=>[
                '/review/add' => '/review/review/create',
                '/review/edit/<id>' => '/review/review/update',
                '/review/delete/<id>' => '/review/review/delete',
        ]
    ]
    
];
