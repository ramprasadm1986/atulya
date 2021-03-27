<?php

namespace backend\modules\product\controllers;

use Yii;
use common\models\Model;
use common\models\CatalogProduct;
use common\models\CatalogProductAttribute as CPAttributes;
use common\models\CatalogProductAttributesOption as CPOptions;
use common\models\CatalogProductVariation as CPVariation;

use common\models\search\CatalogProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;

/**
 * ManageProductController implements the CRUD actions for CatalogProduct model.
 */
class ManageProductController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all CatalogProduct models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CatalogProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

  
    /**
     * Creates a new CatalogProduct model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CatalogProduct();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            if(Yii::$app->request->post()['saveandcontinue'])
                return $this->redirect(['update', 'id' => $model->id]);
            else
                return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);

    }

    /**
     * Updates an existing CatalogProduct model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)

    {

        $model = $this->findModel($id);

        $modelsCPAttributes = $model->catalogProductAttributes;
        
        $modelsCPVariation = $model->catalogProductVariations;

        $modelsCPOptions = [];

        $OldCPOptions = [];


        if (!empty($modelsCPAttributes)) {

            foreach ($modelsCPAttributes as $indexCPAttributes => $modelCPAttributes) {

                $CPOptions = $modelCPAttributes->catalogProductAttributesOptions;

                $modelsCPOptions[$indexCPAttributes] = $CPOptions;

                $OldCPOptions = ArrayHelper::merge(ArrayHelper::index($CPOptions, 'id'), $OldCPOptions);

            }

        }


        if ($model->load(Yii::$app->request->post())) {

            $valid = $model->validate();
            
            if($valid)
                $model->save();
            
            if($model->type=="variable"){
                // reset

                $modelsCPOptions = [];


                $oldCPAttributesIDs = ArrayHelper::map($modelsCPAttributes, 'id', 'id');
                
                $oldCPVariationIDs = ArrayHelper::map($modelsCPVariation, 'id', 'id');

                $modelsCPAttributes = Model::createMultiple(CPAttributes::classname(), $modelsCPAttributes,true);
                
                $modelsCPVariation = Model::createMultiple(CPVariation::classname(), $modelsCPVariation,false);

                Model::loadMultiple($modelsCPAttributes, Yii::$app->request->post());
                
                Model::loadMultiple($modelsCPVariation, Yii::$app->request->post());

                $deletedCPAttributesIDs = array_diff($oldCPAttributesIDs, array_filter(ArrayHelper::map($modelsCPAttributes, 'id', 'id')));
                
                $deletedCPVariationIDs = array_diff($oldCPVariationIDs, array_filter(ArrayHelper::map($modelsCPVariation, 'id', 'id')));


                // validate person and houses models

                
                
                $valid = Model::validateMultiple($modelsCPAttributes) && Model::validateMultiple($modelsCPVariation) && $valid;


                $CPOptionsIDs = [];

                if (isset($_POST['CatalogProductAttributesOption'])) {

                    foreach ($_POST['CatalogProductAttributesOption'] as $indexCPAttributes => $CPOptions) {

                        $CPOptionsIDs = ArrayHelper::merge($CPOptionsIDs, array_filter(ArrayHelper::getColumn($CPOptions, 'id')));

                        foreach ($CPOptions as $indexCPOptions => $modelCPOptions) {

                            $data['CatalogProductAttributesOption'] = $modelCPOptions;
                            
                            

                            $modelCPOption = (isset($modelCPOptions['id']) && isset($OldCPOptions[$modelCPOptions['id']])) ? $OldCPOptions[$modelCPOptions['id']] : new CPOptions;
                          
                            
                            $modelCPOption->load($data);
                            
                            

                            $modelsCPOptions[$indexCPAttributes][$indexCPOptions] = $modelCPOption;

                            $valid = $modelCPOption->validate();

                        }

                    }

                }
                
              
               

                $OldCPOptionsIDs = ArrayHelper::getColumn($OldCPOptions, 'id');

                $deletedCPOptionsIDs = array_diff($OldCPOptionsIDs, $CPOptionsIDs);


                if ($valid) {

                    $transaction = Yii::$app->db->beginTransaction();

                    try {

                        if ($flag = $model->save(false)) {


                            if (! empty($deletedCPOptionsIDs)) {

                                CPOptions::deleteAll(['id' => $deletedCPOptionsIDs]);

                            }


                            if (! empty($deletedCPAttributesIDs)) {

                                CPAttributes::deleteAll(['id' => $deletedCPAttributesIDs]);

                            } 
                            
                            
                            if (! empty($deletedCPVariationIDs)) {

                                CPVariation::deleteAll(['id' => $deletedCPVariationIDs]);

                            }
                            
                            foreach($modelsCPVariation as $indexCPVariation=>$modelCPVariation){
                                if ($flag === false) {

                                    break;

                                }
                                
                                $modelCPVariation->product_id = $model->id;


                                if (!($flag = $modelCPVariation->save(false))) {

                                    break;

                                }
                                
                                
                            }
                            foreach ($modelsCPAttributes as $indexCPAttributes => $modelCPAttributes) {


                                if ($flag === false) {

                                    break;

                                }


                                $modelCPAttributes->product_id = $model->id;


                                if (!($flag = $modelCPAttributes->save(false))) {

                                    break;

                                }


                                if (isset($modelsCPOptions[$indexCPAttributes]) && is_array($modelsCPOptions[$indexCPAttributes])) {

                                    foreach ($modelsCPOptions[$indexCPAttributes] as $indexCPOptions => $CPOptions) {

                                        $CPOptions->attribute_id = $modelCPAttributes->id;

                                        if (!($flag = $CPOptions->save(false))) {

                                            break;

                                        }

                                    }

                                }

                            }

                        }


                        if ($flag) {

                            $transaction->commit();

                           if(Yii::$app->request->post()['saveandcontinue'])
                                return $this->redirect(['update', 'id' => $model->id]);
                            else
                                return $this->redirect(['index']);

                        } else {

                            $transaction->rollBack();

                        }

                    } catch (Exception $e) {

                        $transaction->rollBack();

                    }

                }
            }

        }

       
        
        foreach($modelsCPOptions as $key=>$cmodel){
            
            $modelsCPOptions[$key]=(empty($cmodel)) ?[ new CPOptions ] : $cmodel;
            
        }
        
        return $this->render('update', [

            'model' => $model,

            'CPAttributes' => (empty($modelsCPAttributes)) ? [new CPAttributes] : $modelsCPAttributes,

            'CPOptions' =>(empty($modelsCPOptions)) ? [[new CPOptions]] : $modelsCPOptions,
            
            'CPVariation' => $modelsCPVariation,

        ]);

    }

    /**
     * Deletes an existing CatalogProduct model.
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
     * Finds the CatalogProduct model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CatalogProduct the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CatalogProduct::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
