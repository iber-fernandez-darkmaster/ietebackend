<?php

$params = require __DIR__ . '/params.php';
$db = require __DIR__ . '/db.php';

$config = [
    'id' => 'basic-console',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'controllerNamespace' => 'app\commands',
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'modules'=>[
        'db-manager' => [
            'class' => 'bs\dbManager\Module',
            // path to directory for the dumps
            'path' => '@app/backups',
            // list of registerd db-components
            'dbList' => ['db'],
        ],
        'audit' => [
            'class' => 'bedezign\yii2\audit\Audit',
            // 'class' => 'app\components\auditoria\Audit',
            'ignoreActions' => ['audit/*', 'debug/*'],
            'layout' => '@app/views/layouts/main.php',
            'db' => 'db', 
            'maxAge' => 0, // 30 days
            'panels' => [
                'audit/log' => [
                    'maxAge' => 0, // 7 days
                ],
            ],
            'userIdentifierCallback' => ['app\models\User', 'userIdentifier'],
            // 'panels' => [
            //     // panel_id => array of options or string containing class
            //     'app/views' => 'app\panels\ViewsPanel',
            // ],
        ],
    ],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => $db,
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\PhpManager'
        ],
        'user' => [
            'class' => 'yii\web\User',
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
            // 'enableAutoLogin' => false,
            // 'enableSession' => false,
            // 'loginUrl' => ['admin/user/login'],
        ],
        'session' => [
            // 'class' => 'yii\web\DbSession',
            'class' => 'yii\web\Session',
            // 'name' => 'admin',
			// 'savePath' => __DIR__ . '/../tmp',
            // Set the following if you want to use DB component other than
            // default 'db'.
            // 'db' => 'mydb',

            // To override default session table, set the following
            // 'sessionTable' => 'my_session',
        ],
    ],
    'params' => $params,
    // 'as access' => [
    //     'class' => 'app\components\mdmsoftrbac\components\AccessControl',
    //     'allowActions' => [
    //         // //for dev enviroment
    //         // 'debug/*',
    //         // // 'admin/*',

    //         // //for prod enviroment
    //         // 'admin/user/login',
    //         // 'admin/user/logout',
    //         // 'admin/user/request-password-reset',
    //         // 'admin/user/reset-password',
    //         // 'asistencia-estudiante/index',
    //         // 'asistencia-estudiante/incorrecto',
    //         // 'asistencia-estudiante/backindex',
    //         // 'asistencia-estudiante/registrar-asistencia',
    //         // 'asistencia-estudiante/seleccionar-inscripcion',
    //         // // actualiza el estado de los casillero y 
    //         // // genera lasasignacioens con deuda
    //         // 'casillero/cron-task-casilleros',
    //         'subtask/index',
    //         'subtask/mensualidades',
    //     ]
    // ],
    /*
    'controllerMap' => [
        'fixture' => [ // Fixture generation command line.
            'class' => 'yii\faker\FixtureController',
        ],
    ],
    */
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
    ];
}

return $config;
