<?php

namespace common\modules\checkout\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\User;


class SuccessController extends Controller
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
                        
                        'allow' => (Yii::$app->user->isGuest || Yii::$app->user->identity instanceof User),
                       
                    ],
                   
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
   
    public function actionIndex(){
                $session = Yii::$app->session;
                $session->open();            
                $OrderIdentifire=Yii::$app->session->get('OrderIdentifire');
                Yii::$app->session->remove('OrderIdentifire');
                return $this->render('success',['OrderIdentifire' => $OrderIdentifire]);
        
    }
}