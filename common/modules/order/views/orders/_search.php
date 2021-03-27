<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\OrderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="order-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'order_identifire') ?>

    <?= $form->field($model, 'order_user_type') ?>

    <?= $form->field($model, 'user_id') ?>

    <?= $form->field($model, 'user_email') ?>

    <?php // echo $form->field($model, 'order_subtotal_excl_tax') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'descout_details') ?>

    <?php // echo $form->field($model, 'tax') ?>

    <?php // echo $form->field($model, 'tax_details') ?>

    <?php // echo $form->field($model, 'shipping') ?>
    
    <?php // echo $form->field($model, 'shipping_details') ?>

    <?php // echo $form->field($model, 'order_total') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
