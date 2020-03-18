<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\file\FileInput;
use kartik\switchinput\SwitchInput;
use kartik\date\DatePicker;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Centro;
/* @var $this yii\web\View */
/* @var $model app\models\Estudiante */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="estudiante-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nombre_completo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dni')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?php if (Yii::$app->user->can('Administrador')){ ?>    
        <?= $form->field($model, 'centro_id')->widget(Select2::classname(), [
                'data' => ArrayHelper::map(Centro::find()->all(), 'id', 'numero_id'),
                'options' => ['placeholder' => 'Seleccione un centro ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); 
        ?>
    <?php 
    }
    // elseif (Yii::$app->user->can('Responsable Centro')){ 
    //     echo $form->field($model, 'centro_id')->widget(Select2::classname(), [
    //         'data' => ArrayHelper::map(Centro::find()->where(['id' => Yii::$app->user->identity->centro_id])->all(), 'id', 'numero_id'),
    //         'options' => ['placeholder' => 'Seleccione un centro ...'],
    //         'pluginOptions' => [
    //             'allowClear' => true
    //         ],
    //     ]); 
    // } 
    ?>
     <?php if (Yii::$app->user->can('Administrador')){ ?>    
        <?= $form->field($model, 'estado')->widget(Select2::classname(), [
                'data' => [
                    'Activo' => 'Activo',
                    'Inactivo' => 'Inactivo',
                ],
                'options' => ['placeholder' => 'Seleccione un estado ...'],
                'pluginOptions' => [
                    'allowClear' => true
                ],
            ]); 
        ?>
    <?php 
    }?>

    <?=$form->field($model, 'foto')
        //->hint('Dimencion 500 x 600 px - tamaño maximo 8 MB')
        ->widget(FileInput::classname(), [
            'showMessage'=>false,
            'options' => [
                'multiple' => false, 
                'accept' => 'image/*',
                'value'=>$model->foto,
            ],
            'pluginOptions' => [
                'previewFileType' => 'image',
                'initialPreview'=>[
                    !$model->isNewRecord && $model->foto?Url::base(true).Url::to('@web/uploads'.\app\models\Estudiante::PATH.$model->foto):'',
                ],
                'overwriteInitial'=>true,
                'initialCaption'=>$model->foto,
                'initialPreviewAsData'=>true,
                'showPreview' => true,
                'showCaption' => true,
                'showRemove' => false,
                'showUpload' => false,
                'maxFileSize'=>8000
            ]
        ]
    )?>

    <div class="form-group text-right">
        <?= Html::a( "<i class='material-icons'>clear</i> ".'Cerrar', ['index'], [
            'class' => 'btn btn-default',
            'title'=>'Cerrar',
        ]) ?>
        <?= Html::submitButton( "<i class='material-icons'>save</i> ".'Guardar', ['class' => $model->isNewRecord?'btn btn-success':'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
