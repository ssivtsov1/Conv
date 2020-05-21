<?php

// Отображение массива в удобном для просмотра виде
function debug($var)
{
    echo '<pre>';
    print_r($var);
    echo '</pre>';
}
// Удаление определенных символов из строки
function del_symb($s)
{
    $s=str_replace('нн','',$s);
    $s=str_replace('сс','',$s);
//    $s=str_replace(',','.',$s);
    $y=mb_strlen($s,"UTF-8");

    $s=mb_strtolower($s,"UTF-8");
    $ss='';
    $j=0;

    $pos1 = strpos($s, '(');
    $p1=0;
    if (!$pos1 === false) {
        $p1=1;
    }
    $pos2 = strpos($s, ')');
    $p2=0;
    if (!$pos2 === false) {
        $p2=1;
    }
    $p=$p1*$p2;

    $let=0;
    for($i=0;$i<$y;$i++)
    {
      $flag = 0;
      $c=mb_substr($s,$i,1,"UTF-8");
      if($c==')') $let=0;

          if ($c == '(' && $p==1) $let = 1;
          if (($c >= 'a' && $c<='z') || ($c >= 'A' && $c<='Z')) $flag = 1;

//        echo $c;
          switch ($c) {
              case 'а':
                  $flag = 1;
                  break;
              case 'о':
                  $flag = 1;
                  break;
              case 'и':
                  $flag = 1;
                  break;
              case 'е':
                  $flag = 1;
                  break;
              case 'ё':
                  $flag = 1;
                  break;
              case 'ы':
                  $flag = 1;
                  break;
              case 'у':
                  $flag = 1;
                  break;
              case 'ю':
                  $flag = 1;
                  break;
              case 'я':
                  $flag = 1;
                  break;
              case 'і':
                  $flag = 1;
                  break;
              case 'є':
                  $flag = 1;
                  break;
              case 'э':
                  $flag = 1;
                  break;
              case ' ':
                  $flag = 1;
                  break;
              case '_':
                  $flag = 1;
                  break;
              case '№':
                  $flag = 1;
                  break;
              case '%':
                  $flag = 1;
                  break;
              case '!':
                  $flag = 1;
                  break;
              case ';':
                  $flag = 1;
                  break;
              case ':':
                  $flag = 1;
                  break;
              case '#':
                  $flag = 1;
                  break;
              case '$':
                  $flag = 1;
                  break;
              case '^':
                  $flag = 1;
                  break;
              case '&':
                  $flag = 1;
                  break;
              case '*':
                  $flag = 1;
                  break;
              case '(':
                  $flag = 1;
                  break;
              case ')':
                  $flag = 1;
                  break;
              case '[':
                  $flag = 1;
                  break;
              case ']':
                  $flag = 1;
                  break;
              case '{':
                  $flag = 1;
                  break;
              case '}':
                  $flag = 1;
                  break;
              case '<':
                  $flag = 1;
                  break;
              case '>':
                  $flag = 1;
                  break;
              case '?':
                  $flag = 1;
                  break;
              case '/':
                  $flag = 1;
                  break;
              case '~':
                  $flag = 1;
                  break;
              case '"':
                  $flag = 1;
                  break;
              case "'":
                  $flag = 1;
                  break;
              case 'ї':
                  $flag = 1;
                  break;
              case '|':
                  $flag = 1;
                  break;
              case "\\":
                  $flag = 1;
                  break;
              case "-":
                  $flag = 1;
                  break;
              case "+":
                  $flag = 1;
                  break;
              case "x":
                  $flag = 1;
                  break;
              case "=":
                  $flag = 1;
                  break;
          }
          if ($flag == 0 && $let==0) {

              $ss = $ss . $c;
              $a[$j] = $c;
              $j++;
          }

    }
    if($j>0)
        sort($a);
    else
        $a=[];
//  echo $ss;
    return  implode('',$a);
}

