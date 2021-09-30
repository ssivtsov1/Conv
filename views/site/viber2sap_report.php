<?php


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\grid\ActionColumn;
use yii\grid\CheckboxColumn;
use yii\grid\SerialColumn;
//debug($dataProvider->getModels());
$this->title = 'Передача показів лічильників з Viber в САП';
$this->params['breadcrumbs'][] = $this->title;

?>
<br>
<br>
<div class="site-spr10">

    <h3><?= Html::encode($this->title) ?></h3>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'summary' => false,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            'lic',
            'date_t',
            'val11',
            'val21',
            'val22',
            'val31',
            'val32',
            'val33',
            'status',
        ],
    ]); ?>

</div>


