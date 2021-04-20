<?php
namespace frontend\controllers;

use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use common\models\Order;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        
        return $this->render('index');
    }
	 public function actionCheckout()
    {
        return $this->render('checkout');
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('success', 'You are logged in now.');
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
       
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup(true)) {
            Yii::$app->session->setFlash('success', 'Thank you for registration. Please check your inbox for verification email.');
            return $this->goHome();
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success', 'Your email has been confirmed!');
                return $this->goHome();
            }
        }

        Yii::$app->session->setFlash('error', 'Sorry, we are unable to verify your account with provided token.');
        return $this->goHome();
    }

    /**
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            }
            Yii::$app->session->setFlash('error', 'Sorry, we are unable to resend verification email for the provided email address.');
        }

        return $this->render('resendVerificationEmail', [
            'model' => $model
        ]);
    }
    
    public function actionTrackorder(){
        $data=[];
        $items=[];
        $order=false;
        $model = new \yii\base\DynamicModel(['order_id']);
        $model->addRule(['order_id'], 'required');
        $post=false;
        $order_id=false;
        
        $order_status=[];
        $order_status['pending']=[];
        $order_status['pending']['key']="Payment Processing";
        $order_status['pending']['msg']="Processing payment at gateway or payment pending";
        
        
        $order_status['cancled']=[];
        $order_status['cancled']['key']="User canled the order payment";
        $order_status['cancled']['msg']="User cancled the payment at gateway";
        
        $order_status['placed']=[];
        $order_status['placed']['key']="Order Placed";
        $order_status['placed']['msg']="Order Placed Sucessfully";
        
        $order_status['processing']=[];
        $order_status['processing']['key']="Processing";
        $order_status['processing']['msg']="Order is processing";
        
        $order_status['invoiced']=[];
        $order_status['invoiced']['key']="Invoiced";
        $order_status['invoiced']['msg']="Order Invoice Generated";
        
        $order_status['readytoship']=[];
        $order_status['readytoship']['key']="Ready To Dispatch";
        $order_status['readytoship']['msg']="Order is ready to dispatch";
        
        $order_status['shipped']=[];
        $order_status['shipped']['key']="Dispatched";
        
        
        if(Yii::$app->request->post()){
            $pdata=Yii::$app->request->post();
            $order_id=strtoupper($pdata['DynamicModel']['order_id']);
            $post=true;
            $_order=Order::find()->where(['order_identifire'=>$order_id])->one();
            if($_order){
                
                $order=true;
                $order_tags=json_decode($_order->order_tags,true);
                foreach($order_tags as $key=>$tag){
                    
                    $key=str_replace(" ","",$key);
                    $_items=[];
                    $_items['title'] = $order_status[$key]['key'];
                    $_items['date'] = $tag;
                    $_items['time'] =$tag;
                    $_items['notes'] =$order_status[$key]['msg'];
                    $items[]=$_items;
                }
                 
               $data['status']= $_order->order_status;
               
               if($_order->order_status=="shipped"){
                   
                    $order_status['shipped']['msg']="Order is dispatched through ".strtoupper($_order->schannel)." Traking Id:".$_order->tracking ;
                    $_items=[];
                    $_items['title'] = $order_status['shipped']['key'];
                    $_items['date'] = $_order->updated_at;
                    $_items['time'] = $_order->updated_at;
                    $_items['notes'] = $order_status['shipped']['msg'];
                    $items[]=$_items;
                   
               }
               
                $data['items']=$items;
            }
           
        }
        
        
        
        return $this->render('track', [
                'model' => $model,
                'post'  => $post,
                'order' => $order,
                'data'  =>$data,
                'order_id'  =>$order_id
            ]);
        
    }
   
}
