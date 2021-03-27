<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use yii\helpers\Url;
use backend\widgets\TinyMCECallback;
use dosamigos\tinymce\TinyMce;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\CmsPage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="cms-page-form">
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
             <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
             <?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="form-group col-md-6 col-sm-6 col-xs-12">
            <?= $form->field($model, 'meta_title')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'meta_keywords')->textInput(['maxlength' => true]) ?>

           
        
        </div>
        
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
         <?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <?= $form->field($model, 'content')->widget(TinyMce::class, [
                'language' => strtolower(substr(Yii::$app->language, 0, 2)),
                'clientOptions' => [
                    'height'=> 550,
                    'branding'=> false,
                    'forced_root_block'=>'div',
                    'elementpath'=>true,
                    'plugins' => [
                        'fullscreen emoticons autolink advlist autolink lists link image charmap print preview anchor pagebreak',
                        'searchreplace visualblocks code fullscreen',
                        'insertdatetime media table contextmenu paste code textcolor colorpicker spellchecker',
                    ],
                    'valid_elements'=>'*[*]',
                    'relative_urls'=>false,
                    'remove_script_host'=>false,
                    'convert_urls'=>true,
                    'document_base_url'=>Yii::getAlias("@frontendUrl")."/",
                    'toolbar' => 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media | forecolor backcolor| emoticons | fullscreen ',
                    'file_picker_callback' => TinyMCECallback::getFilePickerCallback(['/file-manager/frame']),
                ],
            ]);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <?php ActiveForm::end(); ?>

</div>
