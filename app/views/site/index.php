<?php
use yii\helpers\Url;
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Administrador';
?>

<?php if (\Yii::$app->user->can('Responsable Centro')){ ?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
        <a class="btn btn-info" href="<?=Url::to(['/estudiante'])?>">
            <h4>Estudiantes</h4>
        </a>
    </div>
</div>

<?php } ?>