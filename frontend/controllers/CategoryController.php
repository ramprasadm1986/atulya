<?php

namespace frontend\controllers;
use frontend\models\CatalogCategory;
use common\models\Product;
use yii\helpers\Url;

use yii\data\Pagination;


class CategoryController extends \yii\web\Controller
{
    
    private $_CurrentCategory;
    
    
    public function actionIndex($slug="")
    {
        
        if($slug==""){
           $slug="all-categories";
        }
            $data=[];
			$products = array();
			$category=CatalogCategory::find()->where(['slug' => $slug])->one();
           
            if($category){
                
                $this->_CurrentCategory=$category;
                $leaves = $category->leaves()->asArray()->all();                
                
                $data['CategoryFiletrs']=[];      
                
                $query=Product::find()->where(['status'=>1])->andWhere([ 'OR', ['like','categories', ",".$this->_CurrentCategory->id.","],['like','categories', "%,".$this->_CurrentCategory->id,false],['like','categories', $this->_CurrentCategory->id.",%",false],['like','categories', $this->_CurrentCategory->id,false]]);

                $countQuery = clone $query;
                
                
                
                $pages = new Pagination(['totalCount' => $countQuery->count(),'pageSize'=>9]);
                
                $products=Product::find()->where(['status'=>1])->andWhere([ 'OR', ['like','categories', ",".$this->_CurrentCategory->id.","],['like','categories', "%,".$this->_CurrentCategory->id,false],['like','categories', $this->_CurrentCategory->id.",%",false],['like','categories', $this->_CurrentCategory->id,false]])->limit($pages->limit)->offset($pages->offset)->all();
                
               return $this->render('index',['products'=>$products,'pages' => $pages]);
            }
            else{
                throw new \yii\web\NotFoundHttpException("Page not found",404);
            }
			
        
        
        
        
        
        
        
    }
    
    public function getCurrentCategory(){
           return $this->_CurrentCategory;
    }
    
    public function getBreadcrumbs(){
		$Breadcrumbs=array();
		$Breadcrumbs[]="<li class='breadcrumb-item'><a href='".Url::home()."'>Home</a></li>";
		$currentCategory = CatalogCategory::findOne(['id' => $this->_CurrentCategory->id]);
		$parents = $currentCategory->parents()->all();
		
		foreach($parents as $parent){			
			if($parent->lvl){
			$Breadcrumbs[]="<li class='breadcrumb-item'><a href='".Url::toRoute(['/category/'.$parent->slug])."'>".$parent->name."</a></li>";
			}
		}
		
		$Breadcrumbs[]="<li class='breadcrumb-item active'>".$this->_CurrentCategory->name."</li>";
		
		return implode("",$Breadcrumbs);
		
	}
    
    public  function getCategoryFiletrs(){
		
		$currentCategoryChilds = CatalogCategory::getCategoryFiletrs($this->_CurrentCategory->id); 
		
	
		return $currentCategoryChilds;
	}
    
    
   
    
}
