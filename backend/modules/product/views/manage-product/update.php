<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CatalogProduct */

$this->title = Yii::t('app', 'Update Catalog Product: {name}', [
    'name' => $model->name,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalog Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->name;
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="x_panel catalog-product-update">

    <div class="x_title">
        <h2><?= Html::encode($this->title) ?></h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <?= $this->render('_form', [
        'model' => $model,
        'CPAttributes'=>$CPAttributes,
        'CPOptions'=>$CPOptions,
        'CPVariation'=>$CPVariation
        ]) ?>
    </div>

</div>
