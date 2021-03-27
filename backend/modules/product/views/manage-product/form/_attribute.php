<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\widgets\SwitchInput;
use kartik\select2\Select2;
use kartik\number\NumberControl;
use yii\helpers\ArrayHelper;
use common\models\ClassInput;

use wbraganca\dynamicform\DynamicFormWidget;

?>
<?php DynamicFormWidget::begin([

    'widgetContainer' => 'dynamicform_inner',

    'widgetBody' => '.container-attributes',

    'widgetItem' => '.attributes-items',

    'limit' => 999,

    'min' => 1,

    'insertButton' => '.add-attribute',

    'deleteButton' => '.remove-attribute',

    'model' => $CPAttributes[0],

    'formId' => 'product_create',

    'formFields' => [

        'status',
        'name'

    ],

]);
    
    ?>
<div class="row container-attributes">

    <div class="form-group col-md-12 col-sm-12 col-xs-12">
               
                <div class="pull-right">
                   
                    <?= Html::button('<i class="fa fa-plus"></i>', ['class' => 'btn btn-sm  add-attribute']) ?>
                </div>
    </div>
   
    <?php foreach ($CPAttributes as $indexCPAttributes => $modelCPAttributes): ?>
    
    <div class="form-group col-md-12 col-sm-12 col-xs-12 attributes-items panel panel-default">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="pull-left">
                    <strong>Attribute</strong>
                </div>
                <div class="pull-right">
                           
                            <?= Html::button('<i class="fa fa-trash"></i>', ['class' => 'btn btn-sm remove-attribute']) ?>
                </div>
            </div>
            <div class="form-group col-md-4 col-sm-4 col-xs-12">
             <?php
             if (! $modelCPAttributes->isNewRecord) {

                        echo Html::activeHiddenInput($modelCPAttributes, "[{$indexCPAttributes}]id");

                    }
             $att_type=ArrayHelper::map(ClassInput::find()->all(), 'code', 'name');
             ?>
             <?= $form->field($modelCPAttributes, "[{$indexCPAttributes}]status")->widget(SwitchInput::classname(),['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Active','offText'=>'Inactive']]) ?>
             </div>
            
            <div class="form-group col-md-4 col-sm-4 col-xs-12">
             <?= $form->field($modelCPAttributes, "[{$indexCPAttributes}]type")->widget(Select2::classname(), [
                                               
                                                'data' =>$att_type ,
                                                'pluginOptions' => [
                                                    'placeholder'=>"Select Type",
                                                    'allowClear' => true
                                                ],
                                            ]); 
                                       ?> 
            
            </div>
            
            <div class="form-group col-md-4 col-sm-4 col-xs-12">
             <?= $form->field($modelCPAttributes, "[{$indexCPAttributes}]name")->textInput(['maxlength' => true]) ?>
            </div>
            
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                
                
                 <?=  $this->render('@backend/modules/product/views/manage-product/form/_options', [
                        'form' => $form,
                        'indexCPAttributes' => $indexCPAttributes,
                        'CPOptions'=> $CPOptions[$indexCPAttributes]
                        ]) ?>
                    
            </div>
           
     <div class="clearfix"></div>   
    </div>
    <?php endforeach;?>
    <div class="clearfix"></div>
</div>

<?php DynamicFormWidget::end(); ?>