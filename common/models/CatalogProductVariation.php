<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_product_variation}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string|null $combination
 * @property string|null $image
 * @property float|null $price
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CatalogProduct $product
 */
class CatalogProductVariation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog_product_variation}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id'], 'required'],
            [['product_id'], 'integer'],
            [['combination', 'image'], 'string'],
            [['price'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogProduct::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'product_id' => Yii::t('app', 'Product ID'),
            'combination' => Yii::t('app', 'Combination'),
            'image' => Yii::t('app', 'Image'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CatalogProductQuery
     */
    public function getProduct()
    {
        return $this->hasOne(CatalogProduct::className(), ['id' => 'product_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CatalogProductVariationQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CatalogProductVariationQuery(get_called_class());
    }
}
