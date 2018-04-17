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
        На этом сайте реализовано несколько программ, которые облегчают жизнь IT-специалистов.
        <br>
        <br>
        1. Программа конвертации преобразует набор чисел в разные системы счисления
           (десятичную, шестьнадцатиричную, восьмеричную и двоичную).
        <br>
        2. Программа проверки кодов символов в строке, для выявления таких символов как 'с' или 'i',
           которые выглядят одинаково как в русской - так и в английской раскладке.
       <br>
        3. Программа поиска информации на серверах PostGreSQL и MySQL. На сервере PostGreSQL
           можно искать по всем объектам сервера
           и на всех РЭСах и во всех базах.
    </p>
    </div>

    <code><?//= __FILE__ ?></code>
</div>
