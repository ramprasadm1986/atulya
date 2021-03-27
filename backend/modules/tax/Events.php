<?php

namespace backend\modules\tax;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
    
    class Events extends BaseObject {
    
        public static function onMenuRegister($event) {
            $event->sender->setItem([
                "id" =>"tax",
                'label' => 'Tax',
                'icon' =>'calculator',
                'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                'sortOrder' => 30,
                "url" => '#',
                'items'=>[
                
                        [
                            'label' => 'Tax Rules',
                            'url' => ['/tax/tax-rule/index'],
                            'icon' =>'gavel',
                            'active' => in_array(Yii::$app->controller->route,['tax/tax-rule/index','tax/tax-rule/update','tax/tax-rule/create']),
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 1
                        ],
                        [
                            'label' => 'Tax Rates',
                            'url' => ['/tax/tax-rate/index'],
                            'icon' =>'percent',
                            'active' => in_array(Yii::$app->controller->route,['tax/tax-rate/index','tax/tax-rate/update','tax/tax-rate/create']),
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 1
                        ]         
                
                
                
                ]
            ]);
        }
    
    }
    
?>