<?php

namespace common\controllers;

use Yii;
use common\models\ClassCountry;
use common\models\ClassState;
use common\models\ClassCity;


use yii\helpers\ArrayHelper;


class AddressHelperController extends \yii\web\Controller
{
    
    public function actionState()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $country_code = $parents[0];
                $param1 = false;
                $param2 = '';
                
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0];
                    if(isset($params[1]))
                    $param2 = $params[1];
                   
                }
                
                $out=ClassState::find()->select('iso2 as id,name')->where(['country_code'=>$country_code])->orderBy(['name' => SORT_ASC])->asArray()->all();
                
                if($param1)
                    return ['output' => array_merge([["id"=>"*",'name'=>'*']],$out),'selected' => $param2];
                else
                   return ['output' =>$out,'selected' => $param2 ]; 
            }
        }
        return ['output' => [["id"=>"*",'name'=>'*']], 'selected' => '*'];
        
    }
    
    public function actionCity()
    {
         
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $country_code = $parents[0];
                $state_code = $parents[1];
                $param1 = false;
                $param2 = '';
                
                if (!empty($_POST['depdrop_params'])) {
                    $params = $_POST['depdrop_params'];
                    $param1 = $params[0];
                    if(isset($params[1]))
                    $param2 = $params[1];
                   
                }
                
                $out=ClassCity::find()->select('name as id,name')->where(['country_code'=>$country_code,'state_code'=>$state_code])->orderBy(['name' => SORT_ASC])->asArray()->all();
                
                if($param1)
                    return ['output' => array_merge([["id"=>"*",'name'=>'*']],$out),'selected' =>$param2];
                else
                   return ['output' =>$out,'selected' => '']; 
            }
        }
        return ['output' => '', 'selected' => $param2];
    }

    

}
