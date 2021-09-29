<?php

// Форма ввода данных для проверки раскладки клавиатуры
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Полезные инструменты';
?>
<? $this->beginBlock('block1'); ?>



    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Добавление вопросов в опросник </div>
            <div id="header_content_tagline">  </div>
        </div>
        <img src="./ulibka.gif">
    </div>


<? $this->endBlock(); ?>

<!--<div class="all_content">-->
<div class="form-group">
<!-- col-xs-5-->
    <div class="row">
        <div class="col-xs-6">
            <?php $form = ActiveForm::begin(['id' => 'symbol',
                'options' => [
                    'class' => 'form-horizontal col-xs-6',
                    'enctype' => 'multipart/form-data'
                    
                ]]); ?>
            <p>Питання записано</p>
            <div class="form-group">
<!--                --><?//= Html::submitButton('OK', ['class' => 'btn btn-info']); ?>
            <?php if($v==1): ?>
                <?= Html::a( 'Записати ще?',['form_quest'],
                    ['class' => 'btn btn-primary']); ?>
                <?= Html::a( 'Ні',['form_no'],
                    ['class' => 'btn btn-primary']); ?>

            <?php endif; ?>
            </div>

            <?php

            ActiveForm::end(); ?>
        </div>
    </div>
</div>
  <?php



    




