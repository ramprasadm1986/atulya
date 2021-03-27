<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use yii\helpers\ArrayHelper;

use common\models\TaxRate;
use kartik\select2\Select2;


/* @var $this yii\web\View */
/* @var $model common\modules\tax\models\TaxRule */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tax-rule-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <div class="row">
    
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
    
             <? $tax_identifire= ArrayHelper::map(TaxRate::find()->orderBy(['rate' => SORT_ASC])->asArray()->all(), 'id', 'tax_identifire'); ?>


           
            <?= $form->field($model, 'tax_class_name')->textInput(['maxlength' => true]) ?>
           
            <?= $form->field($model, 'tax_rate_ids')->widget(Select2::classname(), [
                                                    'data' => $tax_identifire,
                                                    'size' => Select2::LARGE,
                                                    'options' => ['placeholder' => false, 'multiple' => true],
                                                    'maintainOrder' => true,
                                                    'pluginOptions' => [
                                                        'allowClear' => true,
                                                        'tags'=>true,
                                                        
                                                       
                                                    ],
                                                    'toggleAllSettings' => [
                                                       'selectLabel' => '<i class="glyphicon glyphicon-unchecked"></i> Select all',
                                                       'unselectLabel' => '<i class="glyphicon glyphicon-checked"></i> Unselect all',
                                                       'selectOptions' => ['class' => 'text-success'],
                                                       'unselectOptions' => ['class' => 'text-danger'],
                                                    ],
                                                ]); 
                                           ?>
    
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
