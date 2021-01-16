<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$arr = ['Выбор сервера','MySQL','Postgres'];
?>

<div class = 'test'>
    <div class="col-lg-4">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'file')->label('Файл')->fileInput() ?>

    <?= $form->field($model, 'number')->label('Количество полей')  -> textInput()  ?>

    <?= $form->field($model, 'type')->label('Тип сервера')  -> textInput() -> dropDownList ($arr) ?>

    <?= $form->field($model, 'ip_address')->label('IP адрес')  -> Input('number')  ?>

    <?= $form->field($model, 'base')->label('База')  -> textInput()  ?>

    <?= $form->field($model, 'table')->label('Таблица')  -> textInput()  ?>

    <?= $form->field($model, 'delimiter')->label('Символ разделитель')  -> textInput()  ?>

    <?= Html::submitButton('Отправить',['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end() ?>
</div>
</div>

