<?php 
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\form\ActiveForm;
use kartik\form\ActiveField;
use kartik\number\NumberControl;
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use common\models\ClassCountry;
use common\models\ClassState;
use common\models\ClassCity;
use common\models\ShippingMethod;
use common\models\ClassBank;

use yii\helpers\ArrayHelper;

$this->title = 'Checkout';
//echo "<pre>"; var_dump($employeeaddress);
?>
<style type="text/css">
.address_card{margin-top: 15px; margin-bottom:15px;}
.panel-body p{padding:8px; line-height:1.8; font-size:14px; color:#666;}
table tr th{background:#2a5b86;color:#fff; font-weight:normal;}
table tr td{vertical-align:middle !important;font-size: 16px;
color: #555;}
.delivery_address {line-height:1.7; color:#666;}
.checkout-item{padding:2px;}
.product-name{padding-left:10px;}
.select2-container--krajee .select2-selection--single {height:40px;}
</style>
	<section class="hero">
<div class="main-content">
    <?php $form = ActiveForm::begin([
        'fieldConfig' => ['options' => ['class' => 'col-lg-6 col-sm-6']],
    ]); ?>
    


         <div class="container">
            <!-- Breadcrumbs -->
            <ol class="breadcrumb justify-content-center">
               <li class="breadcrumb-item"><a href="index.html">Home</a></li>
               <li class="breadcrumb-item active">Checkout       </li>
            </ol>
            <!-- Hero Content-->
            <div class="hero-content pb-5 text-center">
               <h1 class="hero-heading">Checkout</h1>
               <div class="row">
                  <div class="col-xl-8 offset-xl-2">
					<p class="lead text-muted">Please fill in your address</p>
					
				  </div>
               </div>
            </div>
         </div>
     
<div class="container">  
    <div class="row">
        <div class="col-lg-8">
        <div class="block">
        <div class="block-header">
           <h6 class="text-uppercase mb-0"> Invoice Address</h6>
        </div>
        <div class="row">
         <?= Html::hiddenInput('selected_state_id', $CartAddress->isNewRecord ? '' : $CartAddress->state, ['id'=>'selected_state_id']); ?>
         <?= Html::hiddenInput('selected_city_id', $CartAddress->isNewRecord ? '' : $CartAddress->city, ['id'=>'selected_city_id']); ?>
         <?= Html::hiddenInput('is_star', false, ['id' => 'is_star']); ?>
         
         <?= $form->field($CartAddress, 'name',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->textInput(['maxlength' => true]) ?>
         
         <?= $form->field($CartAddress, 'email',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->textInput(['maxlength' => true]) ?>
         
         <?= $form->field($CartAddress, 'address1',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->textInput() ?>
          <?= $form->field($CartAddress, 'address2',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->textInput() ?>
           <?= $form->field($CartAddress, 'landmark',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->textInput() ?>
         
         <?= $form->field($CartAddress, 'country',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->widget(Select2::classname(), [
                                                'data' => ArrayHelper::map(ClassCountry::find()->where(['iso2'=>explode(",",Yii::getAlias('@AllowedCountry'))])->all(), 'iso2', 'name'),
                                                'options' => ['id'=>'country-id'],
                                                'pluginOptions' => [
                                                    'placeholder'=>"Select Country",
                                                    'allowClear' => true
                                                ],
                                            ]); 
                                       ?>
        <?= $form->field($CartAddress, 'state',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->widget(DepDrop::classname(), [
                        'type' => DepDrop::TYPE_SELECT2,
                        'options' => ['id' => 'state-id'],
                        'select2Options' => ['pluginOptions' => ['placeholder'=>false,'allowClear' => true]],
                        'pluginOptions' => [
                            'placeholder'=>"Select",
                            'depends' => ['country-id'],
                            'url' => Url::to(['/address-helper/state']),
                            'params' => ['is_star','selected_state_id']
                        ]
                    ]); ?>

        <?= $form->field($CartAddress, 'city',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->widget(DepDrop::classname(), [
                       'type' => DepDrop::TYPE_SELECT2,
                       'options' => ['id' => 'city-id'],
                       'select2Options' => ['pluginOptions' => ['placeholder'=>false,'allowClear' => true]],
                       'pluginOptions' => [
                            'placeholder'=>"Select",
                            'depends' => ['country-id','state-id'],
                            'url' => Url::to(['/address-helper/city']),
                            'params' => ['is_star','selected_city_id']
                       ],
                       'pluginEvents'=>[
                            "depdrop:afterChange" => "function(event, id, value) { console.log(id); console.log(value);}",
                       ]
                   ]); ?>
        
            
            
        <?= $form->field($CartAddress, 'zip',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($CartAddress, 'phone',[
                    'template' => "{label}\n{input}\n{hint}\n{error}",
                    'labelOptions' => [ 'class' => 'form-label' ]])->textInput(['maxlength' => true]) ?>
       </div>
        </div>
        
        </div>
        <div class="col-lg-4">
        <div class="block mb-5" style="padding:10px;">
           <div class="form-group col-md-12 col-sm-12 col-xs-12">
               <div class="block-header">
                <h6 class="text-uppercase mb-0">Order Summary</h6>
              </div>
             
            <?php foreach($CartItemmodel['CartItems'] as $CartItem) :?>
             <div class="block-body  pt-1" style="float:left;">
                 
                <div class=" checkout-item ">
                    <div class="row">
                    <div class="col-md-2 col-sm-2 col-xs-12" style="padding-right:0px;">
                    <img class="pull-left" src="<?= $CartItem['image'];?>" width="100%" />
                    </div>
                    <div class="col-md-4 col-sm-5 col-xs-12" style="padding-right:0px;">
                    <label class="control-label"><?= $CartItem['item_name'];?></label>
                    
                    <?php if($CartItem['variations']!="") :
                                 
                    $segments=explode("|",$CartItem['variations']);
                                         
                    ?>
                        <dl>                                   
                            <?php foreach($segments as $seg): 
                            
                                $part=explode(":",$seg);
                                $attr=array_shift($part);
                                $value=implode(":",$part);
                            ?>
                            <dt><small><?=$attr;?></small></dt>
                            <dd><small><i><?=$value;?><i></small></dd>
                            <?php endforeach;?>
                        </dl>
                    <?php endif;?>
                    </div>
                    <div class="col-md-6 col-sm-5 col-xs-12" style="padding-right:0px;">
                    <strong class="pull-right"><i><?=$CartItem['qty']?> X <?= Yii::getAlias('@currency').$CartItem['sell_price']?> = <?=Yii::getAlias('@currency').$CartItem['row_total']?></i></strong>
                    </div>
                    <div class="clearfix"></div>
                </div>
                </div>
           
            <?php endforeach;?>
            <hr>
            <div class="row" >
             <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="form-group">
                        <div class="pull-left">
                        <label class="control-label"><i>Sub Total</i></label>
                        </div>
                        <div class="pull-right">
                        <label class="control-label"><?= Yii::getAlias('@currency').$CartItemmodel['CartDetails']['cart_subtotal_excl_tax'];?></label>
                        </div>
                    </div> 
            </div>
          </div>
          <hr>
          <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
            
             
             <?= $form->field($Cart, 'shipping_details')->radioList(ArrayHelper::map(ShippingMethod::find()->where(['status'=>1])->all(), 'method', 'name')); ?>
               <hr>
            </div>
           </div>
           <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <p>Order Summary</p>
                    <div class="form-group">
                        <div class="pull-left">
                        <label class="control-label"><i>Sub Total</i></label>
                        </div>
                        <div class="pull-right">
                        <label class="control-label"><?= Yii::getAlias('@currency').$CartItemmodel['CartDetails']['cart_subtotal_excl_tax'];?></label>
                        </div>
                    </div>                
            </div>
            </div>
            <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">    
               
                    <div class="form-group">
                        <div class="pull-left">
                        <label class="control-label"><i>Shipping</i></label>
                        <br/><small id="shipping_type"></small>
                        </div>
                        <div class="pull-right">
                        <label class="control-label"><?= Yii::getAlias('@currency')?><span id="shipping_amount">0.0</span></label>
                        </div>
                    </div>                
                
            </div>
            </div>
            <hr>
            <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">    
                    <div class="form-group">
                        <div class="pull-left">
                        <label class="control-label"><i>GRAND TOTAL</i></label>
                        
                        </div>
                        <div class="pull-right">
                        <label class="control-label"><?= Yii::getAlias('@currency')?><span id="grand_total"><?=$CartItemmodel['CartDetails']['cart_total'];?></span></label>
                        </div>
                    </div>                
               
            </div>
            </div>
            
             <div class="row">
            <div class="form-group col-md-12 col-sm-12 col-xs-12">
                <div class="pull-right">
                    <?= Html::submitButton('<i class="fa fa-save"></i> Place Order', ['class' => 'btn btn-dark','id'=>'placeorder']) ?>
                </div>
            </div>
            </div>
          
        </div>
        </div>
        
         <div class="clearfix"></div>
    </div>
    <?php ActiveForm::end(); ?>
     </div>
    </div>
</div>
 </section>
<?php 
$setShippingUrl=Url::to(['/checkout/onepage/setshipping']);
$js=<<<JS
$("input[name='Cart[shipping_details]']").on('change', function() {
setShippingMethod('$setShippingUrl',$(this).val())
});

$("#cartaddress-zip").inputFilter(function(value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
  });
$("#cartaddress-phone").inputFilter(function(value) {
    return /^\d*$/.test(value);    // Allow digits only, using a RegExp
  });
JS;
$this->registerJs($js);
?>
