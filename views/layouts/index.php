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
        if($_SERVER['REMOTE_ADDR']<>'127.0.0.1') {
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
//                                ['label' => 'Импорт списка работников в тел. справ.(новый)', 'url' => ['/site/import_list_works_new']],
                                ['label' => 'Импорт списка работников в тел. справ.(новый)', 'url' => ['/site/import_list_works_tel']],
                                ['label' => 'Импорт списка работников во врем. таблицу', 'url' => ['/site/import_list_new']],
                                ['label' => 'Импорт списка новых работников во врем. таблицу', 'url' => ['/site/import_new']],
                                ['label' => 'Импорт населенных пунктов Украины в таблицу на MySQL', 'url' => ['/site/import_towns']],
                                ['label' => 'Импорт населенных пунктов Украины в таблицу на PostGre', 'url' => ['/site/import_towns_pg']],
                                ['label' => 'Импорт отчета Киевстар 02.2020', 'url' => ['/site/import_ks_0220']],
                                ['label' => 'Импорт таблицы лиценз. работ для 1Click', 'url' => ['/site/import_lic']],
                                ['label' => 'Импорт таблицы не лиценз. работ для 1Click', 'url' => ['/site/import_notlic']],
                                ['label' => 'Импорт транспорт 1Click', 'url' => ['/site/import_transport']],
                                ['label' => 'Импорт транспорт 1Click детальная ', 'url' => ['/site/import_transport_detal']],
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
                                ['label' => 'Перенос данных по линиям [для юр. лиц]', 'url' => ['/site/lines2sap']],
                                ['label' => 'Перенос данных по трансформаторам [для юр. лиц]', 'url' => ['/site/trans2sap']],
//                                ['label' => 'Генерация 32-битного случайного числа', 'url' => ['/site/gen32']],
//                                ['label' => 'Создание поля CHARG (SAP)', 'url' => ['/site/charg']],
//                                ['label' => 'Создание поля CHARG эксплуатация (SAP)', 'url' => ['/site/charg_e']],
//                                ['label' => 'Установка разрядности единиц измерений (SAP)', 'url' => ['/site/edizm']],
//                                ['label' => 'Установка id_lgort (SAP)', 'url' => ['/site/id_lgort']],
//                                ['label' => 'Установка товара (SAP)', 'url' => ['/site/set_t_sap']],
//                                ['label' => 'Установка товара (SAP) экспл.', 'url' => ['/site/set_t_sap_e']],
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
                                ['label' => 'Тест', 'url' => ['/site/test_task']],

                            ]
                    ],

                    ['label' => 'Импорт таблиц', 'url' => ['/sprav/sprav_pokaz'],
                        'options' => ['id' => 'down_menu'],
                        'items' =>
                            [
                                ['label' => 'Добавление типов счетчиков', 'url' => ['/site/add_cnt']],
                                ['label' => 'Добавление типов пломб', 'url' => ['/site/add_type_plomb']],
                                ['label' => 'Импорт street с Ингульца [Энерго]', 'url' => ['/site/imp_street']],
                                ['label' => 'Импорт таблицы областей', 'url' => ['/site/imp_obl']],
                                ['label' => 'Импорт таблицы районов', 'url' => ['/site/imp_region']],
                                ['label' => 'Импорт address с Ингульца [Энерго]', 'url' => ['/site/imp_address']],
                                ['label' => 'Импорт готовой таблицы street в базы РЭСов', 'url' => ['/site/imp_street_in_bd']],
                                ['label' => 'Закачка данных в справочник адресов САП', 'url' => ['/site/addr_from_sap']],
                                ['label' => 'Запись данных по единицам считывания САП', 'url' => ['/site/ed_sch']],
                                ['label' => 'Запись данных по измер. трансформаторам', 'url' => ['/site/get_data_tv']],
                                ['label' => 'Запись справочников  измер. трансформаторов САП', 'url' => ['/site/spr_data_tv']],
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

                    ['label' => 'миг. САП', 'url' => ['/sap/general']],
                    ['label' => 'О сайте', 'url' => ['/site/about']],
                ],
        ]);
        }
        else {
            // Если выполняется на локальном сервере
            NavBar::begin([
                'brandLabel' => 'Полезные инструменты',
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
//                                ['label' => 'Импорт списка работников в тел. справ.(новый)', 'url' => ['/site/import_list_works_new']],
                                    ['label' => 'Импорт списка работников в тел. справ.(новый)', 'url' => ['/site/import_list_works_tel']],
                                    ['label' => 'Импорт списка работников во врем. таблицу', 'url' => ['/site/import_list_new']],
                                    ['label' => 'Импорт списка новых работников во врем. таблицу', 'url' => ['/site/import_new']],
                                    ['label' => 'Импорт населенных пунктов Украины в таблицу на MySQL', 'url' => ['/site/import_towns']],
                                    ['label' => 'Импорт населенных пунктов Украины в таблицу на PostGre', 'url' => ['/site/import_towns_pg']],
                                    ['label' => 'Импорт отчета Киевстар 02.2020', 'url' => ['/site/import_ks_0220']],
                                    ['label' => 'Импорт таблицы лиценз. работ для 1Click', 'url' => ['/site/import_lic']],
                                    ['label' => 'Импорт таблицы не лиценз. работ для 1Click', 'url' => ['/site/import_notlic']],
                                    ['label' => 'Импорт транспорт 1Click', 'url' => ['/site/import_transport']],
                                    ['label' => 'Импорт транспорт 1Click детальная ', 'url' => ['/site/import_transport_detal']],
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
                                    ['label' => 'Перенос данных по линиям [для юр. лиц]', 'url' => ['/site/lines2sap']],
                                    ['label' => 'Перенос данных по трансформаторам [для юр. лиц]', 'url' => ['/site/trans2sap']],
//                                ['label' => 'Генерация 32-битного случайного числа', 'url' => ['/site/gen32']],
//                                ['label' => 'Создание поля CHARG (SAP)', 'url' => ['/site/charg']],
//                                ['label' => 'Создание поля CHARG эксплуатация (SAP)', 'url' => ['/site/charg_e']],
//                                ['label' => 'Установка разрядности единиц измерений (SAP)', 'url' => ['/site/edizm']],
//                                ['label' => 'Установка id_lgort (SAP)', 'url' => ['/site/id_lgort']],
//                                ['label' => 'Установка товара (SAP)', 'url' => ['/site/set_t_sap']],
//                                ['label' => 'Установка товара (SAP) экспл.', 'url' => ['/site/set_t_sap_e']],
//                                ['label' => 'Создание ключа (SAP)', 'url' => ['/site/crt_key']],
//                                ['label' => 'Создание отв. лиц (SAP)', 'url' => ['/site/lgort']],
                                    ['label' => 'Установка разрядности стоимости', 'url' => ['/site/rmoney']],
                                    ['label' => 'Закачка справочника материалов', 'url' => ['/site/spr_mat']],
                                    ['label' => 'Закачка таблицы соответствия для служб', 'url' => ['/site/sootv']],
                                    ['label' => 'Экспорт данных по складу в САП', 'url' => ['/site/sklad2sap']],
                                    ['label' => 'Проверка фактов [пром.]', 'url' => ['/site/check_facts']],
                                    ['label' => 'Закачка таблицы wo', 'url' => ['/site/wosootv']],
                                    ['label' => 'Закачка таблицы реквизитов поставщиков', 'url' => ['/site/rekv_post']],
                                    ['label' => 'Преобразование таблицы инструмента', 'url' => ['/site/do_mshp']],
                                    ['label' => 'Установка даты для инструмента', 'url' => ['/site/set_date']],
                                    ['label' => 'Тест', 'url' => ['/site/test_task']],
                                    ['label' => 'Преобразование файла DEVICE', 'url' => ['/site/cnv_dev']],

                                ]
                        ],

                        ['label' => 'Импорт таблиц', 'url' => ['/sprav/sprav_pokaz'],
                            'options' => ['id' => 'down_menu'],
                            'items' =>
                                [
                                    ['label' => 'Добавление типов счетчиков', 'url' => ['/site/add_cnt']],
                                    ['label' => 'Добавление типов пломб', 'url' => ['/site/add_type_plomb']],
                                    ['label' => 'Импорт street с Ингульца [Энерго]', 'url' => ['/site/imp_street']],
                                    ['label' => 'Импорт таблицы областей', 'url' => ['/site/imp_obl']],
                                    ['label' => 'Импорт таблицы районов', 'url' => ['/site/imp_region']],
                                    ['label' => 'Импорт address с Ингульца [Энерго]', 'url' => ['/site/imp_address']],
                                    ['label' => 'Импорт готовой таблицы street в базы РЭСов', 'url' => ['/site/imp_street_in_bd']],
                                    ['label' => 'Импорт остатков по бухгалтерии перетоки', 'url' => ['/site/imp_ost_reflow']],
                                    ['label' => 'Импорт остатков по бухгалтерии реактив', 'url' => ['/site/imp_ost_reactiv']],
                                    ['label' => 'Закачка данных в справочник адресов САП', 'url' => ['/site/addr_from_sap']],
                                    ['label' => 'Запись данных по единицам считывания САП', 'url' => ['/site/ed_sch']],
                                    ['label' => 'Запись данных по измер. трансформаторам', 'url' => ['/site/get_data_tv']],
                                    ['label' => 'Запись справочников  измер. трансформаторов САП', 'url' => ['/site/spr_data_tv']],
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
                        ['label' => 'Задачи', 'url' => ['/sprav/sprav_pokaz'],
                            'options' => ['id' => 'down_menu'],
                            'items' =>
                                [
                                    ['label' => 'Задачи Ани', 'url' => ['/sprav/sprav_pokaz'],
                                        'options' => ['id' => 'down_menu'],
                                        'items' =>
                                            [
                                                ['label' => 'Перевернутая строка', 'url' => ['/site/stroka']],
                                                ['label' => 'Birthday', 'url' => ['/site/birthday']],
                                                ['label' => 'Таблица умножения', 'url' => ['/site/table']],
                                                ['label' => 'Проверка на пустые поля. Юр', 'url' => ['/site/upload']],
                                                ['label' => 'Проверка на пустые поля. Быт', 'url' => ['/site/uploadbyt']],
                                                ['label' => 'Форма. Перебои в подаче электроэнергии', 'url' => ['/site/power_outages']],
                                            ]
                                    ],
                                    ['label' => 'Задачи Егора', 'url' => ['/sprav/sprav_pokaz'],
                                        'options' => ['id' => 'down_menu'],
                                        'items' =>
                                            [
//                                                ['label' => 'Поиск на PostGreSQL', 'url' => ['/site/find']],
                                            ]
                                    ],
                                    ['label' => 'Задачи Сергея', 'url' => ['/sprav/sprav_pokaz'],
                                        'options' => ['id' => 'down_menu'],
                                        'items' =>
                                            [
                                                ['label' => 'Работа с XML', 'url' => ['/site/exml']],
                                                ['label' => 'Перестановки', 'url' => ['/site/perebor']],
                                            ]
                                    ],
                                ]
                         ],
                        ['label' => 'миг. САП', 'url' => ['/sap/general']],
                        ['label' => 'О сайте', 'url' => ['/site/about']],
                    ],
            ]);
        }
        NavBar::end();
        ?>

    <? if(isset($this->blocks['block1'])) ?>
    <? echo $this->blocks['block1'];

    ?>
    
        
            <?= $content ?>
</div>



<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
