<?php

// Форма ввода данных для проверки раскладки клавиатуры
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Полезные мелочи';
?>
<? $this->beginBlock('block1'); ?>
<? if($vid==1): ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Кодирование файла </div>
            <div id="header_content_tagline">  </div>
        </div>
        <img src="./ulibka.gif">
    </div>
<? endif; ?>

<? if($vid==2): ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Раскодирование файла </div>
            <div id="header_content_tagline">  </div>
        </div>
        <img src="./ulibka.gif">
    </div>
<? endif; ?>

<? $this->endBlock(); ?>

<div class="form-group">
<!-- col-xs-5-->
    <div class="row">
        <div class="col-xs-5">
            
            <?php $form = ActiveForm::begin(['id' => 'symbol',
                'options' => [
                    'class' => 'form-horizontal col-xs-6',
                    'enctype' => 'multipart/form-data'
                    
                ]]); ?>
            
            <?= $form->field($model, 'passwd')->textarea(['rows' => 1, 'cols' => 30]) ?>
            <?= $form->field($model, 'file')->fileInput(); ?>
            
             <?php if($vid==1): ?>
                <?= "Закодированный файл будет находиться в папке Загрузки или Download под именем result.cod";?>
            <?php endif; ?>
             <?php if($vid==2): ?>
                <?= "Раскодированный файл будет находиться в папке Загрузки или Download под именем result.decod";?>
             <?php endif; ?>
            <br>
            <br>
            <div class="form-group">
                <?= Html::submitButton('OK', ['class' => 'btn btn-info']); ?>

            </div>
             
            <?php

            ActiveForm::end(); ?>
        </div>
    </div>
</div>
  <?php



    




