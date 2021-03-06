<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */

$this->title = 'Nuevo examen';
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
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <?= $form->field($model, 'titulo')->textInput([
                                            'maxlength' => true,
                                            'placeholder'=>'Titulo del examen',
                                        ]) ?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                                        <?=$form->field($model, 'fecha')->widget(DatePicker::classname(), [
                                            'options' => [
                                                'placeholder' => 'Seleccionar fecha'
                                            ],
                                            'pluginOptions' => [
                                                'autoclose'=>true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                        ])?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                        
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <?= $form->field($model, 'pregunta')->textInput([
                                            'maxlength' => true,
                                            'placeholder'=>'Ingresa tu pregunta',
                                            'autocomplete'=>'off'
                                        ]) ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
                                        <?=$form->field($model, 'respuesta')->radioList([
                                            0 => 'Falso', 
                                            1 => 'Verdadero', 
                                        ])?>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4" style="padding-top:20px;">
                                        <?= Html::a( "<i class='material-icons'>add</i> ".'Agregar', '#', [
                                            'class' => 'btn btn-primary',
                                            'title'=>'Agregar pregunta',
                                            'id'=>'btn-agregar',
                                            'onclick'=>'agregar()'
                                        ]) ?>
                                    </div>
                                </div>

                                <hr>
                                
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <table class="table table-hover" id="table-preguntas">
                                            <thead>
                                                <tr>
                                                    <th>Pregunta</th>
                                                    <th>Respuesta</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="text-center" colspan="3">No hay preguntas</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                        



                        <div class="form-group text-right">
                            <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['index'], [
                                'class' => 'btn btn-default',
                                'title'=>'Cerrar',
                            ]) ?>
                            <?= Html::submitButton( "<i class='material-icons'>save</i> ".'Guardar', [
                                'class' => $model->isNewRecord?'btn btn-success':'btn btn-warning',
                                // 'onclick'=>'sendForm()', 
                            ]) ?>
                        </div>

                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->registerJsFile('@web/js/materia/create_examen.js', [
    'depends'=>[
        \yii\web\JqueryAsset::className(),
    ]
]);?>