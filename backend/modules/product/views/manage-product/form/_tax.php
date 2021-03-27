<?php

use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use common\models\ClassTax;
use common\models\TaxRule;

?>
    <?php
    $tax_rule_options=[];
    
    foreach(TaxRule::find()->all() as $tax_class){
        
        $tax_rule_options["data-".$tax_class->id]=$tax_class->tax_class_name;
    }
    
    
    ?>

    
    <?= $form->field($model, 'tax_type')->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(ClassTax::find()->all(), 'code', 'name'),
                                                'options'=>ArrayHelper::map(ClassTax::find()->all(), 'code', 'id'),
                                                'pluginEvents' => [
                                                    'change' => "function() { jQuery('#catalogproduct-tax_type_id').val(this.getAttribute(this.value)); }",
                                                ],
                                                'pluginOptions' => [
                                                    'placeholder'=>"Select Type",
                                                    'allowClear' => true
                                                ],
                                            ]); 
                                       ?> 
    <?= $form->field($model, 'tax_type_id')->hiddenInput()->label(false) ?>

    <?= $form->field($model, 'tax_rule_id')->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(TaxRule::find()->all(), 'id', 'tax_class_name'),
                                                'options'=>$tax_rule_options,
                                                'pluginEvents' => [
                                                    'change' => "function() { jQuery('#catalogproduct-tax_class').val(this.getAttribute('data-'+this.value)); }",
                                                ],
                                                'pluginOptions' => [
                                                    'placeholder'=>"Select Class",
                                                    'allowClear' => true
                                                ],
                                            ])->label("Tax Class"); 
                                       ?>
    <?= $form->field($model, 'tax_class')->hiddenInput()->label(false) ?>

    