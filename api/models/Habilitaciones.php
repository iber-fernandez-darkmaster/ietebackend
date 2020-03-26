<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "habilitaciones".
 *
 * @property int $id
 * @property int $estudiante_id
 * @property int $materia_id
 * @property string $fecha
 * @property string $estado
 *
 * @property Estudiante $estudiante
 * @property Materia $materia
 */
class Habilitaciones extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'habilitaciones';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['estudiante_id', 'materia_id'], 'required'],
            [['estudiante_id', 'materia_id'], 'integer'],
            [['fecha'], 'safe'],
            [['estado'], 'string'],
            [['estudiante_id'], 'exist', 'skipOnError' => true, 'targetClass' => Estudiante::className(), 'targetAttribute' => ['estudiante_id' => 'id']],
            [['materia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Materia::className(), 'targetAttribute' => ['materia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'estudiante_id' => 'Estudiante',
            'materia_id' => 'Materia',
            'fecha' => 'Fecha',
            'estado' => 'Estado',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEstudiante()
    {
        return $this->hasOne(Estudiante::className(), ['id' => 'estudiante_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateria()
    {
        return $this->hasOne(Materia::className(), ['id' => 'materia_id']);
    }
}
