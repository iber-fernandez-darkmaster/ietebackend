<?php

namespace app\controllers;

use Yii;
use app\models\TrailsLog;
use app\models\TrailsLogSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;

/**
 * TrailslogController implements the CRUD actions for TrailsLog model.
 */
class TrailslogController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TrailsLog models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrailsLogSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $this->getView()->registerJsFile('/js/trailslog/index.js', [\yii\web\JqueryAsset::className()]); 
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single TrailsLog model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new TrailsLog model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrailsLog();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TrailsLog model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TrailsLog model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrailsLog model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return TrailsLog the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrailsLog::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

       /**
     * Delete multiple existing CarreraCurso model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionBulkDelete()
    {        
        $request = Yii::$app->request;
        // $pks = explode(',', $request->post( 'pks' )); // Array or selected records primary keys
        $pks = $request->post( 'pks' );
        foreach ( $pks as $pk ) {
            $model = $this->findModel($pk);
            $model->delete();
        }
        Yii::$app->session->setFlash('success', 'Los datos fuero elminados correctamente');
        return $this->redirect(['index']);
        // if($request->isAjax){
        //     /*
        //     *   Process for ajax request
        //     */
        //     Yii::$app->response->format = Response::FORMAT_JSON;
        //     return [
        //         'message'=>'Los datos fuero elminados correctamente',
        //     ];
        //     // return ['forceClose'=>true,'forceReload'=>'#crud-datatable-pjax'];
        // }else{
        //     /*
        //     *   Process for non-ajax request
        //     */
        //     return $this->redirect(['index']);
        // }
       
    }
}
