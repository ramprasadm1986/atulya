<?php

namespace common\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\CatalogProduct;

/**
 * CatalogProductSearch represents the model behind the search form of `common\models\CatalogProduct`.
 */
class CatalogProductSearch extends CatalogProduct
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'tax_type_id', 'tax_rule_id', 'is_special_price', 'is_featured', 'is_trending', 'is_bestseller', 'is_new', 'status'], 'integer'],
            [['type', 'name', 'short_description', 'description', 'sku', 'slug', 'meta_title', 'meta_keywords', 'meta_description', 'base_image','size_chart','gallery_images', 'length_class', 'weight_class', 'tax_type', 'tax_class', 'special_price_from', 'special_price_to', 'categories', 'related', 'up_sell', 'cross_sell', 'new_from', 'new_to', 'created_at', 'updated_at'], 'safe'],
            [['length', 'width', 'height', 'weight', 'price', 'special_price'], 'number'],
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
        $query = CatalogProduct::find();

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
            'length' => $this->length,
            'width' => $this->width,
            'height' => $this->height,
            'weight' => $this->weight,
            'tax_type_id' => $this->tax_type_id,
            'tax_rule_id' => $this->tax_rule_id,
            'price' => $this->price,
            'is_special_price' => $this->is_special_price,
            'special_price' => $this->special_price,
            'special_price_from' => $this->special_price_from,
            'special_price_to' => $this->special_price_to,
            'is_featured' => $this->is_featured,
            'is_trending' => $this->is_trending,
            'is_bestseller' => $this->is_bestseller,
            'is_new' => $this->is_new,
            'new_from' => $this->new_from,
            'new_to' => $this->new_to,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'type', $this->type])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_description', $this->short_description])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'sku', $this->sku])
            ->andFilterWhere(['like', 'slug', $this->slug])
            ->andFilterWhere(['like', 'meta_title', $this->meta_title])
            ->andFilterWhere(['like', 'meta_keywords', $this->meta_keywords])
            ->andFilterWhere(['like', 'meta_description', $this->meta_description])
            ->andFilterWhere(['like', 'base_image', $this->base_image])
            ->andFilterWhere(['like', 'gallery_images', $this->gallery_images])
            ->andFilterWhere(['like', 'size_chart', $this->size_chart])
            ->andFilterWhere(['like', 'length_class', $this->length_class])
            ->andFilterWhere(['like', 'weight_class', $this->weight_class])
            ->andFilterWhere(['like', 'tax_type', $this->tax_type])
            ->andFilterWhere(['like', 'tax_class', $this->tax_class])
            ->andFilterWhere(['like', 'categories', $this->categories])
            ->andFilterWhere(['like', 'related', $this->related])
            ->andFilterWhere(['like', 'up_sell', $this->up_sell])
            ->andFilterWhere(['like', 'cross_sell', $this->cross_sell]);

        return $dataProvider;
    }
}
