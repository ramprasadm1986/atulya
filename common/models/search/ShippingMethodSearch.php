<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\ShippingMethod;

/**
 * ShippingMethodSearch represents the model behind the search form of `common\models\ShippingMethod`.
 */
class ShippingMethodSearch extends ShippingMethod
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_system', 'status'], 'integer'],
            [['method', 'name', 'created_at', 'updated_at'], 'safe'],
            [['price', 'snd_price', 'freeship_threshold'], 'number'],
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
        $query = ShippingMethod::find();

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
            'price' => $this->price,
            'snd_price' => $this->snd_price,
            'freeship_threshold' => $this->freeship_threshold,
            'is_system' => $this->is_system,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'method', $this->method])
            ->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
