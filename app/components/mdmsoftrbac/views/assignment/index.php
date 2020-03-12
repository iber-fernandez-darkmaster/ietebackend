<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $searchModel mdm\admin\models\searchs\Assignment */
/* @var $usernameField string */
/* @var $extraColumns string[] */

$this->title = 'Asignaciones';
$this->params['breadcrumbs'][] = $this->title;

$columns = [
    ['class' => 'yii\grid\SerialColumn'],
    $usernameField,
];
if (!empty($extraColumns)) {
    $columns = array_merge($columns, $extraColumns);
}
$columns[] = [
    'class' => 'yii\grid\ActionColumn',
    'template' => '{view}',
    'header'=>'Accion',
    'buttons'=>[
        'view' => function ($url, $model, $key) {
            return Html::a('<i class="material-icons">visibility</i>', $url, ['class'=>'btn btn-info btn-round btn-just-icon']);
        },
    ]
];
?>
<div class="assignment-index">

    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 col-centered">
            <?php Pjax::begin(); ?>
                <div class="card">
                    <div class="card-content table-responsive">
                        <h4><?= Html::encode($this->title) ?></h4>
                        <hr>
                        <?=
                        GridView::widget([
                            'dataProvider' => $dataProvider,
                            // 'filterModel' => $searchModel,
                            'tableOptions'=>['class' => 'table'],
                            'columns' => $columns,
                        ]);
                        ?>
                    </div>
                </div>
            <?php Pjax::end(); ?>
            
        </div>
    </div>
    

</div>
