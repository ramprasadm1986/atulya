<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<section class="hero py-6" style="background-color: #f0f2f5;">
	<div class="container">
		<div class="row">
			<div class=" col-lg-3 col-3 ">
			</div>
			<div class=" col-lg-6 col-12 ">
                
				<div class=" shadow-sm bg-white p-4 rounded">
					<div class="p-3">
					<h3 class="my-0">Welcome Back</h3>
					<p class="small mb-4">Sign in to Continue.</p>
					<?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                    
					
                    <?= $form->field($model, 'username')->textInput(['autofocus' => true,'placeholder'=>'Enter Username']) ?>
					
                    <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Enter Password']) ?>
                    
                     <?= Html::submitButton('Sign in', ['class' => 'btn btn-success btn-lg rounded btn-block', 'name' => 'login-button']) ?>
					
					<?php ActiveForm::end(); ?>
					<!--p class="text-muted text-center small m-0 py-3">or</p>
					<a href="#" class="btn btn-primary btn-block rounded btn-lg btn-apple">
					<i class="icofont-brand-apple mr-2"></i>Sign in with Facebook
					</a>
					<a href="#" class="btn btn-light border btn-block rounded btn-lg btn-google">
					<i class="icofont-google-plus text-danger mr-2"></i>Sign in with Google
					</a-->
					<p class="text-center mt-3 mb-0"><?= Html::a("Don't have an account? Sign up.", ['site/signup'],['class'=>'text-dark']) ?></p>
                    <p class="text-center mt-3 mb-0"><?= Html::a("If you forgot your password you can reset it.", ['site/request-password-reset'],['class'=>'text-dark']) ?></p>
                    <p class="text-center mt-3 mb-0" style="display:none;"><?= Html::a("Need new verification email?", ['site/resend-verification-email'],['class'=>'text-dark']) ?></p>
					</div>
				</div>
                
			</div>
			
		</div>
    </div>
</section>



