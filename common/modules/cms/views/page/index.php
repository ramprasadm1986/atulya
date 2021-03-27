<?php

use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CmsPageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Pages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel cms-page-index">

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
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'title',
            'slug',
            //'meta_title',
            //'meta_keywords',
            //'meta_description:ntext',
            //'content:ntext',
          
            [
                'attribute'=>'status',
               // 'header'=>'Status',
                'filter' => ['1'=>'Active', '0'=>'In-Active'],
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {   
                    if($model->status == 1)
                    {
                        return "<span class='badge alert-success'>Active</span>";
                    }
                    else
                    {
                      return "<span class='badge alert-danger'>In-Active</span>";
                    }
                },
            ],
            'created_at',
            //'updated_at',

        ['class' => 'yii\grid\ActionColumn', 'header' => 'Action','template'=>'{index} {update} {delete}'],
        ],
        ]); ?>
    
        <?php Pjax::end(); ?>
    </div>
</div>
