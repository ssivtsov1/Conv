<?php
namespace app\models;
use yii\base\Model;
use Yii;
/**
 * Форма ввода данных для операций над множествами
 */
class Sets extends Model
{
    public $a;
    public $b;
    public $oper;

    public function attributeLabels()
    {
        return [
            'a' => 'Множество A:',
            'b' => 'Множество B:',
            'oper' => 'Операция:',
        ];
    }

    public function rules()
    {
        return [
            [['a','b','oper'], 'required'],
        ];
    }
    
    public function prepare($mas_a,$mas_b)
    {
        $sql = "CREATE TABLE tmp_set (
              uid varchar(255) NOT NULL,
              data1 varchar(255) DEFAULT NULL,
              data2 varchar(255) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone->createCommand($sql)->execute();
        $uid = uniqid('', true);
        $i=0;
        $y1=count($mas_a);
        $y2=count($mas_b);
        if($y1>$y2) $y=$y1; else $y=$y2; 
        
        for($i=0;$i<$y;$i++){
            if(isset($mas_a[$i])) $v1 = $mas_a[$i]; else $v1=''; 
            if(isset($mas_b[$i])) $v2 = $mas_b[$i]; else $v2='';
            $sql = 'insert into tmp_set(uid,data1,data2) values('."'".$uid."'".','."'".$v1."'".','."'".$v2."'".')';
            Yii::$app->db_phone->createCommand($sql)->execute();
        }
        return $uid;
    }    
    // Объединение множеств
    public function union($key)
    {
        $key = "'".$key."'";
        $sql = "SELECT data  FROM (
        select data1 as data from tmp_set where uid=$key and data1<>''  
        UNION
        select data2 as data from tmp_set where uid=$key and data2<>'') as tt
        order by 1  ";
        $data = Yii::$app->db_phone->createCommand($sql)->queryAll(); 
        return $data;
    } 
    
    // Пересечение множеств
    public function cross($key)
    {
        $key = "'".$key."'";
        $sql = "SELECT data1 as data from tmp_set
                where uid=$key and data1<>'' and data1 in (select data2 from tmp_set where uid=$key and data2<>'')
                order by 1";
        $data = Yii::$app->db_phone->createCommand($sql)->queryAll(); 
        return $data;
    } 
    
    // A-B
    public function a_m_b($key)
    {
        $key = "'".$key."'";
        $sql = "SELECT data1 as data from tmp_set
                where uid=$key and data1<>'' and data1 not in (select data2 from tmp_set where uid=$key and data2<>'')
                order by 1";
        $data = Yii::$app->db_phone->createCommand($sql)->queryAll(); 
        return $data;
    } 
    
    // B-A
    public function b_m_a($key)
    {
        $key = "'".$key."'";
        $sql = "SELECT data2 as data from tmp_set
                where uid=$key and data2<>'' and data2 not in (select data1 from tmp_set where uid=$key and data1<>'')
                order by 1";
        $data = Yii::$app->db_phone->createCommand($sql)->queryAll(); 
        return $data;
    } 
    
    // Инверсия пересечения
    public function uncross($key)
    {
        $key = "'".$key."'";
        $sql = "select data from (SELECT data2 as data from tmp_set
                where uid=$key and data2<>'' and data2 not in (select data1 from tmp_set where uid=$key and data1<>'')
                UNION
                SELECT data1 as data from tmp_set
                where uid=$key and data1<>'' and data1 not in (select data2 from tmp_set where uid=$key and data2<>'')) as tt
                 order by 1  ";
        
        $data = Yii::$app->db_phone->createCommand($sql)->queryAll(); 
        return $data;
    } 
    public function finish()
    {
        $sql = "DROP TABLE tmp_set";
        Yii::$app->db_phone->createCommand($sql)->execute();
    }   
}

