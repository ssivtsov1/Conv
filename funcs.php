<?php
// Отображение массива в удобном для просмотра виде
function debug($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}

function Arr2Tab($arr,$tab){
    $db = new sqlite_db("db.sqlite");


// создаём таблицу foo и вставляем что-нибудь для примера
    $db->query("BEGIN;
        CREATE TABLE $tab(id INTEGER PRIMARY KEY, name CHAR(255));
        INSERT INTO $tab (name) VALUES('Ilia');
        INSERT INTO $tab (name) VALUES('Ilia2');
        INSERT INTO $tab (name) VALUES('Ilia3');
        COMMIT;");
    $result_array = $db->array_query("SELECT * FROM $tab", SQLITE_ASSOC);
    debug(result_array);

}

// Определение кода символа на предмет раскладки клавиатуры
function How_code($c){
    $flag = 0;
    if(($c>=65 && $c<=90) || ($c>=97 && $c<=122)){
        $flag = 1;
        return 'en';
    }
    if($flag = 1 && $c<129)
        return '';
    if($c>128)
        return 'ru';
}
?>