// Удаление определенных символов из строки
function del_symb1($s)
{
    $s=str_replace('нн','',$s);
    $s=str_replace('сс','',$s);

    $s=str_replace(',','',$s);
    $y=mb_strlen($s,"UTF-8");

    $s=mb_strtolower($s,"UTF-8");
    $s=str_replace('кррем','',$s);
    $s=str_replace('інрем','',$s);
    $s=str_replace('жврем','',$s);
    $s=str_replace('днрем','',$s);
    $s=str_replace('вгрем','',$s);
    $s=str_replace('пврем','',$s);
    $s=str_replace('гврем','',$s);
    $s=str_replace('апрем','',$s);
    $s=str_replace('зпрем','',$s);
    $s=str_replace('днрэс','',$s);
    $s=str_replace('инрэс','',$s);
    $s=str_replace('кррэс','',$s);
    $s=str_replace('жврэс','',$s);
    $s=str_replace('стіл','',$s);
    $s=str_replace('спс','',$s);
    $s=str_replace('сдізп','',$s);
    $s=str_replace('промбаза','',$s);
    $s=str_replace('стп','',$s);
    $s=str_replace('ситис','',$s);
    $s=str_replace('дільниця гвард. пврем','',$s);
    $ss='';
    $j=0;

    $pos1 = strpos($s, '(');
    $p1=0;
    if (!$pos1 === false) {
        $p1=1;
    }
    $pos2 = strpos($s, ')');
    $p2=0;
    if (!$pos2 === false) {
        $p2=1;
    }
    $p=$p1*$p2;

    $let=0;
    for($i=0;$i<$y;$i++)
    {
        $flag = 0;
        $c=mb_substr($s,$i,1,"UTF-8");
        if($c==')') $let=0;

        if ($c == '(' && $p==1) $let = 1;
       // if (($c >= 'a' && $c<='z') || ($c >= 'A' && $c<='Z')) $flag = 1;

//        echo $c;
        switch ($c) {
            case 'а':
                $flag = 1;
                break;
            case 'о':
                $flag = 1;
                break;
            case 'и':
                $flag = 1;
                break;
            case 'е':
                $flag = 1;
                break;
            case 'ё':
                $flag = 1;
                break;
            case 'ы':
                $flag = 1;
                break;
            case 'у':
                $flag = 1;
                break;
            case 'ю':
                $flag = 1;
                break;
            case 'я':
                $flag = 1;
                break;
            case 'і':
                $flag = 1;
                break;
            case 'є':
                $flag = 1;
                break;
            case 'э':
                $flag = 1;
                break;
            case ' ':
                $flag = 1;
                break;
            case '_':
                $flag = 1;
                break;
            case '№':
                $flag = 1;
                break;
            case '%':
                $flag = 1;
                break;
            case '!':
                $flag = 1;
                break;
            case ';':
                $flag = 1;
                break;
            case ':':
                $flag = 1;
                break;
            case '#':
                $flag = 1;
                break;
            case '$':
                $flag = 1;
                break;
            case '^':
                $flag = 1;
                break;
            case '&':
                $flag = 1;
                break;
            case '*':
                $flag = 1;
                break;
            case '(':
                $flag = 1;
                break;
            case ')':
                $flag = 1;
                break;
            case '[':
                $flag = 1;
                break;
            case ']':
                $flag = 1;
                break;
            case '{':
                $flag = 1;
                break;
            case '}':
                $flag = 1;
                break;
            case '<':
                $flag = 1;
                break;
            case '>':
                $flag = 1;
                break;
            case '?':
                $flag = 1;
                break;
            case '/':
                $flag = 1;
                break;
            case '~':
                $flag = 1;
                break;
            case '"':
                $flag = 1;
                break;
            case "'":
                $flag = 1;
                break;
            case 'ї':
                $flag = 1;
                break;
            case '|':
                $flag = 1;
                break;
            case "\\":
                $flag = 1;
                break;
            case "-":
                $flag = 1;
                break;
            case "+":
                $flag = 1;
                break;
            case "x":
                $flag = 1;
                break;
            case "=":
                $flag = 1;
                break;
        }
        if ($flag == 0 && $let==0) {

            $ss = $ss . $c;
            $a[$j] = $c;
            $j++;
        }

    }
    if($j>0)
        sort($a);
    else
        $a=[];
//  echo $ss;
    return  implode('',$a);
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

// Функция работает с массивом как с SQL таблицей с помощью
// sql выражений
/*
 * $sql - sql выражение
 * $arr - массив с данными
 */
function a2sql($sql,$arr){
    $sql = ltrim(rtrim($sql));
    // Узнаем тип запроса
    $first = strpos($sql,' ');
       
    $vid = strtolower(substr($sql,0,$first));
    
    $type = 0;
    switch($vid){
        case 'select': 
            $type = 1;
            break;
        case 'update': 
            $type = 2; 
             break;
        case 'insert': 
            $type = 3;  
             break;
        case 'delete': 
            $type = 4;
             break;
    }
       
    // Обработка select запроса
    if($type==1){
    $from = strpos($sql,'from');
    $fields = substr($sql,6,$from-6);    // Имена полей
    $fields = ltrim(rtrim($fields));
    $t1 = substr($sql,$from+5);
    $first_space = strpos(ltrim($t1),' ');
    if($first_space==0) 
        $tabl = substr($t1,0);  // Имя массива(таблицы) - откуда берутся данные
    else
        $tabl = substr($t1,0,$first_space);  // Имя массива(таблицы) - откуда берутся данные
    //Определяем наличие оператора where
    $t2 = ltrim(substr($t1,0+$first_space));
  
    $where = strpos($t2,'where');
    
    $t3 = ltrim(substr($t2,0+$where+5));    // Поисковое выражение

    $where_space = strpos($t3,' ');

    $where_pole = substr($t3,0,$where_space);
    $where_oper = ltrim(rtrim(substr($t3,0+$where_space,3)));
    if($where_oper=='!=')
        $where_oper='<>';
    
    $orderby = strpos($t3,'order by');
    if($orderby==0)
         $where_val = ltrim(rtrim(substr($t3,0+$where_space+3)));
    else
         $where_val = ltrim(rtrim(substr($t3,0+$where_space+3,$orderby-$where_space-3)));
    
    $data_where['pole'][0] = ltrim(rtrim($where_pole));
    $data_where['oper'][0] = ltrim(rtrim($where_oper));
    $data_where['val'][0] = ltrim(rtrim($where_val));

//    debug($data_where);
//
//    debug('t1='.$t1);
//    debug('t2='.$t2);
//    debug('t3='.$t3);
//    debug('where='.$where);

    if(is_numeric($data_where['val'][0]))
        $data_where['datatype'][0] = 'i';  // число
    else
        $data_where['datatype'][0] = 's';  // строка
    //debug($data_where);
    
    //Определяем наличие оператора order by
    $orderby = strpos($t2,'order by');
    if($orderby===false){
        
    }
    else{
    $t_sort = ltrim(substr($t2,0+$orderby+8));    // Выражение для сортировки
    $orderby_space = strpos($t_sort,' '); 
    $orderby_pole = substr($t_sort,0,$orderby_space);
    $orderby_vid = substr($t_sort,0+$orderby_space);
    $data_orderby['pole'][0] = ltrim(rtrim($orderby_pole));
    $data_orderby['vid'][0] = ltrim(rtrim($orderby_vid));
    
    }
    
    if(!isset($data_orderby['pole'][0])){
        $data_orderby['pole'][0] = '';
        $data_orderby['vid'][0] = '';
    }
    
//    debug($data_where);
//    debug($data_orderby);
    //return;
    
        
    if($fields=='*')
    {
        if($where === false && $orderby === false)
            $res = $arr;
        else{
            
            $res=proc_where($arr,$fields,$where,$orderby,$data_where,$data_orderby);
        }
            
    }
    else
    {
        $res=proc_where($arr,$fields,$where,$orderby,$data_where,$data_orderby);
    }
     return $res;
    }
}

// Анализ и разбор where и order by выражений в sql запросе
// применяется внутри функции a2sql
// Аргументы:
// $arr - исходный массив, $fields - отбираемые поля (прописаные в select) 
// $where - поисковое выражение, $data_where - массив поисковых данных,
// $data_orderby - массив данных для сортировки
function proc_where($arr,$fields,$where,$orderby,$data_where,$data_orderby)
{

        $keys = array_keys($arr);
        $k = count($keys);
        $field = explode(',',$fields);
        for($i=0;$i<$k;$i++){
            
            if($fields<>'*'){
                if($where === false && $orderby === false)
                {if (!in_array($keys[$i], $field))
                    continue;
                }
            }
            $k1 = count($arr[$keys[$i]]);
            for($j=0;$j<$k1;$j++){
                if($where === false)
                    $res[$keys[$i]][$j]=$arr[$keys[$i]][$j];
                
                else
                { $line = -1;
                  if (in_array($keys[$i], $data_where['pole'])){
                    
                      if($data_where['oper'][0]=='='){
                          if($data_where['val'][0]=='i')
                          {if(ltrim(rtrim($arr[$keys[$i]][$j]))==$data_where['val'][0])
                              $line = $j;
                          }
                          else{
                               $data_where['val'][0] = del_quote($data_where['val'][0]);
//                              debug($arr);
//                              debug($keys);
//                              return;

                              if(ltrim(rtrim($arr[$keys[$i]][$j]))==$data_where['val'][0])
                                $line = $j;
                          }
                      }
                      if($data_where['oper'][0]=='>'){
                          if($data_where['val'][0]=='i')
                          {if(ltrim(rtrim($arr[$keys[$i]][$j]))>$data_where['val'][0])
                              $line = $j;
                          }
                          else{
                               $data_where['val'][0] = del_quote($data_where['val'][0]);
                              if(ltrim(rtrim($arr[$keys[$i]][$j]))>$data_where['val'][0])
                                $line = $j;
                          }
                      }
                      if($data_where['oper'][0]=='>='){
                         if($data_where['val'][0]=='i')
                          {if(ltrim(rtrim($arr[$keys[$i]][$j]))>=$data_where['val'][0])
                              $line = $j;
                          }
                          else{
                               $data_where['val'][0] = del_quote($data_where['val'][0]);
                              if(ltrim(rtrim($arr[$keys[$i]][$j]))>=$data_where['val'][0])
                                $line = $j;
                          }
                      }
                      if($data_where['oper'][0]=='<'){
                          if($data_where['val'][0]=='i')
                          {if(ltrim(rtrim($arr[$keys[$i]][$j]))<$data_where['val'][0])
                              $line = $j;
                          }
                          else{
                               $data_where['val'][0] = del_quote($data_where['val'][0]);
                              if(ltrim(rtrim($arr[$keys[$i]][$j]))<$data_where['val'][0])
                                $line = $j;
                          }
                      }
                       if($data_where['oper'][0]=='<='){
                          if($data_where['val'][0]=='i')
                          {if(ltrim(rtrim($arr[$keys[$i]][$j]))<=$data_where['val'][0])
                              $line = $j;
                          }
                          else{
                               $data_where['val'][0] = del_quote($data_where['val'][0]);
                              if(ltrim(rtrim($arr[$keys[$i]][$j]))<=$data_where['val'][0])
                                $line = $j;
                          }
                      }
                      if($data_where['oper'][0]=='<>'){
                          if($data_where['val'][0]=='i')
                          {if(ltrim(rtrim($arr[$keys[$i]][$j]))<>$data_where['val'][0])
                              $line = $j;
                          }
                          else{
                               $data_where['val'][0] = del_quote($data_where['val'][0]);
                              if(ltrim(rtrim($arr[$keys[$i]][$j]))<>$data_where['val'][0])
                                $line = $j;
                          }
                      }
                  
                  if($line<>-1)
                  {
                    for($i1=0;$i1<$k;$i1++){  
                    if($fields<>'*'){
                    if (!in_array($keys[$i1], $field))
                        continue;
                    }
                    $kk = count($arr[$keys[$i1]]);
                    $res[$keys[$i1]][$line]=$arr[$keys[$i1]][$line];
                      
                 }
                }
                
        }}
        
    }
        } 
       
        if(!empty($data_orderby['pole'][0])){
            //Сортировка данных 
            $pole = $data_orderby['pole'][0];
            if($data_orderby['vid'][0]=='asc')
                asort($res[$pole]);  // По возрастанию
            else {
                arsort($res[$pole]); // По убыванию
            }
            
            // Переиндексация массива
            $a = array_keys($res);
            $i = 0;                                   
            foreach($res[$pole] as $k => $v){
                $key = $k;
                $res1[$pole][$i] = $v;
                foreach($a as $q){
                     if(trim($q)<>trim($pole)){
                         $temp = $res[$q][$key];
                         $res1[$q][$i] = $temp;
                       }
                }
                $i++;
            }
            $res = $res1;   
            $k = count($keys);
            for($i=0;$i<$k;$i++){
                if (!in_array($keys[$i], $field))
                    //continue;
                    unset($res[$keys[$i]]);
                }
                
        }
        
        if(!isset($res))
            return 0;
        else
            return $res;
}        
// Функция убирает кавычки в начале и в конце строки
function del_quote($str){
    $c_begin = substr($str,0,1);  // Первый символ строки
    $y = strlen($str);
    $c_end = substr($str,$y-1,1); // Последний символ строки
    $kod_begin = ord($c_begin);
    $kod_end = ord($c_end);
    $flag=1;
    if(($kod_begin==34 || $kod_begin==39) && ($kod_end==34 || $kod_end==39)){
        // Если первый и последний символ ' или "
        $dest = substr($str,1);
        $dest = substr($dest,0,$y-2);
        $flag=0;
    }
    
    if($flag)
        $dest = $str;  // Если не было кавычек - то возвращается исходная строка
    
    return $dest;
}
   
// Получение кода Unicode символа
function uniord($ch) {

     $n = ord($ch{0});

     if ($n < 128) { 
         return $n; // no conversion required 
     }

     if ($n < 192 || $n > 253) { 
         return false; // bad first byte || out of range 
     }

     $arr = array(1 => 192, // byte position => range from 
                  2 => 224, 
                  3 => 240, 
                  4 => 248, 
                  5 => 252, 
                  );

     foreach ($arr as $key => $val) { 
         if ($n >= $val) { // add byte to the 'char' array 
             $char[] = ord($ch{$key}) - 128; 
             $range  = $val; 
         } else { 
             break; // save some e-trees 
         } 
     }

     $retval = ($n - $range) * pow(64, sizeof($char));

     foreach ($char as $key => $val) { 
         $pow = sizeof($char) - ($key + 1); // invert key 
         $retval += $val * pow(64, $pow);   // dark magic 
     }

     return $retval; 
}

// Получение символа Unicode по коду UTF-8
function uchr ($codes) {
    if (is_scalar($codes)) $codes= func_get_args();
    $str= '';
    foreach ($codes as $code) {
        
        if($code>128)
            $str.= html_entity_decode('&#'.$code.';',ENT_NOQUOTES,'UTF-8');
        else
            $str.=chr($code);
    }
    return $str;
}

// Перестановка соседних символов в с троке
function transposition($str) {
        $rf='';
        $s2='';
        $kol = strlen($str);
        if($kol%2==0)
            $all = $kol-1;
        else
            $all = $kol;
        for($i=0;$i<$all;$i+=2) {
            $s1 = mb_substr($str,$i,1,"UTF-8");
            $s2='';
            if(($i+1)<$kol)
                 $s2 = mb_substr($str,$i+1,1,"UTF-8");

           $rf = $rf . $s2 . $s1;
        }
        return $rf;
}

// Переворот строки
function str_reverse($str) {
        $r='';
        $y = strlen($str);
        for($i=$y-1;$i>=0;$i--) {
            $c = mb_substr($str,$i,1,"UTF-8");
            $r.= $c;
        }
        return $r;
}

// Преобразование строки пароля в последовательность чисел
// $p - строка пароля
function passwd2num($p) {
if(!empty($p)) {
        $kol = mb_strlen($p,"UTF-8");
        $shift = [];
        for($i=0;$i<$kol;$i++) {
            $s = mb_substr($p,$i,1,"UTF-8");
            $c = uniord($s);  // Получение UTF-8 кода символа
            if($c>1039 && $c<1072)
                $shift[$i] = $c-1039;
            if($c>1071)
                $shift[$i] = $c-1071;
            if(($c>32) && ($c<48))
                $shift[$i] = $c-32;
            if(is_numeric($s))
                 $shift[$i] = $c-48;
            if($c>96 && $c<123)
                $shift[$i] = $c-96;
            if($c>64 && $c<97)
                $shift[$i] = $c-64;
            if($c>57 && $c<65)
                $shift[$i] = $c-57;
            if($c>122 && $c<128)
                 $shift[$i] = $c-122;
            if($c<33)
                 $shift[$i] = 1;    
        } 
        return $shift;
    }
    else {
        return [0];
    }
    
}

/* Кодирование строки в сответствии с алгоритмом
* Аргументы: 
* $r - кодируемая строка
* $shift - массив номеров - для сдвига символов в строке (подготавливается функцией passwd2num)
*/
function code_str($r,$shift,$type=0) {
$res = '';
if(!empty($r)) {
        $cnt = count($shift);
        $kol = mb_strlen($r,"UTF-8");
        $ic=0;
        for($i=0;$i<$kol;$i++) {
              $s = mb_substr($r,$i,1,"UTF-8");
              $code = uniord($s);  // Получение UTF-8 кода символа
              
            //              return;
              
              $shft = $shift[$ic];                         
//              if($code>32 && $code<128){
//                    $code++;
////                  $shft = $shft%10;
////                  $code = $code + $shft;
//              }
              if($code>32 && $code<128){
//                    $code++;
                 $shft = $shft%3;
                 $code = $code + $shft;
              }
             
              if($code>128)
                  $code = $code + $shft;

              $c = uchr($code);
              $res.=$c;
              $ic++;
              if($ic>($cnt-1))
                  $ic = 0;
         } 
    }
    return $res;
}

/* Декодирование строки в сответствии с алгоритмом
* Всего 3 варианта алгоритма декодирования
* Аргументы: 
* $r - кодируемая строка
* $shift - массив номеров - для сдвига символов в строке (подготавливается функцией passwd2num)
* $type - вид кодирования: 
* 0 - только сдвиг символов - если пароль 0 - то сдвига не происходит - аргумент по умолчанию
* 1 - сдвиг и перестановка соседних символов строки после реверса строки
* 2 - выполняется то же что и для 1, но после этого происходит еще раз сдвиг
*     в соответствии с перевернутым массивом shift.
* Эта функция обратна функции str_code
*/
function decode_str($r,$shift) {
    $dec_res='';
    if(!empty($r)) {
        $cnt = count($shift);
        $kol = mb_strlen($r,"UTF-8");
        $ic=0;
        for($i=0;$i<$kol;$i++) {
              $s = mb_substr($r,$i,1,"UTF-8");
              $code = uniord($s);  // Получение UTF-8 кода символа
              $shft = $shift[$ic];                         
//              if($code>32 && $code<129){
//                  $code--;
////                  $shft = $shft%10;
////                  $code = $code - $shft;
//              }  
              
              if($code>32 && $code<131){
//                    $code++;
                 $shft = $shft%3;
                 $code = $code - $shft;
              }
              
              if($code>130)
                  $code = $code - $shft;

              $c = uchr($code);
              $dec_res.=$c;
              $ic++;
              if($ic>($cnt-1))
                  $ic = 0;
         }     
    }          
   return $dec_res;
    
}
/* Кодирование строки в сответствии с алгоритмом
* Всего 3 варианта алгоритма кодирования
* Аргументы: 
* $r - кодируемая строка
* $shift - массив номеров - для сдвига символов в строке (подготавливается функцией passwd2num)
* $type - вид кодирования: 
* 0 - только сдвиг символов - если пароль 0 - то сдвига не происходит - аргумент по умолчанию
* 1 - сдвиг и перестановка соседних символов строки после реверса строки
* 2 - выполняется то же что и для 1, но после этого происходит еще раз сдвиг
*     в соответствии с перевернутым массивом shift.
*/
function str_code($r,$shift,$type=0) {
        $res = code_str($r,$shift);
        if($type>0){
            $res = str_reverse($res);
            $res = transposition($res);
        }
        if($type==2){
            $shift = array_reverse($shift);
            $res = code_str($res,$shift);
        }
        return $res;
}    

/* Декодирование строки в сответствии с алгоритмом
* Всего 3 варианта алгоритма декодирования
* Аргументы: 
* $r - кодируемая строка
* $shift - массив номеров - для сдвига символов в строке (подготавливается функцией passwd2num)
* $type - вид кодирования: 
* 0 - только сдвиг символов - если пароль 0 - то сдвига не происходит - аргумент по умолчанию
* 1 - сдвиг и перестановка соседних символов строки после реверса строки
* 2 - выполняется то же что и для 1, но после этого происходит еще раз сдвиг
*     в соответствии с перевернутым массивом shift.
* Эта функция обратна функции str_code
*/
function str_decode($r,$shift,$type=0) {
         if($type==2){
            $shift = array_reverse($shift);
            $r = decode_str($r,$shift);
            $shift = array_reverse($shift);
         }
         if($type<>0)
         {
             $r = transposition($r);
             $r = str_reverse($r);
         }
         $dec_res = decode_str($r,$shift);
   return $dec_res;
  }
  
  // Удаление пробелов из строки
    function del_space($str) {
        $y= mb_strlen($str);
        $s = '';
        for($i=0;$i<=$y;$i++){
            $s1=substr($str,$i,1);
            $n=ord($s1);
            //echo ord($s1).'  ';
            if($n<>194 && $n<>160) $s.=$s1;
        }
        return $s;
    }

function translit($s) {
    $s = (string) $s; // преобразуем в строковое значение
    $s = strip_tags($s); // убираем HTML-теги
    $s = str_replace(array("\n", "\r"), " ", $s); // убираем перевод каретки
    $s = preg_replace("/\s+/", ' ', $s); // удаляем повторяющие пробелы
    $s = trim($s); // убираем пробелы в начале и конце строки
   // $s = function_exists('mb_strtolower') ? mb_strtolower($s) : strtolower($s); // переводим строку в нижний регистр (иногда надо задать локаль)
    $s = strtr($s, array('а'=>'a','б'=>'b','в'=>'v','г'=>'g','д'=>'d','е'=>'e','ё'=>'e','ж'=>'j','з'=>'z','и'=>'i','і'=>'i','й'=>'y','к'=>'k','л'=>'l','м'=>'m','н'=>'n','о'=>'o','п'=>'p','р'=>'r','с'=>'s','т'=>'t','у'=>'u','ф'=>'f','х'=>'h','ц'=>'c','ч'=>'ch','ш'=>'sh','щ'=>'shch','ы'=>'y','э'=>'e','ю'=>'yu','я'=>'ya','ъ'=>'','ь'=>'','.'=>'.'));
    $s = strtr($s, array('А'=>'A','Б'=>'B','В'=>'V','Г'=>'G','Д'=>'D','Е'=>'E','ё'=>'E','Ж'=>'J','З'=>'Z','И'=>'I','І'=>'I','Й'=>'Y','К'=>'K','Л'=>'L','М'=>'M','Н'=>'N','О'=>'O','П'=>'P','Р'=>'R','С'=>'S','Т'=>'T','У'=>'U','Ф'=>'F','Х'=>'H','Ц'=>'C','Ч'=>'Ch','Ш'=>'Sh','Щ'=>'Shch','Ы'=>'Y','Э'=>'E','Ю'=>'Yu','Я'=>'Ya','Ъ'=>'','Ь'=>'','.'=>'.'));
//    $s = preg_replace("/[^0-9a-z-_ ]/i", "", $s); // очищаем строку от недопустимых символов
//    $s = str_replace(" ", "-", $s); // заменяем пробелы знаком минус
    return $s; // возвращаем результат
}

// Генерация n-битного 16 ричного случайного числа
function gen16($n) {
    $res='';
    for($i=0;$i<$n;$i++){
        $r=rand(0,15);
        $r= base_convert($r, 10, 16);
        $res.=$r;
    }
    return $res;
}

// Функции для САП
// Выгрузка по бытовым партнерам
function f_partner_ind($n_struct,$rem,$v) {
        $oldkey_const='04_C'.$rem.'B_';

        $r = $v['id'];
        $tax_number=trim($v['tax_number']);
        $last_name=$v['last_name'];
        preg_match("/[А-Яа-яіІєЄїЇiIoOaAeE'\s]+/u", $last_name, $matches,PREG_OFFSET_CAPTURE);
        if(isset($matches[0][0]))
            $last_name=$matches[0][0];
        $name_first=str_replace('"','',$v['name']);

        preg_match("/[А-Яа-яіІєЄїЇiIoOaAeE'\s]+/u", $name_first, $matches,PREG_OFFSET_CAPTURE);
        if(isset($matches[0][0]))
            $name_first=$matches[0][0];
        $namemiddle=$v['patron_name'];
        preg_match("/[А-Яа-яіІєЄїЇiIoOaAeE'\s]+/u", $namemiddle, $matches,PREG_OFFSET_CAPTURE);
        if(isset($matches[0][0]))
            $namemiddle=$matches[0][0];

        $town=$v['town'];
        $town_cek=$v['town_cek'];
        $post_code1=$v['post_index'];
        $street = $v['street'];
        $street_cek = $v['street_cek'];
        $house_num1 =$v['house'];
        $korp=$v['korp'];
        $l_c=0;
        if (ctype_digit($korp)) {
            $l_c = 1;
//            $korp = 'корп. '.$korp;
        }
        else {
            if (!empty($korp))
            {
               // $house_num1=$house_num1.$korp;
            }
        }
        $house_num1 =str_replace(' ','',$house_num1);
        $house_num1 =str_replace('"','',$house_num1);
        $roomnumber=$v['flat'];
        $roomnumber =str_replace('"','',$roomnumber);
        $region=$v['region'];
        $tel_number=normal_tel($v['mob_phone']);

        if (!empty($tel_number)) $chind_tel="I"; else $chind_tel='~';
        $smtp_addr=$v['e_mail'];
        if (!empty($smtp_addr)) $chind_smtp="I"; else $chind_smtp='~';
        $iuru_pro=$v['kod_reg'];
        $pasport=$v['pasport'];

        if(!empty($tel_number)) $tel_mobile='3';
        else  $tel_mobile='';

        if(strlen($tax_number)<>10) $tax_number='';

        if(empty($tax_number) || is_null($tax_number)) {
            $tax_number=$pasport;
            $id_type='FS0002';}

        else{
            $id_type='FS0001';
        }
        $flag_inn=1;
        if((empty($tax_number) || is_null($tax_number)) && (empty($pasport) || is_null($pasport))) {
            $tax_number='~';
            $id_type='~';
            $flag_inn=0;
        }

        $oldkey = $oldkey_const . $r;

        if($n_struct=='INIT')
                $z = "insert into sap_init(old_key,dat_type,bu_type,bu_group,bpkind,role1,role2,valid_from_1,chind_1,valid_from_2,chind_2)
                    values('$oldkey','$n_struct','1','01','0001','MKK','','00010101','I','','')";

        if($n_struct=='EKUN')

            $z = "insert into sap_ekun(old_key,dat_type1,fkua_rsd,fkua_ris)
                    values('$oldkey','$n_struct','1','3')";

        if($n_struct=='BUT000')
            $z = "insert into sap_but000(old_key,dat_type2,bu_sort1,bu_sort2,source,augrp,name_last,
                                       name_first,xsexm,xsexf,birthdt,namemiddle,xsexu,zprocind)
                    values('$oldkey','$n_struct','$tax_number','~','0006','IND',$$$last_name$$,$$$name_first$$,
                           '~','~','~',$$$namemiddle$$,'X','X')";


        if($n_struct=='BUT020') {
            if (($rem=='03' && trim($street_cek)=="Металург" ) ||
              (mb_substr($street_cek,0,3,'UTF-8')=='с-т' ||
                mb_substr($street_cek,0,5,'UTF-8')=='ОК-СТ'||
                trim($street_cek)=='Садове товариство'))
                // Если садовое товарищество
            {
                // Определяем город для садовых товариществ
                $sql = 'select town from addr_sap where town like' . "'%" . $town_cek . "%'" .
                    " and trim(note)='Дніпропетровська' limit 1";
                $data = data_from_server($sql, (int) $rem, 1);
                if(!empty($data))
                    $town=$data[0]['town'];
                else
                    $town='';

                $sql = 'select * from  post_index_sap where town like ' . "'%" . $town_cek . "%'" .
                       ' and trim(obl)='."'Дніпропетровська' limit 1";


                $data = data_from_server($sql, (int) $rem, 1);

                if(!empty($data))
                    $post_code1=$data[0]['post_index'];
                else
                    $post_code1='';

                $z = "insert into sap_but020(old_key,dat_type3,adext_addr,chind_addr,city1,post_code1,
                                         post_code2,po_box,street,house_num1,house_num2,str_suppl1,
                                         str_suppl2,roomnumber,region,chind_tel,tel_number,chind_smtp,
                                         smtp_addr,tel_mobile,iuru_pro)
                    values('$oldkey','$n_struct','$r','I',$$$town$$,'$post_code1','~','~','~',
                          '~','~',$$$street_cek$$,'$house_num1','$roomnumber','$region','$chind_tel','$tel_number','$chind_smtp',
                          '$smtp_addr','$tel_mobile','$iuru_pro')";
            }
            else {
                if ($l_c == 1)
                    $z = "insert into sap_but020(old_key,dat_type3,adext_addr,chind_addr,city1,post_code1,
                                         post_code2,po_box,street,house_num1,house_num2,str_suppl1,
                                         str_suppl2,roomnumber,region,chind_tel,tel_number,chind_smtp,
                                         smtp_addr,tel_mobile,iuru_pro)
                    values('$oldkey','$n_struct','$r','I',$$$town$$,'$post_code1','~','~',$$$street$$,
                          '$house_num1','$korp','~','~','$roomnumber','$region','$chind_tel','$tel_number','$chind_smtp',
                          '$smtp_addr','$tel_mobile','$iuru_pro')";
                else
                    $z = "insert into sap_but020(old_key,dat_type3,adext_addr,chind_addr,city1,post_code1,
                                         post_code2,po_box,street,house_num1,house_num2,str_suppl1,
                                         str_suppl2,roomnumber,region,chind_tel,tel_number,chind_smtp,
                                         smtp_addr,tel_mobile,iuru_pro)
                    values('$oldkey','$n_struct','$r','I',$$$town$$,'$post_code1','~','~',$$$street$$,
                          '$house_num1','~','~','~','$roomnumber','$region','$chind_tel','$tel_number','$chind_smtp',
                          '$smtp_addr','$tel_mobile','$iuru_pro')";
            }
        }

       if($n_struct=='BUT0ID')
        if ($flag_inn)
        $z = "insert into sap_but0id(old_key,dat_type4,idnumber,id_type)
                    values('$oldkey','$n_struct','$tax_number','$id_type')";
        else
            $z = "insert into sap_but0id(old_key,dat_type4,idnumber,id_type)
                    values('$oldkey','$n_struct','~','~')";


     //Yii::$app->db_pg_pv_abn_test->createCommand($z)->execute();
    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_abn->createCommand($z)->queryAll();
            break;

        case 2:
            Yii::$app->db_pg_zv_abn->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_abn->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_abn->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_abn->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_abn->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_abn->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_abn->createCommand($z)->queryAll();
            break;
    }

}

