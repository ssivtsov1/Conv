

<h1 align="center">Перевірка моб.телефону</h1>
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

<?php $this->beginBlock('block1'); ?>
<div id="content_container">
    <div id="header"> <div class="header_content_mainline"> Преобразователь чисел </div>
        <div id="header_content_tagline">  </div>
    </div>
</div>

<?php $this->endBlock(); ?>


<div class="form-group">
    <h4>Номер має не дозволену кількість символів. Телефон має бути 10 символів – лише цифри</h4>
    <?php
//        debug($kol);
//        return 1;

    ?>
    <table id="tbl_rez"  cellpadding="0" cellspacing="0" border=1>
        <tr class="tbl_row">
            <?php if(!empty($s)) { ?>
            <th class="tbl_header"> № </th>
            <th class="tbl_header"> особовий рахунок</th>
            <th class="tbl_header"> довжина</th>
            <th class="tbl_header"> моб.телефон</th>

            <?php } ?>
        </tr>

            <?php if(!empty($s)) {
                for($i=0;$i<count($s);$i++) {
                    echo('<tr class="tbl_row">');
                    echo('<td>' . ($i+1) . '</td>');
                    echo('<td>' . $s[$i]['code'] . '</td>');
                    echo('<td>' . $s[$i]['length'] . '</td>');
                    echo('<td>' . $s[$i]['mob_phone'] . '</td>');
                    echo('</tr>');
            }}
          ?>


        </tr>
    </table>


</div>

<div class="clear_fix">

</div>







<?php

//debug($s);

?>