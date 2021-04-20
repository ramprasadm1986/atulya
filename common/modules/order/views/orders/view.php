<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yiister\gentelella\widgets\Panel;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->order_identifire;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="x_panel order-view">

    <div class="x_title">
        <h2><?= Html::encode($this->title) ?></h2>
        <div class="clearfix"></div>
    </div>

    <div class="x_content">
  
    
    <div class="row">
			<div class="form-group col-md-4 col-sm-4 col-xs-12">
					<?php 
						Panel::begin(
							[
								'header' => Html::encode(Yii::t('backend', 'Order Details')),
								'icon' => 'users',
							]
						)
					?>
					<table class="table">
						<tbody>
							<tr>
								<th scope="row">Order ID</th>
								<td><?= $model->order_identifire;?></td>
							</tr>
							<tr>
								<th scope="row">Name</th>
								<td><?= $model->orderAddresses[0]->name; ?></td>
							</tr>
							
							<tr>
								<th scope="row">Email</th>
								<td><?= $model->user_email; ?></td>
							</tr>
							<tr>
								<th scope="row">Contact No</th>
								<td><?= $model->orderAddresses[0]->phone;; ?></td>
							</tr>
                            <tr>
								<th scope="row">Is Guest</th>
								<td><?= $model->order_user_type?"No":"Yes"; ?></td>
							</tr>
														
						</tbody>
					</table>					
					<?php Panel::end() ?>
                    <?php 
						Panel::begin(
							[
								'header' => Html::encode(Yii::t('backend', 'Payment Channel')),
								'icon' => 'users',
							]
						);
                        
                        
					?>
					<table class="table">
						<tbody>
							<tr>
								<th scope="row">Gateway</th>
								<td></td>
							</tr>
                        </tbody>
					</table>					
					<?php Panel::end() ?>
			</div>
			<div class="form-group col-md-8 col-sm-8 col-xs-12">
					<?php 
						Panel::begin(
							[
								'header' => Html::encode(Yii::t('backend', 'Shipping Detils')),
								'icon' => 'users',
							]
						)
					?>
                    <table class="table">
						<tbody>
							
                            <tr>
                                <th scope="row" >Shipping Mode</th>
								
								<th>Shipping Channel</th>
                                
                                <th>Tracking No:</th>
                                
							</tr>
                            <tr>
                                <td scope="row" ><?= $model->shipping_details;?></td>
								
                                <td> <?= $model->schannel;?></td>
                               
                                <td> <?= $model->tracking;?></td>
							</tr>
                            <tr>
                                <th scope="row" >Address Line1</th>
								
								<th>Address Line2</th>
                                
                                <th>Landmark</th>
                                
							</tr>
                            <tr>
                                <td scope="row" ><?= $model->orderAddresses[0]->address1;?></td>
								
                                <td><?= $model->orderAddresses[0]->address2;?></td>
                               
                                <td><?= $model->orderAddresses[0]->landmark;?></td>
							</tr>
							<tr>
								<th scope="row">City</th>
                                <th>State</th>
                                
                                <th>Country</th>
								
							</tr>
							<tr>
								<td><?= $model->orderAddresses[0]->city;?></td>
								<td><?= $model->orderAddresses[0]->state;?></td>
                                <td><?= $model->orderAddresses[0]->country;?></td>
							</tr>
							<tr>
								<th scope="row">Zip Code</th>
                                <th>Contact No</th>
								<th>&nbsp;</th>
							</tr>
							<tr>
								<td><?= $model->orderAddresses[0]->zip;?></td>
								<td><?= $model->orderAddresses[0]->phone;?></td>
                                <td>&nbsp;</td>
							</tr>
							
													
						</tbody>
					</table>
									
					<?php Panel::end() ?>
			</div>
			
		</div>
        <div class="row">
			<div class="form-group col-md-12 col-sm-12 col-xs-12">
					<?php 
						Panel::begin(
							[
								'header' => Html::encode(Yii::t('backend', 'Order Items')),
								'icon' => 'users',
							]
						)
					?>
					

					<table class="table">
						<thead>
							<tr>
								<th>#</th>
								<th>Name</th>
								<th>Qty</th>
								<th>Unit Price</th>
								<th>Total Price</th>
							</tr>
							
						</thead>
						<tbody>
							<?php
							$i=1;
							foreach($model->orderItems as $item){
							?>
							<tr>
								<th scope="row"><?= $i;?></th>
								<td>
                                <?= $item->item_name;?>
                                <?php if($item->variations!="") :
                                 
                                $segments=explode("|",$item->variations);
                                                     
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
								<td><?= $item->qty;?></td>
								<td><?= Yii::getAlias('@currency').$item->sell_price;?></td>
								<td><?= Yii::getAlias('@currency').$item->row_total;?></td>
							</tr>
							<?php $i++; } ?>
						</tbody>
						<tfoot>
                            <tr>
								<th colspan="3" >&nbsp;</th>
								<th>Subtotal</th>
								<th><?= Yii::getAlias('@currency'). $model->order_subtotal_excl_tax;?></th>
							</tr>
                             <tr>
								<th colspan="3" style="border-top:0px;">&nbsp;</th>
								<th>Shipping</th>
								<th><?= Yii::getAlias('@currency').$model->shipping;?></th>
							</tr>
							<tr>
								<th colspan="3" style="border-top:0px;">&nbsp;</th>
								<th>Grand Total</th>
								<th><?= Yii::getAlias('@currency').$model->order_total;?></th>
							</tr>
							
						</tfoot>
					</table>


					
					
					
					<?php Panel::end() ?>
			</div>
		</div>
		

</div>
