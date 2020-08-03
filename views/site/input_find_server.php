<?php

// Форма ввода данных для преобразования чисел
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use yii\bootstrap\Modal;

$this->title = 'Поиск на сервере';
$this->params['breadcrumbs'][] = $this->title;
?>

<? $this->beginBlock('block1'); ?>
    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Поиск на сервере PostGreSQL</div>
            <div id="header_content_tagline">  </div>
        </div>
        <? echo Html::img('./search3.jpeg'); ?>
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
            
             <?php
             echo $form->field($model, 'server')->dropDownList([
                '1' => 'Тестовый',
                '2' => 'Реальный',
                '3' => 'Кол-центр'
             ],['onchange' => 'show_net($(this).val())']);
                
                 
             echo $form->field($model, 'net')->dropDownList([
                '1' => 'Сеть-1',
                '2' => 'Сеть-2',
                
                 ]);
             echo $form->field($model, 'res')->dropDownList([
                '1' => 'Апостолово',
                '2' => 'Вольногорск',
                '3' => 'Гвардейское',
                '4' => 'Днепропетровск',
                '5' => 'Ингулец',
                '6' => 'Желтые Воды',
                '7' => 'Кривой Рог',
                '8' => 'Павлоград',
                
                 ]);
              
              echo $form->field($model, 'db')->dropDownList([
                '1' => 'Abn',
                '2' => 'Energo',
                
                 ]);
              
              echo $form->field($model, 'fwhere')->dropDownList([
                '1' => 'в таблицах',
                '2' => 'в функциях',
                '3' => 'в триггерах',
                 ],['onchange' => 'show_f($(this).val())']);
              
               echo $form->field($model, 'vid')->dropDownList([
                '1' => 'значение в колонке',
                '2' => 'название колонки',
                 ],['onchange' => 'show_f1($(this).val())']);
              
              echo $form->field($model, 'type')->dropDownList([
                '1' => 'строка',
                '2' => 'дата',
                '3' => 'число',
                
                 ]);
             ?>
            
            <?= $form->field($model, 'search')->textarea(['rows' => 3, 'cols' => 3]) ?>
            <?= $form->field($model, 'break')->checkbox() ?>
            <div class="form-group">
                <?= Html::submitButton('OK', ['class' => 'btn btn-primary']); ?>
                
                <?php
                Modal::begin([
                'header' => '<h3>Помощь для поиска на сервере</h3>',
                'toggleButton' => [
                'label' => '?',
                'tag' => 'button',
                'class' => 'btn btn-info',
                ]
                ]);

                ?>
                    <div class="modal_help">
                   Для поиска названий таблиц, где встречается указанная колонка - нужно выбрать
                   "Вид данных"->"название колонки" и ввести в поле "Данные для поиска" поисковое название.
                   <p>При поиске по числовым данным нужно выбрать тип данных "Число".
                   Числа можно вводить либо одно, либо
                       списком, например: 100,120,1000
                   или же можно указать диапазон, например от 100 до 200, пишем так: 100--200
                   Но списки и диапазоны можно применять только для чисел.
                   Так как таблиц с числовыми полями на сервере очень много, то поиск по числовым полям может работать долго.</p>
                   <p>Для поиска по датам выбираем тип данных "Дата" и в поле "Данные для поиска" вводим дату
                       в обычном формате, например: 20.02.2018.</p>
                   </div>     
                <?php
                    Modal::end();
                ?>

            </div>

            <?php

            ActiveForm::end(); ?>
        </div>
    </div>
</div>
<script>
    function show_f(p){
        var q=$('#input_find_server-vid').val();
        //alert(p);
        if(p!=1)
        {
            $('.field-input_find_server-vid').hide();
            $('.field-input_find_server-type').hide();
        }
        else{
            $('.field-input_find_server-vid').show();
            $('.field-input_find_server-type').show();
        }
        if((p==1) && (q==2)){
            $('.field-input_find_server-type').hide();
        }
    }
    
    function show_f1(p){
        var q=$('#input_find_server-fwhere').val();
        //alert(q);
        
        if((p==2) && (q==1))
            $('.field-input_find_server-type').hide();
        else  
            $('.field-input_find_server-type').show();
       
    }
    function show_net(p){
               
        if(p==2) 
            $('.field-input_find_server-net').hide();
        else  
            $('.field-input_find_server-net').show();
       
    }
</script>


    




