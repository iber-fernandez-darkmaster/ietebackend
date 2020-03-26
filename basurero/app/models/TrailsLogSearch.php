<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\TrailsLog;

/**
 * TrailsLogSearch represents the model behind the search form of `app\models\TrailsLog`.
 */
class TrailsLogSearch extends TrailsLog
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'description', 'action', 'user_id', 'model', 'ip'], 'safe'],
            [['id_model', 'creation_date'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = TrailsLog::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
            'pagination' => [
                'defaultPageSize' => 5,
            ],
        ]);

        $this->load($params);
        
        $query->joinWith('usuario');

        $dataProvider->sort->attributes['user_id'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        if( trim($this->creation_date) != ''){
            $query->andFilterWhere(['>', 'trails_log.creation_date', strtotime($this->creation_date.' 00:00:00')])
            ->andFilterWhere(['<', 'trails_log.creation_date', strtotime($this->creation_date.' 23:59:59')]);
        }
        
        $query->andFilterWhere(['like', 'trails_log.description', $this->description])
            ->andFilterWhere(['like', 'trails_log.action', $this->action])
            ->andFilterWhere(['like', 'trails_log.model', $this->model])
            ->andFilterWhere(['like', 'user.username', $this->user_id])
            ->andFilterWhere(['like', 'trails_log.ip', $this->ip])->all();
        return $dataProvider;



    }
}
