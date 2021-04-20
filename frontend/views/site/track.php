<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/

use yii\helpers\Url;

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Track Order';
?>

<section class="hero">
    <div class="container">

  
     
     <div class="hero-content pb-5 text-center">
         <h1 class="hero-heading"><?= Html::encode($this->title) ?></h1>
          
    </div>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'trackorder-form','method'=>'get']); ?>

            <?= $form->field($model, 'order_id')->textInput(['autofocus' => true]) ?>

            <div class="form-group">
                <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
    <?php if($post && $order) :?>
    <div class="row">
        <div class="col-lg-5">
        
            <h3>Tracking Details For: <?= $order_id;?></h3>
    
            <?= \vivekmarakana\widgets\Timeline::widget(['items' => $data['items']]); ?>
        </div>
    </div>
    
    <?php elseif($post && !$order):?>
    <div class="row">
        <div class="col-lg-5">
    
            <h3>Invalid Order Id: <?=$order_id;?></h3>
        </div>
    </div>
    
    <?php endif;?>

</div>
</section>