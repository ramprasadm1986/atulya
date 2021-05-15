<?php
namespace common\modules\promo\assets;
use yii\web\AssetBundle;

    class PromoAsset extends AssetBundle
    {
        // the alias to your assets folder in your file system
        public $sourcePath = '@promo-assets';
        public $baseUrl = '@web';
       
        // finally your files.. 
        public $css = [
          'css/coupon.css'
        ];
        public $js = [
          'js/coupon.js'
        ];
        // that are the dependecies, for makeing your Asset bundle work with Yii2 framework
        public $depends = [
           'backend\assets\AppAsset',
          
        ];
        
        
    }  


?>