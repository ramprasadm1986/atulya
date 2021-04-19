<?php

namespace frontend\controllers;
use common\models\Product;
use yii\helpers\Url;


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
