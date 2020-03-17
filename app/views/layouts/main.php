<?php

/* @var $this \yii\web\View */
/* @var $content string */

use lavrentiev\widgets\toastr\NotificationFlash;
use app\widgets\Menu;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\assets\MaterialAsset;
use yii\helpers\Url;
// para ese modal que esta registrando un externo a seminario
use yii\bootstrap\Modal;
use yii\helpers\ArrayHelper;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use app\models\Seminario;
use app\models\AsistenciaSeminario;
use yii\web\AssetBundle;
use kartik\dialog\Dialog;

MaterialAsset::register($this);
AppAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title>
        <?= Html::encode($this->title) ?>
    </title>
    <?php $this->head() ?>
</head>

<body>
    <?php $this->beginBody() ?>
    <script>const pathRoot = '<?= Url::to(["/"]) ?>';</script>

    <!-- Loading - este loding termina en material-dashboard.js -->
    <div id="loading" style="display:block">
        <div class="loading">
            <div class="lds-roller"><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div></div>
        </div>
    </div>


    <div class="wrapper">
        <input type="hidden" id="path" value="<?=Yii::getAlias('@imageUrl').'/'?>">
        <div class="sidebar hidden-print" data-color="green" data-image="<?=Url::to(['@web/images/sidebar.jpg'])?>">
            <div class="logo text-center">
                <?= Html::a(Html::img('@web/images/logo2.jpeg', ['width'=>'25px', 'height'=>'25px']), ['site/index'], ['class' => 'simple-text']) ?>
            </div>

            <div class="sidebar-wrapper">
                <?php 
                    $route = $this->context->route;
                    $menu = [];
                    
                    if (Yii::$app->user->can('Administrador')){
                        array_push($menu, [
                            'dropdownicon'=>'face', 'icon'=>'face', 'label' => 'Sistema', 'url' => ['#'], 'color'=>'text-default',
                            'items'=>[
                                ['icon'=>'directions', 'label' => 'Permisos', 'url' => ['/admin/route'] , 'color'=>'text-default'],
                                ['icon'=>'person_pin', 'label' => 'Roles', 'url' => ['/admin/role'] , 'color'=>'text-default'],
                                ['icon'=>'group', 'label' => 'Usuarios', 'url' => ['/admin/user'] , 'color'=>'text-default'],
                                ['icon'=>'verified_user', 'label' => 'Asignación', 'url' => ['/admin/assignment'] , 'color'=>'text-default'],
                                ['icon'=>'cloud_download', 'label' => 'Backups', 'url' => ['/db-manager'] , 'color'=>'text-default'],
                                ['icon'=>'pets', 'label' => 'Historial', 'url' => ['/trailslog'] , 'color'=>'text-default'],
                            ], 
                        ]);                    
                        array_push($menu, 
                            [
                                'icon'=>'assignment', 'label' => 'Informacion', 'url' => ['/informacion']
                            ]
                        );
                        array_push($menu, [
                            'dropdownicon'=>'subject', 'icon'=>'subject', 'label' => 'Materias', 'url' => ['#'], 'color'=>'text-default',
                            'items'=>[
                                ['icon'=>'store', 'label' => 'Centros', 'url' => ['/centro'] , 'color'=>'text-default'],
                                ['icon'=>'person_pin', 'label' => 'Estudiantes', 'url' => ['/estudiante'] , 'color'=>'text-default'],
                                ['icon'=>'import_contacts', 'label' => 'Materias', 'url' => ['/materia'] , 'color'=>'text-default'],
                            ], 
                        ]);
                    }
                    if (Yii::$app->user->can('Responsable Centro')){
                        array_push($menu, [
                            'dropdownicon'=>'subject', 'icon'=>'subject', 'label' => 'Materias', 'url' => ['#'], 'color'=>'text-default',
                            'items'=>[
                                ['icon'=>'person_pin', 'label' => 'Estudiantes', 'url' => ['/estudiante'] , 'color'=>'text-default'],
                            ], 
                        ]);
                    }
                ?>
                <?=Menu::widget([
                    'items' => $menu,
                    'options' =>['class' => 'nav']
                ])?>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-transparent navbar-absolute hidden-print">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 hidden-md hidden-lg hidden-xl">
                                            <button type="button" class="navbar-toggle" data-toggle="collapse">
                                                <span class="sr-only">Toggle navigation</span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                                <span class="icon-bar"></span>
                                            </button>
                                            <label class="text-uppercase">
                                                <b>
                                                    <?=Yii::$app->name?>
                                                </b>
                                            </label>
                                        </div>
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 xl-12 padding-cero hidden-xs hidden-sm">
                                            <h4 class="text-uppercase">
                                                <b>
                                                    <?=isset($this->title)?Html::encode($this->title):''?>
                                                </b>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="collapse navbar-collapse">
                        <?php 
                            $color = 'warning';
                            if (Yii::$app->user->can('directora')){
                                $color = 'danger';
                            }
                            if (Yii::$app->user->can('administrador')){
                                $color = 'success';
                            }
                        ?>
                        <?= Nav::widget([
                            'options' => ['class' => 'nav navbar-nav navbar-right'],
                            'items' => [
                                [
                                    'label' => '<i class="material-icons text-'.$color.'">person</i> '.Yii::$app->user->identity['username'],
                                    'encode'=>false,
                                    'items' => [
                                        [
                                            'label' => '<i class="material-icons">lock</i> Cambiar contraseña', 
                                            'encode'=>false,
                                            'url' => ['/admin/user/change-password', 'id'=>Yii::$app->user->identity['id']], 
                                        ],
                                        [
                                            'label' => '<i class="material-icons">exit_to_app</i> Salir', 
                                            'encode'=>false, 
                                            'url' => ['/admin/user/logout'], 
                                            'linkOptions'=>['data-method'=>'post'], 
                                        ],
                                    ],
                                    'options'=>['class'=>'hidden-xs'], 
                                ],
                                [
                                    'label' => '<i class="material-icons">exit_to_app</i> Salir', 
                                    'encode'=>false, 
                                    'url' => ['/admin/user/logout'], 
                                    'linkOptions'=>['class'=>'visible-xs-* hidden-sm hidden-md hidden-lg', 'data-method'=>'post'], 
                                ],
                            ],
                        ])?>
                    </div>
                </div>
            </nav>
            <div class="content">
                <div class="container-fluid">
                    <?=Dialog::widget([
                        'libName' => 'krajeeDialogCust',
                        'options' => [
                        'closable' => true,
                        ], 
                    ])?>
                    <?= Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'options'=>['class'=>'breadcrumb hidden-print']
                    ]) ?>
                    <?= NotificationFlash::widget([
                        'options' =>[
                            "closeButton" => true,
                            "timeOut" => "10000",
                            "extendedTimeOut" => "10000",
                            "tapToDismiss"=> false,
                        ]
                    ]) ?>
                    <?= $content ?>
                </div>
            </div>
            <footer class="footer hidden-print">
                <div class="container-fluid">
                    <p class="pull-left">&copy; <?=Yii::$app->name?>
                        <?= date('Y') ?>
                    </p>

                    <p class="pull-right">
                        
                    </p>
                </div>
            </footer>
        </div>
    </div>
    <!-- Modal de generico del widget modal -->
    <?php Modal::begin([
        "id"=>"ajaxCrudModal",
        "footer"=>"",// always need it for jquery plugin
        // "size"=>"modal-lg"
    ])?>
    <?php Modal::end(); ?>    
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>