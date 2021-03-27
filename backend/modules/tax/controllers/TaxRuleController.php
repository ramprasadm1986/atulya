<?php

namespace backend\modules\tax\controllers;

use Yii;
use common\models\TaxRule;
use common\models\search\TaxRuleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * TaxRuleController implements the CRUD actions for TaxRule model.
 */
class TaxRuleController extends Controller
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
     * Lists all TaxRule models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TaxRuleSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new TaxRule model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TaxRule();
       
        if ($model->load(Yii::$app->request->post())) {
             $model->tax_rate_ids = implode (",",$model->tax_rate_ids);
             $model->save();
            return $this->redirect(['index']);
        }
        
        $model->tax_rate_ids=explode(',',$model->tax_rate_ids);
        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TaxRule model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            
            $model->tax_rate_ids = implode (",",$model->tax_rate_ids);
            $model->save();
            return $this->redirect(['index']);
        }
        $model->tax_rate_ids=explode(',',$model->tax_rate_ids);
        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TaxRule model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TaxRule model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TaxRule the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TaxRule::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
