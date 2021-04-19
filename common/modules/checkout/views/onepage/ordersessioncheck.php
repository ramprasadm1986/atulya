<?php

use yii\helpers\Url;
?>

<?php 
$getordersession=Url::to(['/checkout/onepage/getordersession']);
$js=<<<JS

setInterval(function(){

$.ajax({
		url: '$getordersession',
		type: "GET",
	
		success: function (result) {
		
			
			console.log(result);
		},
	
	});


}, 1000);

JS;
$this->registerJs($js);
?>
