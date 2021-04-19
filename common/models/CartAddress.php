<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cart_address}}".
 *
 * @property int $id
 * @property string $cart_identifire
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
 * @property Cart $cartIdentifire
 */
class CartAddress extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart_address}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cart_identifire', 'name', 'email','address1','country', 'state',  'zip', 'phone'], 'required'],
            ['email', 'email'],
            [['created_at', 'updated_at'], 'safe'],
            [['address1', 'address2', 'landmark'], 'string'],
            [['cart_identifire', 'name', 'email', 'country', 'state', 'city', 'zip'], 'string', 'max' => 255],
            [['cart_identifire'], 'exist', 'skipOnError' => true, 'targetClass' => Cart::className(), 'targetAttribute' => ['cart_identifire' => 'cart_identifire']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'cart_identifire' => Yii::t('app', 'Cart Identifire'),
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
     * Gets query for [[CartIdentifire]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CartQuery
     */
    public function getCartIdentifire()
    {
        return $this->hasOne(Cart::className(), ['cart_identifire' => 'cart_identifire']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CartAddressQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CartAddressQuery(get_called_class());
    }
}
