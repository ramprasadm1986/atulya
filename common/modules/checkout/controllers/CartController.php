<?php

namespace common\modules\checkout\controllers;

use Yii;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Cart;
use common\models\CartItem;
use common\models\User;


/**
 * PageController implements the CRUD actions for CmsPage model.
 */
class CartController extends Controller
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
    
    
    public function getCartidentifier(){
		$session = Yii::$app->session;
        $session->open();
        if(Yii::$app->session->get('CartIdentifire')=='')
        {
			if(Yii::$app->user->identity !=''){
				$User_Id = Yii::$app->user->identity->id;
				$UserCart = Cart::find()->where(['user_id'=>$User_Id,'status'=>0])->one();
				if($UserCart){
					$CartIdentifire = $UserCart->cart_identifire;
					Yii::$app->session->set('CartIdentifire',$CartIdentifire);	
				}else{
				    $count = Yii::$app->db->createCommand("
                        SELECT `AUTO_INCREMENT`
                        FROM  INFORMATION_SCHEMA.TABLES
                        WHERE TABLE_SCHEMA = DATABASE()
                        AND   TABLE_NAME   = :TableName
                    ")->bindValues([
                        ':TableName' => Cart::getTableSchema()->name,
                    ])->queryScalar();
					$CartIdentifire='CART'.str_pad($count,9,"0",STR_PAD_LEFT);
					Yii::$app->session->set('CartIdentifire',$CartIdentifire);	
                    
                    
				}
			}else{
				$count = Yii::$app->db->createCommand("
                        SELECT `AUTO_INCREMENT`
                        FROM  INFORMATION_SCHEMA.TABLES
                        WHERE TABLE_SCHEMA = DATABASE()
                        AND   TABLE_NAME   = :TableName
                    ")->bindValues([
                        ':TableName' => Cart::getTableSchema()->name,
                    ])->queryScalar();
				$CartIdentifire='CART'.str_pad($count,9,"0",STR_PAD_LEFT);
				Yii::$app->session->set('CartIdentifire',$CartIdentifire);
			}
			
		}else{
			$CartIdentifire=Yii::$app->session->get('CartIdentifire');
		}
		return $CartIdentifire;
	}
    
    
    public function actionAdd(){
		$Cart = new Cart();
		$post = Yii::$app->request->post();
		extract($post);
		$CartIdentifire = $this->getCartidentifier();
		$Cartcheck = Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
		if(!$Cartcheck){
			$Cart->cart_identifire = $CartIdentifire;
			if(isset(Yii::$app->user->identity->id)){
				$Cart->user_id = Yii::$app->user->identity->id;
                $Cart->user_email = Yii::$app->user->identity->email;
			}
			$Cart->save();
			
		}
		$variations=stripcslashes($variations);
		$cartadded_status = $Cart->addItem($CartIdentifire,$item_id,$variations,$qty);
		
		$cart_updatedata = $Cart->getCartitemdetails($CartIdentifire,$item_id,$variations);
		
		$json_result = array();
		$json_result['status'] = $cartadded_status;
		$json_result['cart_updatedata'] = $cart_updatedata;
		$json_result['Headercartdetails'] = $Cart->getHeadercartdetails($CartIdentifire);
        $json_result['CartItems'] = $Cart->getCartAllItems($CartIdentifire);
		
		//return json_encode($json_result);
		return $this->asJson($json_result);
	}
    
    public function actionRemoveItem(){
		
		$post = Yii::$app->request->post();
		$cartitemdetail = array();
		extract($post);
		$Cart_obj = new Cart();
		$CartIdentifire = $this->getCartidentifier();
		$Cart=Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
        $variations=stripcslashes($variations);
		$status = $Cart->removeItem($CartIdentifire,$item_id,$variations);			
		$updatecart=Cart::find()->where(['cart_identifire'=>$CartIdentifire])->one();
		if($updatecart){
			$cartitemdetail['cart_subtotal_excl_tax'] = $updatecart->cart_subtotal_excl_tax;
			$cartitemdetail['cart_total'] = $updatecart->cart_total;
		}else{
			$cartitemdetail['cart_subtotal_excl_tax'] = 0;
			$cartitemdetail['cart_total'] = 0;
		}
		$json_result = array();
		$json_result['status'] = $status;
		$json_result['cart_updatedata'] = $cartitemdetail;
		$json_result['Headercartdetails'] = $Cart_obj->getHeadercartdetails($CartIdentifire);
        $json_result['CartItems'] = $Cart_obj->getCartAllItems($CartIdentifire);
		return $this->asJson($json_result);
	}
    
    
    public function actionUpdatequantity(){
		$post = Yii::$app->request->post();
		$Cart_obj = new Cart();
		extract($post);
		$CartIdentifire = $this->getCartidentifier();
		$Cart=Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
		$qty = -1;
        $variations=stripcslashes($variations);
		$status = $Cart->updateItem($CartIdentifire,$item_id,$qty,$variations);
			
		$checkcart=Cart::find()->where(['cart_identifire'=>$CartIdentifire,'status'=>0])->one();
		
		$cart_updatedata = $Cart->getCartitemdetails($CartIdentifire,$item_id,$variations);
		$json_result = array();
		$json_result['status'] = $status;
		$json_result['CheckItem'] = $Cart_obj->getCheckitem($CartIdentifire,$item_id,$variations);
		$json_result['cart_updatedata'] = $cart_updatedata;
		$json_result['Headercartdetails'] = $Cart_obj->getHeadercartdetails($CartIdentifire);
		$json_result['CartItems'] = $Cart_obj->getCartAllItems($CartIdentifire);
		
		
		return $this->asJson($json_result);
	}
    
    /**
     * Lists all CmsPage models.
     * @return mixed
     */
    public function actionIndex(){
		$CartIdentifire = $this->getCartidentifier();
        $Cart = new Cart();
		$CartItemmodel=$Cart->getCartAllItems($CartIdentifire);
		return $this->render('cart',['CartItem'=>$CartItemmodel]);
	}

   

    
   
}
