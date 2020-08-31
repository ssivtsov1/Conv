<?php
// Отображение показателей
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\SerialColumn;
use yii\widgets\DetailView;
use \app\models\Power_outages;
?>

<div class = 'test'>
<?php





echo "<table class='table table-bordered'>";
echo "<td>Номер по порядку</td>";
echo "<td>Вид роботи</td>";
echo "<td>РЕМ</td>";
echo "<td>Тип відключення</td>";
echo "<td>Дата початку відключення</td>";
echo "<td>Дата закінчення відключення</td>";
$i = 0;
//for($i=0;$i<$kol;$i++) {
foreach ($data as $v) {
    $i++;
    echo('<tr>');
    echo('<td>' . $i . '</td>');
    echo('<td>' . $v['descr']. '</td>');
    echo('<td>' . $v['encode']. '</td>');
    echo('<td>' . $v['type_otkl']. '</td>');
    echo('<td>' . $v['date_begin']. '</td>');
    echo('<td>' . $v['date_end']. '</td>');
    echo('</tr>');
}
echo '</table>';
?>
</div>
