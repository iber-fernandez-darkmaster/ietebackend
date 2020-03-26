<?php 
namespace app\controllers;

use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Informacion;
use app\models\Materia;
use app\models\Estudiante;
use app\models\Habilitaciones;

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
class InformacionController extends Controller
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
            //         'ciudades',
            //         'search-public',
            //         'categorias',
            //     ]
            // ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
                'rules' => [
                    [
                        'actions' => [
                            'index', 
                        ],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'crearinformacion' => ['post'],
                    'materias' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Accion de la pagina principal
     * @return JSON
     */
    public function actionIndex()
    {
        return "Welcome to API's IETE";
    }

    private function base64_to_jpeg($base64_string, $output_file) 
    {
        // open the output file for writing
        $ifp = fopen( \Yii::getAlias('@imagePath').'/informacion/'.$output_file, 'wb' );
        // split the string on commas
        // $data[ 0 ] == "data:image/png;base64"
        // $data[ 1 ] == <actual base64 string>
        $data = explode( ',', $base64_string );
        if(count($data)>1) {
            $dataText=$data[ 1 ];
        } else {
            $dataText=$base64_string;
        }
        // we could add validation here with ensuring count( $data ) > 1
        $res = fwrite( $ifp, base64_decode( $dataText ) );
        // clean up the file resource
        fclose( $ifp ); 
        return $res; 
    }

    public function actionCrearinformacion()
    {
        //URL:  http://iete.test/informacion/crearinformacion

        // \Yii::$app->request->parsers['application/json'] = 'yii\web\JsonParser';
        $request = \Yii::$app->request;
        $db = \Yii::$app->db;

        $informacion = new Informacion();
        if ($request->isPost) {
            $transaction = $informacion->db->beginTransaction();
            try{

                if ( !$request->post('foto') && !$request->post('idestudiante') && !$request->post('idcentro') && !$request->post('idexamen') ){
                    throw new \Exception('Los campos son requerdios');
                }
                
                $informacion->idestudiante = $request->post('idestudiante');
                $informacion->idcentro = $request->post('idcentro');
                $informacion->idexamen = $request->post('idexamen');

                if ( $informacion->foto != '' ){
                    //eliminando foto existente
                    $imageExist = \Yii::getAlias('@imagePath').'/informacion/'.$informacion->foto;
                    if ( file_exists($imageExist) ){
                        unlink($imageExist);
                    }
                }
                /////obtener nombre de los 3 id que se registraran
                //$ide = substr($informacion->idestudiante, 0,3 );
                $ide = $informacion->idestudiante;   
                $idin = substr($informacion->idcentro, 0,4 );   
                $idex = substr($informacion->idexamen, 0,3 );   
                $nombreimagen = $ide.''.$idin.''.$idex;
                
                $informacion->foto = $nombreimagen.'.png';
                if ( !$this->base64_to_jpeg($request->post('foto'), $informacion->foto) ){
                    throw new \Exception('La foto tuvo inconveniente al guardarse');
                }

                if( !$informacion->validate()){
                    throw new \Exception(ErrorsComponent::formatJustString($informacion->errors) );
                }
                $informacion->save();
                                
                $transaction->commit();
                return [
                    'status' => true, 
                    'data' => 'Información creada correctamente'
                ];
                
            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw new UnprocessableEntityHttpException( $e->getMessage() );
                // $transaction->rollBack();
                // \Yii::$app->response->statusCode = 422;
                // return array(
                //     'status' => false, 
                //     'data' => $e->getMessage()
                // );
            }
        }else{
            \Yii::$app->response->statusCode = 422;
            return array('status'=>false, 'data'=>'Error method');
        }   
    }
    public function actionMaterias()
    {
        //URL: http://api.iete.test/informacion/materias

        $request = \Yii::$app->request;

        $id = $request->post('idestudiante');
        $estudiante = Estudiante::findOne($id);
        if ( !$estudiante ){
            throw new UnprocessableEntityHttpException( 'El estudiante no existe' );
        }

        $materias = Habilitaciones::find()
        ->where(['estudiante_id'=>$id,'estado'=>'Activo'])
        ->orderBy(['rand()' => SORT_DESC])
        ->all();

        $datos = ArrayHelper::toArray($materias, [
            Habilitaciones::className() => [
                'estudiante'=>function($model){
                    return $model->estudiante->nombre_completo;
                },
                'materia'=>function($model){
                    return $model->materia->nombre;
                },
                'id'=>function($model){
                    return $model->materia->id;
                },
            ],
        ]);

        if ($materias) {
            return $datos;
        } else {
            return [];
        }
    }
}