<!DOCTYPE html>
<?php

use yii\helpers\Url;

?>

<html lang="en">

  <head>

    <meta charset="utf-8" />

  
    <meta name="viewport" content="width=device-width, initial-scale=1" />

  
    

   <?php if($redirect): ?>
    <script>
       
       setTimeout(function(){
        window.location = '<?php echo $paynimo;?>';
        }, 1000);
    </script>
    <?php else :?>
    <script>
       
       setTimeout(function(){
        window.location = '<?php echo Yii::$app->response->redirect(Url::to(['/cart'], true));?>';
        }, 5000);
    </script>
   <?php endif; ?>

  </head>

  <body>
    Please Wait....
    <br />
    Redirecting
    <?php print_r($OrderIdentifire);?>
    <br />
    <?php if(!$redirect): ?>
    <pre>
    <php  print_r($paynimo); ?>
    <?php print_r($responseDetails);?>
    <?php print_r($transactionRequestBean);?>
    </pre>
    <?php endif;?>
    
   
  </body>

</html>
