<?php


namespace app\models;

//use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Форма ввода данных для конвертации чисел
 */
class Search_into extends Model
{
    public $way ;
    public $find ;

    public function attributeLabels()
    {
        return [
            'way' => 'Путь к каталогу:',
            'find' => 'Строка поиска:',
        ];
    }

    public function rules()
    {
        return [
            [['way',  'find'], 'required'],
        ];
    }

    // Копирование файлов поиска на сервер
    public function copy_to_server($s,$files,$dir)
    {

    }
    // Поиск внутри файлов в двух кодировках
    public function search_into($s,$files,$dir)
    {
        $s=mb_strtolower($s,'UTF-8');
        $pos_1 = stripos($s, '|');
        $pos_2 = stripos($s, '&');
        $kind_search=0;  // Обычный поиск подстрок
        $mas_f[0]=$s;
        $flag_search=0; // Признак что хоть какой-то файл найден
        $res1=[]; // Stack - initialisation else
        if ($pos_1 !== false) {
            $mas_f = explode('|', $s);
            $kind_search=1; // Поиск любой из заданных подстрок
        }
        if ($pos_2 !== false) {
            $mas_f = explode('&', $s);
            $kind_search=2;  // Одновременный поиск заданных подстрок
        }
        $all_s=count($mas_f);

        $i=0;
        $result='';
        $pp=0;
        // Создаем временную папку со случайным именем
        $rnd = random_int(1000000, 9999999);
        mkdir($rnd);

        foreach ($files as $v) {
            if($v=='.' || $v=='..') continue;
            if(substr($v,0,1)=='.') continue;
            if (!pathinfo($v, PATHINFO_EXTENSION)) continue;
            // Копирование файлов во временную папку

//            debug($dir .'/' . $v);
//            debug($dir .'/' . $v);
//            debug($rnd .'/' . $v);
//            return;

//            copy($dir .'/' . $v, $rnd . '/' . $v);
            $src = $dir .'/' . $v;
            $dest = $rnd . '/' . $v;
            shell_exec("cp $src $dest");
            $v=$rnd . '/' . $v;
            $list[$i] = $v;
            $i++;
        }
        $q_all = count($list);
        $i=0;

//        debug($list);
//        return;

        foreach ($list as $v) {
            $pp++;

            $fname =  $v;
            if(! file_exists($fname)) continue;
//            if($pp==29) {
//                debug($fname);
//                return;
//            }
            // Определяем расширение файла
            $getMime = explode('.', $fname);
            $k1 = count($getMime);
            $type_file = strtolower($getMime[$k1 - 1]);
//            debug($getMime);
//            return;

            switch ($type_file) {
                // doc файлы
                case 'DOC':
                case 'doc':
                    if (file_exists($fname)) {
                        if (($fh = fopen($fname, 'r')) !== false) {
                            $headers = fread($fh, 0xA00);

                            // 1 = (ord(n)*1) ; Document has from 0 to 255 characters
                            $n1 = ( ord($headers[0x21C]) - 1 );

                            // 1 = ((ord(n)-8)*256) ; Document has from 256 to 63743 characters
                            $n2 = ( ( ord($headers[0x21D]) - 8 ) * 256 );

                            // 1 = ((ord(n)*256)*256) ; Document has from 63744 to 16775423 characters
                            $n3 = ( ( ord($headers[0x21E]) * 256 ) * 256 );

                            // 1 = (((ord(n)*256)*256)*256) ; Document has from 16775424 to 4294965504 characters
                            $n4 = ( ( ( ord($headers[0x21F]) * 256 ) * 256 ) * 256 );

                            // Total length of text in the document
                            $textLength = ($n1 + $n2 + $n3 + $n4);

                            $extracted_plaintext = fread($fh, $textLength);
                            $extracted_plaintext = mb_convert_encoding( $extracted_plaintext, 'UTF-8', 'UTF-16LE' );
                            $extracted_plaintext = mb_strtolower($extracted_plaintext,'UTF-8');
                            $text =  nl2br($extracted_plaintext);

                        } else {
                            $text = '';
                        }
                    } else {
                        $text = '';
                    }

//                        debug($text);
//                        return;

                    $e=0;
                    $res=[]; // Stack - initialisation
                    for ($q = 0; $q < $all_s; $q++) {
                        $s1 = $mas_f[$q];
                        $s = mb_convert_encoding($mas_f[$q], 'CP1251', mb_detect_encoding($mas_f[$q]));  // В Windows кодировке
                        $pos1 = stripos($text, $s);
                        $pos2 = stripos($text, $s1);
                        if (($pos1 !== false) || ($pos2 !== false)) {
                            if(empty($result))
                                $result = "'" . $fname . "'";
                            else
                                $result = $result . ',' . "'" . $fname . "'";
                            $res[$q]='doc'; // Add to stack
                            $res1[$q]='doc'; // Add to stack else
                            $e++;
                            $flag_search=1;
                        }
                    }
                    if(count($res)==$all_s ||  count($res1)==$all_s) $flag_search = 1;
                    else
//                        if($flag_search <> 1)
                        $flag_search = 0;

                    //  Если последняя запись - последний файл в обрабатываемом цикле
                    if($pp==$q_all) {
                        $flag_search = 0;
                        if (count($res1)==$all_s) {
                            if(count($res)==$all_s) {
                                $flag_search = 1;
                            }
                            $flag_like = like_elements($res1);
                            // Если найдено в одном файле
                            if($flag_like==1) $flag_search = 1;
                        }
                    }

                    // Если в стеке не все слова поиска при одновременном поиске - тогда ничего не найдено
                    if((count($res)<>$all_s && $flag_search==0)  && $kind_search==2) $result='';
//                    debug($result);
//                    debug('doc');
//                    debug($res);
//                    debug('res1');
//                    debug($res1);
//                    debug('flag_search= '.$flag_search);
//                    debug('------------------------------------------');
                    break;

                case 'DOCX':
                case 'docx':

                    $objReader = \PhpOffice\PhpWord\IOFactory::createReader('Word2007');
                    $phpWord = $objReader->load($fname);
                    // ---------------------------------------------------------------------------
                    $text='';
                    $sections = $phpWord->getSections();

                    foreach ($sections as $s) {
                        $els = $s->getElements();
                        /** @var ElementTest $e */
                        foreach ($els as $e) {
                            $class = get_class($e);
                            if (method_exists($class, 'getElements')) {
                                if ($e instanceof \PhpOffice\PhpWord\Element\TextRun) {
                                    $secondSectionElement = $e->getElements();
                                    foreach ($secondSectionElement as $secondSectionElementKey => $secondSectionElementValue) {
                                        if ($secondSectionElementValue instanceof \PhpOffice\PhpWord\Element\Text) {
                                            $text .= $secondSectionElementValue->getText();
                                        } else {
                                            $text .= "\n";
                                        }
                                        if ($secondSectionElementValue instanceof \PhpOffice\PhpWord\Element\TextBreak)
                                            $text .= "\n";
                                        // table
                                        if ($secondSectionElementValue instanceof \PhpOffice\PhpWord\Element\Table) {
                                            $rows = $e->getRows();

                                            foreach ($rows as $row) {
                                                $cells = $row->getCells();
                                                foreach ($cells as $cell) {
                                                    $celements = $cell->getElements();
                                                    foreach ($celements as $celem) {

                                                        if ($celements instanceof \PhpOffice\PhpWord\Element\Text) {
                                                            $text .= $celem->getText();
                                                        } else if ($celem instanceof \PhpOffice\PhpWord\Element\TextRun) {
                                                            foreach ($celem->getElements() as $text1) {
                                                                $text .= $text1->getText();
                                                            }
                                                        }
                                                    }
                                                }
                                            }
                                        } else {
                                            $text .= $e->getText();
                                        }
                                    }
                                }
                            }
                        }
                    }
                    $e=0;
                    $res=[]; // Stack - initialisation
                    $text = mb_strtolower($text,'UTF-8');
                    for ($q = 0; $q < $all_s; $q++) {
                        $s1 = $mas_f[$q];
                        $s = mb_convert_encoding($mas_f[$q], 'CP1251', mb_detect_encoding($mas_f[$q]));  // В Windows кодировке
                        $pos1 = stripos($text, $s);
                        $pos2 = stripos($text, $s1);
                        if (($pos1 !== false) || ($pos2 !== false)) {

                            if(empty($result))
                                $result = "'" . $fname . "'";
                            else
                                $result = $result . ',' . "'" . $fname . "'";

                            $res[$q]='docx'; // Add to stack
                            $res1[$q]='docx'; // Add to stack else
                            $e++;
                            $flag_search=1;

                        }
                    }
                    // Если в стеке не все слова поиска при одновременном поиске - тогда ничего не найдено

                    if(count($res)==$all_s ||  count($res1)==$all_s) $flag_search = 1;
                    else
//                        if($flag_search <> 1)
                        $flag_search = 0;

                    //  Если последняя запись - последний файл в обрабатываемом цикле
                    if($pp==$q_all) {
                        $flag_search = 0;
                        if (count($res1)==$all_s) {
                            if(count($res)==$all_s) {
                                $flag_search = 1;
                            }
                            $flag_like = like_elements($res1);
                            // Если найдено в одном файле
                            if($flag_like==1) $flag_search = 1;
                        }
                    }



                    if((count($res)<>$all_s && $flag_search==0)  && $kind_search==2) $result='';
//                    debug($result);
//                    debug('docx');
//                    debug($res);
//                    debug('res1');
//                    debug($res1);
//                    debug('flag_search= '.$flag_search);
//                    debug('----------------------------------------');

                    break;

                // Excel файлы
                case 'XLSX':
                case 'xls':
                case 'XLS':
                case 'xlsx':

                    $objPHPExcel = \PHPExcel_IOFactory::load($fname);
                    $sheet = $objPHPExcel->getSheet(0);
                    $highestRow = $sheet->getHighestRow();
                    if($highestRow>100000) break;
                    $sheetData = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);

//                if($pp==29) {
//                    debug($sheetData);
//                    return;
//                }
                    $ky=count($sheetData);
                    $e=0;
                    $res=[]; // Stack - initialisation
                    $last_file='';
                    for($iy=1;$iy<=$ky;$iy++){
                        foreach ($sheetData[$iy] as $v) {
                            $str = trim($v);
                            $str = mb_strtolower($str,'UTF-8');
//                            debug($str);
                            if (empty($str)) continue;
                            for ($q = 0; $q < $all_s; $q++) {
                                $s1 = $mas_f[$q];
                                $s = mb_convert_encoding($mas_f[$q], 'CP1251', mb_detect_encoding($mas_f[$q]));  // В Windows кодировке
                                $pos1 = stripos($str, $s);
                                $pos2 = stripos($str, $s1);

                                if (($pos1 !== false) || ($pos2 !== false)) {

                                    if ($i == 0)
                                        if(empty($result))
                                            $result = "'" . $fname . "'";
                                        else
                                            $result = $result . ',' . "'" . $fname . "'";
                                    else
                                        $result = $result . ',' . "'" . $fname . "'";
                                    $i++;
                                    $e++;
                                    $res[$q]='xls'; // Add to stack
                                    $res1[$q]='xls'; // Add to stack else
                                    $flag_search=1;

                                }
                            }
                        }
                    }
//                    if($pp==29) {
//                        debug($result);
//                        return;
//                    }
                    // Если в стеке не все слова поиска при одновременном поиске - тогда ничего не найдено
                    if(count($res)==$all_s ||  count($res1)==$all_s) $flag_search = 1;
                    else
//                    if($flag_search <> 1)
                        $flag_search = 0;

                    //  Если последняя запись - последний файл в обрабатываемом цикле
                    if($pp==$q_all) {
                        $flag_search = 0;
                        if (count($res1)==$all_s) {
                            if(count($res)==$all_s) {
                                $flag_search = 1;
                            }
                            $flag_like = like_elements($res1);
                            // Если найдено в одном файле
                            if($flag_like==1) $flag_search = 1;
                        }
                    }

                    if((count($res)<>$all_s && $flag_search==0)  && $kind_search==2) $result='';
//                debug($result);
//                debug('xls');
//                debug($res);
//                debug('res1');
//                debug($res1);
//                debug('flag_search= '.$flag_search);
//                debug('----------------------------------------');
                    break;

                // другие файлы (рассматриваем как текстовые)
//                case 'txt':
//                case 'TXT':
//                case 'csv':
                default:
                    $f = fopen($fname, 'r');
                    $j = 0;
                    $e=0;
                    $res=[]; // Stack - initialisation
                    $i_s=0;
                    $last_file='';
//                    if($pp==28) {
//                        debug($fname);
//                        return;
//                    }

                    while (!feof($f)) {
                        $str = trim(fgets($f));
                        $str = mb_strtolower($str,'UTF-8');
                        $j++;
                        for ($q = 0; $q < $all_s; $q++) {
                            $s1 = $mas_f[$q];
                            $s = mb_convert_encoding($mas_f[$q], 'CP1251', mb_detect_encoding($mas_f[$q]));  // В Windows кодировке
                            $pos1 = stripos($str, $s);
                            $pos2 = stripos($str, $s1);
                            if (($pos1 !== false) || ($pos2 !== false)) {
                                // Что-то найдено
                                if ($i == 0)
                                    if(empty($result))
                                        $result = "'" . $fname . "'";
                                    else
                                        $result = $result . ',' . "'" . $fname . "'";
                                else
                                    $result = $result . ',' . "'" . $fname . "'";
                                $i++;

                                $res[$q]='txt'; // Add to stack
                                $res1[$q]='txt'; // Add to stack else
                                $flag_search=1;
                            }

                        }
                    }

//                    debug($result);
//                    return;
//
                    
                    
                    
                    fclose($f);
                    if(count($res)==$all_s ||  count($res1)==$all_s) $flag_search = 1;
                    else
//                        if($flag_search <> 1)
                        $flag_search = 0;

                    //  Если последняя запись - последний файл в обрабатываемом цикле
                    if($pp==$q_all) {
                        $flag_search = 0;
                        if (count($res1)==$all_s) {
                            if(count($res)==$all_s) {
                                $flag_search = 1;
                            }
                            $flag_like = like_elements($res1);
                            // Если найдено в одном файле
                            if($flag_like==1) $flag_search = 1;
                        }
                    }
                    // Если в стеке не все слова поиска  при одновременном поиске - тогда ничего не найдено
                    if((count($res)<>$all_s && $flag_search==0)  && $kind_search==2) $result='';
                    break;
            }
        }
        // Удаляем папку со случайным именем и все файлы в ней
        shell_exec("rm -R $rnd");
//       debug('result '.$result);

        return $result;
    }


}

