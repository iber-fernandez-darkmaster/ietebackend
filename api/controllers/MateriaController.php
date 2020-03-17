<?php 
namespace app\controllers;

use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Informacion;
use app\models\Materia;
use app\models\Estudiante;
use app\models\Examen;
use app\models\Preguntas;

use yii\web\NotFoundHttpException;;
use yii\web\ForbiddenHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\BadRequestHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\UnauthorizedHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;
use yii\data\Pagination;
use yii\web\Response;

use app\components\errors\ErrorsComponent;

/**
 * Mediante este controlador puede obtener todos los recursos de productos.
 * 
 * Mediante este controlador puede obtener todos los recursos de productos
 */
class MateriaController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'corsFilter'  => [
                'class' => Cors::className(),
                'cors' => [
                    'Origin' => ['*'],
                    'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'DELETE'],
                    'Access-Control-Request-Headers' => ['*'],
                    'Access-Control-Allow-Credentials' => false,
                    'Access-Control-Max-Age' => 3600,
                    'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
                ],
            ],
            // 'bearerAuth' => [
            //     'class' => HttpBearerAuth::className(),
            //     'except'=>[
            //     ]
            // ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => [
                            'index', 
                            'examenes', 
                            'preguntas', 
                        ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'materias' => ['get'],
                    'examenes' => ['get'],
                    'preguntas' => ['get'],
                ],
            ],
        ];
    }

    /**
     * Lista de materias registradas.
     * 
     * `Url`: /materia/index <br>
     * `method`: get <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: none <br>
     * `body`: <br>
     * @return JSON Ejemplo del resultado:
     *     [
     *         {
     *             "id": 1,
     *             "nombre": "ingles basico "
     *         }
     *     ]
     */
    public function actionIndex(){
        $materias = Materia::find()->all();
        return $materias;
    }

    /**
     * Lista de examenes.
     * 
     * `Url`: /materia/examenes?id=[id de la materia] <br>
     * `method`: get <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: none <br>
     * `body`: <br>
     * @param int $id id de materia
     * @return JSON Ejemplo del resultado:
     *     [
     *         {
     *             "id": 1,
     *             "materia_id": 1,
     *             "materia": {
     *                 "id": 1,
     *                 "nombre": "ingles basico "
     *             },
     *             "fecha": "2020-03-14",
     *             "titulo": "dsdsdsds"
     *         },
     *     ]
     */
    public function actionExamenes($id){
        $request = \Yii::$app->request;
        $materia = Materia::findOne($id);
        if (!$materia){
            throw new NotFoundHttpException("La materia no existe");
        }

        return ArrayHelper::toArray($materia->examenes, [
            Examen::className() => [
                'id',
                'materia_id',
                'materia'=>function($model){
                    return $model->materia;
                },
                'fecha',
                'titulo',
            ],
        ]);
    }
 
    /**
     * Lista de preguntas.
     * 
     * `Url`: /materia/preguntas?id=[id del examen] <br>
     * `method`: get <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: none <br>
     * `body`: <br>
     * @param int $id id del examen
     * @return JSON Ejemplo del resultado:
     *     [
     *         {
     *             "id": 7,
     *             "examen_id": 4,
     *             "examen": {
     *                 "id": 4,
     *                 "materia_id": 1,
     *                 "fecha": "2020-03-17",
     *                 "titulo": "sasasasa"
     *             },
     *             "pregunta": "dsadsa",
     *             "respuesta_correcta": 0,
     *             "str_respuesta_correcta": "Falso"
     *         },
     *         {
     *             "id": 10,
     *             "examen_id": 4,
     *             "examen": {
     *                 "id": 4,
     *                 "materia_id": 1,
     *                 "fecha": "2020-03-17",
     *                 "titulo": "sasasasa"
     *             },
     *             "pregunta": "dsadsa",
     *             "respuesta_correcta": 1,
     *             "str_respuesta_correcta": "Verdadero"
     *         }
     *     ]
     */
    public function actionPreguntas($id){
        $request = \Yii::$app->request;
        $examen = Examen::findOne($id);
        if (!$examen){
            throw new NotFoundHttpException("El examen no existe");
        }

        return ArrayHelper::toArray($examen->preguntas, [
            Preguntas::className() => [
                'id',
                'examen_id',
                'examen'=>function($model){
                    return $model->examen;
                },
                'pregunta',
                'respuesta_correcta',
                'str_respuesta_correcta'=>function($model){
                    return $model->strRespuesta;
                },
            ],
        ]);
    }
    
    /**
     * Registrar respuestas de un examen.
     * 
     * `Url`: /materia/register-respuestas?examen=[id del examen]&estudiante=[id del estudiante] <br>
     * `method`: post <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: none <br>
     * `body`: <br>
     *     {
     *         "respuestas":[
     *              "pregunta_id": "",  // integer
     *              "respuesta":"", // integer on or off where on is 1 and off is 0
     *         ]
     *     }
     * @param int $examen id del examen
     * @param int $estudiante id del estudiante
     * @return JSON Ejemplo del resultado:
     *     [
     *         {
     *             "id": 7,
     *             "examen_id": 4,
     *             "examen": {
     *                 "id": 4,
     *                 "materia_id": 1,
     *                 "fecha": "2020-03-17",
     *                 "titulo": "sasasasa"
     *             },
     *             "pregunta": "dsadsa",
     *             "respuesta_correcta": 0,
     *             "str_respuesta_correcta": "Falso"
     *         },
     *         {
     *             "id": 10,
     *             "examen_id": 4,
     *             "examen": {
     *                 "id": 4,
     *                 "materia_id": 1,
     *                 "fecha": "2020-03-17",
     *                 "titulo": "sasasasa"
     *             },
     *             "pregunta": "dsadsa",
     *             "respuesta_correcta": 1,
     *             "str_respuesta_correcta": "Verdadero"
     *         }
     *     ]
     */
    public function actionRegisterRespuestas($id){
        $request = \Yii::$app->request;
        $examen = Examen::findOne($id);
        if (!$examen){
            throw new NotFoundHttpException("El examen no existe");
        }
        $respuestas = $request->post('respuestas'); 

        try {
            
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}