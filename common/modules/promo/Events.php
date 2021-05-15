<?php

namespace common\modules\promo;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
    
    class Events extends BaseObject {
    
        public static function onMenuRegister($event) {
            $event->sender->setItem([
                "id"=>"promo",
                'label' => 'Marketing',
                'icon' =>'cogs',
                'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                'sortOrder' => 50,
                "url" => '#',
                'items'=>[
                
                        [
                            'label' => "Cart Price Rules",
                            'url' => ['/promo/cart-price-rule/index'],
                            'icon' =>'plug',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 2
                        ],
                       
                
                
                ]
            ]);
        }
    
    }
    
?>