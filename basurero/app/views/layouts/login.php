<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\LoginAsset;

LoginAsset::register($this);
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

<body class="text-center">
    <?php $this->beginBody() ?>
    <nav class="navbar navbar-inverse navbar-fixed-top" style="border-bottom: none;background-color: transparent;">
        <div class="container-fluid">
            <!-- <div class="navbar-header hidden-xs">
                <a class="navbar-brand" href="<?=Url::to(['/administrador'])?>?>" style="color:white"><?=$this->title?></a>
            </div> -->
            <!-- <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
            </ul> -->
            <!-- <ul class="nav navbar-nav navbar-right">
                <li>
                    <a href="<?=Url::to(['/site/index'])?>" style="color:white">
                        <span class="material-icons">web</span> Sitio web
                    </a>
                </li>
            </ul> -->
        </div>
    </nav>

    <div class="text-center navbar-fixed-top">
        <?= Alert::widget() ?>
    </div>
    <div class="wrapper">
        <?= $content ?>
    </div>

    

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>