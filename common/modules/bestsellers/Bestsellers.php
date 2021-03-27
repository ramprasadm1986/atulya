<?php

namespace common\modules\bestsellers;


use common\models\Product;
/**
 * bestsellers module definition class
 */
class Bestsellers extends \yii\base\Module
{
     /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    
    public function getBestsellers(){
             
        
        $products=Product::find()->where(['status' =>1,'is_bestseller'=>1])->all();
        
        
        return $products;
    }
}
