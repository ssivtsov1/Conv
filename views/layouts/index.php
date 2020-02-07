<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;  
use app\assets\AppAsset;
ini_set('error_reporting', E_ALL);
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
//                                ['label' => 'Импорт списка работников в тел. справ.(старый)', 'url' => ['/site/import_list_works']],
                                ['label' => 'Импорт списка работников в тел. справ.(новый)', 'url' => ['/site/import_list_works_new']],
                                ['label' => 'Импорт списка работников во врем. таблицу', 'url' => ['/site/import_list_new']],
                                ['label' => 'Импорт списка новых работников во врем. таблицу', 'url' => ['/site/import_new']],
                                ['label' => 'Импорт населенных пунктов Украины в таблицу на MySQL', 'url' => ['/site/import_towns']],
                                ['label' => 'Импорт населенных пунктов Украины в таблицу на PostGre', 'url' => ['/site/import_towns_pg']],
                                ['label' => 'Импорт отчета Киевстар 11.2019', 'url' => ['/site/import_ks_1119']],
                                ['label' => 'Импорт таблицы лиценз. работ для 1Click', 'url' => ['/site/import_lic']],
                                ['label' => 'Импорт таблицы не лиценз. работ для 1Click', 'url' => ['/site/import_notlic']],
                                ['label' => 'Импорт транспорт 1Click', 'url' => ['/site/import_transport']],
                                ['label' => 'Импорт MTS в phone', 'url' => ['/site/import_mts']],
                                ['label' => 'Импорт кодов точек учета в Energo', 'url' => ['/site/import_points']],
                                ['label' => 'Импорт дневника в Info', 'url' => ['/site/import_diary']],
                                ['label' => 'Импорт имен в тел. справочник', 'url' => ['/site/import_names']],
                                ['label' => 'Импорт бюджета', 'url' => ['/site/import_budget19']],
//                                ['label' => 'Импорт выгрузки из call-центра', 'url' => ['/site/import_call_c']],
//                                ['label' => 'Транслитерация', 'url' => ['/site/translit']],
                                ['label' => 'Корректировка стоимости в бюджете', 'url' => ['/site/corr_budget']],
//                                ['label' => 'Тестирование строки', 'url' => ['/site/strtest']],
//                                ['label' => 'Импорт телефонов Винницы', 'url' => ['/site/import_tel_vi']],
                                ['label' => 'Перенос данных по eerm [для юр. лиц]', 'url' => ['/site/eerm2cnt']],
//                                ['label' => 'Генерация 32-битного случайного числа', 'url' => ['/site/gen32']],
                                ['label' => 'Создание поля CHARG (SAP)', 'url' => ['/site/charg']],
                                ['label' => 'Создание поля CHARG эксплуатация (SAP)', 'url' => ['/site/charg_e']],
                                ['label' => 'Установка разрядности единиц измерений (SAP)', 'url' => ['/site/edizm']],
                                ['label' => 'Установка id_lgort (SAP)', 'url' => ['/site/id_lgort']],
                                ['label' => 'Установка товара (SAP)', 'url' => ['/site/set_t_sap']],
                                ['label' => 'Установка товара (SAP) экспл.', 'url' => ['/site/set_t_sap_e']],
//                                ['label' => 'Создание ключа (SAP)', 'url' => ['/site/crt_key']],
//                                ['label' => 'Создание отв. лиц (SAP)', 'url' => ['/site/lgort']],
                                ['label' => 'Установка разрядности стоимости', 'url' => ['/site/rmoney']],
                                ['label' => 'Закачка справочника материалов', 'url' => ['/site/spr_mat']],
                                ['label' => 'Закачка таблицы соответствия для служб', 'url' => ['/site/sootv']],
                                ['label' => 'Экспорт данных по складу в САП', 'url' => ['/site/sklad2sap']],
                                ['label' => 'Задача', 'url' => ['/site/task3']],
                                ['label' => 'Закачка таблицы wo', 'url' => ['/site/wosootv']],
                                ['label' => 'Преобразование таблицы инструмента', 'url' => ['/site/do_mshp']],
                                ['label' => 'Установка даты для инструмента', 'url' => ['/site/set_date']],
                                ['label' => 'Тест', 'url' => ['/site/test_recfile']],

                            ]
                    ],

                    ['label' => 'Импорт таблиц', 'url' => ['/sprav/sprav_pokaz'],
                        'options' => ['id' => 'down_menu'],
                        'items' =>
                            [
                                ['label' => 'Импорт street с Ингульца [Энерго]', 'url' => ['/site/imp_street']],
                                ['label' => 'Импорт таблицы областей', 'url' => ['/site/imp_obl']],
                                ['label' => 'Импорт таблицы районов', 'url' => ['/site/imp_region']],
                                ['label' => 'Импорт address с Ингульца [Энерго]', 'url' => ['/site/imp_address']],
                                ['label' => 'Импорт готовой таблицы street в базы РЭСов', 'url' => ['/site/imp_street_in_bd']],
                                ['label' => 'Форматирование csv файла', 'url' => ['/site/prepare_csv']],
                                ['label' => 'Формирование файла partner для САП [бытовые]', 'url' => ['/site/sap_partner_ind']],
                                ['label' => 'Формирование файла partner для САП [юридические]', 'url' => ['/site/sap_partner']],
                                ['label' => 'Формирование вопросов для опросника', 'url' => ['/site/form_quest']],
                                ['label' => 'SAP идентификации данных', 'url' => ['/site/idfile']],
                                ['label' => 'Експорт в САП', 'url' => ['/site/cek2sap']],

                            ]
                    ],

                    ['label' => 'Функции', 'url' => ['/sprav/sprav_pokaz'],
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
