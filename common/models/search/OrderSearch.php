<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * OrderSearch represents the model behind the search form of `common\models\Order`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'order_user_type', 'user_id', 'status'], 'integer'],
            [['order_identifire', 'user_email', 'descout_details', 'tax_details','shipping_details','order_status','order_tags','schannel','tracking', 'created_at', 'updated_at'], 'safe'],
            [['order_subtotal_excl_tax', 'discount', 'tax', 'shipping', 'order_total'], 'number'],
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
        $query = Order::find()->orderBy(['id' => SORT_DESC]);

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
            'order_user_type' => $this->order_user_type,
            'user_id' => $this->user_id,
            'order_subtotal_excl_tax' => $this->order_subtotal_excl_tax,
            'discount' => $this->discount,
            'tax' => $this->tax,
            'shipping' => $this->shipping,
            'order_total' => $this->order_total,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'order_identifire', $this->order_identifire])
            ->andFilterWhere(['like', 'user_email', $this->user_email])
            ->andFilterWhere(['like', 'descout_details', $this->descout_details])
            ->andFilterWhere(['like', 'tax_details', $this->tax_details])
            ->andFilterWhere(['like', 'shipping_details', $this->shipping_details])
            ->andFilterWhere(['like', 'order_status', $this->order_status])
            ->andFilterWhere(['like', 'order_tags', $this->order_tags])
            ->andFilterWhere(['like', 'schannel', $this->schannel])
            ->andFilterWhere(['like', 'tracking', $this->tracking]);

        return $dataProvider;
    }
}
