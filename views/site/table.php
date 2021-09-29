//Ввести число и вывести таблицу умножения этого числа от 1 до 20. Результат вывести в таблице.

<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>
<div class = 'test'>

<?php $form = ActiveForm::begin(['options' => ['class' => 'form-horizontal']])  ?>
<?= $form->field($model, 'name') -> input ('number') ?>
<?= Html::submitButton('Вычислить',['class' => 'btn btn-success']) ?>
<?php ActiveForm::end() ?>

</div>
