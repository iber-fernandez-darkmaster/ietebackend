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
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    
    public $css = ['css/bootstrap-select.min.css'];
    
    public $js = [
        //generador de codigo de barras ______________
        // YII_ENV_DEV ? 'js/plugins/jquery-barcode/jquery-barcode.js' : 'js/plugins/jquery-barcode/jquery-barcode.min.js',   
        // lienzzo camvas para html ________________
        // YII_ENV_DEV ? 'js/plugins/html2canvas/html2canvas.js' : 'js/plugins/html2canvas/html2canvas.min.js',   
        // 'js/bootstrap-select.min.js'
    ];

    // public $jsOptions = [
    //     'position' => \yii\web\View::POS_HEAD
    // ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
    }
}