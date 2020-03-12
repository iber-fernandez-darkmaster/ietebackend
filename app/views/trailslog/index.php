<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\widgets\Pjax;
use app\models\CustomValues;
use yii\helpers\Url;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TrailsLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Historial de usuario';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="audit-trails-log-index">
    <div class="card">
        <div class="card-header" data-background-color="dark">
            <div class="row">
                
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-uppercase">
                    <h4> <i class="material-icons">pets</i> <?=$this->title?> </h4>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 text-right">
                    <?=Html::button('<i class="material-icons">delete</i> Borrar seleccionados', [
                        'onclick'=>'eliminarSeleccionados()',
                        'class'=>'btn btn-danger btn-round', 
                        'title'=>'Elimina las filas seleccionadas de la tabla',
                        'aria-label'=>'Elimina las filas seleccionadas de la tabla'
                    ])?>
                </div>
            </div>
        </div>
        <div class="card-content">
            
            <?=GridView::widget([
                'id'=>'crud-datatable-pjax',
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                // 'filterPosition'=>GridView::FILTER_POS_HEADER,
                'layout'=>CustomValues::layaout,
                'columns' => [
                    [
                        'class' => 'kartik\grid\CheckboxColumn',
                        'width' => '20px',
                    ],
                    [
                        'class' => 'kartik\grid\SerialColumn',
                        'width' => '30px',
                    ],
                    [
                        'attribute'=>'user_id',
                        'value'=>'usuario.username'
                    ],
                    'description',
                    'model',
                    // 'creation_date:datetime',
                    [
                        'class'=>'\kartik\grid\DataColumn',
                        'attribute'=>'creation_date',
                        'format'=>'datetime',
                        'filterType'=>DatePicker::className(),
                        'filterWidgetOptions' => [
                            'language' => 'es', 
                            'type' => DatePicker::TYPE_INPUT,
                            'removeButton' => false,
                            'pluginOptions' => [
                                'autoclose' => true,    
                                'format' => 'dd-mm-yyyy'
                            ]
                        ],
                        'filterInputOptions'=>[
                            'autocomplete'=>'off',
                            'placeholder'=>'Buscar por fecha'
                        ],
                    ],
                    [
                        'class' => 'kartik\grid\ActionColumn',
                        'dropdown' => false,
                        'vAlign'=>'middle',
                        'urlCreator' => function($action, $model, $key, $index) { 
                                return Url::to([$action,'id'=>$key]);
                        },
                        'width'=>'50px',
                        'template'=>'{view}',
                        'buttons' => [
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="material-icons">visibility</i>', $url, [
                                    'class'=>'btn btn-info btn-round btn-just-icon', 
                                    'title'=>'Ver',
                                    'aria-label'=>'Ver',
                                    'data-pjax'=>0
                                ]);
                            },
                        ],
                    ],
                ],
                'pjax'=>true,
                'bordered' => true,
                'striped' => false,
                'hover' => true,
                'condensed' => false,
                'responsive' => true,          
                'responsiveWrap' => false,                 
                'resizableColumns' => false,              
                'exportConfig' => [
                    GridView::EXCEL => [],
                    GridView::PDF => [
                        'filename' => 'moderna_dallas_'.$this->title,
                        'alertMsg' => 'Se exportara un archivo PDF para poder ser descargado',
                        'options' => ['title' => 'Reporte de ',$this->title],
                        'config' => [
                            'mode' => 'utf-8',
                            'format' => 'Letter',
                            'destination' => 'I',
                            'marginTop' => 20,
                            'marginBottom' => 20,
                            'methods' => [
                                'SetHeader' => ['ACADEMIA '.Yii::$app->name.' - '.date('Y-m-d-Hi')],
                                'SetFooter' => ['{PAGENO}']
                            ],
                           'options' => [
                                'title' => 'PDF Document Title',
                                'subject' => 'PDF Document Subject',
                                'keywords' => 'krajee, grid, export, yii2-grid, pdf'
                           ],
                            'contentBefore'=>'<div class="kv-align-center"><h3>'.\Yii::$app->name.' <br> '.$this->title.'</h3></div>',
                        ]
                    ],
                ]
            ])?>

        </div>
    </div> 
</div>