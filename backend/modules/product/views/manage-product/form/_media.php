<?php

use ramprasadm1986\elfinder\InputFile;
use ramprasadm1986\elfinder\ElFinder;
use yii\web\JsExpression;


?>

<?= $form->field($model, 'base_image')->widget(InputFile::className(), [
								'language'      => 'en',
								'controller'    => 'elfinder', 
								'filter'        => 'image',
								'path'			=> '/product_images/',							
								'template'      => '<div class="input-group"><span>{image}</span><span class="input-group-btn" style="vertical-align:top;">{button}</span>{input}</div>',
								'options'       => ['class' => 'form-control','type'=>'hidden'],
								'buttonOptions' => ['class' => 'btn btn-default'],
								'multiple'      => false,
								'defaultImage' 	=> Yii::getAlias('@storageUrl').'/default/default_product.png',
								
							]);
							?> 

<?= $form->field($model, 'gallery_images')->widget(InputFile::className(), [
								'language'      => 'en',
								'controller'    => 'elfinder', 
								'filter'        => 'image',
								'path'			=> '/product_images/',							
								'template'      => '<div class="input-group">{image}<span class="input-group-btn" style="vertical-align:top;">{button}</span>{input}</div>',
								'options'       => ['class' => 'form-control','type'=>'hidden'],
								'buttonOptions' => ['class' => 'btn btn-default'],
								'multiple'      => true,
								'defaultImage' 	=> Yii::getAlias('@storageUrl').'/default/default_product.png',
								
							]);
							?> 