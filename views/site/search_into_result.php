<?php

// Отображение показателей
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;

$this->title = 'Результат поиска внутри файлов:';
$this->params['breadcrumbs'][] = $this->title;
?>

<? $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Поиск </div>
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

            <th class="tbl_header"> № </th>
            <th class="tbl_header"> Файл  </th>


        </tr>

            <?php
                $i=1;
               foreach ($result as $v) {
                   $pos=strpos($v,'/');
                   if($pos)
                        $v=substr($v,$pos+1);
                   else
                       $v='';
                    echo('<tr class="tbl_row">');
                    echo('<td>' . $i . '</td>');
                    echo('<td>' . $v . '</td>');
                    echo('</tr>');
                    $i++;
            }
          ?>


        </tr>
    </table>


</div>





