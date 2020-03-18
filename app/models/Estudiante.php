<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "estudiante".
 *
 * @property int $id
 * @property string $nombre_completo
 * @property string $dni
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property int $centro_id
 * @property string $foto
 * @property int $status
 *
 * @property Centro $centro
 */
class Estudiante extends \yii\db\ActiveRecord
{
    const PATH = '/estudiante/';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'estudiante';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_completo', 'dni', 'auth_key', 'password_hash', 'email', 'centro_id'], 'required'],
            [['centro_id', 'status'], 'integer'],
            [['nombre_completo', 'dni'], 'string', 'max' => 50],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['foto'], 'string', 'max' => 100],
            [['email'], 'unique'],
            [['estado'], 'string'],
            [['centro_id'], 'exist', 'skipOnError' => true, 'targetClass' => Centro::className(), 'targetAttribute' => ['centro_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre_completo' => 'Nombre Completo',
            'dni' => 'Dni',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'centro_id' => 'Centro ID',
            'foto' => 'Foto',
            'status' => 'Status',
            'estado'=>'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCentro()
    {
        return $this->hasOne(Centro::className(), ['id' => 'centro_id']);
    }

    // /**
    //  * @return \yii\db\ActiveQuery
    //  */
    // public function getExamenes(){
    //     return $this->hasMany(Examen::className(), ['estudiante_id' => 'id']);
    // }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamenes(){
        $respuestas = Respuestas::find()
            ->joinWith('pregunta')
            ->where([
                'respuestas.estudiante_id'=>$this->id,
            ])
            ->asArray()
            ->all();
        $preguntas = Preguntas::findAll( array_unique(\yii\helpers\ArrayHelper::getColumn($respuestas, 'pregunta_id')) );
        
        $examenes = Examen::findAll( array_unique(\yii\helpers\ArrayHelper::getColumn($preguntas, 'examen_id')) );
        return $examenes;
    }
}
