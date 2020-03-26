<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "informacion".
 *
 * @property int $id
 * @property string $foto
 * @property string $idestudiante
 * @property string $idcentro
 * @property string $idexamen
 */
class Informacion extends \yii\db\ActiveRecord
{
    const Path = '/informacion/';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'informacion';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['foto', 'idestudiante', 'idcentro', 'idexamen'], 'required'],
            [['foto'], 'string', 'max' => 100],
            [['idestudiante'], 'string', 'min'=> 7],
            [['idcentro'], 'string', 'min'=> 4],
            [['idexamen'], 'string', 'min'=> 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'foto' => 'Foto',
            'idestudiante' => 'Idestudiante',
            'idcentro' => 'Idcentro',
            'idexamen' => 'Idexamen',
        ];
    }
    public function getstrfoto()
    {
        if($this->foto)
        {
            return Yii::getAlias('@imageUrl'). '/' .self::Path.$this->foto;
        }
        return null;
    }
}