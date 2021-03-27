<?php
use yiister\gentelella\widgets\Panel;
use ramprasadm1986\elfinder\InputFile;
use ramprasadm1986\elfinder\ElFinder;
use yii\web\JsExpression;
use kartik\widgets\SwitchInput;


?>




<?= $form->field($node, 'description')->textArea();?>
<?= $form->field($node, 'slug')->textInput(['maxlength' => true]);?>
<?= $form->field($node, 'image')->widget(InputFile::className(), [
								'language'      => 'en',
								'controller'    => 'elfinder', 
								'filter'        => 'image',
								'path'			=> '/category_images/',							
								'template'      => '<div class="input-group"><span>{image}</span><span class="input-group-btn" style="vertical-align:top;">{button}</span>{input}</div>',
								'options'       => ['class' => 'form-control','type'=>'hidden'],
								'buttonOptions' => ['class' => 'btn btn-default'],
								'multiple'      => false,
								'defaultImage' 	=> Yii::getAlias('@storageUrl').'/default/default_category.png',
								
							]);
							?>
<?= $form->field($node, 'include_in_menu')->widget(SwitchInput::classname(), []) ?>
<?php if(!$node->readonly) : ?>
<?= $form->field($node, 'active')->widget(SwitchInput::classname(), []) ?>
<?php endif;?>
 <?php Panel::end() ?> 