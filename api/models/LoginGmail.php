<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;

/**
 * Login form
 */
class LoginGmail extends Model
{
    const TIPO = 3;
    /**
     * @var string variable ci que interpreta a el uername de un user
     */
    public $email;


    /**
     * @var boolean variable para recordar a un usuario
     */
    public $tipo_login;
    
    /**
     * @var boolean|User Variable para obtener el usuario que es autentificado o false
     */
    private $_user = false;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // ci and password are both required
            [['email'], 'required'],
            // rememberMe must be a boolean value
            ['email', 'email'],
            //['tipo_login', 'integer'],
        ];
    }

    /**
     * Logs in a user using the provided email and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return $this->getUser();
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false && $this->tipo_login == self::TIPO) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
}
