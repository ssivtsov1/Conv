<?php

// Форма ввода данных для преобразования чисел
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

$this->title = 'Полезные инструменты';

//$this->params['breadcrumbs'][] = $this->title;
?>

<? $this->beginBlock('block1'); ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Ввод данных для разных задач </div>
            <div id="header_content_tagline">  </div>
        </div>
      <? echo Html::img('./conv.png'); ?>
        <!--<img src="./ulibka.gif">-->
    </div>

<? $this->endBlock(); ?>

<!--<div class="all_content">-->
<div class="form-group">
<!-- col-xs-5-->
    <div class="row">
        <div class="col-xs-5">
            <?php $form = ActiveForm::begin(['id' => 'index',
                'options' => [
                    'class' => 'form-horizontal col-xs-6',
                    'enctype' => 'multipart/form-data'
                    
                ]]); ?>
            <?= $form->field($model, 'txt')->textarea(['rows' => 20, 'cols' => 20]) ?>

            <div class="form-group">
                <?= Html::submitButton('OK', ['class' => 'btn btn-primary']); ?>

            </div>

            <?php

            ActiveForm::end(); ?>
        </div>
    </div>
</div>
  <?php

//    Вывод картинки в случайном порядке
    /*
        $n = rand(0,9);
        if($n<2)
        {
            echo Html::tag('div', Html::encode(' '), ['class' => 'side_content1']);
        }
        if(($n>1) && ($n<3))
        {
            echo Html::tag('div', Html::encode(' '), ['class' => 'side_content2']);
        }
        if($n>2 && $n<5)
        {
            echo Html::tag('div', Html::encode(' '), ['class' => 'side_content3']);
        }
        if($n>4 && $n<7)
        {
            echo Html::tag('div', Html::encode(' '), ['class' => 'side_content4']);
        }
        if($n>6 && $n<8)
        {
            echo Html::tag('div', Html::encode(' '), ['class' => 'side_content5']);
        }
        if($n>7)
        {
            echo Html::tag('div', Html::encode(' '), ['class' => 'side_content6']);
        }
    ?>
    */



    




