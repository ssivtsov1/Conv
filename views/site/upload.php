<?php
use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

    <div class = 'test'>

        <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]) ?>

        <?= $form->field($model, 'file')->fileInput() ?>

        <?= Html::submitButton('Отправить',['class' => 'btn btn-success']) ?>

        <?php ActiveForm::end() ?>
    </div>

