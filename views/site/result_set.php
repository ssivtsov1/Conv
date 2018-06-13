<?php

// Отображение показателей
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use yii\grid\GridView;
//use yii\grid\ActionColumn;
//use yii\grid\SerialColumn;
//use yii\widgets\DetailView;
$this->title = 'Результат:';
$this->params['breadcrumbs'][] = $this->title;

?>

<? $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Операции с множествами </div>
        <div id="header_content_tagline">  </div>
    </div>
</div>

<? $this->endBlock(); ?>

<div class="form-group">
    <h4><?= Html::encode($this->title) ?></h4>
    <table id="tbl_rez"  cellpadding="0" cellspacing="0" border=1>
        <tr class="tbl_row">
            <? if(!empty($r)) { ?>
            <th class="tbl_header"> Результат</th>
            <? } ?>
        </tr>

            <?php
//            debug($data);
//            return;
           $kol = count($data);
           if(!empty($data)) {
                for($i=0;$i<$kol;$i++){ 
                    $j=$i+1;
                    echo('<tr class="tbl_row">');
                    echo('<td width="3%">' . $j . '</td>');
                    echo('<td width="20%">' . $data[$i]['data'] . '</td>');
                    echo('</tr>');
           }}
          ?>

        </tr>
    </table>
            
   
    <?php
    
    // Кодирование файла
//    $handle = fopen('/home/user/work/Пароли/Алгоритм Флойда. Приклад використання алгоритму Флойда. _ mathros.html','r');
//    $fw = fopen('Алгоритм Флойда. Приклад використання алгоритму Флойда. _ mathros.cod','w+');
//    if ($handle) {
//    while (($r = fgets($handle, 4096)) !== false) {
//        $res = str_code($r,$shift,0);
//        fputs($fw,$res);
//    }
//    if (!feof($handle)) {
//        echo "Error: unexpected fgets() fail\n";
//    }
//    fclose($handle);
//    fclose($fw);
//    }
//    
//    // Декодирование файла
//    $handle = fopen('Алгоритм Флойда. Приклад використання алгоритму Флойда. _ mathros.cod','r');
//    $fw = fopen('Алгоритм Флойда. Приклад використання алгоритму Флойда. _ mathros.html','w+');
//    if ($handle) {
//    while (($r = fgets($handle, 4096)) !== false) {
//        $res = str_decode($r,$shift,0);
//        fputs($fw,$res);
//    }
//    if (!feof($handle)) {
//        echo "Error: unexpected fgets() fail\n";
//    }
//    fclose($handle);
//    fclose($fw);
//    }
     

    ?>        
</div>





