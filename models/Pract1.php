<?php


namespace app\models;

//use Yii;
use yii\base\Model;

/**
 * Форма ввода данных для решения задач
 */
class Pract1 extends Model
{
    public $str='' ;
    public $passwd='' ;

    
       public function rules()
    {
        return [
           
            [['str'], 'required'],
            [['passwd'], 'safe'],
            
        ];
    }

    public function task1($mas)
    {

        echo '<br>';
        echo '<br>';
        echo '<br>';

//        Нахождение максимума
        $n = count($mas);
        $k = $mas[0];
        for ($i = 1; $i < $n; $i++) {

            if ((int)$mas[$i] > (int)$k) {
                $k = $mas[$i];

            }
        }

        $i = 1;
        $k = $mas[0];
        while (true) {
            if ($mas[$i] > $k) {
                $k = $mas[$i];
            }
            $i++;
            if ($i >= $n) break;
        }

        while ($i < $n) {
            if ((int)$mas[$i] > (int)$k) {
                $k = $mas[$i];
            }
            $i++;
        }

        return $k;
    }


    public function task3($mas)
    {

        echo '<br>';
        echo '<br>';
        echo '<br>';
// разворот массива наоборот
        $n=count($mas);
        $i=$n-1;
        while (1==1) {
            echo $mas[$i];
            echo "\n";
            $i--;
            if ($i == 0) break;
        }



        return 1;
    }

    public function task7($s)
    {

// разворот строки наоборот
        $n=strlen($s);
        $i=$n-1;
        $ss='';
        while (1==1) {
            $c=mb_substr($s,$i,1,'UTF-8');
            $i--;
            $ss=$ss.$c;
            if ($i < 0) break;
        }

        return $ss;
    }

    public function task4($s)
    {

        echo '<br>';
        echo '<br>';
        echo '<br>';
        $f=fopen('adres.csv','r');
        $kol=0;
        while($s=fgets($f,65535))
        {
           $n=strlen($s);
            for($i=0;$i<$n;$i++) {
                $c = substr($s, $i, 1);

                if ($c == '0') {
                    $kol += 1;

                }
            }


        }

        return $kol;
    }

//    Рекурсия - числа Фиббоначчи
    public static function task5($n)
    {
        if($n<2) return 1;
        return Pract1::task5($n-2)+Pract1::task5($n-1);


    }

    //    Рекурсия - сложение
    public static function task6($s,$n)
    {

        if($n<0) return 0;
        return (int) Pract1::task6(substr($s,$n-2,1),$n-1)+(int) substr($s,$n-1,1);


    }
 
}

