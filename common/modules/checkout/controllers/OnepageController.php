<?php

namespace common\modules\checkout\controllers;

use Yii;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

use common\models\User;

use common\models\Cart;
use common\models\CartItem;
use common\models\CartAddress;

use common\models\ShippingMethod;

use common\models\Order;
use common\models\OrderItem;
use common\models\OrderAddress;
use common\models\Coupon;

use yii\web\HttpException;

use ramprasadm1986\paypal\PayPalPayment;
use ramprasadm1986\paynimo\TransactionRequestBean;
use ramprasadm1986\paynimo\TransactionResponseBean;


 


/**
 * PageController implements the CRUD actions for CmsPage model.
 */
class OnepageController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        
                        'allow' => (Yii::$app->user->isGuest || Yii::$app->user->identity instanceof User),
                       
                    ],
                   
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    public function beforeAction($action)
    {            
        if ($action->id == 'paynimoreturn') {
            $this->enableCsrfValidation = false;
        }
    
        return parent::beforeAction($action);
    }
    
    public function getCartidentifier(){
		$session = Yii::$app->session;
        $session->open();
       
        $CartIdentifire=Yii::$app->session->get('CartIdentifire');
		
		return $CartIdentifire;
	}
    public function getOrderidentifire(){
        $session = Yii::$app->session;
        $session->open();
       
        $OrderIdentifire=Yii::$app->session->get('OrderIdentifire');
		
        if($OrderIdentifire=="" && $OrderIdentifire===null){
            $count = Yii::$app->db->createCommand("
                SELECT `AUTO_INCREMENT`
                FROM  INFORMATION_SCHEMA.TABLES
                WHERE TABLE_SCHEMA = DATABASE()
                AND   TABLE_NAME   = :TableName
            ")->bindValues([
                ':TableName' => Order::getTableSchema()->name,
            ])->queryScalar();
            
            $OrderIdentifire='ORDER'.str_pad($count,9,"0",STR_PAD_LEFT);
            Yii::$app->session->set('OrderIdentifire',$OrderIdentifire);
        }
        
		return $OrderIdentifire;
	}
    public function actionReturn(){
        $session = Yii::$app->session;
        $session->open();
       
        $OrderIdentifire=Yii::$app->session->get('OrderIdentifire');
        $CartIdentifire=Yii::$app->session->get('CartIdentifire');
        $PayPalId=Yii::$app->session->get('PayPalId');
       
        if($PayPalId!="" && $OrderIdentifire!="" && $CartIdentifire!=""){
            
          
           $response= Yii::$app->PayPalPayment->doCapture($PayPalId);
           
           if($response->statusCode==201){
                $Order = Order::find()->where(['order_identifire'=>$OrderIdentifire,'status'=>0])->one();
                $Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
                
                $Order->status=1;
                $Order->order_status="placed";
                $tags=json_decode( $Order->order_tags,true);
                $tags["placed"]=date("Y-m-d H:i:s");
                $Order->order_tags=json_encode($tags);
                $Order->save();
                $Cart->status=1;
                $Cart->save();
                
                Yii::$app->session->remove('CartIdentifire');
                Yii::$app->session->remove('PayPalId');
                return $this->redirect(['/checkout/success']); 
           }
            else{
                Yii::$app->session->remove('OrderIdentifire');
                Yii::$app->session->remove('PayPalId');
                return $this->redirect(['/cart']);
            }
            
          
          
            
        }
        else{
                     
       
            $OrderIdentifire=Yii::$app->session->get('OrderIdentifire');
            $CartIdentifire=Yii::$app->session->get('CartIdentifire');
            $PayPalId=Yii::$app->session->get('PayPalId');
            Yii::$app->session->remove('CartIdentifire');
            Yii::$app->session->remove('OrderIdentifire');
            Yii::$app->session->remove('PayPalId');
            return $this->redirect(['/cart']);
            
          
        }
        
    }
    public function actionCancel(){
        
            $session = Yii::$app->session;
            $session->open();
       
            $OrderIdentifire=Yii::$app->session->get('OrderIdentifire');
            $CartIdentifire=Yii::$app->session->get('CartIdentifire');
            $PayPalId=Yii::$app->session->get('PayPalId');
            Yii::$app->session->remove('CartIdentifire');
            Yii::$app->session->remove('OrderIdentifire');
            Yii::$app->session->remove('PayPalId');
            return $this->redirect(['/cart']);
        
    }
    public function setCartSymmery(){
        
        
        $CartIdentifire = $this->getCartidentifier();
		$Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
       
        if($Cart)
        {
            
            $Cart->cart_total=round(($Cart->cart_subtotal_excl_tax-$Cart->discount)+$Cart->tax+$Cart->shipping,2);
            $Cart->save();
        }
        
    }
    public function actionSetcoupon(){
        $json_result = array();
        if(!Yii::$app->hasModule('promo'))
        {
           $json_result['status'] = false; 
           return $this->asJson($json_result);  
        }
        
        
        $post = Yii::$app->request->post();
		extract($post);
        $this->setCartSymmery();
        $CartIdentifire = $this->getCartidentifier();
		$Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
        $couponInfo=Yii::$app->getModule('promo')->validateCouponCode($coupon);
        
        if($isRemove=='true' && $Cart){
                $Cart->discount=0;
                $Cart->descout_details="";
                $Cart->save();
                $this->setCartSymmery();
                $Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
                $json_result['msg'] = "Coupon Removed";
                $json_result['cart_data'] = ['tax'=>$Cart->tax,'tax_details'=>$Cart->tax_details,'discount'=>$Cart->discount,'cart_total'=>$Cart->cart_total];
                $json_result['cupon_status'] = 'false';
                $json_result['status'] = true;
            
        }else if($couponInfo && $Cart && $isRemove=='false'){
            if(!$couponInfo->public && Yii::$app->user->isGuest){
                
                $json_result['msg'] = "This promo code is not ment for 'Guest User'. Login to avail the promo code."; 
                $json_result['status'] = false; 
                return $this->asJson($json_result);
            }
            if(!Yii::$app->user->isGuest &&  $couponInfo->total_use>0){
                
                 $used=Cart::find()->where(['descout_details'=>$coupon,'user_email'=>Yii::$app->user->identity->email,'status'=>1])->count();
                 if($used>=$couponInfo->total_use){
                    
                    $json_result['msg'] = "Reached maximum use of Promo Code"; 
                    $json_result['status'] = false; 
                    return $this->asJson($json_result);
                     
                 }
                
            }
            if($couponInfo->has_condition){
                
                	if($couponInfo->filter_by=="product"){
                        $products=explode(",",$couponInfo->products);
                        $products=array_map('trim', $products);
                        $inProduct=false;
                        foreach($Cart->cartItems as $item){
                            
                            if (in_array($item->item->sku, $products))
                                $inProduct=true;
                        }
                        if(!$inProduct){
                    
                            $json_result['msg'] = "Promo Code not applicable for the cart items"; 
                            $json_result['status'] = false; 
                            return $this->asJson($json_result);
                             
                         }
                        
                    }
                    else if($couponInfo->filter_by=="categories"){
                        $Categories=explode(",",$couponInfo->categories);
                        $Categories=array_map('trim', $Categories);
                        $inCategory=false;
                        
                        foreach($Cart->cartItems as $item){
                            $intersect=[];
                            $itemCategory=explode(",",$item->item->categories);
                            $intersect=array_intersect($itemCategory, $Categories);
                            if (count($intersect))
                                $inCategory=true;
                        }
                        if(!$inCategory){
                    
                            $json_result['msg'] = "Promo Code not applicable for the cart items"; 
                            $json_result['status'] = false; 
                            return $this->asJson($json_result);
                             
                         }
                        
                    }
            }
            
            if($couponInfo->discount_type=="flat"){
                $discount=$discount= number_format((float)$couponInfo->discount, 2);
                $discount= $discount-0;                
                $Cart->discount=$discount;
                $Cart->descout_details=$couponInfo->code;
                
                $Cart->save();
                $this->setCartSymmery();
                $Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
                $json_result['msg'] = "Coupon Applied";
                $json_result['cart_data'] = ['shipping'=>$Cart->shipping,'discount'=>$Cart->discount,'tax'=>$Cart->tax,'tax_details'=>$Cart->tax_details,'cart_total'=>$Cart->cart_total];
                $json_result['cupon_status'] = 'true';
                $json_result['status'] = true;
            }
            if($couponInfo->discount_type=="percent"){
                $discount= (($Cart->cart_subtotal_excl_tax/100)*$couponInfo->discount);
               
                           
                $Cart->discount=$discount;
                $Cart->descout_details=$couponInfo->code;
                
                $Cart->save();
                $this->setCartSymmery();
                $Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
                $json_result['msg'] = "Coupon Applied";
                $json_result['cart_data'] = ['shipping'=>$Cart->shipping,'discount'=>$Cart->discount,'tax'=>$Cart->tax,'tax_details'=>$Cart->tax_details,'cart_total'=>$Cart->cart_total];
                $json_result['cupon_status'] = 'true';
                $json_result['status'] = true;
            }
            
            
            
        }
        else{
            $json_result['msg'] = "Invalid promo code 'or' code has been expired."; 
            $json_result['status'] = false; 
        }
        
        return $this->asJson($json_result);
    }
    
    public function actionSetshipping(){
        
		$post = Yii::$app->request->post();
		extract($post);
		$CartIdentifire = $this->getCartidentifier();
		$Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
        $ShippingMethod=ShippingMethod::find()->where(['method'=>$method,'status'=>1])->one();
		if($Cart && $ShippingMethod){
            
            $shipping=0;
            if($Cart->cart_subtotal_excl_tax>=$ShippingMethod->freeship_threshold)
            {
                
                $Cart->shipping=$shipping;
                $Cart->shipping_details=$ShippingMethod->name."( Free )";
                $Cart->save();
            }
            else{
               
                
                foreach($Cart->cartItems as $item){
                    
                    $shipping=$shipping+(($item->qty-1)*$ShippingMethod->snd_price)+$ShippingMethod->price;
                    
                
                }
                $Cart->shipping=$shipping;
                $Cart->shipping_details=$ShippingMethod->name;
                $Cart->cart_total=$Cart->cart_subtotal_excl_tax+$Cart->shipping;
                $Cart->save();
            }
                
            $json_result = array();
            $json_result['status'] = true;
            $json_result['cart_data'] = ['shipping'=>$Cart->shipping,'cart_total'=>$Cart->cart_total];
           
		
		
            return $this->asJson($json_result);    
            
            
            
            
            
            
           
            
            
        }
            $json_result = array();
            $json_result['status'] = false;
            
           
		
		
            return $this->asJson($json_result);  
        
        
        
    }
    
    
    
    public function actionPaynimoreturn(){
        
        $response = Yii::$app->request->post();
     
        
    if(is_array($response)){
        $str = $response['msg'];
    }else if(is_string($response) && strstr($response, 'msg=')){
        $outputStr = str_replace('msg=', '', $response);
        $outputArr = explode('&', $outputStr);
        $str = $outputArr[0];
    }else {
        $str = $response;
    }

    $transactionResponseBean = new TransactionResponseBean();

    $transactionResponseBean->setResponsePayload($str);
    $transactionResponseBean->key = Yii::getAlias('@MerchantKey');
    $transactionResponseBean->iv = Yii::getAlias('@MerchantIV');
    $response = $transactionResponseBean->getResponsePayload();
    
    
    
     try{
       $str=str_replace("|",'","',$response);
       $str=str_replace("=",'":"',$str);
       
       $str=json_decode('{"'.$str.'"}');
       
     
       
        if(strtolower($str->txn_msg)=="success"){
           
          
            $order_identi=explode("-",$str->clnt_txn_ref);
            $CartIdentifire=$order_identi[1];
            $OrderIdentifire=$order_identi[0];
           
                $Order = Order::find()->where(['order_identifire'=>$OrderIdentifire,'status'=>0])->one();
                $Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
                
                $Order->status=1;
                $Order->order_status="placed";
                $tags=json_decode( $Order->order_tags,true);
                $tags["placed"]=date("Y-m-d H:i:s");
                $Order->order_tags=json_encode($tags);
                $Order->save();
                $Cart->status=1;
                $Cart->save();
                $coupon=Coupon::find()->where(['code'=>strtoupper($Order->descout_details),'active'=>1])->one();
                
                if($coupon){
                    
                  $coupon->current_use=$coupon->current_use+1;
                  $coupon->total_rev=$coupon->total_rev+$Order->order_total;             
                  $coupon->total_dis=$coupon->total_dis+$Order->discount;             
                  $coupon->save(); 
                }
                
                
                
                Yii::$app->session->remove('CartIdentifire');
                
                return $this->redirect(['/checkout/success']); 
        }
        else if(strtolower($str->txn_msg)=="aborted"){
               
            $order_identi=explode("-",$str->clnt_txn_ref);
            $CartIdentifire=$order_identi[1];
            $OrderIdentifire=$order_identi[0];
           
                $Order = Order::find()->where(['order_identifire'=>$OrderIdentifire,'status'=>0])->one();
                $Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
                
                $Order->status=2;
                $Order->order_status="cancled";
                $tags=json_decode( $Order->order_tags,true);
                $tags["cancled"]=date("Y-m-d H:i:s");
                $Order->order_tags=json_encode($tags);
                $Order->save();
                $Cart->status=0;
                $Cart->save();              
                Yii::$app->session->remove('OrderIdentifire');
                Yii::$app->session->setFlash('error', 'Order Payment Aborted By User');
               return $this->redirect(['/cart']);
               
        }
        else{
                Yii::$app->session->remove('OrderIdentifire');
                
                return $this->redirect(['/cart']);
        }
     }
     catch(Exception $e) {
         
                Yii::$app->session->remove('OrderIdentifire');
               
                return $this->redirect(['/cart']);
                
                
     }
      
    }
    
    public function actionIndex(){
        
        $this->setCartSymmery();
        $CartIdentifier = $this->getCartidentifier();
		$Cart = Cart::find()->where(['cart_identifire'=>$CartIdentifier,'status'=>0])->one();
       
       
        if(Yii::$app->request->post()){
            
             $model =new CartAddress();
            
            if ($model->load(Yii::$app->request->post())) {  
                $model->cart_identifire=$Cart->cart_identifire;
                $model->save();
                $Cart->user_email= $model->email;
               
               
                 $session = Yii::$app->session;
                 $session->open();
       
                $OrderIdentifire=Yii::$app->session->get('OrderIdentifire');
                
                if($OrderIdentifire=='' || $OrderIdentifire===null){
                    $OrderIdentifire=$this->getOrderidentifire();
                    $order= new Order();
                    
                    $order->order_identifire=$OrderIdentifire;
                    $order->user_email=$Cart->user_email;
                    $order->user_id=$Cart->user_id;
                    $order->order_subtotal_excl_tax=$Cart->cart_subtotal_excl_tax;
                    $order->discount=$Cart->discount;
                    $order->descout_details=$Cart->descout_details;
                    $order->tax=$Cart->tax;
                    $order->tax_details=$Cart->tax_details;
                    $order->shipping=$Cart->shipping;
                    $order->shipping_details=$Cart->shipping_details;
                    $order->order_total=$Cart->cart_total;
                    $order->status=0;
                   
                    $order->order_status="pending";                
                    $order->order_tags=json_encode(['pending'=>date("Y-m-d H:i:s")]);           
                    $order->save();
                    
                    
                    $orderAddress= new OrderAddress();
                    
                    $orderAddress->order_identifire=$order->order_identifire;
                    $orderAddress->name=$model->name;
                    $orderAddress->email=$model->email;
                    $orderAddress->address1=$model->address1;
                    $orderAddress->address2=$model->address2;
                    $orderAddress->landmark=$model->landmark;
                    $orderAddress->country=$model->country;
                    $orderAddress->state=$model->state;
                    $orderAddress->city=$model->city;
                    $orderAddress->zip=$model->zip;
                    $orderAddress->phone=$model->phone;
                    
                    $orderAddress->save();
                
                    foreach($Cart->cartItems as $cart_item){
                        
                        $OrderItem= new OrderItem();
                        $OrderItem->order_identifire=$order->order_identifire;
                        $OrderItem->item_id=$cart_item->item_id;
                        $OrderItem->item_name=$cart_item->item_name;
                        $OrderItem->variations=$cart_item->variations;
                        $OrderItem->price=$cart_item->price;
                        $OrderItem->sell_price=$cart_item->sell_price;
                        $OrderItem->qty=$cart_item->qty;
                        $OrderItem->total=$cart_item->total;
                        $OrderItem->tax=$cart_item->tax;
                        $OrderItem->tax_details=$cart_item->tax_details;
                        $OrderItem->shipping=$cart_item->shipping;
                        $OrderItem->row_total=$cart_item->row_total;                   
                        $OrderItem->save();
                        
                    }
                
                }
                else
                    $order = Order::find()->where(['order_identifire'=>$OrderIdentifire,'status'=>0])->one();
                   
                    
                    
               
                
                $transactionRequestBean = new TransactionRequestBean();
                $transactionRequestBean->merchantCode = Yii::getAlias('@MerchantCode');
                
    $transactionRequestBean->ITC = "email:".$model->email;

    $transactionRequestBean->requestType = "T";
    $transactionRequestBean->merchantTxnRefNumber =$order->order_identifire."-".$Cart->cart_identifire;
    $transactionRequestBean->amount = $order->order_total;
    $transactionRequestBean->currencyCode = Yii::getAlias('@currencyCode');
    $transactionRequestBean->returnURL = Yii::getAlias('@frontendUrl').'/checkout/onepage/paynimoreturn';
    $transactionRequestBean->s2SReturnURL = "https://tpslvksrv6046/LoginModule/Test.jsp";
    $transactionRequestBean->shoppingCartDetails = "FIRST_". $order->order_total . '_0.0';
    $transactionRequestBean->txnDate = date('d-m-Y');;
   
    $transactionRequestBean->TPSLTxnID = $order->order_identifire;
    
    $transactionRequestBean->key = Yii::getAlias('@MerchantKey');
    $transactionRequestBean->iv = Yii::getAlias('@MerchantIV');
    $transactionRequestBean->webServiceLocator = "https://www.tpsl-india.in/PaymentGateway/TransactionDetailsNew.wsdl";
    
     //$transactionRequestBean->webServiceLocator = "https://payments.paynimo.com/PaynimoProxy/services/TransactionLiveDetails";
    
   
    $transactionRequestBean->customerName=$model->name;
    $transactionRequestBean->mobileNumber=$model->phone;
    $transactionRequestBean->timeOut = 30;
    $responseDetails = $transactionRequestBean->getTransactionToken();
    $responseDetails = (array)$responseDetails;
    $response = $responseDetails[0];
            
            
            $redirect=true;
            if(is_string($response) && preg_match('/^msg=/',$response)){
        $outputStr = str_replace('msg=', '', $response);
        $outputArr = explode('&', $outputStr);
        $str = $outputArr[0];

        $transactionResponseBean = new TransactionResponseBean();
        $transactionResponseBean->setResponsePayload($str);
        $transactionResponseBean->setKey(Yii::getAlias('@MerchantKey'));
        $transactionResponseBean->setIv(Yii::getAlias('@MerchantIV'));

        $response = $transactionResponseBean->getResponsePayload();
        $redirect=false;
    }elseif(is_string($response) && preg_match('/^txn_status=/',$response)){
		$redirect=false;
	}
	else if(is_string($response) && preg_match('/^ERROR/',$response)){
	    	$redirect=false;
	}
	    $this->layout = 'blank';
         return $this->render('paynimo', [
                                'redirect' => $redirect,
                                'paynimo'=>$response,
                                'OrderIdentifire'=>$OrderIdentifire,
                                'responseDetails'=>$responseDetails,
                                'transactionRequestBean'=>$transactionRequestBean
                            ]);                  
                
            }
            
            
            
        }
        
        
        if($Cart){
            $Cart->scenario = 'checkout';
			$CartItems = $Cart->cartItems;
			if($CartItems){
				$cartitems = array();
				$cartdetails = array();
				foreach($CartItems as $Cartitemkey=>$Cartitemvalu){
					$cartitems[$Cartitemkey]['item_name'] = $Cartitemvalu->item_name;
					$cartitems[$Cartitemkey]['variations'] = $Cartitemvalu->variations;
					$cartitems[$Cartitemkey]['qty'] = $Cartitemvalu->qty;
					$cartitems[$Cartitemkey]['id'] = $Cartitemvalu->id;
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
            
            if(count($CartItemmodel['CartItems']))
                return $this->render('checkout',['CartAddress' => new CartAddress(),'CartItemmodel'=>$CartItemmodel,'Cart'=>$Cart]);
            else
                return $this->redirect(['/cart']);
                
		}else{
			return $this->redirect(['/cart']);
		}
		
    }
    
    public function actionGetordersession(){
        
      // $session = Yii::$app->session;
     //  $session->open();
        //$OrderIdentifire=$this->getOrderidentifire();
        $OrderIdentifires=Yii::$app->session->get('OrderIdentifire');
        return $this->asJson(['OrderIdentifire'=> $OrderIdentifires]); 
    }
    
    public function actionOrdersessioncheck(){
       
       return $this->render("ordersessioncheck");
    }


}