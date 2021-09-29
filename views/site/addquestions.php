<?php

// Форма ввода данных для проверки раскладки клавиатуры
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Полезные инструменты';
?>
<? $this->beginBlock('block1'); ?>



    <div id="content_container">
        <div id="header"> <div class="header_content_mainline"> Добавление вопросов в опросник </div>
            <div id="header_content_tagline">  </div>
        </div>
        <img src="./ulibka.gif">
    </div>


<? $this->endBlock(); ?>

<!--<div class="all_content">-->
<div class="form-group">
<!-- col-xs-5-->
    <div class="row">
        <div class="col-xs-6">
            <?php $form = ActiveForm::begin(['id' => 'symbol',
                'options' => [
                    'class' => 'form-horizontal col-xs-6',
                    'enctype' => 'multipart/form-data'
                    
                ]]); ?>
            <?
            echo $form->field($model, 'theme')->dropDownList(
                ArrayHelper::map(app\models\project_polls::findbysql(
                    "select *
                                from ws_polls where deleted=0")->all(), 'id', 'title')
            );


            ?>

            <?=$form->field($model, 'quest')
                ->textarea(['rows' => 2, 'cols' => 30]) ;  ?>

            <?=$form->field($model, 'a1')
                ->textarea(['rows' => 2, 'cols' => 30]) ;

            echo $form->field($model, "c1")->checkbox([
               // 'label' => $v['vid_repair'],
                'labelOptions' => [
                    'style' => 'padding-left:20px;'
                ],
                'disabled' => false
            ]);
            ?>
            <?=$form->field($model, 'a2')
                ->textarea(['rows' => 2, 'cols' => 30]) ;
            echo $form->field($model, "c2")->checkbox([
                // 'label' => $v['vid_repair'],
                'labelOptions' => [
                    'style' => 'padding-left:20px;'
                ],
                'disabled' => false
            ]);

            ?>

            <?=$form->field($model, 'a3')
                ->textarea(['rows' => 2, 'cols' => 30]) ;
            echo $form->field($model, "c3")->checkbox([
                // 'label' => $v['vid_repair'],
                'labelOptions' => [
                    'style' => 'padding-left:20px;'
                ],
                'disabled' => false
            ]);

            ?>
            <?=$form->field($model, 'a4')
                ->textarea(['rows' => 2, 'cols' => 30]) ;
            echo $form->field($model, "c4")->checkbox([
                // 'label' => $v['vid_repair'],
                'labelOptions' => [
                    'style' => 'padding-left:20px;'
                ],
                'disabled' => false
            ]);
            ?>
            <?=$form->field($model, 'a5')
                ->textarea(['rows' => 2, 'cols' => 30]) ;
            echo $form->field($model, "c5")->checkbox([
                // 'label' => $v['vid_repair'],
                'labelOptions' => [
                    'style' => 'padding-left:20px;'
                ],
                'disabled' => false
            ]);

            ?>

            <div class="form-group">
                <?= Html::submitButton('OK', ['class' => 'btn btn-info']); ?>

            </div>

            <?php

            ActiveForm::end(); ?>
        </div>
    </div>
</div>
  <?php



    




