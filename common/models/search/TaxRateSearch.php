<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\TaxRate;

/**
 * TaxRateSearch represents the model behind the search form of `common\models\TaxRate`.
 */
class TaxRateSearch extends TaxRate
{
    /**
     * {@inheritdoc}
     */
   
    
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['tax_identifire','tax_name', 'country', 'state', 'city', 'zip', 'created_at', 'updated_at'], 'safe'],
            [['rate'], 'number'],
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
    public function search($params)
    {
        $query = TaxRate::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'rate' => $this->rate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'tax_identifire', $this->tax_identifire])
            ->andFilterWhere(['like', 'tax_name', $this->tax_name])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zip', $this->zip]);

        return $dataProvider;
    }
}
