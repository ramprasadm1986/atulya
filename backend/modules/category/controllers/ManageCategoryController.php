<?php

namespace backend\modules\category\controllers;

use Yii;
use common\models\CatalogCategory;
use common\models\search\CatalogCategorySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * MedicineCategoryController implements the CRUD actions for MedicineCategory model.
 */
class ManageCategoryController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                   
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all MedicineCategory models.
     * @return mixed
     */
    public function actionIndex()
    {
	   return $this->render('index');
    }

}
