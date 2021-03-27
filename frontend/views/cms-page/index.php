<?php
use yii\helpers\Html;

$this->title = Yii::t('app', $page->title);
?>
<section class="hero">
    <div class="container">
        <div class="row">
        <h1><?=$this->title;?></h1>
        <br>
        <?= $page->content;?>
        </div>
    </div>
    <div class="container">

    </div>
</section>