<?php

// Форма ввода данных для проверки раскладки клавиатуры
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Полезные инструменты';
?>
<? $this->beginBlock('block1'); ?>
<? if($vid==1): ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Сравнение строк </div>
            <div id="header_content_tagline">  </div>
        </div>
         <? echo Html::img('./cmp_str.jpg'); ?>
        <!--<img src="./ulibka.gif">-->
    </div>
<? endif; ?>


<? $this->endBlock(); ?>

<!--<div class="all_content">-->
<div class="form-group">
<!-- col-xs-5-->
    <div class="row">
        <div class="col-xs-5">
            <?php $form = ActiveForm::begin(['id' => 'symbol',
                'options' => [
                    'class' => 'form-horizontal col-xs-6',
                    'enctype' => 'multipart/form-data'
                    
                ]]); ?>
            <?= $form->field($model, 'str1')->textarea(['rows' => 7, 'cols' => 85]) ?>
            <?= $form->field($model, 'str2')->textarea(['rows' => 7, 'cols' => 85]) ?>

            <div class="form-group">
                <?= Html::submitButton('OK', ['class' => 'btn btn-info']); ?>

            </div>

            <?php

            ActiveForm::end(); ?>
        </div>
    </div>
</div>
  <?php



    




