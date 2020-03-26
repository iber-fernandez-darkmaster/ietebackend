<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use thiagoalessio\TesseractOCR\TesseractOCR;
// use thiagoalessio\TesseractOCR\TesseractOCR;

/* @var $this yii\web\View */
/* @var $model app\models\Informacion */

$this->title = 'Informacions ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Informacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="informacion-view">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?= Html::encode($this->title) ?></h4>
                    <hr>

                <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'foto',
                                'value' => Yii::getAlias('@imageUrl') . '/informacion/' . $model->foto,
                                'format' => ['image', ['width' => '150', 'height'=>'150']]
                            ],
                            'idestudiante',
                            'idcentro',
                            'idexamen',
                        ],
                    ]) ?>

                     <div class="form-group text-right">
                        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['index'], ['class' => 'btn btn-default', 'title'=>'Cerrar',]) ?>
                        <?= Html::a( "<i class='material-icons'>edit</i> ".'Modificar', ['update', 'id' => $model->id], ['class' => 'btn btn-warning', 'title'=>'Modificar',]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
