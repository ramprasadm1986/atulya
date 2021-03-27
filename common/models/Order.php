<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%orders}}".
 *
 * @property int $id
 * @property string $order_identifire
 * @property int $order_user_type 0->Guest, 1->User
 * @property int|null $user_id
 * @property string|null $user_email
 * @property float|null $order_subtotal_excl_tax
 * @property float|null $discount
 * @property string|null $descout_details
 * @property float|null $tax
 * @property string|null $tax_details
 * @property float|null $shipping
 * @property float|null $order_subtotal_incl_tax
 * @property int $status 0->Still in Cart 1->ConvertedToOrder 2->Cancled
 * @property string $created_at
 * @property string $updated_at
 *
 * @property OrderAddress[] $orderAddresses
 * @property OrderItem[] $orderItems
 */
class Order extends \yii\db\ActiveRecord
{
   
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%orders}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['order_identifire'], 'required'],
            [['order_user_type', 'user_id', 'status'], 'integer'],
            [['order_subtotal_excl_tax', 'discount', 'tax', 'shipping', 'order_total'], 'number'],
            [['descout_details', 'tax_details','shipping_details','order_status','order_tags','payment_details'], 'string'],
            [['created_at', 'updated_at','schannel','tracking','payment_details','payment_method'], 'safe'],
            [['order_identifire', 'user_email','schannel','tracking','payment_method'], 'string', 'max' => 255],
            [['order_status'], 'string', 'max' => 15],
            [['order_identifire'], 'unique'],
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
            'order_user_type' => Yii::t('app', '0->Guest, 1->User'),
            'user_id' => Yii::t('app', 'User ID'),
            'user_email' => Yii::t('app', 'User Email'),
            'order_subtotal_excl_tax' => Yii::t('app', 'Subtotal'),
            'discount' => Yii::t('app', 'Discount'),
            'descout_details' => Yii::t('app', 'Descout Details'),
            'tax' => Yii::t('app', 'Tax'),
            'tax_details' => Yii::t('app', 'Tax Details'),
            'shipping' => Yii::t('app', 'Shipping Amount'),
            'shipping_details' => Yii::t('app', 'Shipping Method'),
            'order_Total' => Yii::t('app', 'Order Total'),
            'status' => Yii::t('app', 'Status'),
            'order_status' => Yii::t('app', 'Order Status'),
            'order_tags' => Yii::t('app', 'Order State'),
            'schannel' => Yii::t('app', 'Ship Channel'),
            'tracking' => Yii::t('app', 'Tracking No'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'payment_method' => Yii::t('app', 'Bank'),
            
        ];
    }

    /**
     * Gets query for [[OrderAddresses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderAddressQuery
     */
    public function getOrderAddresses()
    {
        return $this->hasMany(OrderAddress::className(), ['order_identifire' => 'order_identifire']);
    }

    /**
     * Gets query for [[OrderItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\OrderItemQuery
     */
    public function getOrderItems()
    {
        return $this->hasMany(OrderItem::className(), ['order_identifire' => 'order_identifire']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\OrderQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\OrderQuery(get_called_class());
    }
    
    
    
}
