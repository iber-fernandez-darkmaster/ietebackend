<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use kartik\switchinput\SwitchInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Informacion */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="informacion-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'imagen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idestudiante')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idcentro')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'idexamen')->textInput(['maxlength' => true]) ?>

    <div class="form-group text-right">
        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['index'], [
            'class' => 'btn btn-default',
            'title'=>'Cerrar',
        ]) ?>
        <?= Html::submitButton( "<i class='material-icons'>save</i> ".'Guardar', ['class' => $model->isNewRecord?'btn btn-success':'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
