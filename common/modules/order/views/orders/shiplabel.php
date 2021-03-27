
    <main role="main" class="container">
        <div class="row" style="width:100%;padding:0px; margin:0px;">
            <div class="col-md-4" style="float:left; width:30%;">
               <img src="<?= Yii::getAlias('@storage')."/default/inv_logo.png";?>" style="width:120px;">             
            </div>
            <div class="col-md-4 text-center" style="float:left; width:26%;">              
               <img src="<?= Yii::getAlias('@storage')."/default/".$model->schannel.".png";?>" style="width:50px;" /> 
               <br />
               <br />
            
               <img src="https://www.barcodesinc.com/generator/image.php?code=<?=$model->tracking;?>&style=452&type=C128B&width=232&height=100&xres=1&font=5" width="100%" />
            </div>
            <div class="col-md-4 text-right" style="float:left; width:30%;">
                <p class="lead">Order Number</p>
                <p class="lead"><?=$model->order_identifire;?></p>
                <p>Purchased:<?= date("d-m-Y",strtotime($model->created_at));?></p>
                <p>Shipped: <?= date("d-m-Y",strtotime($model->created_at));?></p>
            </div>
        </div>
        <div class="row" style="width:100%;">
            <div class="col-md-6" style="float:left; width:45%;">
                <h4>Shipping To</h4>
                <p><?= $model->orderAddresses[0]->name; ?></p>
                <p><?= $model->orderAddresses[0]->city;?>, <?= $model->orderAddresses[0]->state;?></p>
                <p><?= $model->orderAddresses[0]->country;?>, <?= $model->orderAddresses[0]->zip;?> </p>
                <p>Phone: <?= $model->orderAddresses[0]->phone;?></p>
            </div>
            <div class="col-md-6" style="float:right; width:45%;">
                <h4>Shipping From</h4>
                <p>HOT BARGAINS LTD</p>
                <p>98 WENNINGTON ROAD</p>
                <p>RAINHAM , RM13 9DE</p>
                <p>VAT NO : 243427894</p>
            </div>
            
        </div>
        <hr/>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Item Code</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody>
                  <?php foreach($model->orderItems as $item): ?>
                <tr>
                    <td scope="row"><?= $item->item->sku;?></th>
                    <td><?= $item->item_name;?>
                     <?php if($item->variations):?>
                     <small><i>(<?=$item->variations;?>)</i></small>
                     <?php endif;?>
                    </td>
                    <td><?= $item->qty;?></td>
                    <td class="text-right"><?= Yii::getAlias('@currency').$item->row_total;?></td>                    
                </tr>
                <?php endforeach;?>
            </tbody>
            <tfoot>
                <tr>
                    <td scope="row" colspan="3" class="text-right">Subtotal</td>
                    <td class="text-right"><?= Yii::getAlias('@currency'). $model->order_subtotal_excl_tax;?></td>                    
                </tr>
                <tr>
                    <td scope="row" colspan="3" class="text-right">Tax</td>
                    <td class="text-right"><?= Yii::getAlias('@currency').$model->tax;?></td>                    
                </tr>
                <tr>
                    <td scope="row" colspan="3" class="text-right">Shipping</td>
                    <td class="text-right"><?= Yii::getAlias('@currency').$model->shipping;?></td>                    
                </tr>
                <tr>
                    <td scope="row" colspan="3" class="text-right">Grand Total</td>
                    <td class="text-right"><?= Yii::getAlias('@currency'). $model->order_total;?></td>                    
                </tr>
            </tfoot>
        </table>
    </main>
   