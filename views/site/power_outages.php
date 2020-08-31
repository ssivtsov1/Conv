<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii \ helpers \ ArrayHelper;
$arr = ['- Оберіть тип *-', 'Планові', 'Аварійні', 'Всі'];
$arr1 = ['- Виберіть район *-', 'Дніпропетровський РЕМ', 'Інгулецький РЕМ', 'Жовтоводський РЕМ', 'Гвардійський РЕМ', 'Апостолівський РЕМ', 'Криворізький РЕМ','Вільногірський РЕМ', 'Павлоградський РЕМ'];
?>
<div class = 'test'>
<h1>Відключення у електромережах</h1>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

    <?= $form->field($model, 'type')->label('Тип відключення') -> textInput() -> dropDownList ( $arr )?>

    <?= $form->field($model, 'begin_date')->label('Дата початку')-> widget(\yii\jui\DatePicker::classname(), ['language' => 'uk']) ?>

    <?= $form->field($model, 'end_date')->label('Дата закінчення')-> widget(\yii\jui\DatePicker::classname(), ['language' => 'uk']) ?>

    <?= $form->field($model, 'pidrozdil')->label('Підрозділ')  -> dropDownList ( $arr1 ) ?>

    <?= Html::submitButton('Надіслати',['class' => 'btn btn-success']) ?>

    <?php ActiveForm::end() ?>
</div>
