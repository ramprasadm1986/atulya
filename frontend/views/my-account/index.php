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
 <section class="hero">
    <div class="container">
    <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
           <li class="breadcrumb-item"><a href="<?= Url::home(); ?>">Home</a></li>
           <li class="breadcrumb-item active">Orders       </li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
           <h1 class="hero-heading">Your Orders</h1>
           <div class="row">
              <div class="col-xl-8 offset-xl-2">
                 <p class="lead text-muted">All orders list in one place.</p>
              </div>
           </div>
        </div>
    </div>
</section>
<div class="container-fluid blogcontainer innerpage" style="margin-top:0px;">
    <div class="row">
        <div class="col-lg-8 col-xl-9">
            <table class="table table-bordered table-hover table-responsive-md">
                <thead class="bg-light">
                    <tr>
                        <th class="py-2 text-uppercase text-sm">Order #</th>
                        <th class="py-2 text-uppercase text-sm">Date</th>
                        <th class="py-2 text-uppercase text-sm">Total</th>
                        <th class="py-2 text-uppercase text-sm">Status</th>
                        
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($orders as $order){ ?>
                    <tr>
                        <th class="py-2 align-middle"># <?= $order->order_identifire ?></th>
                        <td class="py-2 align-middle"><?= date("d/m/Y",strtotime($order->created_at)); ?></td>
                        <td class="py-2 align-middle"><?=Yii::getAlias('@currency');?> <?= $order->order_total ?></td>
                        <td class="py-2 align-middle"><span class="badge p-2 text-uppercase badge-info"><?= ucfirst($order->order_status); ?></span></td>
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- Customer Sidebar-->
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
                    <a class="active list-group-item d-flex justify-content-between align-items-center" href="<?= Url::to(['my-account/index']); ?>">
                        <span><i class="fa fa-shopping-cart"></i> Orders</span>
                        <!--div class="badge badge-pill badge-light font-weight-normal px-3">&nbsp;</div-->
                    </a>
                    <a class="list-group-item d-flex justify-content-between align-items-center" href="#">
                        <span><i class="fa fa-user-circle-o"></i> Profile</span>
                    </a>
                    <a class="list-group-item d-flex justify-content-between align-items-center" href="#">
                        <span><i class="fa fa-map"></i> Addresses</span>
                    </a>
                    <a class="list-group-item d-flex justify-content-between align-items-center" href="<?= Url::to(['site/logout']);?>" data-method="post">
                        <span><i class="fa fa-sign-out"></i>Log out</span>
                    </a>
                </nav>
            </div>
        </div>
        <!-- /Customer Sidebar-->
    </div>
</div>