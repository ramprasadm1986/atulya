<?php

namespace common\modules\trending_products;

use common\models\Product;
/**
 * trending products module definition class
 */
class TrendingProducts extends \yii\base\Module
{
     /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public function getTrendingProducts(){
             
        
        $products=Product::find()->where(['status' =>1,'is_trending'=>1])->all();
        
        
        return $products;
    }
}
