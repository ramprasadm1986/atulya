<?php

use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\CmsBlockSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Blocks');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel cms-block-index">

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
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\CheckboxColumn','checkboxOptions' => function ($model, $key, $index,$column) {
                            return ['value'=>$model->is_system !== 1];
                        }],

                 
            [
              'attribute' => 'id',
              'headerOptions' => ['style' => 'width:50px'],
            ],        
            'title',
            'identifier',
            
            [
                'attribute'=>'is_system',
               // 'header'=>'Status',
                'filter' => ['1'=>'Yes', '0'=>'No'],
                'format'=>'raw',    
                'value' => function($model, $key, $index)
                {   
                    if($model->is_system == 1)
                    {
                        return "<span class='badge alert-success'>Yes</span>";
                    }
                    else
                    {
                      return "<span class='badge alert-danger'>No</span>";
                    }
                },
            ],
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
            //'created_at',
            //'updated_at',

        [
            'class' => 'yii\grid\ActionColumn',
            'visibleButtons' => [
                'delete' => function ($model, $key, $index) {
                            return $model->is_system !== 1;
                        }
            ],
            'header' => 'Action',
            'template'=>'{index} {update} {delete}'
        ],
        ],
        ]); ?>
    
        <?php Pjax::end(); ?>
    </div>
</div>
