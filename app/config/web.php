<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language'=>'es',
    'timeZone' => 'America/La_Paz',
    'name'=>'IETE',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
        // para desarrollo
        // '@imagePath' => '@app/web/uploads',aaaaaaaa
        // para producccion
        '@imagePath' => '@app/../uploads',
        '@imageUrl' => '/uploads'
    ],
    'modules' => [
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ],
        // 'api' => [
        //     'class' => 'app\modules\api\api',
        // ],
        'admin' => [
            'class' => 'app\components\mdmsoftrbac\Module',
            'layout' => 'top-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            'controllerMap' => [
                'user' => [
                    'class' => 'app\controllers\UserController',
                ],
                'assignment' => [
                    'class' => 'app\controllers\AssignmentController',
                    'userClassName' => 'app\models\User',
                    'searchClass' => 'app\models\searchs\UserSearch'
                ],
                'role'=>[
                    'class' => 'app\controllers\RoleController',
                ],
                'route'=>[
                    'class' => 'app\controllers\RouteController',
                ],
            ],
        ],
        'db-manager' => [
            'class' => 'bs\dbManager\Module',
            //for dev enviroment
            'path' =>dirname(__DIR__).'\backups',
            //for production enviroment
            // 'path' =>dirname(__DIR__).'/backups',
            'dbList' => ['db'],
            'customRestoreOptions' => [
                'mysqlForce' => '--force',
                'pgForce' => '-f -d',
            ],
        ],
    ],
    'components' => [
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '7FOYOh1t0ArDaURyJdH8_k-svq-LgoPa',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            // 'enableAutoLogin' => true,
            'loginUrl' => ['admin/user/login'],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'transport' => [
                'class' => Swift_SmtpTransport::class,
                'host' => 'mail.c0520411.ferozo.com',
                'username' => 'willam.m.g@rnova.net',
                'password' => '',
                'port' => '25',
                'encryption' => 'tls',
            ],
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
        'db' => $db,
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'assetManager' => [
            'bundles' => [
                'yii\web\JqueryAsset' => [
                    // 'sourcePath' => null,   // do not publish the bundle
                    'js' => [
                        // YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'// for enviroment production in min.js
                        'jquery.min.js'
                    ]
                ],
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [
                        'css/bootstrap.min.css'
                    ],
                ],
                'yii\bootstrap\BootstrapPluginAsset' => [
                    'js' => [
                        'js/bootstrap.min.js'
                    ]
                ],
                'dosamigos\google\maps\MapAsset' => [
                    'options' => [
                        'key' => 'AIzaSyBUf2cDjX6QTyLvUYGe5IQs748Sn_UzBKs',
                        // 'language' => 'es',
                        // 'version' => '3.1.18'
                    ]
                ],
                // 'kartik\form\ActiveFormAsset' => [
                //     'bsDependencyEnabled' => false // do not load bootstrap assets for a specific asset bundle

                // ],
            ],
            // 'forceCopy' => YII_ENV_DEV ? true : false,// for enviroment production it's in true
            'appendTimestamp' => false,// for enviroment production
        ],
        'session' => [
            'class' => 'yii\web\DbSession',

            // Set the following if you want to use DB component other than
            // default 'db'.
            // 'db' => 'mydb',

            // To override default session table, set the following
            // 'sessionTable' => 'my_session',
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@app/messages',
                    'sourceLanguage' => 'en',
                    'fileMap' => [
                        'app' => 'yii.php',
                        'app/error' => 'error.php',
                    ],
                ],
            ],
        ],
        'formatter' => [
            'locale'=>'es',
            'timeZone' => 'America/La_Paz', 
            'timeFormat' => 'HH:mm', 
            'dateFormat' => 'yyyy-MM-dd',
            // 'dateFormat' => 'dd/MM/yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => ' ',
            'currencyCode' => 'Bs.',
        ],
        // 'userCounter' => array(
        //     // Use this when you copied the file to components folder
        //     // 'class' => 'application.components.contador.UserCounter',
        //     'class' => 'app\components\contador\UserCounter',

        //     // ... or this for extensions folder
        //     // 'class' => 'ext.UserCounter',
        //     // 'class' => 'UserCounter',

        //     // You can setup these options:
        //     'tableUsers' => 'pcounter_users',
        //     'tableSave' => 'pcounter_save',
        //     'autoInstallTables' => true,
        //     'onlineTime' => 10, // min
        // ),
    ],
    'params' => $params,
    'as access' => [
        'class' => 'app\components\mdmsoftrbac\components\AccessControl',
        'allowActions' => [
            //for dev enviroment
            'debug/*',
            'admin/*',
            'api/*',

            //for prod enviroment
            'admin/user/login',
            'admin/user/logout',
            'admin/user/request-password-reset',
            'admin/user/reset-password',
            //'site/*',
        ]
    ],
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [
            'crud' => [ // generator name
                'class' => 'yii\gii\generators\crud\Generator', // generator class
                'templates' => [ //setting for out templates
                    'material-dashboard' => '@app/templates/crud/default', // template name => path to template
                ]
            ]
        ],
        // uncomment the following to add your IP if you are not connecting from localhost.
        //'allowedIPs' => ['127.0.0.1', '::1'],
    ];
}

return $config;