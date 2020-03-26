<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/login.css',
        'css/material-dashboard.css',
        'css/iconfont/material-icons.css',
    ];
    public $js = [
        YII_ENV_DEV ? 'js/material.min.js' : 'js/material.min.js',
        YII_ENV_DEV ? 'js/bootstrap-notify.js' : 'js/bootstrap-notify.min.js',
        YII_ENV_DEV ? 'js/material-dashboard.js' : 'js/material-dashboard.min.js',
        YII_ENV_DEV ? 'js/superfish.js' : 'js/superfish.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapPluginAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}