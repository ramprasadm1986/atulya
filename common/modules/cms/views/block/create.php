<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\CmsBlock */

$this->title = Yii::t('app', 'Create Cms Block');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Cms Blocks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel cms-block-create">

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
