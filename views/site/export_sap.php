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
        <div id="header"> <div class="header_content_mainline"> Експорт в САП </div>
            <div id="header_content_tagline">  </div>
        </div>
      <?
      $r=mt_rand(1,100);
//      if($r%2==0)
//         echo Html::img('./eksport.jpg', ['class' => 'img_exportsap']);
//      else
//          echo Html::img('./export_sap.jpeg', ['class' => 'img_exportsap']);

     if($r>=1 && $r<34) {
         echo Html::img('./eksport.jpg', ['class' => 'img_exportsap']);
     }
      elseif ($r>=34 && $r<67){
          echo Html::img('./export_sap.jpeg', ['class' => 'img_exportsap']);
      }
     else {
         echo Html::img('./export.png', ['class' => 'img_exportsap']);
     }
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
                    '3' => 'CONNOBJ_IND [Споживачі побутові]',
                    '4' => 'CONNOBJ [Споживачі юридичні]',
                    '5' => 'PREMISE_IND [Споживачі побутові]',
                    '6' => 'PREMISE [Споживачі юридичні]',
                    '7' => 'ACCOUNT [Споживачі юридичні]',
                    '8' => 'ACCOUNT_IND [Споживачі побутові]',
                    '9' => 'DEVLOC  [Споживачі юридичні]',
                    '10' => 'DEVLOC_IND  [Споживачі побутові]',
                    '11' =>'DEVICE_IND  [Споживачі побутові]',
                    '12' =>'DEVICE  [Споживачі юридичні]',
                    '13' =>'SEALS_IND  [Споживачі побутові]',
                    '14' =>'SEALS  [Споживачі юридичні]',
//                    '15' =>'SEALS2  [Споживачі юридичні]',
                    '16' =>'INSTLN_IND  [Споживачі побутові]',
                    '17' =>'INSTLN  [Споживачі юридичні]',
                    '18' =>'FACTS  [Споживачі юридичні]',
                    '19' =>'FACTS_IND  [Споживачі побутові]',
                    '20' =>'INST_MGMT_IND  [Споживачі побутові]',
                    '21' =>'MOVE_IN_IND  [Споживачі побутові]',
                    '22' =>'DISC_DOC_IND  [Споживачі побутові]',
                    '23' =>'DISC_ORDER_IND  [Споживачі побутові]',
                    '24' =>'DISC_ENTER_IND  [Споживачі побутові]',
                    '25' =>'ZLINES  [Споживачі юридичні]',
                    '26' =>'ZTRANSF  [Споживачі юридичні]',
                    '27' =>'INST_MGMT  [Споживачі юридичні]',
                    '28' =>'DEVGRP  [Споживачі юридичні]',
                    '29' =>'MOVE_IN  [Споживачі юридичні]',
                    '31' =>'ZSIGN_CA  [Споживачі юридичні]',
                    '32' =>'ZPAY_CA  [Споживачі юридичні]',
                    '33' =>'INSTLNCHA  [Споживачі юридичні]',
                    '34' =>'DOCUMENT  [Споживачі юридичні]',
                    '40' =>'DOCUMENT_POST  [Споживачі юридичні Днепр]',
                    '41' =>'DOCUMENT_ADD   [Споживачі юридичні Днепр]',
                    '35' =>'DISC_DOC  [Споживачі юридичні]',
                    '36' =>'DISC_ORDER  [Споживачі юридичні]',
                    '37' =>'DISC_ENTER  [Споживачі юридичні]',
                    '30' =>'Всі  [Споживачі побутові]',
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



    




