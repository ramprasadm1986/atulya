<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use common\modules\promo\assets\PromoAsset; 
use kartik\widgets\SwitchInput;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model common\models\Coupon */
/* @var $form yii\widgets\ActiveForm */

PromoAsset::register($this); 

?>

<div class="coupon-form">

    <?php $form = ActiveForm::begin(); ?>

       
        
        
       
        
        <div class="row">
        

            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($model, 'active')->widget(SwitchInput::classname(), []) ?>
                
                <?= $form->field($model, 'public')->widget(SwitchInput::classname(),['pluginOptions' => ['onText' => 'Yes','offText' => 'No']] ) ?>
                
                <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        
                <?= $form->field($model, 'description')->textInput(['maxlength' => true]) ?>

                <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
                <?= DatePicker::widget([
                    'model' => $model,
                    'attribute' => 'start_on',
                    'attribute2' => 'expire_on',
                    'options' => ['placeholder' => 'Start From'],
                    'options2' => ['placeholder' => 'Expire On'],
                    'type' => DatePicker::TYPE_RANGE,       
                    'form' => $form,
                    'pluginOptions' => [
                        'format' => 'yyyy-mm-dd',
                        'autoclose' => true,
                    ]
                ]);
                ?>
                
            </div>
            <div class="form-group col-md-6 col-sm-6 col-xs-12">
                <?= $form->field($model, 'current_use')->staticInput(); ?>
                
                <?php
                if($model->total_use > 0){
                    $model->use_type = 1;
                }
                ?>

                <?= $form->field($model, 'use_type')->dropDownList(['0'=>'Unlimited','1'=>'Limited to'])?>
                <?= $form->field($model, 'total_use')->textInput(['type'=>'number']) ?>
                <?= $form->field($model, 'discount_type')->dropDownList(['flat'=>'Flat','percent'=>'Percent'])?>
                <?= $form->field($model, 'discount')->textInput(['type'=>'number','step'=>'.01']) ?>
                
                <?= $form->field($model, 'has_condition')->widget(SwitchInput::classname(),
                    [
                        'pluginOptions' => [
                            'onText' => 'Yes',
                            'offText' => 'No'
                        ],
                        'pluginEvents' => [
                                
                            "switchChange.bootstrapSwitch" => "hasConditionChange"
                        ]
                    ]) ?>
            </div>
            <div class="clearfix"></div>
            
            <div class="form-group col-md-12 col-sm-12 col-xs-12" id="conditions" <?= ($model->has_condition)?"style='display:block'":null ?>>
                <div class="form-group col-md-6 col-sm-6 col-xs-6" >
                <h3>Conditions</h3>

                <?= $form->field($model, 'filter_by')->radioList([
                        'categories'=>'Categories',
                        'product'=>'Products',
                ],[
                        'class'=>'filter-type'
                ]) ?>
                

                    <div class="form-group field-search">
                        <label class="control-label coupon-description-product" for="coupon-description">Search <?=$model->getAttributeLabel('products')?></label>
                        <label class="control-label coupon-description-categories" for="coupon-description">Search <?=$model->getAttributeLabel('categories')?></label>
                        <input type="text" id="product-category-search" class="form-control"  maxlength="255" >
                        <div class="help-block product-help"><hr><strong>To add above product(s), copy its SKU and paste it on products below. For multiple products, add (,) after SKU.</strong></div>
                        <div class="help-block category-help"><hr><strong>To add above categories, copy its ID and paste it on categories below. For multiple categories, add (,) after ID.</strong></div>
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-6" >
                        <div id="search-data" style="display: none;max-height: 300px;overflow-y: scroll;min-height: 300px;">

                        </div>
                        <div id="search-loading" style="display: none;">
                            <div class="lds-dual-ring"></div>
                        </div>
                </div>
                 <div class="clearfix"></div>
                <?= $form->field($model, 'products')->textarea(['rows' => 6]) ?>
                <?= $form->field($model, 'categories')->textarea(['rows' => 6]) ?>
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
