


    

    

    

    


    <?= $form->field($model, 'length')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'width')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'height')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'length_class')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'weight_class')->textInput(['maxlength' => true]) ?>

   

    

   

    

    

    <?= $form->field($model, 'related')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'up_sell')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'cross_sell')->textarea(['rows' => 6]) ?>

    

   

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>


