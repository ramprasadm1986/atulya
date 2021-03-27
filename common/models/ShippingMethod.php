<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%shipping_methods}}".
 *
 * @property int $id
 * @property string $metdhod
 * @property string $name
 * @property float $price
 * @property float $snd_price
 * @property float $freeship_threshold
 * @property int $is_system
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 */
class ShippingMethod extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%shipping_methods}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['method', 'name', 'price', 'snd_price', 'freeship_threshold'], 'required'],
            [['price', 'snd_price', 'freeship_threshold'], 'number'],
            [['is_system', 'status'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['method', 'name'], 'string', 'max' => 255],
            [['method'], 'unique'],
            [['method'], 'match', 'pattern' => '/^[a-z]+$/','message' => 'Metdhod can only contain characters. All are in lower.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'method' => Yii::t('app', 'Method'),
            'name' => Yii::t('app', 'Name'),
            'price' => Yii::t('app', 'Price'),
            'snd_price' => Yii::t('app', '2nd Qty Onward Price'),
            'freeship_threshold' => Yii::t('app', 'Freeship Threshold'),
            'is_system' => Yii::t('app', 'Is System'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ShippingMethodsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ShippingMethodsQuery(get_called_class());
    }
}
