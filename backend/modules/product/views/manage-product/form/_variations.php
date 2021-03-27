<?php
use yii\helpers\Html;
use kartik\date\DatePicker;
use kartik\widgets\SwitchInput;
use kartik\select2\Select2;
use kartik\number\NumberControl;
use ramprasadm1986\elfinder\InputFile;
use ramprasadm1986\elfinder\ElFinder;
use yii\web\JsExpression;


use yii\helpers\ArrayHelper;
use common\models\ClassInput;
use common\models\CatalogProductAttribute;
use common\models\CatalogProductAttributesOption;

use wbraganca\dynamicform\DynamicFormWidget;

?>

<div class="row">

        <div class="form-group col-md-12 col-sm-12 col-xs-12">
    
            
                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                    <?php
                    $CPAttribute_ids=[];
                    foreach($CPAttributes as $CPAttribute): ?>
                       <?php $CPAttribute_ids[]='attribute_id'.$CPAttribute->id;?>
                        <?= Html::dropDownList($CPAttribute->name, null,
                  ArrayHelper::map(CatalogProductAttributesOption::find()->where(['attribute_id'=>$CPAttribute->id])->all(), 'name', 'name'),['id'=>'attribute_id'.$CPAttribute->id,'prompt' =>'Select '.$CPAttribute->name]) ?>
                       
                    <?php endforeach; ?>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <?php 
                        
                        echo NumberControl::widget([
                               
                                'name' => 'vriable_price',
                               
                                'maskedInputOptions' => [
                                    'min' => 0,                                                           
                                    'allowMinus' => false,
                                    'digits' => 2,
                                    'groupSeparator' => '',
                                    'radixPoint' => '.'
                                ],
                                'displayOptions' => [
                                    'id'=>'vriable_price',
                                    'placeholder' => 'Enter a valid amount...'
                                ],
                            ]); 
                    
                        
                            ?>
                   
                    </div>
                </div>
                <div class="form-group col-md-6 col-sm-6 col-xs-6">
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <?php echo InputFile::widget([
                                        'language'      => 'en',
                                        'name'          => 'vriable_image',
                                        'controller'    => 'elfinder', 
                                        'filter'        => 'image',
                                        'path'			=> '/product_images/',							
                                        'template'      => '<div class="input-group"><span>{image}</span><span class="input-group-btn" style="vertical-align:top;">{button}</span>{input}</div>',
                                        'options'       => ['id' =>'vriable_image','class' => 'form-control','type'=>'hidden'],
                                        'buttonOptions' => ['class' => 'btn btn-default'],
                                        'multiple'      => false,
                                        
                                        
                                    ]);
                        ?>
                    </div>
                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                        <div class="pull-right">
                            <?= Html::button('<i class="fa fa-plus"> Add Variant</i>', ['class' => "btn btn-sm",'id'=>'addvariations','onClick'=>'AddToTable('.json_encode($CPAttribute_ids).');']) ?>
                        </div>
                    </div>
                 </div>
               
           
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12">
            <table class="table" id="variationtable">
                <thead>
                    <tr>
                         <?php foreach($CPAttributes as $CPAttribute): ?>
                         <th><?= $CPAttribute->name?></th>
                         
                         <?php endforeach; ?>
                         <th>Price</th>
                         <th>Image</th>
                         <th> Action</th>
                    </tr>
            </thead>
            <tbody>
                <?php $index=0; foreach ($CPVariation as $Variation): ?>
                <tr id="variation-<?= $index;?>">
                <?php 
                 $segments=explode("|",$Variation->combination);
                  
                 
                    foreach($CPAttributes as $CPAttribute){ 
                                    
                        $tag="<td>&nbsp;</td>";
                        
                        foreach($segments as $seg){
                            $part=explode(":",$seg);
                            if($CPAttribute->name== array_shift($part)){
                                
                             $tag="<td>".implode(":",$part)."</td>";
                            }
                        }
                        echo $tag;
                        
                    } ?>
                    
                 
                  <td>
                  
                  <?php echo NumberControl::widget([
                       
                        'name' => "CatalogProductVariation[".$index."][price]",
                        'value'=>$Variation->price,
                        'maskedInputOptions' => [
                            'min' => 0,                                                           
                            'allowMinus' => false,
                            'digits' => 2,
                            'groupSeparator' => '',
                            'radixPoint' => '.'
                        ],
                        'displayOptions' => [
                            'placeholder' => 'Enter a valid amount...'
                        ],
                    ]); ?>
                  <input type="hidden" name="CatalogProductVariation[<?= $index;?>][id]" value="<?= $Variation->id;?>" />
                  <input type="hidden" name="CatalogProductVariation[<?= $index;?>][combination]" value="<?= $Variation->combination;?>" />
                  <input type="hidden" name="CatalogProductVariation[<?= $index;?>][product_id]" value="<?= $model->id;?>" />
                  
                  </td>
                  <td><?php echo InputFile::widget([
                                        'language'      => 'en',
                                        'name'          => "CatalogProductVariation[$index][image]",
                                        'controller'    => 'elfinder', 
                                        'filter'        => 'image',
                                        'path'			=> '/product_images/',							
                                        'template'      => '<div class="input-group"><span>{image}</span><span class="input-group-btn" style="vertical-align:top;">{button}</span>{input}</div>',
                                        'options'       => ['class' => 'form-control','type'=>'hidden'],
                                        'buttonOptions' => ['class' => 'btn btn-default'],
                                        'multiple'      => false,
                                        'value'         => $Variation->image
                                        
                                        
                                    ]);
                        ?></td>
                  
                  
                  <td><?= Html::button('<i class="fa fa-trash"></i>', ['class' => "btn btn-sm",'onClick'=>'RemoveRow("variation-'.$index.'");' ]) ?></td>
                  </tr>
                <?php $index++; endforeach; ?>
            </tbody>
        </table>      
    
        </div>
        <div class="clearfix"></div>
