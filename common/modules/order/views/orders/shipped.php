<?php

use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\models\search\OrderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Orders (Shipped)');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel order-index">

    <div class="row x_title">
        <div class="col-md-12">
            <h4><?= Html::encode($this->title) ?></h4>
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
            'order_identifire',
            //'order_user_type',
            //'user_id',
            [
                'attribute' => 'user_id',
                'value' => function ($model) {
                    return $model->user_id?"Registered User":"Guest User";
                }
            ],
            'user_email:email',
            'order_subtotal_excl_tax',
            //'discount',
            //'descout_details:ntext',
            //'tax',
            //'tax_details:ntext',
            'shipping',
            'shipping_details:ntext',
            'order_total',
            'schannel',
            'tracking',
            
            'created_at',
            [
                'attribute' => 'order_status',
                'filter'=>false,
                'value' => function ($model) {
                    return ucfirst($model->order_status);
                }
            ],
            //'updated_at',
            [
               'label' => 'Invoice',
               'format'=>'raw',
               'value' => function ($model) {
               
                   return Html::a ( '<span class="glyphicon glyphicon-download" aria-hidden="true"></span> ', ['/orders/invoice', 'id' => $model->id],['title'=>'Download','target'=>'_blank','data-pjax'=>"0"]);
               }
            ],
            [
               'label' => 'Shipping Label',
               'format'=>'raw',
               'value' => function ($model) {
               
                   return Html::a ( '<span class="glyphicon glyphicon-download" aria-hidden="true"></span> ', ['/orders/shiplabel', 'id' => $model->id],['title'=>'Download','target'=>'_blank','data-pjax'=>"0"]);
               }
            ],

        [
            'class' => 'yii\grid\ActionColumn',
            'header' => 'Action',
            'template'=>'{index} {view}',
           
        
        
        ],
        ],
        ]); ?>
    
        <?php Pjax::end(); ?>
    </div>
</div>
