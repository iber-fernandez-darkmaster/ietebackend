<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EstudianteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Estudiantes';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="estudiante-index">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered">
            <div class="card card-stats">
                <div class="card-header" data-background-color="purple">
                    <i class="material-icons">date_range</i>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left">
                            <h4>
                                <?= Html::encode($this->title) ?>
                            </h4>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-right pull-right">
                            <?=  Html::a( "<i class='material-icons'>add</i> Nuevo " .'Estudiante', ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>

                                                                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                    

                                            <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
        'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                'nombre_completo',
                                'dni',
                                'email:email',
                                //'centro_id',

                                [
                                    'class' => 'kartik\grid\ActionColumn',
                                    'urlCreator' => function($action, $model, $key, $index) { 
                                            return Url::to([$action,'id'=>$key]);
                                    },
                                    'width'=>'200px',
                                    'template'=>'{view} {update} {delete}',
                                    'buttons'=>[
                                        'view' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">visibility</i>', $url, [
                                                'class'=>'btn btn-info btn-round btn-just-icon', 
                                                'title'=>'Ver',
                                                'aria-label'=>'Ver',
                                                'data-pjax'=>0
                                            ]);
                                        },
                                        'update' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">edit</i>', $url, [
                                                'class'=>'btn btn-warning btn-round btn-just-icon', 
                                                'title'=>'Modificar',
                                                'aria-label'=>'Modificar',
                                                'data-pjax'=>0
                                            ]);
                                        },
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">delete</i>', $url, [
                                                'class'=>'btn btn-danger btn-round btn-just-icon', 
                                                'title'=>'Eliminar',
                                                'aria-label'=>'Eliminar',
                                                'data-confirm'=>'¿ Esta seguro de eliminar este elemento ?',
                                                'data-method'=>'post'
                                            ]);
                                        },
                                    ]
                                ],
                            ],
                            'bordered' => true,
                            'striped' => false,
                            'hover' => true,
                            'condensed' => false,
                            'responsive' => true,          
                            'responsiveWrap' => false,                 
                            'resizableColumns' => false,   
                        ]); ?>
                                        
                </div>
            </div>
        </div>
    </div>
</div>