</div>

<script>
var $last_variation=<?= $index;?>;
var $product_id=<?= $model->id;?>;
function AddToTable(ids){
    
    $price=$("#vriable_price").val();
    $image=$("#vriable_image").val();
    $combination="";
    $valid=true;
    if(!$price)
        $valid=false;
    $text="";
    $text="<tr id='variation-"+$last_variation+"'>";
    
        ids.forEach(function (item) { 
            if(!$( "#"+item ).val()){
                $valid=false;
            return false;
            }
           $text+="<td>"+$( "#"+item ).val()+"</td>";
           $combination+=$( "#"+item ).prop("name")+":"+$( "#"+item ).val()+"|";
        });
        
        
    
   
    
    if($valid){
        
     $inputs="<input type=\"hidden\" name=\"CatalogProductVariation["+$last_variation+"][combination]\" value=\""+$combination.slice(0, -1)+"\" /><input type=\"hidden\" name=\"CatalogProductVariation["+$last_variation+"][price]\" value=\""+$price+"\" /><input type=\"hidden\" name=\"CatalogProductVariation["+$last_variation+"][product_id]\" value=\""+$product_id+"\" /><input type=\"hidden\" name=\"CatalogProductVariation["+$last_variation+"][image]\" value=\""+$image+"\" />";
     $text+="<td>"+$price+$inputs+"</td>";
     
     $text+="<td><img class=\"thumbnail\" src=\" "+$image + " \" style=\"display: table-cell;height: 80px;width: 80px;vertical-align: middle;text-align: center;max-width: 80px; max-height: 80px;margin:0px;\"  /></td>";
     
     $text+="<td>"+'<button type="button" class="btn btn-sm" onclick="RemoveRow(\'variation-'+ $last_variation +'\');"><i class="fa fa-trash"></i></button></td>';
     
        $("#variationtable tbody").append($text);
   
        
        ids.forEach(function (item) { 
            $( "#"+item ).val("");
        });
        $("#vriable_price").val("");
        $("#vriable_image-thumb").attr("src", "");
        $("#vriable_image").val("");
         $last_variation++;
    }
    else
        alert("please select attributes options and price");
       
}

function RemoveRow(Id){
    
        $("#variationtable tbody tr#"+Id).remove();
}
</script>