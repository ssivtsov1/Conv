<?php

$_fn=realpath(__DIR__."/../data")."/LS.db";

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'sqlite:'.$fn,
//    'dsn' => 'sqlite:@app/db/LS.db',
];


