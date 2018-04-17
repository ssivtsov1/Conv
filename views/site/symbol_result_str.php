<?php

// Отображение показателей
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;

//$this->title = 'Результат проверки символов:';
//$this->params['breadcrumbs'][] = $this->title;
?>

<? $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Результат сравнения строк </div>
        <div id="header_content_tagline">  </div>
    </div>
</div>

<? $this->endBlock(); ?>


<div class="form-group">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php
//        debug($kol);
//        return 1;

    ?>
    <h4><?= Html::encode("Строка1: ".$model->str1) ?></h4>
    <h4><?= Html::encode("Строка2: ".$model->str2) ?></h4>
    
    <table id="tbl_rez"  cellpadding="0" cellspacing="0" border=1>
        <tr class="tbl_row">

            <?php
//            Отображение № символа в шапке таблицы
            $r = trim($model->str1);
            $kol = mb_strlen($r,"UTF-8");
            if(!empty($r)) {
                for ($i = 1; $i <= $kol; $i++) {
                    echo("<th class='tbl_header'>$i</th>");
                }
            }
            ?>
            </tr>
            <tr class="tbl_row">
            <?php

            if(!empty($r)) {
                //  Отображение символа в таблице
                for($i=0;$i<$kol;$i++) {
                    $s = mb_substr($r,$i,1,"UTF-8");
                    echo('<td>' . $s . '</td>');
            }}
            ?>
            </tr>
            <tr class="tbl_row">
            <?php
            if(!empty($r)) {
                //  Отображение раскладки для каждого символа
                for($i=0;$i<$kol;$i++) {
                    $s = mb_substr($r,$i,1,"UTF-8");
                    $c = ord($s);
                    $raskl = How_code($c);
                    echo('<td align="center">' . $raskl . '</td>');
                }}
          ?>
           </tr>
                     
    </table>

    
    <div class="clear_fix">
        <p>Различия:</p>    
    </div>
    
    <table id="tbl_rez1"  cellpadding="0" cellspacing="0" border=1>
        <tr class="tbl_row">

            <?php
//            Отображение № символа в шапке таблицы
            $r = trim($model->str1);
            $q = trim($model->str2);
            $kol1 = mb_strlen($r,"UTF-8");
            $kol2 = mb_strlen($q,"UTF-8");
            $flag=0;
            if($kol1==$kol2) {
                echo("<th class='tbl_header'>№ символа</th>");
                echo("<th class='tbl_header'>1-я строка</th>");
                echo("<th class='tbl_header'>2-я строка</th>");
                echo('</tr>');
                echo('<tr class="tbl_row1">');
                for ($i = 0; $i < $kol1; $i++) {
                   $c1=mb_substr($r,$i,1,"UTF-8");
                   $c2=mb_substr($q,$i,1,"UTF-8");
                   $j=$i+1;
                   if($c1<>$c2) {
                       $flag=1;
                       echo('<td>' . $j . '</td>');
                       echo('<td>' . $c1 . " [".ord($c1)."]".'</td>');
                       echo('<td>' . $c2 . " [".ord($c2)."]".'</td>');
                       echo('</tr>');
                       echo('<tr class="tbl_row1">');
                   }
                   
                }
            }
            else 
                echo('<td>' . "Строки разные по длине" . '</td>');
            
            if($flag==0 && ($kol1==$kol2)) {
                echo('<td>' . "Строки одинаковые" . '</td>');
                echo('<td>' . "Строки одинаковые" . '</td>');
                echo('<td>' . "Строки одинаковые" . '</td>');
            }
            
           ?>
           </tr>
           
    </table>


</div>





