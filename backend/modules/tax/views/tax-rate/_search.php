<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\modules\tax\models\search\TaxRateSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tax-rate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'tax_name') ?>

    <?= $form->field($model, 'rate') ?>

    <?= $form->field($model, 'country') ?>

    <?= $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
