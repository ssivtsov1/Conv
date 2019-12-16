<?php


namespace app\models;

//use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Форма ввода данных для поиска на сервере PostGreSQL
 */
class Input_find_server extends Model
{
    public $search ;
    public $res ;
    public $db ;
    public $type ;
    public $vid ;
    public $break=0;
    public $fwhere;
    public $server;
    public $net;
       
    public function attributeLabels()
    {
        return [

            'search' => 'Данные для поиска:',
            'res'    => 'РЭС:',
            'db'     => 'База:',
            'type'      => 'Тип данных:',
            'vid'       => 'Вид данных:',
            'break'     => 'Прекратить поиск при первом совпадении',
            'fwhere'     => 'Где искать:',
            'server'     => 'Сервер:',
            'net'        => 'Сеть:',
           
        ];
    }

    public function rules()
    {
        return [
           
            [['search','res','db','type','vid','fwhere','server','net'], 'required'],
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
                $sql = "select table_name, column_name 
                from information_schema.columns 
                where table_schema='public'
                and column_name="."'".$s."'".
                ' order by 1';
         
         if($this->type==1) // Строка
         {if($this->vid==1)
                $sql = "select table_name, column_name 
                from information_schema.columns 
                where table_schema='public'
                and data_type='character varying' and character_maximum_length>=".$len.
                 ' order by 1';

             if($this->server==3)
                 $sql = "select table_name, column_name 
                from information_schema.columns 
                where table_schema='public'
                 and data_type='text' --and character_maximum_length>=5
                 and table_name not like 'f_%' and table_name not in('ProfileData','Sessions','v_accident')
                
                        order by 1";

         
         }
        
         if($this->type==2) // Дата
         {if($this->vid==1)
                $sql = "select table_name, column_name 
                from information_schema.columns 
                where table_schema='public'
                and (data_type='date' or data_type like 'timestamp%')".
                ' order by 1';
         }
         
         if($this->type==3)  // Число
         {if($this->vid==1)
                $sql = "select table_name, column_name 
                from information_schema.columns 
                where table_schema='public'
                and (data_type='integer' or data_type='numeric')".
                ' order by 1';
         }
         } 
         
         if($this->fwhere==2) // Для функций
         {
             $sql = "select proname,prosrc from pg_proc where prosrc like '%".$s."%' and proowner<>10";
         }
         
         if($this->fwhere==3) // Для триггеров
         {
             $sql = "select proname,prosrc from pg_trigger,pg_proc where
                pg_proc.oid=pg_trigger.tgfoid and proowner<>10 and prosrc like '%".$s."%'";
         }
//         debug($sql);
//         debug($sql);
         //return;
        if($this->server==1) { // Поиск на тестовом сервере
        if($this->net==1) {
        if($this->db==2){
             switch($this->res){
                case 1: 
                    $data = \Yii::$app->db_pg_ap_energo_test->createCommand($sql)->queryAll();
                    break; 
                case 2: 
                    $data = \Yii::$app->db_pg_vg_energo_test->createCommand($sql)->queryAll();
                    break; 
                case 3: 
                    $data = \Yii::$app->db_pg_gv_energo_test->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data = \Yii::$app->db_pg_dn_energo_test->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data = \Yii::$app->db_pg_in_energo_test->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data = \Yii::$app->db_pg_zv_energo_test->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data = \Yii::$app->db_pg_krg_energo_test->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data = \Yii::$app->db_pg_pv_energo_test->createCommand($sql)->queryAll();
                    break;
             }
             }
             if($this->db==1){
             switch($this->res){
                case 1: 
                    $data = \Yii::$app->db_pg_ap_abn_test->createCommand($sql)->queryAll(); 
                    break; 
                case 2: 
                    $data = \Yii::$app->db_pg_vg_abn_test->createCommand($sql)->queryAll();
//                    debug($data_f);
//                    return;
                    break; 
                case 3: 
                    $data = \Yii::$app->db_pg_gv_abn_test->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data = \Yii::$app->db_pg_dn_abn_test->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data = \Yii::$app->db_pg_in_abn_test->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data = \Yii::$app->db_pg_zv_abn_test->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data = \Yii::$app->db_pg_krg_abn_test->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
                    break;
             }
             }
        }
        
        if($this->net==2) {
        if($this->db==2){
             switch($this->res){
                case 1: 
                    $data = \Yii::$app->db_pg_ap_energo_test_2->createCommand($sql)->queryAll();
                    break; 
                case 2: 
                    $data = \Yii::$app->db_pg_vg_energo_test_2->createCommand($sql)->queryAll();
                    break; 
                case 3: 
                    $data = \Yii::$app->db_pg_gv_energo_test_2->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data = \Yii::$app->db_pg_dn_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data = \Yii::$app->db_pg_in_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data = \Yii::$app->db_pg_zv_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data = \Yii::$app->db_pg_krg_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data = \Yii::$app->db_pg_pv_energo_test_2->createCommand($sql)->queryAll();
                    break;
             }
             }
             if($this->db==1){
             switch($this->res){
                case 1: 
                    $data = \Yii::$app->db_pg_ap_abn_test_2->createCommand($sql)->queryAll(); 
                    break; 
                case 2: 
                    $data = \Yii::$app->db_pg_vg_abn_test_2->createCommand($sql)->queryAll();
//                    debug($data_f);
//                    return;
                    break; 
                case 3: 
                    $data = \Yii::$app->db_pg_gv_abn_test_2->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data = \Yii::$app->db_pg_dn_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data = \Yii::$app->db_pg_in_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data = \Yii::$app->db_pg_zv_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data = \Yii::$app->db_pg_krg_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data = \Yii::$app->db_pg_pv_abn_test_2->createCommand($sql)->queryAll();
                    break;
             }
             }
        }
        
        }
         
        //debug($data);
        
        
        if($this->server==2) { // Поиск на реальных серверах 
        if($this->db==2){
             switch($this->res){
                case 1: 
                    $data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                    break; 
                case 2: 
                    $data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                    break; 
                case 3: 
                    $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                    break;
             }
             }
             if($this->db==1){
             switch($this->res){
                case 1: 
                    $data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll(); 
                    break; 
                case 2: 
                    $data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
//                    debug($data_f);
//                    return;
                    break; 
                case 3: 
                    $data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    break;
             }
             }
        }

         if($this->server==3) { // Поиск на сервере Кол-центра

             $f=fopen('aaa',"w+");
             fputs($f,$sql);
             $data = \Yii::$app->db_pg_call->createCommand($sql)->queryAll();
         }
         
         if($this->fwhere==1)
         {
         if($this->vid==1){  
         $k = count($data)-1;
            for($j=0;$j<$k;$j++){
             $tab = $data[$j]['table_name'];
             $col = $data[$j]['column_name'];
             if($this->type=='1')
                $sql = "select ".$col." from ".$tab." where ".$col." like '%".$s."%'";
             if($this->type=='2')
                $sql = "select ".$col." from ".$tab." where ".$col."="."'".$s."'";
             if($this->type=='3')
             {  $flag=0;
             
                $y=strpos($s,'--');
                if($y) 
                     $flag=1;
                if($flag==1)
                {
                   $n1=substr($s,0,$y);
                   $n2=substr($s,$y+2);
                   $sql = "select ".$col." from ".$tab." where ".$col.">=".$n1.' and '.$col."<=".$n2;
//                   debug($sql);
//                   debug($sql);
//                   return;
                }
                if($flag==0)
                {    
                    if(!strpos($s,',')) 
                        $sql = "select ".$col." from ".$tab." where ".$col."=".$s;
                    else
                        $sql = "select ".$col." from ".$tab." where ".$col." in (".$s.')';
                } 
             }

//             debug($sql);
//             return;

                if($this->server==3) { // Поиск на сервере Кол-центра

                    $f=fopen('aaa',"w+");
                    fputs($f,$sql);
                    $data_f = \Yii::$app->db_pg_call->createCommand($sql)->queryAll();
                }

             if($this->server==1) { // Поиск на тестовом сервере
             if($this->net==1) {
             if($this->db==2){
             switch($this->res){
                case 1: 
                    $data_f = \Yii::$app->db_pg_ap_energo_test->createCommand($sql)->queryAll();
                    break; 
                case 2: 
                    $data_f = \Yii::$app->db_pg_vg_energo_test->createCommand($sql)->queryAll();
                    break; 
                case 3: 
                    $data_f = \Yii::$app->db_pg_gv_energo_test->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data_f = \Yii::$app->db_pg_dn_energo_test->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data_f = \Yii::$app->db_pg_in_energo_test->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data_f = \Yii::$app->db_pg_zv_energo_test->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data_f = \Yii::$app->db_pg_krg_energo_test->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data_f = \Yii::$app->db_pg_pv_energo_test->createCommand($sql)->queryAll();
                    break;
             }
             }
             if($this->db==1){
             switch($this->res){
                case 1: 
                    $data_f = \Yii::$app->db_pg_ap_abn_test->createCommand($sql)->queryAll(); 
                    break; 
                case 2: 
                    $data_f = \Yii::$app->db_pg_vg_abn_test->createCommand($sql)->queryAll();
//                    debug($data_f);
//                    return;
                    break; 
                case 3: 
                    $data_f = \Yii::$app->db_pg_gv_abn_test->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data_f = \Yii::$app->db_pg_dn_abn_test->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data_f = \Yii::$app->db_pg_in_abn_test->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data_f = \Yii::$app->db_pg_zv_abn_test->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data_f = \Yii::$app->db_pg_krg_abn_test->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data_f = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
                    break;
             }
             }
            }
            
            if($this->net==2) {
             if($this->db==2){
             switch($this->res){
                case 1: 
                    $data_f = \Yii::$app->db_pg_ap_energo_test_2->createCommand($sql)->queryAll();
                    break; 
                case 2: 
                    $data_f = \Yii::$app->db_pg_vg_energo_test_2->createCommand($sql)->queryAll();
                    break; 
                case 3: 
                    $data_f = \Yii::$app->db_pg_gv_energo_test_2->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data_f = \Yii::$app->db_pg_dn_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data_f = \Yii::$app->db_pg_in_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data_f = \Yii::$app->db_pg_zv_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data_f = \Yii::$app->db_pg_krg_energo_test_2->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data_f = \Yii::$app->db_pg_pv_energo_test_2->createCommand($sql)->queryAll();
                    break;
             }
             }
             if($this->db==1){
             switch($this->res){
                case 1: 
                    $data_f = \Yii::$app->db_pg_ap_abn_test_2->createCommand($sql)->queryAll(); 
                    break; 
                case 2: 
                    $data_f = \Yii::$app->db_pg_vg_abn_test_2->createCommand($sql)->queryAll();
//                    debug($data_f);
//                    return;
                    break; 
                case 3: 
                    $data_f = \Yii::$app->db_pg_gv_abn_test_2->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data_f = \Yii::$app->db_pg_dn_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data_f = \Yii::$app->db_pg_in_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data_f = \Yii::$app->db_pg_zv_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data_f = \Yii::$app->db_pg_krg_abn_test_2->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data_f = \Yii::$app->db_pg_pv_abn_test_2->createCommand($sql)->queryAll();
                    break;
             }
             }
            }
            }
         
             
             if($this->server==2) {  // Поиск на реальных серверах 
             if($this->db==2){
             switch($this->res){
                case 1: 
                    $data_f = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                    break;   
                case 2: 
                    $data_f = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                    break; 
                case 3: 
                    $data_f = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data_f = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data_f = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data_f = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data_f = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data_f = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                    break;
             }
             }
             if($this->db==1){
             switch($this->res){
                case 1: 
                    $data_f = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                    break;  
                case 2: 
                    $data_f = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                    break; 
                case 3: 
                    $data_f = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    break; 
                case 4: 
                    $data_f = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    break;
                case 5: 
                    $data_f = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    break;
                case 6: 
                    $data_f = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                    break;
                case 7: 
                    $data_f = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                    break;
                case 8: 
                    $data_f = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    break;
             }
             }
             }
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

