<?php
use yii\helpers\Url;
use frontend\widgets\CategorySidebar;

/* @var $this yii\web\View */

$currentCategory=$this->context->getCurrentCategory();
$this->title = $currentCategory->name;
    
    
    
?>
<style>
.nav-pills .nav-link{background:#fff; border:1px solid #dedede;}
    a{color:#555; }
</style>
    <section class="hero">
         <div class="container">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb justify-content-center">
               <?= $this->context->getBreadcrumbs();?>
            </ol>
            <!-- Hero Content-->
            <div class="hero-content pb-5 text-center">
               <h1 class="hero-heading"><?= $currentCategory->name ?></h1>
               <div class="row">
                  <div class="col-xl-8 offset-xl-2">
                     <p class="lead text-muted"><?= $currentCategory->description ?></p>
                  </div>
               </div>
            </div>
         </div>
      </section>
    <div class="container-fluid">
         <div class="row">
            <!-- Grid -->
            <div class="products-grid col-xl-10 col-lg-9 order-lg-2">
               <div class="product-grid-header">
                  <div class="mr-3 mb-3">
                    Showing <strong> <?= ($pages->getPage()*$pages->getPageSize())+1?($pages->getPage()*$pages->getPageSize())+1:1?> - <?= (($pages->getPage()*$pages->getPageSize())+$pages->getPageSize())<=$pages->totalCount?(($pages->getPage()*$pages->getPageSize())+$pages->getPageSize()):$pages->totalCount?> </strong>of <strong><?= $pages->totalCount;?> </strong>products
                  </div>
                 
                  <div class="mb-3 d-flex align-items-center">
                     <span class="d-inline-block mr-1">Sort by</span>
                     <select class="custom-select w-auto border-0" name="orderby">
                        <option value="orderby_0">Default</option>
                        <option value="orderby_1">Popularity</option>
                        <option value="orderby_2">Rating</option>
                        <option value="orderby_3">Newest first</option>
                     </select>
                  </div>
               </div>
               <div class="row">
               <?php foreach($products as $product): ?>
                  <!-- product-->
                    <div class="col-xl-3 col-sm-6">
                        <div class="product">
                            <div class="product-image">
                               <!--div class="ribbon ribbon-info">Fresh</div-->
                               <img class="img-fluid" src="<?=$product->base_image;?>" alt="<?=$product->name;?>">
                               <div class="product-hover-overlay">
                                    <a class="product-hover-overlay-link" href="<?=Url::toRoute(['/product/'.$product->slug]);?>"></a>
                                    <div class="product-hover-overlay-buttons">
                                        <a class="btn btn-outline-dark btn-product-left" href="javascript:void(0);" onclick="addtoCart('<?=Url::to(['/cart/add'])?>',<?=$product->id?>)"><i class="fa fa-shopping-cart"></i></a>
                                        <a class="btn btn-info btn-buy" href="<?=Url::toRoute(['/product/'.$product->slug]);?>"><i class="fa-search fa"></i><span class="btn-buy-label ml-2">View</span></a>
                                    </div>
                               </div>
                            </div>
                            <div class="py-2">
                               <!--p class="text-muted text-sm mb-1"><?=$product->name;?></p-->
                               <h3 class="h6 text-uppercase mb-1"><a class="text-dark" href="<?=Url::toRoute(['/product/'.$product->slug]);?>"><?=$product->name;?></a></h3>
                               <span class="text-muted"><?=$product->getSalePrice("<del>{{price}}</del>{{sell_price}}")?></span>
                            </div>
                        </div>
                    </div>
                  <!-- /product-->
                <?php endforeach;?>
                  
               </div>
               <nav class="d-flex justify-content-center mb-5 mt-3" aria-label="page navigation">
               <?= yii\widgets\LinkPager::widget(['pagination' => $pages,'maxButtonCount'=>3 ,'prevPageLabel'=>'Prev','prevPageCssClass'=>'page-item','nextPageLabel'=>"Next",'nextPageCssClass'=>'page-item','options'=>['class'=>"pagination"],'linkContainerOptions'=>['class'=>"page-item"],'linkOptions'=>['class'=>"page-link"],'disabledListItemSubTagOptions' => ['tag' => 'a', 'class' => 'page-link'],'hideOnSinglePage'=>false]);?> 
               </nav>
                
            </div>
            <!-- / Grid End-->
            <!-- Sidebar-->
            <div class="sidebar col-xl-2 col-lg-3 order-lg-1">
            <?php if(count($this->context->getCategoryFiletrs())):?>
               <div class="sidebar-block px-3 px-lg-0 mr-lg-4">
                  <a class="d-lg-none block-toggler" data-toggle="collapse" href="#categoriesMenu" aria-expanded="false" aria-controls="categoriesMenu">Product Categories</a>
                  <div class="expand-lg collapse" id="categoriesMenu">
                   <h6 class="sidebar-heading d-none d-lg-block">Product Categories</h6>
                   
                    <div class="nav nav-pills flex-column mt-4 mt-lg-0">
                    <?php echo CategorySidebar::widget([
                            'items' =>$this->context->getCategoryFiletrs(),
                            'options'=>['class'=>'nav nav-pills flex-column '],
                            'itemOptions'=>['class'=>'nav-link mb-2']
                            
                            ]);
                        ?>
                    </div>
                    
                  </div>
               </div>
               <?php  endif;?>
             
            </div>
            <!-- /Sidebar end-->
         </div>
      </div>