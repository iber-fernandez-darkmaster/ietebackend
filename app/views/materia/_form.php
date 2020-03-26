<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use kartik\switchinput\SwitchInput;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="materia-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'estado')->widget(Select2::classname(), [
            'data' => [
                'Habilitado' => 'Habilitado',
                'No habilitado' => 'No habilitado',
            ],
            'options' => ['placeholder' => 'Seleccione un estado ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 
    ?>

    <div class="form-group text-right">
        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['index'], [
            'class' => 'btn btn-default',
            'title'=>'Cerrar',
        ]) ?>
        <?= Html::submitButton( "<i class='material-icons'>save</i> ".'Guardar', ['class' => $model->isNewRecord?'btn btn-success':'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
