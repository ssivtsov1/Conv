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
function f_partner($n_struct,$rem,$v) {
    $oldkey_const='04_C'.$rem.'B_';
        $r = $v['id'];
        $tax_number=trim($v['tax_number']);
        $last_name=$v['last_name'];
        $name_first=$v['name'];
        $namemiddle=$v['patron_name'];
        $town=$v['town'];
        $post_code1=$v['indx'];
        $street = $v['street'];
        $house_num1 =$v['house'];
        $roomnumber=$v['flat'];
        $region=$v['region'];
        $tel_number=$v['mob_phone'];
        $smtp_addr=$v['e_mail'];
        $iuru_pro=$v['kod_reg'];
        $pasport=$v['pasport'];

        if(!empty($tel_number)) $tel_mobile='3';
        else  $tel_mobile='';

        
        if(empty($tax_number) || is_null($tax_number)) {
            $tax_number=$pasport;
            $id_type='FS0002';}

        else{
            $id_type='FS0001';
        }
        
        if((empty($tax_number) || is_null($tax_number)) && (empty($pasport) || is_null($pasport))) {
            $tax_number='~';
            $id_type='~';
        }

        $oldkey = $oldkey_const . $r;

        if($n_struct=='INIT')
                $z = "insert into sap_init(old_key,dat_type,bu_type,bu_group,bpkind,role1,role2,valid_from_1,chind_1,valid_from_2,chind_2)
                    values('$oldkey','$n_struct','1','01','0001','МКК','','00010101','I','','')";

        if($n_struct=='EKUN')
            $z = "insert into sap_ekun(old_key,dat_type1,fkua_rsd,fkua_ris)
                    values('$oldkey','$n_struct','1','3')";

        if($n_struct=='BUT000')
            $z = "insert into sap_but000(old_key,dat_type2,bu_sort1,bu_sort2,source,augrp,name_last,
                                       name_first,xsexm,xsexf,birthdt,namemiddle,xsexu,zprocind)
                    values('$oldkey','$n_struct','$tax_number','~','0006','LED',$$$last_name$$,$$$name_first$$,
                           '~','~','~',$$$namemiddle$$,'X','X')";


        if($n_struct=='BUT020')
            $z = "insert into sap_but020(old_key,dat_type3,adext_addr,chind_addr,city1,post_code1,
                                         post_code2,po_box,street,house_num1,house_num2,str_suppl1,
                                         str_suppl2,roomnumber,region,chind_tel,tel_number,chind_smtp,
                                         smtp_addr,tel_mobile,iuru_pro)
                    values('$oldkey','$n_struct','$r','I','$town','$post_code1','~','~','$street',
                          '$house_num1','~','~','~','$roomnumber','$region','I','$tel_number','I',
                          '$smtp_addr','$tel_mobile','$iuru_pro')";

       if($n_struct=='BUT0ID')
        $z = "insert into sap_but0id(old_key,dat_type4,idnumber,id_type)
                    values('$oldkey','$n_struct','$tax_number','$id_type')";

     Yii::$app->db_pg_pv_abn_test->createCommand($z)->execute();

}



?>