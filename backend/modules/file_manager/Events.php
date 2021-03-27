<?php

namespace backend\modules\file_manager;

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
                            'label' => 'Media Manager',
                            'url' => ['/filemanager/file-manager/index'],
                            'icon' =>'file-text',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 4
                        ],
                       
                       
                
                
                ]
            ]);
        }
       
    
    }
    
?>