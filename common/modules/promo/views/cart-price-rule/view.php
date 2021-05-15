<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Coupon */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Coupons'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="x_panel coupon-view">

    <div class="x_title">
        <h2><?= Html::encode($this->title) ?></h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
    <p>
        <?= Html::a(Yii::t('app', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app', 'Delete'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'code',
            'start_on',
            'expire_on',
            'current_use',
            'total_use',
            'description',
            'active',
            'public',
            'has_condition',
            'filter_by',
            'discount_type',
            'discount',
            'products:ntext',
            'categories:ntext',
        ],
    ]) ?>
    </div>

</div>
