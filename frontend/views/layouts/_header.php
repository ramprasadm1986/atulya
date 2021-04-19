<?
use yii\helpers\Url;
use common\models\Cart;
if(Yii::$app->session->get('CartIdentifire')!=""){
	$CartIdentifire = Yii::$app->session->get('CartIdentifire');
}else{
	$CartIdentifire = "";
}
$cart_obj = new Cart();
$cartdetails = $cart_obj->getHeadercartdetails($CartIdentifire);
$no_cartitem = $cartdetails['Totalcartitem'];
$cartamount = $cartdetails['Totalamount'];
$CartItems= $cart_obj->getCartAllItems($CartIdentifire);
?>


<header class="header">
         <!-- Top Bar-->
         <div class="top-bar" style="display:none;">
            <div class="container-fluid">
               <div class="row d-flex align-items-center">
                  <div class="col-sm-5 d-none d-sm-block">
                     <ul class="list-inline mb-0">
                        <li class="list-inline-item pr-3 mr-0">
                           <i class="fa fa-whatsapp"></i> +91 7682842572
                        </li>
                        <li class="list-inline-item px-3 border-left d-none d-lg-inline-block"> </li>
                     </ul>
                  </div>
                  <div class="col-sm-7 d-none d-sm-block">
                      <p style="margin-bottom:0px; font-weight:bold; letter-spacing:2px; font-size:16px;">Welcome To Atulya Karigari</p>
                  </div>
                 
               </div>
            </div>
         </div>
         <!-- Top Bar End-->
         <!-- Navbar-->
         <div class="container-fluid" style="background: rgba(0,0,0,0.5);">
                <div class="container" style="text-align:center;">
               <!-- Navbar Header  --><a class="navbar-brand" href="<?= Url::home(); ?>"><img src="<?= Yii::getAlias('@storageUrlNonProtocal')."/home_images/logo.png"?>" style="height:60px;"/></a>
              
               </div>
         </div>
         <nav class="navbar navbar-expand-lg navbar-sticky navbar-airy navbar-dark bg-fixed-white" style=" background: rgba(0,0,0,0.5);">
             <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"><i class="fa fa-bars"></i></button>
            <div class="container-fluid">
             <div class="container">
               <!-- Navbar Collapse -->
               <div class="collapse navbar-collapse" id="navbarCollapse">
                  <ul class="navbar-nav mx-auto">
                     <li class="nav-item ">
                        <a class="nav-link active" href="<?= Url::home(); ?>" >
                        Home</a>
                     </li>
                     <?= $this->render('_sitemenu.php') ?>
                     
                     <!-- Multi level dropdown end-->
                     <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/site/contact']); ?>">Contact</a></li>
                     <?php if(!Yii::$app->user->identity): ?>
					 <li class="nav-item"><a class="nav-link" href="<?= Url::to(['/site/login']); ?>">Login / Sign Up</a></li>
                     <?php else: ?>
                     <li class="nav-item"><a class="nav-link" href="<?= Url::to(['my-account/index']); ?>">My Account</a></li>
                     <?php endif; ?>
                  </ul>
                  <div class="d-flex align-items-center justify-content-between justify-content-lg-end mt-1 mb-2 my-lg-0">
                     <!-- User Not Logged - link to login page-->
                    
                    <?php if(Yii::$app->user->identity): ?>
					 <div class="nav-item dropdown">
						<a class="dropdown-toggle navbar-icon-link" id="userdetails" style="color: #ed8b25;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						<i class="fa fa-user-circle-o"></i>
					    </a>
						<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userdetails"> 
							<a class="dropdown-item" href="<?= Url::to(['my-account/index']); ?>">Orders</a>
							<a class="dropdown-item" href="#">Addresses</a>
							<a class="dropdown-item" href="#">Profile</a>
							<div class="dropdown-divider my-0"></div>
							<a class="dropdown-item" href="<?= Url::to(['site/logout']);?>" data-method="post">Logout</a>
						</div>
					 </div>
                    <?php endif; ?>
                     <!-- Cart Dropdown-->
                     <div class="nav-item dropdown">
                        <a class="navbar-icon-link d-lg-none" href="<?= Url::to(['/cart']);?>"  > 
                        <i class="fa fa-shopping-cart"></i><span class="text-sm ml-2 ml-lg-0 text-uppercase text-sm font-weight-bold d-none d-sm-inline d-lg-none">View cart</span></a>
                        <div class="d-none d-lg-block">
                           <a class="navbar-icon-link dropdown-toggle" id="cartdetails" href="<?= Url::to(['/cart']);?>" data-target="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color:#fff;">
                              <i class="fa fa-shopping-cart"></i>
                              <div class="navbar-icon-link-badge" id="cart_mini_items"><?=number_format($no_cartitem);?></div>
                           </a>
                           <div class="dropdown-menu dropdown-menu-right p-4" aria-labelledby="cartdetails">
                              <div class="navbar-cart-product-wrapper" id="cart_mini">
                                 <!-- cart item-->
                                <?php foreach($CartItems['CartItems'] as $item):?>
                                <div class="navbar-cart-product" id="prod_min_<?=$item['id']?>">
                                    <div class="d-flex align-items-center">
                                       <a href="<?=$item['full_url']?>" id="prod_min_<?=$item['id']?>_url"><img class="img-fluid navbar-cart-product-image" id="prod_min_<?=$item['id']?>_img" src="<?=$item['image'];?>" alt="<?=$item['item_name'];?>"></a>
                                       <div class="w-100">
                                         <div class="pl-3"> <a class="navbar-cart-product-link" href="<?=$item['full_url']?>" id="prod_min_<?=$item['id']?>_name"><?=$item['item_name'];?></a><small class="d-block text-muted">Quantity: <span id="prod_min_<?=$item['id']?>_qty"><?=$item['qty']?></span> </small><strong class="d-block text-sm" id="prod_min_<?=$item['id']?>_total"><?= Yii::getAlias('@currency');?> <?=$item['row_total'];?></strong></div>
                                       </div>
                                    </div>
                                </div>
                               <?php endforeach;?>
                              </div>
                              <!-- total price-->
                              <div class="navbar-cart-total"><span class="text-uppercase text-muted">Total</span><strong class="text-uppercase" id="cart_mini_total"><?=number_format($cartamount,2);?></strong></div>
                              <!-- buttons-->
                              <div class="d-flex justify-content-between"><a class="btn btn-link text-dark mr-3" href="<?= Url::to(['/cart']); ?>">View Cart <i class="fa-arrow-right fa"></i></a><a class="btn btn-outline-dark" href="<?= Url::to(['/checkout/onepage']); ?>">Checkout</a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               </div>
            </div>
         </nav>
         <!-- /Navbar -->
      </header>