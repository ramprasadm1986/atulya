<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
/* @var $this yii\web\View */
use yii\helpers\Url;
use yii\helpers\Html;
$this->title = 'My Account';

?>
 <section class="hero">
    <div class="container">
    <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
           <li class="breadcrumb-item"><a href="<?= Url::home(); ?>">Home</a></li>
           <li class="breadcrumb-item active">Orders</li>
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
                        <th class="py-2 text-uppercase text-sm">Action</th>
                        
                    </tr>
                </thead>
                <tbody>
                    
                    <?php foreach($orders as $order){ ?>
                    <tr>
                        <th class="py-2 align-middle"># <?= $order->order_identifire ?></th>
                        <td class="py-2 align-middle"><?= date("d/m/Y",strtotime($order->created_at)); ?></td>
                        <td class="py-2 align-middle"><?=Yii::getAlias('@currency');?> <?= $order->order_total ?></td>
                        <td class="py-2 align-middle"><span class="badge p-2 text-uppercase badge-info"><?= ucfirst($order->order_status); ?></span></td>
                        <td class="py-2 align-middle"><a href="<?= Url::to(['/my-account/orders/'.$order->id]); ?>"> <span class="badge p-2 text-uppercase badge-info">View</span></a>
                        <?php  if($order->status==1){ ?>
                        <?= Html::a('<span class="badge p-2 text-uppercase badge-info">Track</span>', ['/site/trackorder'], [

                        'data'=>[

                            'method' => 'post',

                           

                            'params'=>['DynamicModel[order_id]'=>$order->order_identifire],

                        ]

                    ]) ?>
                        <?php }?>
                        
                        </td>
                       
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <!-- Customer Sidebar-->
        
        <?= $this->render('usermenu');?>
        
        <!-- /Customer Sidebar-->
    </div>
</div>