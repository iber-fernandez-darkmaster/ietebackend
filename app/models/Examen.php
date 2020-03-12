<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "examen".
 *
 * @property int $id
 * @property string $materia_id
 * @property string $fecha
 * @property string $titulo
 */
class Examen extends \yii\db\ActiveRecord
{
    public $texto_pregunta;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'examen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['materia_id', 'fecha', 'titulo'], 'required'],
            [['materia_id', 'fecha'], 'safe'],
            [['titulo'], 'string', 'max' => 100],
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
            'materia_id' => 'Materia ID',
            'fecha' => 'Fecha',
            'titulo' => 'Titulo',
            'texto_pregunta' => 'Pregunta',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMateria()
    {
        return $this->hasOne(Materia::className(), ['id' => 'materia_id']);
    }
}
