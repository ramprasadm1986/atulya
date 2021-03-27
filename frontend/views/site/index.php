<?php
use yii\helpers\Url;

?>

 <?php
 
 
 
 $this->title = 'Atulya Karigari';
 ?>
 
<?php if (Yii::$app->hasModule('banner')): ?>
    <section class="home-full-slider-wrapper mb-10px">
         <!-- Hero Slider-->
         <div class="owl-carousel owl-theme owl-dots-modern home-slider owl-loaded owl-drag">
            <div class="owl-stage-outer">
               <div class="owl-stage" style="transform: translate3d(-3166px, 0px, 0px); transition: all 0s ease 0s; width: 11081px;">
               
                <?php foreach (Yii::$app->getModule('banner')->getHomeBanners() as $slides): ?>
                    <div class="owl-item" style="width: 1583px;">
                         <div class="item d-flex align-items-center" style="background: rgb(248, 213, 207) none repeat scroll 0% 0%; height: 642.55px;">
                            <img class="bg-image" src="<?=$slides->image; ?>" alt="<?=$slides->title ?>">
                                <div class="container-fluid h-100 py-5 mt-5" style="margin-top: 600px !important;">
                                   <div class="row">
                                          <div class="col-lg-8 col-xl-6  text-white" >
                                                 <!--h5 class="text-uppercase text-white font-weight-light mb-4 letter-spacing-5"> Just arrived</h5-->
                                                 <h1 class="mb-3 text-uppercase  text-serif" style="font-size:22px; padding-top:15px;"><?=$slides->title ?></h1>
                                                <p class="lead mb-3 text-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit, <br/>sed do eiusmod tempor incididunt ut labore<br/> et dolore magna aliqua.</p>
                                                <?php if($slides->link_to!=""):?>
                                                    <p> <a class="btn btn-dark" href="<?=Url::toRoute([$slides->link_to]); ?>">View collection</a></p>
                                                 <?php endif; ?>
                                          </div>
                                   </div>
                                </div>
                         </div>
                    </div>
                <?php endforeach; ?>  
                 
               </div>
            </div>
            <div class="owl-nav"><button type="button" role="presentation" class="owl-prev"><i class="fa fa-chevron-left"></i></button><button type="button" role="presentation" class="owl-next"><i class="fa fa-chevron-right"></i></button></div>
            <div class="owl-dots disabled"></div>
            <div class="owl-thumbs"></div>
         </div>
    </section>
<?php endif; ?>



    <section style="margin-top:60px;">
        <div class="container-fluid px-5px">
            <div class="row mx-0">
               <div class="col-lg-4 mb-10px px-5px">
                  <div class="card border-0 text-center text-white">
                     <img class="card-img" src="<?= Yii::getAlias('@storageUrlNonProtocal')."/home_images/image1.jpg"?>" alt="Card image">
                     <div class="card-img-overlay d-flex align-items-center">
                        <div class="w-100">
                           <h3 class=" mb-4">Khandua Silk Tie</h3>
                           <a class="btn btn-link text-white" href="<?=Url::toRoute(['category/category-1']); ?>">Shop now <i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 mb-10px px-5px">
                  <div class="card border-0 text-center text-white">
                     <img class="card-img" src="<?= Yii::getAlias('@storageUrlNonProtocal')."/home_images/banarasi.jpg"?>" alt="Card image">
                     <div class="card-img-overlay d-flex align-items-center">
                        <div class="w-100">
                           <h3 class="mb-4">Banarasi Silk Saree</h3>
                           <a class="btn btn-link text-white" href="<?=Url::toRoute(['category/category-2']); ?>">Shop now <i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-4 mb-10px px-5px">
                  <div class="card border-0 text-center text-white">
                     <img class="card-img" src="<?= Yii::getAlias('@storageUrlNonProtocal')."/home_images/dhokra.jpg"?>" alt="Card image">
                     <div class="card-img-overlay d-flex align-items-center">
                        <div class="w-100">
                           <h3 class=" mb-4">Dhokra</h3>
                           <a class="btn btn-link text-white" href="<?=Url::toRoute(['category/category-3']); ?>">Shop now <i class="fa-arrow-right fa ml-2"></i></a>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </div>
    </section>
    
    
