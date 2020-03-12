<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\ResetPassword */

$this->title = 'Cambiar contraseña';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-signin text-left">
    <h3><?= Html::encode($this->title) ?></h3>

    <p>Porfavor ingresa una nueva contraseña:</p>

    <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
        <?= $form->field($model, 'password')->label('Contraseña')->passwordInput() ?>
        <div class="form-group text-right">
            <?= Html::submitButton('<i class="material-icons">done</i> '.Yii::t('rbac-admin', 'Guardar'), ['class' => 'btn btn-success']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
