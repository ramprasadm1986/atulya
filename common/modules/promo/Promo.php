<?php

namespace common\modules\promo;

use Yii;
use backend\models\Admin;
use common\models\Coupon;
/**
 * promo module definition class
 */
class Promo extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\promo\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
        //if(Yii::$app->user->identity instanceof Admin){
        $this->setAliases([
            '@promo-assets' => __DIR__ . '/web/'
        ]); 
       // }   
    }
    
    public function validateCouponCode($code){
        
        $coupon=Coupon::find()->where(['code'=>strtoupper($code),'active'=>1])->one();
        if($coupon){
            $today = date('Y-m-d');
            $today=date('Y-m-d', strtotime($today));
            $start=date('Y-m-d', strtotime($coupon->start_on));
            $end=date('Y-m-d', strtotime($coupon->expire_on));
                if($start && !$end){
                    
                    if($today >= $start)
                        return $coupon;
                    else
                        return false;
                    
                }
                else if(!$start && $end){
                    
                    if($today <= $end)
                        return $coupon;
                    else
                        return false;
                    
                }
                else if($start && $end){
                    
                    if($today >= $start && $today <= $end)
                        return $coupon;
                    else
                        return false;
                }
                else{
                    return $coupon;
                }
            
        }
        else 
        return false;
        
    }
}
