<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

use ramprasadm1986\elfinder\InputFile;
use ramprasadm1986\elfinder\ElFinder;
use yii\web\JsExpression;

use kartik\date\DatePicker;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\HomeBanner */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="home-banner-form">
<?php $form = ActiveForm::begin(); ?>
    <div class="row">    
    <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <div class="pull-right">
                <?= Html::resetButton('<i class="fa fa-refresh"></i> Reset', ['class' => 'btn btn-app']) ?>
                <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-app']) ?>
            </div>
    </div>
    
    
    
    <div class="form-group col-md-6 col-sm-6 col-xs-12">
    
    
    
    <?= $form->field($model, 'image')->widget(InputFile::className(), [
								'language'      => 'en',
								'controller'    => 'elfinder', 
								'filter'        => 'image',
								'path'			=> '/product_images/',							
								'template'      => '<div class="input-group"><span>{image}</span><span class="input-group-btn" style="vertical-align:top;">{button}</span>{input}</div>',
								'options'       => ['class' => 'form-control','type'=>'hidden'],
								'buttonOptions' => ['class' => 'btn btn-default'],
								'multiple'      => false,
								
								
							]);
							?>

   

    </div>
    
    <div class="form-group col-md-6 col-sm-6 col-xs-12">
    
        <?= $form->field($model, 'status')->widget(SwitchInput::classname(),['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Active','offText'=>'Inactive']]) ?>
        
        <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
        
        
        <?= $form->field($model, 'link_to')->textInput() ?>
        
         <?= DatePicker::widget([
            'model' => $model,
            'attribute' => 'start_date',
            'attribute2' => 'end_date',
            'options' => ['placeholder' => 'Auto Load On'],
            'options2' => ['placeholder' => 'Take Off On'],
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

   

    <?php ActiveForm::end(); ?>
</div>

