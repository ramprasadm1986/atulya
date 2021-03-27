<?php
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'moduleConfigs' => [
            'class' => 'common\components\ModuleConfigs',
        ],
        'PayPalPayment'=>[
            'class' => 'ramprasadm1986\paypal\PayPalPayment',
            'live'=>false,
            'intent'=>'CAPTURE',
            'client_id'=>"ASxVfF12682mL6_VP9UI9PEqOkqyZ82hOBnExl7RsooF0TKVYXC_p011Mi0L9krYs2NEtE-TrZ8YFrxf",
            'client_secret'=>"ENgz1tYiFDSBtfE1WxYOFsBK-21dZronO5XP10vJ8Q96tjlxYNSlhFHiAneIIdwAy1YaasErVTM4te3y",
            'cancel_url'=>Yii::getAlias('@frontendUrl').'/checkout/onepage/cancel',
            'return_url'=>Yii::getAlias('@frontendUrl').'/checkout/onepage/return',
            
        
        ]
        
    ],
    'bootstrap' => [
        'moduleConfigs' => [
            'class' => 'common\components\ModuleConfigs',
        ],
        'moduleLoader' => [
            'class' => 'common\components\ModuleLoader',
            'modules_paths' => [
                '@backend/modules', 
                '@frontend/modules', 
                '@common/modules'
                ]
        ],
       
    ]
];
