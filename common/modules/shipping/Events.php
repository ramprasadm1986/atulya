<?php

namespace common\modules\shipping;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
    
    class Events extends BaseObject {
    
        public static function onMenuRegister($event) {
            $event->sender->setItem([
                "id"=>"shipping",
                'label' => 'Shipping',
                'icon' =>'truck',
                'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                'sortOrder' => 40,
                "url" => '#',
                'items'=>[
                        [
                            'label' => 'Shipping Methods',
                            'url' => ['/shipping/shipping/index'],
                            'icon' =>'plug',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 1
                        ],
                      
                       
                
                
                ]
            ]);
        }
    
    }
    
?>