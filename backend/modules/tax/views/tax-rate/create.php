<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\tax\models\TaxRate */

$this->title = 'Create Tax Rate';
$this->params['breadcrumbs'][] = ['label' => 'Tax Rates', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel tax-rate-create">

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
