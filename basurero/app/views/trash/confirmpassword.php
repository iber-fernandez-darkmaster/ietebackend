<?php 
use yii\bootstrap\ActiveForm;
use yii\helpers\Html;
?>


<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-centered">
        <div class="card">
            <div class="card-content">
                <?php $form = ActiveForm::begin( [
                            'action'=>['deleteforever'],
                            'method'=>'post',
                            'options'=>[
                                'class' => 'disable-submit-buttons',
                            ] 
                        ]); ?>
                    <input type="hidden" name="action" value="<?=$action?>">
                    <?=$form->field($usuario,'password_hash')->label('Ingrese su contraseña')->textInput(['autofocus'=>true, 'autocomplete'=>'off', 'placeholder'=>'Contraseña'])?>
                    <div class="form-group text-right">
                        <?=  Html::a('<i class="material-icons">clear</i> Cerrar', ['index'], ['class' => 'btn btn-round btn-default']) ?>
                        <?= Html::submitButton('<i class="material-icons">done</i> Confirmar', ['class' => 'btn btn-round btn-success']) ?>
                    </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>        
    </div>
</div>
