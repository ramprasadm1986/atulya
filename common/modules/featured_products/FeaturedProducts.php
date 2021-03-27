<?php

namespace common\modules\featured_products;

use common\models\Product;
/**
 * featured products module definition class
 */
class FeaturedProducts extends \yii\base\Module
{
    

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    public function getFeaturedProducts(){
             
        
        $products=Product::find()->where(['status' =>1,'is_featured'=>1])->all();
        
        
        return $products;
    }
    
}
