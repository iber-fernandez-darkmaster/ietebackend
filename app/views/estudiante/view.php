<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Estudiante */

$this->title = 'Estudiantes ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Estudiantes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="estudiante-view">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?= Html::encode($this->title) ?></h4>
                    <hr>

                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'nombre_completo',
                            'dni',
                            'email:email',
                            [
                                'label' => 'Centro',
                                'attribute' => 'centro.numero_id',
                            ],
                            'estado',
                            [
                                'attribute' => 'foto',
                                'value' => Yii::getAlias('@estudianteImgUrl') . '/' . $model->foto,
                                'format' => ['image', ['width' => '125', 'height'=>'125']],
                                'styles' => 'text-center'
                            ],
                        ],
                    ]) ?>

                    <p></p>
                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                                        <b>Examenes realizados</b>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                            <table class="table">
                                                <tbody>
                                                    <?php if (count($examenes) > 0){ ?>
                                                        <?php foreach ($examenes as $key => $examen) { ?>
                                                            <tr>
                                                                <td>
                                                                    <p>
                                                                        <?= '<b>'.$examen->titulo.'</b>' ?>
                                                                    </p>
                                                                </td>
                                                                <td>
                                                                    <span class="label label-info">
                                                                        <?= \Yii::$app->formatter->asDate($examen->fecha, 'medium') ?>
                                                                    </span>
                                                                </td>
                                                                <td>
                                                                    <?=Html::a('<i class="material-icons">visibility</i>', ['ver-examen', 
                                                                            'pEx'=>$examen->id,
                                                                            'pEst'=>$model->id
                                                                        ], [
                                                                            'class'=>'btn btn-info btn-round btn-just-icon',
                                                                            'title'=>'Ver Respuestas de este examen'
                                                                    ])?>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    <?php }else{ ?>
                                                        <tr>
                                                            <td rowspam="2" class="text-center">No tiene examenes</td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="form-group text-right">
                        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['index'], ['class' => 'btn btn-default', 'title'=>'Cerrar',]) ?>
                        <?= Html::a( "<i class='material-icons'>edit</i> ".'Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-warning', 'title'=>'Modificar',]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
