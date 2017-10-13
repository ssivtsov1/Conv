<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\data\ArrayDataProvider;
use app\models\index;
use app\models\symbol;
use app\models\works;
use app\models\tmp_works;


class SiteController extends Controller
{  /**
 * 
 * @return type
 */
    public $layout = 'index';
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


//    Сохранение файла макета на локальной машине
    public function actionDownload($f)
    {
       // $model = $this->findModel($id);
        $file = Yii::getAlias($f);
        return Yii::$app->response->sendFile($file); 
    }

//    Страница о программе

    public function actionAbout()
    {
        return $this->render('about');
    }

    // Проверка символов на раскладку клавиатуры
    public function actionCheck_symbol()
    {
//        Arr2Tab([],'res');
//        $sql = 'CREATE TEMPORARY TABLE test1
//                SELECT * FROM spr_res';
//        Yii::$app->db->createCommand($sql)->execute();
        $model = new symbol();

        if ($model->load(Yii::$app->request->post()))
        {

            return $this->render('symbol_result', ['model' => $model]);
        }
        else {

            return $this->render('symbol', [
                'model' => $model,
            ]);
        }
    }

}



