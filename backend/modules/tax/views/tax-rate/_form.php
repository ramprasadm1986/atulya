<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


use yii\widgets\ActiveForm;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use yiister\gentelella\widgets\Panel;


use common\models\ClassCountry;
use common\models\ClassState;
use common\models\ClassCity;




/* @var $this yii\web\View */
/* @var $model common\modules\tax\models\TaxRate */
/* @var $form yii\widgets\ActiveForm */
?>

     
<div class="tax-rate-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
        

        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            
            <?= Html::hiddenInput('selected_state_id', $model->isNewRecord ? '' : $model->state, ['id'=>'selected_state_id']); ?>
            <?= Html::hiddenInput('selected_city_id', $model->isNewRecord ? '' : $model->city, ['id'=>'selected_city_id']); ?>
            <?= Html::hiddenInput('is_star_state', false, ['id' => 'is_star_state']); ?>
            <?= Html::hiddenInput('is_star_city', true, ['id' => 'is_star_city']); ?>
            
            <?= $form->field($model, 'country')->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(ClassCountry::find()->where(['iso2'=>explode(",",Yii::getAlias('@AllowedCountry'))])->all(), 'iso2', 'name'),
                                                'options' => ['id'=>'country-id'],
                                                
                                                'pluginOptions' => [
                                                    'placeholder'=>"Select Country",
                                                    'allowClear' => true
                                                ],
                                            ]); 
                                       ?>

            <?= $form->field($model, 'state')->widget(DepDrop::classname(), [
                        'data' => $model->isNewRecord ? ["*" => '*'] : ArrayHelper::map(ClassState::find()->where(['country_code'=>$model->country])->orderBy(['name' => SORT_ASC])->all(), 'iso2', 'name'),
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => ['id' => 'state-id'],
                        'select2Options' => ['pluginOptions' => ['placeholder'=>false,'allowClear' => true]],
                        'pluginOptions' => [
                            'placeholder'=>"Select State",
                            'depends' => ['country-id'],
                            'url' => Url::to(['/address-helper/state']),
                            'params' => ['is_star_state','selected_state_id']
                        ]
                    ]); ?>

            <?= $form->field($model, 'city')->widget(DepDrop::classname(), [
                       'data' => $model->isNewRecord ? ["*" => '*'] : ArrayHelper::merge(["*"=>"*"],ArrayHelper::map(ClassCity::find()->where(['country_code'=>$model->country,'state_code'=>$model->state])->orderBy(['name' => SORT_ASC])->all(), 'name', 'name')),
                       'type' => DepDrop::TYPE_SELECT2,
                       'options' => ['id' => 'city-id'],
                       'select2Options' => ['pluginOptions' => ['placeholder'=>false,'allowClear' => true]],
                       'pluginOptions' => [
                            'placeholder'=>false,
                            'depends' => ['country-id','state-id'],
                            'url' => Url::to(['/address-helper/city']),
                            'params' => ['is_star_city','selected_city_id']
                       ]
                   ]); ?>

            <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="form-group col-md-6 col-sm-6 col-xs-12">    
            
            
            <?= $form->field($model, 'tax_identifire')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'tax_name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'rate')->widget( NumberControl::classname(), [
                                                        'maskedInputOptions' => [
                                                            'min' => 0,
                                                            'max' => 100,
                                                            'suffix' => ' %',
                                                            'allowMinus' => false,
                                                            'digits' => 2
                                                        ],
                                                        
                                                    ]) ?>
            
        </div>
        
        
        
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-app']) ?>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
        