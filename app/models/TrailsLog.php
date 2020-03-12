<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "audit_trails_log".
 *
 * @property string $id
 * @property string $description
 * @property string $action
 * @property string $model
 * @property int $id_model
 * @property string $ip
 * @property int $creation_date
 * @property int $user_id
 */
class TrailsLog extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'trails_log';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['creation_date'], 'required'],
            [['id_model', 'creation_date', 'user_id'], 'integer'],
            [['description'], 'string', 'max' => 255],
            [['action'], 'string', 'max' => 20],
            [['model', 'ip'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'description' => 'Description',
            'action' => 'Action',
            'model' => 'Modelo',
            'id_model' => 'Id registro',
            'ip' => 'Ip',
            'creation_date' => 'Fecha',
            'user_id' => 'Usuario',
        ];
    }

    public function getUsuario()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
