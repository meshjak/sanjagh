<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ArticleSearch represents the model behind the search form of `app\models\Article`.
 */
class ArticleSearch extends Article
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
        $query = Article::find();

        if ($published === true)
        {
            $query->andFilterHaving(['status' => 1]);
//            $query->orWhere(['user_id' => Yii::$app->user->id]);
        }

        $query->joinWith('tags', true, 'LEFT JOIN')
            ->groupBy(['id']);



        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'=> ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => $pageSize,
            ]
        ]);

        $this->load($params);
//        var_dump($params);die;
        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'title' => $this->searchstring,
            'name' => $this->searchstring
        ]);

        $query->orFilterWhere(['like', 'title', $this->searchstring])
            ->orFilterWhere(['like', 'name', $this->searchstring]);

        $this->searchstring = '';
        return $dataProvider;
    }
}
