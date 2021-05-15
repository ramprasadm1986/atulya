<?php
namespace common\modules\promo\controllers;


use Yii;
use common\models\Product;
use common\models\Category;
use common\models\Coupon;
use common\models\search\CouponSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Admin;


class SearchController extends Controller
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
                        'allow' => (Yii::$app->user->identity instanceof Admin),
                        'roles' => ['@'],
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

    /**
     * Lists all Coupon models.
     * @return mixed
     */
    public function actionProduct()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $name = Yii::$app->request->getBodyParam('name');
        if($name==null){
            return "Name is required";
        }

        $products = Product::find()->select(['sku','base_image','name'])->where(['like','name',$name])->asArray()->all();

        if($products == null){
            return [];
        }
        
        return $products;
    }
    
     public function actionCategory()
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        $name = Yii::$app->request->getBodyParam('name');
        if($name==null){
            return "Name is required";
        }

        $Category = Category::find()->select(['id','name'])->where(['like','name',$name])->asArray()->all();

        if($Category == null){
            return [];
        }
        
        return $Category;
    }
    
}