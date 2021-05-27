<?php

use ramprasadm1986\elfinder\InputFile;
use ramprasadm1986\elfinder\ElFinder;
use yii\web\JsExpression;


?>

<?= $form->field($model, 'size_chart')->widget(InputFile::className(), [
								'language'      => 'en',
								'controller'    => 'elfinder', 
								'filter'        => 'image',
								'path'			=> '/size_chart/',							
								'template'      => '<div class="input-group"><span>{image}</span><span class="input-group-btn"              style="vertical-align:top;">{button}</span>{input}</div>',
								'options'       => ['class' => 'form-control','type'=>'hidden'],
								'buttonOptions' => ['class' => 'btn btn-default'],
								'multiple'      => false,
								
								
							]);
							?> 

