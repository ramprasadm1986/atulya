<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\tax\models\TaxRate */

$this->title = 'Update Tax Rate: ' . $model->tax_name .' : ' . $model->tax_identifire;
$this->params['breadcrumbs'][] = ['label' => 'Tax Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->tax_name .' : '. $model->tax_identifire , 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="x_panel tax-rate-update">

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
