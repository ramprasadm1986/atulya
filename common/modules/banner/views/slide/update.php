<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\HomeBanner */

$this->title = Yii::t('app', 'Update Home Banner: {name}', [
    'name' => $model->title,
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Home Banners'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->title;
$this->params['breadcrumbs'][] = Yii::t('app', 'Update');
?>
<div class="x_panel home-banner-update">

    <div class="x_title">
        <h2><?= Html::encode($this->title) ?></h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
        <?= $this->render('_form', [
        'model' => $model,
        ]) ?>
    </div>

</div>
