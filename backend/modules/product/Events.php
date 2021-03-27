<?php

namespace backend\modules\product;

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
                            'label' => 'All Products',
                            'url' => ['/product/manage-product/index'],
                            'icon' =>'list-alt',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 2
                        ],
                        [
                            'label' => 'Add New Product',
                            'url' => ['/product/manage-product/create'],
                            'icon' =>'plus-circle',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 3
                        ],
                       
                
                
                ]
            ]);
        }
    
    }
    
?>