<?php

use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\HomeBannerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Home Banners');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel home-banner-index">

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
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
            <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
        //['class' => 'yii\grid\SerialColumn'],

            'id',
           // 'image:ntext',
            [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function($model){
                        return Html::img($model->image,['style' => ['max-width' => '120px'] ,'class' => 'img img-responsive']);
                    }
            ],
            'title',
            
            'link_to:ntext',
            'start_date',
            'end_date',
            'status',
            'created_at',
        //    'update_at',

        ['class' => 'yii\grid\ActionColumn', 'header' => 'Action','template'=>'{index} {update} {delete}'],
        ],
        ]); ?>
    
        <?php Pjax::end(); ?>
    </div>
</div>
