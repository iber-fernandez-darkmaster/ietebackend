<?php 
namespace app\controllers;

use yii;
use yii\rest\Controller;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

use app\models\Signup;
use app\models\User;
use app\models\Login;
use app\models\ChangePassword;
use app\models\Estudiante;

use yii\web\ForbiddenHttpException;
use yii\web\NotAcceptableHttpException;
use yii\web\BadRequestHttpException;
use yii\web\MethodNotAllowedHttpException;
use yii\web\UnauthorizedHttpException;
use yii\web\UnprocessableEntityHttpException;
use yii\filters\Cors;
use yii\helpers\ArrayHelper;

use app\components\errors\ErrorsComponent;

/**
 * Controlador de usuario para autentificaciones y registro de usuario interesado.
 * 
 * Mediante ete controlador se puede autentificar usuarios de tipo estudiante o 
 * interesado, tambien se pude registrar usuarios de tipo interesado.<br>
 * Usa el tipo de autentificación `Bearer Token` para autorizar la respuesta de un 
 * determinado recurso. Tambien la forma de respuesta se efectua en formato JSON
 * de la siguiente manera:<br>
 *     {
 *         "success":true|false,
 *         "data":{
 *              [RESULTADO]
 *         }
 *     }
 * Donde el atributo `success` es de tipo boolean para deternimar si un recurso es satisfactorio 
 * o falso si se ha tenido algun inconveniente como acceso no autorizado, validacion, etc.
 * y el atributo `data` es de tipo Mixto es donde se almacena el resultado de cada recuro que se 
 * quiera solicitar.<br>
 * En caso de ocurrir una excepcion el resutlado dara un success false y un data con un mensaje, nombre
 * de la excepcion y el codigo de error, teniendo un 
 * contenido similar a este ejemplo:<br>
 *     {
 *         "success": false,
 *         "data": {
 *             "name": "Unauthorized",
 *             "message": "El Estudiante no es valido",
 *             "code": 0,
 *             "status": 401,
 *             "type": "yii\\web\\UnauthorizedHttpException"
 *         }
 *     }
 * 
 */
class UserController extends Controller
{
    const password_general = 'RNOVA123456';
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
            //         'index',
            //         'signup',
            //         'login',
            //         // 'perfil',
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
                    'login' => ['post'],
                    'signup' => ['post'],
                    'cambiar-password' => ['post'],
                    'cambiar-foto' => ['post'],
                    'perfil' => ['post'],
                    'modificar-mensaje-solicitud' => ['post'],
                    'create-favorito' => ['get'],
                    'delete-favorito' => ['get'],
                    'favoritos' => ['get'],
                    'modificar-perfil' => ['post'],
                    'vendedor-perfil' => ['get'],
                    'usuarioedit' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Checks the privilege of the current user.
     *
     * This method should be overridden to check whether the current user has the privilege
     * to run the specified action against the specified data model.
     * If the user does not have access, a [[ForbiddenHttpException]] should be thrown.
     *
     * @param string $action the ID of the action to be executed
     * @param \yii\base\Model $model the model to be accessed. If null, it means no specific model is being accessed.
     * @param array $params additional parameters
     * @throws ForbiddenHttpException if the user does not have access
     */
    private function checkAccess($action, $model = null, $params = [])
    {
    }