// Выгрузка по юридическим партнерам
/**
 * @param $n_struct
 * @param $rem
 * @param $v
 */
function f_partner($n_struct, $rem, $v) {
    $oldkey_const='04_C'.$rem.'P_';
    $r = $v['id'];

   // -------------------------

   $bu_type = $v['bu_type'];
   $bu_group = $v['bu_group'];
   $bpkind = $v['bpkind'];
   $role1 = $v['role1'];
   $role2 = $v['role2'];
   $valid_from_1=$v['valid_from_1'];
   $valid_from_2=$v['valid_from_2'];
   $chind_2 = $v['chind_2'];
   $bu_sort1 = $v['bu_sort1'];
   $bu_sort2 = $v['bu_sort2'];
   $name_org1 = $v['name_org1'];
   $name_org2 = $v['name_org2'];
   $name_org3 = $v['name_org3'];
   $name_org4 = $v['name_org4'];
   //$roomnumber = $v['flat'];
    $roomnumber = '~';  // Уточнить
   $legal_enty = $v['legal_enty'];
   $liquid_dat = $v['liquid_dat'];
   $zfilcode = $v['zfilcode'];
   $zfilhead = $v['zfilhead'];
   $zprocind = $v['zprocind'];
   $zcodeformown=$v['zcodeformown'];
   $zcodebankroot=$v['zcodebankroot'];
   $zcodelicense=$v['zcodelicense'];
   $znameall=$v['znameall'];
   $zz_nameshort=$v['zz_nameshort'];
   // Удаление левых символов в коротком названии
    $zz_nameshort= str_replace('суб+','',$zz_nameshort);
//    $zz_nameshort= str_replace('ПМР+','',$zz_nameshort);
    $zz_nameshort= str_replace('АВШ+','',$zz_nameshort);
    $zz_nameshort= str_replace(' АВШ','',$zz_nameshort);
//    $zz_nameshort= str_replace(' ПМР','',$zz_nameshort);
    $zz_nameshort= str_replace(' суб ','',$zz_nameshort);
    $zz_nameshort= str_replace(' (відкл) ','',$zz_nameshort);
    $zz_nameshort= str_replace('+','',$zz_nameshort);
    $zz_nameshort= str_replace('*','',$zz_nameshort);
    $zz_nameshort= str_replace('!','',$zz_nameshort);
    $zz_nameshort= str_replace('временно','',$zz_nameshort);
    $zz_nameshort= str_replace('(розділеними меражами)','',$zz_nameshort);
    // Убираем ненужные символы из сокращенного названия
    if ($rem=='02' || $rem=='04' || $rem=='01' || $rem=='05') {
        if (mb_substr(trim($zz_nameshort), 0, 2, 'UTF-8') == 'Р ') {
            $yyy = mb_strlen(trim($zz_nameshort), 'UTF-8');
            $zz_nameshort = mb_substr(trim($zz_nameshort), 2, $yyy - 2, 'UTF-8');
        }
    }
    if ($rem=='01') {
        if (mb_substr(trim($zz_nameshort), 0, 3, 'UTF-8') == 'РП ') {
            $yyy = mb_strlen(trim($zz_nameshort), 'UTF-8');
            $zz_nameshort = mb_substr(trim($zz_nameshort), 3, $yyy - 3, 'UTF-8');
        }
    }
    if ($rem=='05') {
        if (mb_substr(trim($zz_nameshort), 0, 3, 'UTF-8') == 'ПР ') {
            $yyy = mb_strlen(trim($zz_nameshort), 'UTF-8');
            $zz_nameshort = mb_substr(trim($zz_nameshort), 3, $yyy - 3, 'UTF-8');
        }
    }
   $zz_document=$v['zz_document'];
   $chind_tel=$v['chind_tel'];
   $chind_smtp=$v['chind_smtp'];
   $tel_number=normal_tel($v['tel_number']);
    if (!empty($tel_number)) $chind_tel="I"; else $chind_tel='~';

   if(empty($tel_mobile))
        $tel_mobile=define_type_tel(substr($v['tel_number'],0,3));
   $idnumber=$v['idnumber'];
   $id_type=$v['id_type'];

   // ------------------------

    $town=trim($v['town_sap']);
    $post_code1=trim($v['post_index_sap']);
    $street = trim($v['street_sap']);
    $house_num1 =trim($v['house']);
    $house_num2=trim($v['flat']);
    $house_num1=str_replace(' ','',$house_num1);
    $house_num2=str_replace(' ','',$house_num2);
    $region=$v['reg'];

    $smtp_addr=$v['e_mail'];
    if (!empty($smtp_addr)) $chind_smtp="I"; else $chind_smtp='~';
    $iuru_pro=$v['numobl'];

    $oldkey = $oldkey_const . $r;
    $str_supll1='~';
    $str_supll2='~';
    $wo = $v['town_wo'];

   // Если садовое товарищество
    if(!empty($wo)) {
            $dacha[1] = 'Дачна';
            $dacha[2] = 'Сонячна';
            $dacha[3] = 'Богатирська';
            $dacha[4] = 'Всемогутня';
            $dacha[5] = 'Довгожителів';
            $dacha[6] = 'Совісті та честі';
            $dacha[7] = 'Розумна';
            $dacha[8] = 'Добра';
            $dacha[9] = 'Світлих душ';
            $dacha[10] = 'Взаємовиручки';
            $dacha[11] = 'Добрих побажань';
            $dacha[12] = 'Всепроникаючого щастя';
            $dacha[13] = 'Ентузіастів';
            $dacha[14] = 'Оптимістів';
            $dacha[15] = 'Істини';
            $dacha[16] = 'Правдивої історії';
            $dacha[17] = 'Міцного здоровя';
            $dacha[18] = 'Безмежних можливостей';
            $dacha[19] = 'Могутньої волі';
            $dacha[20] = 'Старанності';
            $dacha[21] = 'Трудолюбів';
            $dacha[22] = 'Добрих справ';
            $dacha[23] = 'Величності людини';
            $dacha[24] = 'Высокой морали';
            $dacha[25] = 'Человечности';

//            $u_r=rand(1,23);
            $str_supll1 = str_replace("'",'`',trim($v['street_wo']));
            if(empty($str_supll1))
                $str_supll1 = $dacha[10];
            $str_supll2 = $house_num1;
            $town = trim($v['town_wo']);
            $post_code1 = trim($v['ind_wo']);
            $region=trim($v['reg_wo']);;
            $iuru_pro=$v['numobl'];
    }

    if($n_struct=='INIT')
        $z = "insert into sap_init(oldkey,dat_type,bu_type,bu_group,bpkind,role1,role2,valid_from_1,chind_1,valid_from_2,chind_2)
                    values('$oldkey','$n_struct','$bu_type','$bu_group','$bpkind','$role1','$role2','$valid_from_1',
                    'I','$valid_from_2','$chind_2')";

    if($n_struct=='EKUN')

        $z = "insert into sap_ekun(oldkey,dat_type,fkua_rsd,fkua_ris)
                    values('$oldkey','$n_struct','1','3')";

    if($n_struct=='BUT000')
        $z = "insert into sap_but000(oldkey,dat_type,bu_sort1,bu_sort2,source,augrp,name_org1,
                                       name_org2,name_org3,name_org4,legal_enty,liquid_dat,zfilcode,zfilhead,
                                       zprocind,zcodeformown,zcodebankroot,zcodelicense,znameall,zz_nameshort,zz_document)
                    values('$oldkey','$n_struct','$bu_sort1','$bu_sort2','0006','LEG',$$$name_org1$$,$$$name_org2$$,
                           $$$name_org3$$,$$$name_org4$$,'$legal_enty','$liquid_dat','$zfilcode','$zfilhead',
                           '$zprocind','$zcodeformown','$zcodebankroot',
                           '$zcodelicense','$znameall','$zz_nameshort','$zz_document')";


    if($n_struct=='BUT020')
        $z = "insert into sap_but020(oldkey,dat_type,adext_addr,chind_addr,city1,post_code1,
                                         post_code2,po_box,street,house_num1,house_num2,str_supll1,
                                         str_supll2,roomnumber,region,chind_tel,tel_number,chind_fax,
                                         fax_number,chind_smtp,
                                         smtp_addr,tel_mobile,iuru_pro)
                    values('$oldkey','$n_struct','$r','I',$$$town$$,'$post_code1','~','~',$$$street$$,
                          '$house_num1','$house_num2',$$$str_supll1$$,'$str_supll2','$roomnumber',$$$region$$,'$chind_tel','$tel_number','~','~',
                          '$chind_smtp','$smtp_addr','$tel_mobile','$iuru_pro')";

    if($n_struct=='BUT021')

        $z = "insert into sap_but021(oldkey,dat_type,adext_advw,adr_kind,xdfadu)
                    values('$oldkey','$n_struct','$r','CEKPOST','X')";

    if($n_struct=='BUT0ID')

        $z = "insert into sap_but0id(oldkey,dat_type,idnumber,id_type)
                    values('$oldkey','$n_struct','$idnumber','$id_type')";

    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_energo->createCommand($z)->queryAll();
            break;
        case 2:
            Yii::$app->db_pg_zv_energo->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_energo->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_energo->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_energo->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_energo->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_energo->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_energo->createCommand($z)->queryAll();
            break;
    }

}

function f_account($n_struct, $rem, $v) {
    $oldkey_const='04_C'.$rem.'P_';
    $r = $v['id'];
    $gpart = $v['gpart'];
    $vktyp = $v['vktyp'];

    $vkona = $v['vkona'];
    $zdaterep = $v['zdaterep'];
    if(empty($zdaterep)) $zdaterep='01';
    $partner=$v['partner'];
    $opbuk=$v['opbuk'];
    $ebvty = '';
    $abvty = '';
    $abwvk = '';
    $ikey = $v['ikey'];

    $mahnv = $v['mahnv'];
    $begru = $v['begru'];
    $adrnb_ext = $v['adrnb_ext'];
    $zahlkond = $v['zahlkond'];
    $vertyp = $v['vertyp'];

    $kofiz_sd = $v['kofiz_sd'];
    $kzabsver = $v['kzabsver'];
    $stdbk = $v['stdbk'];
    $fkru_fis = $v['fkru_fis'];
    $zsector=$v['zsector'];
    $znodev=$v['znodev'];
    $zz_ministry=$v['zz_ministry'];
    $zz_start=$v['zz_start'];
    $zz_end=$v['zz_end'];
    $zz_budget=$v['zz_budget'];
    $zz_territory=$v['zz_territory'];
    $zz_categ=$v['zz_categ'];
    if(empty($zz_categ)) $zz_categ='03';
    if(empty($zz_territory)) $zz_territory='1';

    $date_from=$v['date_from'];
    $date_to=$v['date_to'];
    $obj=$v['obj'];
    $status=$v['status'];
    $date_reg=$v['date_reg'];
    $price=$v['price'];
    $comments=$v['comments'];
    $loevm=$v['loevm'];

    $oldkey = $oldkey_const . $r;
    $id=$v['id_str'];
    $id=str_pad($id, 5, "0", STR_PAD_LEFT);

    if($n_struct=='INIT')
        $z = "insert into sap_init_acc(oldkey,dat_type,gpart,vktyp,vkona)
                    values('$oldkey','$n_struct','$gpart','$vktyp','$vkona')";

    if($n_struct=='VK')
        $z = "insert into sap_vk(oldkey,dat_type,zdaterep,znodev)
                    values('$oldkey','$n_struct','$zdaterep','$znodev')";

    if($n_struct=='VKP')
        $z = "insert into sap_vkp(oldkey,dat_type,partner,opbuk,ebvty,abvty,abwvk,
                                       ikey,mahnv,begru,adrnb_ext,
                                       zahlkond,vertyp,kofiz_sd,kzabsver,stdbk,fkru_fis,zsector,zz_ministry,
                                       zz_start,zz_end,zz_budget,zz_territory,zz_categ)
                    values('$oldkey','$n_struct','$partner','$opbuk','$ebvty','$abvty',$$$abwvk$$,
                           $$$ikey$$,$$$mahnv$$,'$begru','$adrnb_ext','$zahlkond','$vertyp',
                           '$kofiz_sd','$kzabsver','$stdbk','$fkru_fis',
                           '$zsector','$zz_ministry','$zz_start','$zz_end','$zz_budget','$zz_territory','$zz_categ')";

//    if($n_struct=='KVV')
//        $z = "insert into sap_kvv(oldkey,dat_type,date_from,date_to)
//                    values('$oldkey','$n_struct','$date_from','$date_to')";
//
    // Информация по договорам
    if($n_struct=='ZSTAT')

        $z = "insert into sap_zstat(oldkey,dat_type,id,obj,status,date_reg,date_to,price,comments,loevm)
                    values('$oldkey','$n_struct','$id','$obj','$status','$date_reg',
                    '$date_to','$price','$comments','$loevm')";


    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_energo->createCommand($z)->queryAll();
            break;
        case 2:
            Yii::$app->db_pg_zv_energo->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_energo->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_energo->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_energo->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_energo->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_energo->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_energo->createCommand($z)->queryAll();
            break;
    }

}

