<?php
return [
    'id' => 'api_iete',
    // the basePath of the application will be the `micro-app` directory
    'basePath' => __DIR__,
    'language'=>'es',
    'timeZone' => 'America/La_Paz',
    'name'=>'API IETE',
    // this is where the application will find all controllers
    'controllerNamespace' => 'app\controllers',
    //acccion por defecto
    'defaultRoute' => 'user/index',
    // set an alias to enable autoloading of classes from the 'micro' namespace
    'aliases' => [
        '@app' => __DIR__,
        // '@imagePath' => '@app/../uploads',
        '@imagePath' => 'uploads',
        '@imageUrl' => '/uploads',
        '@images' => 'http://ietebackend.test/uploads',
        '@images1' => 'http://ietebackend.test/api/uploads',
    ],
    'components'=>[
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=db_iete',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'formatter' => [
            'dateFormat' => 'dd.MM.yyyy',
            'decimalSeparator' => '.',
            'thousandSeparator' => '',
            // 'currencyCode' => 'EUR',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableSession'=>false,
            'loginUrl'=>null,
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
        'urlManager' => [
            'class' => 'yii\web\UrlManager',
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                ['class' => 'yii\rest\UrlRule', 'controller' => 'user'],
            ],
        ],
        'request' => [
            'parsers' => [
                'application/json' => 'yii\web\JsonParser',
            ],
            'enableCookieValidation'=>false,
            'enableCsrfValidation'=>false,
        ],
        // 'response' => [
        //     'format' => yii\web\Response::FORMAT_JSON,
        //     // ...
        // ]
        'response' => [
            'class' => 'yii\web\Response',
            // 'on beforeSend' => function ($event) {
            //     $response = $event->sender;
            //     if ($response->data !== null && !empty(Yii::$app->request->get['suppress_response_code'])) {
            //         $response->data = [
            //             'success' => $response->isSuccessful,
            //             'data' => $response->data,
            //         ];
            //         $response->statusCode = 200;
            //     }
            // },
            'on beforeSend' => function ($event) {
                $response = $event->sender;
                if ($response->data !== null) {
                    $response->data = [
                        'success' => $response->isSuccessful,
                        'data' => $response->data,
                    ];
                    // $response->statusCode = 200;
                }
            },
            'format' => yii\web\Response::FORMAT_JSON,
            'formatters' => [
                \yii\web\Response::FORMAT_JSON => [
                    'class' => 'yii\web\JsonResponseFormatter',
                    'prettyPrint' => YII_DEBUG, // use "pretty" output in debug mode
                    'encodeOptions' => JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE,
                    // ...
                ],
            ],
        ],
    ],
    'controllerMap' => [
        'migrate' => [
            'class' => 'yii\console\controllers\MigrateController',
            'migrationNamespaces' => [
                'app\migrations',
                'some\extension\migrations',
            ],
            //'migrationPath' => null, // allows to disable not namespaced migration completely
        ],
    ],
];