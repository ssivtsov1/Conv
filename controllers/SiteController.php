<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use app\models\index;
use app\models\input_find_server;
use app\models\input_find_server_mysql;
use app\models\code_file;
use app\models\decode_file;
use app\models\input_array;
use app\models\symbol;
use app\models\cmp_str;
use app\models\sets;
use app\models\works;
use app\models\tmp_works;
use app\models\tmp_works_1;
use yii\web\UploadedFile;


class SiteController extends Controller
{  /**
 * 
 * @return type
 */
    public $layout = 'index';
    //public $layout = 'index_prod';
//    public $layout = 'main';

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {

            return $this->render('base');

    }
    
    
    // Импорт отчета по КиевСтар за апрель 2018 года для выявления штрафников
    public function actionImport_ks_0418()
    {
        $sql = "CREATE TABLE tmp_ks0418 (
              tel varchar(10) NOT NULL,
              cost_plan varchar(20) DEFAULT NULL,
              cost_all varchar(10) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('Rep0418.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            //if($i==1) continue;
            $data = explode(";",$s);
            
            if(empty($data[0])) break;
            $data[0] = str_replace('"','',$data[0]);
            $data[0] = str_replace('+380','',$data[0]);
            $data[3] = str_replace('"','',$data[3]);
            $data[9] = str_replace('"','',$data[9]);
            $e=1;
             
                    $sql = "INSERT INTO tmp_ks0418 (tel,cost_plan,cost_all) VALUES(".
                        "'".$data[0]."'".","."'".$data[3]."'".","."'".$data[9]."'".')';

            Yii::$app->db_phone->createCommand($sql)->execute();
        }

        fclose($f);
    }   
    
    // Импорт списка новых работников во врем. таблицу
    public function actionImport_new()
    {
       
        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('new_list.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
           // if(empty($data[0])) break;
            $data = explode(";",$s);
             $data[1] = str_replace("'",'`',$data[1]);
             $date=date("Y-m-d", strtotime($data[2]));
            
            if(empty($data[0])) break;
                     
             
                    $sql = "INSERT INTO newlist (fio,date,spec,p1,p2,p3) VALUES(".
                        "'".$data[1]."'".","."'".$date."'".","."'".$data[3]."'".",".
                            "'".$data[4]."'".","."'".$data[5]."'".",". "'".$data[6]."'".')';

            Yii::$app->db_phone->createCommand($sql)->execute();
        }

        fclose($f);
    }   

