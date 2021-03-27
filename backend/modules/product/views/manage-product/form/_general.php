<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\widgets\SwitchInput;
use kartik\select2\Select2;
use kartik\number\NumberControl;

use yii\helpers\ArrayHelper;

use common\models\ClassProduct;

?>

<div class="row">

    <div class="form-group col-md-6 col-sm-6 col-xs-12">        
        
         <?= $form->field($model, 'status')->widget(SwitchInput::classname(),['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Active','offText'=>'Inactive']]) ?>
         
        <?= $form->field($model, 'type')->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(ClassProduct::find()->all(), 'code', 'name'),
                                                'pluginOptions' => [
                                                    'initialize' => true,
                                                    'placeholder'=>"Select Type",
                                                    'allowClear' => true
                                                ],
                                            ]); 
                                       ?> 

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'sku')->textInput(['maxlength' => true]) ?>
        
       <?php if(Yii::$app->hasModule('featuredproducts')): ?>
        
            <?= $form->field($model, 'is_featured')->widget(SwitchInput::classname(), ['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Yes','offText'=>'No']]) ?>
       
       <?php endif; ?>
       
       <?php if(Yii::$app->hasModule('trendingproducts')): ?>
            <?= $form->field($model, 'is_trending')->widget(SwitchInput::classname(), ['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Yes','offText'=>'No']]) ?>
        
       <?php endif; ?>
       
       <?php if(Yii::$app->hasModule('bestsellers')): ?>
       
            <?= $form->field($model, 'is_bestseller')->widget(SwitchInput::classname(), ['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Yes','offText'=>'No']]) ?>
       
       <?php endif; ?>

       
        
    </div>
    <div class="form-group col-md-6 col-sm-6 col-xs-12">
    
        <?= $form->field($model, 'price')->widget( NumberControl::classname(), [
                                                        'maskedInputOptions' => [
                                                            'min' => 0,                                                           
                                                            'allowMinus' => false,
                                                            'digits' => 2
                                                        ],
                                                        
                                                    ]) ?> 

        <?= $form->field($model, 'is_special_price')->widget(SwitchInput::classname(), ['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Yes','offText'=>'No']]) ?>

        <?= $form->field($model, 'special_price')->widget( NumberControl::classname(), [
                                                        'maskedInputOptions' => [
                                                            'min' => 0,                                                           
                                                            'allowMinus' => false,
                                                            'digits' => 2
                                                        ],
                                                        
                                                    ]) ?>
        
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'special_price_from',
            'attribute2' => 'special_price_to',
            'options' => ['placeholder' => 'Special From'],
            'options2' => ['placeholder' => 'Special To'],
            'type' => DatePicker::TYPE_RANGE,       
            'form' => $form,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]);
        
        ?>
        <?= $form->field($model, 'is_new')->widget(SwitchInput::classname(), ['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Yes','offText'=>'No']]) ?>
        
        <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'new_from',
            'attribute2' => 'new_to',
            'options' => ['placeholder' => 'New From'],
            'options2' => ['placeholder' => 'New To'],
            'type' => DatePicker::TYPE_RANGE,       
            'form' => $form,
            'pluginOptions' => [
                'format' => 'yyyy-mm-dd',
                'autoclose' => true,
            ]
        ]);
        
        ?>
        </div>
        
     <div class="clearfix"></div>
    </div>

    
    
  

   