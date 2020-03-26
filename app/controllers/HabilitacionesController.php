<?php

namespace app\controllers;

use Yii;
use app\models\Habilitaciones;
use app\models\HabilitacionesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Carbon\Carbon;


/**
 * HabilitacionesController implements the CRUD actions for Habilitaciones model.
 */
class HabilitacionesController extends Controller
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
     * Lists all Habilitaciones models.
     * @return mixed
     */
    public function actionIndex()
    {
        $eliminar = Habilitaciones::find()->where(['estado'=>'Activo'])
        ->andFilterWhere(['<','fecha', Carbon::now()->subDays(60)])
        ->all();
        foreach ($eliminar as $e) 
        {
            $e->estado = 'Inactivo';
            $e->save();
        }
        
        $searchModel = new HabilitacionesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Habilitaciones model.
     * @param integer $id
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
     * Creates a new Habilitaciones model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Habilitaciones();

        if ($model->load(Yii::$app->request->post())) {

            ////Verificacion del registro de la materia si ya fue asiganda
            $idmateria = Yii::$app->request->post('Habilitaciones')['materia_id'];
            $materia = Habilitaciones::find()->where(['materia_id'=>$idmateria])->one();
            if($materia){
                Yii::$app->session->setFlash('error', 'La materia ya fue asignada');
                return $this->redirect(['create', 'model' => $model]);
            }
            $model->fecha = date('Y-m-d');
            $model->estado = 'Activo';
            $model->save();

            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Habilitaciones model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
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
     * Deletes an existing Habilitaciones model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Habilitaciones model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Habilitaciones the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Habilitaciones::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