function f_account_ind($n_struct, $rem, $v,$vid) {
    $oldkey_const='04_C'.$rem.'B_';
    $r = $v['id'];
    $gpart = $v['gpart'];
    $vktyp = $v['vktyp'];
    $vkona = $v['vkona'];
    $partner=$v['partner'];
    $opbuk=$v['opbuk'];
//    $ikey = $v['ikey'];
    $ikey = '~';
    $begru = $v['begru'];
    $adrnb_ext = $v['adrnb_ext'];
    $zahlkond = $v['zahlkond'];
    $kzabsver = $v['kzabsver'];
    $stdbk = $v['stdbk'];
    $zz_start=$v['zz_start'];
    $zz_start= str_replace('-','',$zz_start);
    $zz_end=$v['zz_end'];
    $zz_begin=$v['zz_begin'];
    $zz_territory=$v['zz_territory'];
    $zz_is_pc=$v['zz_is_pc'];
    $zz_is_eh=$v['zz_is_eh'];
    $zz_is_gf=$v['zz_is_gf'];
    $zz_area_id=$v['zz_area_id'];
    $znodev = $v['znodev'];
    $oldkey = $oldkey_const . $r;
    $kofiz_sd=$r;

    if($n_struct=='INIT')
        $z = "insert into sap_init_acc(oldkey,dat_type,gpart,vktyp,vkona)
                    values('$oldkey','$n_struct','$gpart','$vktyp','$vkona')";

    if($n_struct=='VK')
        $z = "insert into sap_vk(oldkey,dat_type,znodev)
                    values('$oldkey','$n_struct','$znodev')";

    if($n_struct=='VKP')
        $z = "insert into sap_vkp(oldkey,dat_type,partner,opbuk,ikey,begru,adrnb_ext,
                                  zahlkond,kzabsver,stdbk,zz_start,zz_end,zz_begin,zz_territory,
                                  zz_is_pc,zz_is_fc,zz_is_eh,zz_is_gf,zz_area_id)
                    values('$oldkey','$n_struct','$partner','$opbuk','$ikey','$begru','$adrnb_ext','$zahlkond',
                           '$kzabsver','$stdbk','$zz_start','$zz_end','$zz_begin','$zz_territory',
                           '$zz_is_pc','~','$zz_is_eh','$zz_is_gf','$zz_area_id')";

    exec_on_server($z,(int) $rem,$vid);
}

function f_devloc_ind($n_struct, $rem, $v,$vid) {
    $oldkey_const='04_C'.$rem.'B_';
    $r = $v['id'];
    $haus = $v['haus'];
    $vstelle = $v['vstelle'];
    $swerk = $v['swerk'];
    $stort=$v['stort'];
    $begru = $v['begru'];
    $oldkey = $oldkey_const . $r;

    if($n_struct=='EGPLD')
        $z = "insert into sap_egpld(oldkey,dat_type,haus,vstelle,swerk,stort,begru,pltxt)
                    values('$oldkey','$n_struct','$haus','$vstelle','$swerk','$stort','$begru','~')";

    exec_on_server($z,(int) $rem,$vid);
}

// Выгрузка по объектам соединения бытовые
function f_connobj_ind($n_struct,$rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
//    $r = $v['id'];
    // Создание переменных
    foreach($v as $k=>$v1) {
        eval('$'.$k.'='.'"'.$v1.'"'.';');

    }

    $r = hash('crc32', $v['kod_reg'].'~'.$v['town'].'~'.$v['type_street'].'~'.
        $v['street'].'~'.$v['house'].'~'.$v['korp']);

    $town=$v['town_sap'];
    $id=$v['id'];
    $street = $v['street_sap'];
    $street_cek = $v['street'];

    $house_num1 =mb_strtoupper(trim($v['house']),'UTF-8');
    $house_num1 = str_replace(' ','',$house_num1);
    $house_num1 =str_replace('"','',$house_num1);
    $region=$v['region'];
    $iuru_pro=$v['kod_reg'];

    $begru=$v['begru'];
    $swerk=$v['swerk'];
    $stort=$v['stort'];
    $type_street=$v['type_street'];
    $korp=$v['korp'];

//    if (!empty($korp)) {
//        if(ctype_digit($korp)) {
//            $house_num1 = $house_num1 . '/' . $korp;
//        }
//    }

    if (empty($korp)) $korp = '~';
    if(!ctype_digit($korp)) {
       $korp = '~';
    }

    $oldkey = $oldkey_const . strtoupper($r);
    if (!(($rem=='03' && trim($street_cek)=="Металург" ) ||
        (mb_substr(trim($street_cek),0,3,'UTF-8')=='с-т' ||
            mb_substr(trim($street_cek),0,5,'UTF-8')=='ОК-СТ'||
            trim($street_cek)=='Садове товариство')))
    $sql="select distinct b2.post_index
        from clm_paccnt_tbl a
        left join vw_address c on
        a.id=c.id 
       left join addr_sap b1 on
        trim(lower(c.street))=trim(lower(get_sap_street(b1.street))) 
        and case when trim(lower(get_sap_street(b1.street)))='запорізьке шосе' then  lower(trim(c.type_street))='вул.'
        else coalesce(lower(trim(c.type_street)),'')=coalesce(lower(trim(get_typestreet(b1.street))),'') end 
         and trim(lower(b1.town))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end ||' '||trim(lower(c.town))))
         left join (select distinct numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) b2 on b1.numtown=b2.numtown -- and b2.post_index=c.indx --and c.indx is not null
        where a.id=$id and b2.post_index is not null ";
else
    $sql="select distinct b2.post_index
        from clm_paccnt_tbl a
        left join vw_address c on
        a.id=c.id 
       left join addr_sap b1 on
         trim(lower(b1.town))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end ||' '||trim(lower(c.town))))
         left join (select distinct numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) b2 on b1.numtown=b2.numtown -- and b2.post_index=c.indx --and c.indx is not null
        where a.id=$id and b2.post_index is not null";

//$ef=fopen('aaaaaaaa.fff','w+');
//fputs($ef,$sql);

    // Получаем необходимые данные
    switch ($rem) {
        case 1:
            $data1 = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
            break;

        case 2:
            $data1 = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
            break;
        case 3:
            $data1 = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
            break;
        case 4:
            $data1 = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
            break;
        case 5:
            $data1 = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
            break;
        case 6:
            $data1 = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
            break;
        case 7:
            $data1 = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
            break;
        case 8:
            $data1 = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
            break;
    }

if(isset($data1[0]['post_index']))
    $post_code1=$data1[0]['post_index'];
else
    $post_code1='';

// Определяем город для садовых товариществ
    if (($rem=='03' && trim($street_cek)=="Металург" ) ||
        (mb_substr(trim($street_cek),0,3,'UTF-8')=='с-т' ||
            mb_substr(trim($street_cek),0,5,'UTF-8')=='ОК-СТ'||
            trim($street_cek)=='Садове товариство'))
    { $town = $v['town'];
        $pos      = strripos($town, "'");
        if ($pos === false) {
       ;
    } else {
            $y=mb_strlen($town,"UTF-8");
            $town  = mb_substr($town,$pos,$y-($pos),"UTF-8") ;
            $sql = 'select town from addr_sap where (town like' . "'%" . "$town" . "%'" . ' or '. "trim(town)="."'$town'".
                ") and trim(note)='Дніпропетровська' limit 1";


    }
        $sql = 'select town from addr_sap where (town like' . "'%" . "$town" . "%'" . ' or '. "trim(town)="."'$town'".
            ") and trim(note)='Дніпропетровська' limit 1";

//       debug($sql);
//        return;

        $data = data_from_server($sql, (int) $rem, 1);
        if(!empty($data))
            $town=$data[0]['town'];
        else
            $town='';
    }

    if($n_struct=='CO_EHA') {
        $z = "insert into sap_co_eha(oldkey,dat_type,pltxt,begru,swerk,stort)
                    values('$oldkey','$n_struct','~','$begru','$swerk','$stort')";

        // Создание строки INSERT
//        $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
//        $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//
//        $z = "insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";

    }

    if($n_struct=='CO_ADR')

        if (($rem=='03' && trim($street_cek)=="Металург" ) ||
            (mb_substr(trim($street_cek),0,3,'UTF-8')=='с-т' ||
                mb_substr(trim($street_cek),0,5,'UTF-8')=='ОК-СТ'||
                trim($street_cek)=='Садове товариство')) {
            // Если садовое товарищество

            $z = "insert into sap_co_adr(oldkey,dat_type,city1,post_code1,
                                         street,house_num1,str_suppl1,str_suppl2,region,iuru_pro,cek_type_street,house_num2)
                    values('$oldkey','$n_struct',$$$town$$,'$post_code1','~',
                          '~',$$$street_cek$$,'$house_num1','$region','$iuru_pro','$type_street','$korp')";
        }
       else
       $z = "insert into sap_co_adr(oldkey,dat_type,city1,post_code1,
                                         street,house_num1,str_suppl1,str_suppl2,region,iuru_pro,cek_type_street,house_num2)
                    values('$oldkey','$n_struct',$$$town$$,'$post_code1',$$$street$$,
                          '$house_num1','~','~','$region','$iuru_pro','$type_street','$korp')";

    //Yii::$app->db_pg_pv_abn_test->createCommand($z)->execute();
    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_abn->createCommand($z)->queryAll();
            break;

        case 2:
            Yii::$app->db_pg_zv_abn->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_abn->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_abn->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_abn->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_abn->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_abn->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_abn->createCommand($z)->queryAll();
            break;
    }

}

// Выгрузка по объектам соединения юридические
function f_connobj($n_struct,$rem,$v) {
    $oldkey_const='04_C'.$rem.'P_';
    $r = $v['id'];
    $town=$v['town_sap'];
    $post_code1=trim($v['post_index']);
    $street = $v['street_sap'];
    $house_num1 =$v['house'];
    $house_num1=str_replace(' ','',$house_num1);
//    $roomnumber=$v['flat'];
    $house_num2=$v['house_num2'];
    $pltxt='';
    $begru=$v['begru'];
    $swerk='C01M';
    $stort=$v['stort'];
    $iuru_pro=$v['numobl'];
    $region=$v['reg'];

    $oldkey = $oldkey_const . $r;
    $str_supll1 = '~';
    $str_supll2 = '~';
    $wo = $v['town_wo'];
    // Если садовое товарищество
    if(!empty($wo)) {
        $str_supll1 = str_replace("'",'`',trim($v['street_wo']));
        if(empty($str_supll1))
            $str_supll1 = 'вул. Взаємовиручки';
        $str_supll2 = $house_num1;
        $town = trim($v['town_wo']);
        $post_code1 = trim($v['ind_wo']);
//        $region='DNP';
        $region=trim($v['reg_wo']);;
        $iuru_pro=$v['numobl'];
    }

    if($n_struct=='CO_EHA')
        $z = "insert into sap_co_eha(oldkey,dat_type,pltxt,begru,swerk,stort)
                    values('$oldkey','$n_struct','$pltxt','$begru','$swerk','$stort')";


    if($n_struct=='CO_ADR')

        $z = "insert into sap_co_adr(oldkey,dat_type,city1,post_code1,
                                         street,house_num1,str_suppl1,str_suppl2,region,iuru_pro,house_num2)
                    values('$oldkey','$n_struct',$$$town$$,'$post_code1',$$$street$$,
                          '$house_num1','$str_supll1','$str_supll2',$$$region$$,'$iuru_pro','$house_num2')";

    //Yii::$app->db_pg_pv_abn_test->createCommand($z)->execute();
    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_energo->createCommand($z)->queryAll();
            break;
        case 2:
            Yii::$app->db_pg_zv_energo->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_energo->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_energo->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_energo->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_energo->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_energo->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_energo->createCommand($z)->queryAll();
            break;
    }

}

// Выгрузка по premise бытовые
function f_premise_ind($n_struct,$rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
    $r = $v['id'];
    $town=$v['town'];
    $post_code1=$v['indx'];
    $street = $v['street'];
    $haus =$v['haus'];
    $roomnumber=$v['flat'];
    $region=$v['region'];
    $iuru_pro=$v['kod_reg'];
    $pltxt='C01B';
    $begru=$v['begru'];
    $swerk=$v['swerk'];
    $stort=$v['stort'];

    $oldkey = $oldkey_const . $r;

    if($n_struct=='EVBSD')
        $z = "insert into sap_evbsd(oldkey,dat_type,haus,haus_num2,lgzusatz,vbsart,begru)
                    values('$oldkey','$n_struct','$haus','$roomnumber','~','B0001','$pltxt')";

    //$z = "insert into sap_evbsd(oldkey,dat_type,haus,haus_num2,lgzusatz,vbsart,begru)";

    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_abn->createCommand($z)->queryAll();
            break;

        case 2:
            Yii::$app->db_pg_zv_abn->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_abn->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_abn->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_abn->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_abn->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_abn->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_abn->createCommand($z)->queryAll();
            break;
    }

}

// Выгрузка по premise бытовые
function f_premise_ind_new($n_struct,$rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
    $r = $v['id'];
    $town=$v['town'];
    $post_code1=$v['indx'];
    $street = $v['street'];
    $haus =$v['haus'];
    $roomnumber=$v['flat'];
    $roomnumber=str_replace('"','',$roomnumber);
    $region=$v['region'];
    $iuru_pro=$v['kod_reg'];
    $pltxt='C01B';
    $begru=$v['begru'];
    $swerk=$v['swerk'];
    $stort=$v['stort'];
    $oldkey = $oldkey_const . $r;

  //  if($n_struct=='EVBSD')
//        $z = "insert into sap_evbsd(oldkey,dat_type,haus,haus_num2,lgzusatz,vbsart,begru)
//                    values('$oldkey','$n_struct','$haus','$roomnumber','~','B0001','$pltxt')";

   //$z = "insert into sap_evbsd(oldkey,dat_type,haus,haus_num2,lgzusatz,vbsart,begru)";
       $ret="('$oldkey','$n_struct','$haus','$roomnumber','~','B0001','$pltxt')";
       return $ret;

}

// Выгрузка по device бытовые
function f_device_ind($n_struct,$rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
    $r = $v['id'];
    $eqart=$v['eqart'];
    $baujj=$v['baujj'];
    $datab = str_replace('-','',$v['datab']);
    $kostl =$v['kostl'];
    $bukrs='CK01';
    $matnr=mb_strtoupper($v['matnr'],'UTF-8');
    $sernr=$v['sernr'];
    $zz_pernr=$v['zz_pernr'];
    $cert_date=$v['cert_date'];
    $bgljahr=$v['bgljahr'];
    $begru=$v['begru'];
    $swerk=$v['swerk'];
    $stort=$v['stort'];
    $zwgruppe=$v['zwgruppe'];

    // Корректность года поверки
    if($bgljahr<$baujj) {
        $y1 = '0819';
        $bgljahr=$baujj+1;
        // create date's poverka
        switch ($bgljahr%10) {
            case 0:
                $y1 = '0512';
                break;
            case 1:
                $y1 = '0217';
                break;
            case 2:
                $y1 = '0316';
                break;
            case 3:
                $y1 = '1215';
                break;
            case 4:
                $y1 = '0109';
                break;
            case 5:
                $y1 = '0923';
                break;
            case 6:
                $y1 = '0302';
                break;
            case 7:
                $y1 = '1127';
                break;
            default:  '0819';
        }

        $cert_date = $bgljahr.$y1 ;
    }
    if(empty($bgljahr)) {
        $bgljahr=$baujj+1;
        $cert_date = $bgljahr . '0216';
    }

    $oldkey = $oldkey_const . $r;

    if($n_struct=='EQUI')
        $z = "insert into sap_equi(oldkey,dat_type,begru,eqart,baujj,datab,swerk,stort,kostl,bukrs,
                                    matnr,sernr,zz_pernr,cert_date)
                    values('$oldkey','$n_struct','$begru','$eqart','$baujj','$datab','$swerk','$stort',
                            '$kostl','$bukrs','$matnr','$sernr','$zz_pernr','$cert_date')";
    if($n_struct=='EGERS')
        $z = "insert into sap_egers(oldkey,dat_type,bgljahr)
                    values('$oldkey','$n_struct','$bgljahr')";

    if($n_struct=='EGERH')
        $z = "insert into sap_egerh(oldkey,dat_type,ab,zwgruppe,wgruppe)
                    values('$oldkey','$n_struct','$datab','$zwgruppe','~')";

    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_abn->createCommand($z)->queryAll();
            break;

        case 2:
            Yii::$app->db_pg_zv_abn->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_abn->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_abn->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_abn->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_abn->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_abn->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_abn->createCommand($z)->queryAll();
            break;
    }

}

