<?php


use yii\helpers\Html;
use zgb7mtr\gentelella\widgets\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel common\modules\tax\models\search\TaxRuleSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tax Rules';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="x_panel tax-rule-index">

    <div class="row x_title">
        <div class="col-md-6">
            <h4><?= Html::encode($this->title) ?></h4>
           
        </div>
        <div class="col-md-6">
            <div class="pull-right">
                <?= Html::a('<i class="fa fa-plus"></i> New', ['create'], ['class' => 'btn btn-app']) ?>
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

                  
            'tax_class_name',
          

        ['class' => 'yii\grid\ActionColumn', 'header' => 'Action','template'=>'{index} {update} {delete}'],
        ],
        ]); ?>
    
        <?php Pjax::end(); ?>
    </div>
</div>
