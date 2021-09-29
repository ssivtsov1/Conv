<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Результат кодирования:';
$this->params['breadcrumbs'][] = $this->title;

?>

<? $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Кодирование файла </div>
        <div id="header_content_tagline">  </div>
    </div>
</div>

<? $this->endBlock(); ?>

<?php
   
    
    $shift = passwd2num($p);
    // Кодирование файла   
    if($mode==1) {
    $handle = fopen($file,'r');
    $pos_point = mb_strrpos($file, ".",'UTF-8'); 
        
    //$new_file = mb_substr($file,0,$pos_point,'UTF-8').'.cod';
    $new_file = 'result.cod';
    $fw = fopen($new_file,'w+');
    if ($handle) {
    while (($r = fgets($handle, 4096)) !== false) {
        $res = str_code($r,$shift,0);
        fputs($fw,$res);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
    fclose($fw);
    }
    unlink($file);
    Yii::$app->response->sendFile($new_file);
    }
    
    // Декодирование файла
    if($mode==2) {
    $handle = fopen($file,'r');
    $pos_point = mb_strrpos($file, ".",'UTF-8'); 
        
    //$new_file = mb_substr($file,0,$pos_point,'UTF-8').'.cod';
    $new_file = 'result.decod';
    $fw = fopen($new_file,'w+');
    if ($handle) {
    while (($r = fgets($handle, 4096)) !== false) {
        $res = str_decode($r,$shift,0);
        fputs($fw,$res);
    }
    if (!feof($handle)) {
        echo "Error: unexpected fgets() fail\n";
    }
    fclose($handle);
    fclose($fw);
    }
    unlink($file);
    Yii::$app->response->sendFile($new_file);
    }
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





