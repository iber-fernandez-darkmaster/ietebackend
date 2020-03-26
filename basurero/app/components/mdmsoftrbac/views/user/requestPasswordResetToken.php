<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\PasswordResetRequest */

// $this->title = 'Request password reset';
$this->title = 'Recuperar contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-signin text-left">
    <h3><?= Html::encode($this->title) ?></h3>

    <p>Por favor ingresa tu email. para restablecer tu contraseña se enviara un enlace a tu correo electronico</p>

    <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>
        <?= $form->field($model, 'email')->textInput(['placeholder'=>'ingresa tu correo electronico', 'autocomplete'=>'off']) ?>
        <div class="form-group text-right">
            <?= Html::submitButton( '<i class="material-icons">send</i> '.Yii::t('rbac-admin', 'Enviar'), ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
