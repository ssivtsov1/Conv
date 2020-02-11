
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
        <div id="header"> <div class="header_content_mainline"> Експорт idfile в САП </div>
            <div id="header_content_tagline">  </div>
        </div>
      <?
      $r=mt_rand(1,100);
      if($r%2==0)
         echo Html::img('./Data-Export-icon.png', ['class' => 'img_exportsap']);
      else
          echo Html::img('./Data-Export-icon.png', ['class' => 'img_exportsap']);
      ?>
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
            <?= $form->field($model, 'rem')
                ->dropDownList([
                    '1' => 'Дніпро',
                    '2' => 'Жовті Води',
                    '3' => 'Вільногірськ',
                    '4' => 'Павлоград',
                    '5' => 'Кривий Ріг',
                    '6' => 'Апостолово',
                    '7' => 'Гвардійське',
                    '8' => 'Інгулець',
                ],
                    [
                        'prompt' => 'Виберіть РЕМ'
                    ]);?>
            <?= $form->field($model, 'id_oper')
                ->dropDownList([
                    '1' => 'PARTNER_IND [Споживачі побутові]',
                    '2' => 'PARTNER [Споживачі юридичні]',
                    '3' => 'PREMISE_IND [Споживачі побутові]',
                    '4' => 'PREMISE [Споживачі юридичні]',
                    '5' => 'ACCOUNT_IND [Споживачі побутові]',
                    '6' => 'ACCOUNT [Споживачі юридичні]',
                    '7' => 'DEVLOC_IND [Споживачі побутові]',
                    '8' => 'DEVLOC [Споживачі юридичні]',
                    '9' => 'DEVICE_IND [Споживачі юридичні]',
                    '10' => 'DEVICE [Споживачі юридичні]',
                    '11' =>'SEALS_IND  [Споживачі побутові]',
                    '12' =>'SEALS  [Споживачі юридичні]',
                    '13' =>'SEALS2  [Споживачі юридичні]',
                    '14' =>'INSTLN_IND  [Споживачі побутові]',
                    '15' =>'FACTS_IND  [Споживачі побутові]',
                    '16' =>'MOVE_IN_IND  [Споживачі побутові]',
                ],
                    [
                        'prompt' => 'Виберіть файл для формування'
                    ]);?>
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



