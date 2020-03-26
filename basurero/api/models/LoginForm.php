<?php
namespace app\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class LoginForm extends Model
{
    //Se va a cambiar el login del usuario. Ahora se va a logear con su correo
    public $email;
    public $password;
    public $celular;
    public $rememberMe = true;

    private $_user;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['password'], 'required'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
            ['celular', 'integer'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect email or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        }
        
        return false;
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return bool whether the user is logged in successfully
     */
    public function loginFacebook()
    {
        if ($this->validate()) {
            // get with email
            $user = $this->getUser();
            if ( $user  != null ){
                // return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                return $user;
            }
            // get with phone
            $user = $this->getUserPhone();
            if ( $user != null ){
                return $user;
                // return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
            }
        }
        return false;
    }
    public function loginGmail()
    {
        if ($this->validate()) {
            // get with email
            $user = $this->getUser();
            if ( $user  != null ){
                // return Yii::$app->user->login($user, $this->rememberMe ? 3600 * 24 * 30 : 0);
                return $user;
            }
        }        
        return false;
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }

    protected function getUserPhone()
    {
        if ($this->_user === null) {
            $this->_user = User::findByPhone($this->celular);
        }

        return $this->_user;
    }

   /*  protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->username);
        }

        return $this->_user;
    } */

    /* protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    } */
}
