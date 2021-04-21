<?php

namespace common\modules\banner;

use common\models\HomeBanner;

/**
 * banner module definition class
 */
class Banner extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\banner\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public function getHomeBanners(){
        $banners=HomeBanner::find()->where(['status' =>1])->orderBy(['update_at' => SORT_DESC])->all();
        
        
        return $banners;
    }
    
}
