<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\tax\models\TaxRule */

$this->title = 'Create Tax Rule';
$this->params['breadcrumbs'][] = ['label' => 'Tax Rules', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel tax-rule-create">

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