<?php if (Yii::$app->hasModule('featuredproducts')): ?>
    <section class="py-4 bg-gray-100">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-8 mx-auto text-center mb-5">
                  <h2 class="text-uppercase">Featured Products</h2>
                  <h4 style="letter-spacing: 1px;"> <span style="font-size: 15px;" class="text-muted text-uppercase">Top view in the week</span></h4>
               </div>
            </div>
            <!-- Products Slider-->
            <div class="owl-carousel owl-theme product-slider">
            
            <?php foreach (Yii::$app->getModule('featuredproducts')->getFeaturedProducts() as $FeaturedProduct): ?>
               <!-- product-->
                <div class="product-slider-item">
                  <div class="product">
                     <div class="product-image">
                        <img class="img-fluid" src="<?= $FeaturedProduct->getImage();?>" alt="<?=$FeaturedProduct->name;?>"/>
                        <div class="product-hover-overlay">
                           <a class="product-hover-overlay-link" href="<?=Url::toRoute(['/product/'.$FeaturedProduct->slug]);?>"></a>
                           <div class="product-hover-overlay-buttons"><a class="btn btn-dark btn-buy" href="<?=Url::toRoute(['/product/'.$FeaturedProduct->slug]);?>"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">View</span></a>
                           </div>
                        </div>
                     </div>
                     <div class="py-2">
                        <h3 class="h6 text-uppercase mb-1"><a class="text-dark" href="<?=Url::toRoute(['/product/'.$FeaturedProduct->slug]);?>"><?=$FeaturedProduct->name;?></a></h3>
                        <span class="text-muted"><?=$FeaturedProduct->getSalePrice("<del>{{price}}</del>{{sell_price}}");?></span>
                     </div>
                  </div>
                </div>
               <!-- /product-->
            <?php endforeach;?>
            
            </div>
            <div class="text-center mt-4"><a class="btn btn-dark" href="<?=Url::toRoute(['category/']); ?>">View all products</a></div>
         </div>
    </section>
 <?php endif; ?>
 <section class="py-6">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-8 mx-auto text-center mb-5">
                  <h3 class="text-uppercase">Online Sarees Shopping with Worldwide Delivery</h3>
               </div>
            </div>
            <div class="row">
               <!-- post-->
               <div class="col-lg-4 col-6">
                  <div class="mb-30px">
                     <a href="post.html"><img class="img-fluid" src="http://atulyakarigari.com/images/img1.jpg" alt="..."></a>
                     
                  </div>
               </div>
               <!-- /post end-->
               <!-- post-->
               <div class="col-lg-4 col-6">
                  <div class="mb-30px">
                    
                     <div class="mt-3">
                        <small class="text-uppercase text-muted">VIEW More Handloom Silk Sarees</small>
                        <h5 class="my-2"><a class="text-dark font-weight-bold" href="post.html">Direct from Weavers </a></h5>
                      
                        <p class="my-2" style="font-size:17px;">More then 5000 designs in sarees are available in stock. A range of pure silk sarees is available at your fingertips for you to explore and choose. Shop from the comforts of your surrounding and look for what you want. No bargaining or haggling, but certainly various options for online sari shopping in India, such as Cash on Delivery, a 2-day returns guarantee and so on!</p>
                        <a class="btn btn-link text-gray-700 pl-0" href="post.html">More Handloom Sarees Online<i class="fa fa-arrow-right ml-2"></i></a>
                     </div>
                  </div>
               </div>
               <!-- /post end-->
               <!-- post-->
               <div class="col-lg-4 col-6">
                  <div class="mb-30px">
                     <a href="post.html"><img class="img-fluid" src="http://atulyakarigari.com/images/img2.jpg" alt="..."></a>
                    
                  </div>
               </div>
               <!-- /post end-->
            </div>
         </div>
      </section>
