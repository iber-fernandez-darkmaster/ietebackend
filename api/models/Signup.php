<?php
namespace app\models;

use Yii;
use app\models\User;
use yii\base\Model;

/**
 * Signup form
 */
class Signup extends Model
{
    public $nombre_completo;
    public $email;
    public $password;
    public $celular;
    public $fecha_nacimiento;
    public $telefono;
    public $ci;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['nombre_completo', 'trim'],
            ['nombre_completo', 'required'],
          /*['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255], */

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\app\models\User', 'message' => 'Esta dirección de correo electrónico ya ha sido tomada.'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            // ['celular', 'required'],

            // ['ci', 'required'],
        ];
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->nombre_completo = $this->nombre_completo;
        $user->email = $this->email;
        $user->celular = $this->celular;
        $user->ci = $this->ci;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        
        return $user->save() ? $user : null;
    }
}
