<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%order_address}}".
 *
 * @property int $id
 * @property string $order_identifire
 * @property string $name
 * @property string $email
 * @property string $country
 * @property string $state
 * @property string $city
 * @property string $zip
 * @property string $phone
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Order $orderIdentifire
 */
class OrderAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%order_address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_identifire', 'name', 'email','address1', 'country', 'state',  'zip', 'phone'], 'required'],
            [['created_at', 'updated_at'], 'safe'],
            [['address1', 'address2', 'landmark'], 'string'],
            [['order_identifire', 'name', 'email', 'country', 'state', 'city', 'zip', 'phone'], 'string', 'max' => 255],
            [['order_identifire'], 'exist', 'skipOnError' => true, 'targetClass' => Order::className(), 'targetAttribute' => ['order_identifire' => 'order_identifire']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'order_identifire' => Yii::t('app', 'Order Identifire'),
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'country' => Yii::t('app', 'Country'),
            'state' => Yii::t('app', 'State'),
            'city' => Yii::t('app', 'City'),
            'zip' => Yii::t('app', 'Zip'),
            'phone' => Yii::t('app', 'Phone'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * Gets query for [[OrderIdentifire]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderQuery
     */
    public function getOrderIdentifire()
    {
        return $this->hasOne(Order::className(), ['order_identifire' => 'order_identifire']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderAddressQuery(get_called_class());
    }
}