<?php if (Yii::$app->hasModule('trendingproducts')): ?>
    <section class="py-5 bg-gray-100">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-8 mx-auto text-center mb-5">
                  <h2 class="text-uppercase">Trending Now</h2>
                  <h4 style="letter-spacing: 1px;"> <span style="font-size: 15px;" class="text-muted text-uppercase">Top view in the week</span></h4>
               </div>
            </div>
            <!-- Products Slider-->
            <div class="owl-carousel owl-theme product-slider">
            
            <?php foreach (Yii::$app->getModule('trendingproducts')->getTrendingProducts() as $TrendingProduct): ?>
               <!-- product-->
                <div class="product-slider-item">
                  <div class="product">
                     <div class="product-image">
                        <img class="img-fluid" src="<?= $TrendingProduct->getImage();?>" alt="<?=$TrendingProduct->name;?>"/>
                        <div class="product-hover-overlay">
                           <a class="product-hover-overlay-link" href="<?=Url::toRoute(['/product/'.$TrendingProduct->slug]);?>"></a>
                           <div class="product-hover-overlay-buttons"><a class="btn btn-dark btn-buy" href="<?=Url::toRoute(['/product/'.$TrendingProduct->slug]);?>"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">View</span></a>
                           </div>
                        </div>
                     </div>
                     <div class="py-2">
                        <h3 class="h6 text-uppercase mb-1"><a class="text-dark" href="<?=Url::toRoute(['/product/'.$TrendingProduct->slug]);?>"><?=$TrendingProduct->name;?></a></h3>
                        <span class="text-muted"><?=$TrendingProduct->getSalePrice("<del>{{price}}</del>{{sell_price}}");?></span>
                     </div>
                  </div>
                </div>
               <!-- /product-->
            <?php endforeach;?>
            
            </div>
            <div class="text-center mt-4"><a class="btn btn-dark" href="<?=Url::toRoute(['category/']); ?>">View all products</a></div>
         </div>
    </section>
 <?php endif; ?>
 
 <?php if (Yii::$app->hasModule('bestsellers')): ?>
    <section class="py-4 bg-gray-100">
         <div class="container-fluid">
            <div class="row">
               <div class="col-xl-8 mx-auto text-center mb-5">
                  <h2 class="text-uppercase">Best Seller</h2>
                  <h4 style="letter-spacing: 1px;"> <span style="font-size: 15px;" class="text-muted text-uppercase">Top view in the week</span></h4>
               </div>
            </div>
            <!-- Products Slider-->
            <div class="owl-carousel owl-theme product-slider">
            
            <?php foreach (Yii::$app->getModule('bestsellers')->getBestsellers() as $Bestseller): ?>
               <!-- product-->
                <div class="product-slider-item">
                  <div class="product">
                     <div class="product-image">
                        <img class="img-fluid" src="<?= $Bestseller->getImage();?>" alt="<?=$Bestseller->name;?>"/>
                        <div class="product-hover-overlay">
                           <a class="product-hover-overlay-link" href="<?=Url::toRoute(['/product/'.$Bestseller->slug]);?>"></a>
                           <div class="product-hover-overlay-buttons"><a class="btn btn-dark btn-buy" href="<?=Url::toRoute(['/product/'.$Bestseller->slug]);?>"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">View</span></a>
                           </div>
                        </div>
                     </div>
                     <div class="py-2">
                        <h3 class="h6 text-uppercase mb-1"><a class="text-dark" href="<?=Url::toRoute(['/product/'.$Bestseller->slug]);?>"><?=$Bestseller->name;?></a></h3>
                        <span class="text-muted"><?=$Bestseller->getSalePrice("<del>{{price}}</del>{{sell_price}}");?></span>
                     </div>
                  </div>
                </div>
               <!-- /product-->
            <?php endforeach;?>
            
            </div>
            <div class="text-center mt-4"><a class="btn btn-dark" href="<?=Url::toRoute(['category/']); ?>">View all products</a></div>
         </div>
    </section>
 <?php endif; ?>
     <section class="py-6">
         <div class="container blogcontainer" style="margin-top:0px;">
            <div class="row">
               <div class="col-xl-8 mx-auto text-center mb-5">
                  <h3 class="text-uppercase">Fashion For Everyone</h3>
               </div>
            </div>
            <div class="row">
               <!-- post-->
               <div class="col-lg-4 col-6">
                  <div class="mb-30px">
                     <a href="post.html"><img class="img-fluid" src="http://atulyakarigari.com/images/f1.jpg" alt="..."></a>
                     <div class="mt-3">
                        <small class="text-uppercase text-muted">Fashion and style </small>
                        <h5 class="my-2"><a class="text-dark" href="post.html">Pellentesque habitant morbi          </a></h5>
                        <p class="text-gray-500 text-sm my-3"><i class="far fa-clock mr-2"></i>January 16, 2016</p>
                        <p class="my-2 text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Aenean ultricies mi vitae est. </p>
                        <a class="btn btn-link text-gray-700 pl-0" href="post.html">Read more<i class="fa fa-arrow-right ml-2"></i></a>
                     </div>
                  </div>
               </div>
               <!-- /post end-->
               <!-- post-->
               <div class="col-lg-4 col-6">
                  <div class="mb-30px">
                     <a href="post.html"><img class="img-fluid" src="http://atulyakarigari.com/images/f2.jpg" alt="..."></a>
                     <div class="mt-3">
                        <small class="text-uppercase text-muted">Fashion and style </small>
                        <h5 class="my-2"><a class="text-dark" href="post.html">Best books about Fashion          </a></h5>
                        <p class="text-gray-500 text-sm my-3"><i class="far fa-clock mr-2"></i>January 16, 2016</p>
                        <p class="my-2 text-muted">Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante.  Mauris placerat eleifend leo.</p>
                        <a class="btn btn-link text-gray-700 pl-0" href="post.html">Read more<i class="fa fa-arrow-right ml-2"></i></a>
                     </div>
                  </div>
               </div>
               <!-- /post end-->
               <!-- post-->
               <div class="col-lg-4 col-6">
                  <div class="mb-30px">
                     <a href="post.html"><img class="img-fluid" src="http://atulyakarigari.com/images/f3.jpg" alt="..."></a>
                     <div class="mt-3">
                        <small class="text-uppercase text-muted">Fashion and style </small>
                        <h5 class="my-2"><a class="text-dark" href="post.html">Best books about Fashion          </a></h5>
                        <p class="text-gray-500 text-sm my-3"><i class="far fa-clock mr-2"></i>January 16, 2016</p>
                        <p class="my-2 text-muted">Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae.  Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
                        <a class="btn btn-link text-gray-700 pl-0" href="post.html">Read more<i class="fa fa-arrow-right ml-2"></i></a>
                     </div>
                  </div>
               </div>
               <!-- /post end-->
            </div>
         </div>
      </section>
    <section class="py-6 position-relative light-overlay">
         <img class="bg-image" src="http://www.atulyakarigari.com/images/banner3.jpg" alt="">
         <div class="container">
            <div class="overlay-content text-center text-light">
               <p class="text-uppercase font-weight-bold mb-1 letter-spacing-5">Old Collection                  </p>
               <h3 class="display-3  text-serif mb-4">Summer Sales</h3>
               <a class="btn btn-light" href="#">Shop Now</a>
            </div>
         </div>
    </section>
  <section class="py-6 brands">
         <div class="container-fluid blogcontainer" style="margin-top:0px;">
            <h4 class="text-uppercase text-center mb-5">Our Clients</h4>
            <!-- Brands Slider-->
            <div class="owl-carousel owl-theme brands-slider owl-loaded owl-drag">
               <div class="owl-stage-outer">
                  <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1880px;">
                     <div class="owl-item active" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-1.svg" alt="Brand 1"></div>
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-2.svg" alt="Brand 2"></div>
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-3.svg" alt="Brand 3"></div>
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-4.svg" alt="Brand 4"></div>
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-5.svg" alt="Brand 5"></div>
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-6.svg" alt="Brand 6"></div>
                        </div>
                     </div>
                     <div class="owl-item active" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-1.svg" alt="Brand 1"></div>
                        </div>
                     </div>
                     <div class="owl-item" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-2.svg" alt="Brand 2"></div>
                        </div>
                     </div>
                     <div class="owl-item" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-3.svg" alt="Brand 3"></div>
                        </div>
                     </div>
                     <div class="owl-item" style="width: 168px; margin-right: 20px;">
                        <div class="item d-flex align-items-center justify-content-center" style="height: 97.4px;">
                           <div class="w-6rem"><img class="img-fluid" src="https://d19m59y37dris4.cloudfront.net/sell/1-4/img/brand/brand-4.svg" alt="Brand 4"></div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="owl-nav disabled"><button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button><button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button></div>
            </div>
         </div>
      </section>