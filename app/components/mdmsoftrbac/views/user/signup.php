<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Centro;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \mdm\admin\models\form\Signup */

$this->title = Yii::t('rbac-admin', 'Nuevo usuario');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-signup">
    <?= Html::errorSummary($model)?>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?= Html::encode($this->title) ?></h4>
                    <hr>
                    <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                        <?= $form->field($model, 'username')->textInput(['autocomplete'=>'off']) ?>
                        <?= $form->field($model, 'email')->textInput(['autocomplete'=>'off']) ?>
                        <?= $form->field($model, 'rol')->dropdownList([
                                'administrador'=>'Administrador',
                                'responsable centro'=>'Responsable Centro',
                            ],
                            ['prompt'=>'Seleccione un rol']
                        ) ?>
                        <?= $form->field($model, 'centro_id')->dropdownList(ArrayHelper::map(Centro::find()->all(), 'id', 'numero_id'),
                            [
                                'class' => 'form-control', 
                                'prompt'=>'Seleccione el centro'
                            ])
                            ->label('Centro') 
                        ?>
                        <?= $form->field($model, 'password')->passwordInput() ?>
                        <div class="form-group text-right">
                            <?=Html::a('<i class="material-icons">clear</i> Cerrar', ['/admin/user/index'], ['class'=>'btn btn-round btn-default'])?>
                            <?= Html::submitButton(Yii::t('rbac-admin', '<i class="material-icons">add</i> Registrar'), ['class' => 'btn btn-success btn-round', 'name' => 'signup-button']) ?>
                        </div>
                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>
</div>
