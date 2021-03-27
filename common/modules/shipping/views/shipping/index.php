<?php

use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\ShippingMethodSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Shipping Methods');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel shipping-method-index">

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

            //        'id',
            'method',
            'name',
            'price',
            'snd_price',
            'freeship_threshold',
            //'is_system',
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
            //'status',
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
