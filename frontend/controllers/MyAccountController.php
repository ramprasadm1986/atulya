<?php

namespace frontend\controllers;



use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\User;
use common\models\Order;


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
        $user=Yii::$app->user->identity;
        
        
        $orders=Order::find()->where(['user_id'=>$user->id])->andWhere(['>', 'status',0])->all();
        return $this->render('index', [
            'orders' => $orders
        ]);
        
    }

    public function actionOrders($id)
    {
        $order=Order::find()->where(['id'=>$id])->andWhere(['>', 'status',0])->one();
        return $this->render('orders',['order'=>$order]);
    }

    public function actionProfile()
    {
        return $this->render('profile');
    }

}
