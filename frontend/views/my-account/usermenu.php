<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'My Account';

?>


<div class="col-xl-3 col-lg-4 mb-5">
    <div class="customer-sidebar card border-0"> 
        <div class="customer-profile">
            <a class="d-inline-block" href="<?= Url::to(['my-account/index']); ?>">
                <img class="img-fluid rounded-circle customer-image" src="<?= Yii::getAlias('@storageUrlNonProtocal')."/home_images/avatar.jpg";?>">
            </a>
            <h5><?= Yii::$app->user->identity->username;?></h5>
            <p class="text-muted text-sm mb-0">&nbsp;</p>
        </div>
        <nav class="list-group customer-nav">
            <a class="active list-group-item d-flex justify-content-between align-items-center" href="<?= Url::to(['/my-account/index']); ?>">
                <span><i class="fa fa-shopping-cart"></i> Orders</span>
                <!--div class="badge badge-pill badge-light font-weight-normal px-3">&nbsp;</div-->
            </a>
            <!--a class="list-group-item d-flex justify-content-between align-items-center" href="#">
                <span><i class="fa fa-user-circle-o"></i> Profile</span>
            </a -->
            <!--a class="list-group-item d-flex justify-content-between align-items-center" href="#">
                <span><i class="fa fa-map"></i> Addresses</span>
            </a -->
            <a class="list-group-item d-flex justify-content-between align-items-center" href="<?= Url::to(['/site/logout']);?>" data-method="post">
                <span><i class="fa fa-sign-out"></i>Log out</span>
            </a>
        </nav>
    </div>
</div>