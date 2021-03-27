<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Signup';
$this->params['breadcrumbs'][] = $this->title;
?>
<section class="hero py-6" style="background-color: #f0f2f5;">
	<div class="container">
		<div class="row">
			<div class=" col-lg-3 col-3 ">
			</div>
			<div class=" col-lg-6 col-6 ">
				<div class=" shadow-sm bg-white p-4 rounded">
					<div class="p-3">
					<h3 class="my-0">Let's get started</h3>
					<p class="small mb-4">Create account to see our top picks for you!</p>
					 <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
						<?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'Enter Username']) ?>
						
                        <?= $form->field($model, 'email')->input('email',['placeholder'=>'Enter Email']) ?>
						
                        <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter Password']) ?>
						
						<?= Html::submitButton('Create Account', ['class' => 'btn btn-success rounded btn-lg btn-block', 'name' => 'signup-button']) ?>
						
					<?php ActiveForm::end(); ?>
					<!--p class="text-muted text-center small m-0 py-3">or</p>
					<a href="#" class="btn btn-primary btn-block rounded btn-lg btn-apple">
					<i class="fa fa-facebook mr-2"></i>Sign up with Facebook
					</a>
					<a href="#" class="btn btn-light border btn-block rounded btn-lg btn-google">
					<i class="fa fa-google text-danger mr-2"></i>Sign up with Google
					</a-->
					<p class="text-center mt-3 mb-0"><?= Html::a('Already have an account! Sign in', ['site/login'],['class'=>'text-dark']) ?></p>
					</div>
				</div>
			</div>
			
		</div>
    </div>
</section>
