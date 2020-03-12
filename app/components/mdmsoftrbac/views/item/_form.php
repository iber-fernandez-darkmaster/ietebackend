<?php

use yii\helpers\Html;
use kartik\form\ActiveForm;
use mdm\admin\components\RouteRule;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Json;
use mdm\admin\components\Configs;

/* @var $this yii\web\View */
/* @var $model mdm\admin\models\AuthItem */
/* @var $form yii\widgets\ActiveForm */
/* @var $context mdm\admin\components\ItemController */

$context = $this->context;
$labels = $context->labels();
$rules = Configs::authManager()->getRules();
unset($rules[RouteRule::RULE_NAME]);
$source = Json::htmlEncode(array_keys($rules));

$js = <<<JS
    $('#rule_name').autocomplete({
        source: $source,
    });
JS;
AutocompleteAsset::register($this);
$this->registerJs($js);
?>

<div class="auth-item-form">
    <?php $form = ActiveForm::begin(['id' => 'item-form']); ?>
            
        <?= $form->field($model, 'name')->textInput(['maxlength' => 64, 'autocomplete'=>'off']) ?>

        <?= $form->field($model, 'description')->textarea(['rows' => 2, 'autocomplete'=>'off']) ?>
        <div class="form-group text-right">
            <?=Html::a('<i class="material-icons">clear</i> Cerrar', ['/admin/role/index'], ['class'=>'btn btn-round btn-default'])?>
            <?=Html::submitButton($model->isNewRecord ? '<i class="material-icons">add</i> Crear' : '<i class="material-icons">edit</i> Modificar', [
                'class' => $model->isNewRecord ? 'btn btn-round btn-success' : 'btn btn-round btn-warning',
                'name' => 'submit-button'])
            ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
