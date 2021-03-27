<?php

namespace common\modules\banner;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
    
    class Events extends BaseObject {
    
        public static function onMenuRegister($event) {
            $event->sender->setItem([
                "id"=>"content",
                'label' => 'Content',
                'icon' =>'cubes',
                'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                'sortOrder' => 20,
                "url" => '#',
                'items'=>[
                
                        [
                            'label' => 'Banners',
                            'url' => ['/banner/slide/index'],
                            'icon' =>'image',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 3
                        ],
                       
                
                
                ]
            ]);
        }
    
    }
    
?>