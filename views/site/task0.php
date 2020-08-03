<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'О программе:';
//$this->params['breadcrumbs'][] = $this->title;
?>
<? $this->beginBlock('block1'); ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> О сайте </div>
            <div id="header_content_tagline">  </div>
        </div>
      <? echo Html::img('./about.png'); ?>
        <!--<img src="./ulibka.gif">-->
    </div>

<? $this->endBlock(); ?>
<div class="form-group about_site">
<!--    <h2>--><?//= Html::encode($this->title) ?><!--</h2>-->

    <div class="base_head">
    <p>
        Моя задача
    </p>
    </div>

    <code><?//= __FILE__ ?></code>
</div>