// Выгрузка по device юридические
function f_device($n_struct,$rem,$v,$vid) {
    $oldkey_const='04_C'.$rem.'P_';
    $r = $v['id'];
    $eqart=$v['eqart'];
    $baujj=$v['baujj'];
    if(((int) $baujj)==2020) $baujj='2019';
    $datab = $v['datab'];
    $datab = str_replace('-','',$datab);
    $kostl =$v['kostl'];
    $bukrs='CK01';
    $matnr=$v['matnr'];
    $sernr=$v['sernr'];

    $zz_pernr=$v['zz_pernr'];
    $cert_date=$v['cert_date'];
//    $bgljahr=$v['bgljahr'];
    $bgljahr=$v['bgljahr'];
    $begru=$v['begru'];
//    $swerk=$v['swerk'];
    $swerk='C01M';
    $stort=$v['stort'];
    $zwgruppe=$v['zwgruppe'];
    $wgruppe=$v['wgruppe'];

    $oldkey = $oldkey_const . $r;

    if($n_struct=='EQUI')
        $z = "insert into sap_equi(oldkey,dat_type,begru,eqart,baujj,datab,swerk,stort,kostl,bukrs,
                                    matnr,sernr,zz_pernr,cert_date)
                    values('$oldkey','$n_struct','$begru','$eqart','$baujj','$datab','$swerk','$stort',
                            '$kostl','$bukrs','$matnr','$sernr','$zz_pernr','$cert_date')";
    if($n_struct=='EGERS')
        $z = "insert into sap_egers(oldkey,dat_type,bgljahr)
                    values('$oldkey','$n_struct','$bgljahr')";

    if($n_struct=='EGERH')
        $z = "insert into sap_egerh(oldkey,dat_type,ab,zwgruppe,wgruppe)
                    values('$oldkey','$n_struct','$datab','$zwgruppe','$wgruppe')";

    exec_on_server($z,(int) $rem,$vid);
}


// Выгрузка по premise юридические
function f_premise($n_struct,$rem,$v) {
    $haus=$v['haus'];
    $zz_nameplvn = $v['name_eqp'];
    $house_num2 =$v['house_num2'];
    $pltxt=$v['pltxt'];
    $oldkey = $v['oldkey'];

    if($n_struct=='EVBSD')
        $z = "insert into sap_evbsd(oldkey,dat_type,haus,haus_num2,lgzusatz,vbsart,begru,zz_nameplvm)
                    values('$oldkey','$n_struct','$haus','$house_num2','~','P0001','$pltxt',$$$zz_nameplvn$$)";

//    $fff=fopen('a_tst.sql','w+');
//    fputs($fff,$z);

    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_energo->createCommand($z)->queryAll();
            break;
        case 2:
            Yii::$app->db_pg_zv_energo->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_energo->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_energo->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_energo->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_energo->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_energo->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_energo->createCommand($z)->queryAll();
            break;
    }

}

// Выгрузка по devloc юридические
function f_devloc($n_struct,$rem,$v) {
    $haus=$v['haus'];
    $vstelle = $v['vstelle'];
    $swerk =$v['swerk'];
    $stort = $v['stort'];
    $begru = $v['begru'];
//    $oldkey = '04_C04P_'.strtoupper(hash('crc32',$v['id'].random_int(100,1000000)));
    //$oldkey = '04_C04P_'.strtoupper(hash('crc32',$v['id'] ));
    $oldkey = '04_C04P_'.strtoupper(hash('crc32',$v['id'] . $vstelle));
    $oldkey = '04_C04P_'. trim($vstelle);

    if($n_struct=='EGPLD')
        $z = "insert into sap_egpld(oldkey,dat_type,haus,vstelle,swerk,stort,begru,pltxt)
                    values('$oldkey','$n_struct','$haus','$vstelle','$swerk','$stort','$begru','~')";

//    $fff=fopen('a_tst.sql','w+');
//    fputs($fff,$z);

    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_energo->createCommand($z)->queryAll();
            break;
        case 2:
            Yii::$app->db_pg_zv_energo->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_energo->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_energo->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_energo->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_energo->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_energo->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_energo->createCommand($z)->queryAll();
            break;
    }

}

// Выгрузка по пломбам бытовые
function f_seal_ind($n_struct,$rem,$v,$vid) {
    $oldkey_const='04_C'.$rem.'B_01_';
    $r = $v['id'];
    $scat=$v['scat'];
    $scode=$v['scode'];
    $status = $v['status'];
    $color =$v['color'];
    $utmas=$v['utmas'];
    $dpurch=$v['dpurch'];
    $reper=$v['reper'];
    $dissue=$v['dissue'];
    $matnr=mb_strtoupper($v['matnr'],'UTF-8');
    $sernr=$v['sernr'];
    $place=$v['place'];
    $dinst=$v['dinst'];

    $oldkey = $oldkey_const . $r;

    if($n_struct=='AUTO')
        $z = "insert into sap_auto(oldkey,dat_type,scat,scode,status,color,utmas,dpurch,reper,dissue,
                                    matnr,sernr,place,dinst)
                    values('$oldkey','$n_struct','$scat','$scode','$status','$color','$utmas','$dpurch',
                            '$reper','$dissue','$matnr','$sernr','$place','$dinst')";

    exec_on_server($z,(int) $rem,$vid);
}
// Выгрузка по пломбам  юридич.
function f_seals($n_struct,$rem,$v,$vid) {
    $oldkey_const='04_C'.$rem.'P_01_';
    $r = $v['id'];
    $scat=$v['scat'];
    $scode=$v['scode'];
    $status = $v['status'];
    $color =$v['color'];
    $utmas=$v['utmas'];
    $dpurch=$v['dpurch'];
    $reper=$v['reper'];
    $dissue=$v['dissue'];
    $matnr=$v['matnr'];
    $sernr=$v['sernr'];
    $place=$v['place'];
    $place = str_replace("'",'`',$place);
    $dinst=$v['dinst'];

    $oldkey = $oldkey_const . $r;

    if($n_struct=='AUTO')
        $z = "insert into sap_auto(oldkey,dat_type,scat,scode,status,color,utmas,dpurch,reper,dissue,
                                    matnr,sernr,place,dinst)
                    values('$oldkey','$n_struct','$scat','$scode','$status','$color','$utmas','$dpurch',
                            '$reper','$dissue','$matnr','$sernr','$place','$dinst')";

    exec_on_server($z,(int) $rem,$vid);
}

// Выгрузка по линиям  юридич.
function f_zlines($n_struct,$rem,$v,$vid) {
    $day=((int) date('d'))-1;
    $datab = date('Ymd', strtotime("-$day day"));
    $oldkey_const='04_C'.$rem.'P_01_';
    $r = $v['code_eqp'];
    $pnt=$v['pnt'];
    $pnt= substr((1000+$pnt),1,3);
    $line_length=$v['line_length'];
    $id_sap=trim($v['id_sap']);
    //$line_voltage_nom = $v['line_voltage_nom'];
    $line_voltage_nom = $v['voltage'];

    if($line_voltage_nom==0.22 || $line_voltage_nom==0.38)
        $line_voltage_nom = str_replace('.', ',', $line_voltage_nom);
    else
        $line_voltage_nom = (int) $line_voltage_nom;

    $text =$v['text'];
    $oldkey = $oldkey_const . $r;
    $anlage = $oldkey_const . $v['id_point'];
    $text = str_replace("'",'`',$text);

    if($n_struct=='AUTO')
        $z = "insert into sap_auto_zlines(oldkey,dat_type,anlage,linum,frdat,frtim,lityp,length,voltage,state,
                                    wxshr,fshar,xnegp,text,element_id)
                    values('$oldkey','$n_struct','$anlage','$pnt','$datab','000000','$id_sap','$line_length',
                            '$line_voltage_nom','L','100','X','~','$text','$pnt')";

    exec_on_server($z,(int) $rem,$vid);
}

// Выгрузка по линиям  юридич.
function f_ztransf($n_struct,$rem,$v,$vid) {
    $day=((int) date('d'))-1;
    $datab = date('Ymd', strtotime("-$day day"));
    $oldkey_const='04_C'.$rem.'P_01_';
    $r = $v['code_eqp'];
    $pnt=$v['pnt'];
    $pnt= substr((1000+$pnt),1,3);
    $swathe=$v['swathe'];
    $id_sap=$v['id_sap'];
    $text =$v['text'];
    $oldkey = $oldkey_const . $r;
    $anlage = $oldkey_const . $v['id_point'];

    if($n_struct=='AUTO')
        $z = "insert into sap_auto_ztransf(oldkey,dat_type,anlage,frdat,frtim,trcat,trtyp,trsta,
                                    xnegp,text,element_id)
                    values('$oldkey','$n_struct','$anlage','$datab','000000','$swathe','$id_sap',
                            'L','~','$text','$pnt')";

    exec_on_server($z,(int) $rem,$vid);
}


// Выгрузка instln бытовые
function f_instln_ind($n_struct,$rem,$v,$vid) {
$oldkey_const='04_C'.$rem.'B_01_';
$sparte = $v['sparte'];
$spebene = $v['spebene'];
$anlart = $v['anlart'];
$vstelle = trim($v['vstelle']);
$ablesartst = $v['ablesartst'];
$zz_nametu = $v['zz_nametu'];
$zz_fider = $v['zz_fider'];
$ab = $v['ab'];
$ab = str_replace('-','',$ab);
$zz_nametu = str_replace("'",'`',$zz_nametu);
$zz_nametu = str_replace('"','`',$zz_nametu);
$tariftyp = $v['tariftyp'];
$aklasse = $v['aklasse'];
$ableinh = $v['ableinh'];
$begru = $v['begru'];
$branche = $v['branche'];
$zz_eic = $v['eic'];
$oldkey = $oldkey_const . $v['id'];

if ($n_struct == 'DATA')
    $z = " insert into sap_data(oldkey,dat_type,vstelle,spebene,anlart,ablesartst,zz_nametu,zz_fider,ab,tariftyp,branche,aklasse,
            ableinh,zzcode4nkre,zzcode4nkre_dop,zzotherarea,begru,zz_eic)
     values($$$oldkey$$,'$n_struct',$$$vstelle$$,$$$spebene$$,$$$anlart$$,$$$ablesartst$$,".
     "'".$zz_nametu."'".",$$$zz_fider$$,$$$ab$$,'$tariftyp','$branche',$$$aklasse$$,'$ableinh','355','~','~','$begru',$$$zz_eic$$)";

$ff=fopen('aaachack.chk','w+');
fputs($ff,$z);


exec_on_server($z, (int)$rem, $vid);
}

// Выгрузка facts юрид.
function f_facts1($n_struct,$rem,$v,$vid) {
    $day=((int) date('d'))-1;
    $datab = date('Ymd', strtotime("-$day day"));
    $datae1 = date('Ymd', strtotime("last day of this month"));
    $datae='99991231';

    $oldkey_const='04_C'.$rem.'B_01_';
    $avg_dem = $v['avg_dem'];
    $power_allow = $v['power_allow'];
    $power_con = $v['power_con'];
    $react_ = $v['react_'];
    $tg_fi = $v['tg_fi'];
    $factor_hour = $v['factor_hour'];
    $count_lost = $v['count_lost'];
    $safe_category = $v['safe_category'];
    $oldkey = $oldkey_const . $v['id'];

//    1-я строка
          $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'KEY',$$$oldkey$$,'','')";
                    exec_on_server($z, (int)$rem, $vid);
//    $facts[0]['oldkey'] =  $oldkey;
//    $facts[0]['pole1'] =  'KEY';
//    $facts[0]['pole2'] =  $oldkey;
//    $facts[0]['pole3'] = '';
//    $facts[0]['pole4'] = '';


//    2-я строка
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_QUAN','СЕРДБ_А1З','','')";
    exec_on_server($z, (int)$rem, $vid);

    //    3-я строка
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_QUAN','$datab','$datae1','$avg_dem')";
    exec_on_server($z, (int)$rem, $vid);

    //    4-я строка
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_DEMA','ПОТ_ДОЗВ','','')";
    exec_on_server($z, (int)$rem, $vid);

    //    5-я строка
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_DEMA','$datab','$datae','$power_allow')";
    exec_on_server($z, (int)$rem, $vid);

    //    6-я строка
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_DEMA','ПОТ_ПРИКВТ','','')";
    exec_on_server($z, (int)$rem, $vid);

    //    7-я строка
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_DEMA','$datab','$datae','$power_con')";
    exec_on_server($z, (int)$rem, $vid);

    if (!empty($react_)) {
        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_FACT','ТАНГ_ФІ','','')";
        exec_on_server($z, (int)$rem, $vid);
        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_FACT','$datab','$datae','$tg_fi')";
        exec_on_server($z, (int)$rem, $vid);
    }

    //ГРРОБ_ДНІ
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_FACT','ГРРОБ_ДНІ','','')";
    exec_on_server($z, (int)$rem, $vid);
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_FACT','$datab','$datae','7')";
    exec_on_server($z, (int)$rem, $vid);

    //ГРРОБ_ГОДН
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_FACT','ГРРОБ_ГОДН','','')";
    exec_on_server($z, (int)$rem, $vid);
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_FACT','$datab','$datae','$factor_hour')";
    exec_on_server($z, (int)$rem, $vid);

    //Ф_КФГРНАВ
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_FACT','Ф_КФГРНАВ','','')";
    exec_on_server($z, (int)$rem, $vid);
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_FACT','$datab','$datae','1.15')";
    exec_on_server($z, (int)$rem, $vid);
// КАТНАД
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_FACT','КАТНАД','','')";
    exec_on_server($z, (int)$rem, $vid);
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_FACT','$datab','$datae','$safe_category')";
    exec_on_server($z, (int)$rem, $vid);

    //ОЗ_ВТРНАР
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_FLAG','ОЗ_ВТРНАР','','')";
    exec_on_server($z, (int)$rem, $vid);
    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_FLAG','$datab','$datae','$count_lost')";
    exec_on_server($z, (int)$rem, $vid);

//    F_RATE	ВТ_РЕАКТ
    if (!empty($react_)) {
        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_RATE','ВТ_РЕАКТ','','')";
        exec_on_server($z, (int)$rem, $vid);
        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_RATE','$datab','$datae','Р_РОЗР')";
        exec_on_server($z, (int)$rem, $vid);
    }
    if (!empty($gen_)) {
        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'F_RATE','ВТ_ГЕН','','')";
        exec_on_server($z, (int)$rem, $vid);
        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4) 
                     values($$$oldkey$$,'V_RATE','$datab','$datae','Г_РОЗР')";
        exec_on_server($z, (int)$rem, $vid);
    }

}

// Выгрузка facts юрид.
function f_facts($rem,$v) {
    $day=((int) date('d'))-1;
    $datab = date('Ymd', strtotime("-$day day"));
    $datae1 = date('Ymd', strtotime("last day of this month"));
    $datae='99991231';

    $oldkey_const='04_C'.$rem.'P_01_';
    $avg_dem = $v['avg_dem'];
    $power_allow = $v['power_allow'];
    $power_con = $v['power_con'];
    $react_ = $v['react_'];
    $tg_fi = $v['tg_fi'];
    $factor_hour = $v['factor_hour'];
    $count_lost = $v['count_lost'];
    $safe_category = $v['safe_category'];
    $eerm=str_replace(',','.',$v['eerm']);

    $no_lost=$v['no_lost'];
    $main=$v['main'];
    $main_obj=$v['main_obj'];
    $name_tp=$v['name_tp'];
//    if(!empty($name_tp))
    $dmonth=(int) substr($datab,4,2);

    switch($dmonth){
        case 1:
            $value=$v['value1'];
            break;
        case 2:
            $value=$v['value2'];
            break;
        case 3:
            $value=$v['value3'];
            break;
        case 4:
            $value=$v['value4'];
            break;
        case 5:
            $value=$v['value5'];
            break;
        case 6:
            $value=$v['value6'];
            break;
        case 7:
            $value=$v['value7'];
            break;
        case 8:
            $value=$v['value8'];
            break;
        case 9:
            $value=$v['value9'];
            break;
        case 10:
            $value=$v['value10'];
            break;
        case 11:
            $value=$v['value11'];
            break;
        case 12:
            $value=$v['value12'];
            break;

    }

    $oldkey = $oldkey_const . $v['id'];
    $facts=[];

//    1-я строка
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'KEY',$$$oldkey$$,'','')";
//    exec_on_server($z, (int)$rem, $vid);
    $facts['data1'] =  $oldkey.';'.'KEY'.';'.$oldkey.';'.' '.';'.' ';

