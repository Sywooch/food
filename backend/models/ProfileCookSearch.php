<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProfileCook;

/**
 * ProfileCookSearch represents the model behind the search form about `common\models\ProfileCook`.
 */
class ProfileCookSearch extends ProfileCook
{

    public $username;
    public $role;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            ['username', 'safe'],
            ['role', 'integer'],
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
        $query = ProfileCook::find();

        $query->joinWith(['user']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['role'] = [
            'asc' => ['user.role' => SORT_ASC],
            'desc' => ['user.role' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['username'] = [
            'asc' => ['user.username' => SORT_ASC],
            'desc' => ['user.username' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'user_id' => $this->user_id,
            // 'costmin' => $this->costmin,
            // 'costfree' => $this->costfree,
            // 'costdelivery' => $this->costdelivery,
            // 'pickup' => $this->pickup,
            // 'workhome' => $this->workhome,
            // 'workevent' => $this->workevent,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'role', $this->role]);

        return $dataProvider;
    }
}
