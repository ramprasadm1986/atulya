<?php

namespace frontend\controllers;

use Yii;
use common\models\CmsPage;
use common\models\search\CmsPageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;



class CmsPageController extends \yii\web\Controller
{
   
    
    
    public function actionIndex($slug="")
    {
        $page=CmsPage::find()->where(['slug' => $slug])->one();
        if($page){
            
         
           
            return $this->render('index',['page'=>$page]);
            
        }
        else{
            throw new \yii\web\NotFoundHttpException("Page not found",404);
        }
    }
    
    
    
   

}