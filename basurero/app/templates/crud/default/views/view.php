<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass))).' ') ?> . $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view">
    <div class="row">
        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8 col-centered">
            <div class="card">
                <div class="card-content">
                    <h4><?= "<?= " ?>Html::encode($this->title) ?></h4>
                    <hr>

                <?= "<?= " ?>DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                <?php
                if (($tableSchema = $generator->getTableSchema()) === false) {
                    foreach ($generator->getColumnNames() as $name) {
                        if ($name != 'id'){
                            echo "            '" . $name . "',\n";
                        }
                    }
                } else {
                    foreach ($generator->getTableSchema()->columns as $column) {
                        if ($column->name != 'id'){
                            $format = $generator->generateColumnFormat($column);
                            echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                }
                ?>
                        ],
                    ]) ?>

                     <div class="form-group text-right">
                        <?= "<?= " ?>Html::a(<?= " \"<i class='material-icons'>clear</i> \".".$generator->generateString('Cerrar') ?>, ['index'], ['class' => 'btn btn-default', 'title'=>'Cerrar',]) ?>
                        <?= "<?= " ?>Html::a(<?= " \"<i class='material-icons'>edit</i> \".".$generator->generateString('Modificar') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-warning', 'title'=>'Modificar',]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
