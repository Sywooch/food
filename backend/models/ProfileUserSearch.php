<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ProfileUser;

/**
 * ProfileUserSearch represents the model behind the search form about `common\models\ProfileUser`.
 */
class ProfileUserSearch extends ProfileUser
{
    public $role;
    public $username;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['user_id', 'integer'],
            ['role', 'integer'],
            ['username', 'string'],
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
        $query = ProfileUser::find();

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
            // 'username' => $this->username,
        ]);

        $query->andFilterWhere(['like', 'role', $this->role])
            ->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}
