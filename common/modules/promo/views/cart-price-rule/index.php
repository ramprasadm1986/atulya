<?php

use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CouponSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Coupons');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel coupon-index">

    <div class="row x_title">
        <div class="col-md-6">
            <h4><?= Html::encode($this->title) ?></h4>
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> New'), ['create'], ['class' => 'btn btn-app']) ?>
            </div>
        </div>
    </div>

    <div class="x_content">
        <?php Pjax::begin(); ?>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'name',
            'code',
            'start_on',
            'expire_on',
            //'current_use',
            //'total_use',
            //'description',
            //'active',
            //'public',
            //'has_condition',
            //'filter_by',
            //'min_price',
            //'max_price',
            //'discount',
            //'products:ntext',

        ['class' => 'yii\grid\ActionColumn', 'header' => 'Action',],
        ],
        ]); ?>
    
        <?php Pjax::end(); ?>
    </div>
</div>
