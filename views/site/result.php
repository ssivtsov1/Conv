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
    <div id="header"> <div class="header_content_mainline"> Преобразователь чисел </div>
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
            <? if(!empty($r)) { ?>
            <th class="tbl_header"> № </th>
            <th class="tbl_header"> Вход <?= '('.$q.')' ?></th>
            <th class="tbl_header"> Результат <?= '('.$r.')' ?> </th>

            <? } ?>
        </tr>

            <?php if(!empty($r)) {
                for($i=0;$i<$kol;$i++) {
                    echo('<tr class="tbl_row">');
                    echo('<td>' . ($i+1) . '</td>');
                    echo('<td>' . $arr['src'][$i] . '</td>');
                    echo('<td>' . $arr[$k][$i] . '</td>');
                    echo('</tr>');
            }}
          ?>


        </tr>
    </table>


</div>





