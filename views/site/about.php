<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'О программе:';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-group">
<!--    <h2>--><?//= Html::encode($this->title) ?><!--</h2>-->

    <h4 class="about">
    <p>
        На этом сайте реализовано несколько программ, которые облегчают жизнь IT-специалистов.
        <br>
        <br>
        1. Программа конвертации преобразует набор чисел в разные системы счисления
           (десятичную, шестьнадцатиричную, восьмеричную и двоичную).
        <br>
        2. Программа проверки кодов символов в строке, для выявления таких символов как с или i,
           которые выглядят одинаково как в русской - так и в английской раскладке.
    </p>
    </h4>

    <code><?//= __FILE__ ?></code>
</div>
