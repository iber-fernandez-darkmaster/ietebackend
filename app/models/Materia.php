<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materia".
 *
 * @property int $id
 * @property string $nombre
 * @property string $estado
 */
class Materia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materia';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'estado'], 'required'],
            [['nombre'], 'string', 'max' => 100],
            [['estado'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombre' => 'Nombre',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamenes()
    {
        return $this->hasMany(Examen::className(), ['materia_id' => 'id']);
    }
    public function getHabilitaciones()
    {
        return $this->hasMany(Habilitaciones::className(), ['materia_id' => 'id']);
    }
}
