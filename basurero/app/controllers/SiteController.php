<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\Nosotros;
use app\models\Contacto;
use app\models\Servicios;
use app\models\Detalleservicio;
use app\models\Slider;
use app\models\Equipo;
use app\models\Beneficios;
use app\models\Categoriaproyecto;
use app\models\Proyecto;

use yii\data\Pagination;
use app\components\errors\ErrorsComponent;

class SiteController extends Controller
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
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @param $id id de zona
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
    
    public function actionError(){
        return $this->render('error');
    }
}