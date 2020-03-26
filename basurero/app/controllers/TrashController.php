<?php
namespace app\controllers;  
use Yii;
use yii\db\ActiveRecord;
use yii\filters\VerbFilter;
use yii\web\Controller;
use app\models\TrailsLog;
use app\models\Profesor;
use app\models\User;

class TrashController extends  controller
{
    public function behaviors(){
        return [
            'verbs'=>[
                'class'=>VerbFilter::className(),
                'actions'=>[
                    'deleteforever'=>['post'],
                    'validarusuario'=>['get']
                ]
            ]
        ];
    }

    /**
     * show de index page of trash rows
     * @return void
     */
    public function actionIndex(){
        $trailsLog = TrailsLog::find()->all();
        return $this->render('index', [
            'trailsLog'=>$trailsLog,
        ]);
    }

    public function actionValidarusuario(){
        $request = Yii::$app->request;

        if($request->isGet && \Yii::$app->user->can('administrador') == true){
            $action = $request->get('action');
            $usuario = \Yii::$app->user->identity;
            $usuario->password_hash = "";
            return $this->render('confirmpassword', [
                'action'=>$action,
                'usuario'=>$usuario 
            ]);
        }else{
            Yii::$app->session->setFlash('error', 'No tiene permiso para eliminar estos datos');
            return $this->redirect(['index']);
        }
    }

    public function actionDeleteforever(){
        $request = Yii::$app->request;

        if($request->isPost){
            $action = $request->post('action');
            $contrasena = $request->post('User')['password_hash'];
            $userId = \Yii::$app->user->identity->id;
            $usuario = User::findOne($userId);
            if( $usuario->validatePassword($contrasena) ){
                switch ($action) {
                    case 'trailslog':
                        TrailsLog::deleteAll();
                        break;
                    case 'trailslog':
                        Profesor::deleteAll('state = :estado', [':estado' => 0]);
                        break;            
                    default:
                        return $this->redirect(['index']);
                    break;
                }
                \Yii::$app->session->setFlash('success', 'datos eliminados correctamente');
                return $this->redirect(['index']);
            }else{
                \Yii::$app->session->setFlash('error', 'Contraseña invalida');
                return $this->redirect(['validarusuario', 'action'=>$action]);
            }
        }
    }
}
