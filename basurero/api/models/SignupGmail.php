<?php
namespace app\models;

use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class SignupGmail extends Model
{
    // /**
    //  * @var string funciona como username de usuario
    //  */
    // public $username;

    /**
     * @var string email de usaurio
     */
    public $email;
    public $nombre_completo;
    public $telefono_celular;
    public $tipo_login;
    public $player_id;

    /**
     * @var string password del ususario
     */
    public $password;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // ['username', 'filter', 'filter' => 'trim'],
            // ['username', 'required'],
            // ['username', 'unique', 'targetClass' => 'app\models\User', 'message' => 'This username has already been taken.'],
            // ['username', 'string', 'min' => 2, 'max' => 255],

            ['email', 'filter', 'filter' => 'trim'],
            [['email'], 'required'],
            ['email', 'email'],
            //['tipo_login', 'integer'],
            ['email', 'unique', 'targetClass' => 'app\models\User', 'message' => 'El email ya existe.'],

            // ['password', 'required'],
            ['password', 'string'],

            //['player_id', 'string', 'max'=>300],

            // ['retypePassword', 'required'],
            // ['retypePassword', 'compare', 'compareAttribute' => 'password'],
            
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if ($this->validate()) {
            $user = new User();
            $user->nombre_completo = $this->nombre_completo;
            $user->celular = $this->celular;
            $user->email = $this->email;
            $user->setPassword( 'AdminRNOVA123456%2F' );
            $user->generateAuthKey();
            $user->generateAccessToken();
            if ($user->save()) {
                return $user;
            }
        }

        return null;
    }
    

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            // $this->_user = User::findByUsername($this->username);
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
