<?php

$params = require(__DIR__ . '/params.php');


$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    //'layout' => ['views\layouts\main'],
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            //'baseUrl' => '',
            'cookieValidationKey' => '5gNTJRBqUBpu2yux6zL4kR_BdKF5fhli',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => ['<action>' => 'site/<action>'],
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
        'db_phone' => require(__DIR__ . '/db_phone.php'),
        'db_info' => require(__DIR__ . '/db_info.php'),
        'db_phone_loc' => require(__DIR__ . '/db_phone_loc.php'),
        'db_connect' => require(__DIR__ . '/db_connect.php'),
        'db_pg_dn_energo' => require(__DIR__ . '/db_pg_dn_energo.php'),
        'db_pg_dn_abn'    => require(__DIR__ . '/db_pg_dn_abn.php'),
        'db_pg_vg_energo' => require(__DIR__ . '/db_pg_vg_energo.php'),
        'db_pg_vg_abn'    => require(__DIR__ . '/db_pg_vg_abn.php'),
        'db_pg_pv_energo' => require(__DIR__ . '/db_pg_pv_energo.php'),
        'db_pg_pv_abn'    => require(__DIR__ . '/db_pg_pv_abn.php'),
        'db_pg_zv_energo' => require(__DIR__ . '/db_pg_zv_energo.php'),
        'db_pg_zv_abn'    => require(__DIR__ . '/db_pg_zv_abn.php'),
        'db_pg_gv_energo' => require(__DIR__ . '/db_pg_gv_energo.php'),
        'db_pg_gv_abn'    => require(__DIR__ . '/db_pg_gv_abn.php'),
        'db_pg_krg_abn'   => require(__DIR__ . '/db_pg_krg_abn.php'),
        'db_pg_krg_energo'=> require(__DIR__ . '/db_pg_krg_energo.php'),
        'db_pg_ap_energo' => require(__DIR__ . '/db_pg_ap_energo.php'),
        'db_pg_ap_abn'    => require(__DIR__ . '/db_pg_ap_abn.php'),
        'db_pg_in_abn'    => require(__DIR__ . '/db_pg_in_abn.php'),
        'db_pg_in_energo' => require(__DIR__ . '/db_pg_in_energo.php'),
        
        'db_pg_ap_abn_test'    => require(__DIR__ . '/db_pg_ap_abn_test.php'),
        'db_pg_ap_energo_test'    => require(__DIR__ . '/db_pg_ap_energo_test.php'),
        'db_pg_test_energo'    => require(__DIR__ . '/db_pg_test_energo.php'),
        'db_pg_energo'    => require(__DIR__ . '/db_pg_test_energo.php'),
        'db_pg_dn_abn_test'    => require(__DIR__ . '/db_pg_dn_abn_test.php'),
        'db_pg_dn_energo_test'    => require(__DIR__ . '/db_pg_dn_energo_test.php'),
        'db_pg_gv_abn_test'    => require(__DIR__ . '/db_pg_gv_abn_test.php'),
        'db_pg_gv_energo_test'    => require(__DIR__ . '/db_pg_gv_energo_test.php'),
        'db_pg_in_abn_test'    => require(__DIR__ . '/db_pg_in_abn_test.php'),
        'db_pg_in_energo_test'    => require(__DIR__ . '/db_pg_in_energo_test.php'),
        'db_pg_krg_abn_test'    => require(__DIR__ . '/db_pg_krg_abn_test.php'),
        'db_pg_krg_energo_test'    => require(__DIR__ . '/db_pg_krg_energo_test.php'),
        'db_pg_pv_abn_test'    => require(__DIR__ . '/db_pg_pv_abn_test.php'),
        'db_pg_pv_energo_test'    => require(__DIR__ . '/db_pg_pv_energo_test.php'),
        'db_pg_vg_abn_test'    => require(__DIR__ . '/db_pg_vg_abn_test.php'),
        'db_pg_vg_energo_test'    => require(__DIR__ . '/db_pg_vg_energo_test.php'),
        'db_pg_zv_abn_test'    => require(__DIR__ . '/db_pg_zv_abn_test.php'),
        'db_pg_zv_energo_test'    => require(__DIR__ . '/db_pg_zv_energo_test.php'),
        
        'db_pg_ap_abn_test_2'    => require(__DIR__ . '/db_pg_ap_abn_test_2.php'),
        'db_pg_ap_energo_test_2'    => require(__DIR__ . '/db_pg_ap_energo_test_2.php'),
        'db_pg_dn_abn_test_2'    => require(__DIR__ . '/db_pg_dn_abn_test_2.php'),
        'db_pg_dn_energo_test_2'    => require(__DIR__ . '/db_pg_dn_energo_test_2.php'),
        'db_pg_gv_abn_test_2'    => require(__DIR__ . '/db_pg_gv_abn_test_2.php'),
        'db_pg_gv_energo_test_2'    => require(__DIR__ . '/db_pg_gv_energo_test_2.php'),
        'db_pg_in_abn_test_2'    => require(__DIR__ . '/db_pg_in_abn_test_2.php'),
        'db_pg_in_energo_test_2'    => require(__DIR__ . '/db_pg_in_energo_test_2.php'),
        'db_pg_krg_abn_test_2'    => require(__DIR__ . '/db_pg_krg_abn_test_2.php'),
        'db_pg_krg_energo_test_2'    => require(__DIR__ . '/db_pg_krg_energo_test_2.php'),
        'db_pg_pv_abn_test_2'    => require(__DIR__ . '/db_pg_pv_abn_test_2.php'),
        'db_pg_pv_energo_test_2'    => require(__DIR__ . '/db_pg_pv_energo_test_2.php'),
        'db_pg_vg_abn_test_2'    => require(__DIR__ . '/db_pg_vg_abn_test_2.php'),
        'db_pg_vg_energo_test_2'    => require(__DIR__ . '/db_pg_vg_energo_test_2.php'),
        'db_pg_zv_abn_test_2'    => require(__DIR__ . '/db_pg_zv_abn_test_2.php'),
        'db_pg_zv_energo_test_2'    => require(__DIR__ . '/db_pg_zv_energo_test_2.php'),

        'db_pg_im_db'    => require(__DIR__ . '/db_pg_im_db.php'),
        'db_pg_local_energo'    => require(__DIR__ . '/db_pg_local_energo.php'),
        
        'db_mysql_loc' => require(__DIR__ . '/db_mysql_loc.php'),
        'db_mysql_1'   => require(__DIR__ . '/db_mysql_1.php'),
        'db_mysql_2'   => require(__DIR__ . '/db_mysql_2.php'),
        'db_budget'   => require(__DIR__ . '/db_budget.php'),
        'db_pg_call'    => require(__DIR__ . '/db_pg_call.php'),
        'db_pools'    => require(__DIR__ . '/db_pools.php'),
        'db_sap'    => require(__DIR__ . '/db_sap.php'),

        'formatter' => [
        'class' => 'yii\i18n\Formatter',
        'decimalSeparator' => '.',
        'thousandSeparator' => ',',
          ],
        
    ],
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
