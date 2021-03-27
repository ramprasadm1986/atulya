<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\tax\models\TaxRule */

$this->title = 'Update Tax Rule: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tax Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="x_panel tax-rule-update">

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