    /**
     * retorna un array con los datos del usuario
     *
     * @return User
     */
    public function actionPerfil()
    {
        //URL:  http://api.iete.test/user/perfil
        $usuario = \Yii::$app->request->post('idestudiante');
        $usuario = Estudiante::findOne($usuario);
        return [
            'id'=>$usuario->id,
            'nombre_completo'=>$usuario->nombre_completo,
            'dni'=>$usuario->dni,
            'email'=>$usuario->email,
            'foto'=>$usuario->strFoto,
            'centro'=>$usuario->centro->numero_id,
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
    public function actionLogin()
    {
        // Url: http://api.iete.test/user/login

        $request = \Yii::$app->request;
        if ( $request->post('password')) {
            // login normal
            $login = new Login();
            $login->email = $request->post('email');
            $login->password = $request->post('password');
            if ( $login->login() ){
                $usuario = User::find()
                    ->where([
                        'estudiante.id'=>$login->user->id
                    ])
                    ->one();
                $usuario->save();
                return $usuario;
            }else{
                throw new UnauthorizedHttpException("El usuario no es valido");
            }
        }
    }
    
    /**
     * Accion para autorizar a un usuario.
     *
     * Tambien algo importante de esta accion es que una ves se obtenga el resultado satisfactorio debe de 
     * capturarse el objeto del usuario, y aun mas IMPORTANTE capturar el valor del atributo `access_token` que 
     * sirve como llave para solicitar recursos.<br>
     * 
     * `Url`: /user/login <br>
     * `method`: post <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: none <br>
     * `body`: <br>
     *     {
     *         "email":"[value]",
     *         "password":"[value]"
     *     } 
     * @param string $ci ci del estudiante
     * @param string $password por defecto es el mismo ci del estudiante
     * @return JSON Ejemplo del resultado:
     *     {
     *         "id": "21",
     *         "auth_key": "qa6djieLN54354fdsfdsrYvW86hXma",
     *         "password_hash": "$2y$13$5DIY.cKtI0oAZ8OGU1Qmc4JkHgU6Udsads3YAUqxpa",
     *         "password_reset_token": null,
     *         "email": "",
     *         "access_token": "xBqEsw43243DNZYBGwKmSTvXdsfdsfds234zyWpFjAHDi432-Iw6",
     *         "estudiante_id": "32",
     *         "interesado_id": null,
     *         "status": "10",
     *         "created_at": "1563294681",
     *         "updated_at": "1563294681",
     *     }
     */
    // public function actionLoginFacebook(){
    //     $request = \Yii::$app->request;
    //     if ( $request->isPost ){
    //         $login = new Login();
    //         $login->email = $request->post('email');
    //         $login->password = $request->post('password');
    //         if ( $login->login() ){
    //             return User::find()
    //                 ->where([
    //                     'app_user.id'=>$login->user->id
    //                 ])
    //                 ->asArray()
    //                 ->one();
    //         }else{
    //             throw new UnauthorizedHttpException("El usuario no es valido");
    //         }
    //     }
    // }

    /**
     * Accion para registrar un usuario desde la aplicacion mobil.
     * Registra un nuevo usuario del modelo `app\models\User`
     * 
     * `Url`: /user/signup <br>
     * `method`: post <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: none <br>
     * `body`: <br>
     *     {
     *         	   "nombre_completo":"juan",
     *         	   "telefono_celular":"43243432",
     *         	   "ciudad":"juan",
     *         	   "email":"hodsdl@aqcom.com",
     *         	   "password":"123456",
     *         	   "retypePassword":"123456"	
     *     } 
     * @param string $nombre
     * @param string $apellido
     * @param string $telefono
     * @param string $celular
     * @param string $email
     * @param string $password contraseña del usuario
     * @param string $retypePassword es usado para confirmar la contraseña del usuario
     * @return JSON Ejemplo del resultado:
     *     {
     *         "id": "2",
     *         "auth_key": "XlCoZhZc6H0EGr-1Y1EnXA2r42V2dphR",
     *         "password_hash": "$2y$13$lQ/Ud77B178m/VjRWI71zecvD2ePI.7VVYoWul7x5A/qJHZoziuRO",
     *         "password_reset_token": null,
     *         "email": "hodsdl@aqcom.com",
     *         "rol": "2",
     *         "access_token": "Rz7ZMHJb3bOBUUFVuQoM_OW7JTM1-mvb",
     *         "status": "10",
     *         "created_at": "1563282716",
     *         "updated_at": "1563282716",
     *     }
     */
    public function actionSignup(){

        //URL: http://api.inmobiliaria.test/user/signup

        $request = \Yii::$app->request;
        $user = new User();  
        if ( $request->isPost ){
            $transaction = $user->getDb()->beginTransaction();
            try {
                $signup = new Signup();
                $params = Yii::$app->request->post();
                $signup->nombre_completo = $params['nombre_completo'];
                $signup->email=$params['email'];
                $signup->celular=$params['celular'];
                $signup->ci=$params['ci'];
                $signup->password=$params['password'];
                if ( !$signup->validate() ){
                    throw new \Exception(ErrorsComponent::formatJustString($signup->errors) );
                }
                $user = $signup->signup();
                if ( !$user ){
                    return $signup->errors;
                }
                $transaction->commit();
                return User::find()
                    ->where([
                        'cliente.id'=>$user->id
                    ])
                    ->asArray()
                    ->one();

            } catch (\Throwable $e) {
                $transaction->rollBack();
                throw new UnprocessableEntityHttpException( $e->getMessage() );
            }
        }

        ErrorsComponent::format($singup->errors);
    }
    /**
     * api para editar usuario
     * URL: http://api.inmobiliaria.test/user/usuarioedit      
     * @return JSON
     */
    public function actionUsuarioedit()
    {  
        $request = \Yii::$app->request;
        $usuario = User::findOne($request->post('id'));
        
        if ( $request->isPost && $usuario ){

            $transaction = $usuario->db->beginTransaction();
            try{
                $usuario->attributes = $request->post();
                $usuario->nombre_completo = $request->post('nombre_completo');
                $usuario->email = $request->post('email');
                $usuario->celular = $request->post('celular');
                $usuario->ci = $request->post('ci');
                $usuario->player_id = $request->post('player_id');


                if( !$usuario->validate() ){
                    foreach ($usuario->errors as $attribute=>$error){
                        foreach ($error as $message){
                            throw new \Exception( $attribute.": ".$message );
                        }
                    }
                }
                $usuario->save();
                $transaction->commit();
                return array(
                    'status'=>true, 
                    'data'=>'Registro editado correctamente'
                );
            } catch (\Throwable $e) {
                $transaction->rollBack();
                Yii::$app->response->statusCode = 422;
                return array(
                    'status' => false, 
                    'data' => $e->getMessage()
                );
            }
        }        
        throw new UnprocessableEntityHttpException('El usuario no existe');
    }
    

    /**
     * Cambia la contraseña de un usuario.
     * Cambia la contraseña de tipo usuario y de tipo estudiante tambien.
     *
     * `Url`: /user/cambiar-password?id=[id del usuario] <br>
     * `method`: post <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: Bearer[access_token] <br>
     * `body`: <br>
     *     {
     *         "ChangePassword":{
     *         	   "oldPassword":"123",
     *         	   "newPassword":"123456",
     *         	   "retypePassword":"123456",
     *         }
     *     } 
     * @param int $id id de usuario de la tabla app_user
     * @throws UnprocessableEntityHttpException errore de validacion
     * @return JSON retorna solo el mensaje de existo
     */
    public function actionCambiarPassword($id){
        $model = new ChangePassword();
        $model->scenario = ChangePassword::SCENARIO_USER;

        if ($model->load(\Yii::$app->getRequest()->post()) && $model->change($id)) {
            return [
                'message'=>'Contraseña fue cambiada correctamente',
            ];
        }

        ErrorsComponent::format($model->errors);
    }

    /**
     * Muestra los favoritos.
     * Muestra la lista de favoritos del usuario
     * 
     * `Url`: /user/favoritos <br>
     * `method`: get <br>
     * `Content-Type`: application/json <br>
     * `Autorization`: Bearer[access_token] <br>
     * `body`: <br>
     * @param int $id id del producto
     * @throws UnprocessableEntityHttpException errore de validacion
     * @return string mensaje de exito, 
     * Ejemplo de lo que retorna:
     *     [
     *         {
     *             "id": 6, ( este es el id de favorito)
     *             "producto_id": 6,
     *             "app_user_id": 897,
     *             "titulo": "shorts caseros",
     *             "publicado": "Publicado",
     *             "estado_usado": 1,
     *             "usado": "Usado",
     *             "condicion_uso": 2,
     *             "descripcion": "esta es una descirpcion de un producto de otro producto",
     *             "short_descripcion": "descripcion corta nel",
     *             "precio": "0.00",
     *             "precio_charlable": 0,
     *             "vistas": 0,
     *             "estado_vendido": 0,
     *             "vendido": "No vendido",
     *             "ciudad": {
     *                 "id": 2,
     *                 "nombre": "Beni",
     *                 "foto": null
     *             },
     *             "categoria": {
     *                 "id": 1,
     *                 "nombre": "Pantalones",
     *                 "foto": "https://cambalachebolivia.com/uploads/categorias/categoria_1190813185931.png"
     *             },
     *             "usuario": {
     *                 "id": 897,
     *                 "email": "juan@juan.com",
     *                 "nombre_completo": "willa willa",
     *                 "ciudad": "Cochabamba",
     *                 "telefono_celular": "7543543",
     *                 "foto": "https://api.cambalachebolivia.com/uploads/usuarios/fotoperfil/usuario_897190826104626.jpg"
     *             },
     *             "fotos":"https://api.cambalachebolivia.com/uploads/productos/producto_6190813020818.jpg",
     *             "fotos": [
     *                 "https://api.cambalachebolivia.com/uploads/productos/producto_6190813020818.jpg"
     *             ]
     *         },
     *     ]
     */
    public function actionFavoritos(){
        $usuario = \Yii::$app->user->identity;
        $favoritos = $usuario->getFavoritos()
            ->all();
        return ArrayHelper::toArray($favoritos, [
            Favorito::className() => [
                'id',
                'producto_id'=>function($model){
                    return $model->producto->id;
                },
                'app_user_id'=>function($model){
                    return $model->producto->app_user_id;
                },
                'titulo'=>function($model){
                    return $model->producto->titulo;
                },
                'publicado'=>function($model){
                    return $model->producto->strPublicado;
                },
                'estado_usado'=>function($model){
                    return $model->producto->usado;
                },
                'usado'=>function($model){
                    return $model->producto->strUsado;
                },
                'condicion_uso'=>function($model){
                    return $model->producto->condicion_uso;
                },
                'descripcion'=>function($model){
                    return $model->producto->descripcion;
                },
                'short_descripcion'=>function($model){
                    return $model->producto->short_descripcion;
                },
                'precio_valor'=>function($model){
                    return $model->producto->precio;
                },
                'precio'=>function($model){
                    return \Yii::$app->formatter->asInteger($model->producto->precio);
                },
                'precio_charlable'=>function($model){
                    return $model->producto->precio_charlable;
                },
                'vistas'=>function($model){
                    return $model->producto->totalVistas;
                },
                'estado_vendido'=>function($model){
                    return $model->producto->vendido;
                },
                'vendido'=>function($model){
                    return $model->producto->strVendido;
                },
                'ciudad'=>function($model){
                    return [
                        'id'=>$model->producto->ciudad->id,
                        'nombre'=>$model->producto->ciudad->nombre,
                        'foto'=>$model->producto->ciudad->strFoto,
                    ];
                },
                'categoria'=>function($model){
                    return [
                        'id'=>$model->producto->categoria->id,
                        'nombre'=>$model->producto->categoria->nombre,
                        'foto'=>$model->producto->categoria->strFoto,
                    ];
                },
                'usuario'=>function($model){
                    return [
                        'id'=>$model->producto->user->id,
                        'email'=>$model->producto->user->email,
                        'nombre_completo'=>$model->producto->user->nombre_completo,
                        'ciudad'=>$model->producto->user->ciudad,
                        'telefono_celular'=>$model->producto->user->telefono_celular,
                        'foto'=>$model->producto->user->strFoto,
                    ];
                },
                'foto'=>function($model){
                    return $model->producto->firstFoto->strFoto;
                },
                'fotos'=>function($model){
                    return ArrayHelper::getColumn($model->producto->fotos,'strFoto');
                }
            ],
        ]);
    }
}