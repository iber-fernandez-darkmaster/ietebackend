<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">
    <div class="box-admin">
        <div class="col-xs-12 col-sm-12 col-md-4 col-md-offset-4 col-lg-4">
            <div class="card">
                <div class="card-content text-center bg-warning">
                    <h3><?= nl2br(Html::encode($message)) ?></h3>
                    <hr>
                    <img src="<?= Url::to('@web/images/seguridad.png')?>" width="100%" height="auto">
                    <?=Html::a('<h5><i class="material-icons">keyboard_arrow_left</i> Volver a la pagina anterior</h5>', Yii::$app->request->referrer)?>
                </div>
            </div>
        </div>
    </div>
</div>
