<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\search\ClassModulesSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="catalog-product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'short_description') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'sku') ?>

    <?php // echo $form->field($model, 'slug') ?>

    <?php // echo $form->field($model, 'meta_title') ?>

    <?php // echo $form->field($model, 'meta_keywords') ?>

    <?php // echo $form->field($model, 'meta_description') ?>

    <?php // echo $form->field($model, 'base_image') ?>

    <?php // echo $form->field($model, 'gallery_images') ?>

    <?php // echo $form->field($model, 'length') ?>

    <?php // echo $form->field($model, 'width') ?>

    <?php // echo $form->field($model, 'height') ?>

    <?php // echo $form->field($model, 'length_class') ?>

    <?php // echo $form->field($model, 'weight') ?>

    <?php // echo $form->field($model, 'weight_class') ?>

    <?php // echo $form->field($model, 'tax_type') ?>

    <?php // echo $form->field($model, 'tax_type_id') ?>

    <?php // echo $form->field($model, 'tax_class') ?>

    <?php // echo $form->field($model, 'tax_rule_id') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'is_special_price') ?>

    <?php // echo $form->field($model, 'special_price') ?>

    <?php // echo $form->field($model, 'special_price_from') ?>

    <?php // echo $form->field($model, 'special_price_to') ?>

    <?php // echo $form->field($model, 'categories') ?>

    <?php // echo $form->field($model, 'related') ?>

    <?php // echo $form->field($model, 'up_sell') ?>

    <?php // echo $form->field($model, 'cross_sell') ?>

    <?php // echo $form->field($model, 'is_new') ?>

    <?php // echo $form->field($model, 'new_from') ?>

    <?php // echo $form->field($model, 'new_to') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('app', 'Reset'), ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
