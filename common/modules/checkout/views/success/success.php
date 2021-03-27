<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'thank you';
?>

<div class="main-content" style="margin-top:40px;">
    <div class="container cart-block-style"> 
		<div class="jumbotron text-center">
			<h1 class="display-3" style="font-weight:normal !important;"><br/>Thank You!</h1>
			
			<hr>
            <strong>Your has been placed. Order Id is <?=$OrderIdentifire;?></strong>
			<p class="lead">
				<a class="btn btn-primary btn-sm" href="<?= Url::home();?>" role="button">Continue to homepage</a>
			</p>
		</div>
	</div>
</div>