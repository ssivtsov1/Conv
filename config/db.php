<?php
$_fn=realpath(__DIR__."/../data")."/data.db";
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=costwork',
    'username' => 'CostWork',
    'password' => '123',
    'charset' => 'utf8',
];

