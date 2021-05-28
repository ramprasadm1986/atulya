<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CatalogProductReview */

$this->title = Yii::t('app', 'Create Catalog Product Review');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalog Product Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="catalog-product-review-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
