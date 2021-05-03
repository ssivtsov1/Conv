<?php
$_fn=realpath(__DIR__."/../data")."/data.db";
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=sap',
    'username' => 'root',
    'password' => '123',
    'charset' => 'utf8',
];

