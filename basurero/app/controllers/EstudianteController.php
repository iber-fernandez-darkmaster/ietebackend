<?php

namespace app\controllers;

use Yii;
use app\models\Estudiante;
use app\models\EstudianteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Estudiante model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Estudiante();

        if ($model->load(Yii::$app->request->post())) {
            $transaction = $model->getDb()->beginTransaction();
            try {
                $datos = Yii::$app->request->post('Estudiante')['dni'];
                $model->password_hash = Yii::$app->security->generatePasswordHash($this->password($datos));
                $model->status = 10;
                $model->auth_key = Yii::$app->security->generateRandomString();
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
