<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="error-404 text-center">
    <a href="index.html" class="logo">
        <img src="images/logo2.jpeg" alt="Awesome Image" width="100">
    </a>
    <div class="box">
        <div class="content">
            <h3><?= nl2br(Html::encode($message)) ?></h3>
            <p>
                <?php 
                $back = ['/site/index'];
                if (Yii::$app->request->referrer){ 
                    $back = Yii::$app->request->referrer;
                } ?>
                <?=Html::a('<h5><i class="material-icons">keyboard_arrow_left</i> Volver a la pagina anterior</h5>', $back)?>
            </p>
        </div><!-- /.content -->
    </div><!-- /.box -->
    <div class="copy-text">
        <div class="inner">&copy; Copyright Agrocorani 2019.</div><!-- /.inner -->
    </div><!-- /.copy-text -->
</div><!-- /.error-404 -->
