<?php

namespace common\modules\order;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
    
    class Events extends BaseObject {
    
        public static function onMenuRegister($event) {
            
            $event->sender->setItem([
                "id"=>"sales",
                'label' => 'Sales',
                'icon' =>'th-list',
                'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                'sortOrder' => 10,
                "url" => '#',
                'items'=>[
                
                        [
                            'label' => 'Orders (Placed)',
                            'url' => ['/order/orders/index'],
                            'icon' =>'list-alt',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 2
                        ],
                        [
                            'label' => 'Orders (Processing)',
                            'url' => ['/order/orders/processing'],
                            'icon' =>'list-alt',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 3
                        ],
                        [
                            'label' => 'Orders (Ready to Ship)',
                            'url' => ['/order/orders/readytoship'],
                            'icon' =>'list-alt',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 3
                        ],
                        [
                            'label' => 'Orders (Shipped)',
                            'url' => ['/order/orders/shipped'],
                            'icon' =>'list-alt',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 3
                        ],
                        [
                            'label' => 'Orders (Payment Pending)',
                            'url' => ['/order/orders/pending'],
                            'icon' =>'list-alt',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 3
                        ],
                      
                
                
                ]
            ]);
        }
    
    }
    
?>