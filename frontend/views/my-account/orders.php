<?php
/**
* Class and Function List:
* Function list:
* Classes list:
*/
/* @var $this yii\web\View */
use yii\helpers\Url;
$this->title = 'Order Details';

?>

 <section class="hero">
    <div class="container">
    <!-- Breadcrumbs -->
        <ol class="breadcrumb justify-content-center">
           <li class="breadcrumb-item"><a href="<?= Url::home(); ?>">Home</a></li>
           <li class="breadcrumb-item"><a href="<?= Url::to(['/my-account/index']); ?>">Orders</a></li>
           <li class="breadcrumb-item active">Order Details</li>
        </ol>
        <!-- Hero Content-->
        <div class="hero-content pb-5 text-center">
               <h1 class="hero-heading">Order #<?= $order->order_identifire;?></h1>
               <div class="row">
                  <div class="col-xl-8 offset-xl-2">
                    <?php $order_tags=json_decode($order->order_tags,true);?>
                    <?php if( $order->status==1){ ?>
					<p class="lead text-muted">Order #<?= $order->order_identifire;?> was placed on <strong><?= date("d/m/Y H:i",strtotime($order_tags['placed']));?></strong> and is currently <strong><?= $order->order_status=="placed"? "Being prepared": ucwords($order->order_status);?></strong>.</p>
                    <?php  } 
                    else { ?>
                        <p class="lead text-muted">Order #<?= $order->order_identifire;?> was cancled on <strong><?= date("d/m/Y H:i",strtotime($order_tags['cancled']));?></p>
                    <?php } ?>
					<p class="text-muted">If you have any questions, please feel free to contact us, our customer service center is working for you 24/7.</p>
				  </div>
               </div>
        </div>
    </div>
</section>
<div class="container-fluid blogcontainer innerpage" style="margin-top:0px;">
    <div class="row">
        <div class="col-lg-8 col-xl-9">
            <div class="cart">
              <div class="cart-wrapper">
                <div class="cart-header text-center">
                  <div class="row">
                    <div class="col-6">Item</div>
                    <div class="col-2">Price</div>
                    <div class="col-2">Quantity</div>
                    <div class="col-2">Total</div>
                  </div>
                </div>
                <div class="cart-body">
                  <!-- Product-->
                  
                  <?php foreach($order->orderItems as $item ){ ?>
                  <div class="cart-item">
                    <div class="row d-flex align-items-center text-center">
                      <div class="col-6">
                      
                      
                        <div class="d-flex align-items-center"><a href="<?= Url::to(['/product/'.$item->item->slug]); ?>"><img class="cart-item-img" src="<?= $item->item->base_image?>" alt="..."></a>
                          <div class="cart-title text-left"><a class="text-uppercase text-dark" href="<?= Url::to(['/product/'.$item->item->slug]); ?>"><strong><?= $item->item_name;?></strong></a>
                          <br>
                          <?php if($item->variations){
                              
                              $variations=explode("|",$variations);
                              foreach($variations as $vari){ 
                             
                              ?>
                                  
                                <span class="text-muted text-sm"><?= $vari?></span><br>  
                             <?php  }
                          }
                          ?>
                         
                          </div>
                        </div>
                      </div>
                      <div class="col-2"><?=Yii::getAlias('@currency');?> <?= $item->sell_price;?></div>
                      <div class="col-2"><?= $item->qty;?>
                      </div>
                      <div class="col-2 text-center"><?=Yii::getAlias('@currency');?> <?= $item->row_total;?></div>
                    </div>
                  </div>
                  <?php }?>
                  
                </div>
              </div>
            </div>
            <div class="row my-5">
              <div class="col-md-6">
                <div class="block mb-5">
                  <div class="block-header">
                    <h6 class="text-uppercase mb-0">Order Summary</h6>
                  </div>
                  <div class="block-body bg-light pt-1">
                    <p class="text-sm">Shipping and additional costs are calculated based on values you have entered.</p>
                    <ul class="order-summary mb-0 list-unstyled">
                      <li class="order-summary-item"><span>Order Subtotal </span><span><?=Yii::getAlias('@currency');?> <?= $order->order_subtotal_excl_tax?></span></li>
                      <li class="order-summary-item"><span>Shipping and handling</span><span><?=Yii::getAlias('@currency');?> <?= $order->shipping?></span></li>
                      <li class="order-summary-item border-0"><span>Total</span><strong class="order-summary-total"><?=Yii::getAlias('@currency');?> <?= $order->order_total?></strong></li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                 <div class="block mb-5">
                <div class="block-header">
                  <h6 class="text-uppercase mb-0">Shipping address</h6>
                </div>
                <div class="block-body bg-light pt-1">
                
                    
                    <table class="table">
						<tbody>
							
                            <tr>
                                <th scope="row" >Shipping Mode</th>
								
								<th>Shipping Channel</th>
                                
                                <th>Tracking No:</th>
                                
							</tr>
                            <tr>
                                <td scope="row" ><?= $order->shipping_details;?></td>
								
                                <td> <?= $order->schannel;?></td>
                               
                                <td> <?= $order->tracking;?></td>
							</tr>
                            <tr>
                                <th scope="row" >Address Line1</th>
								
								<th>Address Line2</th>
                                
                                <th>Landmark</th>
                                
							</tr>
                            <tr>
                                <td scope="row" ><?= $order->orderAddresses[0]->address1;?></td>
								
                                <td><?= $order->orderAddresses[0]->address2;?></td>
                               
                                <td><?= $order->orderAddresses[0]->landmark;?></td>
							</tr>
							<tr>
								<th scope="row">City</th>
                                <th>State</th>
                                
                                <th>Country</th>
								
							</tr>
							<tr>
								<td><?= $order->orderAddresses[0]->city;?></td>
								<td><?= $order->orderAddresses[0]->state;?></td>
                                <td><?= $order->orderAddresses[0]->country;?></td>
							</tr>
							<tr>
								<th scope="row">Zip Code</th>
                                <th>Contact No</th>
								<th>&nbsp;</th>
							</tr>
							<tr>
								<td><?= $order->orderAddresses[0]->zip;?></td>
								<td><?= $order->orderAddresses[0]->phone;?></td>
                                <td>&nbsp;</td>
							</tr>
							
													
						</tbody>
					</table>
                    
                
                   
                  
                </div>
                </div>
              </div>
            </div>
        </div>
        <!-- Customer Sidebar-->
        
        <?= $this->render('usermenu');?>
        
        <!-- /Customer Sidebar-->
    </div>
</div>