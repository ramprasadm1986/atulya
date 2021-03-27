<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%catalog_product_attributes_options}}".
 *
 * @property int $id
 * @property int $attribute_id
 * @property string $name
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CatalogProductAttribute $optionattribute
 */
class CatalogProductAttributesOption extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%catalog_product_attributes_options}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['attribute_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['attribute_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogProductAttribute::className(), 'targetAttribute' => ['attribute_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'attribute_id' => Yii::t('app', 'Attribute ID'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[Attribute0]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CatalogProductAttributeQuery
     */
    public function getOptionAttribute()
    {
        return $this->hasOne(CatalogProductAttribute::className(), ['id' => 'attribute_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CatalogProductAttributesOptionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CatalogProductAttributesOptionsQuery(get_called_class());
    }
}
