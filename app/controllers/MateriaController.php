<?php

namespace app\controllers;

use Yii;
use app\models\Materia;
use app\models\Estudiante;
use app\models\MateriaSearch;
use app\models\Preguntas;
use app\models\Examen;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MateriaController implements the CRUD actions for Materia model.
 */
class MateriaController extends Controller
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
     * Lists all Materia models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MateriaSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Materia model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id){
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' =>$model,
        ]);
    }

    /**
     * Creates a new Materia model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Materia();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Materia model.
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
     * Deletes an existing Materia model.
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
     * Finds the Materia model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Materia the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Materia::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    
    public function actionCreateExamen($id){
        $request = \Yii::$app->request;
        $materia = Materia::findOne($id);
        if(!$materia){
            throw new NotFoundHttpException("No se encuentra el cliente");
        }
        $model = new Examen();
        $model->materia_id = $id;
        $model->fecha = date('Y-m-d');
        $model->respuesta = 0;

        if ($request->isPost){
            $model->load($request->post());
            try {
                if(!$model->validate()){
                    throw new Exception(\app\components\errors\ErrorsComponent::formatJustString($model->errors));
                }
                $model->save();

                $preguntas = $request->post('preguntas');
                $respuestas = $request->post('respuestas');
                foreach ($preguntas as $key => $item) {
                    $pregunta = new Preguntas();
                    $pregunta->examen_id = $model->id;
                    $pregunta->pregunta = $item;
                    $pregunta->respuesta_correcta = $respuestas[$key];
                    if(!$pregunta->save()){
                        throw new Exception(\app\components\errors\ErrorsComponent::formatJustString($pregunta->errors));
                    }
                }
                return $this->redirect(['ver-examen', 'id'=>$model->id]);
            } catch (\Throwable $th) {
                return var_dump( $th->getMessage() );
            }
        }

        return $this->render('create_examen', [
            'model'=>$model,
        ]);
    }

    public function actionVerExamen($id){
        $model = Examen::findOne($id);
        if (!$model){
            throw new NotFoundHttpException("el examen no existe");
        }   
        return $this->render('ver_examen', [
            'model'=>$model,
        ]);
    }

    public function actionExamenes($id){
        $materia = Materia::findOne();
        if(!$materia){
            throw new NotFoundHttpException("No se encuentra el cliente");
        }
    }

    public function actionUpdateExamen($id){
        $request = \Yii::$app->request;
        $model = Examen::findOne($id);
        if (!$model){
            throw new \yii\web\NotFoundHttpException("El examen no existe");
        }
        if ($request->isPost && $model->load($request->post())){
            try {
                if (!$model->save()){
                    throw new Exception("Hubo un incomveniente con el examen");
                }
                return $this->redirect(['view', 'id'=>$model->materia_id]);
            } catch (\Throwable $th) {
                \Yii::$app->session->setFlash('warning', $th->getMessage());
            }
        }

        return $this->render('update_examen',[
            'model'=>$model,
        ]);
    }
    
    public function actionUpdatePregunta($preg){
        $request = \Yii::$app->request;
        $model = Preguntas::findOne($preg);
        if (!$model){
            throw new \yii\web\NotFoundHttpException("La Pregunta no existe");
        }
        if ($request->isPost && $model->load($request->post())){
            try {
                if (!$model->save()){
                    throw new Exception("Hubo un incomveniente con el examen");
                }
                return $this->redirect(['ver-examen', 'id'=>$model->examen_id]);
            } catch (\Throwable $th) {
                \Yii::$app->session->setFlash('warning', $th->getMessage());
            }
        }

        return $this->render('update_pregunta',[
            'model'=>$model,
        ]);
    }
}
