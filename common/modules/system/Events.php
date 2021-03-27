<?php

namespace common\modules\system;

use Yii;
use yii\base\BaseObject;
use yii\helpers\Html;
    
    class Events extends BaseObject {
    
        public static function onMenuRegister($event) {
            $event->sender->setItem([
                "id"=>"system",
                'label' => 'System',
                'icon' =>'cogs',
                'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                'sortOrder' => 50,
                "url" => '#',
                'items'=>[
                
                        [
                            'label' => 'Modules',
                            'url' => ['/system/module/index'],
                            'icon' =>'plug',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 2
                        ],
                       
                
                
                ]
            ]);
        }
    
    }
    
?>