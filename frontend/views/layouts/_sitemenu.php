<?php
use yii\helpers\Url;
use frontend\models\CatalogCategory;


$categories=CatalogCategory::getFullTreeInline();

foreach($categories as $category) {

?>
<li class="nav-item dropdown position-static">
    <a class="nav-link" href="<?= $category['url'] ?>" data-toggle="dropdown">
    <?= $category['label'] ?><i class="fa fa-angle-down"></i>
    </a>
    <div class="dropdown-menu megamenu py-lg-0">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-10">
                <div class="row  p-3 pr-lg-0 pl-lg-5 pt-lg-5"> 
                    <?php $i=0; ?>
                    <?php foreach($category['items'] as $l2subitems){  ?>   
                    
                    <?php if($i==0) { 
                    if(count($category['items'])<=6 )
                        $seg=4;
                        
                    else 
                        $seg=3;
                    ?>
                    <div class="col-lg-<?= $seg; ?>">
                    <?php } 
                    
                    $i++;
                    ?>
                        
                      <!-- Megamenu list-->
                      <h6 class="text-uppercase"><a class="megamenu-list-link" href="<?= $l2subitems['url'] ?>"><?= $l2subitems['label'] ?></a></h6>
                      
                     <?php  if(count($l2subitems['items'])){ ?>
                      <ul class="megamenu-list list-unstyled">
                        <?php foreach($l2subitems['items'] as $l3subitems){ ?>     
                        <li class="megamenu-list-item"><a class="megamenu-list-link" href="<?= $l3subitems['url'] ?>"><?= $l3subitems['label'] ?></a></li>
                        
                        <?php }?>
                      </ul>
                      <?php } ?>
                      
                     
                      <?php if( $i == 2) {
                          $i=0;
                          ?>
                          </div>
                          
                     <?php  }?>
                    
                    
                    
                    <?php }?>
                    
                    <?php if( $i != 0) {
                          $i=0;
                          ?>
                          </div>
                          
                     <?php  }?>
                    
                   
                </div>
            </div>
            <div class="col-lg-1"></div>
        </div>
    </div>
</li>
<?php } ?>