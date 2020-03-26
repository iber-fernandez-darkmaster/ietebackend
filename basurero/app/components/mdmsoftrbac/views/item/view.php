<?php

use mdm\admin\AnimateAsset;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', $labels['Items']), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="auth-item-view">
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-10 col-lg-10 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4 class="text-uppercase">Rol <?=Html::encode($this->title);?></h4>
                    <hr>
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <?=
                            DetailView::widget([
                                'model' => $model,
                                'attributes' => [
                                    'name',
                                    'description:ntext:Descripción',
                                ],
                                'template' => '<tr><th style="width:25%">{label}</th><td>{value}</td></tr>',
                            ]);
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-5">
                            <input class="form-control search" data-target="available" placeholder="<?=Yii::t('rbac-admin', 'Buscar por disponibilidad');?>">
                            <select style="min-height:300px;" multiple size="20" class="form-control list" data-target="available"></select>
                        </div>
                        <div class="col-sm-2 text-centered">
                            <br><br>
                            <?=Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => $model->name], [
                                'class' => 'btn btn-success btn-assign',
                                'data-page' => 1,
                                'data-target' => 'available',
                                'title' => Yii::t('rbac-admin', 'Assign'),
                            ]);?>
                            <br><br>
                            <?=Html::a('&lt;&lt;' . $animateIcon, ['remove', 'id' => $model->name], [
                                'class' => 'btn btn-danger btn-assign',
                                'data-page' => 1,
                                'data-target' => 'assigned',
                                'title' => Yii::t('rbac-admin', 'Remove'),
                            ]);?>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control search" data-target="assigned" placeholder="<?=Yii::t('rbac-admin', 'Buscar por asignado');?>">
                            <select style="min-height:300px;" multiple size="20" class="form-control list" data-target="assigned"></select>
                        </div>
                    </div>

                    <div class="form-group text-right">
                        <?=Html::a('<i class="material-icons">clear</i> Cerrar', ['/admin/role/index'], ['class'=>'btn btn-round btn-default'])?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    
</div>
