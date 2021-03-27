<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@frontendUrl';
    public $css = [
        'css/style.css',
        'css/rangeslider.css'
       
    ];
    public $js = [
		'js/main.js',
		'js/cart.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'rmrevin\yii\fontawesome\AssetBundle',
        'kv4nt\owlcarousel\OwlCarouselAsset'
    ];
}
