<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yiister\gentelella\widgets\Panel;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $model common\models\Order */

$this->title = $model->order_identifire;

?>

<div style="font-family:courier; margin:auto; padding:0px; font-size:10px;">
	<div style="width: 90%; float:left; margin-left:5%; height:100px;">
		<div style="width: 35%; float: left;"> 
			<p style="width: 100%; float: left; text-align: left; text-transform: uppercase; font-size: 12px; font-weight:bold; color: #333; margin-top: 0px; margin-bottom: 6px;">
				<span style="color:#202e7b;">Atulya Karigari India</span> <br /> <br />
				Plot No 1215/1511 <br />
				Khandagiri Bari, Ghatikiya, Khordha <br />
				Bhubaneswar-751030 Odisha (India)
			</p>	
		</div>
		<div style="width: 20%; float: left; margin-left: 5%; margin-right: 5%; text-align: center;"> 
			<img src="<?= Yii::getAlias('@storage')."/default/inv_logo.png";?>" style="width: 200px;"> 
		</div>
		<div style="width: 35%; float: left;">
		  <h1 style="font-size:16px; font-weight: bold; color: #202e7b; text-align: right;">Invoice </h1>
		</div>  
	</div>
	<div style="width:40%;margin:auto; float:left; height:30px; margin-left:60%">
		
			<div style="width: 44%;  float: left; border: 1px solid #333; height: 30px;">
                <div style="float:left;text-align: center; padding:1%; background: #333; color: #fff;">
					Invoice No
				</div>
                <div style="float:left;text-align: center; padding:1%;">
					<?=$model->order_identifire;?>
				</div>
				
                
			</div>
            <div style="float:left;width:4%;  height: 30px;">
            &nbsp;
            </div>
			
			<div style="width: 40%; float: left; border: 1px solid #333; height: 30px;">
				<div style="float:left; text-align: center; padding:1%; background: #333; color: #fff;">
					Date
				</div>
                <div style="float:left;text-align: center; padding:1%;">
					<?= date("d-m-Y",strtotime($model->created_at));?>
				</div>
			</div>
		
	</div>
	<div style="width:100%; height:140px; float:left; margin-left:5%; margin-top:10px;">
		<div style="width:35%; float:left; height:140px;">
			<div style="background:#333; color:#fff; text-align:center; width:100%; float:left;  height:24px; padding-top:4px; font-weight:bold;">
				Invoice To
			</div>
			<div style="width:100%;height:110px; padding-top:4px; padding-left:5px; border:1px solid #000; line-height:1.2;">
				
				<?= $model->orderAddresses[0]->name; ?> <br /> <br />
				<?= $model->orderAddresses[0]->city;?> <br />
				<?= $model->orderAddresses[0]->state;?> <br />
				<?= $model->orderAddresses[0]->zip;?> <br />
                <?= $model->orderAddresses[0]->phone;?>
			</div>
		</div>
		<div style="width:26%; height:140px; float:left;">
		</div>
		<div style="width:35%; float:left; height:140px;">
			<div style="background:#333; color:#fff; text-align:center; width:100%; float:left;  height:24px; padding-top:4px; font-weight:bold;">
				Ship To
			</div>
			<div style="width:100%;height:110px; padding-top:4px; padding-left:5px; border:1px solid #000; line-height:1.2;">
				
				<?= $model->orderAddresses[0]->name; ?> <br /> <br />
				<?= $model->orderAddresses[0]->city;?> <br />
				<?= $model->orderAddresses[0]->state;?> <br />
				<?= $model->orderAddresses[0]->zip;?> <br />
                <?= $model->orderAddresses[0]->phone;?>
			</div>
		</div>
	</div>
	
	<div style="width:100%; height:auto; float:left; margin-top:10px; margin-bottom:10px;">
		<div style="width:90%; float:left; margin-left:5%; border:1px solid #000; height:a;">
			<div style="background:#333; color:#fff; text-align:center; width:100%; float:left;  height:24px; padding-top:4px; font-weight:bold;">
				<div style="width:25%; float:left; color:#fff;">
					Description
				</div>
				<div style="width:15%; float:left; color:#fff;">
					SKU
				</div>
				<div style="width:15%; float:left; color:#fff;">
					QTY
				</div>
				<div style="width:15%; float:left; color:#fff;">
					PRICE
				</div>
				<div style="width:15%; float:left; color:#fff;">
					VAT
				</div>
				<div style="width:15%; float:left; color:#fff;">
					TOTAL
				</div>
			</div>
            <?php foreach($model->orderItems as $item): ?>
			<div style="width:100%; float:left; height:auto; text-align:center;">

				<div style="width:25%; float:left; line-height:10px; min-height:60px;  border-right:1px solid #000;">
					<br />
					 <?= $item->item_name;?>
                     <?php if($item->variations):?>
                     <small><i>(<?=$item->variations;?>)</i></small>
                     <?php endif;?>
				</div>
				<div style="width:15%; float:left; line-height:10px; min-height:60px;  border-right:1px solid #000;">
					<br />
					<?= $item->item->sku;?>
                    <?php if($item->variations):?>
                     <br />
                      &nbsp;
                      <br />
                      &nbsp;
                     <?php endif;?>
				</div>
				<div style="width:15%; float:left; line-height:10px; min-height:60px;  border-right:1px solid #000;">
					<br />
					<?= $item->qty;?>
                    <?php if($item->variations):?>
                     <br />
                     &nbsp;
                     <br />
                      &nbsp;
                     <?php endif;?>
				</div>
				<div style="width:15%; float:left; line-height:10px; min-height:60px;  border-right:1px solid #000;  text-align:right;">
					<br />
					<?= Yii::getAlias('@currency').$item->sell_price;?>
                    <?php if($item->variations):?>
                      <br />
                      &nbsp;
                      <br />
                      &nbsp;
                     <?php endif;?>
				</div>
				<div style="width:15%; float:left; line-height:10px; min-height:60px;  border-right:1px solid #000;  text-align:right;">
					<br />
					<?= Yii::getAlias('@currency').$item->tax;?>
                    <?php if($item->variations):?>
                      <br />
                      &nbsp;
                      <br />
                      &nbsp;
                     <?php endif;?>
				</div>
				<div style="width:14%; float:left; line-height:10px; min-height:60px; text-align:right;">
					<br />
					<?= Yii::getAlias('@currency').$item->row_total;?>
                    <?php if($item->variations):?>
                      <br />
                      &nbsp;
                      <br />
                      &nbsp;
                     <?php endif;?>
				</div>
                
			</div>
            <?php endforeach; ?>
		</div>
	</div>
	<div style="width:100%; height:65px; float:left; margin-top:5px; margin-bottom:10px;">
		<div style="width:90%; float:left; margin-left:5%; height:65px;">
			<div style="color:#fff; text-align:center; width:100%; float:left;  height:24px; padding-top:4px; font-weight:bold;">
				<div style="width:31%; float:left; background:#333; height:22px; padding-top:2px;  color:#fff; border:1px solid #000;">
					SUB TOTAL
				</div>
				<div style="width:2.5%; float:left; color:#fff;">
					&nbsp;
				</div>
				<div style="width:31%; background:#333; height:22px; padding-top:2px;   float:left; color:#fff; border:1px solid #000;">
					SHIPPING TOTAL
				</div>
				<div style="width:2.5%; float:left; color:#fff;">
					&nbsp; 
				</div>
				<div style="width:31%; background:#333; height:22px; padding-top:2px;   float:left; color:#fff; border:1px solid #000;">
					TOTAL
				</div>
			</div>
			<div style="width:100%; float:left; height:40px; text-align:center;">
				<div style="width:31%; float:left; height:40px;  border:1px solid #000;">
					<br />
					<?= Yii::getAlias('@currency'). $model->order_subtotal_excl_tax;?>
				</div>
				<div style="width:2.5%; float:left;  height:40px; ">
					<br />
					&nbsp;
				</div>
				<div style="width:31%; float:left; height:40px;  border:1px solid #000;">
					<br />
					<?= Yii::getAlias('@currency').$model->shipping;?>
				</div>
				<div style="width:2.5%; float:left; height:40px; ">
					<br />
					&nbsp;
				</div>
				<div style="width:31%; float:left; height:40px;  border:1px solid #000;">
					<br />
					<?= Yii::getAlias('@currency').$model->order_total;?>
				</div>
			</div>
		</div>
	</div>
	
	
	
	
	
	
	
	
	<div style="width:100%; height:120px; float:left; margin-top:5px; margin-bottom:20px;">
		<div style="width:90%; float:left; margin-left:5%; height:200px;">
			<div style="width:100%; float:left; height:120px;">
				<div style="width:40%; float:left;padding:1%; height:120px;  border:1px solid #000;">
                   <div style="width:98%; padding:1%; height:39px; float:left; border-bottom:1px solid #000;">
                   <img src="<?= Yii::getAlias('@storageUrl')."/default/call.png";?>" style="width:32px; height:32px;"> +91 7682842572
					</div>
					<div style="width:98%; padding:1%; height:40px; float:left; border-bottom:1px solid #000;">
                    <img src="<?= Yii::getAlias('@storageUrl')."/default/mail.png";?>" style="width:32px; height:32px;"> atulyakarigariindia@gmail.com
					</div>
					<div style="width:98%;padding:1%; height:39px; float:left; ">
                    <img src="<?= Yii::getAlias('@storageUrl')."/default/web.png";?>" style="width:32px; height:32px;"> www.atulyakarigari.com
					</div>
				</div>
				
			</div>
		</div>
	</div>
	
	
	
	
</div>


