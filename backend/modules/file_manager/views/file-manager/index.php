<?php

use ramprasadm1986\elfinder\ElFinder;

/* @var $this yii\web\View */

$this->title = Yii::t('backend', 'Files Manager');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="file-manager-index">


    <?php  echo ElFinder::widget([
        'controller' => 'elfinder',
        'containerOptions' => ['style' => 'height: 500px;'],
        'frameOptions' => ['style' => 'min-height: 500px; width: 100%; border: 0'],
    ])  ?>

</div>
