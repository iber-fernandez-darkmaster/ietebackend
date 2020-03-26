<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use backend\models\Vehiculo;
use yii\helpers\ArrayHelper;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model backend\models\Vehiculo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="animal-form">
    <div class="producto-form">
        <div class="panel">
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <?= Html::img($model->strfoto, ['alt' => 'foto', 'width'=>'100%', 'style'=>"border:1px solid #ccc"  ]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
