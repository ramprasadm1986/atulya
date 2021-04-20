<?php

/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\models\Cart;
use edwinhaq\simpleloading\SimpleLoading;
if(Yii::$app->session->get('CartIdentifire')!=""){
	$CartIdentifire = Yii::$app->session->get('CartIdentifire');
}else{
	$CartIdentifire = "";
}
$cart_obj = new Cart();
$cartdetails = $cart_obj->getHeadercartdetails($CartIdentifire);
$no_cartitem = $cartdetails['Totalcartitem'];
$cartamount = $cartdetails['Totalamount'];

$imageurl=Yii::$app->homeUrl.'/';
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script>
    <?php $currency_Symbol=Yii::getAlias('@currency'); ?>
	var HOME_URL	='<?=Yii::$app->homeUrl;?>';
	var STORAGE_URL	='<?=Yii::getAlias('@storageUrl');?>';
    var currency_Symbol="<?php echo $currency_Symbol;?>";
	</script>
</head>
<body>
<?php $this->beginBody() ?>
<?php SimpleLoading::widget(); ?>
<?= $this->render('_header.php') ?>

<?= $this->render('_content.php',['content' => $content]) ?>

<?= $this->render('_footer.php') ?>   
<?php 
$crsf=\yii\helpers\Json::encode([\yii::$app->request->csrfParam => \yii::$app->request->csrfToken]);
$this->registerJs("
        $.ajaxSetup({
        data:$crsf});");
        
?>
<?php $this->endBody() ?>
<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/607ec80c5eb20e09cf34cbcd/1f3njqtei';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->
</body>
</html>
<?php $this->endPage() ?>
