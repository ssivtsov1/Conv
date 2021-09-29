<?php

// Форма ввода данных для операций над множествами
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Полезные инструменты';
?>
<? $this->beginBlock('block1'); ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Операции над множествами</div>
            <div id="header_content_tagline">  </div>
        </div>
        <? echo Html::img('./Set_Operations.png'); ?>
        <!--<img src="./ulibka.gif">-->
    </div>
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
            
            <?= $form->field($model, 'a')->textarea(['rows' => 5, 'cols' => 45]) ?>
            <?= $form->field($model, 'b')->textarea(['rows' => 5, 'cols' => 45]) ?>
            <?= $form->field($model, 'oper')->
                dropDownList([1 => 'объединение',2 => 'пересечение',
                    3 => 'разность A-B', 4 => 'разность B-A', 5 => 'инверсия пересечения' ]) ?>

            <div class="form-group">
                <?= Html::submitButton('OK', ['class' => 'btn btn-info']); ?>

            </div>

            <?php

            ActiveForm::end(); ?>
        </div>
    </div>
</div>
  <?php



    




