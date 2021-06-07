<?php

use yii\helpers\Html;
use kartik\widgets\ActiveForm;
use kartik\tabs\TabsX;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $model common\models\CatalogProduct */
/* @var $form yii\widgets\ActiveForm */
?>
<style>
.form-header {
  padding: 10px 16px;
  background: #fff;
 
}

.sticky {
  position: fixed;
  top: 0;
  width: 100%;
}

.sticky + .form-content {
  padding-top: 102px;
}
</style>
<div class="catalog-product-form">

    <?php 
    
        $form = ActiveForm::begin(['id'=>'product_create']);


?>

  
    <div class="row">
        <div class="form-group col-md-12 col-sm-12 col-xs-12 form-header" id="form-header">
                <div class="pull-right">
                    <?= Html::resetButton('<i class="fa fa-refresh"></i> Reset', ['class' => 'btn btn-app']) ?>
                    <?= Html::hiddenInput('saveandcontinue',0,['id'=>'saveandcontinue']); ?>
                    <?= Html::submitButton('<i class="fa fa-save"></i> Save', ['class' => 'btn btn-app']) ?>
                    <?= Html::button('<i class="fa fa-save"></i> Save & Continue', ['class' => 'btn btn-app','onClick'=>'SaveAndContinue();']) ?>
                </div>
        </div>
        <div class="form-group col-md-12 col-sm-12 col-xs-12 form-content">
        
        <?php
        if($model->type=="variable")
            $attributs=[
                
                    [
    
                        'label' => 'Attributes',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_attribute', ['form' => $form,'model'=>$model,'CPAttributes'=>$CPAttributes,'CPOptions'=>$CPOptions]),


                    ],
                    [
    
                        'label' => 'Variations',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_variations', ['form' => $form,'model'=>$model,'CPAttributes'=>$CPAttributes,'CPOptions'=>$CPOptions,'CPVariation'=>$CPVariation]),


                    ]                    
            
            ];
        else
             $attributs=[];
            ?>
            <?=
             TabsX::widget([
             
             'position'=>TabsX::POS_ABOVE,
             'bordered'=>true,

            'items' => ArrayHelper::merge( [

                    [

                        'label' => 'General',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_general', ['form' => $form,'model'=>$model]),


                    ],
                    [

                        'label' => 'Content',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_content', ['form' => $form,'model'=>$model]),


                    ],
                    [

                        'label' => 'Images /Videos',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_media', ['form' => $form,'model'=>$model]),           

                     

                    ],
                    [

                        'label' => 'Size Chart',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_sizechart', ['form' => $form,'model'=>$model]),           

                     

                    ],
                    [

                        'label' => 'Categories',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_category', ['form' => $form,'model'=>$model]),           

                     

                    ],
                    [

                        'label' => 'SEO',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_seo', ['form' => $form,'model'=>$model]),


                    ],
                    [

                        'label' => 'Tax',

                        'content' => $this->render('@backend/modules/product/views/manage-product/form/_tax', ['form' => $form,'model'=>$model]),


                    ]

                    

            ],$attributs),

        ]);
            ?>
        </div>
    <div class="clearfix"></div>
    </div>

    <?php ActiveForm::end(); ?>


<?php
$script=<<<JS
$('#product_create').on('afterValidate', function(event, messages, errorAttributes){
    
  if(errorAttributes.length > 0) {
    var errElement = $('#' + errorAttributes[0].id);
    
    var pane = errElement.closest('.tab-pane');
    
    var tabId = pane[0].id;
    $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
    return false;
  }
});


$("#product_create .has-error").each(function() {
       
        var pane = $(this).closest('.tab-pane');
        var tabId = pane[0].id;
        $('.nav-tabs a[href="#' + tabId + '"]').tab('show');
        return false;
     });

JS;
$this->registerJs($script);
?>

<script> 
    function SaveAndContinue() {
   
    $("#saveandcontinue").val(1);
    $("#product_create").submit();
}
window.onscroll = function() {myFunction()};

var header = document.getElementById("form-header");
var sticky = header.offsetTop;

function myFunction() {
  // if (window.pageYOffset > sticky) {
    // header.classList.add("sticky");
  // } else {
    // header.classList.remove("sticky");
  // }
}
</script>
</div>