//    2-я строка
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_QUAN','СЕРДБ_А1З','','')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data2'] =  $oldkey.';'.'F_QUAN'.';'.'СЕРДБ_А1З'.';'.' '.';'.' ';

    //    3-я строка
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_QUAN','$datab','$datae1','$avg_dem')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data3'] =  $oldkey.';'.'V_QUAN'.';'.$datab.';'.$datae1.';'.$avg_dem;
    if(!empty($value) && !empty($main)){
        $facts['data4'] =  $oldkey.';'.'F_QUAN'.';'.'ЛІМ_СПОЖ'.';'.' '.';'.' ';
        $facts['data5'] =  $oldkey.';'.'V_QUAN'.';'.$datab.';'.$datae1.';'.$value;
    }

    //    4-я строка
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_DEMA','ПОТ_ДОЗВ','','')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data6'] =  $oldkey.';'.'F_DEMA'.';'.'ПОТ_ДОЗВ'.';'.' '.';'.' ';

    //    5-я строка
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_DEMA','$datab','$datae','$power_allow')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data7'] =  $oldkey.';'.'V_DEMA'.';'.$datab.';'.$datae.';'.$power_allow;

    //    6-я строка
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_DEMA','ПОТ_ПРИКВТ','','')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data8'] =  $oldkey.';'.'F_DEMA'.';'.'ПОТ_ПРИКВТ'.';'.' '.';'.' ';

    //    7-я строка
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_DEMA','$datab','$datae','$power_con')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data9'] =  $oldkey.';'.'V_DEMA'.';'.$datab.';'.$datae.';'.$power_con;

    if (!empty($react_)) {
//        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_FACT','ТАНГ_ФІ','','')";
//        exec_on_server($z, (int)$rem, $vid);

        $facts['data10'] =  $oldkey.';'.'F_FACT'.';'.'ТАНГ_ФІ'.';'.' '.';'.' ';

//        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_FACT','$datab','$datae','$tg_fi')";
//        exec_on_server($z, (int)$rem, $vid);

        $facts['data11'] =  $oldkey.';'.'V_FACT'.';'.$datab.';'.$datae.';'.$tg_fi;
    if(!empty($eerm)) {
        $facts['data12'] = $oldkey . ';' . 'F_FACT' . ';' . 'ЕЕРП' . ';' . ' ' . ';' . ' ';
        $facts['data13'] = $oldkey . ';' . 'V_FACT' . ';' . $datab . ';' . $datae . ';' . $eerm;
    }
    }

    //ГРРОБ_ДНІ
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_FACT','ГРРОБ_ДНІ','','')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data14'] =  $oldkey.';'.'F_FACT'.';'.'ГРРОБ_ДНІ'.';'.' '.';'.' ';

//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_FACT','$datab','$datae','7')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data15'] =  $oldkey.';'.'V_FACT'.';'.$datab.';'.$datae.';'.'7';

    //ГРРОБ_ГОДН
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_FACT','ГРРОБ_ГОДН','','')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data16'] =  $oldkey.';'.'F_FACT'.';'.'ГРРОБ_ГОДН'.';'.' '.';'.' ';

//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_FACT','$datab','$datae','$factor_hour')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data17'] =  $oldkey.';'.'V_FACT'.';'.$datab.';'.$datae.';'.$factor_hour;

    //Ф_КФГРНАВ
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_FACT','Ф_КФГРНАВ','','')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data18'] =  $oldkey.';'.'F_FACT'.';'.'Ф_КФГРНАВ'.';'.' '.';'.' ';

//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_FACT','$datab','$datae','1.15')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data19'] =  $oldkey.';'.'V_FACT'.';'.$datab.';'.$datae.';'.'1.15';

// КАТНАД
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_FACT','КАТНАД','','')";
//    exec_on_server($z, (int)$rem, $vid);

    $facts['data20'] =  $oldkey.';'.'F_FACT'.';'.'КАТНАД'.';'.' '.';'.' ';

//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_FACT','$datab','$datae','$safe_category')";
//    exec_on_server($z, (int)$rem, $vid);

        $facts['data21'] = $oldkey . ';' . 'V_FACT' . ';' . $datab . ';' . $datae . ';' . $safe_category;
    if (!empty($count_lost)) {
        $facts['data22'] = $oldkey . ';' . 'F_FLAG' . ';' . 'ОЗ_ВТРНАР' . ';' . ' ' . ';' . ' ';
//    $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_FLAG','$datab','$datae','$count_lost')";
//    exec_on_server($z, (int)$rem, $vid);
        $facts['data23'] = $oldkey . ';' . 'V_FLAG' . ';' . $datab . ';' . $datae . ';' . $count_lost;
    }
    if (!empty($no_lost)) {
        $facts['data24'] =  $oldkey.';'.'F_FLAG'.';'.'ОЗ_БЕЗВТР'.';'.' '.';'.' ';
        $facts['data25'] =  $oldkey.';'.'V_FLAG'.';'.$datab.';'.$datae.';'.$no_lost;
    }
    if (!empty($main)) {
        $facts['data26'] =  $oldkey.';'.'F_FLAG'.';'.'ОЗ_ГОПЛВМ'.';'.' '.';'.' ';
        $facts['data27'] =  $oldkey.';'.'V_FLAG'.';'.$datab.';'.$datae.';'.$main;
    }
    if (!empty($main_obj)) {
        $facts['data28'] =  $oldkey.';'.'F_FLAG'.';'.'ОЗ_ГОЛОБ'.';'.' '.';'.' ';
        $facts['data29'] =  $oldkey.';'.'V_FLAG'.';'.$datab.';'.$datae.';'.$main_obj;
    }
    if (!empty($name_tp)) {
        $facts['data30'] =  $oldkey.';'.'F_FLAG'.';'.'ОЗ_ТП'.';'.' '.';'.' ';
        $facts['data31'] =  $oldkey.';'.'V_FLAG'.';'.$datab.';'.$datae.';'.'X';
    }


//    F_RATE	ВТ_РЕАКТ
    if (!empty($react_)) {
//        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_RATE','ВТ_РЕАКТ','','')";
//        exec_on_server($z, (int)$rem, $vid);

        $facts['data32'] =  $oldkey.';'.'F_RATE'.';'.'ВТ_РЕАКТ'.';'.' '.';'.' ';

//        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_RATE','$datab','$datae','Р_РОЗР')";
//        exec_on_server($z, (int)$rem, $vid);

        $facts['data33'] =  $oldkey.';'.'V_RATE'.';'.$datab.';'.$datae.';'.'Р_РОЗР';
    }
    if (!empty($gen_)) {
//        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'F_RATE','ВТ_ГЕН','','')";
//        exec_on_server($z, (int)$rem, $vid);

        $facts['data34'] =  $oldkey.';'.'F_RATE'.';'.'ВТ_ГЕН'.';'.' '.';'.' ';

//        $z = " insert into sap_facts(oldkey,pole1,pole2,pole3,pole4)
//                     values($$$oldkey$$,'V_RATE','$datab','$datae','Г_РОЗР')";
//        exec_on_server($z, (int)$rem, $vid);

        $facts['data35'] =  $oldkey.';'.'V_RATE'.';'.$datab.';'.$datae.';'.'Г_РОЗР';

    }

    $facts['data36'] =  $oldkey.';'.'&ENDE'.';'.' '.';'.' '.';'.' ';

return $facts;
}

// Выгрузка facts быт.
function f_facts_ind($rem,$v) {

    $datae='99991231';

    $oldkey_const='04_C'.$rem.'B_01_';
    $dem_0 = $v['dem_0'];
    $dem_9 = $v['dem_9'];
    $dem_10 = $v['dem_10'];
    $dem_6 = $v['dem_6'];
    $dem_7 = $v['dem_7'];
    $dem_8 = $v['dem_8'];
    $power = $v['power'];
    $plita = $v['plita'];
    $opal = $v['opal'];
    $datab = $v['datab'];
    $datab = str_replace('-','',$datab);
//    $datae1 = $v['mmgg_end'];
    $datae1=date("Y-m-d",strtotime('+1 month', strtotime($datab)));

    $datae1=date("Y-m-d",strtotime('-1 day', strtotime($datae1)));
    $datae1 = str_replace('-','',$datae1);
    $oldkey = $oldkey_const . $v['id'];
    $facts=[];

    $facts['data1'] =  $oldkey.';'.'KEY'.';'.$oldkey.';'.' '.';'.' ';
    if (!empty($dem_0)) {
        $facts['data2'] = $oldkey . ';' . 'F_QUAN' . ';' . 'СЕРДБ_А1З' . ';' . ' ' . ';' . ' ';
        $facts['data3'] = $oldkey . ';' . 'V_QUAN' . ';' . $datab . ';' . $datae1 . ';' . $dem_0;
    }
    if (!empty($dem_9)) {
        $facts['data4'] = $oldkey . ';' . 'F_QUAN' . ';' . 'СЕРДБ_А2Н' . ';' . ' ' . ';' . ' ';
        $facts['data5'] = $oldkey . ';' . 'V_QUAN' . ';' . $datab . ';' . $datae1 . ';' . $dem_9;
    }
    if (!empty($dem_10)) {
        $facts['data6'] = $oldkey . ';' . 'F_QUAN' . ';' . 'СЕРДБ_А2Д' . ';' . ' ' . ';' . ' ';
        $facts['data7'] = $oldkey . ';' . 'V_QUAN' . ';' . $datab . ';' . $datae1 . ';' . $dem_10;
    }
    if (!empty($dem_6)) {
        $facts['data8'] = $oldkey . ';' . 'F_QUAN' . ';' . 'СЕРДБ_А3Н' . ';' . ' ' . ';' . ' ';
        $facts['data9'] = $oldkey . ';' . 'V_QUAN' . ';' . $datab . ';' . $datae1 . ';' . $dem_6;
    }
    if (!empty($dem_7)) {
        $facts['data10'] = $oldkey . ';' . 'F_QUAN' . ';' . 'СЕРДБ_А3НП' . ';' . ' ' . ';' . ' ';
        $facts['data11'] = $oldkey . ';' . 'V_QUAN' . ';' . $datab . ';' . $datae1 . ';' . $dem_7;
    }
    if (!empty($dem_8)) {
        $facts['data12'] = $oldkey . ';' . 'F_QUAN' . ';' . 'СЕРДБ_А3П' . ';' . ' ' . ';' . ' ';
        $facts['data13'] = $oldkey . ';' . 'V_QUAN' . ';' . $datab . ';' . $datae1 . ';' . $dem_8;
    }
    $facts['data14'] =  $oldkey.';'.'F_DEMA'.';'.'ПОТ_ДОЗВ'.';'.' '.';'.' ';
    $facts['data15'] = $oldkey . ';' . 'V_DEMA' . ';' . $datab . ';' . $datae . ';' . $power;

    $facts['data16'] =  $oldkey.';'.'F_FACT'.';'.'КАТНАД'.';'.' '.';'.' ';
    $facts['data17'] = $oldkey . ';' . 'V_FACT' . ';' . $datab . ';' . $datae . ';' . '3';

    if (!empty($opal)) {
        $facts['data18'] = $oldkey . ';' . 'F_FLAG' . ';' . 'ОЗ_ЕЛОПАЛ' . ';' . ' ' . ';' . ' ';
        $facts['data19'] = $oldkey . ';' . 'V_FLAG' . ';' . $datab . ';' . $datae . ';' . $opal;
    }
    if (!empty($plita)) {
        $facts['data20'] = $oldkey . ';' . 'F_FLAG' . ';' . 'ОЗ_ЕЛПЛИТА' . ';' . ' ' . ';' . ' ';
        $facts['data21'] = $oldkey . ';' . 'V_FLAG' . ';' . $datab . ';' . $datae . ';' . $plita;
    }
    $facts['data22'] =  $oldkey.';'.'&ENDE'.';'.' '.';'.' '.';'.' ';
    return $facts;
}

// Выгрузка move_in (заполнение структуры  ever) быт.
function f_move_in_ind($rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
    $oldkey = $oldkey_const . $v['id'];
    $ever=[];
    $ever[0]=$oldkey;
    $ever[1]='EVER';
    $ever[2]=$v['bukrs'];
    $ever[3]=$v['kofiz'];
    $ever[4]=$v['gemfakt'];
    $ever[5]=$v['vbez'];
    $ever[6]=$v['vrefer'];
    $ever[7]=$v['begru'];
    $ever[8]=$v['anlage'];
    $ever[9]=$v['vkonto'];
    $ever[10]=$v['einzdat'];
    $ever[11]=$v['auszdat'];
    $ever[12]=$v['einzdat_alt'];
    $ever[13]=$v['cokey'];
    $ever[14]=$v['zz_pnt'];
    $ever[15]=$v['zz_nodev'];
    $ever[16]=$v['zz_own'];
    $ever[17]=$v['zz_point_num'];
    $ever[18]=$v['zz_plosch_num'];
    $ever[19]=$v['zz_object_num'];
    $ever[20]=$v['zz_pl_obj_num'];
    $ever[21]=$v['zz_paym_dc'];
    $ever[22]='42082379';
    $ever[23]='31793056';
    $ever[24]=$v['zz_distrib_type'];

    return $ever;
}

// Выгрузка move_in (заполнение структуры  ever) юридич.
function f_move_in($rem,$v) {
    $oldkey_const='04_C'.$rem.'P_';
    $oldkey_const1='04_C'.$rem.'P_01_';
    $oldkey = $oldkey_const . $v['id'];
    $vkonto = $oldkey_const1 . $v['id_cl'];
    $ever=[];
    $ever[0]=$oldkey;
    $ever[1]='EVER';
    $ever[2]=$v['bukrs'];
    $ever[3]=$v['kofiz'];
    $ever[4]=$v['gemfakt'];
    $ever[5]=$v['vbez'];
    $ever[6]=$v['vrefer'];
    $ever[7]=$v['begru'];
    $ever[8] = $oldkey;
    $ever[9]= $vkonto;
    $ever[10]= str_replace('-', '',$v['einzdat']);
    $ever[11]=str_replace('-', '',$v['auszdat']);
    $ever[12]=str_replace('-', '',$v['einzdat_alt']);
    $ever[13]=$v['cokey'];
    $ever[14]=$v['zz_pnt'];
    $ever[15]=$v['zz_nodev'];
    $ever[16]=$v['zz_own'];
    $ever[17]=$v['zz_point_num'];
    $ever[18]=$v['zz_plosch_num'];
    $ever[19]=$v['zz_object_num'];
    $ever[20]=$v['zz_pl_obj_num'];
    $ever[21]=$v['zz_paym_dc'];
    $ever[22]=$v['zz_bp_provider'];
    $ever[23]=$v['zz_bp_distrib'];
    $ever[24]=$v['zz_distrib_type'];

    return $ever;
}

// Выгрузка inst_mgmt (заполнение структуры  di_int) быт.
function f_inst_mgmt1_ind($rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
    $oldkey = $oldkey_const . $v['id'];
    $di_int=[];
    $di_int[0]=$oldkey;
    $di_int[1]='DI_INT';
    $di_int[2]=$v['devloc'];
    $di_int[3]=$v['anlage'];
    $di_int[4]=str_replace('-','',$v['eadat']);
    $di_int[5]=$v['action'];
    return $di_int;
}

