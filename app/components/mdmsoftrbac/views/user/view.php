<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use mdm\admin\components\Helper;
use app\models\User;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Users'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$controllerId = $this->context->uniqueId . '/';
?>
<div class="user-view">
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4 class="text-uppercase"><?= Html::encode($this->title) ?></h4>
                    <hr>
                    <?=
                    DetailView::widget([
                        'options'=>['class'=>'table table-bordered'],
                        'model' => $model,
                        'attributes' => [
                            'username',
                            'email:email',
                            'created_at:date',
                            'status',
                        ],
                    ])
                    ?>
                    <div class="form-group text-right">
                        <?=\Yii::$app->user->can('admin')?Html::a('<i class="material-icons">lock</i> Cambiar contraseña', ['/admin/user/change-password', 'id'=>Yii::$app->user->identity->id], ['class'=>'btn btn-danger btn-round']):''?>
                        <?=Html::a('<i class="material-icons">clear</i> Cerrar', ['/admin/user/index'], ['class'=>'btn btn-round btn-default'])?>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    

</div>
