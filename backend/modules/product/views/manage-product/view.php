<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\CatalogProduct */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Catalog Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="x_panel catalog-product-view">

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
            'type',
            'name',
            'short_description:ntext',
            'description:ntext',
            'sku',
            'slug:ntext',
            'meta_title:ntext',
            'meta_keywords:ntext',
            'meta_description:ntext',
            'base_image:ntext',
            'gallery_images:ntext',
            'length',
            'width',
            'height',
            'length_class',
            'weight',
            'weight_class',
            'tax_type',
            'tax_type_id',
            'tax_class',
            'tax_rule_id',
            'price',
            'is_special_price',
            'special_price',
            'special_price_from',
            'special_price_to',
            'categories:ntext',
            'related:ntext',
            'up_sell:ntext',
            'cross_sell:ntext',
            'is_new',
            'new_from',
            'new_to',
            'status',
            'created_at',
            'updated_at',
        ],
    ]) ?>
    </div>

</div>
