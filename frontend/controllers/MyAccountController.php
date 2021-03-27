<?php

namespace frontend\controllers;



use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;

class MyAccountController extends \yii\web\Controller
{
    
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => (Yii::$app->user->identity instanceof User),
                        'roles' => ['@'],
                    ],
                   
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
               
            ],
        ];
    }
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionOrders()
    {
        return $this->render('orders');
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

}
