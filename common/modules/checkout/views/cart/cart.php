<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;


$this->title = 'Cart';

?>
<style>
.alert_header{
	color: #ce7a3e;
    font-size: 16px;
}
table tr th{background:#2a5b86;color:#fff; font-weight:normal;}
table tr td{vertical-align:middle !important;font-size: 16px;
color: #555;}
.input-group-btn{margin-top:6px;}
</style>
<section class="hero">
<div class="main-content ">
    <div class="container cart-block-style innerpage">          
		
		<div class="hero-content pb-5 text-center">
			<h1 class="hero-heading">Cart</h1>
		</div>
        <?php 
		if(count($CartItem['CartItems'])){
		?>
			<div class="table-responsive margin-top">
				<table class="table table-bordered">
					<thead>
						<tr>
							<th class="text-center">#</th>
							<th class="text-left">Name</th>
							<th class="text-left">Qty</th>
							<th class="text-right">Price</th>
							<th class="text-right">Sell Price</th>
							<th class="text-right">Row Total</th>
							
						</tr>
					</thead>
					<tbody>
						<!------------------------------  Dynamic Section  ------------------------------------->
						<?php
						
							foreach($CartItem['CartItems'] as $cartkey => $cartval){
						?>
						<tr id="item_<?=$cartval['cart_id']?>">
							<td class="text-center">                                   
                                    <a href="<?=Url::toRoute(['/product/'.$cartval['slug']]);?>">
									<img class="thumbnail" src="<?=$cartval['image']?>" style="width: 80px; height: 80px; margin:0px;">
                                    </a>
							</td>
							<td class="text-left">
								<a href="<?=Url::toRoute(['/product/'.$cartval['slug']]);?>">
									<?=$cartval['item_name']?>
								</a>
                                <?php if($cartval['variations']!="") :
                                 
                                $segments=explode("|",$cartval['variations']);
                                                     
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
							</td>
							<td class="text-left">
								<div style="max-width: 180px; margin:auto;" class="input-group btn-block">
									<span class="input-group-btn">
										<button id="item_qty_dec_<?=$cartval['cart_id']?>" class="btn btn-light" type="button" style="border-radius:4px;border: 1px solid #dedede;" onclick="cartQtyupdate(0,<?=$cartval['id']?>,<?=$cartval['cart_id']?>,'<?= addslashes($cartval['variations'])?>');"><i class="fa fa-minus"></i></button>
									</span>
									<input id="item_qty_<?=$cartval['cart_id']?>" type="text" class="form-control input-sm" size="1" style="height:35px;box-shadow: none;width: 54px; margin:5px;" value="<?=$cartval['qty']?>" readonly>
									<span class="input-group-btn">
										<button id="item_qty_inc_<?=$cartval['cart_id']?>" class="btn btn-light" type="button" style="border-radius:4px; border: 1px solid #dedede;" onclick="cartQtyupdate(1,<?=$cartval['id']?>,<?=$cartval['cart_id']?>,'<?=addslashes($cartval['variations'])?>');"><i class="fa fa-plus"></i></button>
										<button id="item_qty_rem_<?=$cartval['cart_id']?>" class="btn btn-danger"  type="button" style="margin-left:5px; border-radius:3px;" onclick="cartQtyupdate(2,<?=$cartval['id']?>,<?=$cartval['cart_id']?>,'<?=addslashes($cartval['variations'])?>');"><i class="fa fa-times-circle"></i></button>
									</span>
								</div>
							</td>
							<td class="text-right" id="item_price_<?=$cartval['cart_id']?>">
								<?=Yii::getAlias('@currency').number_format($cartval['price'],2)?>
							</td>
							<td class="text-right" id="item_sell_price_<?=$cartval['cart_id']?>">
								<?=Yii::getAlias('@currency').number_format($cartval['sell_price'],2)?>
							</td>
							<td class="text-right" id="item_row_total_<?=$cartval['cart_id']?>">
								<?=Yii::getAlias('@currency').number_format($cartval['row_total'],2)?>
							</td>
							
						</tr>
						<?php 
							}
						
						?>
						<!------------------------------ End Dynamic Section--------------------------------->
					</tbody>
				</table>
			</div>
        
        
		<div class="row">
			<div class="col-sm-4 offset-8">
				<table class="table table-bordered">
					<tbody>
						<tr>
							<span style="font-size: 20px;float: right; margin-bottom:10px;">Totals</span>
							<td class="text-right">
								Sub Total:
							</td>
							<td class="text-right">
								<span style="font-weight:bold; font-size:22px;"><?= Yii::getAlias('@currency')?><span id="cart_subtotal"><?=number_format($CartItem['CartDetails']['cart_total'],2)?></span></span>
							</td>
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
		<div class="buttons col-md-12">
			<div class="pull-left"><a class="btn btn-info" href="<?= Url::to(Yii::$app->request->referrer);?>"><i class="fa fa-caret-right"></i>&nbsp;Continue Shopping</a></div>
			<div class="pull-right"><a class="btn btn-primary reg_button" href="<?= Url::to(['/checkout/onepage']);?>">Proceed to Checkout</a></div>
		</div>
		</div>
		<?php 
		}else{
		?>
			<div class="row">
			<p>Your shopping cart is empty...</p>
			
			</div>
			<div class="buttons">
				<div class="pull-left">
					<a class="btn btn-default" href="<?= Url::to(Yii::$app->request->referrer);?>">
						<i class="fa fa-caret-right"></i>&nbsp;Continue Shopping
					</a>
				</div>
			
		    </div>
		<?php
		}
		?>
		
    </div>
</div>
</section>
<?php
$script=<<<JS

$('#search_manu').hide();
JS;
$this->registerJs($script);
?>
<script type="text/javascript">


function cartQtyupdate(type,id,cart_id,variations){
	
		if(type == 1){
			$.ajax({
					url: "<?= Url::to(['/cart/add']);?>",
					type: "POST",
					data: {
						item_id:id,
						variations:variations						
					},
					beforeSend:function(json)
					{ 
						//SimpleLoading.start('hourglass'); 
					},
					success: function (result) {
						//console.log(result);
						if(result.status == 1){
							//alert(123);
						var cart_subtotal_excl_tax = result.cart_updatedata.cart_subtotal_excl_tax;
						
						var row_total = result.cart_updatedata.row_total
				
							$('#cart_subtotal').html(cart_subtotal_excl_tax);
							
							$('#item_qty_'+cart_id).val(result.cart_updatedata.qty);
							
							$('#item_row_total_'+cart_id).html(row_total);
							
							
							/*********** Header part Update ***********/
							var Totalamount = result.Headercartdetails.Totalamount;
                            var TotalItems  = result.Headercartdetails.Totalcartitem;
                            $('#cart_total').html(Totalamount);
                            $('#cart_items').html(TotalItems);
							
							
						}
						
					},
					complete:function(json)
					{
						//SimpleLoading.stop();
					},
			});
		}else if(type == 0){
			$.ajax({
					url: "<?= Url::to(['/cart/updatequantity']);?>",
					type: "POST",
					data: {
						item_id:id,
                        variations:variations
					},
					beforeSend:function(json)
					{ 
						//SimpleLoading.start('hourglass'); 
					},
					success: function (result) {
						if(result.status == 1){
							
							if(result.CheckItem == 0)
								$('#item_'+cart_id).remove();
								
							
							var cart_subtotal_excl_tax = result.cart_updatedata.cart_subtotal_excl_tax;
                            var row_total = result.cart_updatedata.row_total
				
							$('#cart_subtotal').html(cart_subtotal_excl_tax);
							
							$('#item_qty_'+cart_id).val(result.cart_updatedata.qty);
							
							$('#item_row_total_'+cart_id).html(row_total);
							
							
							/*********** Header part Update ***********/
							var Totalamount = result.Headercartdetails.Totalamount;
                            var TotalItems  = result.Headercartdetails.Totalcartitem;
                            $('#cart_total').html(Totalamount);
                            $('#cart_items').html(TotalItems);
							
							
						}else{
							//alertify.alert('Product quantity not updated').setHeader('<em class="alert_header"> Arunodayamedicare </em> ').show();
						}

					},
					complete:function(json)
					{
						//SimpleLoading.stop();
					},
			});
		}else if(type==2){
			$.ajax({
					url: "<?= Url::to(['/cart/remove-item']);?>",
					type: "POST",
					data: {
						item_id:id,
                        variations:variations
					},
					beforeSend:function(json)
					{ 
						//SimpleLoading.start('hourglass'); 
					},
					success: function (result) {
						var cart_subtotal_excl_tax = result.cart_updatedata.cart_subtotal_excl_tax;
                            
				
                        $('#cart_subtotal').html(cart_subtotal_excl_tax);
						$('#item_'+cart_id).remove();
						/*********** Header part Update ***********/
						var Totalamount = result.Headercartdetails.Totalamount;
                        var TotalItems  = result.Headercartdetails.Totalcartitem;
                        $('#cart_total').html(Totalamount);
                        $('#cart_items').html(TotalItems);
						

						
					},
					complete:function(json)
					{
						//SimpleLoading.stop();
					},
			});
			
		}else{
			console.log("Error: cartUpdate()->error");
		}
	}
</script>