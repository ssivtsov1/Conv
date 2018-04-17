<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
//$this->title = 'Полезные инструменты:';
//$this->params['breadcrumbs'][] = $this->title;
?>
<? $this->beginBlock('block1'); ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Полезные инструменты </div>
            <div id="header_content_tagline">  </div>
        </div>
      <? echo Html::img('./tools.jpeg'); ?>
        <!--<img src="./ulibka.gif">-->
    </div>

<? $this->endBlock(); ?>

<div class="form-group main_blk">
    <h2><?= Html::encode($this->title) ?></h2>

    <div class="base_head">
    <p>
        С помощью этого сайта можно делать много разных полезных рассчетов.
        На данный момент реализованы:<br><br>
        1. Преобразователь чисел в разные системы счисления
        (десятичную, шестьнадцатиричную, восьмеричную и двоичную).
        <br>
        2. Программа проверки кодов символов в строке, для выявления таких символов как 'с' или 'i',
        которые выглядят одинаково как в русской - так и в английской раскладке.
        
        <br>
        3. Программа поиска информации на серверах PostGreSQL и MySQL. На сервере PostGreSQL
           можно искать по всем объектам сервера
           на всех РЭСах и во всех базах.
    </p>
    </div>

    <code><?//= __FILE__ ?></code>
</div>
