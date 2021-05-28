<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'name'=> 'Atulya Karigari',
    'basePath' => dirname(__DIR__),
    'homeUrl' => Yii::getAlias('@frontendUrl'),
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap'  => ['assetsAutoCompress'],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
            'baseUrl' => '',
        ],
        'user' => [
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true,'sameSite'=>'strict'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
           'name' => 'advanced-frontend',
            
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'baseUrl' => '@frontendUrl/assets'
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                '<controller:[\w\-]+>/<action:[\w\-]+>/<id:\d+>' => '<controller>/<action>',
                'category/index' => 'category/index',
                'category/search' => 'category/search',
                'category/<slug>' => 'category/index',
                'cms-page/<slug>' => 'cms-page/index',
                'product/<slug>' =>  'product/index',
            ],
        ],
        'assetsAutoCompress' => [
            'class'   => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'enabled' => true,

            'readFileTimeout' => 3,           //Time in seconds for reading each asset file

            'jsCompress'                => true,        //Enable minification js in html code
            'jsCompressFlaggedComments' => true,        //Cut comments during processing js

            'cssCompress' => true,        //Enable minification css in html code
            
            'cssFileCompile'        => true,        //Turning association css files
            'cssFileCompileByGroups' => false,       //Enables the compilation of files in groups rather than in a single file. Works only when the $cssFileCompile option is enabled
            'cssFileRemouteCompile' => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
            'cssFileCompress'       => true,        //Enable compression and processing before being stored in the css file
            'cssFileBottom'         => false,       //Moving down the page css files
            'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js

            'jsFileCompile'                 => true,        //Turning association js files
            'jsFileCompileByGroups'         => false,        //Enables the compilation of files in groups rather than in a single file. Works only when the $jsFileCompile option is enabled
            'jsFileRemouteCompile'          => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress'                => true,        //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js

            'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests when all pjax requests when enabled jsFileCompile
            'noIncludeCssFilesOnPjax' => true,        //Do not connect the css files when all pjax requests when all pjax requests when enabled cssFileCompile

            'htmlFormatter' => [
                //Enable compression html
                'class'         => 'skeeks\yii2\assetsAuto\formatters\html\TylerHtmlCompressor',
                'extra'         => true,       //use more compact algorithm
                'noComments'    => true,        //cut all the html comments
                'maxNumberRows' => 50000,       //The maximum number of rows that the formatter runs on

                //or

                //'class' => 'skeeks\yii2\assetsAuto\formatters\html\MrclayHtmlCompressor',

                //or any other your handler implements skeeks\yii2\assetsAuto\IFormatter interface

                //or false
            ],
        ],
        
    ],
    'params' => $params,
];
