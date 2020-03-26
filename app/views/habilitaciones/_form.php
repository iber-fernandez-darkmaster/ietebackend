<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use kartik\switchinput\SwitchInput;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Estudiante;
use app\models\Materia;

/* @var $this yii\web\View */
/* @var $model app\models\Habilitaciones */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="habilitaciones-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'estudiante_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Estudiante::find()->all(), 'id', 'nombre_completo'),
            'options' => ['placeholder' => 'Seleccione un estudiante...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 
    ?>

    <?= $form->field($model, 'materia_id')->widget(Select2::classname(), [
            'data' => ArrayHelper::map(Materia::find()->where(['estado'=>'Habilitado'])->all(), 'id', 'nombre'),
            'options' => ['placeholder' => 'Seleccione una materia...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 
    ?>

    <!-- <?= $form->field($model, 'estado')->widget(Select2::classname(), [
            'data' => [
                'Activo' => 'Activo',
                'Inactivo' => 'Inactivo',
            ],
            'options' => ['placeholder' => 'Seleccione un estado ...'],
            'pluginOptions' => [
                'allowClear' => true
            ],
        ]); 
    ?> -->

    <div class="form-group text-right">
        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['index'], [
            'class' => 'btn btn-default',
            'title'=>'Cerrar',
        ]) ?>
        <?= Html::submitButton( "<i class='material-icons'>save</i> ".'Guardar', ['class' => $model->isNewRecord?'btn btn-success':'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
