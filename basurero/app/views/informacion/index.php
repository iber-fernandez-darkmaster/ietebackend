<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InformacionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Información';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="informacion-index">

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
                    </div>
                    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                        <?= GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => [
                                ['class' => 'yii\grid\SerialColumn'],

                                array(
                                    'attribute' => 'foto',
                                    'format' => ['image', ['style' => 'width: 30%;']],
                                    'value'=>function($data) { return $data->strfoto; },                
                                ),
                                'idestudiante',
                                'idcentro',
                                'idexamen',

                                [
                                    'class' => 'kartik\grid\ActionColumn',
                                    'urlCreator' => function($action, $model, $key, $index) { 
                                            return Url::to([$action,'id'=>$key]);
                                    },
                                    'width'=>'200px',
                                    'template'=>'{view} {foto}',
                                    'buttons'=>[
                                        'view' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">visibility</i>', $url, [
                                                'class'=>'btn btn-info btn-round btn-just-icon', 
                                                'title'=>'Ver',
                                                'aria-label'=>'Ver',
                                                'data-pjax'=>0
                                            ]);
                                        },
                                        'foto' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">images</i>', ['foto', 'id'=>$key], [
                                                'class'=>'btn btn-success btn-round btn-just-icon', 
                                                'title'=>'Ver foto',
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
