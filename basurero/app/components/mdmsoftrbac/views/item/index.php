<?php

use yii\helpers\Html;
use yii\grid\GridView;
use mdm\admin\components\RouteRule;
use mdm\admin\components\Configs;
use app\models\AuthItem;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = Yii::t('rbac-admin', $labels['Items']);
$this->params['breadcrumbs'][] = $this->title;

$rules = array_keys(Configs::authManager()->getRules());
$rules = array_combine($rules, $rules);
unset($rules[RouteRule::RULE_NAME]);
?>
<div class="role-index">    
    <div class="card">
        <div class="card-header" data-background-color="dark">
            <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                    <h4><?= Html::encode($this->title) ?></h4>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-right">
                    <?= Html::a('<i class="material-icons">add</i> Crear rol ', ['create'], ['class' => 'btn btn-round btn-success']) ?>
                </div>
            </div>
        </div>
        <div class="card-content">
            <?=
            GridView::widget([
                'dataProvider' => $dataProvider,
                // 'filterModel' => $searchModel,
                'tableOptions'=>['class'=>'table'],
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'name',
                        'label' => Yii::t('rbac-admin', 'Name'),
                    ],
                    [
                        'attribute' => 'description',
                        'label' => Yii::t('rbac-admin', 'Description'),
                    ],
                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions'=>['style'=>'width: 200px;'],
                        'header'=>'Accion',
                        'template' => '{view}{update}{delete}',
                        'buttons'=>[
                            'view' => function ($url, $model, $key) {
                                return Html::a('<i class="material-icons">visibility</i>', $url, [
                                    'class'=>'btn btn-info btn-round btn-just-icon', 
                                    'title'=>'Ver',
                                    'aria-label'=>'Ver',
                                ]);
                            },
                            'update' => function ($url, $model, $key) {
                                if ($model->name != AuthItem::ROLE_SUPER_USER && $model->name != AuthItem::ROLE_ADMINISTRADOR && $model->name != AuthItem::ROLE_EDITOR ){
                                    return Html::a('<i class="material-icons">edit</i>', $url, [
                                        'class'=>'btn btn-warning btn-round btn-just-icon', 
                                        'title'=>'Ver',
                                        'aria-label'=>'Ver',
                                    ]);
                                }
                                return '';
                            },
                            'delete' => function ($url, $model, $key) {
                                if ($model->name != AuthItem::ROLE_SUPER_USER && $model->name != AuthItem::ROLE_ADMINISTRADOR && $model->name != AuthItem::ROLE_EDITOR ){
                                    return Html::a('<i class="material-icons">delete</i>', $url, [
                                        'class'=>'btn btn-danger btn-round btn-just-icon', 
                                        'title'=>'Eliminar',
                                        'aria-label'=>'Eliminar',
                                        'data-confirm'=>'Esta seguro de eliminar este elemento?',
                                        'data-method'=>'post'
                                    ]);
                                }
                                return '';
                            },
                        ]
                    ],
                ],
            ])
            ?>
        </div>
    </div>

</div>
