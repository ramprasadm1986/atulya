<?php

use common\widgets\Alert;

?>

<?php if(Yii::$app->controller->action->id!="index" && Yii::$app->controller->id!="site") { ?>
      <section class="hero">
         <div class="container">
           
            <?= Alert::widget() ?>
         </div>
      </section>
<?php }
    
else if(Yii::$app->controller->action->id!="index" && Yii::$app->controller->id=="site") { ?>
      <section class="hero">
         <div class="container">
           
            <?= Alert::widget() ?>
         </div>
      </section>
<?php }

 ?>
<?= $content ?>