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

    'widgetBody' => '.container-options',

    'widgetItem' => '.options-items',

    'limit' => 999,

    'min' => 1,

    'insertButton' => '.add-options',

    'deleteButton' => '.remove-options',

    'model' => $CPOptions[0],

    'formId' => 'product_create',

    'formFields' => [

        'name',
        'price'

    ],

]);
    
    ?>
<div class="row container-options">

    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="pull-right">
                   
                    <?= Html::button('<i class="fa fa-plus"></i>', ['class' => "btn btn-sm  add-options"]) ?>
                </div>
    </div>
   
    <?php foreach ($CPOptions as $indexCPOptions => $modelCPOptions): ?>
    
    <div class="form-group col-md-12 col-sm-12 col-xs-12 options-items panel panel-default">
        
            <div class="pull-left">
                       
                        <?php if (! $modelCPOptions->isNewRecord) {

                        echo Html::activeHiddenInput($modelCPOptions, "[{$indexCPAttributes}][{$indexCPOptions}]id");

                    }
                    ?>
                    <?= $form->field($modelCPOptions, "[{$indexCPAttributes}][{$indexCPOptions}]name")->textInput(['maxlength' => true]) ?>
                   
            </div>
            <div class="pull-right">
                       
                        <?= Html::button('<i class="fa fa-trash"></i>', ['class' => "btn btn-sm remove-options"]) ?>
            </div>
         
            
             
          
           

    </div>
    <?php endforeach;?>
    <div class="clearfix"></div>
</div>

<?php DynamicFormWidget::end(); ?>