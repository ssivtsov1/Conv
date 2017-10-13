<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body>
<?php $this->beginBody() ?>

<div class="wrap">
        <?php
        NavBar::begin([
            'brandLabel' => 'Полезные мелочи',
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
               'class' => 'navbar-inverse navbar-fixed-top',
            ],
        ]);
        echo Nav::widget([
            'options' => ['class' => 'navbar-nav navbar-right'],
            'items' =>
                [
                    ['label' => 'Главная', 'url' => ['/site/index']],
                    ['label' => 'Рассчеты', 'url' => ['/sprav/sprav_pokaz'],
                        'options' => ['id' => 'down_menu'],
                        'items' =>
                            [
                                ['label' => 'Преобразователь чисел', 'url' => ['/site/convert']],
                                ['label' => 'Проверка символов', 'url' => ['/site/check_symbol']],
                            ]
                    ],
                    ['label' => 'Сервис', 'url' => ['/sprav/sprav_pokaz'],
                        'options' => ['id' => 'down_menu'],
                        'items' =>
                            [
                                ['label' => 'Импорт списка работников в тел. справ.', 'url' => ['/site/import_list_works']],

                            ]
                    ],
                    ['label' => 'О программе', 'url' => ['/site/about']],
                ],
        ]);
        NavBar::end();
        ?>

    <? if(isset($this->blocks['block1'])) ?>
    <? echo $this->blocks['block1']; ?>
    
        
            <?= $content ?>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
