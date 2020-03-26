<?php
return [
    'id' => 'api_modernadallas',
    // the basePath of the application will be the `micro-app` directory
    'basePath' => __DIR__,
    // this is where the application will find all controllers
    'controllerNamespace' => 'app\controllers',
    //acccion por defecto
    'defaultRoute' => 'site/index',
    // set an alias to enable autoloading of classes from the 'micro' namespace
    'aliases' => [
        '@app' => __DIR__,
    ],
    'components'=>[
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=db_modernadallasv322',
            'username' => 'root',
            'password' => '',
            'charset' => 'utf8',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            // 'enableAutoLogin' => true,
            // 'loginUrl' => ['admin/user/login'],
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
            ]
        ],
        // 'response' => [
        //     'format' => yii\web\Response::FORMAT_JSON,
        //     // ...
        // ]
        'response' => [
            // ...
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
    ]
];