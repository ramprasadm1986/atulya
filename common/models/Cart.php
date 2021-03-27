<?php

namespace common\models;

use Yii;
use yii\helpers\Url;
/**
 * This is the model class for table "{{%cart}}".
 *
 * @property int $id
 * @property string $cart_identifire
 * @property int $cart_user_type 0->Guest, 1->User
 * @property int|null $user_id
 * @property string|null $user_email
 * @property float|null $cart_subtotal_excl_tax
 * @property float|null $discount
 * @property string|null $descout_details
 * @property float|null $tax
 * @property string|null $tax_details
 * @property float|null $shipping
 * @property float|null $cart_subtotal_incl_tax
 * @property int $status 0->Still in Cart 1->ConvertedToOrder 2->Cancled
 * @property string $created_at
 * @property string $updated_at
 *
 * @property CartItem[] $cartItems
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%cart}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cart_identifire'], 'required'],
            [['cart_user_type', 'user_id', 'status'], 'integer'],
            [['cart_subtotal_excl_tax', 'discount', 'tax', 'shipping', 'cart_total'], 'number'],
            [['descout_details', 'tax_details','shipping_details'], 'string'],
            [['shipping_details'],'required','on'=>'checkout'],
            [['created_at', 'updated_at'], 'safe'],
            [['cart_identifire', 'user_email'], 'string', 'max' => 255],
            [['cart_identifire'], 'unique'],
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
            'cart_user_type' => Yii::t('app', '0->Guest, 1->User'),
            'user_id' => Yii::t('app', 'User ID'),
            'user_email' => Yii::t('app', 'User Email'),
            'cart_subtotal_excl_tax' => Yii::t('app', 'Cart Subtotal Excl Tax'),
            'discount' => Yii::t('app', 'Discount'),
            'descout_details' => Yii::t('app', 'Descout Details'),
            'tax' => Yii::t('app', 'Tax'),
            'tax_details' => Yii::t('app', 'Tax Details'),
            'shipping' => Yii::t('app', 'Shipping Amount'),
            'shipping_details' => Yii::t('app', 'Shipping Method'),
            'cart_total' => Yii::t('app', 'Cart Total'),
            'status' => Yii::t('app', '0->Still in Cart 1->ConvertedToOrder 2->Cancled'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            
        ];
    }

    /**
     * Gets query for [[CartItems]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CartItemQuery
     */
    public function getCartItems()
    {
        return $this->hasMany(CartItem::className(), ['cart_identifire' => 'cart_identifire']);
    }
    
    /**
     * Gets query for [[CartAddresses]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\CartAddressQuery
     */
    public function getCartAddresses()
    {
        return $this->hasMany(CartAddress::className(), ['order_identifire' => 'order_identifire']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\CartQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\CartQuery(get_called_class());
    }
    
    
    public function addItem($CartIdentifire,$item_id,$variations=null){
		
        if($variations!="")
            $CartItem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id,'variations'=>$variations])->one();
        else
            $CartItem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id])->one();
		if($CartItem){
			$CartItem->qty= $CartItem->qty+1;
		}
		else{
			$Item=Product::find()->where(['id'=>$item_id])->one();
			$CartItem=new CartItem();
			$CartItem->cart_identifire=$CartIdentifire;
			$CartItem->item_id=$Item->id;
			$CartItem->item_name=$Item->name;
            $CartItem->variations=$variations;
			$CartItem->qty=1;
            if($Item->IsVariable() && $variations!=""){
                $CartItem->price=$Item->getCartSalePrice($variations);
                $CartItem->sell_price=$Item->getCartSalePrice($variations);
            }
            else{
                $CartItem->price=$Item->price;
                $CartItem->sell_price=$Item->getCartSalePrice();
            }			
					
		}
		$CartItem->save();
		
		
		
		
		$CartItem->calculateRowTotal();
		$this->calculateTotal($CartIdentifire);
		$status = 1;
		return $status;
		
	}
    
    public function updateItem($CartIdentifire,$item_id,$qty,$variations=null){
		
		if($variations!="")
            $CartItem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id,'variations'=>$variations])->one();
        else
            $CartItem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id])->one();
        
		if($CartItem){
			$CartItem->qty= $CartItem->qty+$qty;
			$CartItem->save();
			$CartItem->calculateRowTotal();
			
			if($CartItem->qty == 0){
			   $CartItem->delete();
			   
		    }
			
		}
		
		$this->calculateTotal($CartIdentifire);
		
		$status = 1;
		return $status;
		
		
	}
	
	public function removeItem($CartIdentifire,$item_id,$variations=null){
		
		
        if($variations!="")
            $CartItem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id,'variations'=>$variations])->one();
        else
            $CartItem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id])->one();
        
		if($CartItem){
		
			$CartItem->delete();	
		}
		$this->calculateTotal($CartIdentifire);
		$status = 1;
		return $status;
	}
    public function getCheckitem($CartIdentifire,$item_id,$variations){
		
        if($variations!="")
                $cartitem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id,'variations'=>$variations])->one();
            else
                $cartitem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id])->one();
		if($cartitem){
			$status = 1;
		}else{
			$status = 0;
		}
		return $status;
	}
    
    
    public function calculateTotal($CartIdentifire){
		$Cart=Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
		if($Cart){
			$CartItems=$Cart->cartItems;
			
			$cart_subtotal_excl_tax=0;
			$cart_total=0;
			foreach($CartItems as $CartItem){
				
				$cart_subtotal_excl_tax=$cart_subtotal_excl_tax+$CartItem->total;
				$cart_total=$cart_total+$CartItem->row_total;
				
			}
			$Cart->cart_subtotal_excl_tax=$cart_subtotal_excl_tax; 		
			$Cart->cart_total=$cart_total; 
			$Cart->save();
			
		}
	}
    
    public function getCartitemdetails($CartIdentifire,$item_id,$variations){
		$Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
		$cartitemdetail = array();
		if($Cart){
			$cartitemdetail['cart_subtotal_excl_tax'] = $Cart->cart_subtotal_excl_tax;
			$cartitemdetail['cart_total'] = $Cart->cart_total;
			$cartitem = CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id])->one();
            if($variations!="")
                $cartitem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id,'variations'=>$variations])->one();
            else
                $cartitem=CartItem::find()->where(['cart_identifire'=>$CartIdentifire,'item_id'=>$item_id])->one();
			if($cartitem){
                $cartitemdetail['name'] = $cartitem->item_name;
                $cartitemdetail['id'] = $cartitem->id;
                $cartitemdetail['image'] = $cartitem->item->base_image;
				$cartitemdetail['qty'] = $cartitem->qty;
				$cartitemdetail['total'] = $cartitem->total;
				$cartitemdetail['row_total'] = $cartitem->row_total;
			}
		}
		
		return $cartitemdetail;
	}
    
    public function getHeadercartdetails($CartIdentifire){
		$Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
		$result = array();
		if($Cart){
			$Totalcartitem = CartItem::find()->where(['cart_identifire'=>$CartIdentifire])->count();
			$Totalamount = $Cart->cart_total;
		}else{
			$Totalcartitem = 0;
			$Totalamount = 0;
		}
		$result['Totalcartitem'] = $Totalcartitem;
		$result['Totalamount'] = $Totalamount;
		return $result;
		
	}
    
    public function getCartAllItems($CartIdentifire){
        
        $Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
		if($Cart){
			$CartItems = $Cart->cartItems;
			if($CartItems){
				$cartitems = array();
				$cartdetails = array();
				foreach($CartItems as $Cartitemkey=>$Cartitemvalu){
					$cartitems[$Cartitemkey]['item_name'] = $Cartitemvalu->item_name;
					$cartitems[$Cartitemkey]['variations'] = $Cartitemvalu->variations;
					$cartitems[$Cartitemkey]['slug'] = $Cartitemvalu->item->slug;
                    $cartitems[$Cartitemkey]['full_url'] = Url::toRoute(['/product/'.$Cartitemvalu->item->slug]);
					$cartitems[$Cartitemkey]['qty'] = $Cartitemvalu->qty;
					$cartitems[$Cartitemkey]['id'] = $Cartitemvalu->item_id;
                    $cartitems[$Cartitemkey]['cart_id'] = $Cartitemvalu->id;
					$cartitems[$Cartitemkey]['price'] = $Cartitemvalu->price;
					$cartitems[$Cartitemkey]['sell_price'] = $Cartitemvalu->sell_price;
					$cartitems[$Cartitemkey]['total'] = $Cartitemvalu->total;
					$cartitems[$Cartitemkey]['row_total'] = $Cartitemvalu->row_total;
                    
					if ($Cartitemvalu->item->base_image !='') {
						$getimage = $Cartitemvalu->item->base_image;
					}else{
						$getimage = Yii::getAlias('@storageUrl')."/default/default_product.png";
					}
					$cartitems[$Cartitemkey]['image'] = $getimage;
				}
				$cartdetails['cart_identifire'] = $Cart->cart_identifire;
				$cartdetails['id'] = $Cart->id;
				$cartdetails['cart_subtotal_excl_tax'] = $Cart->cart_subtotal_excl_tax;
				$cartdetails['cart_total'] = $Cart->cart_total;
				
				$CartItemmodel['CartItems'] = $cartitems;
				$CartItemmodel['CartDetails'] = $cartdetails;
			}else{
				$CartItemmodel['CartItems'] = array();
				$CartItemmodel['CartDetails'] = array();
			}
		}else{
			$CartItemmodel['CartItems'] = array();
			$CartItemmodel['CartDetails'] = array();
		}
        return $CartItemmodel;
    }
}