   // Импорт списка рабочих в справочник телефонов
    public function actionImport_list_works()
    {
        $sql = "CREATE TABLE tmp_works (
              in_unit varchar(255) NOT NULL,
              id_podr int(11) DEFAULT NULL,
              unit varchar(255) DEFAULT NULL,
              post varchar(255) DEFAULT NULL,
              fio varchar(255) DEFAULT NULL,
              id_name int(11) DEFAULT NULL,
              main_unit varchar(255) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('list_works.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode(",",$s);
            if(empty($data[0])) break;
            $data[3] = str_replace('"',' ',$data[3]);
            $e=1;
            while($e==1)
            {
                $pos = strpos($data[1], "'");
                if(!$pos)
                    {$sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(".
                        "'".$data[1]."'".","."'".$data[3]."'".","."'".$data[4]."'".","."'".$data[5]."'".
                        ",".'null'.",".'null'.')';

                    }
                else
                    {$sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(".
                        '"'.$data[1].'"'.","."'".$data[3]."'".","."'".$data[4]."'".","."'".$data[5]."'".
                        ",".'null'.",".'null'.')';
                     break;
                    }

                $pos = strpos($data[5], "'");
                if(!$pos)
                    $sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(".
                           "'".$data[1]."'".","."'".$data[3]."'".","."'".$data[4]."'".","."'".$data[5]."'".
                    ",".'null'.",".'null'.')';
                else
                    $sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(".
                        "'".$data[1]."'".","."'".$data[3]."'".","."'".$data[4]."'".",".'"'.$data[5].'"'.
                        ",".'null'.",".'null'.')';
                $e=0;
            }

            Yii::$app->db_phone->createCommand($sql)->execute();
        }

        fclose($f);
        // Делаем обновление полей id_podr и id_name проверяем совпадение строк по fio
        $sql = 'UPDATE tmp_works a,1c b SET a.id_podr=b.id_podr,a.id_name=b.id_name
                WHERE a.fio = b.Працівник ';
        Yii::$app->db_phone->createCommand($sql)->execute();
        $data=tmp_works::find()->where('id_name is not null')->orderby('id_name')->all();
        $i = 0;
        // Делаем чтобы все номера работников шли по порядку
        foreach ($data as $d){
            $i++;
//            $d->id_sort = $i;
            $d->id_name = $i;
            $d->save();
        }

        $max = $i;  // Сдесь макс. последний номер работника
        $data=tmp_works::find()->where('id_name is null')->all();
        // Делаем чтобы все номера работников шли по порядку - тем которые null присваивается максимальный номер + 1
        foreach ($data as $d){
            $max++;
//            $d->id_sort = $max;
            $d->id_name = $max;
            $d->id_podr = 20;
            $d->save();
        }

        // Заполняем поле main_unit
        $sql = 'UPDATE tmp_works a,1c b SET `a`.`main_unit` = `b`.`Входит в подразделение`
                WHERE `a`.`unit` = `b`.`Підрозділ організації`';
        Yii::$app->db_phone->createCommand($sql)->execute();

        $sql = 'UPDATE tmp_works a,1c b SET `a`.`main_unit` = `b`.`Входит в подразделение`
                WHERE `a`.`in_unit` = `b`.`Підрозділ організації` and a.main_unit is null';
        Yii::$app->db_phone->createCommand($sql)->execute();

//        $sql = 'UPDATE tmp_works  SET `Входит в подразделение` = `main_unit`  // ЭТО ВАЖНЫЙ ЗАПРОС НУЖНО БУДЕТ ЕГО ДЕЛАТЬ
//                WHERE `Входит в подразделение` NOT like "%РЕМ%"';             // ПОСЛЕДНИЙ РАЗ ДЕЛАЛ ЕГО НА СЕРВЕРЕ
//        Yii::$app->db_phone->createCommand($sql)->execute();                  // ТАК КАК ОН СДЕСЬ ЧЕГО-ТО НЕ СРАБОТАЛ

        // Удаляем все из таблицы 1c
        $sql = 'DELETE FROM 1c';
        Yii::$app->db_phone->createCommand($sql)->execute();
//        // Переписываем данные из tmp_works в 1c
////        $sql = "INSERT INTO 1c ('Входит в подразделение', 'id_podr',
////                'id_name', 'Працівник','Посада','Підрозділ організації')
////                 SELECT in_unit,id_podr,id_name,fio,post,unit FROM tmp_works";
////        Yii::$app->db_phone->createCommand($sql)->execute();
//        $model = new works();
//        $data=tmp_works::find()->all();
//        foreach ($data as $d){
//
//            $model->id_name = $d->id_name;
//            $model->id_podr = $d->id_podr;
//            $model->Працівник = $d->fio;
//            $model->Посада = $d->post;
////            $model->Входит в подразделение = $d->in_unit;
////            $model->Підрозділ організації = $d->unit;
//            $model->save();
//        }

        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `fio` `Працівник` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();
        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `post` `Посада` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();
        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `in_unit` `Входит в подразделение` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();
        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `unit` `Підрозділ організації` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Удаляем таблицу 1c
        $sql = "DROP TABLE 1c";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Переименовываем таблицу tmp_works в 1c
        $sql = "RENAME TABLE tmp_works TO 1c";
        Yii::$app->db_phone->createCommand($sql)->execute();

        echo "Інформацію записано";
        //return $this->render('base');

    }
    
    // Импорт списка рабочих в справочник телефонов для нового телефонного справочника
    public function actionImport_list_works_new()
    {
        $sql = "CREATE TABLE tmp_works (
              tab_nom varchar(255) NOT NULL,
              email varchar(255) NOT NULL,
              unit_1 varchar(255) NOT NULL,
              id_podr int(11) DEFAULT NULL,
              unit_2 varchar(255) DEFAULT NULL,
              post varchar(255) DEFAULT NULL,
              fio varchar(255) DEFAULT NULL,
              id_name int(11) DEFAULT NULL,
              main_unit varchar(255) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('list_works1.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode(",",$s);
            if(empty($data[0])) break;
            $data[3] = str_replace('"',' ',$data[3]);
            $e=1;
            while($e==1)
            {
                $pos = strpos($data[2], "'");
                if(!$pos)
                    {$sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name) VALUES(".
                        "'".$data[1]."'".","."'".$data[2]."'".","."'".$data[3]."'".","."'".$data[4]."'".","."'".$data[5]."'".
                        ",".'null'.",".'null'.')';

                    }
                else
                    {$sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name) VALUES(".
                        "'".$data[1]."'".",".'"'.$data[2].'"'.","."'".$data[3]."'".","."'".$data[4]."'".","."'".$data[5]."'".
                        ",".'null'.",".'null'.')';
                     break;
                    }

                $pos = strpos($data[5], "'");
                if(!$pos)
                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name) VALUES(".
                        "'".$data[1]."'".","."'".$data[2]."'".","."'".$data[3]."'".","."'".$data[4]."'".","."'".$data[5]."'".
                        ",".'null'.",".'null'.')';
                else
                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name) VALUES(".
                        "'".$data[1]."'".","."'".$data[2]."'".","."'".$data[3]."'".",".'"'.$data[5].'"'.
                        ",".'null'.",".'null'.')';
                $e=0;
            }

            Yii::$app->db_phone_loc->createCommand($sql)->execute();
        }

        fclose($f);
        // Делаем обновление полей id_podr и id_name проверяем совпадение строк по fio
        $sql = 'UPDATE tmp_works a,1c b SET a.id_podr=b.id_podr,a.id_name=b.id_name,a.main_unit=b.main_unit
                WHERE a.fio = b.fio ';
        Yii::$app->db_phone_loc->createCommand($sql)->execute();
        $data=tmp_works_1::find()->where('id_name is not null')->orderby('id_name')->all();
        $i = 0;
        // Делаем чтобы все номера работников шли по порядку
        foreach ($data as $d){
            $i++;
//            $d->id_sort = $i;
            $d->id_name = $i;
            $d->save();
        }

        $max = $i;  // Сдесь макс. последний номер работника
        $data=tmp_works_1::find()->where('id_name is null')->all();
        // Делаем чтобы все номера работников шли по порядку - тем которые null присваивается максимальный номер + 1
        foreach ($data as $d){
            $max++;
//            $d->id_sort = $max;
            $d->id_name = $max;
            $d->id_podr = 20;
            $d->save();
        }

        
        // Заполняем поле main_unit
//        $sql = 'UPDATE tmp_works a,1c b SET `a`.`main_unit` = `b`.`Входит в подразделение`
//                WHERE `a`.`unit` = `b`.`Підрозділ організації`';
//        Yii::$app->db_phone_loc->createCommand($sql)->execute();
//
//        $sql = 'UPDATE tmp_works a,1c b SET `a`.`main_unit` = `b`.`Входит в подразделение`
//                WHERE `a`.`in_unit` = `b`.`Підрозділ організації` and a.main_unit is null';
//        Yii::$app->db_phone_loc->createCommand($sql)->execute();

//        $sql = 'UPDATE tmp_works  SET `Входит в подразделение` = `main_unit`  // ЭТО ВАЖНЫЙ ЗАПРОС НУЖНО БУДЕТ ЕГО ДЕЛАТЬ
//                WHERE `Входит в подразделение` NOT like "%РЕМ%"';             // ПОСЛЕДНИЙ РАЗ ДЕЛАЛ ЕГО НА СЕРВЕРЕ
//        Yii::$app->db_phone->createCommand($sql)->execute();                  // ТАК КАК ОН СДЕСЬ ЧЕГО-ТО НЕ СРАБОТАЛ

        // Удаляем все из таблицы 1c
        $sql = 'DELETE FROM 1c';
        Yii::$app->db_phone_loc->createCommand($sql)->execute();
        // Переписываем данные из tmp_works в 1c
        $sql = 'INSERT INTO 1c (id,id_podr,id_name,tab_nom,fio,main_unit,unit_1,unit_2,post,email)'
                . ' SELECT id,id_podr,id_name,tab_nom,fio,main_unit,unit_1,unit_2,post,email FROM tmp_works';
        Yii::$app->db_phone_loc->createCommand($sql)->execute();
        
        $sql = "UPDATE 1c SET main_unit = unit_1 "
                . "WHERE unit_1 LIKE '%РЕМ%' AND unit_1 NOT LIKE 'Група РЕМ%' and main_unit is null";
          Yii::$app->db_phone_loc->createCommand($sql)->execute();
          
          $sql = "UPDATE 1c SET email = unit_1 "
                . " WHERE unit_1 LIKE 'Загальновиробничий персонал%'" ;
          Yii::$app->db_phone_loc->createCommand($sql)->execute();
          
          $sql = "UPDATE 1c SET unit_1 = unit_2 "
                . " WHERE unit_1 LIKE 'Загальновиробничий персонал%'" ;
          Yii::$app->db_phone_loc->createCommand($sql)->execute();

          $sql = "UPDATE 1c SET unit_2 = email "
                . " WHERE email LIKE 'Загальновиробничий персонал%'" ;
          Yii::$app->db_phone_loc->createCommand($sql)->execute();
          
          $sql = "UPDATE 1c SET email = ''"
                . " WHERE email LIKE 'Загальновиробничий персонал%'" ;
          Yii::$app->db_phone_loc->createCommand($sql)->execute();
          
          $sql =    "update 1c
                    set main_unit = unit_1
                    WHERE `unit_1` LIKE '%РЕМ%'
                    AND `main_unit` LIKE '%РЕМ%'
                    AND unit_1 <> main_unit";
          Yii::$app->db_phone_loc->createCommand($sql)->execute();
//        
        echo "Інформацію записано";
        return;
////        $sql = "INSERT INTO 1c ('Входит в подразделение', 'id_podr',
////                'id_name', 'Працівник','Посада','Підрозділ організації')
////                 SELECT in_unit,id_podr,id_name,fio,post,unit FROM tmp_works";
////        Yii::$app->db_phone->createCommand($sql)->execute();
//        $model = new works();
//        $data=tmp_works::find()->all();
//        foreach ($data as $d){
//
//            $model->id_name = $d->id_name;
//            $model->id_podr = $d->id_podr;
//            $model->Працівник = $d->fio;
//            $model->Посада = $d->post;
////            $model->Входит в подразделение = $d->in_unit;
////            $model->Підрозділ організації = $d->unit;
//            $model->save();
//        }
      
        
        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `fio` `Працівник` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();
        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `post` `Посада` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();
        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `in_unit` `Входит в подразделение` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();
        $sql = "ALTER TABLE tmp_works CHANGE COLUMN `unit` `Підрозділ організації` varchar(255) NOT NULL";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Удаляем таблицу 1c
        $sql = "DROP TABLE 1c";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Переименовываем таблицу tmp_works в 1c
        $sql = "RENAME TABLE tmp_works TO 1c";
        Yii::$app->db_phone->createCommand($sql)->execute();

        echo "Інформацію записано";
        //return $this->render('base');

    }

    
    // Импорт списка рабочих из файла ОК во врем. табл.
    public function actionImport_list_new()
    {
        $sql = "CREATE TABLE tmp_works (
              tab_nom varchar(255) NOT NULL,
              email varchar(255) DEFAULT NULL,
              unit_1 varchar(255) NOT NULL,
              id_podr int(11) DEFAULT NULL,
              unit_2 varchar(255) DEFAULT NULL,
              post varchar(255) DEFAULT NULL,
              fio varchar(255) DEFAULT NULL,
              id_name int(11) DEFAULT NULL,
              main_unit varchar(255) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('list_new.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            
            if($i==1) continue;
            $s=substr($s,1);
            $data = explode(";",$s);
            if(empty($data[0])) break;
            $data[3] = str_replace('"',' ',$data[3]);
            $e=1;
            while($e==1)
            {
                $pos = strpos($data[5], "'");
                if(!$pos)
                    {$sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
                        "'".$data[0]."'".","."'".$data[1]."'".","."'".$data[5]."'".","."'".$data[3]."'".","."'".$data[2]."'".
                        ",".'null'.",".'null'.","."'".$data[4]."'".')';

                    }
                else
                    {$sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
                        "'".$data[0]."'".",".'"'.$data[1].'"'.","."'".$data[5]."'".","."'".$data[3]."'".","."'".$data[2]."'".
                        ",".'null'.",".'null'.","."'".$data[4]."'".')';
                     break;
                    }

                $pos = strpos($data[1], "'");
                if(!$pos)
                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
                        "'".$data[0]."'".","."'".$data[1]."'".","."'".$data[5]."'".","."'".$data[3]."'".","."'".$data[2]."'".
                        ",".'null'.",".'null'.","."'".$data[4]."'".')';
                else
                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
                        "'".$data[0]."'".",".'"'.$data[1].'"'.","."'".$data[5]."'".",".'"'.$data[3].'"'.","."'".$data[2]."'".
                        ",".'null'.",".'null'.","."'".$data[4]."'".')';
                $e=0;
            }

            Yii::$app->db_phone_loc->createCommand($sql)->execute();
        }

        fclose($f);
        
        
        // Переписываем данные из tmp_works в 1c
        $sql = 'INSERT INTO 1c (id_podr,id_name,tab_nom,fio,main_unit,unit_1,unit_2,post)'
                . ' SELECT id_podr,id_name,tab_nom,fio,main_unit,unit_1,unit_2,post FROM tmp_works_new '
                . 'where cast(tab_nom as dec(4,0))>1731';
        //Yii::$app->db_phone_loc->createCommand($sql)->execute();
        
                
        
        echo "Інформацію записано";
        //return $this->render('base');

    }

    
    // Импорт населенных пунктов Украины по Днепропетровской области
    public function actionImport_towns()
    {
        // Добавляем записи в таблицу spr_towns с csv файла houses.csv
        // файл houses.csv взят с УкрПочты
        $f = fopen('houses.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode(";",$s);
            $obl = mb_convert_encoding($data[0],"UTF-8","Windows-1251");
            if($obl<>'Дніпропетровська') continue;
                 
                    $sql = "INSERT INTO spr_towns (obl,district,town,street) VALUES(".
                        '"'.$obl.'"'.",".'"'.
                            mb_convert_encoding($data[1],"UTF-8","Windows-1251").'"'.",".'"'.
                            mb_convert_encoding($data[2],"UTF-8","Windows-1251").'"'.",".'"'.
                            mb_convert_encoding($data[4],"UTF-8","Windows-1251").'"'.')';
                       

            Yii::$app->db_connect->createCommand($sql)->execute();
        }

        fclose($f);
        echo "Інформацію записано";
    }
    
    

// Импорт данных по лицензированной деятельности
// в справочник видов услуг в 1Click    
    public function actionImport_lic()
    {
       $sql = "CREATE TABLE tmp_works (
              work varchar(255) NOT NULL,
              brig varchar(255) DEFAULT NULL,
              stavka dec(7,2) NOT NULL,
              time_transp dec(5,2) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db->createCommand($sql)->execute();
        $f = fopen('lic.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            
            if($i<3 || ($i>38 && $i<53)) continue;
            $data = explode(";",$s);
            $s1=$data[0];
            $s1=substr($s1,0,1);
            $cod = ord($s1);
            
           // debug($data);
            
            if($cod>=48 && $cod<58){
               //echo $i.' '.$data[1].' '.$data[2].' '.$data[3].' '.$data[6]."\n";
               $work = str_replace("'","`",$data[1]);
               $brig = $data[2];
               $stavka = str_replace(',','.',$data[3]);
               $time = str_replace(',','.',$data[6]);;
               $v = "'".$work."'".","."'".$brig."'".",".$stavka.",".$time;
            }
            else{
               //if($i==76) debug($data); 
               //echo $i.' '.$data[2].' '.$data[3]."\n"; 
               $brig = $data[2]; 
               $stavka = str_replace(',','.',$data[3]);;
               
               $v = "'".$work."'".","."'".$brig."'".",".$stavka.",".$time;
            }
            if($brig=='-') continue;
            if(empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3]) &&  $i<>41) break;         
            //echo $i.' '.$data[0].' '.$data[1].' '.$data[2].' '.$data[5]."\n";
            //echo $v."\n";
            $sql = "INSERT INTO tmp_works (work,brig,stavka,time_transp) VALUES(".$v.')';

            Yii::$app->db->createCommand($sql)->execute();
            }

        fclose($f);
                
        echo "Інформацію записано";
     }

     
     
// Импорт данных по не лицензированной деятельности
// в справочник видов услуг в 1Click    
    public function actionImport_notlic()
    {
       $sql = "CREATE TABLE tmp_notlic (
              work varchar(255) NOT NULL,
              cast_1 dec(7,2) NOT NULL,
              cast_2 dec(7,2) NOT NULL,
              cast_3 dec(7,2) NOT NULL,
              cast_4 dec(7,2) NOT NULL,
              cast_5 dec(7,2) NOT NULL,
              cast_6 dec(7,2) NOT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db->createCommand($sql)->execute();
        $f = fopen('work.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            
            if($i<6) continue;
            $data = explode(";",$s);
            //debug($data);
            $work = str_replace("'","`",trim($data[1]));
            
            $cast_1 = del_space($data[2]);
            $cast_2 = del_space($data[4]);
            $cast_3 = del_space($data[6]);
            $cast_4 = del_space($data[8]);
            $cast_5 = del_space($data[10]);
            $cast_6 = del_space($data[12]);
            
            $cast_1 = str_replace(",",".",$cast_1);
            $cast_2 = str_replace(",",".",$cast_2);
            $cast_3 = str_replace(",",".",$cast_3);
            $cast_4 = str_replace(",",".",$cast_4);
            $cast_5 = str_replace(",",".",$cast_5);
            $cast_6 = str_replace(",",".",$cast_6);
                                    
            if(empty($cast_1)) $cast_1='0'; 
            if(empty($cast_2)) $cast_2='0';
            if(empty($cast_3)) $cast_3='0';
            if(empty($cast_4)) $cast_4='0';
            if(empty($cast_5)) $cast_5='0';
            if(empty($cast_6)) $cast_6='0';
            
            $v = "'".$work."'".",".$cast_1.",".$cast_2.",".$cast_3.",".$cast_4.",".$cast_5.",".$cast_6;
            
            if(empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3])) break;         
            //echo $i.' '.$data[0].' '.$data[1].' '.$data[2].' '.$data[5]."\n";
            echo $v."\n";
            $sql = "INSERT INTO tmp_notlic (work,cast_1,cast_2,cast_3,cast_4,cast_5,cast_6) VALUES(".$v.')';

            Yii::$app->db->createCommand($sql)->execute();
            }

        fclose($f);
                
        echo "Інформацію записано";
     }


