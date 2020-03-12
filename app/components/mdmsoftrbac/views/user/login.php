<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Login */

$this->title = 'Administrador';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-signin">
    <div class="card">
        <!-- <div class="card-header text-uppercase" data-background-color="green">
            
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
                    <i class="material-icons"></i>
                </div>
            </div>
            
        </div> -->
        <div class="card-content" style="">
            <?= Html::img('@web/images/logo2.jpeg', ['alt' => 'IETE', 'width'=>'100px', 'height'=>'123px']) ?>
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'class'=>'form-signin']); ?>
            <?= $form->field($model, 'username')->textInput(['placeholder'=>'Nombre de usuario', 'autocomplete'=>'off', 'autofocus'=>true])->label(false) ?>
            <?= $form->field($model, 'password')->passwordInput(['placeholder'=>'Contraseña'])->label(false) ?>
            <?= $form->field($model, 'rememberMe')->checkbox(['labelOptions'=>['style'=>'color:white;']])->label('Recordarme') ?>    
            
            <p style="color:#999">
                <?= Html::a('¿ Olvidaste tu contraseña ?', ['user/request-password-reset'], ['style'=>'color:#999;']) ?>.
            </p>
            
            <div class="form-group">
                <?= Html::submitButton(Yii::t('rbac-admin', '<i class="material-icons">input</i> Ingresar'), ['class' => 'btn btn-success', 'name' => 'login-button']) ?>
            </div>
            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>