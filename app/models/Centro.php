<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "centro".
 *
 * @property int $id
 * @property int $numero_id
 *
 * @property Estudiante[] $estudiantes
 * @property User[] $users
 */
class Centro extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'centro';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['numero_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero_id' => 'Numero ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiantes()
    {
        return $this->hasMany(Estudiante::className(), ['centro_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['centro_id' => 'id']);
    }
}
