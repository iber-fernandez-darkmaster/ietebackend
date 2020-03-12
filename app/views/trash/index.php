<?php 
use yii\helpers\Html;
$this->title = "Datos recilados";
?>

<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
        <div class="panel panel-warning">
            <div class="panel-heading">
                <i class="material-icons">delete_sweep</i>
                Historial de los rastros
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 text-center bg-info">
                        <h4><?=count($trailsLog)?></h4>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
                        <?=Html::a('<h4>Registros</h4>', ['/trailslog'], ['title'=>'Ver el historial de rastros'])?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center bg-danger">
                        <?=Html::a('<h4><i class="material-icons">delete</i> Eliminar</h4>', ['validarusuario', 'action'=>'trailslog'], ['class'=>'text-danger', 'title'=>'Eliminar para siempre todos los rastros', 'data-confirm'=>'Esta seguro de eliminar estos datos?'])?>                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
