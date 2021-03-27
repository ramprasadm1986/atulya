<?php

namespace backend\modules\category;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
    
    class Events extends BaseObject {
    
        public static function onMenuRegister($event) {
            $event->sender->setItem([
                "id"=>"catalog",
                'label' => 'Catalog',
                'icon' =>'th-list',
                'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                'sortOrder' => 10,
                "url" => '#',
                'items'=>[
                
                        [
                            'label' => 'Categories',
                            'url' => ['/category/manage-category/index'],
                            'icon' =>'list-alt',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 1
                        ],
                       
                
                
                ]
            ]);
        }
    
    }
    
?>