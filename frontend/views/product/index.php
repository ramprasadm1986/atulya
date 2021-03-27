<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use common\models\CatalogProductAttribute;
use common\models\CatalogProductAttributesOption;

/* @var $this yii\web\View */

$this->title = $product->name;
?>
    <section class="hero">
         <div class="container">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb justify-content-center">
               <li class="breadcrumb-item"><a href="index.html">Home</a></li>
               <li class="breadcrumb-item active">Handloom Sarees        </li>
            </ol>
            <!-- Hero Content-->
            <div class="hero-content pb-5 text-center">
               <h1 class="hero-heading">Handloom Saree</h1>
               <div class="row">
                  <div class="col-xl-8 offset-xl-2">
                     <p class="lead text-muted">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt.</p>
                  </div>
               </div>
            </div>
         </div>
    </section>
    <div class="container-fluid blogcontainer" style="margin-top:0px;">
        <div class="row">
            <div class="col-lg-6">
                <div class="row">
                       <?php foreach($product->getGalleryImages() as $image) : ?>
                    <div class="col-md-6" style="padding:3px;">
                        <img src="<?= $image;?>" style="width:100%; height:auto;"/>
                    </div>
                      <?php endforeach;?>
                </div>
                <div class="owl-carousel owl-theme owl-dots-modern detail-full" data-slider-id="1" style="display:none;">
                  <div class="detail-full-item-modal" style="background: center center url('<?= $product->getImage();?>') no-repeat; background-size: contain;">  </div>
                  
                  <?php foreach($product->getGalleryImages() as $image) : ?>
                  <div class="detail-full-item-modal" style="background: center center url('<?= $image;?>') no-repeat; background-size: contain;">  </div>
                  <?php endforeach;?>
                 
                </div>
            </div>
            <div class="d-flex col-lg-6 col-xl-5 pl-lg-5 mb-5 order-1 order-lg-2">
                <div class="col-lg-12"> 
                  <h3 class="mb-4 mt-4 mt-lg-1"><?= $product->name ?></h3>
                  <div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-sm-between mb-4">
                  <?=$product->getSalePrice("
                    <ul class='list-inline mb-2 mb-sm-0'>
                      <li class='list-inline-item h4 font-weight-light mb-0'>{{sell_price}}</li>
                      <li class='list-inline-item text-muted font-weight-light'> 
                        <del>{{price}}</del>
                      </li>
                    </ul>");?>
                    <!-- div class="d-flex align-items-center">
                      <ul class="list-inline mr-2 mb-0">
                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item mr-0"><i class="fa fa-star text-primary"></i></li>
                        <li class="list-inline-item mr-0"><i class="fa fa-star text-gray-300"></i></li>
                      </ul><span class="text-muted text-uppercase text-sm">25 reviews</span>
                    </div -->
                  </div>
                  <p class="mb-4 text-muted">
                      
                      <span style="color:#f0802e; font-size:15px; font-weight:bold;">SKU: <?=$product->sku;?></span>
                  
                  <br /><?=$product->short_description;?></p>
                  
                    <div class="row">
                    <div class="col-12 col-lg-6 detail-option mb-5">
                        <label class="detail-option-heading font-weight-bold">Items <span>(required)</span></label>
                        <input class="form-control detail-quantity" name="items" value="1" type="number">
                    </div>
                    <?php  
                    $CPAttribute_ids=[];
                    foreach($product->cPAttributes as $CPAttribute): ?>
                   <?php $CPAttribute_ids[]='attribute_id'.$CPAttribute->id;?>
                    <?= Html::dropDownList($CPAttribute->name, null,
                    ArrayHelper::map(CatalogProductAttributesOption::find()->where(['attribute_id'=>$CPAttribute->id])->all(), 'name', 'name'),['id'=>'attribute_id'.$CPAttribute->id,'prompt' =>'Select '.$CPAttribute->name,'onchange'=>"SwitchPrice();"]) ?>
                    <?php endforeach;?>
                      
                      
                       <?php if($product->IsVariable()):?>
                       <a class="sales-36-products" href="#" id="variable_price"> </a>
                       <?php endif;?>
                    
                    </div>
                    <ul class="list-inline">
                      <li class="list-inline-item">
                        <button class="btn btn-info btn-lg mb-1" onclick="addtoCart('<?=Url::to(['/cart/add'])?>',<?=$product->id?>,true)"> <i class="fa fa-shopping-cart mr-2"></i>Add to Cart</button>
                      </li>
                      <li class="list-inline-item"><a class="btn btn-outline-secondary mb-1" href="<?= Url::to(['/checkout/onepage']); ?>"> <i class="far fa-heart mr-2"></i>Proceed to Checkout</a></li>
                      
                    </ul>
                  
                </div>
            </div>
        </div>
    </div>
    	  <section class="mt-5">
      <div class="container-fluid blogcontainer">
        <ul class="nav nav-tabs flex-column flex-sm-row" role="tablist">
          <li class="nav-item"><a class="nav-link detail-nav-link active" data-toggle="tab" href="#description" role="tab" aria-selected="false">Description</a></li>
         
        </ul>
        <div class="tab-content py-4">
          <div class="tab-pane px-3 active" id="description" role="tabpanel">
           <p><?=$product->description;?></p>
          </div>
    
        </div>
      </div>
    </section>









      
<script>

var price_variation=<?= json_encode($ProductVariation['price']);?>;
var variation_ids=<?= json_encode($ProductVariation['ids']);?>;
var CPAttribute_ids=<?= json_encode($CPAttribute_ids);?>;

</script>