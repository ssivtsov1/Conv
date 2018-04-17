<?php

// Отображение показателей
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;

$this->title = 'Результат поиска:';
$this->params['breadcrumbs'][] = $this->title;
?>

<? $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Результат поиска </div>
        <div id="header_content_tagline">  </div>
    </div>
</div>

<? $this->endBlock(); ?>


<div class="form-group">
    <h4><?= Html::encode($this->title) ?></h4>
    <?php
    $flag=0;
    if(!empty($r)){
    while ($u = current($r)) {
        if(key($r[0])=='proname'){
            $flag=1;
            break;
        }
        if(key($r[0])=='trigger'){
            $flag=2;
            break;
        }
        next($r);
        }
    
    }
    
   
    ?>
    <table id="tbl_rez"  cellpadding="0" cellspacing="0" border=1>
        <tr class="tbl_row">
            <? if(!empty($r)) { ?>
            <th class="tbl_header"> № </th>
            <?php if(!$flag):?>
                <th class="tbl_header"> Таблица </th>
                <th class="tbl_header"> Колонка </th>
            <?php endif; ?>  
             <?php if($flag==1):?>
                <th class="tbl_header"> Функция </th>
            <?php endif; ?>   
            <?php if($flag==2):?>
                <th class="tbl_header"> Триггер </th>
            <?php endif; ?>    
            <? } ?>
        </tr>

            <?php 
                $kol=count($r);
                if(!empty($r)) {
                for($i=0;$i<$kol;$i++) {
                    echo('<tr class="tbl_row">');
                    echo('<td>' . ($i+1) . '</td>');
                    if(!$flag){
                        echo('<td>' . $r[$i]['table'] . '</td>');
                        echo('<td>' . $r[$i]['column'] . '</td>');
                    }
                    else{
                        if($flag==1)
                            echo('<td>' . $r[$i]['proname'] . '</td>');
                        if($flag==2)
                            echo('<td>' . $r[$i]['trigger'] . '</td>');
                    }
                    echo('</tr>');
            }}
            else {
               // echo('Ничего не найдено.');
            }
          ?>


        </tr>
    </table>

    <p class="p_right">Всего найдено совпадений: <?php echo $kol; ?>  </p>
</div>





