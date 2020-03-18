<?php

namespace app\controllers;

use Yii;
use app\models\Estudiante;
use app\models\EstudianteSearch;
use app\models\Respuestas;
use app\models\Examen;
use app\models\Preguntas;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;

/**
 * EstudianteController implements the CRUD actions for Estudiante model.
 */
class EstudianteController extends Controller
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
     * Lists all Estudiante models.
     * @return mixed
     */
    public function actionIndex()
    {
        if (Yii::$app->user->can('Administrador'))
        {
            $searchModel = new EstudianteSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }
        if (Yii::$app->user->can('Responsable Centro'))
        {
            $searchModel = new EstudianteSearch();
            $searchModel->centro_id = Yii::$app->user->identity->centro_id;
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Estudiante model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
            'examenes' => $model->examenes,
        ]);
    }

    public function actionVerExamen($pEx, $pEst){
        $examen = Examen::findOne($pEx);
        if (!$examen){
            throw new \yii\web\NotFoundHttpException("El examen no existe");
        }
        $estudiante = Estudiante::findOne($pEst);
        if (!$estudiante){
            throw new \yii\web\NotFoundHttpException("El estudiante no existe");
        }
        $respuestasEstudiante = Respuestas::find()
            ->joinWith('pregunta')
            ->where([
                'respuestas.estudiante_id'=>$estudiante->id,
                'preguntas.examen_id'=>$examen->id,
            ])
            ->all();
        // return var_dump($respuestasEstudiante);
                
        return $this->render('ver_examen', [
            'examen' => $examen,
            'estudiante' => $estudiante,
            'respuestasEstudiante' => $respuestasEstudiante,
        ]);
    }

    /**
     * Creates a new Estudiante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = \Yii::$app->request;
        $model = new Estudiante();
        if (\Yii::$app->user->can('Responsable Centro')){
            $model->centro_id = \Yii::$app->user->identity->centro_id;
        }
        // return $model->centro_id;

        // if ($model->load(Yii::$app->request->post()) && $model->validate()) {
        if ($request->isPost && $model->load(Yii::$app->request->post()) ) {
            $transaction = $model->getDb()->beginTransaction();
            try {
                $datos = Yii::$app->request->post('Estudiante')['dni'];
                $model->password_hash = Yii::$app->security->generatePasswordHash($this->password($datos));
                $model->status = 10;
                $model->auth_key = Yii::$app->security->generateRandomString();
                if ( !$model->validate() ){
                    throw new \Exception(var_dump($model->errors));
                }
                $model->save();
                $image = UploadedFile::getInstance($model, 'foto');
                if ($image){
                    $imageName = 'estudiante_'.$model->id.date('ymdHis').'.'.$image->getExtension();
                    $image->saveAs(\Yii::getAlias('@imagePath').Estudiante::PATH.$imageName);
                    $model->foto = $imageName;
                }
                $model->save();
                $transaction->commit();
                Yii::$app->session->setFlash('success', 'El estudiante se registro correctamente');
                return $this->redirect(['view', 'id' => $model->id]);
            } catch (\Throwable $e) {
                $transaction->rollBack();
                return var_dump($e->getMessage());
                Yii::$app->session->setFlash('warning', $e->getMessage() );
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    private function password($valor)
    {
        $r = str_split($valor);
        $p = '';
        foreach($r as $d)
        {
            $p .= $d.'a';
        }
        return $p;
    }

    /**
     * Updates an existing Estudiante model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $auxfoto = $model->foto;
        if ($model->load(Yii::$app->request->post())) {
            $image = UploadedFile::getInstance($model, 'foto');
            $model->foto = $auxfoto;
            if ($image){
                if ( $model->foto != "" ){
                    $imageExist = Yii::getAlias('@imagePath').Estudiante::PATH.$model->foto;
                    if ( file_exists($imageExist) ){
                        unlink($imageExist);
                    }
                }
                $imageName = 'estudiante_'.$model->id.date('ymdHis').'.'.$image->getExtension();
                $image->saveAs(\Yii::getAlias('@imagePath').Estudiante::PATH.$imageName);
                $model->foto = $imageName;
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Estudiante model.
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
     * Finds the Estudiante model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Estudiante the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Estudiante::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
