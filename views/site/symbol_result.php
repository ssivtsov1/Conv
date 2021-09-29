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
    <div id="header"> <div class="header_content_mainline"> Результат проверки символов </div>
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
    <table id="tbl_rez"  cellpadding="0" cellspacing="0" border=1>
        <tr class="tbl_row">

            <?php
//            Отображение № символа в шапке таблицы
            //echo chr(1442);
            $r = $model->str;
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
           <tr class="tbl_row">
            <?php
            if(!empty($r)) {
                //  Отображение кода каждого символа
                for($i=0;$i<$kol;$i++) {
                                                            
                    $s = mb_substr($r,$i,1,"UTF-8");
                    $c = uniord($s);  // Получение UTF-8 кода символа
                    echo('<td align="center">' . $c . '</td>');
                }}
          ?>
           </tr>
           
    </table>


</div>





