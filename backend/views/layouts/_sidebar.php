<?php

/**
 * @var string $content
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\helpers\Url;
?>

<div class="col-md-3 left_col menu_fixed">
	<div class=" scroll-view">

		<div class="navbar nav_title" style="border: 0;">
			<a href="<?= Url::to(['/']);?>" class="site_title"><i class="fa fa-medkit"></i> <span><?php echo Yii::$app->user->identity->username ?>!</span></a>
		</div>
		<div class="clearfix"></div>

		<!-- menu prile quick info -->
		<div class="profile clearfix">
			<div class="profile_pic">
				<img src="<?= Yii::getAlias('@storageUrl').'/default/user.png'?>" alt="..." class="img-circle profile_img">
			</div>
			<div class="profile_info">
				<span>Welcome,</span>
				<h2><?php echo Yii::$app->user->identity->username ?></h2>
			</div>
		</div>
		<!-- /menu prile quick info -->

		<br />
		<!-- sidebar menu -->
		<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

			<div class="menu_section">
				<h3>Menu</h3>
				
				
				<?=
				\yiister\gentelella\widgets\Menu::widget(
					[  
                    
						"items" => array_merge([
                                ["label" => "Home", "url" => ["/"], "icon" => "home"],
                                // [	
                                    // "label" => "Catalog", 
                                    // "url" => '#', 
                                    // "icon" => "home",
                                    // "items"=>[
                                        // ["label" => "Categories", "url" => ["/catalog-category"], "icon" => "home"],
                                        //["label" => "All Products", "url" => ["catalog-product/"], "icon" => "home",'active' => in_array($this->context->route,['catalog-product/index','catalog-product/update'])],
                                       // // ["label" => "Add Item", "url" => ["catalog-product/create"], "icon" => "home"],
                                
                                    
                                    // ]
                                // ]
                            ],
                            
                            (new \backend\components\SidebarMenu())->getItems()
                        )
                ]
		)
		?>
	</div>

</div>
<!-- /sidebar menu -->

<!-- /menu footer buttons -->
<div class="sidebar-footer hidden-small">
	<a data-toggle="tooltip" data-placement="top" title="Settings">
		<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
	</a>
	<a data-toggle="tooltip" data-placement="top" title="FullScreen" onclick="openFullscreen();">
		<span  id="fullscreen" class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
	</a>
	<a data-toggle="tooltip" data-placement="top" title="Lock">
		<span  class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
	</a>
	<a href="<?= Url::to(['/site/logout']);?>" data-toggle="tooltip" data-method="post" data-placement="top" title="Logout">
		<span class="glyphicon glyphicon-off" aria-hidden="true"></span>
	</a>
</div>
<!-- /menu footer buttons -->
</div>
</div>

<script>
	/* Get the documentElement (<html>) to display the page in fullscreen */
	var FullscreenElem = document.documentElement;
	var isFullScreen=false;
	/* View in fullscreen */
	function openFullscreen() {
		
		if(isFullScreen){
			
			if (document.exitFullscreen) {
				document.exitFullscreen();
			} else if (document.mozCancelFullScreen) { /* Firefox */
				document.mozCancelFullScreen();
			} else if (document.webkitExitFullscreen) { /* Chrome, Safari and Opera */
				document.webkitExitFullscreen();
			} else if (document.msExitFullscreen) { /* IE/Edge */
				document.msExitFullscreen();
			}
			isFullScreen=false;
		}
		else{
			if (FullscreenElem.requestFullscreen) {
				FullscreenElem.requestFullscreen();
			} else if (elem.mozRequestFullScreen) { /* Firefox */
				FullscreenElem.mozRequestFullScreen();
			} else if (elem.webkitRequestFullscreen) { /* Chrome, Safari and Opera */
				FullscreenElem.webkitRequestFullscreen();
			} else if (elem.msRequestFullscreen) { /* IE/Edge */
				FullscreenElem.msRequestFullscreen();
			}
			isFullScreen=true;
		}
		
	}


</script>