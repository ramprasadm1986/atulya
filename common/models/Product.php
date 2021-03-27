<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

class Product extends CatalogProduct
{
    public function getCartSalePrice($variations=null){
        
        $price=$this->price;
        
        if($this->is_special_price){            
            
            if(time() >= strtotime($this->special_price_from) && !$this->special_price_to)
                $price=$this->special_price;
            else if(time() >= strtotime($this->special_price_from) && time() <= strtotime($this->special_price_to))
                $price=$this->special_price;          
            
        }
        if($variations!=""){
            $session = Yii::$app->session;
            $session->open();
            Yii::$app->session->set('variant',$variations);
            $Variant=$this->variationPrice;
            if($Variant)
              $price=$Variant->price; 
            Yii::$app->session->remove('variant');
        }
        
        return $price;
    }
    
    public function getSalePrice($template=""){
        
        $price=$this->price;
        
        if($this->is_special_price){
            
            $special_price=false;
            if(time() >= strtotime($this->special_price_from) && !$this->special_price_to){
                $price=$this->special_price;
                $special_price=true;
            }
            else if(time() >= strtotime($this->special_price_from) && time() <= strtotime($this->special_price_to)){
                $price=$this->special_price;
                $special_price=true;
            }
            
            
            if ($template!=""){
                
                $template= str_replace("{{sell_price}}",Yii::getAlias('@currency').$price,$template);
                
                if($special_price)
                    $template= str_replace("{{price}}",Yii::getAlias('@currency').$this->price,$template);
                else
                    $template= str_replace("{{price}}","",$template);
            }
            else
                $template="<strike>".Yii::getAlias('@currency').$this->price. "</strike> ". Yii::getAlias('@currency').$price; 
            
           if($this->type!="variable")
                return $template;
        }
        if ($template!=""){
            $template= str_replace("{{sell_price}}",Yii::getAlias('@currency').$price,$template);
            $template= str_replace("{{price}}","",$template);
        }
        else
            $template=Yii::getAlias('@currency').$price;
        
        
        if($this->type!="variable")
            return $template;       
     
        
            $v_min_price=$this->variationsMin;
            $v_max_price=$this->variationsMax;
           
            return Yii::getAlias('@currency').$v_min_price." - ".Yii::getAlias('@currency').$v_max_price;
        
    }
    
    public function IsVariable(){
        
        if($this->type=="variable"){
            return true;
        }
        return false;
    }
     public static function find()
    {
         return parent::find();
    }
    
    public function getImage(){
        return $this->base_image;
    }
    
    public function getGalleryImages(){
        
        return explode(",",$this->gallery_images);
    }
    
    public function getCategories(){
        
        $categories=[];
        $datas= Category::find()->where(['in', 'id', explode(",",$this->categories)])->all();
        
        foreach($datas as $cat){
            if($cat->id!=1)
            $categories[]="<a href='".Url::toRoute(['/category/'.$cat->slug])."'>$cat->name</a>";
        }
        
        return implode(", ",$categories);
        
    }
}
