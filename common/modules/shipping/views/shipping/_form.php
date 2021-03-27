<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use yii\helpers\Url;
use kartik\widgets\SwitchInput;
use kartik\number\NumberControl;
/* @var $this yii\web\View */
/* @var $model common\models\ShippingMethod */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="shipping-method-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="pull-left">
                    <?= $form->field($model, 'status')->widget(SwitchInput::classname(),['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Active','offText'=>'Inactive']]) ?>                
                </div>
                <div class="pull-right">
                    <?= Html::resetButton('<i class="fa fa-refresh"></i> Reset', ['class' => 'btn btn-app']) ?>
                    <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-app']) ?>
                </div>
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
             <?= $form->field($model, 'method')->textInput(['maxlength' => true,'disabled'=>$model->is_system]) ?>
             <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
             <?= $form->field($model, 'price')->widget( NumberControl::classname(), [
                                                        'disabled'=>$model->is_system,
                                                        'maskedInputOptions' => [
                                                            'min' => 0,
                                                            'prefix' => Yii::getAlias('@currency'),
                                                            'allowMinus' => false,
                                                            'digits' => 2
                                                        ],
                                                        
                                                    ]) ?>

             
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
             <?= $form->field($model, 'is_system')->widget(SwitchInput::classname(),['disabled' => true,'pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Yes','offText'=>'No']]) ?>
             <?= $form->field($model, 'snd_price')->widget( NumberControl::classname(), [
                                                        'disabled'=>$model->is_system,
                                                        'maskedInputOptions' => [
                                                            'min' => 0,
                                                            'prefix' => Yii::getAlias('@currency'),
                                                            'allowMinus' => false,
                                                            'digits' => 2
                                                        ],
                                                        
                                                    ]) ?>
            <?= $form->field($model, 'freeship_threshold')->widget( NumberControl::classname(), [
                                                        'disabled'=>$model->is_system,
                                                        'maskedInputOptions' => [
                                                            'min' => 0,
                                                            'prefix' => Yii::getAlias('@currency'),
                                                            'allowMinus' => false,
                                                            'digits' => 2
                                                        ],
                                                        
                                                    ]) ?>             
        </div>
    

   

   

   

    

  
   

   
    
    <div class="clearfix"></div>
    </div>
    <?php ActiveForm::end(); ?>
   

</div>
