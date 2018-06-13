<?php


namespace app\models;

//use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Форма ввода данных для поиска на сервере MySQL
 */
class Input_find_server_mysql extends Model
{
    public $search ;
    public $res ;
    public $db ;
    public $type ;
    public $vid ;
    public $break=0;
    public $fwhere;
    public $server;
       
    public function attributeLabels()
    {
        return [

            'search' => 'Данные для поиска:',
            'res'    => 'РЭС:',
            'db'     => 'База:',
            'type'     => 'Тип данных:',
            'vid'      => 'Вид данных:',
            'break'     => 'Прекратить поиск при первом совпадении',
            'fwhere'     => 'Где искать:',
            'server'     => 'Сервер:',
           
        ];
    }

    public function rules()
    {
        return [
           
            [['search','res','db','type','vid','fwhere','server'], 'required'],
            [['break'], 'safe']    
            
        ];
    }
 
     public function search(){
         $res=[];
         $i=0;
         $s = trim($this->search);
         $len=strlen($s);
         if($this->fwhere==1) // Для таблиц
         {
         if($this->vid==2)
                $sql ="SELECT a.table_name,a.column_name FROM information_schema.COLUMNS a
                WHERE  a.table_schema="."'".$this->db."'"." and column_name="."'".$s."'".
                ' order by 1';
        
               
               
         if($this->type==1) // Строка
         {if($this->vid==1)
                $sql = "select table_name, column_name 
                from information_schema.columns 
                where table_schema="."'".$this->db."'".
                " and (data_type='varchar' or data_type='char') and character_maximum_length>=".$len.
                ' order by 1';
         
         }
        
         if($this->type==2) // Дата
         {if($this->vid==1)
                $sql = "select table_name, column_name 
                from information_schema.columns 
                 where table_schema="."'".$this->db."'".
                " and (data_type='date' or data_type like 'timestamp%')".
                ' order by 1';
         }
         
         if($this->type==3)  // Число
         {if($this->vid==1)
                $sql = "select table_name, column_name 
                from information_schema.columns 
                where table_schema="."'".$this->db."'".
                " and (data_type='int' or data_type='numeric')".
                ' order by 1';
         }
         } 
         
         if($this->fwhere==2) // Для функций
         {
             $sql = "select routine_name as proname,routine_definition as prosrc from "
                     . "information_schema.routines where routine_definition like '%".$s.
                     "%' and routine_schema="."'".$this->db."'";
         }
         
         if($this->fwhere==3) // Для триггеров
         {
             $sql = "select proname,prosrc from pg_trigger,pg_proc where
                pg_proc.oid=pg_trigger.tgfoid and proowner<>10 and prosrc like '%".$s."%'";
         }
//         debug($sql);
//         debug($sql);
//         return;
         if($this->server==1)
            $data = \Yii::$app->db_mysql_loc->createCommand($sql)->queryAll();
         if($this->server==2)
            $data = \Yii::$app->db_mysql_1->createCommand($sql)->queryAll();
         if($this->server==3)
            $data = \Yii::$app->db_mysql_2->createCommand($sql)->queryAll();
       
        //         
         if($this->fwhere==1)
         {
         if($this->vid==1){  
         $k = count($data)-1;
            for($j=0;$j<$k;$j++){
             $tab = $data[$j]['table_name'];
             $col = $data[$j]['column_name'];
             
             if(ord(substr($col,0,1))>127) { 
                continue;
                
             }
             if($this->type=='1')
                $sql = "select `".$col."` from ".$this->db.'.'.$tab." where `".$col."` like '%".$s."%'";
                //$sql = "select ".$col." from ".$tab." where ".$col." like '%".$s."%'";
             if($this->type=='2')
                 { $s = date("Y-m-d", strtotime($s));
                 $sql = "select ".$col." from ".$this->db.'.'.$tab." where ".$col."="."'".$s."'";}
             if($this->type=='3')
             {  $flag=0;
             
                $y=strpos($s,'--');
                if($y) 
                     $flag=1;
                if($flag==1)
                {
                   $n1=substr($s,0,$y);
                   $n2=substr($s,$y+2);
                   $sql = "select ".$col." from ".$this->db.'.'.$tab." where ".$col.">=".$n1.' and '.$col."<=".$n2;
//                   debug($sql);
//                   debug($sql);
//                   return;
                }
                if($flag==0)
                {    
                    if(!strpos($s,',')) 
                        $sql = "select ".$col." from ".$this->db.'.'.$tab." where ".$col."=".$s;
                    else
                        $sql = "select ".$col." from ".$this->db.'.'.$tab." where ".$col." in (".$s.')';
                } 
             }
                
//           debug($sql);
//            debug($sql);
             if($this->server==1)
               $data_f = \Yii::$app->db_mysql_loc->createCommand($sql)->queryAll();
             if($this->server==2)
               $data_f = \Yii::$app->db_mysql_1->createCommand($sql)->queryAll();
             if($this->server==3)
               $data_f = \Yii::$app->db_mysql_2->createCommand($sql)->queryAll();
         
             if(!empty($data_f)){
                 $res[$i]['table']=$tab;
                 $res[$i]['column']=$col;
                 $i++;
                 if($this->break==true && $i==1) break;
             }
         }
         }
         
         if($this->vid==2){  
             $k = count($data);
             for($j=0;$j<$k;$j++){
             $tab = $data[$j]['table_name'];
             $col = $data[$j]['column_name'];
             if(!empty($data)){
                 $res[$i]['table']=$tab;
                 $res[$i]['column']=$col;
                 $i++;
             }
            }
         }
         }
        
         if($this->fwhere<>1){
             $k = count($data);
             for($j=0;$j<$k;$j++){
                 $proc_name = $data[$j]['proname'];
                 //$proc_src = $data[$j]['prosrc'];
             
             if(!empty($data)){
                 if($this->fwhere==2)
                    $res[$i]['proname']=$proc_name;
                 if($this->fwhere==3)
                    $res[$i]['trigger']=$proc_name;
                // $res[$i]['column']=substr($proc_src,0,160).'...';
                // $res[$i]['column']=$proc_src;
                 $i++;
             }
            }
         }
         //debug($res);
         return $res;
     }
}

