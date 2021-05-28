<?php

namespace frontend\controllers;

use Yii;
use common\models\Product;
use yii\helpers\Url;
use common\models\CatalogProductReview;
use common\models\search\CatalogProductReviewSearch;




class ProductController extends \yii\web\Controller
{
    private $_CurrentProduct;
    
    private $_ProductCategories;
    
    
    public function actionIndex($slug="")
    {
        $product=Product::find()->where(['slug' => $slug])->one();
        if($product){
            
            $this->_CurrentProduct=$product;
            
            $ProductVariation=[];
            $ProductVariation['price']=[];
            $ProductVariation['ids']=[];
            
            foreach($product->catalogProductVariations as $variations){
                
                $ProductVariation['price'][$variations->combination]=$variations->price;
                $ProductVariation['ids'][$variations->combination]=$variations->id;
               
            }
            
             if (Yii::$app->hasModule('review')){
                 
                $revmodel = new CatalogProductReview();      
                $User_Review=false;
                if(Yii::$app->user->identity){
                    $user=Yii::$app->user->identity;
                    $hasReview=CatalogProductReview::find()->where(['product_id'=>$product->id,'user_id'=>$user->id])->one();
                    
                    if($hasReview){
                        
                        $revmodel = CatalogProductReview::findOne($hasReview->id);
                        $User_Review=true;
                        
                    }
                }
                return $this->render('index',['product'=>$product,'ProductVariation'=>$ProductVariation,'revmodel'=>$revmodel,'UReview'=>$User_Review]);
             }
             else
                 return $this->render('index',['product'=>$product,'ProductVariation'=>$ProductVariation]);
        }
        else{
            throw new \yii\web\NotFoundHttpException("Page not found",404);
        }
    }
    
    public function getCurrentProduct(){
           return $this->_CurrentProduct;
    }
    
    
    public function getBreadcrumbs(){
		$Breadcrumbs=array();
		$Breadcrumbs[]="<li class='breadcrumb-item'><a href='".Url::home()."'>Home</a></li>";
	
		
		$Breadcrumbs[]="<li class='breadcrumb-item active'>".$this->_CurrentProduct->name."</li>";
		
		return implode("",$Breadcrumbs);
		
	}
   

}