// Выгрузка inst_mgmt (заполнение структуры  di_zw) быт.
function f_inst_mgmt2_ind($rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
    $oldkey = $oldkey_const . $v['id'];
    $zone=$v['zone'];
    $di_zw=[];

    if($zone==0){
        $di_zw[0][0]=$oldkey;
        $di_zw[0][1]='DI_ZW';
        $di_zw[0][2]='001';
        $di_zw[0][3]='0001';
        $di_zw[0][4]=(int) $v['value_0'];
        $di_zw[0][5]='~';
        $di_zw[0][6]='А_1З';
        $di_zw[0][7]=$v['demand_0'];
        $di_zw[0][8]=$v['equnre'];
        $di_zw[0][9]='30';
        $di_zw[0][10]='0001';

        $di_zw[1][0]=$oldkey;
        $di_zw[1][1]='DI_GER';
        $di_zw[1][2]=$v['equnre'];

        $di_zw[2][0]=$oldkey;
        $di_zw[2][1]='&ENDE';
    }
    if($zone==9){
        $di_zw[0][0]=$oldkey;
        $di_zw[0][1]='DI_ZW';
        $di_zw[0][2]='001';
        $di_zw[0][3]='0001';
        $di_zw[0][4]=(int) $v['value_10'];
        $di_zw[0][5]='~';
        $di_zw[0][6]='А_2ЗД';
        $di_zw[0][7]=$v['demand_10'];
        $di_zw[0][8]=$v['equnre'];
        $di_zw[0][9]='30';
        $di_zw[0][10]='0001';

        $di_zw[1][0]=$oldkey;
        $di_zw[1][1]='DI_ZW';
        $di_zw[1][2]='002';
        $di_zw[1][3]='0001';
        $di_zw[1][4]=(int)  $v['value_9'];
        $di_zw[1][5]='~';
        $di_zw[1][6]='А_2ЗН';
        $di_zw[1][7]=$v['demand_9'];
        $di_zw[1][8]=$v['equnre'];
        $di_zw[1][9]='30';
        $di_zw[1][10]='0001';

        $di_zw[2][0]=$oldkey;
        $di_zw[2][1]='DI_ZW';
        $di_zw[2][2]='003';
        $di_zw[2][3]='~';
        $di_zw[2][4]=(int)  $v['value_all'];
        $di_zw[2][5]='X';
        $di_zw[2][6]='~';
        $di_zw[2][7]='~';
        $di_zw[2][8]=$v['equnre'];
        $di_zw[2][9]='30';
        $di_zw[2][10]='0001';

        $di_zw[3][0]=$oldkey;
        $di_zw[3][1]='DI_GER';
        $di_zw[3][2]=$v['equnre'];

        $di_zw[4][0]=$oldkey;
        $di_zw[4][1]='&ENDE';
    }
    if($zone==6){
        $di_zw[0][0]=$oldkey;
        $di_zw[0][1]='DI_ZW';
        $di_zw[0][2]='001';
        $di_zw[0][3]='0001';
        $di_zw[0][4]=(int)  $v['value_8'];
        $di_zw[0][5]='~';
        $di_zw[0][6]='А_3ЗП';
        $di_zw[0][7]=$v['demand_8'];
        $di_zw[0][8]=$v['equnre'];
        $di_zw[0][9]='30';
        $di_zw[0][10]='0001';

        $di_zw[1][0]=$oldkey;
        $di_zw[1][1]='DI_ZW';
        $di_zw[1][2]='002';
        $di_zw[1][3]='0001';
        $di_zw[1][4]=(int)  $v['value_7'];
        $di_zw[1][5]='~';
        $di_zw[1][6]='А_3ЗНП';
        $di_zw[1][7]=$v['demand_7'];
        $di_zw[1][8]=$v['equnre'];
        $di_zw[1][9]='30';
        $di_zw[1][10]='0001';

        $di_zw[2][0]=$oldkey;
        $di_zw[2][1]='DI_ZW';
        $di_zw[2][2]='003';
        $di_zw[2][3]='0001';
        $di_zw[2][4]=(int)  $v['value_6'];
        $di_zw[2][5]='~';
        $di_zw[2][6]='А_3ЗН';
        $di_zw[2][7]=$v['demand_6'];
        $di_zw[2][8]=$v['equnre'];
        $di_zw[2][9]='30';
        $di_zw[2][10]='0001';

        $di_zw[3][0]=$oldkey;
        $di_zw[3][1]='DI_ZW';
        $di_zw[3][2]='004';
        $di_zw[3][3]='~';
        $di_zw[3][4]=(int)  $v['value_all'];
        $di_zw[3][5]='X';
        $di_zw[3][6]='~';
        $di_zw[3][7]='~';
        $di_zw[3][8]=$v['equnre'];
        $di_zw[3][9]='30';
        $di_zw[3][10]='0001';

        $di_zw[4][0]=$oldkey;
        $di_zw[4][1]='DI_GER';
        $di_zw[4][2]=$v['equnre'];

        $di_zw[5][0]=$oldkey;
        $di_zw[5][1]='&ENDE';
    }
    return $di_zw;
}

function f_discdoc1_ind($rem,$v) {
    $oldkey_const='04_C'.$rem.'B_01_';
    $oldkey = $oldkey_const . $v['id'];
    $di_doc=[];
    $di_doc[0]=$oldkey;     //oldkey
    $di_doc[1]='HEADER';    //datatype
    $di_doc[2]='99';        //DISCREASON
    $di_doc[4]='INSTLN';    //REFOBJTYPE
    $di_doc[5]='~';         //REFOBJKEY
    $di_doc[6]=$oldkey;     //ANLAGE
    $di_doc[7]='~';         //EQUNR
    $di_doc[8]='~';         //VKONTO
    return $di_doc;
}
function f_discdoc2_ind($rem,$v) {
    $oldkey_const='04_C'.$rem.'B_01_';
    $oldkey = $oldkey_const . $v['id'];
    $di_inf=[];
    $di_inf[0]=$oldkey;         //oldkey
    $di_inf[1]='INFO';          //datatype
    $di_inf[3]='42082379';      //ZZ_BP_PROVIDER
    $di_inf[4]='01';            //ZZ_DISCREASON
    return $di_inf;
}

function f_discorder_ind($rem,$v) {
    $oldkey_const='04_C'.$rem.'B_01_';
    $oldkey = $oldkey_const . $v['id'];
    $di_ord=[];
    $di_ord[0]=$oldkey;     //oldkey
    $di_ord[1]='HEADER';    //datatype
    $di_ord[2]=$oldkey;     //ANLAGE
    $di_ord[3]=str_replace('-','',$v['dat']);         //EQUNR
    return $di_ord;
}

function f_discenter_ind($rem,$v) {
    $oldkey_const='04_C'.$rem.'B_01_';
    $oldkey = $oldkey_const . $v['id'];
    $di_ent=[];
    $di_ent[0]=$oldkey;     //oldkey
    $di_ent[1]='HEADER';    //datatype
    $di_ent[2]=$oldkey;     //ANLAGE
    $di_ent[3]=str_replace('-','',$v['dat']);         //EQUNR
    return $di_ent;
}

// Выгрузка instln юридические потребители
function f_instln($n_struct,$rem,$v,$vid) {
    $oldkey_const='04_C'.$rem.'P_01_';
    //$sparte = $v['sparte'];
    $spebene = $v['spebene'];
    $anlart = $v['anlart'];
    $vstelle = $v['vstelle'];
    $ablesartst = $v['ablesartst'];
    $zz_nametu = str_replace('"',' ',$v['zz_nametu']);
    $zz_nametu = str_replace('`',"'",$zz_nametu);
    $zz_nametu = str_replace("'","",$zz_nametu);
//    $zz_nametu = 'weqq';
    $zz_fider = $v['zz_fider'];
    $ab = $v['ab'];
    $ab = str_replace('-', '',$ab);
//    $tariftyp = $v['tariftyp'];
    $tariftyp = $v['tarif_sap'];
    $branche = $v['branche'];
    $aklasse = $v['aklasse'];
    $ableinh = $v['ableinh'];
    $zzcode4nkre = $v['zzcode4nkre'];
    $zzcode4nkre_dop = $v['zzcode4nkre_dop'];
    $zzotherarea = $v['zzotherarea'];
    $begru = $v['begru'];
    $zz_eic = substr($v['zz_eic'],0,16);
    if(ord(substr($zz_eic,15,1))>90)
        $zz_eic = substr($zz_eic,0,15);
    $oldkey = $oldkey_const . $v['id'];;

//    if($v['id']==159223 || $v['id']==158868) return;

    if ($n_struct == 'DATA') {
        $pos = strpos($zz_nametu, "'");

        if(!$pos)
        $z = " insert into sap_data(oldkey,dat_type,vstelle,spebene,anlart,ablesartst,zz_nametu,zz_fider,ab,
                tariftyp,branche,aklasse,ableinh,zzcode4nkre,zzcode4nkre_dop,zzotherarea,begru,zz_eic) 
     values($$$oldkey$$,'$n_struct',$$$vstelle$$,$$$spebene$$,$$$anlart$$,$$$ablesartst$$,
     '$zz_nametu','$zz_fider',$$$ab$$,'$tariftyp','$branche',$$$aklasse$$,'$ableinh',
     '$zzcode4nkre','$zzcode4nkre_dop','$zzotherarea','$begru','$zz_eic');";
        else
        $z = " insert into sap_data(oldkey,dat_type,vstelle,spebene,anlart,ablesartst,zz_nametu,zz_fider,ab,
                tariftyp,branche,aklasse,ableinh,zzcode4nkre,zzcode4nkre_dop,zzotherarea,begru,zz_eic) 
     values($$$oldkey$$,'$n_struct',$$$vstelle$$,$$$spebene$$,$$$anlart$$,$$$ablesartst$$,".
    '$$'.$zz_nametu.'$$'.",'$zz_fider',$$$ab$$,'$tariftyp','$branche',$$$aklasse$$,'$ableinh',
     '$zzcode4nkre','$zzcode4nkre_dop','$zzotherarea','$begru','$zz_eic');";
    }

//    debug($z);
//   return;

    switch ((int) $rem) {
        case 1:
            Yii::$app->db_pg_dn_energo->createCommand($z)->queryAll();
            break;
        case 2:
            Yii::$app->db_pg_zv_energo->createCommand($z)->queryAll();
            break;
        case 3:
            Yii::$app->db_pg_vg_energo->createCommand($z)->queryAll();
            break;
        case 4:
            Yii::$app->db_pg_pv_energo->createCommand($z)->queryAll();
            break;
        case 5:
            Yii::$app->db_pg_krg_energo->createCommand($z)->queryAll();
            break;
        case 6:
            Yii::$app->db_pg_ap_energo->createCommand($z)->queryAll();
            break;
        case 7:
            Yii::$app->db_pg_gv_energo->createCommand($z)->queryAll();
            break;
        case 8:
            Yii::$app->db_pg_in_energo->createCommand($z)->queryAll();
            break;
    }
//    debug($z);
//    return;

//    exec_on_server($z, (int)$rem, $vid);
}

// Выгрузка по ЗАВОДСКИМ пломбам  юридич.
function f_seals2($n_struct,$rem,$v,$vid) {
    $oldkey_const='04_C'.$rem.'P_01_';
    $r = $v['id'];
    $instdate=$v['instdate'];
    $employee=$v['employee'];
    $instreason = $v['instreason'];
    $pliers =$v['pliers'];
    $matnr=$v['matnr'];
    $sernr=$v['sernr'];
    $oldkey = $oldkey_const . $r;

    if($n_struct=='AUTO1')
        $z = "insert into sap_auto1(oldkey,dat_type,matnr,sernr,instdate,employee,instreason,pliers)
                    values('$oldkey','AUTO','$matnr','$sernr','$instdate','$employee','$instreason','$pliers')";

    exec_on_server($z,(int) $rem,$vid);
}

// Оставляет только цифры в № телефона
function normal_tel($tel){
    preg_match_all('/[\d]+/', $tel, $matches);
    $s='';
    foreach ($matches[0] as $v)
        $s.=$v;
    return substr($s,0,10);
}

function define_type_tel($oper)
{   $flag = 1;
    switch ($oper) {
        case '039':
            $flag = 3;
            break;
       case '050':
           $flag = 3;
           break;
        case '063':
            $flag = 3;
            break;
        case '066':
            $flag = 3;
            break;
        case '067':
            $flag = 3;
            break;
        case '068':
            $flag = 3;
            break;
        case '073':
            $flag = 3;
            break;
        case '091':
            $flag = 3;
            break;
        case '092':
            $flag = 3;
            break;
        case '093':
            $flag = 3;
            break;
        case '094':
            $flag = 3;
            break;
        case '095':
            $flag = 3;
            break;
        case '096':
            $flag = 3;
            break;
        case '097':
            $flag = 3;
            break;
        case '098':
            $flag = 3;
            break;
        case '099':
            $flag = 3;
            break;

    }
    return $flag;
}
// Cоздание строки всех колонок таблицы
// Аргументы:
// $table - имя таблицы
// $rem -РЭС
// $type - тип (1- abn, 2 - energo)
// $arr - массив для исключения колонок, например:
// gen_column('sap_co_eha',$res,[0=>'swerk',1=>'dat_type']); - будут исключены поля swerk и dat_type
function gen_column($table,$rem,$type,$arr=[])
{
    $sql = "select * from $table limit 1";
    $struct_data=data_from_server($sql,$rem,$type);
    $s='';
    foreach($struct_data[0] as $k=>$v) {
        $flag=0;
        foreach ($arr as $a) {
             if($a==$k) $flag=1;
            }
        if(!$flag)
            $s=$s.$k.',';
    }
    $s=substr($s,0,strlen($s)-1);
    return $s;

}
// Cоздание строки всех колонок таблицы для выражения в insert запросе
// Аргументы:
// $table - имя таблицы
// $rem -РЭС
// $type - тип (1- abn, 2 - energo)
// $arr - массив для исключения колонок, например:
// gen_column('sap_co_eha',$res,[0=>'swerk',1=>'dat_type']); - будут исключены поля swerk и dat_type
function gen_column_insert($table,$rem,$type,$arr=[])
{
    $sql = "SELECT ordinal_position, column_name, data_type
            FROM information_schema.columns
            WHERE table_name='$table'
            ORDER BY 1";
    $struct_data=data_from_server($sql,$rem,$type);
    $s='';
    foreach($struct_data as $v) {
        $flag=0;
        foreach ($arr as $a) {
            if($a==$v['column_name']) $flag=1;
        }
        if(!$flag)
            $s=$s.$v['column_name'].',';
    }
    $s=substr($s,0,strlen($s)-1);
    return $s;

}


// Cоздание строки всех колонок таблицы для выражения values в insert запросе
// Аргументы:
// $table - имя таблицы
// $rem -РЭС
// $type - тип (1- abn, 2 - energo)
// $arr - массив для исключения колонок, например:
// gen_column('sap_co_eha',$res,[0=>'swerk',1=>'dat_type']); - будут исключены поля swerk и dat_type
function gen_column_values($table,$rem,$type,$arr=[])
{
    $sql = "SELECT ordinal_position, column_name, data_type
            FROM information_schema.columns
            WHERE table_name='$table'
            ORDER BY 1";
    $struct_data=data_from_server($sql,$rem,$type);
    $s='';
    foreach($struct_data as $v) {
        $flag=0;
        foreach ($arr as $a) {
            if($a==$v['column_name']) $flag=1;
        }
        if(!$flag)
            $s=$s.'$$$'.$v['column_name'].'$$,';
    }
    $s=substr($s,0,strlen($s)-1);
    return $s;

}

// $s=$s.'$$$'.$k.'$$,';

// Получение данных с сервера (выполнение select команды)
// Аргументы:
// $sql - запрос
// $rem - код РЭСа
// $type - тип (1- abn, 2 - energo)
function data_from_server($sql,$rem,$type)
{
    $sql='"'.$sql.'"';
    if($type==1) {
        switch ($rem) {
            case 1:
                $base = 'db_pg_dn_abn';
                break;
            case 2:
                $base = 'db_pg_zv_abn';
                break;
            case 3:
                $base = 'db_pg_vg_abn';
                break;
            case 4:
                $base = 'db_pg_pv_abn';
                break;
            case 5:
                $base = 'db_pg_krg_abn';
                break;
            case 6:
                $base = 'db_pg_ap_abn';
                break;
            case 7:
                $base = 'db_pg_gv_abn';
                break;
            case 8:
                $base = 'db_pg_in_abn';
                break;
        }
    }
    if($type==2) {
        switch ($rem) {
            case 1:
                $base = 'db_pg_dn_energo';
                break;
            case 2:
                $base = 'db_pg_zv_energo';
                break;
            case 3:
                $base = 'db_pg_vg_energo';
                break;
            case 4:
                $base = 'db_pg_pv_energo';
                break;
            case 5:
                $base = 'db_pg_krg_energo';
                break;
            case 6:
                $base = 'db_pg_ap_energo';
                break;
            case 7:
                $base = 'db_pg_gv_energo';
                break;
            case 8:
                $base = 'db_pg_in_energo';
                break;
        }
    }
    $data='$data='." \Yii::".'$app'."->".$base."->createCommand($sql)"."->queryAll();";
    eval($data);
    return($data);

}

