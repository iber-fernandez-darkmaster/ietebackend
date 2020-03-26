<?php

namespace app\controllers;

use Yii;
use app\models\form\Login;
use app\models\form\PasswordResetRequest;
use app\models\form\ResetPassword;
use app\models\form\Signup;
use app\models\form\ChangePassword;
use app\models\User;
use app\models\searchs\UserSearch as UserSearch;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use yii\base\UserException;
use yii\mail\BaseMailer;
use yii\filters\AccessControl;
use app\models\TrailsLog;

/**
 * User controller
 */
class UserController extends Controller
{
    private $_oldMailPath;

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                    // 'logout' => ['post'],
                    'activate' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            if (Yii::$app->has('mailer') && ($mailer = Yii::$app->getMailer()) instanceof BaseMailer) {
                /* @var $mailer BaseMailer */
                $this->_oldMailPath = $mailer->getViewPath();
                $mailer->setViewPath('@mdm/admin/mail');
            }
            return true;
        }
        return false;
    }

    /**
     * @inheritdoc
     */
    public function afterAction($action, $result)
    {
        if ($this->_oldMailPath !== null) {
            Yii::$app->getMailer()->setViewPath($this->_oldMailPath);
        }
        return parent::afterAction($action, $result);
    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
                'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Login
     * @return string
     */
    public function actionLogin()
    {
        $this->layout = '/login';

        if (!Yii::$app->getUser()->isGuest) {
            return $this->goHome();
        }

        $model = new Login();
        if ( $model->load(Yii::$app->getRequest()->post()) ) {
            if ($model->login()) {
                //registrando historial de usuario
                $log = new TrailsLog();
                $log->model = get_class(\Yii::$app->user->identity);
                $log->id_model = \Yii::$app->user->identity->id;
                $log->user_id = \Yii::$app->user->identity->id;
                $log->description = 'Ingreso al sistema';
                $log->action = 'login';
                $log->ip = \Yii::$app->getRequest()->getUserIP();
                $log->creation_date= time();
                $log->save();
                return $this->goBack();
            }else{
                Yii::$app->session->setFlash('danger', "El nombre de usuario o el password son incorrectos");
                return $this->render('login', [
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('login', [
                    'model' => $model,
            ]);
        }
    }

    /**
     * Logout
     * @return string
     */
    public function actionLogout()
    {
        //registrando historial de usuario
        $log = new TrailsLog();
        $log->model = get_class(\Yii::$app->user->identity);
        $log->id_model = \Yii::$app->user->identity->id;
        $log->user_id = \Yii::$app->user->identity->id;
        $log->description = 'Salio del sistema';
        $log->action = 'logout';
        $log->ip = \Yii::$app->getRequest()->getUserIP();
        $log->creation_date= time();
        $log->save();

        Yii::$app->getUser()->logout();

        // return $this->goHome();
        return $this->redirect(['/administrador']);
    }

    /**
     * Signup new user
     * @return string
     */
    public function actionSignup()
    {
        // $this->layout = '/login';

        $model = new Signup();
        if ($model->load(Yii::$app->getRequest()->post())) {
            if ($user = $model->signup()) {
                // $auth = Yii::$app->authManager;
                // $rol = $auth->getRole($model->rol);
                // $auth->assign($rol, $user->id);
                Yii::$app->session->setFlash('success', 'Usuario registrado correctamente');
                return $this->redirect(['/admin/assignment/view', 'id'=>$user->id]);
            }
            else{
                return var_dump($model->errors);
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Request reset password
     * @return string
     */
    public function actionRequestPasswordReset()
    {
        $this->layout = '/login';
        $model = new PasswordResetRequest();
        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->getSession()->setFlash('success', 'Revisa tu correo electronico y sigue las instrucciones.');

                return $this->goHome();
            } else {
                Yii::$app->getSession()->setFlash('error', 'Lo sentimos, no podemos restablecer la contraseña para el correo electrónico proporcionado.');
            }
        }

        return $this->render('requestPasswordResetToken', [
                'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionResetPassword($token)
    {
        $this->layout = '/login';
        try {
            $model = new ResetPassword($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->getRequest()->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->getSession()->setFlash('success', 'Nueva contraseña fue guardada correctamente.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
                'model' => $model,
        ]);
    }

    /**
     * Reset password
     * @return string
     */
    public function actionChangePassword($id)
    {
        $this->layout = '/main';
        $model = new ChangePassword();
        //solo si es vendedor se activa la validacion del ingreso del anteriro password
        if ( \Yii::$app->user->can('secretaria') == true && \Yii::$app->user->can('administrador') == false ){
            $model->scenario = ChangePassword::SCENARIO_USER;
        }else{
            $model->scenario = ChangePassword::SCENARIO_ADMIN;
        }
        //modificando el password
        if ($model->load(Yii::$app->getRequest()->post()) && $model->change($id)) {
            $user = User::findOne($id);
            //registrando historial de usuario
            $log = new TrailsLog();
            $log->model = get_class($user);
            $log->id_model = $user->id;
            $log->user_id = \Yii::$app->user->identity->id;
            $log->description = 'Modifico la contraseña de '. $user->username;
            $log->action = 'change-password';
            $log->ip = \Yii::$app->getRequest()->getUserIP();
            $log->creation_date= time();
            $log->save();

            Yii::$app->session->setFlash('success', 'Contraseña cambiada correctamente');
            return $this->goHome();
        }

        return $this->render('change-password', [
                'model' => $model,
        ]);
    }

    /**
     * Activate new user
     * @param integer $id
     * @return type
     * @throws UserException
     * @throws NotFoundHttpException
     */
    public function actionActivate($id)
    {
        /* @var $user User */
        $user = $this->findModel($id);
        if ($user->status == User::STATUS_INACTIVE) {
            $user->status = User::STATUS_ACTIVE;
            if ($user->save()) {
                return $this->goHome();
            } else {
                $errors = $user->firstErrors;
                throw new UserException(reset($errors));
            }
        }
        return $this->goHome();
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
