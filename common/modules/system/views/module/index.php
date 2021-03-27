<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ClassModulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Modules');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel class-modules-index">

    <div class="row x_title">
        <div class="col-md-6">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
    </div>

    <div class="x_content">
        <?= $this->render('_form', [
        'models' => $models,
        ]) ?>
    </div>
</div>
