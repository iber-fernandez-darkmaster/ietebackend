<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Materia */

$this->title = 'Ver examen';
$this->params['breadcrumbs'][] = ['label' => 'Ver Materia', 'url' => ['view', 'id'=>$model->materia_id]];
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
                                    <?=$model->titulo?>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                                    <?=$model->fecha?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <?php foreach ($model->preguntas as $key => $pregunta) { ?>
                                
                                <div class="row">
                                    <div class="col-xs-2 col-sm-2 col-md-2 col-lg-2 text-right">
                                        <?= Html::a('<i class="material-icons">edit</i>', ['update-pregunta', 'preg'=>$pregunta->id], [
                                            'class'=>'text-warning',
                                            'title'=>'Modificar la pregunta'
                                        ])?>
                                    </div>
                                    <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8 text-righ">
                                        <b>¿  <?=$pregunta->pregunta?>  ?</b><br>
                                        <?= $pregunta->strRespuesta?> <br>
                                        </p>
                                    </div>
                                </div>
                                
                            <?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group text-right">
                        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['view', 'id'=>$model->materia_id], ['class' => 'btn btn-default', 'title'=>'Cerrar',]) ?>
                    </div>
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