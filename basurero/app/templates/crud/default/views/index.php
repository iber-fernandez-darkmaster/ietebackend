<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

use <?= $generator->indexWidgetType === 'grid' ? "kartik\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this yii\web\View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index">

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-centered">
            <div class="card card-stats">
                <div class="card-header" data-background-color="purple">
                    <i class="material-icons">date_range</i>
                </div>
                <div class="card-content">
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 text-left">
                            <h4>
                                <?= "<?= " ?>Html::encode($this->title) ?>
                            </h4>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text-right pull-right">
                            <?= "<?= " ?> Html::a(<?= " \"<i class='material-icons'>add</i> Nuevo \" .".$generator->generateString(Inflector::camel2words(StringHelper::basename($generator->modelClass))) ?>, ['create'], ['class' => 'btn btn-success']) ?>
                        </div>
                    </div>

                    <?= $generator->enablePjax ? "    <?php Pjax::begin(); ?>\n" : '' ?>
                    <?php if(!empty($generator->searchModelClass)): ?>
                    <?= "    <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
                    <?php endif; ?>


                    <?php if ($generator->indexWidgetType === 'grid'): ?>
                        <?= "<?= " ?>GridView::widget([
                            'dataProvider' => $dataProvider,
                            <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n        'columns' => [\n" : "'columns' => [\n"; ?>
                                ['class' => 'yii\grid\SerialColumn'],

                    <?php
                    $count = 0;
                    if (($tableSchema = $generator->getTableSchema()) === false) {
                        foreach ($generator->getColumnNames() as $name) {
                            if ($name != 'id'){
                                if (++$count < 6) {
                                    echo "            '" . $name . "',\n";
                                } else {
                                    echo "            //'" . $name . "',\n";
                                }
                            }
                        }
                    } else {
                        foreach ($tableSchema->columns as $column) {
                            $format = $generator->generateColumnFormat($column);
                            if ($column->name != 'id'){
                                if (++$count < 6) {
                                    echo "            '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                } else {
                                    echo "            //'" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                                }
                            }
                        }
                    }
                    ?>

                                [
                                    'class' => 'kartik\grid\ActionColumn',
                                    'urlCreator' => function($action, $model, $key, $index) { 
                                            return Url::to([$action,'id'=>$key]);
                                    },
                                    'width'=>'200px',
                                    'template'=>'{view} {update} {delete}',
                                    'buttons'=>[
                                        'view' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">visibility</i>', $url, [
                                                'class'=>'btn btn-info btn-round btn-just-icon', 
                                                'title'=>'Ver',
                                                'aria-label'=>'Ver',
                                                'data-pjax'=>0
                                            ]);
                                        },
                                        'update' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">edit</i>', $url, [
                                                'class'=>'btn btn-warning btn-round btn-just-icon', 
                                                'title'=>'Modificar',
                                                'aria-label'=>'Modificar',
                                                'data-pjax'=>0
                                            ]);
                                        },
                                        'delete' => function ($url, $model, $key) {
                                            return Html::a('<i class="material-icons">delete</i>', $url, [
                                                'class'=>'btn btn-danger btn-round btn-just-icon', 
                                                'title'=>'Eliminar',
                                                'aria-label'=>'Eliminar',
                                                'data-confirm'=>'¿ Esta seguro de eliminar este elemento ?',
                                                'data-method'=>'post'
                                            ]);
                                        },
                                    ]
                                ],
                            ],
                            'bordered' => true,
                            'striped' => false,
                            'hover' => true,
                            'condensed' => false,
                            'responsive' => true,          
                            'responsiveWrap' => false,                 
                            'resizableColumns' => false,   
                        ]); ?>
                    <?php else: ?>
                        <?= "<?= " ?>ListView::widget([
                            'dataProvider' => $dataProvider,
                            'itemOptions' => ['class' => 'item'],
                            'itemView' => function ($model, $key, $index, $widget) {
                                return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                            },
                        ]) ?>
                    <?php endif; ?>
                    <?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>

                </div>
            </div>
        </div>
    </div>
</div>
