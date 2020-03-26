<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ChangePassword */

$this->title = Yii::t('rbac-admin', 'Cambiar contraseña');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-signin">
    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?= Html::encode($this->title) ?></h4>
                    <hr>
                    <?php $form = ActiveForm::begin(['id' => 'form-change']); ?>
                        <?php if ( \Yii::$app->user->can('secretaria') == true && \Yii::$app->user->can('administrador') == false ){ ?>
                            <?= $form->field($model, 'oldPassword')->passwordInput(['autoFocus'=>true]) ?>
                        <?php } ?>
                        <?= $form->field($model, 'newPassword')->passwordInput() ?>
                        <?= $form->field($model, 'retypePassword')->passwordInput() ?>
                        <div class="form-group text-right">
                            <?=Html::a('<i class="material-icons">clear</i> Cerrar', ['/site/index'], ['class'=>'btn btn-default btn-round'])?>
                            <?= Html::submitButton(Yii::t('app', '<i class="material-icons">edit</i> Cambiar'), ['class' => 'btn btn-warning btn-round', 'name' => 'change-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
    
</div>