     // Импорт данных по транспорту
    // в справочник транспорта в 1Click    
    public function actionImport_transport()
    {
       $sql = "CREATE TABLE tmp_transport (
              transport varchar(255) NOT NULL,
              nomer varchar(15) NOT NULL,
              prostoy dec(7,2) NOT NULL,
              proezd dec(7,2) NOT NULL,
              rabota dec(7,2) NOT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db->createCommand($sql)->execute();
        $f = fopen('transp.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            
            if($i<8) continue;
            $data = explode(";",$s);
            //debug($data);
            $transport = $data[1];
            $nomer = $data[2];
            $prostoy = $data[4];
            $proezd = $data[5];
            $rabota = $data[6];
           
            $prostoy = str_replace(",",".",$prostoy);
            $proezd = str_replace(",",".",$proezd);
            $rabota = str_replace(",",".",$rabota);
            
            if(empty($rabota) || is_null($rabota) || $rabota=='' || ord($rabota)==10) $rabota=0;
            
            $v = "'".$transport."'".","."'".$nomer."'".",".$prostoy.",".$proezd.",".$rabota;
            
            if(empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3])) break;         
            //echo $i.' '.$data[0].' '.$data[1].' '.$data[2].' '.$data[5]."\n";
            //echo $v."\n";
            $sql = "INSERT INTO tmp_transport (transport,nomer,prostoy,proezd,rabota) VALUES(".$v.')';
            //echo $sql;
            Yii::$app->db->createCommand($sql)->execute();
            }

        fclose($f);
                
        echo "Інформацію записано";
     }
     
     
      // Импорт данных по MTS
    // в справочник телефонов   
    public function actionImport_mts()
    {
       $sql = "CREATE TABLE mts (
              tel varchar(10) NOT NULL,
              tarif varchar(80) NOT NULL,
              fio varchar(80) NOT NULL,
              post varchar(80) NOT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();
        $f = fopen('mts.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode(",",$s);
            $tel = $data[0];
            $tarif = $data[1];
            $fio = $data[2];
            $post = $data[3];
                      
            $v = "'".$tel."'".","."'".$tarif."'".","."'".$fio."'".","."'".$post."'";
            
            if(empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3])) break;         
            
            $sql = "INSERT INTO mts (tel,tarif,fio,post) VALUES(".$v.')';
            Yii::$app->db_phone_loc->createCommand($sql)->execute();
            }

        fclose($f);
                
        echo "Інформацію записано";
     }
     

    // Делает поиск на сервере PostGreSQL
    public function actionFind()
    {
        $model = new input_find_server();

        if ($model->load(Yii::$app->request->post()))
        {
            $data = $model->search();
            
            return $this->render('result_find', ['r' => $data]);
          
        }
        else {

            return $this->render('input_find_server', [
                'model' => $model,
            ]);
        }
    }
    
     // Делает поиск на сервере MySQL
    public function actionFind_mysql()
    {
        $model = new input_find_server_mysql();

        if ($model->load(Yii::$app->request->post()))
        {
            $data = $model->search();
            
            return $this->render('result_find', ['r' => $data]);
          
        }
        else {

            return $this->render('input_find_server_mysql', [
                'model' => $model,
            ]);
        }
    }


    // Делает ввод данных и преобразование чисел
    public function actionConvert()
    {
        $model = new index();

        if ($model->load(Yii::$app->request->post()))
        {

            $arr['src'] = split ("\n", trim($model->number));

            $kol = count($arr['src']);
            $i=0;


            foreach ($arr['src'] as $v)
            { if(empty($v) || !isset($v)) continue;

                if(empty($model->sys_res)) {
                    if ($model->sys == 1) {
                        $arr['dec'][$i] = base_convert($v, 16, 10);
                        $arr['oct'][$i] = base_convert($v, 16, 8);
                        $arr['bin'][$i] = base_convert($v, 16, 2);
                    }
                    if ($model->sys == 2) {
                        $arr['hex'][$i] = base_convert($v, 10, 16);
                        $arr['oct'][$i] = base_convert($v, 10, 8);
                        $arr['bin'][$i] = base_convert($v, 10, 2);
                    }
                    if ($model->sys == 3) {
                        $arr['dec'][$i] = base_convert($v, 8, 10);
                        $arr['hex'][$i] = base_convert($v, 8, 16);
                        $arr['bin'][$i] = base_convert($v, 8, 2);
                    }
                    if ($model->sys == 4) {
                        $arr['dec'][$i] = base_convert($v, 2, 10);
                        $arr['oct'][$i] = base_convert($v, 2, 8);
                        $arr['hex'][$i] = base_convert($v, 2, 16);
                    }
                }
                else {
                    switch($model->sys_res) {
                        case 1:
                            $k = 'hex';
                            break;
                        case 2:
                            $k = 'dec';
                            break;
                        case 3:
                            $k = 'oct';
                            break;
                        case 4:
                            $k = 'bin';
                            break;
                    }
                    switch($model->sys) {
                        case 1:
                            $q = 16;
                            break;
                        case 2:
                            $q = 10;
                            break;
                        case 3:
                            $q = 8;
                            break;
                        case 4:
                            $q = 2;
                            break;
                    }
                    switch($model->sys_res) {
                        case 1:
                            $r = 16;
                            break;
                        case 2:
                            $r = 10;
                            break;
                        case 3:
                            $r = 8;
                            break;
                        case 4:
                            $r = 2;
                            break;
                    }
                    $arr[$k][$i] = strtoupper(base_convert($v, $q, $r));

                }

                $i++;
            }
//            debug($arr);
//            return;


            return $this->render('result', ['arr' => $arr,'q' => $q,'r' => $r , 'k' => $k, 'kol' => $kol]);
        }
        else {

            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }
    // Отображение результата (происходит при нажатии на кн. OK)
    public function actionResult($model)
    {
        //$model = new index();
        //$model = $model::find()->all();


        return $this->render('result', ['model' => $model]);
    }


//    Кодирование строки
    public function actionCode()
    {
       $model = new symbol();

        if ($model->load(Yii::$app->request->post()))
        {
            $r = $model->str;
            $p = $model->passwd;
            return $this->render('result_code', ['r' => $r,'p' => $p ]);
        }
        else {

            return $this->render('symbol_code', [
                'model' => $model,'vid'=>2
            ]);
        }
    }
    
    //    Операции с множествами
    public function actionOper_sets()
    {
       $model = new sets();

        if ($model->load(Yii::$app->request->post()))
        {
            $a = $model->a;
            $b = $model->b;
            $mas_a = explode(",", $a);
            $mas_b = explode(",", $b);
            $oper = $model->oper;
            $key = $model->prepare($mas_a,$mas_b);
            if($oper==1)
                $data = $model->union($key);
            if($oper==2)
                $data = $model->cross($key);
            if($oper==3)
                $data = $model->a_m_b($key);
            if($oper==4)
                $data = $model->b_m_a($key);
            if($oper==5)
                $data = $model->uncross($key);
            $model->finish();
            return $this->render('result_set', ['data' => $data]);
        }
        else {

            return $this->render('oper_sets', [
                'model' => $model,'vid'=>2
            ]);
        }
    }

    //    Кодирование файла
    public function actionCode_file()
    {
       $model = new code_file();
        
            
        if ($model->load(Yii::$app->request->post()))
        {
            if (Yii::$app->request->isPost) 
                $model->file = UploadedFile::getInstance($model, 'file');
            $p = $model->passwd;
            $file = $model->file;
            $model->file->saveAs('./'.$file->name);            
            return $this->render('result_code_file', ['file' => $file,'p' => $p,'mode' => 1]);
        }
        else {

            return $this->render('file_code', [
                'model' => $model,'vid'=>1
            ]);
        }
    }
    
    //    Декодирование файла
    public function actionDecode_file()
    {
       $model = new decode_file();
        
            
        if ($model->load(Yii::$app->request->post()))
        {
            if (Yii::$app->request->isPost) 
                $model->file = UploadedFile::getInstance($model, 'file');
            $p = $model->passwd;
            $file = $model->file;
            $model->file->saveAs('./'.$file->name);            
            return $this->render('result_code_file', ['file' => $file,'p' => $p,'mode' => 2]);
        }
        else {

            return $this->render('file_code', [
                'model' => $model,'vid'=>2
            ]);
        }
    }
    
//    Страница о программе
    public function actionAbout()
    {
        return $this->render('about');
    }

    // Проверка символов на раскладку клавиатуры
    public function actionCheck_symbol()
    {
        $model = new symbol();

        if ($model->load(Yii::$app->request->post()))
        {

            return $this->render('symbol_result', ['model' => $model]);
        }
        else {

            return $this->render('symbol', [
                'model' => $model,'vid'=>1
            ]);
        }
    }
    
    // Проверка строк на различие
    public function actionCmp_str()
    {
        $model = new cmp_str();

        if ($model->load(Yii::$app->request->post()))
        {

            return $this->render('symbol_result_str', ['model' => $model]);
        }
        else {

            return $this->render('cmp_str', [
                'model' => $model,'vid'=>1
            ]);
        }
    }
    
     public function actionDownload($f)
    {
        $file = Yii::getAlias($f);
        return Yii::$app->response->sendFile($file);
    }

     // Делает ввод данных и работу с функцией a2sql
    public function actionA2sql()
    {
        $model = new input_array();

        if ($model->load(Yii::$app->request->post()))
        {

            //$arr['src'] = split ("\n", trim($model->number));
            
            $str = trim($model->number);
            $y = strlen($str);
            $flag=0;
            $s='';
            $j=0;
            $k=0;
            $p=1;
            for($i=0;$i<$y;$i++){
                $c = substr($str,$i,1);
                if($i==($y-1)) $s.=$c;
                if($c!="\n" && $i!=($y-1)){
                     $s.=$c;
                }
                else{
                    if(strlen($s)==1 || $s=='') {$flag=1;$s='';$p++;$k=0;continue;}
                    if($flag==0)
                    {
                        $arr['dat1'][$j] = $s;
                        $j++;
                        
                    }
                    if($flag==1)
                    {
                        $arr['dat'.$p][$k] = $s;
                        $k++;
                        
                    }
                   
                    $s='';
                }
                
            }
            $kol = 0;
            $i=0;
            $k = count($arr);
//            for($i=0;$i<$k;$i++)
//                echo $arr[$i];
//            debug(count($arr));
//            return;
                        
            return $this->render('result_task', ['arr' => $arr,'kol' => $kol]);
        }
        else {

            return $this->render('input_data', [
                'model' => $model,
            ]);
        }
    }
}



