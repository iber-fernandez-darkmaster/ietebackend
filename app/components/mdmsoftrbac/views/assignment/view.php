<?php

use mdm\admin\AnimateAsset;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\YiiAsset;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\Assignment */
/* @var $fullnameField string */

$userName = $model->{$usernameField};
if (!empty($fullnameField)) {
    $userName .= ' (' . ArrayHelper::getValue($model, $fullnameField) . ')';
}
$userName = Html::encode($userName);

$this->title = ' Asignar rol a manuel ' . $userName;

$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Assignments'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $userName;

AnimateAsset::register($this);
YiiAsset::register($this);
$opts = Json::htmlEncode([
    'items' => $model->getItems(),
]);
$this->registerJs("var _opts = {$opts};");
$this->registerJs($this->render('_script.js'));
$animateIcon = ' <i class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></i>';
?>
<div class="assignment-index">
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4 class="text-uppercase"><?=$this->title;?></h4>
                    <hr>
                    <div class="row">
                        <div class="col-sm-5">
                            <input class="form-control search" data-target="available" placeholder="<?=Yii::t('rbac-admin', 'Buscar por disponibles');?>">
                            <select style="min-height:300px;" multiple size="20" class="form-control list" data-target="available">
                            </select>
                        </div>
                        <div class="col-sm-2">
                            <br><br>
                            <?=Html::a('&gt;&gt;' . $animateIcon, ['assign', 'id' => (string) $model->id], [
                                'class' => 'btn btn-success btn-assign',
                                'data-target' => 'available',
                                'title' => Yii::t('rbac-admin', 'Assign'),
                            ]);?><br><br>
                            <?=Html::a('&lt;&lt;' . $animateIcon, ['revoke', 'id' => (string) $model->id], [
                                'class' => 'btn btn-danger btn-assign',
                                'data-target' => 'assigned',
                                'title' => Yii::t('rbac-admin', 'Remove'),
                            ]);?>
                        </div>
                        <div class="col-sm-5">
                            <input class="form-control search" data-target="assigned" placeholder="<?=Yii::t('rbac-admin', 'Buscar por asignado');?>">
                            <select style="min-height:300px;" multiple size="20" class="form-control list" data-target="assigned">
                            </select>
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
