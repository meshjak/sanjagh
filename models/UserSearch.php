<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * UserSearch represents the model behind the search form of `app\models\User`.
 */
class UserSearch extends User
{
    public $searchstring;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['searchstring'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
    public function search($params, $pageSize = 15, $published = false)
    {
        $query = User::find();

        if ($published === true)
            $query->andFilterHaving(['status' => 1]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'fullname' => $this->searchstring,
            'username' => $this->searchstring,
            'email' => $this->searchstring,
        ]);

        $query->orFilterWhere(['like', 'fullname', $this->searchstring])
            ->orFilterWhere(['like', 'username', $this->searchstring])
            ->orFilterWhere(['like', 'email', $this->searchstring]);

        $this->searchstring = null;
        return $dataProvider;
    }
}
