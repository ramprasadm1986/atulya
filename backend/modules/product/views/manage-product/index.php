<?php

use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ClassModulesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Catalog Products');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel catalog-product-index">

    <div class="row x_title">
        <div class="col-md-6">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <?=  Html::a('<i class="fa fa-plus"></i> New', ['create'], ['class' => 'btn btn-app']) ?>
            </div>
        </div>
    </div>

    <div class="x_content">
        <?php Pjax::begin(); ?>
                <?php //echo $this->render('_search', ['model' => $searchModel]); ?>
    
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
       // ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'type',
            'name',
           // 'short_description:ntext',
           // 'description:ntext',
           'sku',
            //'slug:ntext',
            //'meta_title:ntext',
            //'meta_keywords:ntext',
            //'meta_description:ntext',
            //'base_image:ntext',
            //'gallery_images:ntext',
            //'length',
            //'width',
            //'height',
            //'length_class',
            //'weight',
            //'weight_class',
            //'tax_type',
            //'tax_type_id',
            //'tax_class',
            //'tax_rule_id',
            'price',
            //'is_special_price',
            //'special_price',
            //'special_price_from',
            //'special_price_to',
            //'categories:ntext',
            //'related:ntext',
            //'up_sell:ntext',
            //'cross_sell:ntext',
            //'is_new',
            //'new_from',
            //'new_to',
            //'status',
            //'created_at',
            //'updated_at',

        ['class' => 'yii\grid\ActionColumn', 'header' => 'Action','template'=>'{index} {update} {delete}'],
        ],
        ]); ?>
    
        <?php Pjax::end(); ?>
    </div>
</div>
