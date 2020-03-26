<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\TrailsLog */

$this->title = 'Registro '.$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Historial de usuario', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="audit-trails-log-view">
    
    <div class="row">
        <div class="col-xs-8 col-sm-8 col-md-5 col-lg-5 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?=$this->title?></h4>
                    <hr>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute'=>'user_id',
                                'value'=>$model->usuario->username
                            ],
                            'description',
                            'action',
                            'model',
                            'id_model',
                            'ip',
                            'creation_date:datetime',
                        ],
                    ]) ?>
                    <div class="form-group text-right">
                        <?=  Html::a('<i class="material-icons">clear</i> Cerrar', ['index'], ['class' => 'btn btn-round btn-default']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    

</div>
