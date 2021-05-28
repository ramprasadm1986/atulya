<?php

namespace common\modules\review;


use common\models\Product;
use common\models\User;
use common\models\CatalogProductReview;
/**
 * review module definition class
 */
class Review extends \yii\base\Module
{
     /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
    
    
    public function getReviews($id){
        return CatalogProductReview::find()->where(['product_id'=>$id])->all();
    }
    
    public function getReviewCount($id){
        
        return CatalogProductReview::find()->where(['product_id'=>$id])->count();
    }
    public function getAvgReview($id){
     
        return CatalogProductReview::find()->where(['product_id'=>$id])->average('rating');
        
    }
    
    
}
