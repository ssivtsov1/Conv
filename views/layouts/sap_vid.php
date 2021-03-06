<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'ЦEK',
        'brandUrl' => ['sap/general'],
        'options' => [
            'class' => 'navbar-default navbar-fixed-top',
            'id' => 'main-menu',
        ],
    ]);
                                                                                echo Nav::widget([
                                                                                 'options' => ['class' => 'navbar-nav navbar-right'],
                                                                                 'items' => [
                                                                                 ['label' => 'Побутові споживачі', 'url' => ['/site/index'],
                                                                                     
                                                                                     'options' => ['id' => 'down_menu'],
                                                                                        'items' =>
                                                                                            [
                                                                                            ['label' => 'мобільні телефони', 'url' => ['/sap/phone']],
                                                                                            ['label' => 'Дублі лічильник+номер', 'url' => ['/sap/doublemeter']],
                                                                                            ['label' => 'Не визначено лічильник', 'url' => ['/sap/exsistmeter']],
                                                                                            ],
                                                                                 ],
                                                                                     
                                                                                 ['label' => 'Юридичні споживачі', 'url' => ['/site/index'],
                                                                                     
                                                                                     'options' => ['id' => 'down_menu'],
                                                                                        'items' =>
                                                                                            [
                                                                                            ['label' => 'перевірка ОКПО', 'url' => ['/sap/okpo']],
                                                                                            ['label' => 'перевірка ІПН', 'url' => ['/sap/inn']],
                                                                                            ['label' => 'Пусті площадки', 'url' => ['/sap/plosh']],
                                                                                            ['label' => 'Відсутня юр.адреса спож.', 'url' => ['/sap/yspoj']],
                                                                                            ['label' => 'Відсутня адреса на точці вым.', 'url' => ['/sap/missingaddres']],
                                                                                            ['label' => 'Відсутня площадка вим.', 'url' => ['/sap/missingarea']],
                                                                                            ['label' => 'Відсутня категорія', 'url' => ['/sap/missingcategory']],
                                                                                            ['label' => 'завантажити', 'url' => ['/sap/downloadsap']],
                                                                                            ],
                                                                                 ],     
                                                                                 ]
                                                                                    ]);
    NavBar::end();
    ?>

    <div class="container">

        <?= $content ?>
    </div>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
