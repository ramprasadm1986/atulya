<?php

namespace common\modules\system\controllers;

use Yii;
use yii\base\Model;
use common\models\ClassModules;
use common\models\search\ClassModulesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use backend\models\Admin;

/**
 * ModuleController implements the CRUD actions for ClassModules model.
 */
class ModuleController extends Controller
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
     * Lists all ClassModules models.
     * @return mixed
     */
    public function actionIndex()
    {
       $models = ClassModules::find()->indexBy('id')->all();

        if (Model::loadMultiple($models, Yii::$app->request->post()) && Model::validateMultiple($models)) {
            foreach ($models as $model) {
                $model->save(false);
            }
            Yii::$app->cache->flush();
            return $this->redirect('settings');
        }

        return $this->render('index', ['models' => $models]);
    }

    

    
}
