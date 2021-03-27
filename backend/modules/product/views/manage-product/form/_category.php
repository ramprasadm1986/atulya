<?php

use common\models\CatalogCategory;
use kartik\tree\TreeViewInput;

?>


<?= $form->field($model, 'categories')->widget(TreeViewInput::classname(),
											[
																					
											'query' =>CatalogCategory::find()->addOrderBy('root, lft'),
											'headingOptions' => ['label' => 'Categories'],
											'rootOptions' => ['label'=>'<span class="text-primary">Categories</span>'],
											'rootNodeCheckboxOptions'=>['class'=>'hide'],
											'topRootAsHeading' => true,
											'fontAwesome' => true,
											'asDropdown' => false,
											'multiple' => true,

											'options' => ['disabled' => false]
											])->label(false);
							?>