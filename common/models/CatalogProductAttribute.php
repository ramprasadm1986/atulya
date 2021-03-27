<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_product_attributes}}".
 *
 * @property int $id
 * @property int $product_id
 * @property string $name
 * @property string $type
 * @property int $status
 * @property string $created_at
 * @property string $update_at
 *
 * @property CatalogProduct $product
 * @property CatalogProductAttributesOption[] $catalogProductAttributesOptions
 */
class CatalogProductAttribute extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog_product_attributes}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['product_id', 'status'], 'integer'],
            [['created_at', 'update_at'], 'safe'],
            [['name', 'type'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'type' => Yii::t('app', 'Type'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'update_at' => Yii::t('app', 'Update At'),
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
     * Gets query for [[CatalogProductAttributesOptions]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CatalogProductAttributesOptionQuery
     */
    public function getCatalogProductAttributesOptions()
    {
        return $this->hasMany(CatalogProductAttributesOption::className(), ['attribute_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CatalogProductAttributesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CatalogProductAttributesQuery(get_called_class());
    }
}
