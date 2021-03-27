<?php


use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\SwitchInput;

/* @var $this yii\web\View */
/* @var $model common\models\ClassModules */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="class-modules-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12 col-sm-12">
        

            <table  class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
              <thead>
                <tr>
                  
                  <th>Module Name</th>
                  <th>Is System</th>
                  <th>System Config Status</th>
                  <th>Config File Override</th>
                  <th>Module Status</th>
                </tr>
              </thead>
              <tbody>
              
               <?php foreach ($models as $index => $model): ?>
                <tr class="<?= Yii::$app->hasModule($model->code)?'success':'danger' ?>" >
                  <th scope="row"><?= $form->field($model, "[$index]name" ,['options' => ['tag' => false,'calss' => ""],'errorOptions' => ['tag' => false]])->hiddenInput()->label($model->name); ?></th>
                  <td><?= $form->field($model, "[$index]is_system", ['options' => ['tag' => false,'calss' => ""],'errorOptions' => ['tag' => false]])->hiddenInput()->label( $model->is_system? "Yes":"No" ); ?></td>             
                  <td><?= $form->field($model, "[$index]is_active",['options' => ['tag' => false],'errorOptions' => ['tag' => false]])->widget(SwitchInput::classname(), ['pluginOptions' => ['size' => 'mini','onColor' => 'success','offColor' => 'danger','onText'=>'Active','offText'=>'Inactive'],'disabled' => $model->is_system? true:false ])->label(false)  ?>
                  <td><?= Yii::$app->hasModule($model->code)!=$model->is_active? "Yes":"No"; ?></td>
                  <td><?= Yii::$app->hasModule($model->code)? "<strong class='label-success label pull-right'>Active</strong>":"<strong class='label-danger label pull-right'>Inactive</strong>"; ?></td>
                </tr>
               <?php endforeach; ?> 
              </tbody>
            </table>

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
