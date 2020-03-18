<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */

$this->title = 'Ver examen';
$this->params['breadcrumbs'][] = ['label' => 'Ver Materia', 'url' => ['view', 'id'=>$examen->materia_id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="materia-create">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?= Html::encode($this->title) ?></h4>
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <?=$examen->titulo?>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <?=$examen->fecha?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php foreach ($respuestasEstudiante as $key => $item) {?>
                                
                                <div class="row">
                                     <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                        <?php if($item->pregunta->respuesta_correcta == $item->respuesta) { ?>
                                            <span class="text-success">
                                                <i class="material-icons">done</i>
                                            </span>
                                        <?php }else{ ?>
                                            <span class="text-danger">
                                                <i class="material-icons">clear</i>
                                            </span>
                                        <?php } ?>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                        <b>¿ <?=$item->pregunta->pregunta?> ?</b><br>
                                        <b>
                                            <?= $item->pregunta->strRespuesta?>
                                        </b>
                                        | <?= $item->strRespuesta?> <br>
                                    </div>
                                </div>
                                
                                </p>
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group text-right">
                        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['view', 'id'=>$estudiante->id], ['class' => 'btn btn-default', 'title'=>'Cerrar',]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>