<?php

// Отображение показателей
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;

$this->title = 'Результат преобразования:';
$this->params['breadcrumbs'][] = $this->title;
?>

<? $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Результат выполнения: </div>
        <div id="header_content_tagline">  </div>
    </div>
</div>

<? $this->endBlock(); ?>


<div class="form-group">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php
//        debug($kol);
//        return 1;
    $sql = 'select dat1,dat2 from arr order by dat2 desc';
    
    //echo "Всего данных:$kol";
    echo "<br>";
//    for($i=0;$i<$kol;$i++){
//        echo $arr['src'][$i];
//        echo "<br>";
//    }
//    echo "<br>";
  
    $res = a2sql($sql,$arr);
    debug($res);
    ?>
</div>





