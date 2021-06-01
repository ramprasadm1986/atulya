<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Coupon;

/**
 * CouponSearch represents the model behind the search form of `common\models\Coupon`.
 */
class CouponSearch extends Coupon
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'current_use', 'total_use', 'active', 'public', 'has_condition'], 'integer'],
            [['name', 'code', 'start_on', 'expire_on', 'description', 'filter_by', 'products','categories','discount_type'], 'safe'],
            [['discount'], 'number'],
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
        $query = Coupon::find();

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
            'start_on' => $this->start_on,
            'expire_on' => $this->expire_on,
            'current_use' => $this->current_use,
            'total_use' => $this->total_use,
            'active' => $this->active,
            'public' => $this->public,
            'has_condition' => $this->has_condition,
            'discount' => $this->discount,
            'total_rev' => $this->total_rev,
            'total_dis' => $this->total_dis,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'filter_by', $this->filter_by])
            ->andFilterWhere(['like', 'discount_type', $this->discount_type])
            ->andFilterWhere(['like', 'products', $this->products])
            ->andFilterWhere(['like', 'categories', $this->categories]);

        return $dataProvider;
    }
}
