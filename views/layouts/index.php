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
            'brandLabel' =>  'Полезные инструменты',
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
                                ['label' => 'Сравнение строк', 'url' => ['/site/cmp_str']],
                            ]
                    ],
                    ['label' => 'Текущие работы', 'url' => ['/sprav/sprav_pokaz'],
                        'options' => ['id' => 'down_menu'],
                        'items' =>
                            [
                                ['label' => 'Импорт списка работников в тел. справ.(старый)', 'url' => ['/site/import_list_works']],
                                ['label' => 'Импорт списка работников в тел. справ.(новый)', 'url' => ['/site/import_list_works_new']],
                                ['label' => 'Импорт списка работников во врем. таблицу', 'url' => ['/site/import_list_new']],
                                ['label' => 'Импорт списка новых работников во врем. таблицу', 'url' => ['/site/import_new']],
                                ['label' => 'Импорт населенных пунктов Украины в таблицу на MySQL', 'url' => ['/site/import_towns']],
                                ['label' => 'Импорт отчета Киевстар 03.2018', 'url' => ['/site/import_ks_0318']],
                                ['label' => 'Импорт таблицы лиценз. работ для 1Click', 'url' => ['/site/import_lic']],
                                ['label' => 'Импорт таблицы не лиценз. работ для 1Click', 'url' => ['/site/import_notlic']],
                                ['label' => 'Импорт транспорт 1Click', 'url' => ['/site/import_transport']],
                                
                            ]
                    ],
                    
                    ['label' => 'Сервис', 'url' => ['/sprav/sprav_pokaz'],
                        'options' => ['id' => 'down_menu'],
                        'items' =>
                            [
                                
                                ['label' => 'Разработка функции a2sql', 'url' => ['/site/a2sql']],
                                ['label' => 'Кодирование строки', 'url' => ['/site/code']],
                                ['label' => 'Кодирование файла', 'url' => ['/site/code_file']],
                                ['label' => 'Раскодирование файла', 'url' => ['/site/decode_file']],
                                ['label' => 'Операции с множествами', 'url' => ['/site/oper_sets']],

                            ]
                    ],
                    
                    ['label' => 'Поиск на сервере', 'url' => ['/sprav/sprav_pokaz'],
                        'options' => ['id' => 'down_menu'],
                        'items' =>
                            [
                                ['label' => 'Поиск на PostGreSQL', 'url' => ['/site/find']],
                                ['label' => 'Поиск на MySQL', 'url' => ['/site/find_mysql']],
                            ]
                    ],
                    ['label' => 'О сайте', 'url' => ['/site/about']],
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