function data_to_server($sql,$rem,$type)
{
    $sql='"'.$sql.'"';
    if($type==1) {
        switch ($rem) {
            case 1:
                $base = 'db_pg_dn_abn';
                break;
            case 2:
                $base = 'db_pg_zv_abn';
                break;
            case 3:
                $base = 'db_pg_vg_abn';
                break;
            case 4:
                $base = 'db_pg_pv_abn';
                break;
            case 5:
                $base = 'db_pg_krg_abn';
                break;
            case 6:
                $base = 'db_pg_ap_abn';
                break;
            case 7:
                $base = 'db_pg_gv_abn';
                break;
            case 8:
                $base = 'db_pg_in_abn';
                break;
        }
    }
    if($type==2) {
        switch ($rem) {
            case 1:
                $base = 'db_pg_dn_energo';
                break;
            case 2:
                $base = 'db_pg_zv_energo';
                break;
            case 3:
                $base = 'db_pg_vg_energo';
                break;
            case 4:
                $base = 'db_pg_pv_energo';
                break;
            case 5:
                $base = 'db_pg_krg_energo';
                break;
            case 6:
                $base = 'db_pg_ap_energo';
                break;
            case 7:
                $base = 'db_pg_gv_energo';
                break;
            case 8:
                $base = 'db_pg_in_energo';
                break;
        }
    }
    $data='$data='." \Yii::".'$app'."->".$base."->createCommand($sql)"."->execute();";

    eval($data);
    return($data);

}

// Выполнение комманды sql на сервере (выполнение любых команд кроме select)
// Аргументы:
// $sql - запрос
// $rem - код РЭСа
// $type - тип (1- abn, 2 - energo)
function exec_on_server($sql,$rem,$type)
{
    $sql='"'.$sql.'"';
    if($type==1) {
        switch ($rem) {
            case 1:
                $base = 'db_pg_dn_abn';
                break;
            case 2:
                $base = 'db_pg_zv_abn';
                break;
            case 3:
                $base = 'db_pg_vg_abn';
                break;
            case 4:
                $base = 'db_pg_pv_abn';
                break;
            case 5:
                $base = 'db_pg_krg_abn';
                break;
            case 6:
                $base = 'db_pg_ap_abn';
                break;
            case 7:
                $base = 'db_pg_gv_abn';
                break;
            case 8:
                $base = 'db_pg_in_abn';
                break;
        }
    }
    if($type==2) {
        switch ($rem) {
            case 1:
                $base = 'db_pg_dn_energo';
                break;
            case 2:
                $base = 'db_pg_zv_energo';
                break;
            case 3:
                $base = 'db_pg_vg_energo';
                break;
            case 4:
                $base = 'db_pg_pv_energo';
                break;
            case 5:
                $base = 'db_pg_krg_energo';
                break;
            case 6:
                $base = 'db_pg_ap_energo';
                break;
            case 7:
                $base = 'db_pg_gv_energo';
                break;
            case 8:
                $base = 'db_pg_in_energo';
                break;
        }
    }
    $data="Yii::".'$app'."->".$base."->createCommand($sql)"."->execute();";
//debug($data);
//return;
//    $f=fopen('aaaaa_sap.sap','w+');
//    fputs($f,$data);

    eval($data);
    return;

}
// Создание глобальных переменных
function gen_vars($w)
{   error_reporting( E_ERROR);

    foreach($w as $k=>$v) {

        eval('static $'.$k.'='.'"'.$v.'"'.';');
//        IF($k=='street') {
//            debug($street);
//            return;
//        }
    }
    return 0;
}

// Получение название подпрограммы
function get_routine($s)
{
    if(substr($s,-4)=='_ind') {
        $r = substr($s, 10);
        $r = str_replace('_ind', '', $r);
    }
    else
        $r = substr($s, 10);
    return(strtoupper($r));

}

function get_routine1($s)
{
    if(substr($s,-4)=='_ind') {
        $r = substr($s, 13);
        $r = str_replace('_ind', '', $r);
    }
    else
        $r = substr($s, 13);
    return(strtoupper($r));

}

// Извлекаем из общего массива данных j-ю порцию полей, разделенных разделителями
// Аргументы:
// $data - массив данных с разделителями
// $n - номер порции извлекаемых данных с массива $data
function extract_p($data,$number){
    $start='r' . $number;
    $end='r' . ($number+1);
    $flag=0;
    $i=0;
    foreach ($data as $k=>$v){
        if($k==$start){
            $flag=1;
            continue;
        }
        if($k==$end){
            break;
        }
        if($flag==1){
            $result[$i]=$v[$k];
            $i++;
        }
    }
    return $result;
}

function extract_fields($data){
    $i=0;
    $result=[];
    foreach ($data as $k=>$v){
            $result[$i]=$k;
            $i++;
        }
    return $result;
}

function array_part($data,$data_p){
    foreach ($data as $k=>$d) {
        foreach ($data_p as $v) {
//            if (substr($v,0,8)=='data_type')
//                $v='data_type';
            if(trim(strtoupper($k))==trim(strtoupper($v)))
                $result[$k] = trim($d);
        }
    }
    return $result;
}
// Ускоренная выгрузка данных в файл (настроена на выгрузку PARTNER_IND)
function date2file_Partner_ind($res,$vid)
{
    $rem = '0'.$res;  // Код РЭС
    $fd = date('Ymd');
    $fname='PARTNER_04'.'_CK'.$rem.'_'.$fd.'_07'.'_R'.'.txt';
    deleterOM($fname,$rem);
    $f = fopen($fname, 'w+');
    $i = 0;
    $sql = "select a.*,b.*,c.*,d.*,e.* from sap_init a  
                    left join sap_ekun b on a.old_key=b.old_key
                    left join sap_but000 c on a.old_key=c.old_key
                    left join sap_but020 d on a.old_key=d.old_key
                    left join sap_but0id e on a.old_key=e.old_key
                ";
    $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
    $sql_c = "select * from sap_export where objectsap='PARTNER_IND' order by id_object";
    $cnt = data_from_server($sql_c, $res, $vid);
//        Получаем массивы полей всех структур
    $i = 0;
    foreach ($cnt as $v) {
        $i++;
        $k = $i - 1;
        $table_struct = 'sap_' . trim($v['dattype']);
        $z = "select * from $table_struct limit 1";
        $mas = data_from_server($z, $res, $vid);
        $r = '$struct' . $i . '=$mas[0];';
        eval($r);
    }
    $j = 0;
    foreach ($struct_data as $d) {
        $j = 0;
        $old_key = $d['old_key'];
        foreach ($cnt as $v) {
            $j++;
            // Извлекаем список полей в структуре
            $data_p = extract_fields(${"struct" . $j});
            $d1 = array_part($d, $data_p);

            if($j==5 && ($d1['idnumber']=="~" || empty($d1['idnumber'])))
               continue;   // Не пишем структуру but0id если она пустая

            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }
        fputs($f, $old_key . "\t&ENDE");
        fputs($f, "\n");
    }
    fclose($f);
    return $fname;
}

function deleterOM ($str,$rem){
//    $rest = substr($str, 0, strpos($str, '_'));
    $rest = masc($str,$rem);
    $rest_a = $rest.'*_R.txt';

    $filess = yii\helpers\FileHelper::findFiles('.',['only'=>[$rest_a]]);
    $filess = str_replace('./', '', $filess);

    $n = count($filess);

    if($n>0){
        for($i=0;$i<$n;$i++){
            unlink($filess[$i]);}
    }
    return 0;
}

function deleterOM_ext ($str,$rem){
//    $rest = substr($str, 0, strpos($str, '_'));
    $rest = masc($str,$rem);
    $rest_a = $rest.'*_R_ext.txt';
//    $f=fopen("aaaaaaaaa.aaa",'w+');
//    fputs($f,$rest_a);

    $filess = yii\helpers\FileHelper::findFiles('.',['only'=>[$rest_a]]);
    $filess = str_replace('./', '', $filess);

    $n = count($filess);

    if($n>0){
        for($i=0;$i<$n;$i++){
            unlink($filess[$i]);}
    }
    return 0;
}

function masc ($s,$rem){
    $y=strlen($s);
    $j=0;
    $ss='';
    $stop=1;
    $p1=strpos($s,'INST_MGMT') ;
    $p2=strpos($s,'MOVE_IN') ;
    if (!($p1 === false))  $stop=2;
    if (!($p2 === false))  $stop=2;
    for($i=0;$i<$y;$i++) {
        $c = substr($s, $i, 1);
        $ss = $ss . $c;
        if ($c == "_" ) {
            $j++;
        }
        if($j > $stop) break;
    }
    return $ss.'CK'.$rem;

}

// Проверка файла выгрузки - задвоения по oldkey
function double_oldkey ($filename)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $j=0;
    $arr_k = [];
    while (!feof($f)) {
        $i++;
        $s = fgets($f);
        $data = explode("\t", $s);
        if (isset($data[1])) {
            if ($data[1] == 'INIT' || $data[1] == 'CO_EHA' ||  $data[1] == 'EVBSD'
                || $data[1] == 'DATA' || $data[1] == 'EGPLD' || $data[1] == 'AUTO' || $data[1] == 'EGRH'
                || $data[1] == 'DI_INT' || $data[1] == 'EVER') {
                $arr_k[$j] = $data[0];
                $j++;
            }
        }
    }
    // Seek double - result will be in array res
    $res = [];
    $k=0;
    for($m=0;$m<$j;$m++) {
        $prev = $arr_k[$m];
        for ($n = $m+1; $n < $j; $n++) {
            if ($arr_k[$n]==$prev) {
                $res[$k] = $prev;
                $k++;
            }
        }
    }
    fclose($f);
    return $res;
}

// Проверка файла выгрузки - задвоения структур
function double_struct ($filename)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $prev='';
    while (!feof($f)) {
        $i++;
        $s = fgets($f);
        $data = explode("\t", $s);
        if (isset($data[1])) {
            if($data[1]==$prev) {
                fclose($f);
                return $data[0];
            }
            $prev=$data[1];
        }
    }
    fclose($f);
    return '';
}

// Проверка файла выгрузки - отсутствие структуры
// Аргументы:
// $filename - имя файла выгрузки
// $cnt - кол-во структур в каждом блоке данных
function no_struct ($filename,$cnt)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $prev='';
    $oldkey='';
    $flag=0;
    $ok=1;  // Признак нормальности структуры
    while (!feof($f)) {
        $s = fgets($f);
        $i++;
        $data = explode("\t", $s);
        if (isset($data[0])) {
            $oldkey = $data[0];
            if ($oldkey <> $prev && $prev <> '') {
                $flag = 1;  // Конец структуры
            }

            if (($i-1) == $cnt && $flag == 1) {
                $ok = 1;   // Normal structure
                $i = 1;
                $flag = 0;
                $prev = $oldkey;
                continue;
            }
            if (($i-1) <> $cnt && $flag == 1) {
                $ok = 0;   // not normal structure
                fclose($f);
                return $prev;
            }
            $prev = $oldkey;
        }
    }
    fclose($f);
    return '';
}

function count_str ($filename)
{
    $f = fopen($filename, 'r');
        $count = 0;
        $a = "";
        $b = 0;
        while(($s = fgets($f)) !== false) {
        $count++;
        $rez = explode("\t", $s);
        if ($a != $rez[0]) {
        $b++;
        }
        $a = $rez[0];
        }
        return 'количество строк '.$count.'  '.',количество уникалных кодов '.$b;
        
}

// Проверка файла выгрузки - нет объекта высшего уровня
function no_refer ($filename,$data_u)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $j=0;
   $upload=$data_u[0]['upload'];
   $pole=$data_u[0]['n_data'];
   $refer=$data_u[0]['refer'];
   $tail=substr($filename,strlen($upload));
    $arr_k = [];

    for($q=0;$q<count($data_u);$q++) {
        $pole = $data_u[$q]['n_data'];
        $refer=$data_u[$q]['refer'];
        $struct=$data_u[$q]['struct'];
        $ref_file=$refer . $tail;

        $fr = fopen($ref_file, 'r');
        rewind($f);
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("\t", $s);
            if (isset($data[1])) {
                if ($data[1] == $struct) {
                    // Ищем ссылку в файле $ref_file (высшего уровня)
                    $f_seek = 0;
                    rewind($fr);
                    while (!feof($fr)) {
                        $sr = fgets($fr);
                        $data_r = explode("\t", $sr);
                        if ($data_r[0] == $data[$pole - 1]) {
                            $f_seek = 1;
                            break;
                        }
                    }
                    if ($f_seek == 0) {
                        // not found reference
                        $arr_k[$j] = $refer.' '.$data[$pole - 1];
                        $j++;
                    }
                }
            }
        }
        fclose($fr);
    }
    fclose($f);
    return $arr_k;
}

// Проверка файла выгрузки фактов - нет объекта высшего уровня (в INSTLN)
function no_refer_facts ($filename)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $j=0;
    $upload='FACTS';
    $refer='INSTLN';
    $tail=substr($filename,strlen($upload));
    $arr_k = [];

        $ref_file=$refer . $tail;


        rewind($f);
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("\t", $s);
            if (isset($data[1]) && $data[1]=='KEY') {
                $ref = $data[2];
                    // Ищем ссылку в файле $ref_file (высшего уровня)
                    $f_seek = 0;
                    $fr1 = fopen($ref_file, 'r');
                    rewind($fr1);
                    while (!feof($fr1)) {
                        $sr = fgets($fr1);
                        $data_r = explode("\t", $sr);
                        if ($data_r[0] == $ref) {
                            $f_seek = 1;
                            break;
                        }
                    }
                    if ($f_seek == 0) {
                        // not found reference
                        $arr_k[$j] = $refer.' '.$ref;
                        $j++;
                    }

        }
//        fclose($fr1);
    }
    fclose($f);
    return $arr_k;
}

// Проверка файла выгрузки - пустая ссылка
function empty_refer ($filename,$data_u)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $j = 0;
    $struct = $data_u[0]['struct'];
    $pole = $data_u[0]['n_data'];
    $arr_k = [];
    while (!feof($f)) {
        $i++;
        $s = fgets($f);
        $data = explode("\t", $s);
        if (isset($data[1])) {
            if ($data[1] == $struct) {
                if (empty($data[$pole - 1])) {
                    $arr_k[$j] = $data[0];
                    $j++;
                }
            }
        }
    }
    fclose($f);
    return $arr_k;
}

// Проверка файла выгрузки - проверка адреса  на соответствие его с названием в САП или индекса
// Аргументы:
// $filename - имя файла выгрузки
// $mode - режим работы (1 - проверка адреса, 2 - проверка почтового индекса)
function check_adres ($filename,$mode)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $j = 0;
    $arr_k = [];
    if ($mode==1)
        $ind=3;
    if ($mode==2)
        $ind=4;
    while (!feof($f)) {
        $i++;
        $s = fgets($f);
        $data = explode("\t", $s);
        if (isset($data[1])) {
            if ($data[1] == 'CO_ADR' || $data[1] == 'BUT020') {

                if(empty($data[$ind-1] )) {
                    $arr_k[$j] = $data[0];
                    $j++;
                }
            }
        }
    }
    return $arr_k;
}

function check_adres_partner ($filename,$mode)
{
    $f = fopen($filename, 'r');
    $i = 0;
    $j = 0;
    $arr_k = [];
    if ($mode==1)
        $ind=5;
    if ($mode==2)
        $ind=6;
    while (!feof($f)) {
        $i++;
        $s = fgets($f);
        $data = explode("\t", $s);
        if (isset($data[1])) {
            if ($data[1] == 'CO_ADR' || $data[1] == 'BUT020') {

                if(empty($data[$ind-1] )) {
                    $arr_k[$j] = $data[0];
                    $j++;
                }
            }
        }
    }
    return $arr_k;
}

// Проверка на пустые поля
function empty_fields ($filename,$mas)
{
    $f = fopen($filename, 'r');
    $i=0;
    $q=0;
    $res=[];
    while (!feof($f)) {
        $i++;
        $s = fgets($f);
        $data = explode("\t", $s);
        for ($j = 0; $j < count($data); $j++) {
            if (empty($data[$j])) {
                for ($k = 0; $k < count($mas); $k++) {
                    if (($mas[$k]['num']-1)==$j && (strtolower((trim($mas[$k]['struct'])) == strtolower(trim($data[1]))))) {
                            $res[$q] = trim($mas[$k]['field']).' в структуре '.
                                trim($mas[$k]['struct']).' по ключу '.$data[0].' (строка '.$i.')';
                            $q++;
                    }
                }
            }
        }
    }
    fclose($f);
    return $res;
}

function test_f($s) {
    $p=true;
    $y=strlen($s);
    for($i=0;$i<$y;$i++)
    {
        $c=substr($s,$i,1);
//        $p=((!$p) && ($c=='5')) || ($p && (!($c=='5')));
        $p= ($c=='5') xor ($p);
//        echo $c . ' ';
//        echo ($p)?1:0 . ' ';
    }
    return  ($p)?1:0;
}

?>