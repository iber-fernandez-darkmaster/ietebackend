<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use kartik\switchinput\SwitchInput;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */

$this->title = 'Modificar pregunta';
$this->params['breadcrumbs'][] = ['label' => 'Materias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materia-create">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?= Html::encode($this->title) ?></h4>
                    <?php $form = ActiveForm::begin(); ?>

                        <?= $form->field($model, 'pregunta')->textInput(['maxlength' => true]) ?>

                        <?=$form->field($model, 'respuesta_correcta')->radioList([
                            0 => 'Falso', 
                            1 => 'Verdadero', 
                        ])?>

                        <div class="form-group text-right">
                            <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['ver-examen', 'id'=>$model->examen_id], [
                                'class' => 'btn btn-default',
                                'title'=>'Cerrar',
                            ]) ?>
                            <?= Html::submitButton( "<i class='material-icons'>save</i> ".'Guardar', ['class' => 'btn btn-warning']) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
