<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\AsistenciaSeminario;
use app\models\Estudiante;
use app\models\AsignacionCasillero;
use app\models\Mensualidad;
use app\models\Year;
use app\models\Inscripcion;
use app\models\Baner;
use app\models\Ambiente;
use app\models\MenuComida;
use app\models\Evento;
use yii\data\Pagination;

class AdministradorController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => [
                            'index', 
                            'error',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
                'except'=>[
                    'index', 
                    'error',
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            // 'error' => [
            //     'class' => 'yii\web\ErrorAction',
            // ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        // $this->layout = 'website';
        return $this->render('index',[
        ]);
    }
}
