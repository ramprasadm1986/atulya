<?php
namespace common\modules\order\controllers;









use Yii;
use common\models\Order;
use common\models\OrderItem;
use common\models\search\OrderSearch;

use common\modules\order\models\Consignment;

use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

use backend\models\Admin;

use kartik\mpdf\Pdf;

use yii2tech\spreadsheet\Spreadsheet;
use yii\data\ActiveDataProvider;

use ramprasadm1986\pdfmerger\PDFMerger;





/**
 * OrdersController implements the CRUD actions for Order model.
 */
class OrdersController extends Controller
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
                        'allow' => (Yii::$app->user->identity instanceof Admin),
                        'roles' => ['@'],
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

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $searchModel->order_status = 'placed'; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    public function actionReadytoship()
    {
        $searchModel = new OrderSearch();
        $searchModel->order_status = 'ready to ship'; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('readytoship', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    public function actionShipped()
    {
        $searchModel = new OrderSearch();
        $searchModel->order_status = 'shipped'; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('shipped', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    
    
     public function actionProcessing()
    {
        $searchModel = new OrderSearch();
        $searchModel->order_status = 'processing'; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        
        $model = new Consignment();
        if (Yii::$app->request->isPost) {
            $cfile = UploadedFile::getInstance($model, 'cfile');
            
            if ($cfile) {   
                $csv = array_map('str_getcsv', file($cfile->tempName));
               
                if(count($csv)){
                    array_walk($csv, function(&$a) use ($csv) {
                        $a = array_combine($csv[0], $a);
                    });
                    if(count($csv)){
                        $count=0;
                       foreach($csv as $row){
                           if(isset($row["Order Identifire"]) && isset($row["Channel"]) && isset($row["Tracking"])){
                               $order=Order::find()->where(['order_identifire'=>$row["Order Identifire"],'order_status'=>'processing'])->one();
                               
                               if($order){
                                   $count++;
                                    $tags=json_decode( $order->order_tags,true);
                                    
                                    $tags['ready to ship']=date("Y-m-d H:i:s");
                                    $order->order_status="ready to ship";
                                    $order->schannel=$row["Channel"];
                                    $order->tracking=$row["Tracking"];
                                    $order->order_tags=json_encode($tags);
                                    $order->save();
                                    
                                   
                               }
                           }
                       }
                       Yii::$app->session->setFlash('success', $count.' Order Processed');
                   }
                }
            
            }
         
        }
        
        $model->cfile='';
    
        return $this->render('processing', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'consignment'=>$model,
        ]);
    }
    
    public function actionPending()
    {
        $searchModel = new OrderSearch();
        $searchModel->order_status = 'pending'; 
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('pending', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    

    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    
    /**
     * Displays a single Order model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionInvoice($id)
    {
        
        $model= $this->findModel($id);
        
        $file=Yii::getAlias('@storage')."/invoices/Invoice-".$model->order_identifire.".pdf";
        $fileName="Invoice-".$model->order_identifire.".pdf";
    
      if (file_exists($file)) {
        return Yii::$app->response->sendFile($file, $fileName);
      }
      else{
          
         $content=$this->renderPartial('invoice', [
            'model' => $model,
        ]);
        
        
            $pdf = new Pdf([
        // set to use core fonts only
        'mode' => Pdf::MODE_UTF8, 
        // A4 paper format
        'format' => Pdf::FORMAT_A4, 
        // portrait orientation
        'orientation' => Pdf::ORIENT_PORTRAIT, 
        // stream to browser inline
        'destination' => Pdf::DEST_BROWSER, 
        // your html content input
        'content' => $content,  
        // format content from your own css file if needed or use the
        // enhanced bootstrap css built by Krajee for mPDF formatting 
        'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
        // any css to be embedded if required
        'cssInline' => '.kv-heading-1{font-size:18px}', 
         // set mPDF properties on the fly
        'options' => ['title' => 'Invoice: '.$model->order_identifire],
         // call mPDF methods on the fly
        'methods' => [ 
            'SetHeader'=>['Invoice: '.$model->order_identifire], 
            'SetFooter'=>['{PAGENO}'],
        ],
        'filename'=> $file,
        'destination'=>Pdf::DEST_FILE
    ]);
    
                    if($model){
                        
                        $tags=json_decode( $model->order_tags,true);
                        $tags["invoiced"]=date("Y-m-d H:i:s");
                        $model->order_tags=json_encode($tags);
                        $model->save();
                    }
    
    // return the pdf output as per the destination setting
        $pdf->render();  
        return Yii::$app->response->sendFile($file, $fileName);  
          
      }
    }
    
     public function actionShiplabel($id)
    {
       
       $model= $this->findModel($id);
       if($model->order_status=="ready to ship" || $model->order_status=="shipped" ){
            $file=Yii::getAlias('@storage')."/shiplabels/"."PackingSlip-".$model->order_identifire.".pdf";
            
            $fileName="PackingSlip-".$model->order_identifire.".pdf";
            
            if (file_exists($file)) {
            return Yii::$app->response->sendFile($file, $fileName);
          }
          else{
            
            $content=$this->renderPartial('shiplabel', [
                'model' => $model,
            ]);
            
            
                $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_UTF8, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:18px}', 
             // set mPDF properties on the fly
            'options' => ['title' => 'Order ID: '.$model->order_identifire,'curlAllowUnsafeSslRequests'=>true],
             // call mPDF methods on the fly
            'methods' => [ 
              
                'SetHeader'=>['Order ID: '.$model->order_identifire], 
                'SetFooter'=>['{PAGENO}'],
            ],
            'filename'=> $file,
            'destination'=>Pdf::DEST_FILE
            ]);
        
                        if($model){
                            
                            $tags=json_decode( $model->order_tags,true);
                            $tags["ready to ship"]=date("Y-m-d H:i:s");
                            $model->order_tags=json_encode($tags);
                            $model->order_status="shipped";
                            $model->save();
                        }
           
        // return the pdf output as per the destination setting
            $pdf->render(); 
           
            return Yii::$app->response->sendFile($file, $fileName);
             
        
          }
       }
       return false;
    }
    
    
    public function actionShippinglist(){
       
        ob_end_clean();
       $exporter = (new Spreadsheet([
            'title' => 'Shipping List',
            'dataProvider' => new ActiveDataProvider([
                'query' =>  OrderItem::find()->joinWith(['orderIdentifire','item'])->where(['orders.order_status'=>"placed"]),
            ]),
            'writerType' => 'Csv',
            'columns' => [                
                [
                    'attribute' => 'order_identifire',
                    
                ],
                [
                    'attribute' => 'item.sku',
                    
                ],
                [
                    'attribute' => 'item_name',
                    
                ],
                [
                    'attribute' => 'variations',
                    
                ],
                [
                    'attribute' => 'qty',
                    
                ],
            ],
        ]));
        
     
     $file="ShippingList-".date("Y-m-d-h-i-s").".csv";
     
     $exporter->save(Yii::getAlias('@storage')."/shipping_list/". $file);
     
        $csv = array();
        $lines = file(Yii::getAlias('@storage')."/shipping_list/". $file, FILE_IGNORE_NEW_LINES);
        $first=true;
        foreach ($lines as $key => $value)
        {
            if(!$first){
            $csvData=str_getcsv($value);
           
               if(isset($csvData[0]))
               {
                  
                   $csv[]=$csvData[0];
                    $model=Order::find()->where(['order_identifire'=>$csvData[0]])->one();
                    
                    if($model){
                        $model->order_status="processing";
                        $tags=json_decode( $model->order_tags,true);
                        $tags["processing"]=date("Y-m-d H:i:s");
                        $model->order_tags=json_encode($tags);
                        $model->save();
                    }
                
                
               }
            
            }
            $first=false;
        }
        if(count($csv))
           return Yii::$app->response->sendFile(Yii::getAlias('@storage')."/shipping_list/". $file, $file);
        else{
            unlink (Yii::getAlias('@storage')."/shipping_list/". $file);
            Yii::$app->session->setFlash('error', 'No Record To Process');
            return $this->redirect(['index']);
        }
    }
    
    
    
    
    public function actionPackagingslip(){
       ob_end_clean();
       $models=Order::find()->where(['orders.order_status'=>"ready to ship"])->all();
        $files=array();
        
        foreach($models as $model){
     
            $file=Yii::getAlias('@storage')."/shiplabels/"."PackingSlip-".$model->order_identifire.".pdf";
        
        
        
              if (file_exists($file)) {
                    $files[]=$file;
                }
              else{
                
                $content=$this->renderPartial('shiplabel', [
                    'model' => $model,
                ]);
                
                
                    $pdf = new Pdf([
                // set to use core fonts only
                'mode' => Pdf::MODE_UTF8, 
                // A4 paper format
                'format' => Pdf::FORMAT_A4, 
                // portrait orientation
                'orientation' => Pdf::ORIENT_PORTRAIT, 
                // stream to browser inline
                'destination' => Pdf::DEST_BROWSER, 
                // your html content input
                'content' => $content,  
                // format content from your own css file if needed or use the
                // enhanced bootstrap css built by Krajee for mPDF formatting 
                'cssFile' => '@vendor/kartik-v/yii2-mpdf/src/assets/kv-mpdf-bootstrap.min.css',
                // any css to be embedded if required
                'cssInline' => '.kv-heading-1{font-size:18px}', 
                 // set mPDF properties on the fly
                'options' => ['title' => 'Order ID: '.$model->order_identifire],
                 // call mPDF methods on the fly
                'methods' => [ 
                    'SetHeader'=>['Order ID: '.$model->order_identifire], 
                    'SetFooter'=>['{PAGENO}'],
                ],
                'filename'=>  $file,
                'destination'=>Pdf::DEST_FILE
                ]);
            
                            if($model){
                                
                                $tags=json_decode( $model->order_tags,true);
                                $tags["ready to ship"]=date("Y-m-d H:i:s");
                                $model->order_tags=json_encode($tags);
                                $model->order_status="shipped";
                                $model->save();
                            }
            // return the pdf output as per the destination setting
                $pdf->render(); 
                
                 $files[]=$file;
                }
        }
        if(count($files)){    
          
            
            $_com_pdf = new PDFMerger; 
            foreach($files as $file)
            $_com_pdf->addPDF($file, 'all');
            
            $file_name="Packaging Slips".date("Y-m-d H:i:s").".pdf";
            return Yii::$app->response->sendFile($_com_pdf->merge('download', $file_name), $file_name);
            
        }
          
        else{
           
            Yii::$app->session->setFlash('error', 'No Record To Process');
            return $this->redirect(['readytoship']);
        }
    }
    
    /**
     * Finds the Order model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Order the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Order::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
