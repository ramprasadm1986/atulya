<?php

namespace common\modules\cms;

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
                            'label' => 'Page',
                            'url' => ['/cms/page/index'],
                            'icon' =>'file-text',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 1
                        ],
                        [
                            'label' => 'Block',
                            'url' => ['/cms/block/index'],
                            'icon' =>'th-large',
                            'visible' => (basename(Yii::getAlias('@app'))=="backend") && Yii::$app->user->identity,
                            'sortOrder' => 2
                        ],
                       
                
                
                ]
            ]);
        }
    
    }
    
?>