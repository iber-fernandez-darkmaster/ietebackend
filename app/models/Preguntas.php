<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "preguntas".
 *
 * @property int $id
 * @property int $examen_id
 * @property string $pregunta
 * @property int $respuesta_correcta
 */
class Preguntas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'preguntas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['examen_id', 'pregunta', 'respuesta_correcta'], 'required'],
            [['examen_id', 'respuesta_correcta'], 'integer'],
            [['pregunta'], 'string', 'max' => 300],
            [['examen_id'], 'exist', 'skipOnError' => true, 'targetClass' => Examen::className(), 'targetAttribute' => ['examen_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'examen_id' => 'Examen ID',
            'pregunta' => 'Pregunta',
            'respuesta_correcta' => 'Respuesta Correcta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getExamen()
    {
        return $this->hasOne(Examen::className(), ['id' => 'examen_id']);
    }
}
