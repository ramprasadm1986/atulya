<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%cart_items}}".
 *
 * @property int $id
 * @property string $cart_identifire
 * @property int $item_id
 * @property string $item_name
 * @property string|null $variations
 * @property float|null $price
 * @property float|null $sell_price
 * @property int|null $qty
 * @property float|null $total
 * @property float|null $tax
 * @property float|null $tax_details
 * @property float|null $shipping
 * @property float|null $row_total
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Cart $cartIdentifire
 * @property CatalogProduct $item
 */
class CartItem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart_items}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cart_identifire', 'item_id', 'item_name'], 'required'],
            [['item_id', 'qty'], 'integer'],
            [['variations'], 'string'],
            [['price', 'sell_price', 'total', 'tax', 'tax_details', 'shipping', 'row_total'], 'number'],
            [['created_at', 'updated_at'], 'safe'],
            [['cart_identifire', 'item_name'], 'string', 'max' => 255],
            [['cart_identifire'], 'exist', 'skipOnError' => true, 'targetClass' => Cart::className(), 'targetAttribute' => ['cart_identifire' => 'cart_identifire']],
            [['item_id'], 'exist', 'skipOnError' => true, 'targetClass' => CatalogProduct::className(), 'targetAttribute' => ['item_id' => 'id']],
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
            'item_id' => Yii::t('app', 'Item ID'),
            'item_name' => Yii::t('app', 'Item Name'),
            'variations' => Yii::t('app', 'Variations'),
            'price' => Yii::t('app', 'Price'),
            'sell_price' => Yii::t('app', 'Sell Price'),
            'qty' => Yii::t('app', 'Qty'),
            'total' => Yii::t('app', 'Total'),
            'tax' => Yii::t('app', 'Tax'),
            'tax_details' => Yii::t('app', 'Tax Details'),
            'shipping' => Yii::t('app', 'Shipping'),
            'row_total' => Yii::t('app', 'Row Total'),
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
     * Gets query for [[Item]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CatalogProductQuery
     */
    public function getItem()
    {
        return $this->hasOne(CatalogProduct::className(), ['id' => 'item_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CartItemsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CartItemsQuery(get_called_class());
    }
    
    public function calculateRowTotal(){
		
		$CartItemQty=$this->qty;
		$sell_price=$this->sell_price;
		
		$this->total=$CartItemQty*$sell_price;
		$this->row_total=$CartItemQty*$sell_price;
		$this->save();	
		
	}
}
