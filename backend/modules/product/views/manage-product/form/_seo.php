

<?= $form->field($model, 'slug')->textInput(['maxlength' => true]) ?>

<?= $form->field($model, 'meta_title')->textInput(['rows' => 6]) ?>

<?= $form->field($model, 'meta_keywords')->textarea(['rows' => 6]) ?>

<?= $form->field($model, 'meta_description')->textarea(['rows' => 6]) ?>