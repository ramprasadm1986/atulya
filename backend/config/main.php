<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-backend',
    'name'=> 'Atulya Karigari Admin',
	'homeUrl' => Yii::getAlias('@backendUrl'),
    'basePath' => dirname(__DIR__),
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log'],
    'modules' => [
		'treemanager' =>  [
			'class' => '\kartik\tree\Module',
			// other module settings, refer detailed documentation
		]
	],
    'controllerMap' => [
        'elfinder' => [
            'class' => 'ramprasadm1986\elfinder\Controller',
            'access' => ['@'],
            'disabledCommands' => ['netmount'],
            'plugin' => [
                [
                    'class'=>'\ramprasadm1986\elfinder\plugin\Sluggable',
                    'lowercase' => true,
                    'replacement' => '-'
                ]
             ],
             'connectOptions' => [
                'bind' => [
                    'upload.pre mkdir.pre mkfile.pre rename.pre archive.pre ls.pre' =>[
                            'Plugin.Sanitizer.cmdPreprocess'
                    ],
                    'ls' =>[
                        'Plugin.Sanitizer.cmdPostprocess'
                    ],
                    'upload.presave' => [
                        'Plugin.Sanitizer.onUpLoadPreSave'
                    ]
                ],
                'plugin' => [
                    'Sanitizer' => [
                        'enable' => true,
                        'targets'  => ['\\','/',':','*','?','"','<','>','|'], // target chars
                        'replace'  => '_'    // replace to this
                   ]
                ],
            ],
            'roots' => [
                [
					'baseUrl' => '@storageUrlNonProtocal',
                    'basePath' => '@storage',
                    'path' => '/',
                    'access' => ['read' => true, 'write' => true],
                   
                    'options' => [
                        
                       'tmbPath' => Yii::getAlias('@storage').'/thumbnails',
                       'tmbURL' => Yii::getAlias('@storageUrlNonProtocal').'/thumbnails',
                       'tmbSize' => '512',
   
                       'attributes' => [
                            [
                                'pattern' => '#.*(\.gitignore|\.htaccess)$#i',
                                'read' => false,
                                'write' => false,
                                'hidden' => true,
                                'locked' => true,
                            ],
                        ],
                    ],
					'name'=> "Storage",
                    'plugin' => [
                                        'Sluggable' => [
                                            'lowercase' => true,
                                        ],
                                        'Sanitizer' =>[
                                            'enable' => true,
                                            'targets'  => array('\\','/',':','*','?','"','<','>','|'), // target chars
                                            'replace'  => '_'    // replace to this
                                        ]
                                 ]
                ],
            ],
        ],
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
            'baseUrl' => '/backend',
        ],
        
        'user' => [
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true,'sameSite'=>'strict'],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
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
       
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'sidebarMenu' => [
            'class' => 'backend\components\SidebarMenu',
        ],
        'assetManager' => [
            'baseUrl' => '@backendUrl/assets'
        ],
        'i18n' => [
			'translations' => [
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@backend/messages', // if advanced application, set @frontend/messages
					'sourceLanguage' => 'en',
					'fileMap' => [
						//'main' => 'main.php',
					],
				],
			],
		],
       
    ],
    'params' => $params,
];
