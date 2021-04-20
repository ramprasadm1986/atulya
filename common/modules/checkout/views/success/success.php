<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
$this->title = 'thank you';
?>
<style>
    .icon-rounded {
    display: -ms-flexbox;
    display: flex;
    -ms-flex-align: center;
    align-items: center;
    -ms-flex-pack: center;
    justify-content: center;
    width: 4rem;
    height: 4rem;
    border-radius: 50%;
    color: #fff;
}
</style>
<section class="hero">
    <div class="container cart-block-style"> 
		<ol class="breadcrumb justify-content-center">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item active">Order confirmed        </li>
        </ol>
		<div class="hero-content pb-5 text-center">
          <h1 class="hero-heading">Order confirmed</h1>
        </div>
        <div class="container text-center">
        <div class="icon-rounded bg-primary mb-3 mx-auto text-white">
          <i class="fa fa-check" style="font-size: 30px;"></i>
        </div>
        <h4 class="mb-3 ff-base">Thank you, <b>Customer</b>. Your order has been placed.</h4>
        <p class="text-muted mb-5">Your order hasn't shipped yet but we will send you an email when it does.</p>
        <p> <a class="btn btn-outline-dark" href="customer-order.html">Order ID-<?=$OrderIdentifire;?></a></p>
        	<p class="lead">
				<a class="btn btn-primary btn-sm" href="<?= Url::home();?>" role="button">Continue to homepage</a>
			</p>
      </div>
           
		
		
	</div>
</section>