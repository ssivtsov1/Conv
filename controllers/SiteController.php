<?php

namespace app\controllers;

use app\models\off_site;
use app\models\PoweroutagesForm;
use app\models\Pract1;
use app\models\UploadBytForm;
use app\models\UploadForm;
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
use app\models\input;
use app\models\symbol;
use app\models\cmp_str;
use app\models\addquestions;
use app\models\project_polls;
use app\models\quest;
use app\models\info;
use app\models\export_sap;
use app\models\answer;
use app\models\sets;
//use app\models\pract;
use app\models\works;
use app\models\all_tmc;
use app\models\tmp_works;
use app\models\tmp_works_1;
use yii\web\UploadedFile;
use app\models\sap_connect;
use app\models\TableForm;
use app\models\Power_outages;

class SiteController extends Controller
{
    /**
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

    // Импорт бюджета использрвался в 2019 году
    public function actionImport_budget()
    {
        $f = fopen('budget_18.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(";", $s);
            if (!isset($data[1])) continue;
            //if ($i==16832) {echo $i; echo "<br>";debug($data);return;}

            $data[9] = trim(str_replace('"', "'", $data[9]));
            $data[7] = trim(str_replace('"', "'", $data[7]));
            $data[5] = trim(str_replace('"', "'", $data[5]));


            if (is_null($data[8]) || $data[8] == '') $data[8] = 0;
            if (is_null($data[12]) || $data[12] == '') $data[12] = 0;
            if (is_null($data[13]) || $data[13] == '') $data[13] = 0;
            $data[12] = trim(str_replace(',', '.', $data[12]));
            if (is_null($data[14]) || $data[14] == '') $data[14] = 0;
            $data[14] = trim(str_replace(',', '.', $data[14]));
            if (is_null($data[15]) || $data[15] == '') $data[15] = 0;
            if (is_null($data[16]) || $data[16] == '') $data[16] = 0;
            $data[16] = trim(str_replace(',', '.', $data[16]));
            if (is_null($data[17]) || $data[17] == '') $data[17] = 0;
            if (is_null($data[18]) || $data[18] == '') $data[18] = 0;
            if (is_null($data[19]) || $data[19] == '') $data[19] = 0;
            if (is_null($data[20]) || $data[20] == '') $data[20] = 0;
            $data[20] = trim(str_replace(',', '.', $data[20]));
            if (is_null($data[21]) || $data[21] == '') $data[21] = 0;
            if (is_null($data[22]) || $data[22] == '') $data[22] = 0;
            $data[22] = trim(str_replace(',', '.', $data[22]));
            if (is_null($data[23]) || $data[23] == '') $data[23] = 0;
            if (is_null($data[24]) || $data[24] == '') $data[24] = 0;
            $data[24] = trim(str_replace(',', '.', $data[24]));
            if (is_null($data[25]) || $data[25] == '') $data[25] = 0;
            if (is_null($data[26]) || $data[26] == '') $data[26] = 0;
            if (is_null($data[27]) || $data[27] == '') $data[27] = 0;
            if (is_null($data[28]) || $data[28] == '') $data[28] = 0;
            $data[28] = trim(str_replace(',', '.', $data[28]));
            if (is_null($data[29]) || $data[29] == '') $data[29] = 0;
            if (is_null($data[30]) || $data[30] == '') $data[30] = 0;
            $data[30] = trim(str_replace(',', '.', $data[30]));
            if (is_null($data[31]) || $data[31] == '') $data[31] = 0;
            if (is_null($data[32]) || $data[32] == '') $data[32] = 0;
            $data[32] = trim(str_replace(',', '.', $data[32]));
            if (is_null($data[33]) || $data[33] == '') $data[33] = 0;
            if (is_null($data[34]) || $data[34] == '') $data[34] = 0;
            if (is_null($data[35]) || $data[35] == '') $data[35] = 0;
            if (is_null($data[36]) || $data[36] == '') $data[36] = 0;
            $data[36] = trim(str_replace(',', '.', $data[36]));
            if (is_null($data[37]) || $data[37] == '') $data[37] = 0;
            if (is_null($data[38]) || $data[38] == '') $data[38] = 0;
            $data[38] = trim(str_replace(',', '.', $data[38]));
            if (is_null($data[39]) || $data[39] == '') $data[39] = 0;
            if (is_null($data[40]) || $data[40] == '') $data[40] = 0;
            $data[40] = trim(str_replace(',', '.', $data[40]));
            if (is_null($data[41]) || $data[41] == '') $data[41] = 0;
            if (is_null($data[42]) || $data[42] == '') $data[42] = 0;
            if (is_null($data[43]) || $data[43] == '') $data[43] = 0;
            if (is_null($data[44]) || $data[44] == '') $data[44] = 0;
            if (is_null($data[45]) || $data[45] == '') $data[45] = 0;

            $data[11] = trim(str_replace(',', '.', $data[11]));
            $data[11] = preg_replace("/[^x\d|*\.]/", "", $data[11]);
            $data[13] = trim(str_replace(',', '.', $data[13]));
            $data[13] = preg_replace("/[^x\d|*\.]/", "", $data[13]);
            $data[15] = trim(str_replace(',', '.', $data[15]));
            $data[15] = preg_replace("/[^x\d|*\.]/", "", $data[15]);
            $data[17] = trim(str_replace(',', '.', $data[17]));
            $data[17] = preg_replace("/[^x\d|*\.]/", "", $data[17]);
            $data[18] = trim(str_replace(',', '.', $data[18]));
            $data[18] = preg_replace("/[^x\d|*\.]/", "", $data[18]);
            $data[19] = trim(str_replace(',', '.', $data[19]));
            $data[19] = preg_replace("/[^x\d|*\.]/", "", $data[19]);

            $data[21] = trim(str_replace(',', '.', $data[21]));
            $data[21] = preg_replace("/[^x\d|*\.]/", "", $data[21]);
            $data[23] = trim(str_replace(',', '.', $data[23]));
            $data[23] = preg_replace("/[^x\d|*\.]/", "", $data[23]);
            $data[25] = trim(str_replace(',', '.', $data[25]));
            $data[25] = preg_replace("/[^x\d|*\.]/", "", $data[25]);
            $data[26] = trim(str_replace(',', '.', $data[26]));
            $data[26] = preg_replace("/[^x\d|*\.]/", "", $data[26]);
            $data[27] = trim(str_replace(',', '.', $data[27]));
            $data[27] = preg_replace("/[^x\d|*\.]/", "", $data[27]);

            $data[29] = trim(str_replace(',', '.', $data[29]));
            $data[29] = preg_replace("/[^x\d|*\.]/", "", $data[29]);
            $data[31] = trim(str_replace(',', '.', $data[31]));
            $data[31] = preg_replace("/[^x\d|*\.]/", "", $data[31]);
            $data[33] = trim(str_replace(',', '.', $data[33]));
            $data[33] = preg_replace("/[^x\d|*\.]/", "", $data[33]);
            $data[34] = trim(str_replace(',', '.', $data[34]));
            $data[34] = preg_replace("/[^x\d|*\.]/", "", $data[34]);
            $data[35] = trim(str_replace(',', '.', $data[35]));
            $data[35] = preg_replace("/[^x\d|*\.]/", "", $data[35]);

            $data[37] = trim(str_replace(',', '.', $data[37]));
            $data[37] = preg_replace("/[^x\d|*\.]/", "", $data[37]);
            $data[39] = trim(str_replace(',', '.', $data[39]));
            $data[39] = preg_replace("/[^x\d|*\.]/", "", $data[39]);
            $data[41] = trim(str_replace(',', '.', $data[41]));
            $data[41] = preg_replace("/[^x\d|*\.]/", "", $data[41]);
            $data[42] = trim(str_replace(',', '.', $data[42]));
            $data[42] = preg_replace("/[^x\d|*\.]/", "", $data[42]);
            $data[43] = trim(str_replace(',', '.', $data[43]));
            $data[43] = preg_replace("/[^x\d|*\.]/", "", $data[43]);
            $data[44] = trim(str_replace(',', '.', $data[44]));
            $data[44] = preg_replace("/[^x\d|*\.]/", "", $data[44]);
            $data[45] = trim(str_replace(',', '.', $data[45]));
            $data[45] = preg_replace("/[^x\d|*\.]/", "", $data[45]);


            $sql = "INSERT INTO budget (type_act,vid_tmc,page,service,name_obj,dname_obj,vid_repair,
                    name_spec,lot,name_tmc,ed_izm,price,
                    q_1,p_1,q_2,p_2,q_3,p_3,aq_1,ap_1,q_4,p_4,q_5,p_5,q_6,p_6,aq_2,ap_2,
                    q_7,p_7,q_8,p_8,q_9,p_9,aq_3,ap_3,q_10,p_10,q_11,p_11,q_12,p_12,aq_4,ap_4,
                    year_q,year_p) VALUES(" .
                "'" . $data[0] . "'" . "," . "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . ",'" . $data[3] . "'" . "," . "'" . $data[4] . "'," .
                '"' . $data[5] . '"' . "," . "'" . $data[6] . "'" . "," . '"' . $data[7] . '"' . "," . $data[8] . "," . '"'
                . $data[9] . '",' . "'" . $data[10] . "'" . "," . $data[11] . "," . $data[12] . ","
                . $data[13] . "," . $data[14] . "," . $data[15] . "," . $data[16] . ","
                . $data[17] . "," . $data[18] . "," . $data[19] . "," . $data[20] . "," .
                $data[21] . "," . $data[22] . "," . $data[23] . "," . $data[24] . "," .
                $data[25] . "," . $data[26] . "," . $data[27] . "," . $data[28] . "," .
                $data[29] . "," . $data[30] . "," . $data[31] . "," . $data[32] . "," .
                $data[33] . "," . $data[34] . "," . $data[35] . "," . $data[36] . "," .
                $data[37] . "," . $data[38] . "," . $data[39] . "," . $data[40] . "," .
                $data[41] . "," . $data[42] . "," . $data[43] . "," . $data[44] . "," .
                $data[45] .
                ')';

            if ($i > 19977)
                Yii::$app->db_budget->createCommand($sql)->execute();
//            if ($i>16825) {
//                echo $sql;
//                echo '<br>';
//                echo '<br>';
//                echo $i;
////                echo  preg_replace("/[^x\d|*\.]/", "", $data[44]);
////                exit;
//            }
        }

        fclose($f);

        echo "Інформацію записано";
    }

    public function actionCorr_budget()
    {

        $sql = 'update budget
        set p_1=q_1*price/1000
        WHERE p_1=0 and q_1>0';

        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
        set p_2=q_2*price/1000
        WHERE p_2=0 and q_2>0';

        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
        set ap_2=aq_2*price/1000
        WHERE ap_2=0 and aq_2>0';

        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
        set p_3=q_3*price/1000
        WHERE p_3=0 and q_3>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
        set ap_3=aq_3*price/1000
        WHERE ap_3=0 and aq_3>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_4=q_4*price/1000
WHERE p_4=0 and q_4>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set ap_4=aq_4*price/1000
WHERE ap_4=0 and aq_4>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_5=q_5*price/1000
WHERE p_5=0 and q_5>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_6=q_6*price/1000
WHERE p_6=0 and q_6>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_7=q_7*price/1000
WHERE p_7=0 and q_7>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_8=q_8*price/1000
WHERE p_8=0 and q_8>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_9=q_9*price/1000
WHERE p_9=0 and q_9>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_10=q_10*price/1000
WHERE p_10=0 and q_10>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_11=q_11*price/1000
WHERE p_11=0 and q_11>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set p_12=q_12*price/1000
WHERE p_12=0 and q_12>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget
set year_p=year_q*price/1000
WHERE year_p=0 and year_q>0';
        Yii::$app->db_budget->createCommand($sql)->execute();
//-------------------------------------------------------------------------

        $sql = 'update budget 
        set q_1=p_1*1000/price
        WHERE p_1<>0 and q_1=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_2=p_2*1000/price
        WHERE p_2<>0 and q_2=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_3=p_3*1000/price
        WHERE p_3<>0 and q_3=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_4=p_4*1000/price
        WHERE p_4<>0 and q_4=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_5=p_5*1000/price
        WHERE p_5<>0 and q_5=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_6=p_6*1000/price
        WHERE p_6<>0 and q_6=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_7=p_7*1000/price
        WHERE p_7<>0 and q_7=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_8=p_8*1000/price
        WHERE p_8<>0 and q_8=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_9=p_9*1000/price
        WHERE p_9<>0 and q_9=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_10=p_10*1000/price
        WHERE p_10<>0 and q_10=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_11=p_11*1000/price
        WHERE p_11<>0 and q_11=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set q_12=p_12*1000/price
        WHERE p_12<>0 and q_12=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set aq_1=ap_1*1000/price
        WHERE ap_1<>0 and aq_1=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set aq_2=ap_2*1000/price
        WHERE ap_2<>0 and aq_2=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set aq_3=ap_3*1000/price
        WHERE ap_3<>0 and aq_3=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set aq_4=ap_1*1000/price
        WHERE ap_4<>0 and aq_4=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql = 'update budget 
        set year_q=year_p*1000/price
        WHERE year_p<>0 and year_q=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();


        echo "Інформацію записано";
    }

    // Импорт бюджета за 2019 год
    public function actionImport_budget19()
    {
        $f = fopen('budget_19.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(";", $s);
            //if(!isset($data[1])) continue;
            //if ($i==16832) {echo $i; echo "<br>";debug($data);return;}

            $data[9] = trim(str_replace('"', "'", $data[9]));
            $data[7] = trim(str_replace('"', "'", $data[7]));
            $data[5] = trim(str_replace('"', "'", $data[5]));


            if (is_null($data[8]) || $data[8] == '') $data[8] = 0;
            if (is_null($data[11]) || $data[11] == '' || trim($data[11]) == '-') $data[11] = 0;
            if (is_null($data[12]) || $data[12] == '' || trim($data[12]) == '-') $data[12] = 0;

            if (is_null($data[13]) || $data[13] == '' || trim($data[13]) == '-') $data[13] = 0;
            $data[12] = trim(str_replace(',', '.', $data[12]));
            if (is_null($data[14]) || $data[14] == '' || trim($data[14]) == '-') $data[14] = 0;
            $data[14] = trim(str_replace(',', '.', $data[14]));

            if (is_null($data[15]) || $data[15] == '' || trim($data[15]) == '-') $data[15] = 0;
            if (is_null($data[16]) || $data[16] == '' || trim($data[16]) == '-') $data[16] = 0;
            $data[16] = trim(str_replace(',', '.', $data[16]));
            if (is_null($data[17]) || $data[17] == '' || trim($data[17]) == '-') $data[17] = 0;
            if (is_null($data[18]) || $data[18] == '' || trim($data[18]) == '-') $data[18] = 0;
            if (is_null($data[19]) || $data[19] == '' || trim($data[19]) == '-') $data[19] = 0;
            if (is_null($data[20]) || $data[20] == '' || trim($data[20]) == '-') $data[20] = 0;
            $data[20] = trim(str_replace(',', '.', $data[20]));
            if (is_null($data[21]) || $data[21] == '' || trim($data[21]) == '-') $data[21] = 0;
            if (is_null($data[22]) || $data[22] == '' || trim($data[22]) == '-') $data[22] = 0;
            $data[22] = trim(str_replace(',', '.', $data[22]));
            if (is_null($data[23]) || $data[23] == '' || trim($data[23]) == '-') $data[23] = 0;
            if (is_null($data[24]) || $data[24] == '' || trim($data[24]) == '-') $data[24] = 0;
            $data[24] = trim(str_replace(',', '.', $data[24]));
            if (is_null($data[25]) || $data[25] == '' || trim($data[25]) == '-') $data[25] = 0;
            if (is_null($data[26]) || $data[26] == '' || trim($data[26]) == '-') $data[26] = 0;
            if (is_null($data[27]) || $data[27] == '' || trim($data[27]) == '-') $data[27] = 0;
            if (is_null($data[28]) || $data[28] == '' || trim($data[28]) == '-') $data[28] = 0;
            $data[28] = trim(str_replace(',', '.', $data[28]));
            if (is_null($data[29]) || $data[29] == '' || trim($data[29]) == '-') $data[29] = 0;
            if (is_null($data[30]) || $data[30] == '' || trim($data[30]) == '-') $data[30] = 0;
            $data[30] = trim(str_replace(',', '.', $data[30]));
            if (is_null($data[31]) || $data[31] == '' || trim($data[31]) == '-') $data[31] = 0;
            if (is_null($data[32]) || $data[32] == '' || trim($data[32]) == '-') $data[32] = 0;
            $data[32] = trim(str_replace(',', '.', $data[32]));
            if (is_null($data[33]) || $data[33] == '' || trim($data[33]) == '-') $data[33] = 0;
            if (is_null($data[34]) || $data[34] == '' || trim($data[34]) == '-') $data[34] = 0;
            if (is_null($data[35]) || $data[35] == '' || trim($data[35]) == '-') $data[35] = 0;
            if (is_null($data[36]) || $data[36] == '' || trim($data[36]) == '-') $data[36] = 0;
            $data[36] = trim(str_replace(',', '.', $data[36]));
            if (is_null($data[37]) || $data[37] == '' || trim($data[37]) == '-') $data[37] = 0;
            if (is_null($data[38]) || $data[38] == '' || trim($data[38]) == '-') $data[38] = 0;
            $data[38] = trim(str_replace(',', '.', $data[38]));
            if (is_null($data[39]) || $data[39] == '' || trim($data[39]) == '-') $data[39] = 0;
            if (is_null($data[40]) || $data[40] == '' || trim($data[40]) == '-') $data[40] = 0;
            $data[40] = trim(str_replace(',', '.', $data[40]));
            if (is_null($data[41]) || $data[41] == '' || trim($data[41]) == '-') $data[41] = 0;
            if (is_null($data[42]) || $data[42] == '' || trim($data[42]) == '-') $data[42] = 0;
            if (is_null($data[43]) || $data[43] == '' || trim($data[43]) == '-') $data[43] = 0;
            if (is_null($data[44]) || $data[44] == '' || trim($data[44]) == '-') $data[44] = 0;
//            if(is_null($data[45])  || $data[45]=='') $data[45]=0;

            $data[10] = trim(str_replace(',', '.', $data[10]));
            //$data[10] = trim(str_replace(' ','',$data[10]));
            $data[10] = preg_replace('/[^x\d|*\.]/', '', $data[10]);


//            $data[11] = preg_replace("/[^x\d|*\.]/", "", $data[11]);
            $data[11] = trim(str_replace(',', '.', $data[11]));
            $data[11] = preg_replace("/[^x\d|*\.]/", "", $data[11]);
            $data[13] = trim(str_replace(',', '.', $data[13]));
            $data[13] = preg_replace("/[^x\d|*\.]/", "", $data[13]);
            $data[15] = trim(str_replace(',', '.', $data[15]));
            $data[15] = preg_replace("/[^x\d|*\.]/", "", $data[15]);
            $data[17] = trim(str_replace(',', '.', $data[17]));
            $data[17] = preg_replace("/[^x\d|*\.]/", "", $data[17]);
            $data[18] = trim(str_replace(',', '.', $data[18]));
            $data[18] = preg_replace("/[^x\d|*\.]/", "", $data[18]);
            $data[19] = trim(str_replace(',', '.', $data[19]));
            $data[19] = preg_replace("/[^x\d|*\.]/", "", $data[19]);

            $data[21] = trim(str_replace(',', '.', $data[21]));
            $data[21] = preg_replace("/[^x\d|*\.]/", "", $data[21]);
            $data[23] = trim(str_replace(',', '.', $data[23]));
            $data[23] = preg_replace("/[^x\d|*\.]/", "", $data[23]);
            $data[25] = trim(str_replace(',', '.', $data[25]));
            $data[25] = preg_replace("/[^x\d|*\.]/", "", $data[25]);
            $data[26] = trim(str_replace(',', '.', $data[26]));
            $data[26] = preg_replace("/[^x\d|*\.]/", "", $data[26]);
            $data[27] = trim(str_replace(',', '.', $data[27]));
            $data[27] = preg_replace("/[^x\d|*\.]/", "", $data[27]);

            $data[29] = trim(str_replace(',', '.', $data[29]));
            $data[29] = preg_replace("/[^x\d|*\.]/", "", $data[29]);
            $data[31] = trim(str_replace(',', '.', $data[31]));
            $data[31] = preg_replace("/[^x\d|*\.]/", "", $data[31]);
            $data[33] = trim(str_replace(',', '.', $data[33]));
            $data[33] = preg_replace("/[^x\d|*\.]/", "", $data[33]);
            $data[34] = trim(str_replace(',', '.', $data[34]));
            $data[34] = preg_replace("/[^x\d|*\.]/", "", $data[34]);
            $data[35] = trim(str_replace(',', '.', $data[35]));
            $data[35] = preg_replace("/[^x\d|*\.]/", "", $data[35]);

            $data[37] = trim(str_replace(',', '.', $data[37]));
            $data[37] = preg_replace("/[^x\d|*\.]/", "", $data[37]);
            $data[39] = trim(str_replace(',', '.', $data[39]));
            $data[39] = preg_replace("/[^x\d|*\.]/", "", $data[39]);
            $data[41] = trim(str_replace(',', '.', $data[41]));
            $data[41] = preg_replace("/[^x\d|*\.]/", "", $data[41]);
            $data[42] = trim(str_replace(',', '.', $data[42]));
            $data[42] = preg_replace("/[^x\d|*\.]/", "", $data[42]);
            $data[43] = trim(str_replace(',', '.', $data[43]));
            $data[43] = preg_replace("/[^x\d|*\.]/", "", $data[43]);
            $data[44] = trim(str_replace(',', '.', $data[44]));
            $data[44] = preg_replace("/[^x\d|*\.]/", "", $data[44]);
//            $data[45] = trim(str_replace(',','.',$data[45]));
//            $data[45] = preg_replace("/[^x\d|*\.]/", "", $data[45]);
            if (empty($data[7]) || is_null($data[7])) $data[7] = 0;

            // debug($data);
//            return;

            $sql = "INSERT INTO budget (vid_tmc1,page1,service1,name_obj1,dname_obj,vid_repair1,
                    name_spec1,lot,name_tmc,ed_izm1,price,
                    q_1,p_1,q_2,p_2,q_3,p_3,aq_1,ap_1,q_4,p_4,q_5,p_5,q_6,p_6,aq_2,ap_2,
                    q_7,p_7,q_8,p_8,q_9,p_9,aq_3,ap_3,q_10,p_10,q_11,p_11,q_12,p_12,aq_4,ap_4,
                    year_q,year_p) VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . ",'" . $data[3] . "'" . "," . '"' . $data[4] . '",' .
                '"' . $data[5] . '"' . "," . '"' . $data[6] . '"' . "," . '"' . $data[7] . '"' . "," . '"' . $data[8] . '"' . "," . '"'
                . $data[9] . '",' . $data[10] . "," . $data[11] . "," . $data[12] . ","
                . $data[13] . "," . $data[14] . "," . $data[15] . "," . $data[16] . ","
                . $data[17] . "," . $data[18] . "," . $data[19] . "," . $data[20] . "," .
                $data[21] . "," . $data[22] . "," . $data[23] . "," . $data[24] . "," .
                $data[25] . "," . $data[26] . "," . $data[27] . "," . $data[28] . "," .
                $data[29] . "," . $data[30] . "," . $data[31] . "," . $data[32] . "," .
                $data[33] . "," . $data[34] . "," . $data[35] . "," . $data[36] . "," .
                $data[37] . "," . $data[38] . "," . $data[39] . "," . $data[40] . "," .
                $data[41] . "," . $data[42] . "," . $data[43] . "," . $data[44] .
                ')';

            //if ($i>16029)
            Yii::$app->db_budget->createCommand($sql)->execute();
//            if ($i>16825) {
//                echo $sql;
//                echo '<br>';
//                echo '<br>';
//                echo $i;
////                echo  preg_replace("/[^x\d|*\.]/", "", $data[44]);
////                exit;
//            }
        }

        fclose($f);

        echo "Інформацію записано";
    }


    // Импорт областей
    public function actionImp_obl()
    {
        $f = fopen('obl.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            $data = explode(";", $s);
            if (!isset($data[1])) continue;

            $sql = "INSERT INTO _obl (smb,name) VALUES(" .
                '$$' . $data[0] . '$$' . "," . '$$' . $data[1] . '$$' .
                ')';

            Yii::$app->db_pg_in_energo->createCommand($sql)->execute();

        }

        fclose($f);

        echo "Інформацію записано";
    }

    // Добавление счетчиков (соотв с САП)
    public function actionAdd_cnt()
    {
        $f = fopen('add_cnt.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("~", $s);
            $sql = "INSERT INTO add_cnt (id_type,cek_name,sap_name) VALUES(" .
                $data[1] . "," . '$$' . $data[2] . '$$' . "," . '$$' . $data[3] . '$$' .
                ')';

            Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();

        }

        fclose($f);

        echo "Інформацію записано";
    }

    // Добавление типов пломб (соотв с САП)
    public function actionAdd_type_plomb()
    {
        $f = fopen('sap_type_plombs.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("~", $s);
            $sql = "INSERT INTO sap_type_plombs (sap_name,sap_desc,cek_name) VALUES(" .
                '$$' . $data[0] . '$$' . "," . '$$' . $data[1] . '$$' . "," . '$$' . $data[2] . '$$' .
                ')';

            Yii::$app->db_pg_dn_energo->createCommand($sql)->execute();

        }

        fclose($f);

        echo "Інформацію записано";
    }

    // Импорт районов
    public function actionImp_region()
    {
        $f = fopen('region.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            $data = explode(";", $s);

            $sql = "INSERT INTO _region (smb,name_obl,id,name) VALUES(" .
                '$$' . $data[0] . '$$' . "," . '$$' . $data[1] . '$$' . "," . $data[2] . "," . '$$' . $data[3] . '$$' .
                ')';

            Yii::$app->db_pg_in_energo->createCommand($sql)->execute();

        }

        fclose($f);

        echo "Інформацію записано";
    }

// Импорт остатков по бухгалтерии перетоки
    public function actionImp_ost_reflow()
    {
        $f = fopen('ost_reflow.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            $data = explode("~", $s);
            $data[3] = str_replace(",", ".", $data[3]);
            $data[5] = str_replace(",", ".", $data[5]);
            $data[2] = str_replace("Р", "", $data[2]);

            $sql = "INSERT INTO ost_detal (contragent,dogovor,kredit,data_v_k,debet,data_v_d) VALUES(" .
                '$$' . $data[1] . '$$' . "," . '$$' . $data[2] . '$$' . "," . '$$'.$data[3] . '$$' . "," . '$$' . $data[4] . '$$' . "," .
                '$$' . $data[5] . '$$' .  "," . '$$' . $data[6] . '$$' .')';

            Yii::$app->db_pg_dn_energo->createCommand($sql)->execute();

        }

        fclose($f);

        echo "Інформацію записано";
    }

    // Импорт остатков по бухгалтерии реактив
    public function actionImp_ost_reactiv()
    {
        $f = fopen('ost_detal.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            $data = explode("~", $s);
            $data[3] = str_replace(",", ".", $data[3]);
            $data[5] = str_replace(",", ".", $data[5]);

            $sql = "INSERT INTO ost_detal (contragent,dogovor,kredit,data_v_k,debet,data_v_d) VALUES(" .
                '$$' . $data[1] . '$$' . "," . '$$' . $data[2] . '$$' . "," . '$$'.$data[3] . '$$' . "," . '$$' . $data[4] . '$$' . "," .
                '$$' . $data[5] . '$$' .  "," . '$$' . $data[6] . '$$' .')';

            Yii::$app->db_pg_dn_energo->createCommand($sql)->execute();

        }
        fclose($f);

        echo "Інформацію записано";
    }

    // ---------------- ИМПОРТ ТАБЛИЦ В ДЛЯ НОВОЙ ПРОГРАММЫ С ВИННИЦЫ -----------------------------------------

    // Импорт street с Ингульца [Энерго]
    public function actionImp_street()
    {


        $sql = "select * from tmp_street_e";
        //echo $sql;
        $data_in = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
        $data_ap = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
        //debug($data);
        $sql = "CREATE TABLE tmp_street_e_in
                    (
                      town character varying(200),
                      id_city character varying(200),
                      type_street character varying(20),
                      streettypecode integer,
                      name_street character varying(200),
                      citycoid character varying(200)
                    )";
        //Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        $sql = "CREATE TABLE tmp_street_e_ap
                    (
                      town character varying(200),
                      id_city character varying(200),
                      type_street character varying(20),
                      streettypecode integer,
                      name_street character varying(200),
                      citycoid character varying(200)
                    )";
        //Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        foreach ($data_in as $in) {
            $town = $in['town'];
            $id_city = $in['id_city'];
            $type_street = $in['type_street'];
            $streettypecode = $in['streettypecode'];
            $name_street = $in['name_street'];
            $citycoid = $in['citycoid'];
            $sql = "INSERT INTO tmp_street_e_in (town,id_city,type_street,streettypecode,name_street,citycoid) VALUES(" .
                '$$' . $town . '$$' . "," . "'" . $id_city . "'" . "," . "'" . $type_street . "'" . "," . $streettypecode .
                "," . '$$' . $name_street . '$$' . "," . "'" . $citycoid . "'" . ')';
            Yii::$app->db_pg_im_db->createCommand($sql)->execute();

            //debug($town);
        }
        foreach ($data_ap as $ap) {
            $town = $ap['town'];
            $id_city = $ap['id_city'];
            $type_street = $ap['type_street'];
            $streettypecode = $ap['streettypecode'];
            $name_street = $ap['name_street'];
            $citycoid = $ap['citycoid'];
            $sql = "INSERT INTO tmp_street_e_ap (town,id_city,type_street,streettypecode,name_street,citycoid) VALUES(" .
                '$$' . $town . '$$' . "," . "'" . $id_city . "'" . "," . "'" . $type_street . "'" . "," . $streettypecode .
                "," . '$$' . $name_street . '$$' . "," . "'" . $citycoid . "'" . ')';
            Yii::$app->db_pg_im_db->createCommand($sql)->execute();

            //debug($town);
        }
        echo "Інформацію записано";
    }

// Импорт address с Ингульца [Энерго]
    public function actionImp_address()
    {
        $sql = "select * from tmp_address_e_in";
        $data_in = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
        $sql = "select * from tmp_address_e_ap";
        $data_ap = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
        //debug($data);
        $sql = "CREATE TABLE tmp_address_e_in
                    (
                      zip text,
                      streetcode integer,
                      locationhouse character varying(20),
                      locationapp character varying(20)
                    )";
        // Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        $sql = "CREATE TABLE tmp_address_e_ap
                    (
                      zip text,
                      streetcode integer,
                      locationhouse character varying(20),
                      locationapp character varying(20)
                    )";
        //Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        foreach ($data_in as $in) {
            $zip = $in['zip'];
            $streetcode = $in['streetcode'];
            if (is_null($streetcode)) $streetcode = 0;
            $locationhouse = $in['locationhouse'];
            $locationapp = $in['locationapp'];

            $sql = "INSERT INTO tmp_address_e_in (zip,streetcode,locationhouse,locationapp) VALUES(" .
                '$$' . $zip . '$$' . "," . $streetcode .
                "," . '$$' . $locationhouse . '$$' . "," . "'" . $locationapp . "'" . ')';
            // Yii::$app->db_pg_im_db->createCommand($sql)->execute();

            //debug($town);
        }
        foreach ($data_ap as $ap) {
            $zip = $ap['zip'];
            $streetcode = $ap['streetcode'];
            if (is_null($streetcode)) $streetcode = 0;
            $locationhouse = $ap['locationhouse'];
            $locationapp = $ap['locationapp'];

            $sql = "INSERT INTO tmp_address_e_ap (zip,streetcode,locationhouse,locationapp) VALUES(" .
                '$$' . $zip . '$$' . "," . $streetcode .
                "," . '$$' . $locationhouse . '$$' . "," . "'" . $locationapp . "'" . ')';
            Yii::$app->db_pg_im_db->createCommand($sql)->execute();

            //debug($town);
        }
        echo "Інформацію записано";
    }

    // Експорт в САП
    public function actionCek2sap()
    {
        $model = new export_sap();

        if ($model->load(Yii::$app->request->post())) {
            switch ($model->id_oper) {
                case 1:
                    return $this->redirect(['sap_partner_ind', 'res' => $model->rem]);
                    break;
                case 2:
                    return $this->redirect(['sap_partner', 'res' => $model->rem]);
                    break;
                case 3:
                    return $this->redirect(['sap_connobj_ind', 'res' => $model->rem]);
                    break;
                case 4:
                    return $this->redirect(['sap_connobj', 'res' => $model->rem]);
                    break;
                case 5:
                    return $this->redirect(['sap_premise_ind', 'res' => $model->rem]);
                    break;
                case 6:
                    return $this->redirect(['sap_premise', 'res' => $model->rem]);
                    break;
                case 7:
                    return $this->redirect(['sap_account', 'res' => $model->rem]);
                    break;
                case 8:
                    return $this->redirect(['sap_account_ind', 'res' => $model->rem]);
                    break;
                case 9:
                    return $this->redirect(['sap_devloc', 'res' => $model->rem]);
                    break;
                case 10:
                    return $this->redirect(['sap_devloc_ind', 'res' => $model->rem]);
                    break;
                case 11:
                    return $this->redirect(['sap_device_ind', 'res' => $model->rem]);
                    break;
                case 12:
                    return $this->redirect(['sap_device', 'res' => $model->rem]);
                    break;
                case 13:
                    return $this->redirect(['sap_seal_ind', 'res' => $model->rem]);
                    break;
                case 14:
                    return $this->redirect(['sap_seals', 'res' => $model->rem]);
                    break;
//                case 15:
//                    return $this->redirect(['sap_seals2', 'res' => $model->rem]);
//                    break;
                case 16:
                    return $this->redirect(['sap_instln_ind', 'res' => $model->rem]);
                    break;
                case 17:
                    return $this->redirect(['sap_instln', 'res' => $model->rem]);
                    break;
                case 18:
                    return $this->redirect(['sap_facts', 'res' => $model->rem]);
                    break;
                case 19:
                    return $this->redirect(['sap_facts_ind', 'res' => $model->rem]);
                    break;
                case 20:
                    return $this->redirect(['sap_inst_mgmt_ind', 'res' => $model->rem]);
                    break;
                case 21:
                    return $this->redirect(['sap_move_in_ind', 'res' => $model->rem]);
                    break;
                case 22:
                    return $this->redirect(['sap_discdoc_ind', 'res' => $model->rem]);
                    break;
                case 23:
                    return $this->redirect(['sap_discorder_ind', 'res' => $model->rem]);
                    break;
                case 24:
                    return $this->redirect(['sap_discenter_ind', 'res' => $model->rem]);
                    break;
                case 25:
                    return $this->redirect(['sap_zlines', 'res' => $model->rem]);
                    break;
                case 26:
                    return $this->redirect(['sap_ztransf', 'res' => $model->rem]);
                    break;
                case 27:
                    return $this->redirect(['sap_inst_mgmt', 'res' => $model->rem]);
                    break;
                case 28:
                    return $this->redirect(['sap_devgrp', 'res' => $model->rem]);
                    break;
                case 29:
                    return $this->redirect(['sap_move_in', 'res' => $model->rem]);
                    break;
                case 31:
                    return $this->redirect(['sap_zsign_ca', 'res' => $model->rem]);
                    break;
                case 32:
                    return $this->redirect(['sap_zpay_ca', 'res' => $model->rem]);
                    break;
                case 33:
                    return $this->redirect(['sap_instlncha', 'res' => $model->rem]);
                    break;
                case 34:
                    return $this->redirect(['sap_document', 'res' => $model->rem]);
                    break;
                case 35:
                    return $this->redirect(['sap_discdoc', 'res' => $model->rem]);
                    break;
                case 36:
                    return $this->redirect(['sap_discorder', 'res' => $model->rem]);
                    break;
                case 37:
                    return $this->redirect(['sap_discenter', 'res' => $model->rem]);
                    break;
                case 30:
                    return $this->redirect(['all_sapfile', 'res' => $model->rem]);
                    break;
                case 40:
                    return $this->redirect(['sap_document_post', 'res' => $model->rem]);
                    break;
            }
        } else {

            return $this->render('export_sap', [
                'model' => $model,
            ]);
        }
    }

    //формирование файлов индентификации данных ЦЕК в системе САП
    public function actionIdfile()

    {
        $model = new export_sap();

        if ($model->load(Yii::$app->request->post())) {
            switch ($model->id_oper) {
                case 1:
                    return $this->redirect(['idfile_partner_ind', 'res' => $model->rem]);
                    break;
                case 2:
                    return $this->redirect(['idfile_partner', 'res' => $model->rem]);
                    break;
                case 3:
                    return $this->redirect(['idfile_premise_ind', 'res' => $model->rem]);
                    break;
                case 4:
                    return $this->redirect(['idfile_premise', 'res' => $model->rem]);
                    break;
                case 5:
                    return $this->redirect(['idfile_account_ind', 'res' => $model->rem]);
                    break;
                case 6:
                    return $this->redirect(['idfile_account', 'res' => $model->rem]);
                    break;
                case 7:
                    return $this->redirect(['idfile_devloc_ind', 'res' => $model->rem]);
                    break;
                case 8:
                    return $this->redirect(['idfile_devloc', 'res' => $model->rem]);
                    break;
                case 9:
                    return $this->redirect(['idfile_device_ind', 'res' => $model->rem]);
                    break;
                case 10:
                    return $this->redirect(['idfile_device', 'res' => $model->rem]);
                    break;
                case 11:
                    return $this->redirect(['idfile_seals_ind', 'res' => $model->rem]);
                    break;
                case 12:
                    return $this->redirect(['idfile_seals', 'res' => $model->rem]);
                    break;
                case 13:
                    return $this->redirect(['idfile_seals2', 'res' => $model->rem]);
                    break;
                case 14:
                    return $this->redirect(['idfile_instln_ind', 'res' => $model->rem]);
                    break;
                case 15:
                    return $this->redirect(['idfile_facts_ind', 'res' => $model->rem]);
                    break;
                case 16:
                    return $this->redirect(['idfile_move_in_ind', 'res' => $model->rem]);
                    break;
                case 17:
                    return $this->redirect(['all_idfile', 'res' => $model->rem]);
                    break;
                case 20:
                    return $this->redirect(['idfile_connobj', 'res' => $model->rem]);
                    break;
                case 21:
                    return $this->redirect(['idfile_instln', 'res' => $model->rem]);
                    break;
                case 22:
                    return $this->redirect(['idfile_facts', 'res' => $model->rem]);
                    break;
            }
        } else {

            return $this->render('idfile', [
                'model' => $model,
            ]);
        }
    }

    // Форматирование файла partner для САП для юридических партнеров
    public function actionSap_partner($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        ini_set('upload_max_filesize', '0');
        ini_set('post_max_size', '1000M');
        $rem = '0' . $res;  // Код РЭС

        $sql = "select distinct a.id,a.name,a.code_okpo,b.okpo_num,b.tax_num,'2' AS BU_TYPE,b.FLAG_JUR,
case when substr(trim(a.name),1,4)='ФОП ' or substr(trim(a.name),1,3)='ФО ' or position('Фізична особа' in a.name)>0
or position('Фізична  особа' in a.name)>0 or position('Приватний підприємець' in a.name)>0  
or position('Приватна особа' in a.name)>0 or position('ФІЗИЧНА ОСОБА' in a.name)>0 or position('ФІЗИЧНА  ОСОБА' in a.name)>0
or position('ПРИВАТНА ОСОБА' in a.name)>0 or position('ПРИВАТНИЙ ПІДПРИЄМЕЦЬ' in a.name)>0  
or position('ПРИВАТНИЙ НОТАРІУС' in a.name)>0 or position('Приватний нотаріус' in a.name)>0  
then '03' else '02' end as BU_GROUP,
case when length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 or (substr(trim(a.name),1,4)='ФОП '
 or substr(trim(a.name),1,3)='ФО ' or position('Фізична особа' in a.name)>0
or position('Фізична  особа' in a.name)>0 or position('Приватний підприємець' in a.name)>0  
or position('Приватна особа' in a.name)>0 or position('ФІЗИЧНА ОСОБА' in a.name)>0 
or position('ПРИВАТНА ОСОБА' in a.name)>0 or position('ПРИВАТНИЙ ПІДПРИЄМЕЦЬ' in a.name)>0 
or position('ФІЗИЧНА  ОСОБА' in a.name)>0
or position('ПРИВАТНИЙ НОТАРІУС' in a.name)>0 or position('Приватний нотаріус' in a.name)>0)  
then '0003' else '0002' end as BPKIND,
'MKK' as ROLE1,
case when coalesce(a.id_state,0) in (80,49) then 'ZLIQ' else '' end  as ROLE2,
'00010101' as VALID_FROM_1,
'I' as CHIND_1,
case when coalesce(a.id_state,0) in (80,49) then substring(replace(a.dt_close::varchar, '-',''),1,8) else '' end  as VALID_FROM_2,
case when coalesce(a.id_state,0) in (80,49) then 'I' else '' end  as CHIND_2,
'1' as FKUA_RSD,
'3' as FKUA_RIS,
case when coalesce(b.FLAG_JUR,0)= 1 then 

	a.code_okpo
        
else 
	case when length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 and trim(coalesce (a.code_okpo, b.okpo_num))<>'0000000000' then trim(coalesce (a.code_okpo, b.okpo_num))
	 when length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 and trim(coalesce (a.code_okpo, b.okpo_num))='0000000000' then a.code_okpo else '' end
end  as BU_SORT1,
'' as BU_SORT2,
'0006' as SOURCE,
'LEG' as AUGRP,
substr(trim(a.name),1,40) as name_org1,
substr(trim(a.name),41,40) as name_org2,
substr(trim(a.name),81,40) as name_org3,
substr(trim(a.name),121,40) as name_org4,
case when coalesce(b.FLAG_JUR,0)= 1 then  
     case 
     when upper(trim(a.name)) LIKE  'ФЕРМЕР%' AND upper(trim(a.name)) LIKE '%ГОСП%' then '02' 
     when (upper(trim(a.name)) LIKE  'ПРИВАТ%' OR  upper(trim(a.name)) LIKE  '%ПРИВАТ%') AND upper(trim(a.name)) LIKE '%ПІДПР%' then '03' 
     when upper(trim(a.name)) LIKE 'КОЛЕКТИВ%' AND upper(trim(a.name)) LIKE '%ПІДПР%' then '04' 
     when upper(trim(a.name)) LIKE 'ДЕРЖ%' AND upper(trim(a.name)) LIKE '%ПІДПР%' then '05' 
     when (upper(trim(a.name)) LIKE  'КОМУНАЛЬНЕ%' AND upper(trim(a.name)) LIKE '%ПІДПР%') then '07' 
     when ((upper(trim(a.name)) LIKE 'ДОЧІРНЄ%' OR upper(trim(a.name)) LIKE 'ДОЧІРНЕ%') AND upper(trim(a.name)) LIKE '%ПІДПР%') then '08' 
     when upper(trim(a.name)) LIKE  'РЕЛІГ%' or  upper(trim(a.name)) LIKE '%РЕЛІГ%' then '10' 
     when upper(trim(a.name)) LIKE  'ПІДПР%' AND  upper(trim(a.name)) LIKE '%СПОЖИВ%' AND  upper(trim(a.name)) LIKE '%КООП%' then '11' 
     when (upper(trim(a.name)) LIKE  'АКЦІОНЕРНЕ ТОВАРИСТВО%' or ((upper(trim(a.name)) LIKE  'ПУБЛІЧНЕ%' OR upper(trim(a.name)) LIKE  'ПРИВАТНЕ%') and  upper(trim(a.name)) LIKE  '%АКЦІОНЕРНЕ%' and upper(trim(a.name)) LIKE  '%ТОВАРИСТВО%')) then '17' 
     when upper(trim(a.name)) LIKE 'ВІДКРИТЕ АКЦІОНЕРНЕ ТОВАРИСТВО%' then '18' 
     when upper(trim(a.name)) LIKE 'ЗАКРИТЕ%' AND upper(trim(a.name)) LIKE  '%АКЦІОНЕР%' AND  upper(trim(a.name)) LIKE '%ТОВ%' then '19' 
     when (upper(trim(a.name)) LIKE  'ТОВ%' AND upper(trim(a.name)) LIKE '%ОБМЕЖ%' AND upper(trim(a.name))  LIKE '%ВІДП%') OR upper(trim(a.name)) LIKE  'ТОВ %' then '21' 
     when upper(trim(a.name)) LIKE  'ТОВ%' AND upper(trim(a.name)) LIKE '%ДОД%' AND upper(trim(a.name))  LIKE '%ВІДП%' then '22'
     when upper(trim(a.name)) LIKE  'ПОВНЕ%' AND upper(trim(a.name)) LIKE '%ТОВ%' then '23' 
     when upper(trim(a.name)) LIKE  'КОМАНДИТНЕ%' AND upper(trim(a.name)) LIKE '%ТОВ%' then '24' 
     when upper(trim(a.name)) like 'АВТОКООПЕРАТИВ%'  OR upper(trim(a.name)) like '%АВТОКООПЕРАТИВ%' OR (upper(trim(a.name))  like 'АВТО%' AND upper(trim(a.name))  like '%КООПЕРАТИВ%') then '25' 
     when upper(trim(a.name)) LIKE  'ВИРОБНИЧ%' AND upper(trim(a.name)) LIKE '%КООП%' then '26' 
     when upper(trim(a.name)) LIKE  'ОБСЛУГОВ%' AND upper(trim(a.name)) LIKE '%КООП%' then '27'   
     WHEN (upper(trim(a.name)) like 'ДЕРЖАВНИЙ%' AND upper(trim(a.name)) like '%ЗАКЛАД%') OR (upper(trim(a.name))  like 'ДЕРЖАВНА%' AND upper(trim(a.name)) like '%УСТАНОВА%') OR (upper(trim(a.name))  like 'ДЕРЖАВНА%' AND upper(trim(a.name)) like '%ОРГАНІЗАЦІЯ%') THEN '35'
     WHEN (upper(trim(a.name)) like 'КОМУНАЛЬНИЙ%' AND upper(trim(a.name)) like '%ЗАКЛАД%') OR (upper(trim(a.name))  like 'КОМУНАЛЬНА%' AND upper(trim(a.name)) like '%УСТАНОВА%') OR (upper(trim(a.name))  like 'КОМУНАЛЬНА%' AND upper(trim(a.name)) like '%ОРГАНІЗАЦІЯ%') THEN '36'
     WHEN (upper(trim(a.name)) like 'ПРИВАТНИЙ%' AND upper(trim(a.name)) like '%ЗАКЛАД%') OR (upper(trim(a.name))  like 'ПРИВАТНА%' AND upper(trim(a.name)) like '%УСТАНОВА%') OR (upper(trim(a.name))  like 'ПРИВАТНА%' AND upper(trim(a.name)) like '%ОРГАНІЗАЦІЯ%') THEN '37'
     when upper(trim(a.name)) LIKE  'ГРОМАДСЬКА%' AND upper(trim(a.name)) LIKE '%ОРГ%' then '38' 
     when (upper(trim(a.name)) LIKE  'КОРПОРАЦІЯ%' OR upper(trim(a.name)) LIKE 'КООРПОРАЦІЯ%') then '43' 
     when upper(trim(a.name)) LIKE  'КОНЦЕРН%' AND upper(trim(a.name)) LIKE '%КОНЦЕРН%' then '45' 
     else '01'
     end
else '' 
end as LEGAL_ENTY,
case when coalesce(a.id_state,0) in (80,49)  then substring(replace(a.dt_close::varchar, '-',''),1,8) else '' end as LIQUID_DAT,
''::char(4) as ZFILCODE,
'' as ZFILHEAD,
case when coalesce(b.FLAG_JUR,0)= 0 then  'X' else '' end as ZPROCIND,
'' as ZCODEFORMOWN,
'' as ZCODESPODU,
'' as ZCODEBANKROOT,
'' as ZCODELICENSE,
case when length(trim(a.name))> 160 then trim(a.name) else '' end as ZNAMEALL,
replace(replace(replace(trim(a.short_name),'   ',' '),'  ',' '),'''','’') as ZZ_NAMESHORT,
b.doc_ground as ZZ_DOCUMENT,
'' as ADEXT_ADDR,
'I' as CHIND_ADDR,
'' as POST_CODE2,
'' as PO_BOX,
-- UPPER(am.building) as HOUSE_NUM1,
f_get_number_house(am.building,am.building_add) as HOUSE_NUM1,
UPPER(am.office) as HOUSE_NUM2,
'UA' as COUNTRY,
case when substring(trim(b.phone),1,30) <> '' then 'I' else '' end as CHIND_TEL,
case when position(',' in trim(b.phone))>0 then get_phone(b.phone) else
case when length(regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g')) =10 then
		regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g')
		 else '' end end as TEL_NUMBER,
'' as CHIND_FAX,
'' as FAX_NUMBER,
case when trim(a.email) <>'' then 'I' else '' end as CHIND_SMTP,
trim(a.email) as SMTP_ADDR,

case when length(regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g')) =10 then
	case when regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '039%'
	or	
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '050%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '063%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '066%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '067%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '068%'
        or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '073%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '091%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '092%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '093%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '094%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '095%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '096%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '097%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '098%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '099%'
	then '3'
	else '1' end

	else '' end as TEL_MOBILE,
	'CEKPOST' as ADR_KIND,
	'X' as XDFADU,
	case when (length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 and trim(coalesce (a.code_okpo, b.okpo_num))<>'0000000000')
	   then trim(coalesce (a.code_okpo, b.okpo_num)) 
	   when length(trim(coalesce (a.code_okpo, b.okpo_num)))=8 then trim(coalesce (a.code_okpo, b.okpo_num))
	   end as IDNUMBER,
	   case when coalesce(b.FLAG_JUR,0)= 1 and length(trim(coalesce (a.code_okpo, b.okpo_num)))=8 then 'EDRPOU'
	    when (coalesce(b.FLAG_JUR,0)= 0 and length(trim(coalesce (a.code_okpo, b.okpo_num)))=10) then  'FS0001' 
	    when coalesce(b.FLAG_JUR,0)= 1 and length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 then  'FS0001'
	    else '' end as ID_TYPE,
	
kt.shot_name||' '||t.name as town,ads.town as town_sap,am.post_index,b2.post_index as post_index_sap,ks.shot_name||' '||s.name as street,ads.street as street_sap,
-- UPPER(am.building) as house,
 f_get_number_house(am.building,am.building_add) as house,
UPPER(am.office) as flat,
b.phone,get_email(b.e_mail) as e_mail,ads.reg,ads.numobl,
u.town as town_wo,u.street as street_wo,u.ind as ind_wo,u.reg as reg_wo,u.id_client as id_wo
 from clm_client_tbl a
        left join clm_statecl_tbl b on
        a.id=b.id_client
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town
        --LEFT JOIN addr_sap ads on ads.town=kt.shot_name||' '||t.name and ads.type_street||' '||get_street(ads.street)=ks.shot_name||' '||s.name
       --LEFT JOIN addr_sap ads on trim(ads.town)=trim(kt.shot_name)||' '||trim(t.name) and trim(ads.short_street)=trim(s.name) 
       LEFT JOIN addr_sap ads on trim(ads.town)=trim(kt.shot_name)||' '||trim(t.name) 
       
       and (trim(ads.street)=get_typestreet1(trim(ks.shot_name))||' '||trim(s.name) or 
        case when ks.shot_name='шосе' and trim(s.name)='Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)||' шосе'
             when ks.shot_name='шосе' and trim(s.name)<>'Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)
         end)
       
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end 
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Грузьке' and $res='05' then trim(ads.reg)='DNP' else 1=1 end 
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Червоне' and $res='05' then trim(ads.reg)='DNP' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='07' then trim(ads.rnobl)='Новомосковський район' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Степове' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Камянка' and $res='06' then trim(ads.reg)='DNP' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Високе' and $res='01' then trim(ads.reg)='VIN' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Миколаївка' and $res='01' then trim(ads.reg)='DNP' else 1=1 end      
       -- LEFT JOIN post_index_sap b2 on ads.numtown=b2.numtown and b2.post_index::integer=am.post_index
        
       LEFT JOIN (select distinct numtown,min(post_index) as post_index from (
       select distinct trim(numtown) as numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) 
       b20 group by 1) b2
         on trim(ads.numtown)=trim(b2.numtown) --and b2.post_index::integer=am.post_index
       LEFT JOIN  sap_wo_adr u on ((coalesce(trim(ks.shot_name||' '||trim(s.name)),'')=coalesce(trim(trim(chr(13) from trim(chr(10) from u.street))),'')
        and coalesce(trim(kt.shot_name||' '||trim(t.name)),'') = coalesce(trim(trim(chr(13) from trim(chr(10) from u.town))),'') and u.connobj is null) or (a.id=u.id_client)
         and u.res=$rem)
        WHERE 
        ((a.code>999 or  a.code=900) AND coalesce(a.idk_work,0)<>0 
	     and  a.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')) or  a.code in('10001306')
	     -- AND a.id=12098
	     -- and u.town is not null
   ";

        $sql_c = "select * from sap_export where objectsap='PARTNER' order by id_object";
        $zsql = 'delete from sap_init';
        $zsql1 = 'delete from sap_but000';
        $zsql2 = 'delete from sap_ekun';
        $zsql3 = 'delete from sap_but020';
        $zsql4 = 'delete from sap_but0id';
        $zsql5 = 'delete from sap_but021';

        if (1 == 1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_dn_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_dn_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_dn_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_dn_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_dn_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_dn_energo->createCommand($zsql5)->execute();
                    break;
                case 2:
                    $data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_zv_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_zv_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_zv_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_zv_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_zv_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_zv_energo->createCommand($zsql5)->execute();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_vg_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_vg_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_vg_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_vg_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_vg_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_vg_energo->createCommand($zsql5)->execute();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_pv_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_pv_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_pv_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_pv_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_pv_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_pv_energo->createCommand($zsql5)->execute();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_krg_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_krg_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_krg_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_krg_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_krg_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_krg_energo->createCommand($zsql5)->execute();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_ap_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_ap_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_ap_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_ap_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_ap_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_ap_energo->createCommand($zsql5)->execute();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_gv_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_gv_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_gv_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_gv_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_gv_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_gv_energo->createCommand($zsql5)->execute();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_in_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_in_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_in_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_in_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_in_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_in_energo->createCommand($zsql5)->execute();
                    break;
            }
            $i = 0;
//            debug($data);
//            return;

            // Заполняем структуры
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_partner($n_struct, $rem, $w);
                }
            }
        }
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $fname = 'PARTNER_04' . '_CK' . $rem . '_' . $fd . '_08' . '_L' . '.txt';
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $i = 0;
//        foreach ($cnt as $v) {
//            $table_struct = 'sap_' . trim($v['dattype']);
//            $i++;
//            $k=$i-1;
//            if($i==1)
//                $sql = "select a.*,'|' as sep1,a1.*,'|' as sep2,
//                        a2.*,'|' as sep3,a3.*,'|' as sep4,a4.*,'|' as sep5 from " . $table_struct.' a ';
//            else{
//                $sql.="join $table_struct a$k on a.old_key=a$k.old_key$k ";
//            }
//        }
//
////        debug($sql);
////        return;
//
//                $struct_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
//
//                foreach ($struct_data as $d) {
//
//                    $s=implode("\t", $d);
//                    //echo($s);
//                    $s=str_replace("~","",$s);
//                    $s=str_replace("|","\n",$s);
//                    fputs($f, ltrim($s," \t"));
////                    fputs($f, "\n");
//                }
        $sql = "select * from sap_init";
        switch ($res) {
            case 1:
                $struct_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                break;
            case 2:
                $struct_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                break;
            case 3:
                $struct_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                break;
            case 4:
                $struct_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                break;
            case 5:
                $struct_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                break;
            case 6:
                $struct_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                break;
            case 7:
                $struct_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                break;
            case 8:
                $struct_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                break;
        }


        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 6) continue;
                if ($i > 1) {
                    $sql = "select * from $table_struct where oldkey='$old_key'";

                    switch ($res) {
                        case 1:
                            $cur_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                            break;
                        case 2:
                            $cur_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                            break;
                        case 3:
                            $cur_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                            break;
                        case 4:
                            $cur_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                            break;
                        case 5:
                            $cur_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                            break;
                        case 6:
                            $cur_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                            break;
                        case 7:
                            $cur_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                            break;
                        case 8:
                            $cur_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                            break;
                    }
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }

                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }


//        fputs($f, "\t&ENDE");
//        fputs($f, "\n");

// Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);
        // проверка адреса  на соответствие его с названием в САП {
        $err = check_adres_partner($fname, 1);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет адреса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка индекса  на соответствие его с названием в САП {
        $err = check_adres_partner($fname, 2);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет индекса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка адреса  на соответствие его с названием в САП   }

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 7;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }
    //формирование файла идентификации
    // Формирование файла partner для САП для юридических лиц
    public function actionIdfile_partner($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);
        $sql = "select 'PARTNER' as OM,oldkey,code,short_name,const.ver from sap_init as i 
        left join clm_client_tbl as c
        on substr(i.oldkey,9)::int=c.id
        join sap_const as const on 1=1";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }


        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }

    //формирование файла идентификации
    // Формирование файла connobj для САП для юридических лиц
    public function actionIdfile_connobj($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);
        $sql = "select 'CONNOBJ' as OM,oldkey,code,short_name,const.ver from sap_co_eha as i 
        left join clm_client_tbl as c
        on substr(i.oldkey,9)::int=c.id
        join sap_const as const on 1=1";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }


    public function actionCheck()
    {

        $r = hash('crc32', '111111111111111111111111111111111111111111111111111111111111111111111111111111111122');
        debug($r);
        $r = hash('crc32', '111111111111111111111111111111111111111111111111111111111111111111111111111111111121');
        debug($r);

    }

    // Формирование файла partner для САП для бытовых
    public function actionSap_partner_ind($res, $par = 0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '0');
        ini_set('upload_max_filesize', '0');
        ini_set('post_max_size', '1000M');
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind')
            $vid = 1;
        else
            $vid = 2;
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));

        $sql = "select * from (
        select a.id,a.activ,case when i.inn is null then 
case when b.tax_number is not null and length(trim(b.tax_number))=10 then 
b.tax_number else null end else null end as tax_number,b.last_name,
                b.name,b.patron_name,b1.town,c.town as town_cek,b2.post_index,c.indx as index_cek,
                case when b1.street is null then 'Неопределено' else b1.street end as street,c.street as street_cek,
               -- upper(c.house) as house,
             case when c.korp is null then upper(c.house) else 
             case when NOT(c.korp ~ '[0-9]+$')  then upper(trim(c.house))||trim(c.korp) 
             else upper(trim(c.house))||'/'||c.korp end end as house,  
             upper(c.korp) as korp,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id_abon=b.id
        left join vw_address c on
        a.id=c.id
        left join addr_sap b1 on
       case when trim(lower(c.street))='шосе кіровоградське' then  trim(lower(c.street))=trim(lower(b1.street)) else trim(lower(c.street))=trim(lower(get_sap_street(b1.street))) end
        and case when trim(lower(get_sap_street(b1.street)))='запорізьке шосе' then  lower(trim(c.type_street))='вул.'
        else case when trim(lower(c.street))='шосе кіровоградське' then 1=1 else coalesce(lower(trim(c.type_street)),'')=coalesce(lower(trim(get_typestreet(b1.street))),'') end end 
        and trim(lower(b1.town))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end ||' '||trim(lower(c.town))))
        and case when trim(lower(b1.town))='с. Степове' then trim(b1.rnobl)='Криворізький район' else 1=1 end
        and case when trim(b1.town)='с. Інгулець' then trim(b1.rnobl)='Криворізький район' else 1=1 end  
         left join (select distinct numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) b2
          on trim(b1.numtown)= trim(b2.numtown) --and b2.post_index=c.indx  
        left join
        (select id,last_name,name,patron_name,tax_number as inn,'ИНН не проходит контрольную сумму'::text as Error  
        from clm_abon_tbl 
        where check_inn(tax_number)=0 and tax_number is not null and tax_number<>'' and length(tax_number)=10) i
        on i.id=b.id       
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region where a.archive='0' 
        and case when $res='05' then (trim(b1.rnobl)='Криворізький район' or trim(b1.rnobl)='Широківський район' or b1.rnobl is null or trim(b1.rnobl)='') else 1=1 end ) x
        -- limit 10
     
        ";

        $sql_c = "select * from sap_export where objectsap='PARTNER_IND' order by id_object";
        //$cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();
//        if(3==4) {
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);
//debug($sql);
//debug($data);
//return;
        $cnt = data_from_server($sql_c, $res, $vid);

        // Удаляем данные в таблицах
        $zsql = 'delete from sap_init';
        exec_on_server($zsql, $res, $vid);

        $zsql = 'delete from sap_but000';
        exec_on_server($zsql, $res, $vid);

        $zsql = 'delete from sap_ekun';
        exec_on_server($zsql, $res, $vid);

        $zsql = 'delete from sap_but020';
        exec_on_server($zsql, $res, $vid);

        $zsql = 'delete from sap_but0id';
        exec_on_server($zsql, $res, $vid);
        $i = 0;
        // Заполняем структуры
        foreach ($data as $w) {
            $i = 0;
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $i++;
                f_partner_ind($n_struct, $rem, $w);
            }
        }
//        return;
//        } // endif 3==4
        // Формируем имя файла и создаем файл
        $fname = date2file_Partner_ind($res, $vid);  // Быстрая функция для записи в файл

        if (1 == 2) {  // Так работала программа раньше - было существенно медленее
            $fd = date('Ymd');
            $fname = 'PARTNER_04' . '_CK' . $rem . '_' . $fd . '_08' . '_R' . '.txt';
            $f = fopen($fname, 'w+');
            $i = 0;
            $sql = "select * from sap_init";
            //$struct_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
            $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
            foreach ($struct_data as $d) {
                $old_key = trim($d['old_key']);
                $d = array_map('trim', $d);
                $s = implode("\t", $d);

                $s = str_replace("~", "", $s);
                $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
                fputs($f, $s);
                fputs($f, "\n");
                $i = 0;
                foreach ($cnt as $v) {
                    $table_struct = 'sap_' . trim($v['dattype']);
                    $i++;
                    if ($i > 1) {
                        $sql = "select * from $table_struct where old_key='$old_key'";
                        //$cur_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
                        $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                        foreach ($cur_data as $d1) {
                            $d1 = array_map('trim', $d1);
                            $s1 = implode("\t", $d1);
                            $s1 = str_replace("~", "", $s1);
                            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                            fputs($f, $s1);
                            fputs($f, "\n");
                        }

                    }
                }
                fputs($f, $old_key . "\t&ENDE");
                fputs($f, "\n");
            }
        }  //  endif  1==2


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);
        // проверка адреса  на соответствие его с названием в САП {
        $err = check_adres_partner($fname, 1);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет адреса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка индекса  на соответствие его с названием в САП {
        $err = check_adres_partner($fname, 2);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет индекса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка адреса  на соответствие его с названием в САП   }

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//        $cnt=6;
//        $err = no_struct($fname,$cnt);
//        if($err<>'') {
//            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
//            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
//        }
        // отсутствие структуры }
        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        //fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл PARTNER_IND сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//            return 1;


//        return $this->render('info', [
//            'model' => $model]);
    }

// Test
    public function actionTest_task()
    {
//       for($i=1;$i<40;$i++)
//       {
        $s=posti('12,6');
        echo $s - 1;
        echo '<br>';
//       }
    }

// Тестовая функция для записи в файл
    public function actionTest_recfile()
    {
        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $fname = 'PARTNER_04_test.txt';
        $f = fopen($fname, 'w+');
        $i = 0;
        $vid = 1;
        $res = 4;
        $sql = "select a.*,b.*,c.*,d.*,e.* from sap_init a  
                    left join sap_ekun b on a.old_key=b.old_key
                    left join sap_but000 c on a.old_key=c.old_key
                    left join sap_but020 d on a.old_key=d.old_key
                    left join sap_but0id e on a.old_key=e.old_key
                ";
        //$struct_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
//        debug($struct_data);
        $sql_c = "select * from sap_export where objectsap='PARTNER_IND' order by id_object";
        $cnt = data_from_server($sql_c, $res, $vid);
// Тест
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
//        debug($struct1);
//         debug($struct2);
//        debug($struct3);
//        debug($struct4);
//        debug($struct5);
//        return;

        foreach ($struct_data as $d) {
            $j = 0;
            $old_key = $d['old_key'];
            foreach ($cnt as $v) {
                $j++;
                // Извлекаем список полей в структуре
                $data_p = extract_fields(${"struct" . $j});
//                $d1 = array_map('trim', $data_p);
                $d1 = array_part($d, $data_p);
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
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
        //формирование файла идентификации
        // Формирование файла partner для САП для бытовых
    }

    public function actionIdfile_partner_ind($res, $par = 0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'PARTNER' as OM,old_key,b.code,(b.last_name||' '||substr(b.name, 1, 1)||'.'||substr(b.patron_name, 1, 1)||'.') as name_tu,const.ver from sap_init as sap
left join vw_address as b on substr(sap.old_key,9)::int=b.id join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        if ($par == 0)
            return $this->render('info', [
                'model' => $model]);
        else
            return 1;

    }

    // Формирование файла пломб(seal) для САП для бытовых потребителей
    public function actionSap_seal_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        // Главный запрос со всеми необходимыми данными
        $sql = "select *,case when nn>1 then trim(scode)||'_'||nn else trim(scode) end as plomb_num_t from (
select *,row_number() over(partition by scat,scode) as nn from (
select distinct a.id_paccnt,a.plomb_num as scode,coalesce(b.id_sap,'8') as place,coalesce(sp.short_name,'СЕЙФ-ПАКЕТ') as scat,a.id_type,a.dt_on,a.id,
                'I' as status,'3' as color,'C010099' as utmas,'C010099' as reper,
                substring(replace(a.dt_on::varchar, '-',''),1,8) as DPURCH,
                substring(replace(a.dt_on::varchar, '-',''),1,8) as dissue,
                substring(replace(a.dt_on::varchar, '-',''),1,8) as dinst,
                w.num_meter as sernr,d.matnr as matnr,const.ver,w.id_type_meter
                from clm_plomb_tbl a
                left join 
               -- (select id_paccnt,num_meter,max(id_type_meter) as id_type_meter,max(work_period) as work_period from clm_meterpoint_tbl group by id_paccnt,num_meter) w
                (select a.* from clm_meterpoint_tbl a
		left join clm_meter_zone_h b on a.id=b.id_meter where b.dt_e is null) w
                on w.id_paccnt=a.id_paccnt
                left join eqi_meter_tbl f on w.id_type_meter=f.id
                left join sap_plomb_place b on
                a.id_place=b.idcek::integer
                left join plomb_type c on
                a.id_type=c.id
                left join (select distinct id as id,sap_meter_id from sap_meter) s on s.id::integer=w.id_type_meter
                left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22 where sap_meter_id<>'') sd on s.sap_meter_id=sd.sap_meter_id
                -- left join sap_equi d on
                inner join sap_equi d on
                trim(w.num_meter)=trim(d.sernr) and upper(trim(d.matnr))=upper(trim(sd.sap_meter_name))
                inner join sap_const const on 1=1
                left join sap_plomb_name sp on sp.id_cek::integer=a.id_type
                left join clm_paccnt_tbl cl on cl.id=a.id_paccnt
                where dt_off is null and length(a.plomb_num) <= 15 
		         and cl.archive=0 
		        -- and w.num_meter='10682627'
		        -- and
                ) g
                ) gg
                ";

        //                join
//                (select min(a.id) as id,w.num_meter as sernr
//                from clm_plomb_tbl a
//                left join
//                (select a.* from clm_meterpoint_tbl a
//		left join clm_meter_zone_h b on a.id=b.id_meter where b.dt_e is null) w
//                on w.id_paccnt=a.id_paccnt
//                left join eqi_meter_tbl f on w.id_type_meter=f.id
//                left join sap_plomb_place b on
//                a.id_place=b.idcek::integer
//                left join plomb_type c on
//                a.id_type=c.id
//                left join (select distinct id as id,sap_meter_id from sap_meter) s on s.id::integer=w.id_type_meter
//                left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22 where sap_meter_id<>'') sd on s.sap_meter_id=sd.sap_meter_id
//                left join sap_equi d on
//                trim(w.num_meter)=trim(d.sernr) and upper(trim(d.matnr))=upper(trim(sd.sap_meter_name))
//                inner join sap_const const on 1=1
//                left join sap_plomb_name sp on sp.id_cek::integer=a.id_type
//                left join clm_paccnt_tbl cl on cl.id=a.id_paccnt
//                where dt_off is null and length(a.plomb_num) <= 15
//		         and cl.archive=0
//		 group by w.num_meter
//		 ) un on un.id=g.id

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;
            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур
        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }
//        else {
//            // Выдаем предупреждение на экран об окончании формирования файла
//            $model = new info();
//            $model->title = 'УВАГА!';
//            $model->info1 = "Erorr.";
//            $model->style1 = "d15";
//            $model->style2 = "info-text";
//            $model->style_title = "d9";
//
//            return $this->render('info', [
//                'model' => $model]);
//        }
    }

    public function actionIdfile_seals_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'SEALS' as OM,oldkey,v.code,(v.last_name||' '||substr(v.name, 1, 1)||'.'||substr(v.patron_name, 1, 1)||'.') as name_tu,const.ver from sap_AUTO as a
                left join clm_plomb_tbl as p 
                on substr(a.oldkey,12)::int=p.id
                left join vw_address as v
                on p.id_paccnt=v.id
                left join sap_const as const
                on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла instln для САП для бытовых потребителей
    public function actionSap_instln_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        $asd = ["01" => 'BC010131',
            "02" => 'BC010231',
            "03" => 'BC010331',
            "04" => 'BC010431',
            "05" => 'BC010531',
            "06" => 'BC010631',
            "07" => 'BC010731',
            "08" => 'BC010831',
        ];
        // Получаем дату ab
        $sql_d = "select (fun_mmgg() - interval '4 month')::date as mmgg_current";
        $data_d = data_from_server($sql_d, $res, $vid);
        $date_ab = $data_d[0]['mmgg_current'];
        // Главный запрос со всеми необходимыми данными
        $sql = "select a.id,'10' as sparte,'02' as spebene,'0002' as anlart,'0001' as ablesartst,
case when length(adr.last_name||' '||adr.name||' '||adr.patron_name)>0 then
adr.last_name||' '||adr.name||' '||adr.patron_name else
adr.code end as zz_nametu,'' as zz_fider,'$date_ab' as ab,'CK_1AL2_01' as tariftyp,
'0001' as aklasse,ff.ableinh as ableinh,b.begru_b as begru,a.eic,b.ver,c.oldkey as vstelle,
case when trim(adr.type_city)='м.' then '70' else '71' end as branche, p.id_sector
from clm_paccnt_tbl a
inner join sap_const b on 1=1
left join sap_evbsd c on a.id=substr(c.oldkey,9)::integer
left join vw_address adr on a.id=adr.id
left join prs_runner_paccnt p on p.id_paccnt=a.id
left join (
select qwe.id,qwe.name,qwe.ed_sch as ableinh from (
select distinct c.id,c.name,abl.ed_sch from prs_runner_sectors c
left join prs_runner_paccnt p on p.id_sector=c.id
left join clm_paccnt_tbl as pa on pa.id=p.id_paccnt
left join ableinh_tbl as abl on abl.id::int=p.id_sector
where pa.archive = '0'
order by c.name
) qwe
) ff
on ff.id=p.id_sector
where a.archive='0' -- and a.id in(select id_paccnt from clm_meterpoint_tbl)
-- limit 10
                ";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур
        $i = 0;

        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        if (1 == 2) {  // отключено
            // задвоения по oldkey  {
            $err = double_oldkey($fname);
            // Запись в таблицу ошибок
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
            // задвоения по oldkey  }

            // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
            $err = double_struct($fname);
            if ($err <> '') {

                $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
                exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
            }
            // задвоения структур }


            // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
            $cnt = 2;
            $err = no_struct($fname, $cnt);
            if ($err <> '') {
                $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
                exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
            }
            // отсутствие структуры }
            // нет объекта высшего уровня {
            $sql = "SELECT * from sap_refer where upload='$filename'";
            $data_u = data_from_server($sql, $res, $vid);
            $refer = $data_u[0]['refer'];
            $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
            if (!empty($data_u[0]['upload'])) {
                $err = no_refer($fname, $data_u);
                if (count($err)) {
                    foreach ($err as $v) {
                        $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                        exec_on_server($z, (int)$rem, $vid);
                    }
                }
            }
            // нет объекта высшего уровня }

            // пустая ссылка {
            $msg = 'Пустая ссылка';
            $err = empty_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }

            }
            // пустая ссылка }
        }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        fclose($f);
//
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//
//        return $this->render('info', [
//            'model' => $model]);
    }

    // Формирование файла монтажей INST_MGMT (юридические лица)
    public function actionSap_inst_mgmt($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
//   Дальше идет плагиат - взято из выгрузки Чернигова - НО с нашими особенностями
        $sql_p = " select (max(mmgg) + interval '1 month')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $period = $data_p[0]['mmgg'];  // Получаем текущий отчетный период
        $period = str_replace('-', '', $period);

        $sql = "select distinct 'INST_MGMT' as name, c.id,c.code, eq.name_eqp,m.code_eqp as id_eq,
     get_tu(m.code_eqp) as id_tu,
    '04_C'||'$rem'||'P_'||m.code_eqp as oldkey,const.ver,c.short_name
     from eqm_tree_tbl as tr 
    join eqm_eqp_tree_tbl as ttr on (tr.id = ttr.id_tree) 
    join eqm_equipment_tbl as eq on (ttr.code_eqp = eq.id) 
    join eqm_meter_tbl as m on (m.code_eqp = eq.id) 
    left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
    left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
    left join clm_statecl_h as sc on (c.id = sc.id_client) 
    left join eqm_equipment_h as hm on (hm.id = eq.id) 
    left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
    inner join sap_const const on 1=1
    where hm.dt_b = (select dt_b from eqm_equipment_h where id = eq.id and num_eqp = eq.num_eqp and dt_e is null order by dt_b desc limit 1 ) 
    and c.book=-1 and c.idk_work not in (0) 
    and coalesce(c.id_state,0) not in (50,99,49)
    and sc.mmgg_b = (select max(mmgg_b) from clm_statecl_h as sc2 where sc2.id_client = sc.id_client and sc2.mmgg_b <= date_trunc('month', '$period'::date ) )  
    and sc.id_section not in (205,206,207,208,209,218) 
    and coalesce (use.id_client, tr.id_client) <> syi_resid_fun()
    and coalesce (use.id_client, tr.id_client)<>999999999  -- and c.id=10330and (c.code>999 or c.code=900)
	        and  c.code not in(20000556,20000565,20000753,
	       20555555,20888888,20999999,30999999,40999999,41000000,42000000,43000000,
	       10999999,11000000,19999369,50999999,1000000,1000001) 
        order by 5";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
//        Формируем имя файла выгрузки
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');
        $fname1 = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $ff = fopen($fname1, 'w+');

        $j = 0;
        foreach ($data as $v) {

            $j = 0;
            foreach ($data as $v) {
                $j++;

                $id_eq = $v['id_eq'];
                if (($id_eq == 120744 || $id_eq == 120748) && $res = 4) continue;
                $j++;
//            debug( $id_eq);
//            return;
                $id = $v['id_tu'];
                $oldkey = $v['oldkey'];
                $code = $v['code'];
                $short_name = $v['short_name'];
                $sql_f = "select di_zw($id_eq , '$period')";
                $data_f = data_from_server($sql_f, $res, $vid);
                $sql_f = "select a.*,b.zwgruppe,f_exact(a.pokaz,b.zwgruppe,a.tarifart) as pokaz_true from di_zw_struc a 
                        left join sap_egerh b on substr(b.oldkey,9)::char(10)=$id_eq::char(10)     
                        order by a.knde,a.sort";
                $data_f = data_from_server($sql_f, $res, $vid);
//            $devloc = '04_C04P_' . strtoupper(hash('crc32', $id));
//            $devloc = '04_C04P_' . $id;
                $sql_1 = "select distinct
                -- '04_C'||'$rem'||'P_'||m.code_eqp::varchar  as oldkey,
                 p.oldkey as oldkey,
                '04_C04P_' || p.oldkey as devloc_old,
                devloc.oldkey as devloc,
                'DI_INT' as struc,'$period' as eadat,
                 '04_C'||'$rem'||'P_01_'||get_tu(eq.id)::varchar as anlage,
                '01' as ACTION
                from eqm_meter_tbl as m
                join eqm_equipment_tbl as eq on (m.code_eqp = eq.id) 
                left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
                left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join 
                eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = mp.id_point)
                join sap_evbsd p on area.id_area=right(p.oldkey,length(trim(area.id_area::text)))::int 
                and case when p.haus ='' then 0 else substr(p.haus,9)::integer end  in (select a.id_tu from 
		        sap_premise_dop a where a.id_eq=right(p.oldkey,length(trim(area.id_area::text)))::int)
		        join sap_egpld devloc on trim(devloc.vstelle)=trim(p.oldkey) and trim(devloc.haus)=trim(p.haus)
                where m.code_eqp= $id_eq
                limit 1  ";
                $data_1 = data_from_server($sql_1, $res, $vid);
                // Запись в файл структуры DI_INT

                $i = 0;
                foreach ($data_1 as $v1) {
                    $i++;
                    $oldkey = '04_C' . $rem . 'P_01_' . $id_eq . '_' . $i;
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        $v1['struc'] . "\t" .
                        $v1['devloc'] . "\t" .
                        $v1['anlage'] . "\t" .
                        $v1['eadat'] . "\t" .
                        $v1['action'] . "\n"));

                    fwrite($ff, iconv("utf-8", "windows-1251", 'INST_MGMT' . "\t" .
                        $oldkey . "\t" .
                        $code . "\t" .
                        $short_name . "\n"));

                    $c = 0;
                    $c1 = '';
                    // Запись в файл структуры DI_ZW
                    foreach ($data_f as $v2) {
                        $c = $c + 1;
                        $c1 = '00' . "$c";
                        fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                            'DI_ZW' . "\t" . $c1 . "\t" .
                            $v2['kondigre'] . "\t" .
//                        $v2['zwstandce'] . "\t" .
                            $v2['pokaz_true'] . "\t" .
                            $v2['zwnabr'] . "\t" .
                            $v2['tarifart'] . "\t" .
                            $v2['perverbr'] . "\t" .
                            '04_C' . $rem . 'P_' . $v2['equnre'] . "\t" .
                            $v2['anzdaysofperiod'] . "\t" .
                            $v2['pruefkla'] . "\n"));
                    }

                    $sql_2 = "select distinct 
                '04_C'||'$rem'||'P_'||m.code_eqp::varchar  as oldkey,
                'DI_GER' as struc,
                case when grp.code_t_new is null then 
                    '04_C'||'$rem'||'P_'||m.code_eqp::text else  '04_C'||'$rem'||'P_'||extract_sn(cyrillic_transliterate(grp.code_t_new::text)) end as EQUNRNEU,
                '' as WANDNR,
                '' as WANDNRE
                from eqm_tree_tbl as tr 
                join eqm_eqp_tree_tbl as ttr on (tr.id = ttr.id_tree) 
                join eqm_equipment_tbl as eq on (ttr.code_eqp = eq.id) 
                join eqm_meter_tbl as m on (m.code_eqp = eq.id) 
                left join eqd_meter_energy_tbl as eqd on eqd.code_eqp = m.code_eqp
                left join eqm_equipment_h as hm on (hm.id = eq.id) 
                left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
                left join eqm_point_tbl as pp on (pp.code_eqp = mp.id_point ) 
                left join ( select eq.id as id_comp,CASE WHEN eq2.type_eqp = 1 THEN eq2.id WHEN eq3.type_eqp = 1 THEN eq3.id END as id_meter, c.date_check, tt3.code_eqp_e as id_area, 
                ic.amperage_nom, ic.conversion , ic.type as tt_type,ic.accuracy, CASE WHEN coalesce(ic.amperage2_nom,0)=0 THEN 0 ELSE ic.amperage_nom/ic.amperage2_nom END as koef_i, eq.num_eqp, eq.is_owner --,
                   from eqm_compensator_i_tbl as c 
                        join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
                        join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
                        left join eqm_eqp_tree_tbl as tt3 on (tt3.code_eqp=c.code_eqp ) 
                        left join eqm_eqp_tree_tbl as tt on (tt.code_eqp_e=c.code_eqp ) 
                        left join eqm_eqp_tree_tbl as tt2 on (tt2.code_eqp_e=tt.code_eqp ) 
                        left join eqm_equipment_tbl as eq2 on (eq2.id =tt.code_eqp ) 
                        left join eqm_equipment_tbl as eq3 on (eq3.id =tt2.code_eqp )  
                        ) as sti on (sti.id_meter = eq.id) 
                left join group_trans1 as grp on grp.id_meter=m.code_eqp
                where m.code_eqp= $id_eq and sti.id_comp is not null and grp.code_t_new is not null
                -- order by grp.ord 
                ";
                    $data_2 = data_from_server($sql_2, $res, $vid);
                    // Запись в файл структуры DI_GER
                    foreach ($data_2 as $v2) {
                        fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                            $v2['struc'] . "\t" .
                            $v2['equnrneu'] . "\n"));
                    }
                    $sql_3 = "select distinct 
                    '04_C'||'$rem'||'P_'||m.code_eqp::varchar  as oldkey,
                    'DI_GER' as struc,
                    '04_C'||'$rem'||'P_'||m.code_eqp::text  as EQUNRNEU,
                    '04_C'||'$rem'||'P_'||extract_sn(cyrillic_transliterate(grp.code_t_new::text)) as met_id,
                    '' as WANDNR,
                    '' as WANDNRE
                    from eqm_tree_tbl as tr 
                    join eqm_eqp_tree_tbl as ttr on (tr.id = ttr.id_tree) 
                    join eqm_equipment_tbl as eq on (ttr.code_eqp = eq.id) 
                    join eqm_meter_tbl as m on (m.code_eqp = eq.id) 
                    left join eqd_meter_energy_tbl as eqd on eqd.code_eqp = m.code_eqp
                    left join eqm_equipment_h as hm on (hm.id = eq.id) 
                    left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
                    left join eqm_point_tbl as pp on (pp.code_eqp = mp.id_point ) 
                    left join ( select eq.id as id_comp,CASE WHEN eq2.type_eqp = 1 THEN eq2.id WHEN eq3.type_eqp = 1 THEN eq3.id END as id_meter, c.date_check, tt3.code_eqp_e as id_area, 
                    ic.amperage_nom, ic.conversion , ic.type as tt_type,ic.accuracy, CASE WHEN coalesce(ic.amperage2_nom,0)=0 THEN 0 ELSE ic.amperage_nom/ic.amperage2_nom END as koef_i, eq.num_eqp, eq.is_owner --,
                       from eqm_compensator_i_tbl as c 
                            join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
                            join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
                            left join eqm_eqp_tree_tbl as tt3 on (tt3.code_eqp=c.code_eqp ) 
                            left join eqm_eqp_tree_tbl as tt on (tt.code_eqp_e=c.code_eqp ) 
                            left join eqm_eqp_tree_tbl as tt2 on (tt2.code_eqp_e=tt.code_eqp ) 
                            left join eqm_equipment_tbl as eq2 on (eq2.id =tt.code_eqp ) 
                            left join eqm_equipment_tbl as eq3 on (eq3.id =tt2.code_eqp )  
                            ) as sti on (sti.id_meter = eq.id) 
                    left join group_trans1 as grp on grp.id_meter=m.code_eqp
                    where m.code_eqp=$id_eq limit 1";
                    $data_3 = data_from_server($sql_3, $res, $vid);
                    // Запись в файл структуры DI_GER
                    $end = '&ENDE';
                    foreach ($data_3 as $v3) {
                        fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                            $v3['struc'] . "\t" .
                            $v3['equnrneu'] . "\t" .
                            '' . "\t" .
                            $v3['met_id'] . "\n"));

                        fwrite($f, $oldkey . "\t" .
                            $end . "\n");
                    }
                }
            }

            // Проверка файла выгрузки
            $method = __FUNCTION__;
            if (substr($method, -4) == '_ind') {
                $vid = 1;
                $_suffix = '_R';
            } else {
                $vid = 2;
                $_suffix = '_L';
            }
            $filename = get_routine($method); // Получаем название подпрограммы для названия файла
            // Удаляем предыдущую информацию
            $res = (int)$rem;
            $sql_err = "delete from sap_err where upload='$filename' and res=$res";
            exec_on_server($sql_err, (int)$rem, $vid);

            // задвоения по oldkey  {
            $err = double_oldkey($fname);
            // Запись в таблицу ошибок
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
            // задвоения по oldkey  }

            // нет объекта высшего уровня {
            $sql = "SELECT * from sap_refer where upload='$filename'";
            $data_u = data_from_server($sql, $res, $vid);
            $refer = $data_u[0]['refer'];
            $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
            if (!empty($data_u[0]['upload'])) {
                $err = no_refer($fname, $data_u);
                if (count($err)) {
                    foreach ($err as $v) {
//                    debug($v);
                        $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                        exec_on_server($z, (int)$rem, $vid);
                    }
                }
            }
            // нет объекта высшего уровня }

            // пустая ссылка {
            $msg = 'Пустая ссылка';
            $err = empty_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }

            }
            // пустая ссылка }
            //kol struckt{
            $col = count_str($fname);
            //kol struckt}
            fclose($f);


            $sql_err = "select * from sap_err where upload = '$filename'";


            $sql_ab = data_from_server($sql_err, $res, $vid);

            if (empty($sql_ab)) {

                $model = new info();
                $model->title = 'УВАГА!';
                $model->info1 = "Файл сформовано." . $col;
                $model->style1 = "d15";
                $model->style2 = "info-text";
                $model->style_title = "d9";

                return $this->render('info', [
                    'model' => $model]);
            } else {
                return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
            }
        }
    }

    // Формирование файла остатков по бухгалтерии DOCUMENT (юридические лица)
    public function actionSap_document($res)
    {
        $helper=0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method=__FUNCTION__;
        if(substr($method,-4)=='_ind') {
            $vid = 1;
            $_suffix = '_R';
        }
        else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        $sql_p=" select (max(mmgg) + interval '1 month' -  interval '1 day')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $date_p = $data_p[0]['mmgg'];  // Получаем дату проводки
        $date_p = str_replace('-','',$date_p);

//        Формируем данные по розподілу
        $sql_old="select c.kofiz_sd as kofiz, gpart||'_'||date1||'_'||num as oldkey,c2.*
 --(replace(c2.date,'.','-')::date+interval '1 day')::date as faedn
 from (
select replace(date,'.','_') as date1,row_number() over(partition by date,schet) as num,c1.* from (
select '04_C'||'$rem'||'P_'||b.id as gpart,split_part(a.data_doc,' ',1) as date,split_part(a.dog,' ',1) as schet,a.*,const.ver,const.begru
     from balances as a 
       inner join sap_const const on 1=1
      left join clm_client_tbl b on b.code=split_part(a.dog,' ',1)::int 
     where dog like '%розподіл%' and saldo is not null and a.saldo<>''
     and substr(dog,1,2)='$rem'
) c1
) c2
left join sap_vkp c on c.oldkey=c2.gpart
      ";

        $sql="select c.kofiz_sd as kofiz, 
gpart||'_'||replace(case when trim(data_v_k)<>'' then data_v_k else data_v_d end,'.','_')||'_01' as oldkey,c2.*,
 case when trim(data_v_k)<>'' then data_v_k else data_v_d end as date,
case when trim(kredit)<>'' then '-'||kredit else debet end as saldo,
 case when trim(kredit)<>'' then kredit else '' end as prepay
 from (
select c1.* from (
select '04_C'||'$rem'||'P_'||b.id as gpart,split_part(a.dogovor,' ',1) as schet,a.*,const.ver,const.begru
     from ost_detal as a 
       inner join sap_const const on 1=1
      left join clm_client_tbl b on b.code=split_part(a.dogovor,' ',1)::int 
     where dogovor like '%розподіл%' 
     and substr(dogovor,1,2)='$rem'
) c1
) c2
left join sap_vkp c on c.oldkey=c2.gpart
      ";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);

//        debug($data);
//        return;

        $fd=date('Ymd');
        $ver=$data[0]['ver'];

//        Формируем имя файла выгрузки
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        $j=0;
        foreach($data as $v) {
            $j++;
            $oldkey = trim($v['oldkey']);
            $date = date('Ymd', strtotime($v['date']));


//            debug(n2sap($v['saldo']));
//            debug($date);
//            debug($date_);
//            debug($faedn);
//            return;

            if(!empty($v['date_s']))
                $date = date('Ymd', strtotime($v['date_s']));

            $date_ = date('Y-m-d', strtotime($date));
            $faedn = date("Ymd", strtotime($date_ . ' +1 week'));

            $nds=round($v['saldo']/6,2);
            $wo_nds=round($v['saldo']-$nds,2);
            $prepay=$v['prepay'];
            if($date>$date_p) $date=$date_p;

            if($v['saldo']>0)
            {
                if($v['kofiz']=='02' || $v['kofiz']=='06')
                    $sch='3611310077';
                if($v['kofiz']=='03')
                    $sch='3611320077';

                $sch_opk= '6410303177';
                $cod_nds='VE';
                $priz='D';

            }
            else
            {
                if($v['kofiz']<>'03')
                    $sch='6811310077';
                else
                    $sch='6811320077';

                $cod_nds='UC';
                $faedn = $date;
                $priz='D';
            }

// KO block
            fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                'KO' . "\t" .
                'SL'  . "\t" .
                $date  . "\t" .
                $date_p . "\t"));

            fwrite($f,  "\n");

// OP block
            if(empty($prepay) || is_null($prepay)) {
                if($cod_nds<>'UC')
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OP' . "\t" .
                        $v['begru'] . "\t" .
                        $v['gpart'] . "\t" .
                        "\t" .
                        $v['gpart'] . "\t" .
                        '0108' . "\t" .
                        '0010' . "\t" .
                        $v['kofiz'] . "\t" .
                        $sch . "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        "\t" .
                        $date . "\t" .
                        $date_p . "\t" .
                        'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                        $faedn . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        '2020' . "\t" .
                        n2sap($nds) . "\t" .
                        n2sap($nds) . "\t" .
                        $priz
                    ));
                else
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OP' . "\t" .
                        $v['begru'] . "\t" .
                        $v['gpart'] . "\t" .
                        "\t" .
                        $v['gpart'] . "\t" .
                        '0068' . "\t" .
                        '0010' . "\t" .
                        $v['kofiz'] . "\t" .
                        $sch . "\t" .
                        $cod_nds . "\t" .
                        'X' . "\t" .
                        "\t" .
                        $date . "\t" .
                        $date_p . "\t" .
                        'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                        $faedn . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($nds) . "\t" .
                        n2sap($nds) . "\t" .
//                        "\t" .
                        '6410302177' . "\t" .
                        '6431000077' . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        '2020' . "\t" .
                        "\t" .
                        "\t" .
                        $priz
                    ));



                fwrite($f, "\n");
// OPK block
                if( $cod_nds=='VE') {
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '001' . "\t" .
                        $v['begru'] . "\t" .
                        'INITIAL4' . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $cod_nds . "\t" .
                        '2020'
                    ));


                    fwrite($f, "\n");

                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '002' . "\t" .
                        $v['begru'] . "\t" .
                        $sch_opk . "\t" .
                        n2sap($nds * (-1)) . "\t" .
                        n2sap($nds * (-1)) . "\t" .
                        $cod_nds . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        'MWS' . "\t" .
                        '020000' . "\t" .
                        'MWAS' . "\t" .
                        $cod_nds . "\t" .
                        '2020'
                    ));


                    fwrite($f, "\n");
                }
                if( $cod_nds=='UC') {
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '001' . "\t" .
                        $v['begru'] . "\t" .
                        'INITIAL3' . "\t" .
                        n2sap($v['saldo'] * (-1)) . "\t" .
                        n2sap($v['saldo'] * (-1)) . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        '2020'
                    ));
                    fwrite($f, "\n");


                }
            }
            else{
                if( $v['kofiz']<>'03')
                    $sch='6811310077';
                else
                    $sch='6811320077';
                // предоплата розподіл
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OP' . "\t" .
                    $v['begru'] . "\t" .
                    $v['gpart'] . "\t" .
                    "\t" .
                    $v['gpart'] . "\t" .
                    '0068' . "\t" .
                    '0010' . "\t" .
                    $v['kofiz'] . "\t" .
                    $sch . "\t" .
                    'UC' . "\t" .
                    'X' . "\t" .
                    "\t" .
                    $date . "\t" .
                    $date_p . "\t" .
                    'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                    $faedn . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    n2sap($nds) . "\t" .
                    n2sap($nds) . "\t" .
                    '6410302177' . "\t" .
                    '6431000077' . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    'UC' . "\t" .
                    "\t" .
                    '2020' . "\t" .
                    "\t" .
                    "\t" .
                    'D'
                ));

                fwrite($f, "\n");
// OPK block
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OPK' . "\t" .
                    '001' . "\t" .
                    $v['begru'] . "\t" .
                    'INITIAL3' . "\t" .
                    n2sap($v['saldo']*(-1)) . "\t" .
                    n2sap($v['saldo']*(-1)) . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    '2020'
                ));

                fwrite($f, "\n");

            }

            $end = '&ENDE';

            fwrite($f, $oldkey . "\t" .
                $end . "\n");
        }

//        if(1==2) {
        //        Формируем данные по перетокам
        $sql1_old = "select c.kofiz_sd as kofiz, gpart||'_'||date1||'_'||num as oldkey,c2.*
 -- (replace(c2.date,'.','-')::date+interval '1 day')::date as faedn
 from (
select replace(date,'.','_') as date1,row_number() over(partition by date,schet) as num,c1.* from (
select '04_C'||'$rem'||'P_'||b.id as gpart,split_part(a.data_doc,' ',1) as date,split_part(a.dog,' ',1) as schet,a.*,
const.ver,const.begru,def_bank_day(a.date_s,5) as date_sf
     from balances as a 
       inner join sap_const const on 1=1
      left join clm_client_tbl b on b.code=split_part(a.dog,' ',1)::int 
     where dog like '%перетоки%' and saldo is not null and a.saldo<>''
     and substr(dog,1,2)='$rem'
) c1
) c2
left join sap_vkp c on c.oldkey=c2.gpart
      ";

        $sql1="
select *,def_bank_day(date_format(date,1)::date,5) as date_sf from (
select c.kofiz_sd as kofiz, 
gpart||'_'||replace(case when trim(data_v_k)<>'' then data_v_k else data_v_d end,'.','_')||'_02' as oldkey,c2.*,
 case when trim(data_v_k)<>'' then data_v_k else data_v_d end as date,
case when trim(kredit)<>'' then '-'||kredit else debet end as saldo,
 case when trim(kredit)<>'' then kredit else '' end as prepay
 from (
select c1.* from (
select '04_C'||'$rem'||'P_'||b.id as gpart,split_part(a.dogovor,' ',1) as schet,a.*,const.ver,const.begru
     from ost_detal as a 
      inner join sap_const const on 1=1
      left join clm_client_tbl b on b.code=split_part(a.dogovor,' ',1)::int 
     where dogovor like '%перетоки%' 
     and substr(dogovor,1,2)='$rem' or ('$rem'='07' and substr(dogovor,1,1)='7' and dogovor like '%перетоки%')
) c1
) c2
left join sap_vkp c on c.oldkey=c2.gpart
) r
where schet not in('070000112','050300005','010000673','010000373')
and (trim(debet)<>'0.00')
 ";

 $data = data_from_server($sql1, $res, $vid);
        $j = 0;
        foreach ($data as $v) {
            $j++;
            $oldkey = trim($v['oldkey']);
            $date = date('Ymd', strtotime($v['date']));

            if (!empty($v['date_s']))
                $date = date('Ymd', strtotime($v['date_s']));
            $date_sf = date('Ymd', strtotime($v['date_sf']));  // +5 bank day

//                $date_ = date('Y-m-d', strtotime($date));
            $faedn = str_replace('-','',$date_sf);

            $nds = round($v['saldo'] / 6, 2);
            $wo_nds = round($v['saldo'] - $nds, 2);
            if ($date > $date_p) $date = $date_p;

//            echo n2sap(round(132.01/6,2));
//            return;


// KO block
            fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                'KO' . "\t" .
                'SL' . "\t" .
                $date . "\t" .
                $date_p . "\t"));


            $sch_opk = '6410303177';


            if ($v['saldo'] > 0) {
                $priz = 'R';
                if ($v['kofiz'] <> '03')
                    $sch = '3611210077';
                else
                    $sch = '3611220077';

                $x = '';
                if (substr($date, 0, 4) == 2020) {
                    $abr = 'VR';
                    $sch_nds = '6410203177';

                } else {
                    $abr = 'UR';
                    $sch_nds = '6410202177';

                }
            } else {
                if ($v['kofiz'] <> '03')
                    $sch = '6811210077';
                else
                    $sch = '6811220077';

                $abr = 'UD';
                $faedn = $date;
                $priz = 'R';
                $x = 'X';
            }

            fwrite($f, "\n");

// OP block
            if ($v['saldo'] > 0) {
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OP' . "\t" .
                    $v['begru'] . "\t" .
                    $v['gpart'] . "\t" .
                    "\t" .
                    $v['gpart'] . "\t" .
                    '0102' . "\t" .
                    '0010' . "\t" .
                    $v['kofiz'] . "\t" .
                    $sch . "\t" .
                    $abr . "\t" .
                    $x . "\t" .
                    "\t" .
                    $date . "\t" .
                    $date_p . "\t" .
                    'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                    $faedn . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    $abr . "\t" .
                    "\t" .
                    '2020' . "\t" .
                    n2sap($nds) . "\t" .
                    n2sap($nds) . "\t" .
                    $priz
                ));
            } else {


                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OP' . "\t" .
                    $v['begru'] . "\t" .
                    $v['gpart'] . "\t" .
                    "\t" .
                    $v['gpart'] . "\t" .
                    '0062' . "\t" .
                    '0010' . "\t" .
                    $v['kofiz'] . "\t" .
                    $sch . "\t" .
                    $abr . "\t" .
                    $x . "\t" .
                    "\t" .
                    $date . "\t" .
                    $date_p . "\t" .
                    'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                    $faedn . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    n2sap($nds) . "\t" .
                    n2sap($nds) . "\t" .
                    '6410202177' . "\t" .
                    '6430000077' . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    $abr . "\t" .
                    "\t" .
                    '2020' . "\t" .
                    "\t" .
                    "\t" .
                    $priz
                ));
            }


            fwrite($f, "\n");

            if ($v['saldo'] > 0) {
// OPK block
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OPK' . "\t" .
                    '001' . "\t" .
                    $v['begru'] . "\t" .
                    'INITIAL4' . "\t" .
                    n2sap($wo_nds * (-1)) . "\t" .
                    n2sap($wo_nds * (-1)) . "\t" .
                    $abr . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    $abr . "\t" .
                    '2020'
                ));

                fwrite($f, "\n");

                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OPK' . "\t" .
                    '002' . "\t" .
                    $v['begru'] . "\t" .
                    $sch_nds . "\t" .
                    n2sap($nds * (-1)) . "\t" .
                    n2sap($nds * (-1)) . "\t" .
                    $abr . "\t" .
                    n2sap($wo_nds * (-1)) . "\t" .
                    n2sap($wo_nds * (-1)) . "\t" .
                    'MWS' . "\t" .
                    '020000' . "\t" .
                    'MWAS' . "\t" .
                    $abr . "\t" .
                    '2020'
                ));

                fwrite($f, "\n");
            } else {
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OPK' . "\t" .
                    '001' . "\t" .
                    $v['begru'] . "\t" .
                    'INITIAL3' . "\t" .
                    n2sap($v['saldo'] * (-1)) . "\t" .
                    n2sap($v['saldo'] * (-1)) . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    '2020'
                ));

                fwrite($f, "\n");
            }

            $end = '&ENDE';

            fwrite($f, $oldkey . "\t" .
                $end . "\n");
        }
//        }

        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл DOCUMENT сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";
        return $this->render('info', [
            'model' => $model]);
    }


    // Формирование файла остатков по бухгалтерии DOCUMENT_POST (юридические лица поставщики - только для Днепра)
    public function actionSap_document_post($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);

        $rem = '0' . $res;  // Код РЭС

        $rem = '0' . $res;  // Код РЭС
        $end = '&ENDE';

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла


        $sql_p = " select (max(mmgg) + interval '1 month' -  interval '1 day')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $date_p = $data_p[0]['mmgg'];  // Получаем дату проводки
        $date_p = str_replace('-', '', $date_p);

//        Формируем данные по розподілу
        $sql = "select '06' as kofiz,'04_C'||'01'||'P_'|| 
gpart||'_'||replace(case when trim(data_v_k)<>'' then data_v_k else data_v_d end,'.','_') as oldkey,
c2.*,
 case when trim(data_v_k)<>'' then data_v_k else data_v_d end as date,
case when trim(kredit)<>'' then '-'||kredit else debet end as saldo,
 case when trim(kredit)<>'' then kredit else '' end as prepay
 from (
select c1.* from (
select b.partner_id as gpart,b.acc_id,'' as schet,a.*,const.ver,const.begru
     from ost_detal_post as a 
       inner join sap_const const on 1=1
     --left join rekv_post b on trim(trim(chr(13) from trim(chr(10) from a.contragent)))=trim(trim(chr(13) from trim(chr(10) from b.post)))
     inner join rekv_post b on trim(trim(chr(13) from trim(chr(10) from a.contragent)))=trim(trim(chr(13) from trim(chr(10) from b.post)))
) c1
) c2
      ";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);

//        debug($data);
//        return;

        $fd = date('Ymd');
        $ver = $data[0]['ver'];

//        Формируем имя файла выгрузки
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        $j = 0;
        foreach ($data as $v) {
            $j++;
            $oldkey = $v['oldkey'];
            $date = date('Ymd', strtotime($v['date']));


//            debug(n2sap($v['saldo']));
//            debug($date);
//            debug($date_);
//            debug($faedn);
//            return;

            if (!empty($v['date_s']))
                $date = date('Ymd', strtotime($v['date_s']));

            $date_ = date('Y-m-d', strtotime($date));
            $faedn = date("Ymd", strtotime($date_ . ' +1 week'));

            $nds = round($v['saldo'] / 6, 2);
            $wo_nds = round($v['saldo'] - $nds, 2);
            $prepay = $v['prepay'];
            if ($date > $date_p) $date = $date_p;

            if ($v['saldo'] > 0) {
                if ($v['kofiz'] == '02' || $v['kofiz'] == '06')
                    $sch = '3611310077';
                if ($v['kofiz'] == '03')
                    $sch = '3611320077';

                $sch_opk = '6410303177';
                $cod_nds = 'VE';
                $priz = 'D';

            } else {
                if ($v['kofiz'] <> '03')
                    $sch = '6811310077';
                else
                    $sch = '6811320077';

                $cod_nds = 'UC';
                $faedn = $date;
                $priz = 'D';
            }

// KO block
            fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                'KO' . "\t" .
                'SL' . "\t" .
                $date . "\t" .
                $date_p . "\t"));

            fwrite($f, "\n");

// OP block
            if (empty($prepay) || is_null($prepay)) {
                if ($cod_nds <> 'UC')
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OP' . "\t" .
                        $v['begru'] . "\t" .
                        $v['gpart'] . "\t" .
                        "\t" .
                        $v['acc_id'] . "\t" .
                        '0108' . "\t" .
                        '0010' . "\t" .
                        $v['kofiz'] . "\t" .
                        $sch . "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        "\t" .
                        $date . "\t" .
                        $date_p . "\t" .
                        'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                        $faedn . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        '2020' . "\t" .
                        n2sap($nds) . "\t" .
                        n2sap($nds) . "\t" .
                        $priz
                    ));
                else
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OP' . "\t" .
                        $v['begru'] . "\t" .
                        $v['gpart'] . "\t" .
                        "\t" .
                        $v['acc_id'] . "\t" .
                        '0068' . "\t" .
                        '0010' . "\t" .
                        $v['kofiz'] . "\t" .
                        $sch . "\t" .
                        $cod_nds . "\t" .
                        'X' . "\t" .
                        "\t" .
                        $date . "\t" .
                        $date_p . "\t" .
                        'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                        $faedn . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($nds) . "\t" .
                        n2sap($nds) . "\t" .
//                        "\t" .
                        '6410302177' . "\t" .
                        '6431000077' . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        '2020' . "\t" .
                        "\t" .
                        "\t" .
                        $priz
                    ));


                fwrite($f, "\n");
// OPK block
                if ($cod_nds == 'VE') {
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '001' . "\t" .
                        $v['begru'] . "\t" .
                        'INITIAL4' . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        $cod_nds . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $cod_nds . "\t" .
                        '2020'
                    ));


                    fwrite($f, "\n");

                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '002' . "\t" .
                        $v['begru'] . "\t" .
                        $sch_opk . "\t" .
                        n2sap($nds * (-1)) . "\t" .
                        n2sap($nds * (-1)) . "\t" .
                        $cod_nds . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        'MWS' . "\t" .
                        '020000' . "\t" .
                        'MWAS' . "\t" .
                        $cod_nds . "\t" .
                        '2020'
                    ));


                    fwrite($f, "\n");
                }
                if ($cod_nds == 'UC') {
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '001' . "\t" .
                        $v['begru'] . "\t" .
                        'INITIAL3' . "\t" .
                        n2sap($v['saldo'] * (-1)) . "\t" .
                        n2sap($v['saldo'] * (-1)) . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        '2020'
                    ));
                    fwrite($f, "\n");


                }
            } else {
                if ($v['kofiz'] <> '03')
                    $sch = '6811310077';
                else
                    $sch = '6811320077';
                // предоплата розподіл
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OP' . "\t" .
                    $v['begru'] . "\t" .
                    $v['gpart'] . "\t" .
                    "\t" .
                    $v['acc_id'] . "\t" .
                    '0068' . "\t" .
                    '0010' . "\t" .
                    $v['kofiz'] . "\t" .
                    $sch . "\t" .
                    'UC' . "\t" .
                    'X' . "\t" .
                    "\t" .
                    $date . "\t" .
                    $date_p . "\t" .
                    'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                    $faedn . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    n2sap($v['saldo']) . "\t" .
                    n2sap($nds) . "\t" .
                    n2sap($nds) . "\t" .
                    '6410302177' . "\t" .
                    '6431000077' . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    'UC' . "\t" .
                    "\t" .
                    '2020' . "\t" .
                    "\t" .
                    "\t" .
                    'D'
                ));

                fwrite($f, "\n");
// OPK block
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'OPK' . "\t" .
                    '001' . "\t" .
                    $v['begru'] . "\t" .
                    'INITIAL3' . "\t" .
                    n2sap($v['saldo'] * (-1)) . "\t" .
                    n2sap($v['saldo'] * (-1)) . "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    "\t" .
                    '2020'
                ));

                fwrite($f, "\n");

            }

            $end = '&ENDE';

            fwrite($f, $oldkey . "\t" .
                $end . "\n");
        }

        if (1 == 2) {
            //        Формируем данные по перетокам
            $sql1 = "select c.kofiz_sd as kofiz, gpart||'_'||date1||'_'||num as oldkey,c2.*
 -- (replace(c2.date,'.','-')::date+interval '1 day')::date as faedn
 from (
select replace(date,'.','_') as date1,row_number() over(partition by date,schet) as num,c1.* from (
select '04_C'||'$rem'||'P_'||b.id as gpart,split_part(a.data_doc,' ',1) as date,split_part(a.dog,' ',1) as schet,a.*,const.ver,const.begru
     from balances as a 
       inner join sap_const const on 1=1
      left join clm_client_tbl b on b.code=split_part(a.dog,' ',1)::int 
     where dog like '%перетоки%' and saldo is not null and a.saldo<>''
     and substr(dog,1,2)='$rem'
) c1
) c2
left join sap_vkp c on c.oldkey=c2.gpart
      ";
            $data = data_from_server($sql1, $res, $vid);


            $j = 0;
            foreach ($data as $v) {
                $j++;
                $oldkey = $v['oldkey'];
                $date = date('Ymd', strtotime($v['date']));

                if (!empty($v['date_s']))
                    $date = date('Ymd', strtotime($v['date_s']));

                $date_ = date('Y-m-d', strtotime($date));
                $faedn = date("Ymd", strtotime($date_ . ' +1 week'));

                $nds = round($v['saldo'] / 6, 2);
                $wo_nds = round($v['saldo'] - $nds, 2);
                if ($date > $date_p) $date = $date_p;

//            echo n2sap(round(132.01/6,2));
//            return;


// KO block
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'KO' . "\t" .
                    'SL' . "\t" .
                    $date . "\t" .
                    $date_p . "\t"));


                $sch_opk = '6410303177';


                if ($v['saldo'] > 0) {
                    $priz = 'R';
                    if ($v['kofiz'] <> '03')
                        $sch = '3611210077';
                    else
                        $sch = '3611220077';

                    $x = '';
                    if (substr($date, 0, 4) == 2020) {
                        $abr = 'VR';
                        $sch_nds = '6410203177';

                    } else {
                        $abr = 'UR';
                        $sch_nds = '6410202177';

                    }
                } else {
                    if ($v['kofiz'] <> '03')
                        $sch = '6811210077';
                    else
                        $sch = '6811220077';

                    $abr = 'UD';
                    $faedn = $date;
                    $priz = 'R';
                    $x = 'X';
                }

                fwrite($f, "\n");

// OP block
                if ($v['saldo'] > 0) {
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OP' . "\t" .
                        $v['begru'] . "\t" .
                        $v['gpart'] . "\t" .
                        "\t" .
                        $v['gpart'] . "\t" .
                        '0102' . "\t" .
                        '0010' . "\t" .
                        $v['kofiz'] . "\t" .
                        $sch . "\t" .
                        $abr . "\t" .
                        $x . "\t" .
                        "\t" .
                        $date . "\t" .
                        $date_p . "\t" .
                        'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                        $faedn . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $abr . "\t" .
                        "\t" .
                        '2020' . "\t" .
                        n2sap($nds) . "\t" .
                        n2sap($nds) . "\t" .
                        $priz
                    ));
                } else {


                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OP' . "\t" .
                        $v['begru'] . "\t" .
                        $v['gpart'] . "\t" .
                        "\t" .
                        $v['gpart'] . "\t" .
                        '0062' . "\t" .
                        '0010' . "\t" .
                        $v['kofiz'] . "\t" .
                        $sch . "\t" .
                        $abr . "\t" .
                        $x . "\t" .
                        "\t" .
                        $date . "\t" .
                        $date_p . "\t" .
                        'Energo-' . $v['begru'] . '-' . substr($date, 4, 2) . substr($date, 0, 4) . '-' . $v['schet'] . "\t" .
                        $faedn . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($v['saldo']) . "\t" .
                        n2sap($nds) . "\t" .
                        n2sap($nds) . "\t" .
                        '6410202177' . "\t" .
                        '6430000077' . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $abr . "\t" .
                        "\t" .
                        '2020' . "\t" .
                        "\t" .
                        "\t" .
                        $priz
                    ));
                }


                fwrite($f, "\n");

                if ($v['saldo'] > 0) {
// OPK block
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '001' . "\t" .
                        $v['begru'] . "\t" .
                        'INITIAL4' . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        $abr . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        $abr . "\t" .
                        '2020'
                    ));

                    fwrite($f, "\n");

                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '002' . "\t" .
                        $v['begru'] . "\t" .
                        $sch_nds . "\t" .
                        n2sap($nds * (-1)) . "\t" .
                        n2sap($nds * (-1)) . "\t" .
                        $abr . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        n2sap($wo_nds * (-1)) . "\t" .
                        'MWS' . "\t" .
                        '020000' . "\t" .
                        'MWAS' . "\t" .
                        $abr . "\t" .
                        '2020'
                    ));

                    fwrite($f, "\n");
                } else {
                    fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                        'OPK' . "\t" .
                        '001' . "\t" .
                        $v['begru'] . "\t" .
                        'INITIAL3' . "\t" .
                        n2sap($v['saldo'] * (-1)) . "\t" .
                        n2sap($v['saldo'] * (-1)) . "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        "\t" .
                        '2020'
                    ));

                    fwrite($f, "\n");
                }

                $end = '&ENDE';

                fwrite($f, $oldkey . "\t" .
                    $end . "\n");
            }
        }

        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл DOCUMENT_POST сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";
        return $this->render('info', [
            'model' => $model]);
    }

// Формирование файла группировки устройств DEVGRP (юридические лица)
    public function actionSap_devgrp($res)
    {
        $helper=0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС
        $end = '&ENDE';
        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method=__FUNCTION__;
        if(substr($method,-4)=='_ind') {
            $vid = 1;
            $_suffix = '_R';
        }
        else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
//   Дальше идет плагиат - взято из выгрузки Чернигова
        $sql_p=" select (max(mmgg) + interval '1 month')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $period = $data_p[0]['mmgg'];  // Получаем текущий отчетный период
        $period = str_replace('-','',$period);

        $sql="select distinct 'DEVGRP' as name, c.id,c.code,e.name_eqp,eq.id_point as id_eq,const.ver,c.short_name
        from group_trans1 as eq
         join ( select eq.id as id_comp,eq.num_eqp as num_comp , hm.dt_b, eq.name_eqp,
		CASE WHEN eq2.type_eqp = 1 THEN eq2.id WHEN eq3.type_eqp = 1 THEN eq3.id END as id_meter, c.date_check, 
	      ic.id as id_type_tr, ic.accuracy, CASE WHEN coalesce(ic.amperage2_nom,0)=0 THEN 0 ELSE ic.amperage_nom/ic.amperage2_nom END as koef_i, eq.num_eqp, eq.is_owner 
	    from eqm_compensator_i_tbl as c 
	    join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
	    left join eqm_equipment_h as hm on (hm.id = c.code_eqp) and hm.dt_b = (
	    select dt_b from eqm_equipment_h where id = eq.id 
	    and trim(coalesce(num_eqp,'')) = trim(coalesce(eq.num_eqp,''))  and dt_e is null order by dt_b desc limit 1 )
	    join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
	    left join eqm_eqp_tree_tbl as tt3 on (tt3.code_eqp=c.code_eqp ) 
	    left join eqm_eqp_tree_tbl as tt on (tt.code_eqp_e=c.code_eqp ) 
	    left join eqm_eqp_tree_tbl as tt2 on (tt2.code_eqp_e=tt.code_eqp ) 
	    left join eqm_equipment_tbl as eq2 on (eq2.id =tt.code_eqp ) 
	    left join eqm_equipment_tbl as eq3 on (eq3.id =tt2.code_eqp ) 
	    order by 1
	    ) as sti on (sti.id_meter = eq.id_meter::integer)  	  
            left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.code_tt::integer) 
            join eqm_eqp_tree_tbl as ttr on (ttr.code_eqp =eq.code_tt::integer)
            left join eqm_tree_tbl as tr on  (tr.id = ttr.id_tree) 
            left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
            left join clm_statecl_tbl as sc on (c.id = sc.id_client) 
            left join eqm_equipment_tbl as e on e.id= eq.id_point
            inner join sap_const const on 1=1 
            where  c.book=-1 and coalesce(c.idk_work,0) not in (0) and coalesce(c.id_state,0) not in (50,99,49,100)
             and sc.id_section not in (205,206,207,208,209,218) and c.id <> syi_resid_fun() and c.id <>999999999
              and eq.code_t_new is not null
              and (c.code>999 or c.code=900) 
	         and  c.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001')
            order by 5";

        if ($res==4)
        $sql="select distinct 'DEVGRP' as name, c.id,c.code,e.name_eqp,eq.id_point as id_eq,const.ver,c.short_name
        from group_trans1 as eq
         join ( select eq.id as id_comp,eq.num_eqp as num_comp , hm.dt_b, eq.name_eqp,
		CASE WHEN eq2.type_eqp = 1 THEN eq2.id WHEN eq3.type_eqp = 1 THEN eq3.id END as id_meter, c.date_check, 
	      ic.id as id_type_tr, ic.accuracy, CASE WHEN coalesce(ic.amperage2_nom,0)=0 THEN 0 ELSE ic.amperage_nom/ic.amperage2_nom END as koef_i, eq.num_eqp, eq.is_owner 
	    from eqm_compensator_i_tbl as c 
	    join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
	    left join eqm_equipment_h as hm on (hm.id = c.code_eqp) and hm.dt_b = (
	    select dt_b from eqm_equipment_h where id = eq.id 
	    and trim(coalesce(num_eqp,'')) = trim(coalesce(eq.num_eqp,''))  and dt_e is null order by dt_b desc limit 1 )
	    join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
	    left join eqm_eqp_tree_tbl as tt3 on (tt3.code_eqp=c.code_eqp ) 
	    left join eqm_eqp_tree_tbl as tt on (tt.code_eqp_e=c.code_eqp ) 
	    left join eqm_eqp_tree_tbl as tt2 on (tt2.code_eqp_e=tt.code_eqp ) 
	    left join eqm_equipment_tbl as eq2 on (eq2.id =tt.code_eqp ) 
	    left join eqm_equipment_tbl as eq3 on (eq3.id =tt2.code_eqp ) 
	    order by 1
	    ) as sti on (sti.id_meter = eq.id_meter::integer)  	  
            left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.code_tt::integer) 
            join eqm_eqp_tree_tbl as ttr on (ttr.code_eqp =eq.code_tt::integer)
            left join eqm_tree_tbl as tr on  (tr.id = ttr.id_tree) 
            left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
            left join clm_statecl_tbl as sc on (c.id = sc.id_client) 
            left join eqm_equipment_tbl as e on e.id= eq.id_point
            inner join sap_const const on 1=1 
            where  c.book=-1 and coalesce(c.idk_work,0) not in (0) and coalesce(c.id_state,0) not in (50,99,49,100)
             and sc.id_section not in (205,206,207,208,209,218) and c.id <> syi_resid_fun() and c.id <>999999999
              and eq.code_t_new is not null
              and (c.code>999 or c.code=900) 
	         and  c.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001')
	    AND eq.id_point not in(120745,120741)
            order by 5";

//        and eq.id not in(120748,120744)
//    and eq.id not in(120745,120741) instln

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
//        Формируем имя файла выгрузки
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');
        $oldkey_const='04_C'.$rem.'B_';

        $fname1 = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $ff = fopen($fname1, 'w+');

        foreach($data as $v) {
            $id_eq = $v['id_eq'];
            $id = $v['id'];
            $short_name=$v['short_name'];
            $code=$v['code'];
            $oldkey = $oldkey_const . $id;
            $oldkey1= '04_C'.$rem.'P_';
            $sql_1="select  distinct  1 as ord,eq.id_point ,
'EDEVGR' as n_struct,
case when substr(zz.clas,1,1)='J'  then '0002'  else '0003' end as devgrptyp,
'$period'  as keydate, 
'' as dop,
'1' as sort
from group_trans1 as eq
join ( select eq.num_eqp as num_comp , 
    CASE WHEN eq2.type_eqp = 1 THEN eq2.id WHEN eq3.type_eqp = 1 THEN eq3.id END as id_meter
      from eqm_compensator_i_tbl as c 
      join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
      left join eqm_equipment_h as hm on (hm.id = c.code_eqp) and hm.dt_b = (
            select dt_b from eqm_equipment_h where id = eq.id
            and trim(coalesce(num_eqp,'')) = trim(coalesce(eq.num_eqp,''))  and dt_e is null order by dt_b desc limit 1 )
      join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
      left join eqm_eqp_tree_tbl as tt3 on (tt3.code_eqp=c.code_eqp ) 
      left join eqm_eqp_tree_tbl as tt on (tt.code_eqp_e=c.code_eqp ) 
      left join eqm_eqp_tree_tbl as tt2 on (tt2.code_eqp_e=tt.code_eqp ) 
      left join eqm_equipment_tbl as eq2 on (eq2.id =tt.code_eqp ) 
      left join eqm_equipment_tbl as eq3 on (eq3.id =tt2.code_eqp ) 
      order by 1
      ) as sti on (sti.id_meter = eq.id_meter)        
left join
            (select mt.id_meter, type_tr.group_ob as clas from
            (select CASE WHEN eq2.type_eqp = 1 THEN eq2.id WHEN eq3.type_eqp = 1 THEN eq3.id END as id_meter, ic.id as id_type_tr
from eqm_compensator_i_tbl as c 
join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
      left join eqm_eqp_tree_tbl as tt3 on (tt3.code_eqp=c.code_eqp ) 
      left join eqm_eqp_tree_tbl as tt on (tt.code_eqp_e=c.code_eqp ) 
      left join eqm_eqp_tree_tbl as tt2 on (tt2.code_eqp_e=tt.code_eqp ) 
      left join eqm_equipment_tbl as eq2 on (eq2.id =tt.code_eqp ) 
      left join eqm_equipment_tbl as eq3 on (eq3.id =tt2.code_eqp ) 
) as mt
           join sap_type_tr_i_tbl as type_tr on type_tr.id_type = mt.id_type_tr
          -- join sap_type_tr_u_tbl as type_tr_u on type_tr_u.id_type = mt.id_type_tr
                where type_tr.id_type is not null
) as zz on zz.id_meter=sti.id_meter
                where eq.id_point= $id_eq and eq.code_t_new is not null
    
union
--eq.code_t_new
select  distinct  eq.ord,eq.id_point,
'DEVICE' as n_struct,
'$oldkey1' || cyrillic_transliterate(extract_sn(eq.code_t_new)) as devgrptyp,
 '' as  keydate, 
''  as dop,
'2' as sort
from group_trans1 as eq
join ( select eq.id as id_comp,eq.num_eqp as num_comp , hm.dt_b, 
		CASE WHEN eq2.type_eqp = 1 THEN eq2.id WHEN eq3.type_eqp = 1 THEN eq3.id END as id_meter, c.date_check, 
	       gr.id_area, ic.amperage_nom, ic.conversion , ic.type as tt_type,ic.id as id_type_tr, ic.accuracy, CASE WHEN coalesce(ic.amperage2_nom,0)=0 THEN 0 ELSE ic.amperage_nom/ic.amperage2_nom END as koef_i, eq.num_eqp, eq.is_owner 
	    from eqm_compensator_i_tbl as c 
	    join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
	    left join eqm_equipment_h as hm on (hm.id = c.code_eqp) and hm.dt_b = (
            select dt_b from eqm_equipment_h where id = eq.id
            and trim(coalesce(num_eqp,'')) = trim(coalesce(eq.num_eqp,''))  and dt_e is null order by dt_b desc limit 1 )
	    join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
	    left join eqm_eqp_tree_tbl as tt3 on (tt3.code_eqp=c.code_eqp ) 
	    left join eqm_eqp_tree_tbl as tt on (tt.code_eqp_e=c.code_eqp ) 
	    left join eqm_eqp_tree_tbl as tt2 on (tt2.code_eqp_e=tt.code_eqp ) 
	    left join eqm_equipment_tbl as eq2 on (eq2.id =tt.code_eqp ) 
	    left join eqm_equipment_tbl as eq3 on (eq3.id =tt2.code_eqp ) 
	    left join (select eq.id as id_area, eq.id_addres,  eq.name_eqp, ins.code_eqp from eqm_equipment_tbl as eq join eqm_compens_station_inst_tbl as ins on (ins.code_eqp_inst = eq.id) where eq.type_eqp = 11 order by ins.code_eqp ) as gr on (gr.code_eqp =  tt3.code_eqp_e) 
	    order by 1
	    ) as sti on (sti.id_meter = eq.id_meter::integer)
            left join sap_type_tr_i_tbl as type_tr on type_tr.id_type = sti.id_type_tr
               left join sap_type_tr_u_tbl as type_tr_u on type_tr_u.id_type = sti.id_type_tr
               where eq.id_point = $id_eq and eq.code_t_new is not null
order by sort,ord";

            $data_1 = data_from_server($sql_1, $res, $vid);

//            debug($data_1);
//            return;

            // Запись в файл структуры DI_INT
            $oldkey2='';
            foreach ($data_1 as $v1) {
                $link_tr = str_replace(chr(13),'',$v1['devgrptyp']);
                $link_tr = str_replace(chr(10),'',$v1['devgrptyp']);
                $oldkey2 = $oldkey1 . $v1['id_point'];
                fwrite($f, iconv("utf-8","windows-1251",$oldkey2."\t".
                    $v1['n_struct']."\t".
                    $link_tr."\t".
                    $v1['keydate']."\n") );

            }
            if (trim($oldkey2)<>'')
            { fwrite($f, $oldkey2."\t".
                $end."\n");

                // Запись в _ext файл
                fwrite($ff, iconv("utf-8","windows-1251", 'DEVGRP'."\t".
                    $oldkey2."\t".
                    $code."\t".
                    $short_name."\n"
                ) );}
        }


        // Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл DEVGRP сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }


    //выгрузка ид фалов сап инстлн , для бытовых потребителей
    public function actionIdfile_instln_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'INSTLN' as OM,oldkey,v.code,trim((v.last_name||' '||substr(v.name, 1, 1)||'.'||substr(v.patron_name, 1, 1)||'.')) as name_tu,const.ver from sap_data as a
		left join clm_paccnt_tbl as p
		on substr(a.oldkey,12)::int=p.id
                left join vw_address as v
                on v.id=p.id
                left join sap_const as const
                on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }


    // Формирование файла instln для САП для юридических потребителей
    public function actionSap_instln($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        $sql_p = " select (max(mmgg) + interval '1 month')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $period = $data_p[0]['mmgg'];  // Получаем текущий отчетный период

        // Получаем дату ab
        $sql_d = " select (max(mmgg) - interval '3 month')::date as mmgg_current from sys_month_tbl";
        $data_d = data_from_server($sql_d, $res, $vid);
        $date_ab = $data_d[0]['mmgg_current'];

        // Главный запрос со всеми необходимыми данными - но старый (переделанный смотри ниже после этого)
        // сейчас этот не используется
        $sql = "select * from (
select r.*,coalesce(eds.ed_sch,eds1.ed_sch) as ableinh from (
        select  distinct on(zz_eic::char(16)||qqq.id::char(10)) 
        case when www.code=900 then 'CK_4HN2_01' else u.tarif_sap end as tarif_sap,
        case when qqq.oldkey is null or qqq.oldkey='' then trim(yy.oldkey) else trim(qqq.oldkey) end as vstelle,
www.short_name as real_name,const.ver,const.begru_all as begru,
'10' as sparte,qqq.* from
(select  distinct on(q1.num_eqp::char(16)||q1.id::char(10)) q1.id,aa.id_tu,x.oldkey,cc.short_name,
case when q.id_cl=2062 then rr.id_client else q.id_cl end as id_potr,
q1.num_eqp as zz_eic,q.* from
(select  distinct 'DATA' as DATA,c.id as id_cl,c.idk_work,
case when p.voltage_max = 0.22 then '02'
     when p.voltage_max = 0.4 then '03'
     when p.voltage_max = 10.00 then '05' 
     when p.voltage_max = 6.0 then '04'
     when p.voltage_max = 27.5 then '06'
     when p.voltage_max = 35.0 then '07'
     when p.voltage_max = 150.0 then '16'
     when p.voltage_max = 110.0 then '08' else '-' end as SPEBENE,
'0001' as ANLART,
'0002' as ABLESARTST,
p.name_eqp as ZZ_NAMETU,
p.eic_code,
p.code_eqp,
'' as ZZ_FIDER,
'$date_ab'::char(10) as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'  
     when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???' 
     else 
	case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???' 
	else '???' --tar_sap.id_sap_tar 
	end 
end  as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' then '0004' else '0002' end as AKLASSE,
    -- 'PC010131' as ABLEINH,
    -- eds.ed_sch as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
     when tgr.ident in('tgr2') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
     when tgr.ident in('tgr6') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
     when tgr.ident in('tgr3') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
     when tgr.ident in('tgr4') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
     when tgr.ident in('tgr1') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999)  then '054'
     when tgr.ident in('tgr2') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
     when tgr.ident in('tgr6') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
     when tgr.ident in('tgr3') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
     when tgr.ident in('tgr4') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
     when tgr.ident in('tgr8_10','tgr8_30') then '298'
     when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
     when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '352'
     when ((tgr.ident ~ 'tgr7_12') or (tgr.ident~ 'tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007)  in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)  and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521'  and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and  tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and  tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10  and tcl.ident='tcl1' then '604'
when c.idk_work=99 and p.voltage_min<=10 and tcl.ident='tcl2' then '606'
when tcl.ident='tcl1' and p.id_extra =1003 then '632'
when tcl.ident='tcl2' and p.id_extra =1003 then '634'
when tcl.ident='tcl1' and p.id_extra in (1001,1002,1012,1013) then '638'
when tcl.ident='tcl2' and p.id_extra in (1001,1002,1012,1013) then '640'
when tgr.ident in('tgr8_101') then '666'
 else '' end as ZZCODE4NKRE,
'' as ZZCODE4NKRE_DOP,
'' as ZZOTHERAREA,
'1' as sort 
from (select eq.num_eqp as eic_code,tr.name as vid_trf,dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, tr.id_grouptarif --, ph.id_extra --, tr.id_classtarif
	from eqm_equipment_tbl as eq 
	
	 join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	 join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) 
	left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) 
	left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
	left join eqk_zone_tbl AS z on (dt.zone=z.id) 
	left join cla_param_tbl AS cla on (dt.id_depart=cla.id) 
	left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
	left join clm_position_tbl as cp on (cp.id = dt.id_position) ) as p 
 join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
 join eqm_tree_tbl as t on (t.id = tt.id_tree) 
 join (select distinct id,code,idk_work from clm_client_tbl) as c on (c.id = t.id_client) 
left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
left join clm_statecl_tbl as st on (st.id_client = c2.id) 
left join aci_tarif_tbl as tar on (tar.id=p.id_tarif)
--left join sap_energo_tarif as tar_sap on tar_sap.id_tar = p.id_tarif
left join eqi_grouptarif_tbl as tgr on tgr.id= p.id_grouptarif
left join eqi_classtarif_tbl as tcl on (p.id_classtarif=tcl.id) 
--left join reading_controller as w on w.tabel_numb = p.num_tab
left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp) 
left join (select code_eqp, trim(sum(e.name||','),',') as energy from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en on (en.code_eqp = p.code_eqp) 

) q 
left join eqm_equipment_tbl q1 
on q.zz_nametu::text=q1.name_eqp::text and substr(trim(q1.num_eqp)::text,1,3)='62Z' 
and substr(trim(q1.num_eqp),1,16)=substr(trim(q.eic_code),1,16)
left join eqm_eqp_use_tbl as use1 on (use1.code_eqp = q1.id)
left join eqm_area_tbl ar on ar.code_eqp=q1.id
--left join sap_evbsd x on case when trim(x.haus)='' then 0 else coalesce(substr(x.haus,9)::integer,0) end =q1.id
left join (select distinct id_eq,id_tu from sap_premise_dop) aa on aa.id_tu=q1.id
left join sap_evbsd x on substr(x.oldkey,11)::int in (aa.id_eq) 
    
left join clm_client_tbl as cc on cc.id = q.id_cl --and cc.idk_work=1
left join 
(select u.id_client,a.id from eqm_equipment_tbl a
   left join eqm_point_tbl tu1 on tu1.code_eqp=a.id 
   left JOIN eqm_compens_station_inst_tbl AS area ON (a.id=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_area_tbl u on u.code_eqp=area.code_eqp_inst
   left join clm_client_tbl u1 on u1.id=u.id_client) rr 
   on rr.id=q1.id and (x.oldkey is null or q.id_cl=2062)
where SPEBENE::text<>'' and q1.num_eqp is not null
and q.code_eqp=q1.id 
and substr(trim(q1.num_eqp),1,16)||case when q.id_cl=2062 then use1.id_client else id_cl end in

(select substr(eq.num_eqp,1,16)||coalesce (use.id_client, tr.id_client) from eqm_equipment_tbl eq
 left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
	join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	join eqm_point_tbl AS dt on (dt.code_eqp= eq.id)
	left JOIN eqm_compens_station_inst_tbl AS area ON (eq.id=area.code_eqp) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	join eqm_eqp_tree_tbl as tt on (dt.code_eqp = tt.code_eqp) 
	join eqm_tree_tbl as t on (t.id = tt.id_tree) 
	left join eqm_area_tbl u on u.code_eqp=area.code_eqp_inst
	join (select distinct id,code,idk_work from clm_client_tbl) as c1 on (c1.id = t.id_client) 
    where c.idk_work<>0) 
    --order by q1.id
   
) qqq 
--order by id

left join tarif_sap_energo u on trim(u.name)=trim(qqq.vid_trf)
left join eqm_eqp_use_tbl use on use.code_eqp=qqq.id
left join sap_evbsd yy on case when trim(yy.haus)='' then 0 else coalesce(substr(yy.haus,9)::integer,0) end=qqq.id_tu
left join clm_client_tbl www on www.id=coalesce(qqq.id_potr,use.id_client)
inner join sap_const const on 1=1
where coalesce(qqq.id_potr,use.id_client) is not null and www.code<>999 or (www.code=999 and use.code_eqp is not null)
and
(www.code>999 or  www.code=900) AND coalesce(www.idk_work,0)<>0 or (coalesce(www.idk_work,0)=0 and use.code_eqp is not null)
	     and  www.code not in('20000556','20000565','20000753',
	    '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001')
)  r	
left join ed_sch eds on r.id=eds.code_tu::int
left join ed_sch_dop eds1 on r.id=eds1.code_tu::int
where vstelle is not null      
order by 7	             		        
) o
";
// Самый новый правильный запрос
        $sql = "SELECT distinct q.code_eqp as id,ar.code_eqp_inst,yy.oldkey as vstelle,''::char(20) as vstelle1,'10' as sparte,
const.ver,const.begru_all as begru,coalesce(eds.ed_sch,eds1.ed_sch) as ableinh,
case when www.code=900  or (q.code_eqp=118522 and $res=5) or (q.code_eqp=120129 and $res=4) then 'CK_4HN2_01' else u.tarif_sap end as tarif_sap,
q.* from (
select  distinct 'DATA' as DATA,c.id as id_cl,c.idk_work,
case when p.voltage_max = 0.22 then '02'
     when p.voltage_max = 0.4 then '03'
     when p.voltage_max = 10.00 then '05' 
     when p.voltage_max = 6.0 then '04'
     when p.voltage_max = 27.5 then '06'
     when p.voltage_max = 35.0 then '07'
     when p.voltage_max = 150.0 then '16'
     when p.voltage_max = 110.0 then '08' else '-' end as SPEBENE,
'0001' as ANLART,
'0002' as ABLESARTST,
p.name_eqp as ZZ_NAMETU,
p.eic_code as zz_eic,
p.code_eqp,
'' as ZZ_FIDER,
'$date_ab'::char(10) as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'  
     when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???' 
     else 
	case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???' 
	else '???' --tar_sap.id_sap_tar 
	end 
end  as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' or (p.code_eqp=118522 and $res=5) or (p.code_eqp=120129 and $res=4) 
then '0004' else '0002' end as AKLASSE,
    -- 'PC010131' as ABLEINH,
    -- eds.ed_sch as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
     when tgr.ident in('tgr2') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
     when tgr.ident in('tgr6') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
     when tgr.ident in('tgr3') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
     when tgr.ident in('tgr4') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
     when tgr.ident in('tgr1') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999)  then '054'
     when tgr.ident in('tgr2') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
     when tgr.ident in('tgr6') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
     when tgr.ident in('tgr3') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
     when tgr.ident in('tgr4') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
     when tgr.ident in('tgr8_10','tgr8_30') then '298'
     when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
     when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '352'
     when ((tgr.ident ~ 'tgr7_12') or (tgr.ident~ 'tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007)  in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)  and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521'  and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and  tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and  tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10  and tcl.ident='tcl1' then '604'
when c.idk_work=99 and p.voltage_min<=10 and tcl.ident='tcl2' then '606'
when tcl.ident='tcl1' and p.id_extra =1003 then '632'
when tcl.ident='tcl2' and p.id_extra =1003 then '634'
when tcl.ident='tcl1' and p.id_extra in (1001,1002,1012,1013) then '638'
when tcl.ident='tcl2' and p.id_extra in (1001,1002,1012,1013) then '640'
when tgr.ident in('tgr8_101') then '666'
 else '' end as ZZCODE4NKRE,
'' as ZZCODE4NKRE_DOP,
'' as ZZOTHERAREA,
'1' as sort 
from (select eq.num_eqp as eic_code,tr.name as vid_trf,dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, tr.id_grouptarif --, ph.id_extra --, tr.id_classtarif
	from eqm_equipment_tbl as eq 
	
	 join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	 join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) 
	left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) 
	left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
	left join eqk_zone_tbl AS z on (dt.zone=z.id) 
	left join cla_param_tbl AS cla on (dt.id_depart=cla.id) 
	left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
	left join clm_position_tbl as cp on (cp.id = dt.id_position) 
	where eq.type_eqp=12 and substr(trim(eq.num_eqp)::text,1,3)='62Z' 
	) as p 
 join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
 join eqm_tree_tbl as t on (t.id = tt.id_tree) 
 join (select distinct id,code,idk_work from clm_client_tbl) as c on (c.id = t.id_client) 
left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
left join clm_statecl_tbl as st on (st.id_client = c2.id) 
left join aci_tarif_tbl as tar on (tar.id=p.id_tarif)
--left join sap_energo_tarif as tar_sap on tar_sap.id_tar = p.id_tarif
left join eqi_grouptarif_tbl as tgr on tgr.id= p.id_grouptarif
left join eqi_classtarif_tbl as tcl on (p.id_classtarif=tcl.id) 
--left join reading_controller as w on w.tabel_numb = p.num_tab
left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp) 
left join (select code_eqp, trim(sum(e.name||','),',') as energy from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en on (en.code_eqp = p.code_eqp)
where (c2.code>999 or c2.code=900) AND coalesce(c2.idk_work,0)<>0 or (c2.code=999 and use.code_eqp is not null) 
	     and  c2.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001') 
) q
inner join sap_const const on 1=1
left join ed_sch eds on q.code_eqp=eds.code_tu::int
left join ed_sch_dop eds1 on q.code_eqp=eds1.code_tu::int
left join eqm_compens_station_inst_tbl ar on ar.code_eqp=q.code_eqp
left join sap_evbsd yy on coalesce(right(yy.oldkey,length(trim(ar.code_eqp_inst::text)))::int,0)=ar.code_eqp_inst
left join eqm_eqp_use_tbl use on use.code_eqp=q.code_eqp
left join clm_client_tbl www on www.id=coalesce(q.id_cl,use.id_client)
left join tarif_sap_energo u on trim(u.name)=trim(q.vid_trf)
where ar.code_eqp_inst is not null and yy.oldkey is not null
order by q.code_eqp
";

        if ($res==4)
        $sql = "SELECT distinct q.code_eqp as id,ar.code_eqp_inst,yy.oldkey as vstelle,''::char(20) as vstelle1,'10' as sparte,
const.ver,const.begru_all as begru,coalesce(eds.ed_sch,eds1.ed_sch) as ableinh,
case when www.code=900  or (q.code_eqp=118522 and $res=5) or (q.code_eqp=120129 and $res=4) then 'CK_4HN2_01' else u.tarif_sap end as tarif_sap,
q.* from (
select  distinct 'DATA' as DATA,c.id as id_cl,c.idk_work,
case when p.voltage_max = 0.22 then '02'
     when p.voltage_max = 0.4 then '03'
     when p.voltage_max = 10.00 then '05' 
     when p.voltage_max = 6.0 then '04'
     when p.voltage_max = 27.5 then '06'
     when p.voltage_max = 35.0 then '07'
     when p.voltage_max = 150.0 then '16'
     when p.voltage_max = 110.0 then '08' else '-' end as SPEBENE,
'0001' as ANLART,
'0002' as ABLESARTST,
p.name_eqp as ZZ_NAMETU,
p.eic_code as zz_eic,
p.code_eqp,
'' as ZZ_FIDER,
'$date_ab'::char(10) as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'  
     when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???' 
     else 
	case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???' 
	else '???' --tar_sap.id_sap_tar 
	end 
end  as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
--case when c.code = '900' then '0004' else '0002' end as AKLASSE,
case when c.code = '900' or (p.code_eqp=118522 and $res=5) or (p.code_eqp=120129 and $res=4) 
then '0004' else '0002' end as AKLASSE,
    -- 'PC010131' as ABLEINH,
    -- eds.ed_sch as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
     when tgr.ident in('tgr2') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
     when tgr.ident in('tgr6') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
     when tgr.ident in('tgr3') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
     when tgr.ident in('tgr4') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
     when tgr.ident in('tgr1') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999)  then '054'
     when tgr.ident in('tgr2') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
     when tgr.ident in('tgr6') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
     when tgr.ident in('tgr3') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
     when tgr.ident in('tgr4') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
     when tgr.ident in('tgr8_10','tgr8_30') then '298'
     when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
     when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '352'
     when ((tgr.ident ~ 'tgr7_12') or (tgr.ident~ 'tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007)  in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)  and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521'  and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and  tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and  tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10  and tcl.ident='tcl1' then '604'
when c.idk_work=99 and p.voltage_min<=10 and tcl.ident='tcl2' then '606'
when tcl.ident='tcl1' and p.id_extra =1003 then '632'
when tcl.ident='tcl2' and p.id_extra =1003 then '634'
when tcl.ident='tcl1' and p.id_extra in (1001,1002,1012,1013) then '638'
when tcl.ident='tcl2' and p.id_extra in (1001,1002,1012,1013) then '640'
when tgr.ident in('tgr8_101') then '666'
 else '' end as ZZCODE4NKRE,
'' as ZZCODE4NKRE_DOP,
'' as ZZOTHERAREA,
'1' as sort 
from (select eq.num_eqp as eic_code,tr.name as vid_trf,dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, tr.id_grouptarif --, ph.id_extra --, tr.id_classtarif
	from eqm_equipment_tbl as eq 
	
	 join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	 join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) 
	left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) 
	left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
	left join eqk_zone_tbl AS z on (dt.zone=z.id) 
	left join cla_param_tbl AS cla on (dt.id_depart=cla.id) 
	left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
	left join clm_position_tbl as cp on (cp.id = dt.id_position) 
	where eq.type_eqp=12 and substr(trim(eq.num_eqp)::text,1,3)='62Z' 
	and eq.id not in(120745,120741)
	) as p 
 join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
 join eqm_tree_tbl as t on (t.id = tt.id_tree) 
 join (select distinct id,code,idk_work from clm_client_tbl) as c on (c.id = t.id_client) 
left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
left join clm_statecl_tbl as st on (st.id_client = c2.id) 
left join aci_tarif_tbl as tar on (tar.id=p.id_tarif)
--left join sap_energo_tarif as tar_sap on tar_sap.id_tar = p.id_tarif
left join eqi_grouptarif_tbl as tgr on tgr.id= p.id_grouptarif
left join eqi_classtarif_tbl as tcl on (p.id_classtarif=tcl.id) 
--left join reading_controller as w on w.tabel_numb = p.num_tab
left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp) 
left join (select code_eqp, trim(sum(e.name||','),',') as energy from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en on (en.code_eqp = p.code_eqp)
where (c2.code>999 or c2.code=900) AND coalesce(c2.idk_work,0)<>0 or (c2.code=999 and use.code_eqp is not null) 
	     and  c2.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001') 
) q
inner join sap_const const on 1=1
left join ed_sch eds on q.code_eqp=eds.code_tu::int
left join ed_sch_dop eds1 on q.code_eqp=eds1.code_tu::int
left join eqm_compens_station_inst_tbl ar on ar.code_eqp=q.code_eqp
left join sap_evbsd yy on coalesce(right(yy.oldkey,length(trim(ar.code_eqp_inst::text)))::int,0)=ar.code_eqp_inst
left join eqm_eqp_use_tbl use on use.code_eqp=q.code_eqp
left join clm_client_tbl www on www.id=coalesce(q.id_cl,use.id_client)
left join tarif_sap_energo u on trim(u.name)=trim(q.vid_trf)
where ar.code_eqp_inst is not null and yy.oldkey is not null
order by q.code_eqp
";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

//        $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();

//debug($data);
//return;

        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур

        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры

        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        // нет объекта высшего уровня {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
        if (!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
        // нет объекта высшего уровня }


        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }

        }
        // пустая ссылка }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }


    // Формирование файла zsign_ca(подписанты)  для САП для юридических потребителей
    public function actionSap_zsign_ca($res)
    {

        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        // Главный запрос со всеми необходимыми данными
        $sql = "select a.*,c.oldkey || '_' || row_number() over(partition by a.vkont) as oldkey_true ,row_number() over(partition by a.vkont) as id1,c.oldkey as ref_acc from sap_signers a
    left join clm_client_tbl b on a.vkont::int=b.code
    inner join sap_vk c on b.id=substr(c.oldkey,9)::int
    where last_name2<>'' and last_name2 is not null
    order by 2   ";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

//        debug($data);
//        return;

        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур

        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        $i = 0;
        foreach ($data as $w) {
            $zsign[$i] = f_zsign_ca($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = '8';
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($zsign as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");

            $i++;
        }

        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла zpay_ca(схема платежей)  для САП для юридических потребителей
    public function actionSap_zpay_ca($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        // Главный запрос со всеми необходимыми данными
        $sql = "select b.oldkey as oldkey_acc,a.*,b.oldkey||'_PAY' as oldkey_pay from sap_payment_scheme a 
                 right join sap_init_acc b on trim(a.vkont)=trim(b.vkona) ";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

//        debug($data);
//        return;

        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур

        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        $i = 0;
        foreach ($data as $w) {
            $zsign[$i] = f_zpay_ca($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = '8';
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        $i = 0;
        foreach ($zsign as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");

            $i++;
        }

        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл ZPAY_CA сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

        // Формирование файла instlncha (субпотребители) - САП для юридических потребителей
    public function actionSap_instlncha($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

// Главный запрос со всеми необходимыми данными


//$sql = "select q.*,'*' as div,i.*,
//j.oldkey||'_'||row_number() OVER (partition BY j.oldkey,q.code_ust) as oldkey_m,
//i.oldkey||'_'||row_number() OVER (partition BY i.oldkey) as oldkey_r,
//j.vstelle as vstelle_m,j.spebene as spebene_m,j.anlart as anlart_m,




        $sql = "select q.*,'*' as div,i.*,
j.oldkey as oldkey_m,j.vstelle as vstelle_m,j.spebene as spebene_m,j.anlart as anlart_m,

j.ablesartst as ablesartst_m,j.zz_nametu as zz_nametu_m,j.zz_fider as zz_fider_m,
j.ab as ab_m,j.tariftyp as tariftyp_m,j.branche as branche_m,j.aklasse as aklasse_m,
j.ableinh as ableinh_m,j.zzcode4nkre as zzcode4nkre_m,j.zzcode4nkre_dop as zzcode4nkre_dop_m,
j.zzotherarea as zzotherarea_m,j.begru as begru_m,j.zz_eic as zz_eic_m
from (
Select tr.id_client,cl2.name,tr.name,tr.code_eqp,tt.lvl,cl.name as name_sub,eq.id,get_tu2(eq.id) as code_ust,
get_counter(eq.id) as code_sub
from eqm_tree_tbl tr
left join eqm_eqp_tree_tbl AS tt on tr.id=tt.id_tree
JOIN eqm_equipment_tbl AS eq ON (tt.code_eqp=eq.id)
JOIN (eqi_device_kinds_tbl AS dk JOIN eqi_device_kinds_prop_tbl AS dkp ON (dk.id=dkp.type_eqp)) ON (eq.type_eqp=dk.id)
left join eqm_borders_tbl as b on (b.code_eqp=eq.id) 
left join clm_client_tbl as cl on (cl.id=b.id_clientb)
left join clm_client_tbl as cl2 on (cl2.id=tr.id_client)
WHERE 
tt.code_eqp_e is not null and b.id_clientb is not null 
) q
inner join sap_data as i on substr(i.oldkey,12)::int=q.code_sub 
inner join sap_data as j on substr(j.oldkey,12)::int=q.code_ust 
where code_sub is not null and id_client<>2062
and case when $res=1 then id_client not in(10408,10312,11843,162582,12527) else 1=1 end
order by code_ust,lvl";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

//        debug($data);
//        return;

        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Удаляем данные в таблицах структур

//        $i=0;
//        foreach ($cnt as $v) {
//            $i++;
//            $n_struct = trim($v['dattype']);
//            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
//            $zsql = "delete from sap_".strtolower($n_struct);
//            exec_on_server($zsql,$res,$vid);
//        }

//        debug($data);
//        return;

        // Заполняем структуры
        $i = 0;
        $q = count($data);
        if ($q > 0)
            $ust = $data[0]['code_ust'];
        else
            $ust = '';
        $zsub = [];
        $kol = 0;

//        debug($data);
//        debug($q);
//        debug($ust);
        //return;
        $j = 0;
        foreach ($data as $v) {
            $ust1=$v['code_ust'];
            $kol++;
            $i_status=0;
            if($kol>=$q) $i_status=1;
//            while($i_status==0) {
            if ($ust1 == $ust) {
                $j++;
                if ($j == 1) {
                    // Запись информации по главной установке
                    $oldkey = $v['oldkey_m'];
                    $spebene = $v['spebene_m'];
                    $anlart = $v['anlart_m'];
                    $vstelle = $v['vstelle_m'];
                    $ablesartst = $v['ablesartst_m'];
                    $zz_nametu = $v['zz_nametu_m'];
                    $zz_fider = $v['zz_fider_m'];
                    $ab = $v['ab_m'];
                    $tariftyp = $v['tariftyp_m'];
                    $branche = $v['branche_m'];
                    $aklasse = $v['aklasse_m'];
                    $ableinh = $v['ableinh_m'];
                    $zzcode4nkre = $v['zzcode4nkre_m'];
                    $zzcode4nkre_dop = $v['zzcode4nkre_dop_m'];
                    $zzotherarea = $v['zzotherarea_m'];
                    $begru = $v['begru_m'];
                    $zz_eic = $v['zz_eic_m'];
                    $maininst = '';
                    $instrole = '';
                    $instgrtype = '0002';
                    $highlevinst = '';

                    $zsub[$i][0]=$oldkey;
                    $zsub[$i][1]='DATA';
                    $zsub[$i][2]=$vstelle;
                    $zsub[$i][3]=$spebene;
                    $zsub[$i][4]=$anlart;
                    $zsub[$i][5]=$ablesartst;
                    $zsub[$i][6]=$zz_nametu;
                    $zsub[$i][7]=$zz_fider;
                    $zsub[$i][8]=$ab;
                    $zsub[$i][9]=$tariftyp;
                    $zsub[$i][10]=$branche;
                    $zsub[$i][11]=$aklasse;
                    $zsub[$i][12]=$ableinh;
                    $zsub[$i][13]=$maininst;
                    $zsub[$i][14]=$instrole;
                    $zsub[$i][15]=$instgrtype;
                    $zsub[$i][16]=$highlevinst;
                    $zsub[$i][17]=$zzcode4nkre;
                    $zsub[$i][18]=$zzcode4nkre_dop;
                    $zsub[$i][19]=$zzotherarea;
                    $zsub[$i][20]=$begru;
                    $zsub[$i][21]=$zz_eic;
                    $i++;
                }
                // Запись информации по субпотребителю
                $oldkey = $v['oldkey'];
                $spebene = $v['spebene'];
                $anlart = $v['anlart'];
                $vstelle = $v['vstelle'];
                $ablesartst = $v['ablesartst'];
                $zz_nametu = $v['zz_nametu'];
                $zz_fider = $v['zz_fider'];
                $ab = $v['ab'];
                $tariftyp = $v['tariftyp'];
                $branche = $v['branche'];
                $aklasse = $v['aklasse'];
                $ableinh = $v['ableinh'];
                $zzcode4nkre = $v['zzcode4nkre'];
                $zzcode4nkre_dop = $v['zzcode4nkre_dop'];
                $zzotherarea = $v['zzotherarea'];
                $begru = $v['begru'];
                $zz_eic = $v['zz_eic'];
                $maininst = $v['oldkey_m'];
                $instrole = 'VL_N';
                $instgrtype = '';
                $highlevinst = $v['oldkey_m'];

                $zsub[$i][0]=$oldkey;
                $zsub[$i][1]='DATA';
                $zsub[$i][2]=$vstelle;
                $zsub[$i][3]=$spebene;
                $zsub[$i][4]=$anlart;
                $zsub[$i][5]=$ablesartst;
                $zsub[$i][6]=$zz_nametu;
                $zsub[$i][7]=$zz_fider;
                $zsub[$i][8]=$ab;
                $zsub[$i][9]=$tariftyp;
                $zsub[$i][10]=$branche;
                $zsub[$i][11]=$aklasse;
                $zsub[$i][12]=$ableinh;
                $zsub[$i][13]=$maininst;
                $zsub[$i][14]=$instrole;
                $zsub[$i][15]=$instgrtype;
                $zsub[$i][16]=$highlevinst;
                $zsub[$i][17]=$zzcode4nkre;
                $zsub[$i][18]=$zzcode4nkre_dop;
                $zsub[$i][19]=$zzotherarea;
                $zsub[$i][20]=$begru;
                $zsub[$i][21]=$zz_eic;
                $i++;
            }
            else {
                $ust = $ust1;
                $i_status=1;
                $j=1;

                // Запись информации по главной установке
                $oldkey = $v['oldkey_m'];
                $spebene = $v['spebene_m'];
                $anlart = $v['anlart_m'];
                $vstelle = $v['vstelle_m'];
                $ablesartst = $v['ablesartst_m'];
                $zz_nametu = $v['zz_nametu_m'];
                $zz_fider = $v['zz_fider_m'];
                $ab = $v['ab_m'];
                $tariftyp = $v['tariftyp_m'];
                $branche = $v['branche_m'];
                $aklasse = $v['aklasse_m'];
                $ableinh = $v['ableinh_m'];
                $zzcode4nkre = $v['zzcode4nkre_m'];
                $zzcode4nkre_dop = $v['zzcode4nkre_dop_m'];
                $zzotherarea = $v['zzotherarea_m'];
                $begru = $v['begru_m'];
                $zz_eic = $v['zz_eic_m'];
                $maininst = '';
                $instrole = '';
                $instgrtype = '0002';
                $highlevinst = '';

                $zsub[$i][0]=$oldkey;
                $zsub[$i][1]='DATA';
                $zsub[$i][2]=$vstelle;
                $zsub[$i][3]=$spebene;
                $zsub[$i][4]=$anlart;
                $zsub[$i][5]=$ablesartst;
                $zsub[$i][6]=$zz_nametu;
                $zsub[$i][7]=$zz_fider;
                $zsub[$i][8]=$ab;
                $zsub[$i][9]=$tariftyp;
                $zsub[$i][10]=$branche;
                $zsub[$i][11]=$aklasse;
                $zsub[$i][12]=$ableinh;
                $zsub[$i][13]=$maininst;
                $zsub[$i][14]=$instrole;
                $zsub[$i][15]=$instgrtype;
                $zsub[$i][16]=$highlevinst;
                $zsub[$i][17]=$zzcode4nkre;
                $zsub[$i][18]=$zzcode4nkre_dop;
                $zsub[$i][19]=$zzotherarea;
                $zsub[$i][20]=$begru;
                $zsub[$i][21]=$zz_eic;
                $i++;

                // Запись информации по субпотребителю
                $oldkey = $v['oldkey'];
                $spebene = $v['spebene'];
                $anlart = $v['anlart'];
                $vstelle = $v['vstelle'];
                $ablesartst = $v['ablesartst'];
                $zz_nametu = $v['zz_nametu'];
                $zz_fider = $v['zz_fider'];
                $ab = $v['ab'];
                $tariftyp = $v['tariftyp'];
                $branche = $v['branche'];
                $aklasse = $v['aklasse'];
                $ableinh = $v['ableinh'];
                $zzcode4nkre = $v['zzcode4nkre'];
                $zzcode4nkre_dop = $v['zzcode4nkre_dop'];
                $zzotherarea = $v['zzotherarea'];
                $begru = $v['begru'];
                $zz_eic = $v['zz_eic'];
                $maininst = $v['oldkey_m'];
                $instrole = 'VL_N';
                $instgrtype = '';
                $highlevinst = $v['oldkey_m'];

                $zsub[$i][0]=$oldkey;
                $zsub[$i][1]='DATA';
                $zsub[$i][2]=$vstelle;
                $zsub[$i][3]=$spebene;
                $zsub[$i][4]=$anlart;
                $zsub[$i][5]=$ablesartst;
                $zsub[$i][6]=$zz_nametu;
                $zsub[$i][7]=$zz_fider;
                $zsub[$i][8]=$ab;
                $zsub[$i][9]=$tariftyp;
                $zsub[$i][10]=$branche;
                $zsub[$i][11]=$aklasse;
                $zsub[$i][12]=$ableinh;
                $zsub[$i][13]=$maininst;
                $zsub[$i][14]=$instrole;
                $zsub[$i][15]=$instgrtype;
                $zsub[$i][16]=$highlevinst;
                $zsub[$i][17]=$zzcode4nkre;
                $zsub[$i][18]=$zzcode4nkre_dop;
                $zsub[$i][19]=$zzotherarea;
                $zsub[$i][20]=$begru;
                $zsub[$i][21]=$zz_eic;
                $i++;
            }
        }


//        debug($zsub);
//        return;

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver='8';
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        $i=0;
        foreach ($zsub as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $d1[0]."\t".'KEY'."\t".$d1[0]);
            fputs($f, "\n");
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0]."\t".'&ENDE');
            fputs($f, "\n");

            $i++;
        }

        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл INSTLNCHA сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла линий(zlines) для САП для юридических потребителей
    public function actionSap_zlines($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

//        $sql_f = "select eqm_schema_point_fun()";
//        $data_f = data_from_server($sql_f, $res, $vid);

        // Главный запрос со всеми необходимыми данными
        $sql_old = "
select * from (
              select DISTINCT on(p.code_eqp) p.type_eqp as id_type_eqp,c.code,c.idk_work,p.id_point, p2.name_point, p.code_eqp, p.name, p.lvl, p.type_eqp, RANK() OVER(PARTITION BY p.id_point ORDER BY p.lvl desc) as pnt, 
                case when p.type_eqp=6 then replace(round(line_c.length::numeric/1000,3)::varchar, '.', ',')
                    when p.type_eqp=7 then replace(round(line_a.length::numeric/1000,3)::varchar, '.', ',')
                end as line_length,
                case when p.type_eqp=6 then sap_c.m
                    when p.type_eqp=7 then sap_l.m
                end as line_voltage_nom,
                case when p.type_eqp=2 then trim(coalesce(sap_tr.trtyp,eqk.type))
                    when p.type_eqp=6 then trim(coalesce(sap_cable.id_sap,cable.type))
                    when p.type_eqp=7 then trim(coalesce(sap_line.id_sap,corde.type))
                end as type_eqp,  
                case when p.type_eqp=7 then 'ПЛ: '||trim(corde.type)||';  R0='||round(corde.ro,3)||' X0='||round(corde.xo,3) end as line_text,
                case when p.type_eqp=6 then 'КЛ: '||trim(cable.type)||';  R0='||round(cable.ro,3)||coalesce(' X0='||round(cable.xo,3),'') end as cable_text,
                case when p.type_eqp=2 then trim(eqk.type) end as compensator_text,
                p.name as text, p.type_eqp as id_type_eqp,
                case when eqk.swathe=2 then '2L' 
                    when eqk.swathe=2 then '3L'
                end as swathe,
                case when length(p.id_point::varchar)>7 then p.id_point else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.id_point::varchar)::int)),(7-(length(p.id_point::varchar)::int)))||p.id_point::varchar)::int end as instln_key,
		       case when length(p.code_eqp::varchar)>7 then p.code_eqp else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.code_eqp::varchar)::int)),(7-(length(p.code_eqp::varchar)::int)))||p.code_eqp::varchar)::int end as oldkey,
		       const.ver as ver,
		       coalesce(v.id_sap,v1.id_sap) as id_sap,
		       case when v.normative is null or trim(v.normative)='' then case when u.voltage_min is null then uu2.u_sap else coalesce(uu1.u_sap,uu2.u_sap) end 
		       else case when v1.normative is not null then v1.normative::dec(6,2) else coalesce(uu1.u_sap,uu2.u_sap) end end as voltage			
                from tmp_eqm_schema_point_tbl as p
                join (select id_point, name as name_point from tmp_eqm_schema_point_tbl where type_eqp=12 and id_point=code_eqp) as p2 on (p.id_point=p2.id_point)
                left join eqm_line_a_tbl as line_a on (line_a.code_eqp=p.code_eqp)
                left join eqm_line_c_tbl as line_c on (line_c.code_eqp=p.code_eqp)
                left join eqk_voltage_tbl as u on u.id=line_a.id_voltage
                left join eqk_voltage_tbl as u1 on u1.id=line_c.id_voltage
                left join eqi_corde_tbl as corde on (corde.id=line_a.id_type_eqp)
                left join eqi_cable_tbl as cable on (cable.id=line_c.id_type_eqp)
                left join eqm_compensator_tbl AS eqd on (eqd.code_eqp=p.code_eqp) 
                left join eqi_compensator_tbl AS eqk on (eqd.id_type_eqp=eqk.id) 
                left join sap_type_tr_2w_tbl as sap_tr on (sap_tr.id_type=eqk.id)
                left join cabels_soed as sap_cable on (sap_cable.id_en=cable.id and sap_cable.type_cab=1)
                left join cabels_soed as sap_line on (sap_line.id_en=corde.id and sap_line.type_cab=2)
                left join cabels as sap_c on (sap_c.a=sap_cable.id_sap)
                left join cabels as sap_l on (sap_l.a=sap_line.id_sap)
                left join sap_lines as v on v.id::int=cable.id  and v.kod_res='$res' --and (v.normative is null or trim(v.normative)='')
                left join sap_lines as v1 on v1.id::int=corde.id  and v1.kod_res='$res' --and (v1.normative is not null and trim(v1.normative)<>'')
                left join voltage_line uu1 on u.voltage_min=uu1.u_our
                left join voltage_line uu2 on u1.voltage_min=uu2.u_our
                left join eqm_eqp_use_tbl as use on (use.code_eqp = p.id_point) 
                left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = p.id_point
                left join eqm_tree_tbl tr on tr.id = ttr.id_tree
                left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                inner join sap_const const on 1=1   
                where p.type_eqp not in (1,12,3,4,5,9,15,16,17)  -- and p.loss_power=1  -- and  p.type_eqp<>2
                ) r
                where (code>999 or code=900) AND coalesce(idk_work,0)<>0
	        and  code not in(20000556,20000565,20000753,
	       20555555,20888888,20999999,30999999,40999999,41000000,42000000,43000000,
	       10999999,11000000,19999369,50999999,1000000,1000001)
	       ORDER BY 6
                ";
       $z_sql = 'select * from get_schema()';

        $sql="select * from (
            select DISTINCT on(p.code_eqp) p.type_eqp as id_type_eqp,c.code,c.idk_work,p.id_point, p.name_point, p.code_eqp, p.name, p.lvl, p.type_eqp, 
            RANK() OVER(PARTITION BY p.id_point ORDER BY p.lvl desc) as pnt, 
                case when p.type_eqp=6 then replace(round(line_c.length::numeric/1000,3)::varchar, '.', ',')
                    when p.type_eqp=7 then replace(round(line_a.length::numeric/1000,3)::varchar, '.', ',')
                end as line_length,
                case when p.type_eqp=6 then sap_c.m
                    when p.type_eqp=7 then sap_l.m
                end as line_voltage_nom,
                case when p.type_eqp=2 then trim(coalesce(sap_tr.trtyp,eqk.type))
                    when p.type_eqp=6 then trim(coalesce(sap_cable.id_sap,cable.type))
                    when p.type_eqp=7 then trim(coalesce(sap_line.id_sap,corde.type))
                end as type_eqp,  
                case when p.type_eqp=7 then 'ПЛ: '||trim(corde.type)||';  R0='||round(corde.ro,3)||' X0='||round(corde.xo,3) end as line_text,
                case when p.type_eqp=6 then 'КЛ: '||trim(cable.type)||';  R0='||round(cable.ro,3)||coalesce(' X0='||round(cable.xo,3),'') end as cable_text,
                case when p.type_eqp=2 then trim(eqk.type) end as compensator_text,
                p.name as text, p.type_eqp as id_type_eqp,
                case when eqk.swathe=2 then '2L' 
                    when eqk.swathe=2 then '3L'
                end as swathe,
                case when length(p.id_point::varchar)>7 then p.id_point else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.id_point::varchar)::int)),(7-(length(p.id_point::varchar)::int)))||p.id_point::varchar)::int end as instln_key,
		       case when length(p.code_eqp::varchar)>7 then p.code_eqp else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.code_eqp::varchar)::int)),(7-(length(p.code_eqp::varchar)::int)))||p.code_eqp::varchar)::int end as oldkey,
		       const.ver as ver,
		       coalesce(v.id_sap,v1.id_sap) as id_sap,
		       case when v.normative is null or trim(v.normative)='' then case when u.voltage_min is null then uu2.u_sap else coalesce(uu1.u_sap,uu2.u_sap) end 
		       else case when v1.normative is not null then v1.normative::dec(6,2) else coalesce(uu1.u_sap,uu2.u_sap) end end as voltage			
                from (select x.*,eq.name_eqp as name_point from (
        select a.id as code_eqp,get_equipment_m(a.id,6,12,$res) as id_point,
                a.type_eqp,a.name_eqp as name,
                b.lvl,c.idk_work,c.book,c.code 
                from eqm_equipment_tbl a 
                left join eqm_eqp_tree_tbl b on a.id=b.code_eqp
                left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
	        left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
	        left join eqm_tree_tbl tr on tr.id = ttr.id_tree
	        left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                where a.type_eqp in(6,7) --and a.is_owner=1
    and COALESCE(c.idk_work,0) not in (0) and c.book=-1
    and (coalesce(c.code,0)>999 or coalesce(c.code,0)=900)
    and  coalesce(c.code,0) not in(20000556,20000565,20000753,
        20555555,20888888,20999999,30999999,40999999,41000000,42000000,43000000,
        10999999,11000000,19999369,50999999,1000000,1000001)  
                ) x
                left join eqm_equipment_tbl eq on eq.id=x.id_point
                order by 1) as p
                left join eqm_line_a_tbl as line_a on (line_a.code_eqp=p.code_eqp)
                left join eqm_line_c_tbl as line_c on (line_c.code_eqp=p.code_eqp)
                left join eqk_voltage_tbl as u on u.id=line_a.id_voltage
                left join eqk_voltage_tbl as u1 on u1.id=line_c.id_voltage
                left join eqi_corde_tbl as corde on (corde.id=line_a.id_type_eqp)
                left join eqi_cable_tbl as cable on (cable.id=line_c.id_type_eqp)
                left join eqm_compensator_tbl AS eqd on (eqd.code_eqp=p.code_eqp) 
                left join eqi_compensator_tbl AS eqk on (eqd.id_type_eqp=eqk.id) 
                left join sap_type_tr_2w_tbl as sap_tr on (sap_tr.id_type=eqk.id)
                left join cabels_soed as sap_cable on (sap_cable.id_en=cable.id and sap_cable.type_cab=1)
                left join cabels_soed as sap_line on (sap_line.id_en=corde.id and sap_line.type_cab=2)
                left join cabels as sap_c on (sap_c.a=sap_cable.id_sap)
                left join cabels as sap_l on (sap_l.a=sap_line.id_sap)
                left join sap_lines as v on v.id::int=cable.id  and v.kod_res='$res' --and (v.normative is null or trim(v.normative)='')
                left join sap_lines as v1 on v1.id::int=corde.id  and v1.kod_res='$res' --and (v1.normative is not null and trim(v1.normative)<>'')
                left join voltage_line uu1 on u.voltage_min=uu1.u_our
                left join voltage_line uu2 on u1.voltage_min=uu2.u_our
                left join eqm_eqp_use_tbl as use on (use.code_eqp = p.id_point) 
                left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = p.id_point
                left join eqm_tree_tbl tr on tr.id = ttr.id_tree
                left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                inner join sap_const const on 1=1   
                where p.type_eqp not in (1,12,3,4,5,9,15,16,17)  -- and p.loss_power=1  -- and  p.type_eqp<>2
                ) r
                where case when '$res'='5' then id_sap is not null and trim(id_sap)<>'' else 1=1 end
                and  case when '$res'='4' then code_eqp not in(116758,116766,117269,118413)  else 1=1 end
                and  case when '$res'='3' then code_eqp not in(107239,107747,107870,113325,107259)  else 1=1 end
                and  case when '$res'='2' then code_eqp not in(108033,109456,110357,113908,113915,114059,232344,
               1057436,1103582,1228227,1302623)  else 1=1 end   
               and  case when '$res'='1' then code_eqp not in(114760,121176,118475,149669,122030,122872,
               122878,123103,123108,123124,124528,124540,143928,146434,146469,146804,146888,
               148961,149139,149589,149610,150130,159139,159301,142991,142992,142993,143000,143001,
               143002,144466,148340)  else 1=1 end 
    	       ORDER BY 6";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data_1 = data_from_server($z_sql, $res, $vid);   // Заполнение таблицы схемы оборудования
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

//        debug($data);
//        return;

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур
        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct) . '_zlines';

            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        $oldkey_const = '04_C' . $rem . 'P_01_';

        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);

                // Запись в _ext файл
                $_ext[0] = 'ZLINES';
                $_ext[1] = $oldkey_const . $w['code_eqp'];
                $_ext[2] = '';
                $_ext[3] = $w['name_point'];

                $d1 = array_map('trim', $_ext);
                $s1 = implode("\t", $d1);
                $s1 = str_replace("~", "", $s1);
                $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                fputs($f, $s1);
                fputs($f, "\n");
            }
        }
        fclose($f);

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct" . "_zlines";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']) . '_zlines';
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        // нет объекта высшего уровня {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
        if (!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
        // нет объекта высшего уровня }

        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }

        }
        // пустая ссылка }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }

    // Формирование файла трансформаторов (ztransf) для САП для юридических потребителей
    public function actionSap_ztransf($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        // Главный запрос со всеми необходимыми данными
        $sql_old = "select * from (
            select p.type_eqp as id_type_eqp,c.code,c.idk_work,p.id_point, p2.name_point, p.code_eqp, p.name, p.lvl, p.type_eqp, RANK() OVER(PARTITION BY p.id_point ORDER BY p.lvl desc) as pnt, 
                case when p.type_eqp=6 then replace(round(line_c.length::numeric/1000,3)::varchar, '.', ',')
                    when p.type_eqp=7 then replace(round(line_a.length::numeric/1000,3)::varchar, '.', ',')
                end as line_length,
                case when p.type_eqp=6 then sap_c.m
                    when p.type_eqp=7 then sap_l.m
                end as line_voltage_nom,
                case when p.type_eqp=2 then trim(coalesce(sap_tr.trtyp,eqk.type))
                    when p.type_eqp=6 then trim(coalesce(sap_cable.id_sap,cable.type))
                    when p.type_eqp=7 then trim(coalesce(sap_line.id_sap,corde.type))
                end as type_eqp,  
                case when p.type_eqp=7 then 'ПЛ: '||trim(corde.type)||';  R0='||round(corde.ro,3)||' X0='||round(corde.xo,3) end as line_text,
                case when p.type_eqp=6 then 'КЛ: '||trim(cable.type)||';  R0='||round(cable.ro,3)||coalesce(' X0='||round(cable.xo,3),'') end as cable_text,
                case when p.type_eqp=2 then trim(eqk.type) end as compensator_text,
                p.name as text, p.type_eqp as id_type_eqp,
                case when eqk.swathe=2 then '2L' 
                    when eqk.swathe=3 then '3L'
                end as swathe,
                case when length(p.id_point::varchar)>7 then p.id_point else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.id_point::varchar)::int)),(7-(length(p.id_point::varchar)::int)))||p.id_point::varchar)::int end as instln_key,
		      case when length(p.code_eqp::varchar)>7 then p.code_eqp else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.code_eqp::varchar)::int)),(7-(length(p.code_eqp::varchar)::int)))||p.code_eqp::varchar)::int end as oldkey,
		       const.ver as ver,v.id_sap		
                from tmp_eqm_schema_point_tbl as p
                join (select id_point, name as name_point from tmp_eqm_schema_point_tbl where type_eqp=12 and id_point=code_eqp) as p2 on (p.id_point=p2.id_point)
                left join eqm_line_a_tbl as line_a on (line_a.code_eqp=p.code_eqp)
                left join eqm_line_c_tbl as line_c on (line_c.code_eqp=p.code_eqp)
                left join eqi_corde_tbl as corde on (corde.id=line_a.id_type_eqp)
                left join eqi_cable_tbl as cable on (cable.id=line_c.id_type_eqp)
                left join eqm_compensator_tbl AS eqd on (eqd.code_eqp=p.code_eqp) 
                left join eqi_compensator_tbl AS eqk on (eqd.id_type_eqp=eqk.id) 
                left join sap_type_tr_2w_tbl as sap_tr on (sap_tr.id_type=eqk.id)
                left join cabels_soed as sap_cable on (sap_cable.id_en=cable.id and sap_cable.type_cab=1)
                left join cabels_soed as sap_line on (sap_line.id_en=corde.id and sap_line.type_cab=2)
                left join cabels as sap_c on (sap_c.a=sap_cable.id_sap)
                left join cabels as sap_l on (sap_l.a=sap_line.id_sap)
                left join eqm_eqp_use_tbl as use on (use.code_eqp = p.id_point) 
                 left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = p.id_point
                left join eqm_tree_tbl tr on tr.id = ttr.id_tree
                left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                
                left join sap_transf as v on (v.id::int=eqk.id and v.kod_res=$res)
                
                inner join sap_const const on 1=1   
                where p.type_eqp not in (1,12,3,4,5,9,15,16,17) -- and p.loss_power=1 
                
               -- and  p.type_eqp=2
               -- order by p.id_point, p.lvl desc
                order by 1) r
                where (code>999 or code=900) AND coalesce(idk_work,0)<>0
	        and  code not in(20000556,20000565,20000753,
	       20555555,20888888,20999999,30999999,40999999,41000000,42000000,43000000,
	       10999999,11000000,19999369,50999999,1000000,1000001)
                ";

//  New query
        $sql="select * from (
            select p.type_eqp as id_type_eqp,c.code,c.idk_work,p.id_point, p.name_point, p.code_eqp, p.name, p.lvl, p.type_eqp, RANK() OVER(PARTITION BY p.id_point ORDER BY p.lvl desc) as pnt, 
                case when p.type_eqp=6 then replace(round(line_c.length::numeric/1000,3)::varchar, '.', ',')
                    when p.type_eqp=7 then replace(round(line_a.length::numeric/1000,3)::varchar, '.', ',')
                end as line_length,
                case when p.type_eqp=6 then sap_c.m
                    when p.type_eqp=7 then sap_l.m
                end as line_voltage_nom,
                case when p.type_eqp=2 then trim(coalesce(sap_tr.trtyp,eqk.type))
                    when p.type_eqp=6 then trim(coalesce(sap_cable.id_sap,cable.type))
                    when p.type_eqp=7 then trim(coalesce(sap_line.id_sap,corde.type))
                end as type_eqp,  
                case when p.type_eqp=7 then 'ПЛ: '||trim(corde.type)||';  R0='||round(corde.ro,3)||' X0='||round(corde.xo,3) end as line_text,
                case when p.type_eqp=6 then 'КЛ: '||trim(cable.type)||';  R0='||round(cable.ro,3)||coalesce(' X0='||round(cable.xo,3),'') end as cable_text,
                case when p.type_eqp=2 then trim(eqk.type) end as compensator_text,
                p.name as text, p.type_eqp as id_type_eqp,
                case when eqk.swathe=2 then '2L' 
                    when eqk.swathe=3 then '3L'
                end as swathe,
                case when length(p.id_point::varchar)>7 then p.id_point else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.id_point::varchar)::int)),(7-(length(p.id_point::varchar)::int)))||p.id_point::varchar)::int end as instln_key,
		      case when length(p.code_eqp::varchar)>7 then p.code_eqp else (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(p.code_eqp::varchar)::int)),(7-(length(p.code_eqp::varchar)::int)))||p.code_eqp::varchar)::int end as oldkey,
		       const.ver as ver,v.id_sap,eq.is_owner		
                from (
select x.*,eq.name_eqp as name_point from (
select a.id as code_eqp,get_equipment_m(a.id,2,12,$res) as id_point,
                a.type_eqp,a.name_eqp as name,
                b.lvl,c.idk_work,c.book,c,code 
                from eqm_equipment_tbl a 
                left join eqm_eqp_tree_tbl b on a.id=b.code_eqp
                left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
	        left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
	        left join eqm_tree_tbl tr on tr.id = ttr.id_tree
	        left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                where a.type_eqp=2 and a.is_owner=1 
                and COALESCE(c.idk_work,0) not in (0) and c.book=-1
                and (coalesce(c.code,0)>999 or coalesce(c.code,0)=900) 
	        and  coalesce(c.code,0) not in(20000556,20000565,20000753,
	       20555555,20888888,20999999,30999999,40999999,41000000,42000000,43000000,
	       10999999,11000000,19999369,50999999,1000000,1000001)  
                ) x
                left join eqm_equipment_tbl eq on eq.id=x.id_point
                order by 1
                ) p
                left join eqm_line_a_tbl as line_a on (line_a.code_eqp=p.code_eqp)
                left join eqm_line_c_tbl as line_c on (line_c.code_eqp=p.code_eqp)
                left join eqi_corde_tbl as corde on (corde.id=line_a.id_type_eqp)
                left join eqi_cable_tbl as cable on (cable.id=line_c.id_type_eqp)
                left join eqm_compensator_tbl AS eqd on (eqd.code_eqp=p.code_eqp) 
                left join eqi_compensator_tbl AS eqk on (eqd.id_type_eqp=eqk.id) 
                left join sap_type_tr_2w_tbl as sap_tr on (sap_tr.id_type=eqk.id)
                left join cabels_soed as sap_cable on (sap_cable.id_en=cable.id and sap_cable.type_cab=1)
                left join cabels_soed as sap_line on (sap_line.id_en=corde.id and sap_line.type_cab=2)
                left join cabels as sap_c on (sap_c.a=sap_cable.id_sap)
                left join cabels as sap_l on (sap_l.a=sap_line.id_sap)
                left join eqm_eqp_use_tbl as use on (use.code_eqp = p.id_point) 
                 left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = p.id_point
                left join eqm_tree_tbl tr on tr.id = ttr.id_tree
                left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                left join sap_transf as v on (v.id::int=eqk.id and v.kod_res=$res)
                left join eqm_equipment_tbl as eq on (eq.id=p.code_eqp and eq.type_eqp=2 and eq.is_owner=1)
                inner join sap_const const on 1=1   
                where p.type_eqp not in (1,12,3,4,5,9,15,16,17) 
                 order by 4) r
                 where  case when '$res'='4' then code_eqp not in(118478,118479,149671,149672)  else 1=1 end
	       order by 1 ";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

//        debug($data);
//        return;

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур
        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct) . '_ztransf';
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        $fd = date('Ymd');
        if (isset($data[0]['ver']))
            $ver = $data[0]['ver'];
        else
            $ver = $res;
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        $oldkey_const = '04_C' . $rem . 'P_01_';

        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);

                // Запись в _ext файл
                $_ext[0] = 'ZTRANSF';
                $_ext[1] = $oldkey_const . $w['code_eqp'];
                $_ext[2] = '';
                $_ext[3] = $w['name_point'];

                $d1 = array_map('trim', $_ext);
                $s1 = implode("\t", $d1);
                $s1 = str_replace("~", "", $s1);
                $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                fputs($f, $s1);
                fputs($f, "\n");
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        if (isset($data[0]['ver']))
            $ver = $data[0]['ver'];
        else
            $ver = $res;

        $ver = '8';
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct" . '_ztransf';
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']) . '_ztransf';
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        // нет объекта высшего уровня {
//        if(1==2) {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
        if (!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
//        }
//         нет объекта высшего уровня


        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }

        }
        // пустая ссылка }

        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }

    // Формирование файла facts для САП для юридических потребителей
    public function actionSap_facts($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        // Главный запрос со всеми необходимыми данными
        if (1 == 2) {
            $sql = "select distinct eq2.num_eqp as ncnt,p.num_eqp,eerm.eerm,p.code_eqp as id,p.name_eqp,
p.avg_dem::varchar as avg_dem,power_allow,power_con,
value_r as tg_fi,round(p.wtm::numeric/30.0,0) as FACTOR_hour,p.safe_category,
case when coalesce(p.count_lost,0)=1 then 'X' else '' end as count_lost,
case when coalesce(p.lost_nolost,0)=0 then 'X' else '' end as no_lost,
en.kind_energy, en1.kind_energy as react, en2.kind_energy as gen,
me.kind_energy as react_,me1.kind_energy as gen_,const.ver
from ( select eq.num_eqp as neqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, dt.id_tg, --p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, 
dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,  
 dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,
dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone, round(sum(bs.demand_val)/30,0) as avg_dem,sum(bs.demand_val) as demand_val,
coalesce(dt.power,0)::varchar as power_allow,
case when coalesce(dt.con_power_kva,0) = 0 then coalesce(dt.connect_power,0)::varchar else '0' end as power_con,
tg.value_r
	from eqm_equipment_tbl as eq 
	join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id and dt_b < '2020-02-01' and dt_e is null order by dt_b desc limit 1) ) 
	join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	join acd_billsum_tbl as bs on bs.id_point = dt.code_eqp and kind_energy = 1 and id_zone=0
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id)
		
	group by eq.num_eqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, 
	dt.id_tg,dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,
	dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, dt.lost_nolost, dt.id_extra,dt.reserv,dt.con_power_kva, dt.safe_category,
	 dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone,tg.value_r
	) as p 
left join eqd_point_energy_h  as en on en.code_eqp=p.code_eqp and en.dt_e is null and en.kind_energy =1	
left join eqd_point_energy_h  as en1 on en1.code_eqp=p.code_eqp and en1.dt_e is null and en1.kind_energy in (2,5)	
left join eqd_point_energy_h  as en2 on en1.code_eqp=p.code_eqp and en2.dt_e is null and en2.kind_energy in (4,6)

left join eqm_meter_point_h as mp on mp.id_point = p.code_eqp and mp.dt_e is null
left join eqm_meter_tbl as m on m.code_eqp = mp.id_meter
left join eqm_equipment_tbl eq2 on  m.code_eqp = eq2.id
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (2,5) )as me on me.code_eqp = mp.id_meter
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (4,6) )as me1 on me1.code_eqp = mp.id_meter
left join eerm2cnt eerm on get_num_cnt(trim(eerm.cnt))=get_num_cnt(trim(eq2.num_eqp))
inner join sap_const const on 1=1 ";
        }

        $sql = " select distinct eq2.num_eqp as ncnt,p.num_eqp,eerm.eerm,p.code_eqp as id,p.name_eqp,
p.avg_dem::varchar as avg_dem,power_allow,power_con,
value_r as tg_fi,round(p.wtm::numeric/30.0,0) as FACTOR_hour,p.safe_category,
case when coalesce(p.count_lost,0)=1 then 'X' else '' end as count_lost,
case when coalesce(p.lost_nolost,0)=0 then 'X' else '' end as no_lost,
en.kind_energy, en1.kind_energy as react, en2.kind_energy as gen,
me.kind_energy as react_,me1.kind_energy as gen_,const.ver,x.code_area,x.main ,
case when me.kind_energy=2 and x.main='X' then 'X' end as main_obj,
x.name_tp,lm.*
from ( select eq.num_eqp as neqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, dt.id_tg, --p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, 
dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,  
 dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,
dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone, round(sum(bs.demand_val)/30,0) as avg_dem,sum(bs.demand_val) as demand_val,
coalesce(ROUND(dt.power,3),0)::varchar as power_allow,
case when coalesce(dt.con_power_kva,0) = 0 then coalesce(ROUND(dt.connect_power,3),0)::varchar else '0' end as power_con,
tg.value_r
	from eqm_equipment_tbl as eq 
	join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id and dt_b < '2020-02-01' and dt_e is null order by dt_b desc limit 1) ) 
	join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	join acd_billsum_tbl as bs on bs.id_point = dt.code_eqp and kind_energy = 1 and id_zone=0
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id)
		
	group by eq.num_eqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, 
	dt.id_tg,dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,
	dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, dt.lost_nolost, dt.id_extra,dt.reserv,dt.con_power_kva, dt.safe_category,
	 dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone,tg.value_r
	) as p 
left join eqd_point_energy_h  as en on en.code_eqp=p.code_eqp and en.dt_e is null and en.kind_energy =1	
left join eqd_point_energy_h  as en1 on en1.code_eqp=p.code_eqp and en1.dt_e is null and en1.kind_energy in (2,5)	
left join eqd_point_energy_h  as en2 on en1.code_eqp=p.code_eqp and en2.dt_e is null and en2.kind_energy in (4,6)

left join eqm_meter_point_h as mp on mp.id_point = p.code_eqp and mp.dt_e is null
left join eqm_meter_tbl as m on m.code_eqp = mp.id_meter
left join eqm_equipment_tbl eq2 on  m.code_eqp = eq2.id
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (2,5) )as me on me.code_eqp = mp.id_meter
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (4,6) )as me1 on me1.code_eqp = mp.id_meter
left join eerm2cnt eerm on get_num_cnt(trim(eerm.cnt))=get_num_cnt(trim(eq2.num_eqp))
inner join sap_const const on 1=1
left join
    (select t.code_area,t.name_area,t.name_tp,t.num_eqp,t.id,t.code_tu,idkl,power,type_eqp1,h_eqp,
count(*) over (partition by t.name_area,t.code_area) as kol,
case when power=max(power) over (partition by t.name_area,t.code_area) then 'X' else '' end as main_eq,qq.main_eq as main
from
(select distinct on (b.num_eqp) b.id,b.code_tu,b.num_eqp,eq4.num_eqp as idkl,eq2.name_eqp as name_area,
eq3.name_eqp as name_tp,e.power,h.type_eqp as type_eqp1,h.name_eqp as h_eqp,area.code_eqp_inst as code_area from
    (select *,get_tu(id) as code_tu,get_tp(id) as code_tp from eqm_equipment_tbl a) b
   left JOIN eqm_compens_station_inst_tbl AS area ON (b.code_tu=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_point_tbl e on e.code_eqp= b.code_tu
   left join eqm_equipment_h h on h.id= b.id
   left JOIN eqm_equipment_tbl AS eq3 ON (b.code_tp=eq3.id)
   left JOIN eqm_equipment_tbl AS eq4 ON (b.code_tu=eq4.id)
) t
left join
    (select code_area,main_eq,min(id) as id from
    (select code_area,t.name_area,t.name_tp,t.num_eqp,id,t.code_tu,idkl,power,type_eqp1,h_eqp,
count(*) over (partition by t.name_area,code_area) as kol,
case when power=max(power) over (partition by t.name_area,code_area) then 'X' else '' end as main_eq
from
(select distinct on (b.num_eqp) b.id,b.code_tu,b.num_eqp,eq4.num_eqp as idkl,eq2.name_eqp as name_area,
eq3.name_eqp as name_tp,e.power,h.type_eqp as type_eqp1,h.name_eqp as h_eqp,area.code_eqp_inst as code_area from
    (select *,get_tu(id) as code_tu,get_tp(id) as code_tp from eqm_equipment_tbl a order by id) b
   left JOIN eqm_compens_station_inst_tbl AS area ON (b.code_tu=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_point_tbl e on e.code_eqp= b.code_tu
   left join eqm_equipment_h h on h.id= b.id
   left JOIN eqm_equipment_tbl AS eq3 ON (b.code_tp=eq3.id)
   left JOIN eqm_equipment_tbl AS eq4 ON (b.code_tu=eq4.id)
) t
   where type_eqp1=1) z
   where z.main_eq='X'
   group by code_area,main_eq
) qq on qq.id=t.id and qq.code_area=t.code_area
   where t.type_eqp1=1) x on x.code_tu=p.code_eqp
        ----
    left join
    ( select cl.code,cl.name,cl.period_indicat, s1.*,cl.represent_name, area.name_eqp as area_name, area.power,
    area.wtm, area.adr as area_adr, area.is_used from ( select c.id,c.code,c.short_name as name, cp.represent_name ,
     scl.period_indicat from clm_client_tbl as c join clm_statecl_tbl as scl on (c.id = scl.id_client)
      left join clm_position_tbl as cp on (scl.id_position = cp.id) where scl.id_section not in (205,206,207,208)
    and c.idk_work not in (0,99) and coalesce(c.id_state,0) not in (50,99) and c.book=-1 ) as cl
        left join ( select a.id_client, a.code_eqp, eq.name_eqp , g.power, g.wtm, addr.adr,
         CASE WHEN (select count(*) from eqm_compens_station_inst_tbl as csi where csi.code_eqp_inst = a.code_eqp) >0 THEN 1 ELSE 0 END
          as is_used from eqm_area_tbl as a join eqm_ground_tbl as g on (g.code_eqp = a.code_eqp) join eqm_equipment_tbl as eq on (eq.id = a.code_eqp)
           left join adv_address_tbl as addr on (addr.id = eq.id_addres) ) as area on (area.id_client = cl.id)
            left join ( select id_client,id_area, sum(CASE WHEN date_part('month',month_limit)= 1 THEN value_dem ELSE 0 END) as value1 ,
             sum(CASE WHEN date_part('month',month_limit)= 2 THEN value_dem ELSE 0 END) as value2 ,
              sum(CASE WHEN date_part('month',month_limit)= 3 THEN value_dem ELSE 0 END) as value3 ,
               sum(CASE WHEN date_part('month',month_limit)= 4 THEN value_dem ELSE 0 END) as value4 ,
                sum(CASE WHEN date_part('month',month_limit)= 5 THEN value_dem ELSE 0 END) as value5 ,
                 sum(CASE WHEN date_part('month',month_limit)= 6 THEN value_dem ELSE 0 END) as value6 ,
                  sum(CASE WHEN date_part('month',month_limit)= 7 THEN value_dem ELSE 0 END) as value7 ,
                   sum(CASE WHEN date_part('month',month_limit)= 8 THEN value_dem ELSE 0 END) as value8 ,
                    sum(CASE WHEN date_part('month',month_limit)= 9 THEN value_dem ELSE 0 END) as value9 ,
                     sum(CASE WHEN date_part('month',month_limit)= 10 THEN value_dem ELSE 0 END) as value10 ,
                      sum(CASE WHEN date_part('month',month_limit)= 11 THEN value_dem ELSE 0 END) as value11 ,
                       sum(CASE WHEN date_part('month',month_limit)= 12 THEN value_dem ELSE 0 END) as value12 
                       from ( select distinct hl.id_client,d1.value_dem,d1.month_limit,d1.id_area from acd_demandlimit_tbl as d1
                        join acm_headdemandlimit_tbl as hl on (hl.id_doc = d1.id_doc) join
    ( select h2.id_client,d2.month_limit, d2.id_area, max(h2.reg_date) as maxdate , max(h2.mmgg) as maxmmgg
                        from acm_headdemandlimit_tbl as h2 join acd_demandlimit_tbl as d2 on (h2.id_doc = d2.id_doc) 
                        left join ( select distinct g.code_eqp from eqm_ground_tbl as g join eqm_compens_station_inst_tbl as csi on
    (csi.code_eqp_inst = g.code_eqp) )as g on (g.code_eqp = d2.id_area)
                          where h2.idk_document = 600 and date_part('year',d2.month_limit)= date_part('year', '2020-02-01'::date )
                           and (d2.id_area is null or g.code_eqp is not null)
                            group by h2.id_client , d2.id_area, d2.month_limit order by h2.id_client ) as hh
                             on (hh.id_client = hl.id_client and hh.maxdate = hl.reg_date and hh.maxmmgg = hl.mmgg
                                 and hh.month_limit = d1.month_limit and hh.id_area = d1.id_area) where hl.idk_document = 600
    and date_part('year',d1.month_limit)= date_part('year', '2020-02-01'::date ) 
                              order by hl.id_client,id_area ) as ss group by id_client, id_area ) as s1 on
    (s1.id_client =cl.id and s1.id_area = area.code_eqp) order by cl.code,area_name) lm 
                              on lm.id_area=code_area
		order by code_area";

// Получаем дату ab
        $sql_d = " select (max(mmgg) - interval '3 month')::date as mmgg_current from sys_month_tbl";
        $data_d = data_from_server($sql_d, $res, $vid);
        $date_ab = $data_d[0]['mmgg_current'];

        $sql = "select distinct uuu.zz_eic,p.neqp,eq2.num_eqp as ncnt,p.num_eqp,min(eerm.eerm) over(partition by uuu.zz_eic) as eerm,p.code_eqp as id,p.name_eqp,
p.avg_dem::varchar as avg_dem,power_allow,power_con,
value_r as tg_fi,round(p.wtm::numeric/30.0,0) as FACTOR_hour,p.safe_category,
case when coalesce(p.count_lost,0)=1 then 'X' else '' end as count_lost,
case when coalesce(p.lost_nolost,0)=0 then 'X' else '' end as no_lost,
en.kind_energy, en1.kind_energy as react, en2.kind_energy as gen,
me.kind_energy as react_,me1.kind_energy as gen_,const.ver,x.code_area,x.main ,
case when me.kind_energy=2 and x.main='X' then 'X' end as main_obj,
x.name_tp,lm.* --into t_f1
from ( select eq.num_eqp as neqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, dt.id_tg, --p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, 
dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,  
 dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,
dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone, round(sum(bs.demand_val)/30,0) as avg_dem,sum(bs.demand_val) as demand_val,
coalesce(ROUND(dt.power,3),0)::varchar as power_allow,
case when coalesce(dt.con_power_kva,0) = 0 then coalesce(ROUND(dt.connect_power,3),0)::varchar else '0' end as power_con,
tg.value_r
	from eqm_equipment_tbl as eq 
	left join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id and dt_b < '2020-03-01' and dt_e is null order by dt_b desc limit 1) ) 
	 join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join acd_billsum_tbl as bs on bs.id_point = dt.code_eqp and kind_energy = 1 and id_zone=0
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id)
		
	group by eq.num_eqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, 
	dt.id_tg,dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,
	dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, dt.lost_nolost, dt.id_extra,dt.reserv,dt.con_power_kva, dt.safe_category,
	 dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone,tg.value_r
	) as p 
left join eqd_point_energy_h  as en on en.code_eqp=p.code_eqp and en.dt_e is null and en.kind_energy =1	
left join eqd_point_energy_h  as en1 on en1.code_eqp=p.code_eqp and en1.dt_e is null and en1.kind_energy in (2,5)	
left join eqd_point_energy_h  as en2 on en1.code_eqp=p.code_eqp and en2.dt_e is null and en2.kind_energy in (4,6)

left join eqm_meter_point_h as mp on mp.id_point = p.code_eqp and mp.dt_e is null
left join eqm_meter_tbl as m on m.code_eqp = mp.id_meter
left join eqm_equipment_tbl eq2 on  m.code_eqp = eq2.id
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (2,5) )as me on me.code_eqp = mp.id_meter
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (4,6) )as me1 on me1.code_eqp = mp.id_meter
left join eerm2cnt eerm on get_num_cnt(trim(eerm.cnt))=get_num_cnt(trim(eq2.num_eqp))
inner join sap_const const on 1=1
left join
    (select t.code_area,t.name_area,t.name_tp,t.num_eqp,t.id,t.code_tu,idkl,power,type_eqp1,h_eqp,
count(*) over (partition by t.name_area,t.code_area) as kol,
case when power=max(power) over (partition by t.name_area,t.code_area) then 'X' else '' end as main_eq,qq.main_eq as main
from
(select distinct on (b.num_eqp) b.id,b.code_tu,b.num_eqp,eq4.num_eqp as idkl,eq2.name_eqp as name_area,
eq3.name_eqp as name_tp,e.power,h.type_eqp as type_eqp1,h.name_eqp as h_eqp,area.code_eqp_inst as code_area from
    (select *,get_tu(id) as code_tu,get_tp(id) as code_tp from eqm_equipment_tbl a) b
   left JOIN eqm_compens_station_inst_tbl AS area ON (b.code_tu=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_point_tbl e on e.code_eqp= b.code_tu
   left join eqm_equipment_h h on h.id= b.id
   left JOIN eqm_equipment_tbl AS eq3 ON (b.code_tp=eq3.id)
   left JOIN eqm_equipment_tbl AS eq4 ON (b.code_tu=eq4.id)
) t
left join
    (select code_area,main_eq,min(id) as id from
    (select code_area,t.name_area,t.name_tp,t.num_eqp,id,t.code_tu,idkl,power,type_eqp1,h_eqp,
count(*) over (partition by t.name_area,code_area) as kol,
case when power=max(power) over (partition by t.name_area,code_area) then 'X' else '' end as main_eq
from
(select distinct on (b.num_eqp) b.id,b.code_tu,b.num_eqp,eq4.num_eqp as idkl,eq2.name_eqp as name_area,
eq3.name_eqp as name_tp,e.power,h.type_eqp as type_eqp1,h.name_eqp as h_eqp,area.code_eqp_inst as code_area from
    (select *,get_tu(id) as code_tu,get_tp(id) as code_tp from eqm_equipment_tbl a order by id) b
   left JOIN eqm_compens_station_inst_tbl AS area ON (b.code_tu=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_point_tbl e on e.code_eqp= b.code_tu
   left join eqm_equipment_h h on h.id= b.id
   left JOIN eqm_equipment_tbl AS eq3 ON (b.code_tp=eq3.id)
   left JOIN eqm_equipment_tbl AS eq4 ON (b.code_tu=eq4.id)
) t
   where type_eqp1=1) z
   where z.main_eq='X'
   group by code_area,main_eq
) qq on qq.id=t.id and qq.code_area=t.code_area
   where t.type_eqp1=1) x on x.code_tu=p.code_eqp
        ----
    left join
    ( select cl.code,cl.name,cl.period_indicat, s1.*,cl.represent_name, area.name_eqp as area_name, area.power,
    area.wtm, area.adr as area_adr, area.is_used from ( select c.id,c.code,c.short_name as name, cp.represent_name ,
     scl.period_indicat from clm_client_tbl as c join clm_statecl_tbl as scl on (c.id = scl.id_client)
      left join clm_position_tbl as cp on (scl.id_position = cp.id) where scl.id_section not in (205,206,207,208)
    and c.idk_work not in (0,99) and coalesce(c.id_state,0) not in (50,99) and c.book=-1 ) as cl
        left join ( select a.id_client, a.code_eqp, eq.name_eqp , g.power, g.wtm, addr.adr,
         CASE WHEN (select count(*) from eqm_compens_station_inst_tbl as csi where csi.code_eqp_inst = a.code_eqp) >0 THEN 1 ELSE 0 END
          as is_used from eqm_area_tbl as a join eqm_ground_tbl as g on (g.code_eqp = a.code_eqp) join eqm_equipment_tbl as eq on (eq.id = a.code_eqp)
           left join adv_address_tbl as addr on (addr.id = eq.id_addres) ) as area on (area.id_client = cl.id)
            left join ( select id_client,id_area, sum(CASE WHEN date_part('month',month_limit)= 1 THEN value_dem ELSE 0 END) as value1 ,
             sum(CASE WHEN date_part('month',month_limit)= 2 THEN value_dem ELSE 0 END) as value2 ,
              sum(CASE WHEN date_part('month',month_limit)= 3 THEN value_dem ELSE 0 END) as value3 ,
               sum(CASE WHEN date_part('month',month_limit)= 4 THEN value_dem ELSE 0 END) as value4 ,
                sum(CASE WHEN date_part('month',month_limit)= 5 THEN value_dem ELSE 0 END) as value5 ,
                 sum(CASE WHEN date_part('month',month_limit)= 6 THEN value_dem ELSE 0 END) as value6 ,
                  sum(CASE WHEN date_part('month',month_limit)= 7 THEN value_dem ELSE 0 END) as value7 ,
                   sum(CASE WHEN date_part('month',month_limit)= 8 THEN value_dem ELSE 0 END) as value8 ,
                    sum(CASE WHEN date_part('month',month_limit)= 9 THEN value_dem ELSE 0 END) as value9 ,
                     sum(CASE WHEN date_part('month',month_limit)= 10 THEN value_dem ELSE 0 END) as value10 ,
                      sum(CASE WHEN date_part('month',month_limit)= 11 THEN value_dem ELSE 0 END) as value11 ,
                       sum(CASE WHEN date_part('month',month_limit)= 12 THEN value_dem ELSE 0 END) as value12 
                       from ( select distinct hl.id_client,d1.value_dem,d1.month_limit,d1.id_area from acd_demandlimit_tbl as d1
                        join acm_headdemandlimit_tbl as hl on (hl.id_doc = d1.id_doc) join
    ( select h2.id_client,d2.month_limit, d2.id_area, max(h2.reg_date) as maxdate , max(h2.mmgg) as maxmmgg
                        from acm_headdemandlimit_tbl as h2 join acd_demandlimit_tbl as d2 on (h2.id_doc = d2.id_doc) 
                        left join ( select distinct g.code_eqp from eqm_ground_tbl as g join eqm_compens_station_inst_tbl as csi on
    (csi.code_eqp_inst = g.code_eqp) )as g on (g.code_eqp = d2.id_area)
                          where h2.idk_document = 600 and date_part('year',d2.month_limit)= date_part('year', '2020-05-01'::date )
                           and (d2.id_area is null or g.code_eqp is not null)
                           
                            group by h2.id_client , d2.id_area, d2.month_limit order by h2.id_client ) as hh
                             on (hh.id_client = hl.id_client and hh.maxdate = hl.reg_date and hh.maxmmgg = hl.mmgg
                                 and hh.month_limit = d1.month_limit and hh.id_area = d1.id_area) where hl.idk_document = 600
    and date_part('year',d1.month_limit)= date_part('year', '2020-05-01'::date ) 
                              order by hl.id_client,id_area ) as ss group by id_client, id_area ) as s1 on
    (s1.id_client =cl.id and s1.id_area = area.code_eqp) order by cl.code,area_name) lm 
                              on lm.id_area=code_area
    --where id_client is not null and code<>999 --and (yy.oldkey is not null or qqq.oldkey is not null) and www.code<>999
               
    join
    (
        select distinct on(zz_eic) u.tarif_sap,case when qqq.oldkey is null then trim(yy.oldkey) else trim(qqq.oldkey) end as vstelle,
www.short_name as real_name,const.ver,const.begru,
'10' as sparte,qqq.* from
    (select distinct on(q1.num_eqp) q1.id,x.oldkey,cc.short_name,
case when q.id_cl=2062 then rr.id_client else q.id_cl end as id_potr,
q1.num_eqp as zz_eic,q.* from
    (select  distinct 'DATA' as DATA,c.id as id_cl,
case when p.voltage_max = 0.22 then '02'
     when p.voltage_max = 0.4 then '03'
     when p.voltage_max = 10.00 then '05' 
     when p.voltage_max = 6.0 then '04'
     when p.voltage_max = 27.5 then '06'
     when p.voltage_max = 35.0 then '07'
     when p.voltage_max = 110.0 then '08' else '' end as SPEBENE,
'0001' as ANLART,
'0002' as ABLESARTST,
p.name_eqp as ZZ_NAMETU,
p.eic_code,
'' as ZZ_FIDER,
'$date_ab' as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'  
     when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???' 
     else 
	case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???' 
	else '???' --tar_sap.id_sap_tar 
	end 
end  as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' then '0004' else '0002' end as AKLASSE,
     'PC01311' as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
     when tgr.ident in('tgr2') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
     when tgr.ident in('tgr6') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
     when tgr.ident in('tgr3') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
     when tgr.ident in('tgr4') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
     when tgr.ident in('tgr1') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999)  then '054'
     when tgr.ident in('tgr2') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
     when tgr.ident in('tgr6') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
     when tgr.ident in('tgr3') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
     when tgr.ident in('tgr4') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
     when tgr.ident in('tgr8_10','tgr8_30') then '298'
     when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
     when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '352'
     when ((tgr.ident ~ 'tgr7_12') or (tgr.ident~ 'tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007)  in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)  and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521'  and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and  tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and  tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10  and tcl.ident='tcl1' then '604'
when c.idk_work=99 and p.voltage_min<=10 and tcl.ident='tcl2' then '606'
when tcl.ident='tcl1' and p.id_extra =1003 then '632'
when tcl.ident='tcl2' and p.id_extra =1003 then '634'
when tcl.ident='tcl1' and p.id_extra in (1001,1002,1012,1013) then '638'
when tcl.ident='tcl2' and p.id_extra in (1001,1002,1012,1013) then '640'
when tgr.ident in('tgr8_101') then '666'
 else '' end as ZZCODE4NKRE,
'' as ZZCODE4NKRE_DOP,
'' as ZZOTHERAREA,
'1' as sort 
from (select eq.num_eqp as eic_code,tr.name as vid_trf,dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, tr.id_grouptarif --, ph.id_extra --, tr.id_classtarif
	from eqm_equipment_tbl as eq 
	join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) 
	left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) 
	left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
	left join eqk_zone_tbl AS z on (dt.zone=z.id) 
	left join cla_param_tbl AS cla on (dt.id_depart=cla.id) 
	left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
	left join clm_position_tbl as cp on (cp.id = dt.id_position) ) as p 
join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
join eqm_tree_tbl as t on (t.id = tt.id_tree) 
join (select distinct id,code,idk_work from clm_client_tbl) as c on (c.id = t.id_client) 
left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
left join clm_statecl_tbl as st on (st.id_client = c2.id) 
left join aci_tarif_tbl as tar on (tar.id=p.id_tarif)
    --left join sap_energo_tarif as tar_sap on tar_sap.id_tar = p.id_tarif
left join eqi_grouptarif_tbl as tgr on tgr.id= p.id_grouptarif
left join eqi_classtarif_tbl as tcl on (p.id_classtarif=tcl.id)
    --left join reading_controller as w on w.tabel_numb = p.num_tab
left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp) 
left join (select code_eqp, trim(sum(e.name||','),',') as energy from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en on (en.code_eqp = p.code_eqp) 
) q 
left join eqm_equipment_tbl q1 
on q.zz_nametu::text=q1.name_eqp::text  and substr(trim(q1.num_eqp)::text,1,3)='62Z' 
and substr(trim(q1.num_eqp),1,16)=substr(trim(q.eic_code),1,16)
left join eqm_area_tbl ar on ar.code_eqp=q1.id
left join sap_evbsd x on case when trim(x.haus)='' then 0 else coalesce(substr(x.haus,9)::integer,0) end =q.id_cl
left join clm_client_tbl as cc on cc.id = q.id_cl
left join
    (select u.id_client,a.id from eqm_equipment_tbl a
   left join eqm_point_tbl tu1 on tu1.code_eqp=a.id 
   left JOIN eqm_compens_station_inst_tbl AS area ON (a.id=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_area_tbl u on u.code_eqp=area.code_eqp_inst
   left join clm_client_tbl u1 on u1.id=u.id_client) rr 
   on rr.id=q1.id and (x.oldkey is null or q.id_cl=2062)
where SPEBENE::text<>'' and q1.num_eqp is not null) qqq
left join tarif_sap_energo u on trim(u.name)=trim(qqq.vid_trf)
left join eqm_eqp_use_tbl use on use.code_eqp=qqq.id
left join sap_evbsd yy on case when trim(yy.haus)='' then 0 else coalesce(substr(yy.haus,9)::integer,0) end=--qqq.id_potr
case when qqq.id_potr=2062 then use.id_client else coalesce(qqq.id_potr,use.id_client) end
left join clm_client_tbl www on www.id=coalesce(qqq.id_potr,use.id_client)
inner join sap_const const on 1=1 
where coalesce(qqq.id_potr,use.id_client) is not null and 
(www.code<>999 or (www.code=999 and use.code_eqp is not null))
and
(www.code>999 or  www.code=900) AND 
(coalesce(www.idk_work,0)<>0 or (coalesce(www.idk_work,0)=0 and use.code_eqp is not null))
	     and  www.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')
) uuu on 
uuu.id=p.id and uuu.vstelle is not null 
-- substr(trim(uuu.zz_eic),1,16)=substr(trim(p.neqp),1,16) and uuu.vstelle is not null
";


// Самый правильный запрос
        $sql = "select res.*,ust.tariftyp from (
select distinct uuu.zz_eic,p.neqp,eq2.num_eqp as ncnt,p.num_eqp,min(eerm.eerm) over(partition by uuu.zz_eic) as eerm,
p.code_eqp as id,p.name_eqp,
p.avg_dem::varchar as avg_dem,power_allow,power_con,
value_r as tg_fi,round(p.wtm::numeric/30.0,0) as FACTOR_hour,p.safe_category,
case when coalesce(p.count_lost,0)=1 then 'X' else '' end as count_lost,
case when coalesce(p.lost_nolost,0)=0 then 'X' else '' end as no_lost,
en.kind_energy, en1.kind_energy as react, en2.kind_energy as gen,
me.kind_energy as react_,me1.kind_energy as gen_,const.ver,x.code_area,x.main ,
case when me.kind_energy=2 and x.main='X' then 'X' end as main_obj,
x.name_tp,lm.* --into t_f1
from ( select eq.num_eqp as neqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, dt.id_tg, --p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, 
dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,  
 dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,
dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone, round(sum(bs.demand_val)/30,0) as avg_dem,sum(bs.demand_val) as demand_val,
coalesce(ROUND(dt.power,3),0)::varchar as power_allow,
case when coalesce(dt.con_power_kva,0) = 0 then coalesce(ROUND(dt.connect_power,3),0)::varchar else '0' end as power_con,
tg.value_r
	from eqm_equipment_tbl as eq 
	left join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id and dt_b < '2020-03-01' and dt_e is null order by dt_b desc limit 1) ) 
	 join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join acd_billsum_tbl as bs on bs.id_point = dt.code_eqp and kind_energy = 1 and id_zone=0
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id)
		
	group by eq.num_eqp,eq.id,eqh.num_eqp,dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, 
	dt.id_tg,dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control,dt.zone,
	dt.flag_hlosts, dt.id_depart,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, dt.lost_nolost, dt.id_extra,dt.reserv,dt.con_power_kva, dt.safe_category,
	 dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, bs.id_zone,tg.value_r
	) as p 
left join eqd_point_energy_h  as en on en.code_eqp=p.code_eqp and en.dt_e is null and en.kind_energy =1	
left join eqd_point_energy_h  as en1 on en1.code_eqp=p.code_eqp and en1.dt_e is null and en1.kind_energy in (2,5)	
left join eqd_point_energy_h  as en2 on en1.code_eqp=p.code_eqp and en2.dt_e is null and en2.kind_energy in (4,6)

left join eqm_meter_point_h as mp on mp.id_point = p.code_eqp and mp.dt_e is null
left join eqm_meter_tbl as m on m.code_eqp = mp.id_meter
left join eqm_equipment_tbl eq2 on  m.code_eqp = eq2.id
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (2,5) )as me on me.code_eqp = mp.id_meter
left join (select kind_energy, code_eqp from  eqd_meter_energy_tbl where kind_energy in (4,6) )as me1 on me1.code_eqp = mp.id_meter
left join eerm2cnt eerm on get_num_cnt(trim(eerm.cnt))=get_num_cnt(trim(eq2.num_eqp))
inner join sap_const const on 1=1
left join
    (select t.code_area,t.name_area,t.name_tp,t.num_eqp,t.id,t.code_tu,idkl,power,type_eqp1,h_eqp,
count(*) over (partition by t.name_area,t.code_area) as kol,
case when power=max(power) over (partition by t.name_area,t.code_area) then 'X' else '' end as main_eq,qq.main_eq as main
from
(select distinct on (b.num_eqp) b.id,b.code_tu,b.num_eqp,eq4.num_eqp as idkl,eq2.name_eqp as name_area,
eq3.name_eqp as name_tp,e.power,h.type_eqp as type_eqp1,h.name_eqp as h_eqp,area.code_eqp_inst as code_area from
    (select *,get_tu(id) as code_tu,get_tp(id) as code_tp from eqm_equipment_tbl a) b
   left JOIN eqm_compens_station_inst_tbl AS area ON (b.code_tu=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_point_tbl e on e.code_eqp= b.code_tu
   left join eqm_equipment_h h on h.id= b.id
   left JOIN eqm_equipment_tbl AS eq3 ON (b.code_tp=eq3.id)
   left JOIN eqm_equipment_tbl AS eq4 ON (b.code_tu=eq4.id)
) t
left join
    (select code_area,main_eq,min(id) as id from
    (select code_area,t.name_area,t.name_tp,t.num_eqp,id,t.code_tu,idkl,power,type_eqp1,h_eqp,
count(*) over (partition by t.name_area,code_area) as kol,
case when power=max(power) over (partition by t.name_area,code_area) then 'X' else '' end as main_eq
from
(select distinct on (b.num_eqp) b.id,b.code_tu,b.num_eqp,eq4.num_eqp as idkl,eq2.name_eqp as name_area,
eq3.name_eqp as name_tp,e.power,h.type_eqp as type_eqp1,h.name_eqp as h_eqp,area.code_eqp_inst as code_area from
    (select *,get_tu(id) as code_tu,get_tp(id) as code_tp from eqm_equipment_tbl a order by id) b
   left JOIN eqm_compens_station_inst_tbl AS area ON (b.code_tu=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_point_tbl e on e.code_eqp= b.code_tu
   left join eqm_equipment_h h on h.id= b.id
   left JOIN eqm_equipment_tbl AS eq3 ON (b.code_tp=eq3.id)
   left JOIN eqm_equipment_tbl AS eq4 ON (b.code_tu=eq4.id)
) t
   where type_eqp1=1) z
   where z.main_eq='X'
   group by code_area,main_eq
) qq on qq.id=t.id and qq.code_area=t.code_area
   where t.type_eqp1=1) x on x.code_tu=p.code_eqp
        ----
    left join
    ( select cl.code,cl.name,cl.period_indicat, s1.*,cl.represent_name, area.name_eqp as area_name, area.power,
    area.wtm, area.adr as area_adr, area.is_used from ( select c.id,c.code,c.short_name as name, cp.represent_name ,
     scl.period_indicat from clm_client_tbl as c join clm_statecl_tbl as scl on (c.id = scl.id_client)
      left join clm_position_tbl as cp on (scl.id_position = cp.id) where scl.id_section not in (205,206,207,208)
    and c.idk_work not in (0,99) and coalesce(c.id_state,0) not in (50,99) and c.book=-1 ) as cl
        left join ( select a.id_client, a.code_eqp, eq.name_eqp , g.power, g.wtm, addr.adr,
         CASE WHEN (select count(*) from eqm_compens_station_inst_tbl as csi where csi.code_eqp_inst = a.code_eqp) >0 THEN 1 ELSE 0 END
          as is_used from eqm_area_tbl as a join eqm_ground_tbl as g on (g.code_eqp = a.code_eqp) join eqm_equipment_tbl as eq on (eq.id = a.code_eqp)
           left join adv_address_tbl as addr on (addr.id = eq.id_addres) ) as area on (area.id_client = cl.id)
            left join ( select id_client,id_area, sum(CASE WHEN date_part('month',month_limit)= 1 THEN value_dem ELSE 0 END) as value1 ,
             sum(CASE WHEN date_part('month',month_limit)= 2 THEN value_dem ELSE 0 END) as value2 ,
              sum(CASE WHEN date_part('month',month_limit)= 3 THEN value_dem ELSE 0 END) as value3 ,
               sum(CASE WHEN date_part('month',month_limit)= 4 THEN value_dem ELSE 0 END) as value4 ,
                sum(CASE WHEN date_part('month',month_limit)= 5 THEN value_dem ELSE 0 END) as value5 ,
                 sum(CASE WHEN date_part('month',month_limit)= 6 THEN value_dem ELSE 0 END) as value6 ,
                  sum(CASE WHEN date_part('month',month_limit)= 7 THEN value_dem ELSE 0 END) as value7 ,
                   sum(CASE WHEN date_part('month',month_limit)= 8 THEN value_dem ELSE 0 END) as value8 ,
                    sum(CASE WHEN date_part('month',month_limit)= 9 THEN value_dem ELSE 0 END) as value9 ,
                     sum(CASE WHEN date_part('month',month_limit)= 10 THEN value_dem ELSE 0 END) as value10 ,
                      sum(CASE WHEN date_part('month',month_limit)= 11 THEN value_dem ELSE 0 END) as value11 ,
                       sum(CASE WHEN date_part('month',month_limit)= 12 THEN value_dem ELSE 0 END) as value12 
                       from ( select distinct hl.id_client,d1.value_dem,d1.month_limit,d1.id_area from acd_demandlimit_tbl as d1
                        join acm_headdemandlimit_tbl as hl on (hl.id_doc = d1.id_doc) join
    ( select h2.id_client,d2.month_limit, d2.id_area, max(h2.reg_date) as maxdate , max(h2.mmgg) as maxmmgg
                        from acm_headdemandlimit_tbl as h2 join acd_demandlimit_tbl as d2 on (h2.id_doc = d2.id_doc) 
                        left join ( select distinct g.code_eqp from eqm_ground_tbl as g join eqm_compens_station_inst_tbl as csi on
    (csi.code_eqp_inst = g.code_eqp) )as g on (g.code_eqp = d2.id_area)
                          where h2.idk_document = 600 and date_part('year',d2.month_limit)= date_part('year', '2020-05-01'::date )
                           and (d2.id_area is null or g.code_eqp is not null)
                           
                            group by h2.id_client , d2.id_area, d2.month_limit order by h2.id_client ) as hh
                             on (hh.id_client = hl.id_client and hh.maxdate = hl.reg_date and hh.maxmmgg = hl.mmgg
                                 and hh.month_limit = d1.month_limit and hh.id_area = d1.id_area) where hl.idk_document = 600
    and date_part('year',d1.month_limit)= date_part('year', '2020-05-01'::date ) 
                              order by hl.id_client,id_area ) as ss group by id_client, id_area ) as s1 on
    (s1.id_client =cl.id and s1.id_area = area.code_eqp) order by cl.code,area_name) lm 
                              on lm.id_area=code_area
    --where id_client is not null and code<>999 --and (yy.oldkey is not null or qqq.oldkey is not null) and www.code<>999
               
    join
    (
        SELECT q.code_eqp as id,ar.code_eqp_inst,yy.oldkey as vstelle,''::char(20) as vstelle1,'10' as sparte,
const.ver,const.begru_all as begru,coalesce(eds.ed_sch,eds1.ed_sch) as ableinh,
case when www.code=900 then 'CK_4HN2_01' else u.tarif_sap end as tarif_sap,
q.* from (
select  distinct 'DATA' as DATA,c.id as id_cl,c.idk_work,
case when p.voltage_max = 0.22 then '02'
     when p.voltage_max = 0.4 then '03'
     when p.voltage_max = 10.00 then '05' 
     when p.voltage_max = 6.0 then '04'
     when p.voltage_max = 27.5 then '06'
     when p.voltage_max = 35.0 then '07'
     when p.voltage_max = 150.0 then '16'
     when p.voltage_max = 110.0 then '08' else '-' end as SPEBENE,
'0001' as ANLART,
'0002' as ABLESARTST,
p.name_eqp as ZZ_NAMETU,
p.eic_code as zz_eic,
p.code_eqp,
'' as ZZ_FIDER,
'$date_ab'::char(10) as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'  
     when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???' 
     else 
	case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???' 
	else '???' --tar_sap.id_sap_tar 
	end 
end  as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' then '0004' else '0002' end as AKLASSE,
    -- 'PC010131' as ABLEINH,
    -- eds.ed_sch as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
     when tgr.ident in('tgr2') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
     when tgr.ident in('tgr6') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
     when tgr.ident in('tgr3') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
     when tgr.ident in('tgr4') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
     when tgr.ident in('tgr1') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999)  then '054'
     when tgr.ident in('tgr2') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
     when tgr.ident in('tgr6') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
     when tgr.ident in('tgr3') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
     when tgr.ident in('tgr4') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
     when tgr.ident in('tgr8_10','tgr8_30') then '298'
     when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
     when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '352'
     when ((tgr.ident ~ 'tgr7_12') or (tgr.ident~ 'tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007)  in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)  and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521'  and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and  tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and  tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10  and tcl.ident='tcl1' then '604'
when c.idk_work=99 and p.voltage_min<=10 and tcl.ident='tcl2' then '606'
when tcl.ident='tcl1' and p.id_extra =1003 then '632'
when tcl.ident='tcl2' and p.id_extra =1003 then '634'
when tcl.ident='tcl1' and p.id_extra in (1001,1002,1012,1013) then '638'
when tcl.ident='tcl2' and p.id_extra in (1001,1002,1012,1013) then '640'
when tgr.ident in('tgr8_101') then '666'
 else '' end as ZZCODE4NKRE,
'' as ZZCODE4NKRE_DOP,
'' as ZZOTHERAREA,
'1' as sort 
from (select eq.num_eqp as eic_code,tr.name as vid_trf,dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, tr.id_grouptarif --, ph.id_extra --, tr.id_classtarif
	from eqm_equipment_tbl as eq 
	
	 join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	 join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) 
	left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) 
	left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
	left join eqk_zone_tbl AS z on (dt.zone=z.id) 
	left join cla_param_tbl AS cla on (dt.id_depart=cla.id) 
	left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
	left join clm_position_tbl as cp on (cp.id = dt.id_position) 
	where eq.type_eqp=12 and substr(trim(eq.num_eqp)::text,1,3)='62Z' 
	) as p 
 join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
 join eqm_tree_tbl as t on (t.id = tt.id_tree) 
 join (select distinct id,code,idk_work from clm_client_tbl) as c on (c.id = t.id_client) 
left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
left join clm_statecl_tbl as st on (st.id_client = c2.id) 
left join aci_tarif_tbl as tar on (tar.id=p.id_tarif)
--left join sap_energo_tarif as tar_sap on tar_sap.id_tar = p.id_tarif
left join eqi_grouptarif_tbl as tgr on tgr.id= p.id_grouptarif
left join eqi_classtarif_tbl as tcl on (p.id_classtarif=tcl.id) 
--left join reading_controller as w on w.tabel_numb = p.num_tab
left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp) 
left join (select code_eqp, trim(sum(e.name||','),',') as energy from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en on (en.code_eqp = p.code_eqp)
where (c2.code>999 or c2.code=900) AND coalesce(c2.idk_work,0)<>0 or (c2.code=999 and use.code_eqp is not null) 
	     and  c2.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001')  
) q
inner join sap_const const on 1=1
left join ed_sch eds on q.code_eqp=eds.code_tu::int
left join ed_sch_dop eds1 on q.code_eqp=eds1.code_tu::int
left join eqm_compens_station_inst_tbl ar on ar.code_eqp=q.code_eqp
left join sap_evbsd yy on coalesce(right(yy.oldkey,length(trim(ar.code_eqp_inst::text)))::int,0)=ar.code_eqp_inst
left join eqm_eqp_use_tbl use on use.code_eqp=q.code_eqp
left join clm_client_tbl www on www.id=coalesce(q.id_cl,use.id_client)
left join tarif_sap_energo u on trim(u.name)=trim(q.vid_trf)
where ar.code_eqp_inst is not null and yy.oldkey is not null
order by q.code_eqp
) uuu on uuu.id=p.id and uuu.vstelle is not null
--substr(trim(uuu.zz_eic),1,16)=substr(trim(p.neqp),1,16) and uuu.vstelle is not null
--where zz_eic like '%62Z4632451837557%'
--where p.code_eqp='105997'
) res
left join sap_data ust on substr(ust.oldkey,12)::int=res.id
order by 6 
";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массив $facts
        $i = 0;
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        $oldkey_const = '04_C' . $rem . 'P_01_';
        $id_h = '';
        foreach ($data as $w) {
            $facts[$i] = f_facts($rem, $w);
            $i++;
            // Запись в _ext файл
            $_ext[0] = 'FACTS';
            $_ext[1] = $oldkey_const . $w['id'];
            $_ext[2] = $w['code'];
            $_ext[3] = $w['name'];
            $id_h = $w['id'];
            $d1 = array_map('trim', $_ext);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }
        fclose($f);

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с массива $facts
        foreach ($facts as $d) {
            foreach ($d as $v) {

                $d1 = explode(';', $v);
                $d1 = array_map('trim', $d1);
                $s = implode("\t", $d1);
                $s = str_replace("~", "", $s);
                $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
                fputs($f, $s);
                fputs($f, "\n");
            }
        }

        // нет объекта высшего уровня {
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        $refer = 'INSTLN';
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;

        $err = no_refer_facts($fname);

        if (count($err) > 0) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('FACTS','$v','$refer',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }

        // нет объекта высшего уровня }
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";

        $sql_ab = data_from_server($sql_err, $res, $vid);

        //kol struckt{
        $col = count_str($fname);
        //kol struckt}

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }

    // Формирование файла facts для САП для бытовых потребителей
    public function actionSap_facts_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        $asd = ["01" => 'BC010131',
            "02" => 'BC010231',
            "03" => 'BC010331',
            "04" => 'BC010431',
            "05" => 'BC010531',
            "06" => 'BC010631',
            "07" => 'BC010731',
            "08" => 'BC010831',
        ];
        // Получаем дату ab
        $sql_d = "select (fun_mmgg() - interval '4 month')::date as mmgg_current";
        $data_d = data_from_server($sql_d, $res, $vid);
        $date_ab = $data_d[0]['mmgg_current'];

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select distinct fun_mmgg() as datab,facts.id,facts.power,max(facts.plita) as plita,max(facts.opal) as opal,max(facts.mmgg) as mmgg,
max(facts.mmgg_end) as mmgg_end,facts.ver,max(facts.dem_0) as dem_0,max(facts.dem_9) as dem_9,
max(facts.dem_10) as dem_10,max(facts.dem_6) as dem_6,max(facts.dem_7) as dem_7,max(facts.dem_8) as dem_8  from
(select distinct id,power,plita,opal,max(mmgg-interval '0 month')::date as mmgg,
(mmgg_end-interval '0 month')::date as mmgg_end,ver,sum(dem_0) as dem_0,sum(dem_9) as dem_9,
sum(dem_10) as dem_10,sum(dem_6) as dem_6,sum(dem_7) as dem_7,sum(dem_8) as dem_8  from
(select q.* from (
select c.id as id,b.dt_b,case when a.id_zone=0 or a.id_zone is null then coalesce(demand,0) end as dem_0,
case when a.id_zone=9 then coalesce(demand,0) end as dem_9,
case when a.id_zone=10 then coalesce(demand,0) end as dem_10,
case when a.id_zone=6 then coalesce(demand,0) end as dem_6,
case when a.id_zone=7 then coalesce(demand,0) end as dem_7,
case when a.id_zone=8 then coalesce(demand,0) end as dem_8,
max(a.mmgg) OVER (PARTITION BY a.id_paccnt,a.id_zone) as mmgg,(max(a.mmgg) OVER (PARTITION BY a.id_paccnt,a.id_zone)+interval '1 month'-interval '1 day') as mmgg_end,b.power,
case when c.id_gtar in(3,5,16) then 1 end as plita,
case when c.id_gtar in(4,6,14) then 1 end as opal,const.ver
from clm_paccnt_tbl c
left join clm_meterpoint_tbl b on c.id=b.id_paccnt and c.archive='0'
left join clm_plandemand_tbl a on a.id_paccnt=b.id_paccnt and a.work_period=(select max(work_period) from clm_plandemand_tbl)
left join (select (fun_mmgg())::date as mmgg_current) w1
on 1=1
left join (select id_paccnt,max(mmgg) as mmgg,id_zone,max(dat_ind) as dat_ind from acm_indication_tbl 
group by id_paccnt,id_zone) j on j.id_paccnt=a.id_paccnt --and j.mmgg=w1.mmgg_current
 and j.id_zone=a.id_zone
inner join sap_const const on 1=1
--where c.id=100042822
where c.archive='0'  -- and a.work_period=(select max(work_period) from clm_plandemand_tbl)
order by b.id_paccnt
) q
left join 
(select (fun_mmgg())::date as mmgg_current) w
on 1=1
--where mmgg=mmgg_current
) s
group by id,power,plita,opal,mmgg_end,ver) facts
inner join 
(select a.id,'10' as sparte,'02' as spebene,'0002' as anlart,'0001' as ablesartst,
                                case when length(adr.last_name||' '||adr.name||' '||adr.patron_name)>0 then 
                            adr.last_name||' '||adr.name||' '||adr.patron_name else
                                 adr.code end as zz_nametu,'' as zz_fider,'$date_ab' as ab,'CK_1AL2_01' as tariftyp,
                                '0001' as aklasse,ff.ableinh as ableinh,b.begru,a.eic,b.ver,c.oldkey as vstelle,
                                case when trim(adr.type_city)='м.' then '70' else '71' end as branche, p.id_sector
                                from clm_paccnt_tbl a 
                                inner join sap_const b on 1=1
                                left join sap_evbsd c on a.id=substr(c.oldkey,9)::integer
                                left join vw_address adr on a.id=adr.id
                                left join prs_runner_paccnt p on p.id_paccnt=a.id
                        left join (                
                                select qwe.id,qwe.name,'$asd[$rem]' as ableinh from (
                                select distinct c.id,c.name from prs_runner_sectors c
                                left join prs_runner_paccnt p on p.id_sector=c.id
                                left join clm_paccnt_tbl as pa on pa.id=p.id_paccnt
                                where pa.archive = '0'
                                order by c.name
                                ) qwe
                                ) ff
                        on ff.id=p.id_sector
                where a.archive='0'
                ) instln on
                facts.id=instln.id
                group by 1,facts.id,facts.power,facts.ver
                order by facts.id
                -- limit 10
";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массив $facts
        $i = 0;
        foreach ($data as $w) {
            $facts[$i] = f_facts_ind($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с массива $facts
        foreach ($facts as $d) {
            foreach ($d as $v) {

                $d1 = explode(';', $v);
                $d1 = array_map('trim', $d1);
                $s = implode("\t", $d1);
                $s = str_replace("~", "", $s);
                $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
                fputs($f, $s);
                fputs($f, "\n");
            }
        }

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        if (1 == 2) {  // отключено
            // нет объекта высшего уровня {
            $refer = 'INSTLN';
            $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;

            $err = no_refer_facts($fname);
//            debug($err);
//            return;

            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('FACTS','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }

            // нет объекта высшего уровня }
            fclose($f);
        }

        $sql_err = "select * from sap_err where upload = '$filename'";

        $sql_ab = data_from_server($sql_err, $res, $vid);

        //kol struckt{

        $col = count_str($fname);
        //kol struckt}

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        fclose($f);
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//
//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

//        return $this->render('info', [
//            'model' => $model]);
    }

    //выгрузка ид фалов сап факты , для бытовых потребителей
    public function actionIdfile_facts_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'FACTS' as OM,'04_C'||ext.id_res||'B_01_'||ext.id as oldkey,kk.code,trim((v.last_name||' '||substr(v.name, 1, 1)||'.'||substr(v.patron_name, 1, 1)||'.')) as name_tu,ext.ver from (

                select id,power,plita,opal,mmgg::date,mmgg_end::date,ver,sum(dem_0) as dem_0,sum(dem_9) as dem_9,
sum(dem_10) as dem_10,sum(dem_6) as dem_6,sum(dem_7) as dem_7,sum(dem_8) as dem_8, s.id_res from
(select q.* from (
select a.id_paccnt as id,b.dt_b,case when a.id_zone=0 then demand end as dem_0,
case when a.id_zone=9 then demand end as dem_9,
case when a.id_zone=10 then demand end as dem_10,
case when a.id_zone=6 then demand end as dem_6,
case when a.id_zone=7 then demand end as dem_7,
case when a.id_zone=8 then demand end as dem_8,
a.mmgg,(a.mmgg+interval '1 month'-interval '1 day') as mmgg_end,b.power,
case when c.id_gtar in(3,5,16) then 1 end as plita,
case when c.id_gtar in(4,6,14) then 1 end as opal,const.id_res,const.ver
from clm_meterpoint_tbl b 
left join clm_plandemand_tbl a on a.id_paccnt=b.id_paccnt
inner join clm_paccnt_tbl c on c.id=a.id_paccnt and c.archive='0'
left join (select (fun_mmgg() - interval '1 month')::date as mmgg_current) w1
on 1=1
inner join (select id_paccnt,mmgg,id_zone,max(dat_ind) as dat_ind from acm_indication_tbl 
group by id_paccnt,id_zone,mmgg) j on j.id_paccnt=a.id_paccnt and j.mmgg=w1.mmgg_current and j.id_zone=a.id_zone
inner join sap_const const on 1=1
where a.mmgg=w1.mmgg_current 
order by a.id_paccnt
) q
left join 
(select (fun_mmgg() - interval '1 month')::date as mmgg_current) w
on 1=1
where mmgg=mmgg_current) s
group by id,power,plita,opal,mmgg,mmgg_end,ver,id_res,ver) as ext
		left join vw_address as v
                on v.id=ext.id
                left join clm_paccnt_tbl as kk
                on kk.id=v.id";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла inst_mgmt для САП для бытовых потребителей
    public function actionSap_inst_mgmt_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select distinct on(id) * from 
(select *,max(dat_ind) over(partition by id) as dat_ind_last from
(select id,sum(value_0) as value_0,
sum(value_9) as value_9,sum(value_10) as value_10,
sum(value_6) as value_6,sum(value_7) as value_7,sum(value_8) as value_8,
sum(value_0+value_9+value_10+value_6+value_7+value_8) as value_all,
dat_ind,devloc,anlage,equnre,action,
coalesce(sum(demand_0),0) as demand_0,
coalesce(sum(demand_9),0) as demand_9,
coalesce(sum(demand_10),0) as demand_10,
coalesce(sum(demand_6),0) as demand_6,
coalesce(sum(demand_7),0) as demand_7,
coalesce(sum(demand_8),0) as demand_8,
eadat,ver,zone from
(select distinct aa.id as id,
case when a.id_zone=0 or a.id_zone is null then coalesce(a.value,0) else 0.0000 end as value_0,
case when a.id_zone=9 then a.value else 0.0000 end as value_9,
case when a.id_zone=10 then a.value else 0.0000 end as value_10,
case when a.id_zone=6 then a.value else 0.0000 end as value_6,
case when a.id_zone=7 then a.value else 0.0000 end as value_7,
case when a.id_zone=8 then a.value else 0.0000 end as value_8,

a.dat_ind,
'04_C'||$$$rem$$||'B_'||a.id_paccnt as devloc,'04_C'||$$$rem$$||'B_01_'||a.id_paccnt as anlage,
'04_C'||$$$rem$$||'B_'||m.id as equnre,
'01' as action,
 case when a.id_zone=0 or a.id_zone is null then coalesce(p.demand,0) else 0 end demand_0,
 case when a.id_zone=9 then p.demand else 0 end demand_9,
  case when a.id_zone=10 then p.demand else 0 end demand_10,
  case when a.id_zone=6 then p.demand else 0 end demand_6,
  case when a.id_zone=7 then p.demand else 0 end demand_7,
  case when a.id_zone=8 then p.demand else 0 end demand_8,
 (w1.mmgg_current + interval '1 month')::date as  eadat,const.ver,
 case when a.id_zone=0 or a.id_zone is null then 0 
 when a.id_zone in(9,10) then 9
 when a.id_zone in(6,7,8) then 6
 end as zone
 from clm_paccnt_tbl aa 
 left join acm_indication_tbl a on aa.id=a.id_paccnt and aa.archive='0'
left join
(select max(dat_ind) as dat_ind,id_paccnt,id_zone,id_typemet from acm_indication_tbl group by id_paccnt,id_zone,id_typemet) b on
a.id_paccnt=b.id_paccnt and a.id_zone=b.id_zone and a.dat_ind=b.dat_ind
left join (select  b.id_zone,a.id_paccnt,a.id_type_meter from clm_meterpoint_tbl a
left join clm_meter_zone_h b on a.id=b.id_meter) d  on d.id_paccnt=b.id_paccnt and d.id_type_meter=b.id_typemet and d.id_zone=b.id_zone
--left join clm_paccnt_tbl c on aa.id=c.id and c.archive='0'
--left join sap_egpld devloc on devloc.oldkey='04_C04B_'||a.id_paccnt
left join (select (fun_mmgg() - interval '1 month')::date as mmgg_current) w1
on 1=1
left join clm_meterpoint_tbl m on m.id_paccnt=a.id_paccnt 
left join clm_plandemand_tbl p on p.id_paccnt=a.id_paccnt and p.id_zone=a.id_zone and p.mmgg=w1.mmgg_current 
inner join sap_const const on 1=1
where (a.id_operation<>5 or a.id_operation is null) and aa.archive='0' 
and not(m.id_type_meter=0 or trim(m.num_meter)='0' or m.num_meter is null)
order by 1) t
group by 1,9,10,11,12,13,20,21,22
order by 1) w ) ww
where  (dat_ind=dat_ind_last or dat_ind is null)
-- limit 10
";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;
        foreach ($data as $w) {
            $di_int[$i] = f_inst_mgmt1_ind($rem, $w);
            $di_zw[$i] = f_inst_mgmt2_ind($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($di_int as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            foreach ($di_zw[$i] as $v) {
                $d1 = array_map('trim', $v);
                $s = implode("\t", $d1);
                $s = str_replace("~", "", $s);
                $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
                fputs($f, $s);
                fputs($f, "\n");
            }
            $i++;
        }

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        if (1 == 2) {  // отключено
            // задвоения по oldkey  {
            $err = double_oldkey($fname);
            // Запись в таблицу ошибок
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
            // задвоения по oldkey  }

            // нет объекта высшего уровня {
            $sql = "SELECT * from sap_refer where upload='$filename'";
            $data_u = data_from_server($sql, $res, $vid);
            $refer = $data_u[0]['refer'];
            $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
            if (!empty($data_u[0]['upload'])) {
                $err = no_refer($fname, $data_u);
                if (count($err)) {
                    foreach ($err as $v) {
//                    debug($v);
                        $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                        exec_on_server($z, (int)$rem, $vid);
                    }
                }
            }
            // нет объекта высшего уровня }

            // пустая ссылка {
            $msg = 'Пустая ссылка';
            $err = empty_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }

            }
            // пустая ссылка }
        }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        fclose($f);
//
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//        return $this->render('info', [
//            'model' => $model]);
    }

    // Формирование файла imove_in для САП для бытовых потребителей
    public function actionSap_move_in_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select  distinct a.id,b.num_agreem as vrefer,'01' as kofiz,1 as gemfakt,const.begru as bukrs,const.begru_b as begru,const.ver,
--CASE WHEN instln.oldkey IS NULL THEN substr(account.oldkey,1,8)||'01_'||substr(account.oldkey,9) else instln.oldkey end as anlage,
instln.oldkey as anlage,
account.oldkey as vkonto,replace(w1.mmgg_current::char(10),'-','') as einzdat,
'99991231' as auszdat,replace(w1.mmgg_current::char(10),'-','') as einzdat_alt,const.cokey,'~' as zz_pnt,
'~' as zz_nodev,'99991231' as zz_own,1 as zz_point_num,1 as zz_plosch_num,1 as zz_object_num,1 as zz_pl_obj_num,
'~' as zz_paym_dc,'02' as zz_distrib_type,'~' as vbez
from clm_paccnt_tbl a
left join (select max(date_agreem) as date_agreem,max(num_agreem) as num_agreem,id_paccnt from clm_agreem_tbl group by id_paccnt) b
on a.id=b.id_paccnt
inner join sap_const const on 1=1
left join sap_data instln on substr(instln.oldkey,12)::int=a.id
left join sap_init_acc account on substr(account.oldkey,9)::int=a.id
left join sap_init partner on substr(partner.old_key,9)::int=a.id
left join (select (fun_mmgg())::date as mmgg_current) w1 on 1=1
where a.archive='0'	
-- limit 10	       
";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;
        foreach ($data as $w) {
            $ever[$i] = f_move_in_ind($rem, $w);
//            $ever1[$i]=f_move_in_ind1($rem,$w);
            $i++;
        }

//        debug($ever);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($ever as $d) {
            $d1 = array_map('trim', $d);
//            debug($d1);
//            return;
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");
        }


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        if (1 == 2) {  // отключено
            // задвоения по oldkey  {
            $err = double_oldkey($fname);
            // Запись в таблицу ошибок
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
            // задвоения по oldkey  }


            // нет объекта высшего уровня {

            $sql = "SELECT * from sap_refer where upload='$filename'";
            $data_u = data_from_server($sql, $res, $vid);

            $refer = $data_u[0]['refer'];
            $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
            if (!empty($data_u[0]['upload'])) {
                $err = no_refer($fname, $data_u);
                if (count($err)) {
                    foreach ($err as $v) {
//                    debug($v);
                        $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                        exec_on_server($z, (int)$rem, $vid);
                    }
                }
            }
            // нет объекта высшего уровня }


            // пустая ссылка {
            $msg = 'Пустая ссылка';
            $err = empty_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }

            }
            // пустая ссылка }
        }

        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        fclose($f);
//
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//        return $this->render('info', [
//            'model' => $model]);
    }


// Формирование файла move_in для САП для юрид. потребителей
    public function actionSap_move_in($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        $sql_p = " select (max(mmgg) + interval '1 month')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $period = str_replace('-', '', $data_p[0]['mmgg']);  // Получаем текущий отчетный период
        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "
select * from (
select const.opbuk as bukrs,stt.doc_num as vrefer,
tt.*,
case when stt.flag_budjet = 1 then '03' else case when coalesce(cc2.idk_work,0)=99 then '04' else '02' end  end  as kofiz,
'1' as gemfakt,'' as vbez,stt.doc_num as vreffer,'$period'::text as einzdat,''::text as auszdat,dt_b as einzdat_alt,
case when  coalesce(cc2.idk_work,0) = 99 then  const.opbuk||'01100' when stt.flag_budjet = 1 then const.opbuk || '01110' else const.opbuk || '01100' end  as cokey,
''::text as zz_pnt,
''::text as zz_nodev,''::text as zz_own,
row_number() OVER (PARTITION BY id_cl)::int as zz_point_num,
row_number() OVER (PARTITION BY vstelle)::int as zz_plosch_num,
row_number() OVER (PARTITION BY vstelle,id_cl)::int as zz_object_num,
1 as zz_pl_obj_num,
(case when coalesce(stt.flag_reactive,0)=0 then 'X' else '' end ) as zz_paym_dc,
'31793056' as zz_bp_distrib,
ci.edrpou_contr as zz_bp_provider,
case when ci.id=2 then '03'
when ci.id=1000000 then '02' else '01' end as zz_distrib_type
from
(select distinct on(zz_eic) case when qqq.oldkey is null then trim(qqq.oldkey) else trim(qqq.oldkey) end as vstelle,
www.short_name as real_name,const.ver,const.begru,
'10'::text as sparte,qqq.* from
(select distinct on(q1.num_eqp) q1.id,x.oldkey,cc.short_name,cc.code,
case when q.id_cl=2062 then rr.id_client else q.id_cl end as id_potr,
q1.num_eqp as zz_eic,q.* from
(select  distinct 'DATA' as DATA,c2.id as id_cl,p.dt_b,
case when p.voltage_max = 0.22 then '02'
     when p.voltage_max = 0.4 then '03'
     when p.voltage_max = 10.00 then '05' 
     when p.voltage_max = 6.0 then '04'
     when p.voltage_max = 27.5 then '06'
     when p.voltage_max = 35.0 then '07'
     when p.voltage_max = 110.0 then '08' else '' end as SPEBENE,
'0001' as ANLART,
'0002' as ABLESARTST,
p.name_eqp as ZZ_NAMETU,
p.eic_code,
'' as ZZ_FIDER,
'$period' as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'  
     when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???' 
     else 
	case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???' 
	else '???' --tar_sap.id_sap_tar 
	end 
end  as TARIFTYP,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' then '0004' else '0002' end as AKLASSE,
     '' as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
     when tgr.ident in('tgr2') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
     when tgr.ident in('tgr6') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
     when tgr.ident in('tgr3') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
     when tgr.ident in('tgr4') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
     when tgr.ident in('tgr1') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999)  then '054'
     when tgr.ident in('tgr2') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
     when tgr.ident in('tgr6') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
     when tgr.ident in('tgr3') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
     when tgr.ident in('tgr4') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
     when tgr.ident in('tgr8_10','tgr8_30') then '298'
     when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
     when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '352'
     when ((tgr.ident ~ 'tgr7_12') or (tgr.ident~ 'tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007)  in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)  and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521'  and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and  tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and  tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10  and tcl.ident='tcl1' then '604'
when c.idk_work=99 and p.voltage_min<=10 and tcl.ident='tcl2' then '606'
when tcl.ident='tcl1' and p.id_extra =1003 then '632'
when tcl.ident='tcl2' and p.id_extra =1003 then '634'
when tcl.ident='tcl1' and p.id_extra in (1001,1002,1012,1013) then '638'
when tcl.ident='tcl2' and p.id_extra in (1001,1002,1012,1013) then '640'
when tgr.ident in('tgr8_101') then '666'
 else '' end as ZZCODE4NKRE,
'' as ZZCODE4NKRE_DOP,
'' as ZZOTHERAREA,
'1' as sort 
from (select eq.num_eqp as eic_code,dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, tr.id_grouptarif --, ph.id_extra --, tr.id_classtarif
	from eqm_equipment_tbl as eq 
	join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) 
	left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) 
	left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
	left join eqk_zone_tbl AS z on (dt.zone=z.id) 
	left join cla_param_tbl AS cla on (dt.id_depart=cla.id) 
	left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
	left join clm_position_tbl as cp on (cp.id = dt.id_position) ) as p 
join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
join eqm_tree_tbl as t on (t.id = tt.id_tree) 
join (select distinct id,code,idk_work from clm_client_tbl) as c on (c.id = t.id_client) 
left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
left join clm_statecl_tbl as st on (st.id_client = c2.id) 
left join aci_tarif_tbl as tar on (tar.id=p.id_tarif)
--left join sap_energo_tarif as tar_sap on tar_sap.id_tar = p.id_tarif
left join eqi_grouptarif_tbl as tgr on tgr.id= p.id_grouptarif
left join eqi_classtarif_tbl as tcl on (p.id_classtarif=tcl.id) 
--left join reading_controller as w on w.tabel_numb = p.num_tab
left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp) 
left join (select code_eqp, trim(sum(e.name||','),',') as energy from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en on (en.code_eqp = p.code_eqp) 
) q 
left join eqm_equipment_tbl q1 
on q.zz_nametu::text=q1.name_eqp::text and substr(trim(q1.num_eqp)::text,1,3)='62Z' and trim(q1.num_eqp)=trim(q.eic_code) 
left join eqm_area_tbl ar on ar.code_eqp=q1.id
--left join sap_evbsd x on case when trim(x.haus)='' then 0 else coalesce(substr(x.haus,9)::integer,0) end =q1.id
left join (select distinct id_eq,id_tu from sap_premise_dop) aa on aa.id_tu=q1.id
left join sap_evbsd x on substr(x.oldkey,11)::int in (aa.id_eq)
left join clm_client_tbl as cc on cc.id = q.id_cl
left join 
(select u.id_client,a.id from eqm_equipment_tbl a
   left join eqm_point_tbl tu1 on tu1.code_eqp=a.id 
   left JOIN eqm_compens_station_inst_tbl AS area ON (a.id=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_area_tbl u on u.code_eqp=area.code_eqp_inst
   left join clm_client_tbl u1 on u1.id=u.id_client) rr 
   on rr.id=q1.id and (x.oldkey is null or q.id_cl=2062)
where SPEBENE::text<>'' and q1.num_eqp is not null
)
 qqq
left join eqm_eqp_use_tbl use on use.code_eqp=qqq.id 	
left join sap_evbsd yy on case when trim(yy.haus)='' then 0 else coalesce(substr(yy.haus,9)::integer,0) end=--qqq.id_potr
case when qqq.id_potr=2062 then use.id_client else coalesce(qqq.id_potr,use.id_client) end
left join clm_client_tbl www on www.id=coalesce(qqq.id_potr,use.id_client)
inner join sap_const const on 1=1) tt
left join clm_statecl_tbl as stt on (stt.id_client = tt.id_cl) 
left join clm_client_tbl as cc2 on (tt.id_cl = cc2.id) 
left join eqm_eqp_use_tbl use1 on use1.code_eqp=tt.id 	
left join (select distinct id_contractor,id_client from clm_contractor_tbl 
where dt_contr_end is null and id_contractor is not null limit 1) ct on ct.id_client=cc2.id
left join cli_contractor_tbl ci on ci.id=ct.id_contractor and ci.edrpou_contr is not null 
inner join sap_const const on 1=1
WHERE (cc2.code>999 or cc2.code=900) AND coalesce(cc2.idk_work,0)<>0 or (cc2.code=999 and use1.code_eqp is not null) 
	     and  cc2.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001')
	   
order by 8,zz_point_num,zz_plosch_num,zz_object_num  
) r 
join
sap_data ust on substr(ust.oldkey,12)::int=r.id
";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных


        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;

        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        $oldkey_const = '04_C' . $rem . 'P_01_';
        foreach ($data as $w) {
            $ever[$i] = f_move_in($rem, $w);
//            $ever1[$i]=f_move_in_ind1($rem,$w);
            $i++;
            // Делаем _ext файл
            $_ext[0] = 'MOVE_IN';
            $_ext[1] = $oldkey_const . $w['id'];
            $_ext[2] = $w['code'];
            $_ext[3] = $w['short_name'];

            $d1 = array_map('trim', $_ext);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($ever as $d) {
            $d1 = array_map('trim', $d);
//            debug($d1);
//            return;
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");
        }


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // нет объекта высшего уровня {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        /*
        $refer = 'Нет объекта высшего уровня в выгрузке '.$refer;
        if(!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z="INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
        // нет объекта высшего уровня }
*/
        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }

        }
        // пустая ссылка }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }

    //выгрузка ид фалов сап imove_in , для бытовых потребителей
    public function actionIdfile_move_in_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'MOVE_IN_IND' as OM,'04_C'||ext.id_res||'B_01_'||ext.id as oldkey,kk.code,trim((v.last_name||' '||substr(v.name, 1, 1)||'.'||substr(v.patron_name, 1, 1)||'.')) as name_tu,ext.ver from (

select a.id,b.num_agreem as vrefer,'01' as kofiz,1 as gemfakt,const.begru as bukrs,const.begru_b as begru,const.ver,const.id_res,
instln.oldkey as anlage,account.oldkey as vkonto,replace(w1.mmgg_current::char(10),'-','') as einzdat,
'99991231' as auszdat,replace(w1.mmgg_current::char(10),'-','') as einzdat_alt,const.cokey,partner.old_key as zz_pnt,
'~' as zz_nodev,'99991231' as zz_own,1 as zz_point_num,1 as zz_plosch_num,1 as zz_object_num,1 as zz_pl_obj_num,
'~' as zz_paym_dc,'02' as zz_distrib_type
from clm_paccnt_tbl a
left join (select max(date_agreem) as date_agreem,num_agreem,id_paccnt from clm_agreem_tbl group by id_paccnt,num_agreem) b
on a.id=b.id_paccnt
inner join sap_const const on 1=1
left join sap_data instln on substr(instln.oldkey,12)::int=a.id
left join sap_init_acc account on substr(account.oldkey,9)::int=a.id
left join sap_init partner on substr(partner.old_key,9)::int=a.id
left join (select (fun_mmgg() - interval '1 month')::date as mmgg_current) w1 on 1=1
where a.archive='0'

) as ext
		left join vw_address as v
                on v.id=ext.id
                left join clm_paccnt_tbl as kk
                on kk.id=v.id";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Выгрузка всех ID файлов (САП)  для бытовых потребителей

    public function beforeAction($action)
    {
//       debug($action);
        if ($action->id == 'idfile_launch') {
//            debug($action->request);
            // $e=$action->controller->module->request;
            $log = 'aaalog_ext.txt';
            $f = fopen($log, "a+");

            $e = Yii::$app->request->get('nom');
            fputs($f, $e);
            fputs($f, "\n");
            $res = Yii::$app->request->get('res');
            $r = Yii::$app->response->redirect([$e, 'res' => $res, 'par' => 1])->send();
            Yii::app()->runController('site/index');
            $r1 = Yii::$app->response->redirect(['idfile_premise_ind', 'res' => $res, 'par' => 1])->send();
            return false;
            //debug($e);

//            if (!\Yii::$app->user->isSessionActive()) {
//                $this->redirect(['/session/auth/']);
//            }
        }

        return parent::beforeAction($action);
    }

    public function actionIdfile_launch($nom, $res, $i)
    {
        //$r=Yii::$app->response->redirect(['All_idfile',  'res' => $res,'par' => 1])->send();
        return $i;
    }

    public function actionAll_idfile($res)
    {
        $actions = [
            'idfile_partner_ind',
            'idfile_premise_ind',
            'idfile_account_ind',
            'idfile_devloc_ind',
            'idfile_device_ind',
            'idfile_seals_ind',
            'idfile_instln_ind',
            'idfile_facts_ind',
            'idfile_move_in_ind'
        ];
        $log = 'log_ext.txt';
        $f = fopen($log, "w+");
        for ($i = 0; $i < 9; $i++) {
            $e = '$this->action' . ucfirst($actions[$i]) . '($res,$par=0);';
            eval($e);
            fputs($f, 'Сформирован файл ' . $actions[$i] . '_ext');
            fputs($f, "\n");
        }
        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файли _ext  сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    public function actionAll_sapfile($res)
    {
        $actions = [
            'sap_partner_ind',
            'sap_connobj_ind',
            'sap_premise_ind',
            'sap_account_ind',
            'sap_devloc_ind',
            'sap_device_ind',
            'sap_seal_ind',
            'sap_instln_ind',
            'sap_facts_ind',
            'sap_inst_mgmt_ind',
            'sap_move_in_ind',
            'sap_discdoc_ind',
            'sap_discorder_ind',
            'sap_discenter_ind'
        ];
        $log = 'log_sap.txt';
        $f = fopen($log, "w+");
        for ($i = 0; $i < 14; $i++) {
            $e = '$this->action' . ucfirst($actions[$i]) . '($res,1);';
            eval($e);
            fputs($f, 'Сформирован файл ' . $actions[$i]);
            fputs($f, "\n");
        }
        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файли _sap сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    public function actionAll_idfile_full()
    {
        $actions = [
            'idfile_partner_ind',
            'idfile_premise_ind',
            'idfile_account_ind',
            'idfile_devloc_ind',
            'idfile_device_ind',
            'idfile_seals_ind',
            'idfile_instln_ind',
            'idfile_facts_ind',
            'idfile_move_in_ind'
        ];
        $log = 'log_ext.txt';
        $f = fopen($log, "w+");
        for ($res = 1; $res < 9; $res++) {
            for ($i = 0; $i < 9; $i++) {
                $e = '$this->action' . ucfirst($actions[$i]) . '($res,$par=0);';
                eval($e);
                fputs($f, 'Сформирован файл ' . $actions[$i] . '_ext' . " для РЭСа $res");
                fputs($f, "\n");
            }
        }
        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файли _ext  сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }


    // Формирование файла пломб(seal) для САП для юр. потребителей
    public function actionSap_seals($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        // Главный запрос со всеми необходимыми данными
        $sql = "select *,case when gg=1 then scode1 else scode1 || '_' || gg end as scode,
case when gg=100 then id1::text else id1 || '_' || gg end as id from (
select *,row_number() over(partition by SCAT,scode1)+99 as gg from (
select distinct 
        p.id as id1,'AUTO' as AUTO, 
        --p.id_type as SCAT,
        sp.sap_name as SCAT,
        t.name as SCAT_cek,
        trim(p.plomb_num) as SCODE1,
        'I' as STATUS,
        '3' as COLOR,
        'C010099' as UTMAS, 
        substring(replace(p.dt_b::varchar, '-',''),1,8) as DPURCH,
        'C010099' as REPER,
        substring(replace(p.dt_b::varchar, '-',''),1,8) as DISSUE,
        u.matnr as MATNR,
        u.sernr as SERNR,
        --coalesce(obj.id_sap,8) as PLACE,
        p.object_name,
        case when p2.id is not null then p2.id else '8' end as PLACE,
        substring(replace(p.dt_b::varchar, '-',''),1,8) as DINST,const.ver
        from clm_plomb_tbl as p 
        left join cli_plomb_type_tbl as t on (t.id = p.id_type) 
        left join clm_position_tbl as cp on (cp.id = p.id_position) 
        left join clm_position_tbl as cp2 on (cp2.id = p.id_person)
        left join sap_type_plombs sp on case when trim(t.name)='Пластикова' then upper(trim(sp.cek_name))='ФАВОРИТ' 
        else upper(trim(sp.cek_name))=upper(trim(t.name)) end 
        left join clm_client_tbl as c on (c.id = p.id_client ) 
        left join clm_statecl_tbl as st on st.id_client = c.id
        inner join eqm_equipment_tbl as eq on (eq.id = p.id_point) 
        left join adv_address_tbl as adr on (adr.id = eq.id_addres ) 
        left join sap_recode_place_plomb p1 on trim(p1.place_cek)=trim(p.object_name)
        left join spr_place_plomb p2 on trim(p2.name)=trim(p1.place_sap)
         inner join sap_const const on 1=1
         left join (select oldkey,get_tu(extract_n(substr(oldkey,9,6))::integer) as id_tu,matnr,sernr from sap_equi) u on u.id_tu=eq.id
         where (c.code>999 or  c.code=900) AND coalesce(c.idk_work,0)<>0 
                 and  c.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                '10999999','11000000','19999369','50999999','1000000','1000001')
                and sp.sap_name is not null  -- AND  p.id=3130
         ORDER BY 13 ) plombs) q      
       where matnr is not null

          ";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "'];";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;
            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }
        // Удаляем данные в таблицах структур
        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }


    public function actionIdfile_seals($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'SEALS' as OM,oldkey,p.code,p.short_name as name_tu,const.ver from sap_AUTO as a
                left join clm_plomb_tbl as k
                on substr(a.oldkey,12,4)::int=k.id
                left join clm_client_tbl as p 
                on k.id_client=p.id
                left join sap_const as const
                on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }


    // Формирование файла заводских пломб (seals) для САП для юр. потребителей
    public function actionSap_seals2($res)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Главный запрос со всеми необходимыми данными
        $sql = "select * from
        (select distinct 
        p.id,'AUTO' as AUTO,
        u.matnr as MATNR,
        u.sernr as SERNR,
        substring(replace(p.dt_b::varchar, '-',''),1,8) as INSTDATE,
        p.plomb_owner,
        case when upper(trim(p.plomb_owner)) ~'ДЕР' or upper(trim(p.plomb_owner)) ~'ЦСМ' then 'VER.OFF.' when upper(trim(p.plomb_owner)) ~'ЗАВОД' or upper(trim(p.plomb_owner)) ~'НІК' or upper(trim(p.plomb_owner)) ~'ВИРОБН' then 'PLANT' else 'VER.OFF.' end as EMPLOYEE,
        '1' as INSTREASON,
        '' as PLIERS,const.ver
        from clm_plomb_tbl as p 
        left join cli_plomb_type_tbl as t on (t.id = p.id_type) 
        left join clm_position_tbl as cp on (cp.id = p.id_position) 
        left join clm_position_tbl as cp2 on (cp2.id = p.id_person) 
        left join clm_client_tbl as c on (c.id = p.id_client ) 
        left join clm_statecl_tbl as st on st.id_client = c.id
        left join eqm_equipment_h as eq on (eq.id = p.id_point) 
        --left join eqm_equipment_tbl as eq1 on (eq.id = eq1.id) 
        left join adv_address_tbl as adr on (adr.id = eq.id_addres ) 
        --left join sap_plomb_workers as w on cp.num_tab = w.tabel_numb
        left join (select oldkey,get_tu(substr(oldkey,9)::integer) as id_tu,matnr,sernr from sap_equi) u on u.id_tu=eq.id
        inner join sap_const const on 1=1
        ) r 
        where employee='PLANT'
         ";

        if ($helper == 1)
            $sql = $sql . ' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Включение режима помощника
        if ($helper == 1) {
            $fhelper = $routine . '_HELPER' . '.txt';
            $ff = fopen($fhelper, 'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var = '$' . $k . '=$v' . '[' . "'" . $k . "']";
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i = 0;
            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var = 'if ($n_struct==' . "'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "' . " insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values . ")" . '";';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = ' exec_on_server($z,(int) $rem,$vid);';
                fputs($ff, $z);
                fputs($ff, "\n");
                $z = "}";
                fputs($ff, $z);
                fputs($ff, "\n");
            }

            // Выдаем предупреждение на экран об окончании формирования файла для помощи
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл допомоги $fhelper сформовано.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }

        // Удаляем данные в таблицах структур
        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        if (isset($data[0]['ver']))
            $ver = $data[0]['ver'];
        else
            $ver = $res;

        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        fclose($f);
        // Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }

    public function actionIdfile_seals2($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'SEALS2' as OM,oldkey,p.code,p.short_name as name_tu,const.ver from sap_auto1 as a
                left join clm_plomb_tbl as k
                on substr(a.oldkey,12)::int=k.id
                left join clm_client_tbl as p 
                on k.id_client=p.id
                left join sap_const as const
                on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }


    // Формирование файла connobj для САП для бытовых
    public function actionSap_connobj_ind($res, $par = 0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind')
            $vid = 1;
        else
            $vid = 2;

        // Главный запрос со всеми необходимыми данными
        $c = '"';
        $sql = "select min(id) as id,trim(town) as town,trim(town_sap) as town_sap,trim(street) as street,trim(street_sap) as street_sap,
trim(type_street) as type_street,trim(house) as house,id_res,swerk,
stort,ver,begru,trim(region) as region,trim(type_street) as type_street,trim(kod_reg) as kod_reg,coalesce(str_supl2,'') as str_supl1,
coalesce(str_supl2,'') as str_supl2,coalesce(korp,'') as korp from
(select min(a.id) as id,
                c.town,trim(b1.town) as town_sap,trim(c.street) as street,
                case when b1.street is null then 'Неопределено' else b1.street end as street_sap,c.type_street,
                case when c.korp is null or trim(c.korp) like " . "'%" . '"' . "%'" . "  then upper(trim(c.house)) else 
                case when NOT(c.korp ~ '[0-9]+$')  then upper(trim(c.house))||upper(trim(c.korp)) 
               else upper(trim(c.house))||'/'||upper(trim(c.korp))  end end as house
               -- else c.house end end as house
                ,const.id_res,
                const.swerk,const.stort,const.ver,const.begru,
                const.region,d.kod_reg,
                case when b1.street is null then c.street else '' end as str_supl1,
                case when b1.street is null then c.house else '' end as str_supl2,
                case when NOT(c.korp ~ '[0-9]+$') then '' else c.korp end as korp,
                case when trim(c.korp) not like " . "'%" . '"' . "%'" . " then upper(trim(c.korp)) else '' end as korp1
                 from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id_abon=b.id
        left join vw_address c on  
            a.id=c.id
        left join addr_sap b1 on
        case when trim(lower(c.street))='шосе кіровоградське' then  trim(lower(c.street))=trim(lower(b1.street)) else trim(lower(c.street))=trim(lower(get_sap_street(b1.street))) end
         and case when trim(lower(get_sap_street(b1.street)))='запорізьке шосе' then  lower(trim(c.type_street))='вул.'
          else case when trim(lower(c.street))='шосе кіровоградське' then 1=1 else coalesce(lower(trim(c.type_street)),'')=coalesce(lower(trim(get_typestreet(b1.street))),'') end end 
         and trim(lower(b1.town))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end ||' '||trim(lower(c.town))))
        and case when trim(b1.town)='с. Інгулець' then trim(b1.rnobl)='Криворізький район' else 1=1 end  
         
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region
        where a.archive='0'  --and c.street like '%Східний%' -- and a.id=100033028 --and  b1.street is null
         -- and a.id in (100050982,100050983) 
        group by 2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18 
        order by 5,7) z 
        group by 2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18
        order by 5,7
        -- limit 10
        ";

//debug($sql);
//    return;

        $sql_c = "select * from sap_export where objectsap='CONNOBJ_IND' order by id_object";

        if (1 == 1) {
            // Получаем необходимые данные
//            $data = data_from_server($sql,$res,$vid);
//            $cnt = data_from_server($sql_c,$res,$vid);

            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_abn->createCommand($sql_c)->queryAll();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_abn->createCommand($sql_c)->queryAll();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_abn->createCommand($sql_c)->queryAll();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_abn->createCommand($sql_c)->queryAll();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_abn->createCommand($sql_c)->queryAll();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_abn->createCommand($sql_c)->queryAll();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_abn->createCommand($sql_c)->queryAll();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_abn->createCommand($sql_c)->queryAll();
                    break;
            }


            // Удаляем данные в таблицах
            $zsql = 'delete from sap_co_eha';
            $zsql1 = 'delete from sap_co_adr';
            exec_on_server($zsql, $res, $vid);
            exec_on_server($zsql1, $res, $vid);

            $i = 0;
            // Заполняем структуры
//            debug($data);
//            return;

            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_connobj_ind($n_struct, $rem, $w);
                }
            }
        }
        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = 'CONNOBJ_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . '_R' . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_co_eha";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос

                    foreach ($cur_data as $d1) {
                        if (strtolower($table_struct) == 'sap_co_adr')
                            $d1 = array_slice($d1, 0, 10);
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        //fclose($f);


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }

        // Получаем название подпрограммы
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);
        // проверка адреса  на соответствие его с названием в САП {
        $err = check_adres($fname, 1);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет адреса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка индекса  на соответствие его с названием в САП {
        $err = check_adres($fname, 2);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет индекса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка адреса  на соответствие его с названием в САП   }

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
        $cnt = 3;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";

//        return $this->render('info', [
//            'model' => $model]);

//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//            else
//                return 1;

    }

    // Формирование файла account для САП для бытовых
    public function actionSap_account_ind($res, $par = 0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 4000);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        // Главный запрос со всеми необходимыми данными
        $sql = "select s1.*,s2.*,m.id as id_cnt,
             case when m.id_type_meter IN(0,300000010 ,200000005,999) or trim(num_meter)='0' or m.num_meter is null then 'X' else '~' end as znodev
                from
                --INIT
                (select 'INIT' as struct,a.id,a.code as vkona,
                const.vktyp as vktyp,'04_C'||$$$rem$$||'B_'||a.id as gpart,const.ver
                from clm_paccnt_tbl as a
                left join clm_abon_tbl as b on a.id_abon = b.id
                inner join sap_const const on 1=1
		       where a.archive='0'
                ) s1
                left join
                --VKP
                (select distinct 'VKP' as struct,a.id,'04_C'||$$$rem$$||'B_'||a.id as partner,const.opbuk,51 as ikey,
                const.begru_b as begru,c.adext_addr as adrnb_ext,
                '0010' as ZAHLKOND,'0001' as VERTYP,
                     '0' as KZABSVER,
                     const.opbuk as stdbk,
                     ''  as ZZ_MINISTRY,
                     '99991231' as ZZ_END,''  as ZZ_BEGIN,q.ZZ_TERRITORY,case when x.lic is not null then 'X' end as zz_is_pc,
                     case when a.id_gtar in(4,6,14) then 'X' end as zz_is_eh,
                     case when a.green_tarif='t' then 'X' end as zz_is_gf,
                     const.area_id as zz_area_id,case when y.date_agreem is null then '2018-12-01'::date else y.date_agreem end as zz_start
                from clm_paccnt_tbl as a
                left join clm_abon_tbl as b on a.id_abon = b.id
                inner join sap_const const on 1=1
                left join sap_but020 c on '04_C'||$$$rem$$||'B_'||a.id=c.old_key
                left join a_cabinet_register_tbl x on trim(x.lic)=trim(a.code)
                left join (select max(date_agreem) as date_agreem,id_paccnt from clm_agreem_tbl 
				group by id_paccnt) y on y.id_paccnt=a.id
                left join
                (select id,w,case
                when w like 'м.%' then '1'
                when w not like 'м.%' then '2'
                END as zz_territory
                from (select id,get_address(addr,3) as w from clm_paccnt_tbl) s) q
                on q.id=a.id) s2
                on s1.id=s2.id
                left join clm_meterpoint_tbl m on m.id_paccnt=s1.id
              -- limit 10
                
";

        // Запрос для получения списка необходимых
        // для экспорта структур
        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";
        $sql_err = "delete from sap_err where upload='ACCOUNT' and res=$res";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

        // Удаляем данные в таблицах
        $zsql = 'delete from sap_init_acc';
        $zsql1 = 'delete from sap_vkp';
        $zsql2 = 'delete from sap_vk';
        exec_on_server($zsql, $res, $vid);
        exec_on_server($zsql1, $res, $vid);
        exec_on_server($zsql2, $res, $vid);
        exec_on_server($sql_err, $res, $vid);

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                f_account_ind($n_struct, $rem, $w, $vid);  // Функция заполнения структур
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_init_acc";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос

        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        fclose($f);

        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        $res = (int)$rem;

        if (1 == 2) {  // отключено
            // задвоения по oldkey  {
            $err = double_oldkey($fname);
            // Запись в таблицу ошибок
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
            // задвоения по oldkey  }

            // задвоения структур {
            $err = double_struct($fname);
            if ($err <> '') {

                $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
                exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
            }
            // задвоения структур }

            // отсутствие структуры {
            $cnt = 4;
            $err = no_struct($fname, $cnt);
            if ($err <> '') {
                $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
                exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
            }
            // отсутствие структуры }

            // нет объекта высшего уровня {
            $sql = "SELECT * from sap_refer where upload='$filename'";
            $data_u = data_from_server($sql, $res, $vid);
            $refer = $data_u[0]['refer'];
            $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
            if (!empty($data_u[0]['upload'])) {
                $err = no_refer($fname, $data_u);
                if (count($err)) {
                    foreach ($err as $v) {
//                    debug($v);
                        $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                        exec_on_server($z, (int)$rem, $vid);
                    }
                }
            }
            // нет объекта высшего уровня }

            // пустая ссылка {
            $msg = 'Пустая ссылка';
            $err = empty_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
            // пустая ссылка }
        }
        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
//        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }
//        return $this->render('info', [
//            'model' => $model]);
    }

    //формирование файла идентификации
    // Формирование файла account для САП для бытовых абонентов
    public function actionIdfile_account_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'ACCOUNT' as OM,a.oldkey,b.code,(ad.last_name||' '||substr(ad.name, 1, 1)||'.'||substr(ad.patron_name, 1, 1)||'.') as name_tu,const.ver from sap_init_acc as a
                left join clm_paccnt_tbl as b
                on substr(a.oldkey,9)::int=b.id
                left join vw_address as ad on b.id=ad.id
                join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла device для САП для юридических потребителей
    public function actionSap_device($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        $day = ((int)date('d')) - 1;  // УЧЕСТЬ!!!! ДАЛЬШЕ
        $datab = date('Ymd', strtotime("-$day day")); // УЧЕСТЬ!!!! ДАЛЬШЕ

        // Получаем дату datab
        $sql_d = " select (max(mmgg) - interval '3 month')::date as mmgg_current from sys_month_tbl";
        $data_d = data_from_server($sql_d, $res, $vid);
        $date_ab = $data_d[0]['mmgg_current'];
        // Главный запрос со всеми необходимыми данными
        $sql = "select * from 
(select distinct m.code_eqp::text as id,id_type_eqp,s.sap_meter_id,case when length(m.code_eqp::varchar)<8 then 
                 (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(m.code_eqp::varchar)::int)),(7-(length(m.code_eqp::varchar)::int)))||m.code_eqp::varchar)::int else m.code_eqp end  as OLDKEY,
                'EQUI' as EQUI,
                case when eq.is_owner = 1 then '4002' else '4001' end   EQART, 
                 case when m.dt_control is null then '2004' else substring(m.dt_control::varchar,1,4) end as BAUJJ, 
                '$date_ab' as datab,
                 '' as EQKTX,
                case when m.dt_control is null then '2005' else substring(m.dt_control::varchar,1,4)  end as bgljahr,
                case  when coalesce(eq.is_owner,0) = 0 then 'CK01230370' else '' end as KOSTL, 
                 trim(eq.num_eqp) as SERNR,
                 case when eq.is_owner <> 1 then '2189' else '' end as zz_pernr,
                  substring(replace(m.dt_control::varchar,'-',''),1,8) as CERT_DATE,
                  upper(sd.sap_meter_name) as matnr,
                 case when en1.kind_energy =1 then case when eqz1.zone in (4,5,9,10) then '2' when eqz1.zone in (1,2,3,6,7,8) then '3' when  eqz1.zone = 0 then '1' else '0' end ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end||
case when en2.kind_energy =3 then case when eqz2.zone in (4,5,9,10) then '2' when eqz2.zone in (1,2,3,6,7,8) then '3' when  eqz2.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end||
case when en3.kind_energy =2 then case when eqz3.zone in (4,5,9,10) then '2' when eqz3.zone in (1,2,3,6,7,8) then '3' when  eqz3.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end||
case when en4.kind_energy =4 then case when eqz4.zone in (4,5,9,10) then '1' when eqz4.zone in (1,2,3,6,7,8) then '1' when  eqz4.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end as ZWGRUPPE,
                  '' as wgruppe,
                  const.swerk,const.stort,const.ver,const.begru_b as begru,1 as tzap
                from eqm_meter_tbl as m 
                join eqm_equipment_tbl as eq on (m.code_eqp = eq.id)
                left join eqm_equipment_h as hm on (hm.id = eq.id) 
                left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
                left join (select code as id,min(sap_cnt) as sap_meter_id from sap_meter_cnt where sap_cnt<>'' group by code) s on s.id::integer=m.id_type_eqp
                left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22) sd on s.sap_meter_id=sd.sap_meter_id
                left join eqd_meter_zone_h as eqz1 on (eqz1.code_eqp = m.code_eqp and eqz1.dt_e is null and eqz1.kind_energy =1)
		left join eqd_meter_zone_h as eqz2 on (eqz2.code_eqp = m.code_eqp and eqz2.dt_e is null and eqz2.kind_energy =3)
		left join eqd_meter_zone_h as eqz3 on (eqz3.code_eqp = m.code_eqp and eqz3.dt_e is null and eqz3.kind_energy in(2,5))
		left join eqd_meter_zone_h as eqz4 on (eqz4.code_eqp = m.code_eqp and eqz4.dt_e is null and eqz4.kind_energy in(4,6))
		left join eqi_meter_tbl as t on t.id=m.id_type_eqp
		left join types_meter as t1 on trim(t1.type)=trim(t.type) 
                left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy=1 and dt_e is null) as en1 on en1.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy=3 and dt_e is null) as en2 on en2.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy in(2,5) and dt_e is null) as en3 on en3.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy in(6,4) and dt_e is null) as en4 on en4.code_eqp = m.code_eqp
		left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
       left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
       left join eqm_tree_tbl tr on tr.id = ttr.id_tree
       left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                inner join sap_const const on 1=1
        where (c.code>999 or c.code=900) AND coalesce(c.idk_work,0)<>0 
	     and  c.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001')
   
union                

select distinct cyrillic_transliterate(gr.code_t_new::text) as id,0 as id_type_eqp,'' as sap_meter_id,c.code_eqp as OLDKEY,
                'EQUI' as EQUI,
                case when eq.is_owner = 1 then '4002' else case when ic.conversion=1 then  '4004' else '4006' end  end EQART,
                '2004' as BAUJJ, 
                '$date_ab' as datab,
                 '' as EQKTX,
                 '2005' as bgljahr,
                case  when coalesce(eq.is_owner,0) = 0 then 'CK01230370' else '' end as KOSTL, 
                 --trim(eq.num_eqp) as SERNR,
                 --get_element_str(trim(eq.num_eqp),row_number() OVER (PARTITION BY c.code_eqp)::int) as sernr,
                 -- substr(cyrillic_transliterate(gr.code_t_new::text),8) as sernr,
               f_get_sn(cyrillic_transliterate(gr.code_t_new::text),1) as sernr,
                  case when eq.is_owner <> 1 then '2189' else '' end as zz_pernr,
                 c.date_check::text as CERT_DATE,
                  coalesce(upper(type_tr.type_tr_sap),upper(type_tr_u.type_tr_sap)) as MATNR,
                  '' as zwgruppe,
                 coalesce(type_tr.group_ob,type_tr_u.group_ob) as WGRUPPE,
                  const.swerk,const.stort,const.ver,const.begru_b as begru,2 as tzap
                 from group_trans1 as gr
                 join eqm_compensator_i_tbl as c on c.code_eqp=gr.code_tt::int
		    join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
		    left join eqm_equipment_h as hm on (hm.id = c.code_eqp) and hm.dt_b = (
		    select dt_b from eqm_equipment_h where id = eq.id 
		    and trim(coalesce(num_eqp,'')) = trim(coalesce(eq.num_eqp,''))  and dt_e is null order by dt_b desc limit 1 )
		    join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
		    left join sap_type_tr_i_tbl as type_tr on type_tr.id_type = ic.id 
		     left join sap_type_tr_u_tbl as type_tr_u on type_tr_u.id_type = ic.id left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
		    left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
			left join eqm_tree_tbl tr on tr.id = ttr.id_tree
			left join clm_client_tbl as cl1 on (cl1.id = coalesce (use.id_client, tr.id_client)) 
                    inner join sap_const const on 1=1 
                    where  (cl1.code>999 or  cl1.code=900) AND coalesce(cl1.idk_work,0)<>0 
                 and  cl1.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                 '10999999','11000000','19999369','50999999','1000000','1000001') ) x
order by tzap   
--limit 3
";

if($res==4)
        $sql = "select * from 
(select distinct m.code_eqp::text as id,id_type_eqp,s.sap_meter_id,case when length(m.code_eqp::varchar)<8 then 
                 (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(m.code_eqp::varchar)::int)),(7-(length(m.code_eqp::varchar)::int)))||m.code_eqp::varchar)::int else m.code_eqp end  as OLDKEY,
                'EQUI' as EQUI,
                case when eq.is_owner = 1 then '4002' else '4001' end   EQART, 
                 case when m.dt_control is null then '2004' else substring(m.dt_control::varchar,1,4) end as BAUJJ, 
                '$date_ab' as datab,
                 '' as EQKTX,
                case when m.dt_control is null then '2005' else substring(m.dt_control::varchar,1,4)  end as bgljahr,
                case  when coalesce(eq.is_owner,0) = 0 then 'CK01230370' else '' end as KOSTL, 
                 trim(eq.num_eqp) as SERNR,
                 case when eq.is_owner <> 1 then '2189' else '' end as zz_pernr,
                  substring(replace(m.dt_control::varchar,'-',''),1,8) as CERT_DATE,
                  upper(sd.sap_meter_name) as matnr,
                 case when en1.kind_energy =1 then case when eqz1.zone in (4,5,9,10) then '2' when eqz1.zone in (1,2,3,6,7,8) then '3' when  eqz1.zone = 0 then '1' else '0' end ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end||
case when en2.kind_energy =3 then case when eqz2.zone in (4,5,9,10) then '2' when eqz2.zone in (1,2,3,6,7,8) then '3' when  eqz2.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end||
case when en3.kind_energy =2 then case when eqz3.zone in (4,5,9,10) then '2' when eqz3.zone in (1,2,3,6,7,8) then '3' when  eqz3.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end||
case when en4.kind_energy =4 then case when eqz4.zone in (4,5,9,10) then '1' when eqz4.zone in (1,2,3,6,7,8) then '1' when  eqz4.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||coalesce(t1.count_round,'0')::varchar||')' else '0_(000)' end as ZWGRUPPE,
                  '' as wgruppe,
                  const.swerk,const.stort,const.ver,const.begru_b as begru,1 as tzap
                from eqm_meter_tbl as m 
                join eqm_equipment_tbl as eq on (m.code_eqp = eq.id)
                left join eqm_equipment_h as hm on (hm.id = eq.id) 
                left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
                left join (select code as id,min(sap_cnt) as sap_meter_id from sap_meter_cnt where sap_cnt<>'' group by code) s on s.id::integer=m.id_type_eqp
                left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22) sd on s.sap_meter_id=sd.sap_meter_id
                left join eqd_meter_zone_h as eqz1 on (eqz1.code_eqp = m.code_eqp and eqz1.dt_e is null and eqz1.kind_energy =1)
		left join eqd_meter_zone_h as eqz2 on (eqz2.code_eqp = m.code_eqp and eqz2.dt_e is null and eqz2.kind_energy =3)
		left join eqd_meter_zone_h as eqz3 on (eqz3.code_eqp = m.code_eqp and eqz3.dt_e is null and eqz3.kind_energy in(2,5))
		left join eqd_meter_zone_h as eqz4 on (eqz4.code_eqp = m.code_eqp and eqz4.dt_e is null and eqz4.kind_energy in(4,6))
		left join eqi_meter_tbl as t on t.id=m.id_type_eqp
		left join types_meter as t1 on trim(t1.type)=trim(t.type) 
                left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy=1 and dt_e is null) as en1 on en1.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy=3 and dt_e is null) as en2 on en2.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy in(2,5) and dt_e is null) as en3 on en3.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy in(6,4) and dt_e is null) as en4 on en4.code_eqp = m.code_eqp
		left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
       left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
       left join eqm_tree_tbl tr on tr.id = ttr.id_tree
       left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                inner join sap_const const on 1=1
        where (c.code>999 or c.code=900) AND coalesce(c.idk_work,0)<>0 
	     and  c.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	    '10999999','11000000','19999369','50999999','1000000','1000001')
	    and eq.id not in(120748,120744)
	      
union                

select distinct cyrillic_transliterate(gr.code_t_new::text) as id,0 as id_type_eqp,'' as sap_meter_id,c.code_eqp as OLDKEY,
                'EQUI' as EQUI,
                case when eq.is_owner = 1 then '4002' else case when ic.conversion=1 then  '4004' else '4006' end  end EQART,
                '2004' as BAUJJ, 
                '$date_ab' as datab,
                 '' as EQKTX,
                 '2005' as bgljahr,
                case  when coalesce(eq.is_owner,0) = 0 then 'CK01230370' else '' end as KOSTL, 
                 --trim(eq.num_eqp) as SERNR,
                 --get_element_str(trim(eq.num_eqp),row_number() OVER (PARTITION BY c.code_eqp)::int) as sernr,
                 -- substr(cyrillic_transliterate(gr.code_t_new::text),8) as sernr,
               f_get_sn(cyrillic_transliterate(gr.code_t_new::text),1) as sernr,
                  case when eq.is_owner <> 1 then '2189' else '' end as zz_pernr,
                 c.date_check::text as CERT_DATE,
                  coalesce(upper(type_tr.type_tr_sap),upper(type_tr_u.type_tr_sap)) as MATNR,
                  '' as zwgruppe,
                 coalesce(type_tr.group_ob,type_tr_u.group_ob) as WGRUPPE,
                  const.swerk,const.stort,const.ver,const.begru_b as begru,2 as tzap
                 from group_trans1 as gr
                 join eqm_compensator_i_tbl as c on c.code_eqp=gr.code_tt::int
		    join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
		    left join eqm_equipment_h as hm on (hm.id = c.code_eqp) and hm.dt_b = (
		    select dt_b from eqm_equipment_h where id = eq.id 
		    and trim(coalesce(num_eqp,'')) = trim(coalesce(eq.num_eqp,''))  and dt_e is null order by dt_b desc limit 1 )
		    join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
		    left join sap_type_tr_i_tbl as type_tr on type_tr.id_type = ic.id 
		     left join sap_type_tr_u_tbl as type_tr_u on type_tr_u.id_type = ic.id left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
		    left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
			left join eqm_tree_tbl tr on tr.id = ttr.id_tree
			left join clm_client_tbl as cl1 on (cl1.id = coalesce (use.id_client, tr.id_client)) 
                    inner join sap_const const on 1=1 
                    where  (cl1.code>999 or  cl1.code=900) AND coalesce(cl1.idk_work,0)<>0 
                 and  cl1.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                 '10999999','11000000','19999369','50999999','1000000','1000001') 
                 and eq.id not in(120747,120746,120742,120743) ) x
order by tzap   
--limit 3
";

        // Запрос для получения списка необходимых
        // для экспорта структур
        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c, $res, $vid);  // Список структур

//debug($data);
//return;

        // Удаляем данные в таблицах структур
        $i = 0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if ($i == 1) $first_struct = trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_" . strtolower($n_struct);
            exec_on_server($zsql, $res, $vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill = 'f_' . strtolower($routine) . '($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        $f = fopen($fname, 'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
        $err = double_struct($fname);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
        $cnt = 4;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }

//         Проверка на пустые поля {
        $sql = 'SELECT * FROM sap_check_fields';
        $f_data = data_from_server($sql, $res, $vid);
        $err = empty_fields($fname, $f_data);
//        debug($err);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Пустое поле',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
//         Проверка на пустые поля }

        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }

    //формирование файла идентификации
    // Формирование файла device для САП для ЮР.лиц
    public function actionIdfile_device($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select om,oldkey,sernr,qui.code,const.ver from (
                select f.*,u1.code from (
                select 'DEVICE' as OM,a.oldkey,a.sernr,get_tu(eq.id) as tu from sap_equi as a
                join eqm_equipment_tbl as eq on (extract_n(substr(a.oldkey,9,6))::int = eq.id)
                ) f
                left join eqm_equipment_tbl as v
                on f.tu=v.id
                left JOIN eqm_compens_station_inst_tbl AS area ON (f.tu=area.code_eqp)
                left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
                left join eqm_area_tbl u on u.code_eqp=area.code_eqp_inst
                left join clm_client_tbl u1 on u1.id=u.id_client
                ) qui
                join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла devloc для САП для бытовых
    public function actionSap_devloc_ind($res, $par = 0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind')
            $vid = 1;
        else
            $vid = 2;
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));

        // Главный запрос со всеми необходимыми данными
        $sql = "select a.id,b.haus as haus,b.oldkey as vstelle,const.swerk,
                  const.stort,const.begru_b as begru,const.ver
                from clm_paccnt_tbl as a
                left join sap_evbsd b on b.oldkey='04_C'||$$$rem$$||'B_'||a.id
                inner join sap_const const on 1=1
                where a.archive='0' 
                -- limit 10 
                ";

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);
        $cnt = data_from_server($sql_c, $res, $vid);

        // Удаляем данные в таблицах
        $zsql = 'delete from sap_egpld';
        exec_on_server($zsql, $res, $vid);

        // Заполняем структуры
        foreach ($data as $w) {
            $i = 0;
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $i++;
                f_devloc_ind($n_struct, $rem, $w, $vid);
            }
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = 'DEVLOC_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . '_R' . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_egpld";
        $struct_data = data_from_server($sql, $res, $vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $all = gen_column($table_struct, $res, $vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql, $res, $vid); // Выполняем запрос

                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }
                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        // нет объекта высшего уровня {
//        $sql="SELECT * from sap_refer where upload='$filename'";
//        $data_u = data_from_server($sql, $res, $vid);
//        $refer = $data_u[0]['refer'];
//        $refer = 'Нет объекта высшего уровня в выгрузке '.$refer;
//        if(!empty($data_u[0]['upload'])) {
//            $err = no_refer($fname, $data_u);
//            if (count($err)) {
//                foreach ($err as $v) {
////                    debug($v);
//                    $z="INSERT  INTO sap_err
//                        VALUES('$filename','$v','$refer',$res)";
//                    exec_on_server($z, (int)$rem, $vid);
//                }
//            }
//        }
        // нет объекта высшего уровня }

        // пустая ссылка {
//        $msg = 'Пустая ссылка';
//        $err = empty_refer($fname, $data_u);
//        if (count($err)) {
//            foreach ($err as $v) {
////                    debug($v);
//                $z="INSERT  INTO sap_err
//                        VALUES('$filename','$v','$msg',$res)";
//                exec_on_server($z, (int)$rem, $vid);
//            }
//
//        }
        // пустая ссылка }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        fclose($f);
//
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }
//        else {
//            // Выдаем предупреждение на экран об окончании формирования файла
//            $model = new info();
//            $model->title = 'УВАГА!';
//            $model->info1 = "Erorr.";
//            $model->style1 = "d15";
//            $model->style2 = "info-text";
//            $model->style_title = "d9";
//
//            return $this->render('info', [
//                'model' => $model]);
//        }
    }

    //формирование файла идентификации
    // Формирование файла devloc для САП для бытовых абонентов
    public function actionIdfile_devloc_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'DEVLOC' as OM,a.oldkey,b.code,(ad.last_name||' '||substr(ad.name, 1, 1)||'.'||substr(ad.patron_name, 1, 1)||'.') as name_tu,const.ver from sap_egpld as a
                left join clm_paccnt_tbl as b
                on substr(a.oldkey,9)::int=b.id
                left join vw_address as ad on b.id=ad.id
                join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }


    // Формирование файла device для САП для бытовых
    public function actionSap_device_ind($res, $par = 0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', -1);
        $rem = '0' . $res;  // Код РЭС
        $day = ((int)date('d')) - 1;
        $datab = date('Ymd', strtotime("-$day day"));
        //phpversion()
//        $baujj=random_int(1979, 2006);
        $baujj = mt_rand(1970, 1993);

        $sql = "select distinct w1.mmgg_current,(w1.mmgg_current- interval '4 month')::date as datab,a.id,'4001' as eqart,'$baujj' as baujj,
                const.kostl as kostl,a.num_meter as sernr,'00000347' as zz_pernr,
                replace(a.dt_control::char(10),'-','') as cert_date,b.id as id_meter,
                date_part('year', a.dt_control) as bgljahr,get_gen_cq(a.id_paccnt,a.carry) as zwgruppe,
                const.swerk,const.stort,const.ver,const.begru_b as begru,sd.sap_meter_name as matnr
                from clm_meterpoint_tbl a
                left join clm_meter_zone_h b1 on a.id=b1.id_meter --and b1.dt_e is null
                left join (select distinct id from eqi_meter_tbl) b on a.id_type_meter=b.id
                inner join sap_const const on
                1=1
                left join (select distinct id as id,sap_meter_id from sap_meter) s on s.id::integer=a.id_type_meter
                left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22 where sap_meter_id<>'') sd on s.sap_meter_id=sd.sap_meter_id
                left join (select (fun_mmgg())::date as mmgg_current) w1 on 1=1
                left join clm_paccnt_tbl p on p.id=a.id_paccnt
		        where p.archive='0' and b1.dt_e is null
		        and not(a.id_type_meter in(0,300000010 ,200000005,999) or trim(a.num_meter)='0' or a.num_meter is null)
		        --and a.id=100033776 and b1.dt_e is null
                order by sd.sap_meter_name 
               --  limit 10       
                ";

        $sql_c = "select * from sap_export where objectsap='DEVICE_IND' order by id_object";
//        $cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();

        if (1 == 1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_abn->createCommand($sql_c)->queryAll();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_abn->createCommand($sql_c)->queryAll();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_abn->createCommand($sql_c)->queryAll();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_abn->createCommand($sql_c)->queryAll();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_abn->createCommand($sql_c)->queryAll();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_abn->createCommand($sql_c)->queryAll();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_abn->createCommand($sql_c)->queryAll();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_abn->createCommand($sql_c)->queryAll();
                    break;
            }

//            debug($data);
//            return;

            // Удаляем данные в таблицах
            $zsql = 'delete from sap_equi';
            $zsql1 = 'delete from sap_egers';
            $zsql2 = 'delete from sap_egerh';

            switch ($res) {
                case 1:
                    Yii::$app->db_pg_dn_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_dn_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_dn_abn->createCommand($zsql2)->execute();
                    break;

                case 2:
                    Yii::$app->db_pg_zv_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_zv_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_zv_abn->createCommand($zsql2)->execute();
                    break;
                case 3:
                    Yii::$app->db_pg_vg_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_vg_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_vg_abn->createCommand($zsql2)->execute();
                    break;
                case 4:
                    Yii::$app->db_pg_pv_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_pv_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_pv_abn->createCommand($zsql2)->execute();
                    break;
                case 5:
                    Yii::$app->db_pg_krg_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_krg_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_krg_abn->createCommand($zsql2)->execute();
                    break;
                case 6:
                    Yii::$app->db_pg_ap_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_ap_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_ap_abn->createCommand($zsql2)->execute();
                    break;
                case 7:
                    Yii::$app->db_pg_gv_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_gv_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_gv_abn->createCommand($zsql2)->execute();
                    break;
                case 8:
                    Yii::$app->db_pg_in_abn->createCommand($zsql)->execute();
                    Yii::$app->db_pg_in_abn->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_in_abn->createCommand($zsql2)->execute();
                    break;
            }


            $i = 0;
            // Заполняем структуры
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_device_ind($n_struct, $rem, $w);
                }
            }
        }
        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        // $fname='PARTNER_04'.'_CK'.$rem.'_B'.$fd.'.txt';
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = 'DEVICE_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . '_R' . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $i = 0;
        $sql = "select * from sap_equi";

        switch ($res) {
            case 1:
                $struct_data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                break;
            case 2:
                $struct_data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                break;
            case 3:
                $struct_data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                break;
            case 4:
                $struct_data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                break;
            case 5:
                $struct_data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                break;
            case 6:
                $struct_data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                break;
            case 7:
                $struct_data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                break;
            case 8:
                $struct_data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                break;
        }


        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $sql = "select * from $table_struct where oldkey='$old_key'";
                    //$cur_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();

                    switch ($res) {
                        case 1:
                            $cur_data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                            break;
                        case 2:
                            $cur_data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                            break;
                        case 3:
                            $cur_data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                            break;
                        case 4:
                            $cur_data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                            break;
                        case 5:
                            $cur_data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                            break;
                        case 6:
                            $cur_data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                            break;
                        case 7:
                            $cur_data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                            break;
                        case 8:
                            $cur_data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                            break;
                    }

                    foreach ($cur_data as $d1) {
                        if (strtolower($table_struct) == 'sap_co_adr')
                            $d1 = array_slice($d1, 0, 9);
                        $d1 = array_map('trim', $d1);
//                        $d1['oldkey']=substr($d1['oldkey'],0,10);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }

                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        if (1 == 2) {  // отключено
            // задвоения по oldkey  {
            $err = double_oldkey($fname);
            // Запись в таблицу ошибок
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
            // задвоения по oldkey  }

            // задвоения структур {
            $err = double_struct($fname);
            if ($err <> '') {
                $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
                exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
            }
            // задвоения структур }

            // отсутствие структуры {
            $cnt = 4;
            $err = no_struct($fname, $cnt);
            if ($err <> '') {
                $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
                exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
            }
            // отсутствие структуры }

//         Проверка на пустые поля {
//        if(1==2) { // off
            $sql = 'SELECT * FROM sap_check_fields';
            $f_data = data_from_server($sql, $res, $vid);
            $err = empty_fields($fname, $f_data);
//        debug($err);
            // Запись в таблицу ошибок
            if (count($err)) {
                foreach ($err as $v) {
                    $z = "INSERT  INTO sap_err VALUES('$filename','$v','Пустое поле',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
//        }
//         Проверка на пустые поля }
        }

        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        fputs($f, "\t&ENDE");
//        fputs($f, "\n");
//        fclose($f);
//
//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//            else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }
//        else {
//            // Выдаем предупреждение на экран об окончании формирования файла
//            $model = new info();
//            $model->title = 'УВАГА!';
//            $model->info1 = "Erorr.";
//            $model->style1 = "d15";
//            $model->style2 = "info-text";
//            $model->style_title = "d9";
//
//            return $this->render('info', [
//                'model' => $model]);
//        }


//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//
//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

//        return $this->render('info', [
//            'model' => $model]);
    }

    //формирование файла идентификации
    // Формирование файла devloc для САП для бытовых абонентов
    public function actionIdfile_device_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'DEVICE' as OM,a.oldkey,b.code,(ad.last_name||' '||substr(ad.name, 1, 1)||'.'||substr(ad.patron_name, 1, 1)||'.') as name_tu,const.ver from sap_equi as a
                left join clm_paccnt_tbl as b
                on substr(a.oldkey,9)::int=b.id
                left join vw_address as ad on b.id=ad.id
                join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }


    // Формирование файла connobj для САП для Юридических потребителей
    public function actionSap_connobj($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        $sql = "select min(id) as id,coalesce(town,'') as town,coalesce(post_index,'') as post_index,
coalesce(street,'') as street,coalesce(house,'') as house,stort,ver,begru,region,swerk,
case when coalesce(street,'')='' and coalesce(house,'')='' then name end as str_suppl1,
'' as str_suppl2,''::char(20) as house_num2,town_sap,reg,street_sap,numobl,
 town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo from
(select a.id,'' as pltxt,a.name,a.code_okpo,b.okpo_num,b.tax_num,'2' AS BU_TYPE,b.FLAG_JUR,
case when coalesce(b.FLAG_JUR,0)= 1  then '03' when coalesce(b.FLAG_JUR,0)= 1  then '03' when coalesce(b.FLAG_JUR,0)= 0 then  '03'  else '03' end as BU_GROUP,
case when coalesce(b.FLAG_JUR,0)= 1 then '0002' when coalesce(b.FLAG_JUR,0)= 0 then  '0003' else '0001' end as BPKIND,
'MKK' as ROLE1,
case when coalesce(a.id_state,0) in (80,49) then 'ZLIQ' else '' end  as ROLE2,
'00010101' as VALID_FROM_1,
'I' as CHIND_1,
case when coalesce(a.id_state,0) in (80,49) then substring(replace(a.dt_close::varchar, '-',''),1,8) else '' end  as VALID_FROM_2,
case when coalesce(a.id_state,0) in (80,49) then 'I' else '' end  as CHIND_2,
'1' as FKUA_RSD,
'3' as FKUA_RIS,
case when coalesce(b.FLAG_JUR,0)= 1 then 

	a.code_okpo
        
else 
	case when length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 and trim(coalesce (a.code_okpo, b.okpo_num))<>'0000000000' then trim(coalesce (a.code_okpo, b.okpo_num))
	 when length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 and trim(coalesce (a.code_okpo, b.okpo_num))='0000000000' then a.code_okpo else '' end
end  as BU_SORT1,
'' as BU_SORT2,
'0006' as SOURCE,
'LEG' as AUGRP,
substr(trim(a.name),1,40) as name_org1,
substr(trim(a.name),41,40) as name_org2,
substr(trim(a.name),81,40) as name_org3,
substr(trim(a.name),121,40) as name_org4,
case when coalesce(b.FLAG_JUR,0)= 1 then  
     case 
     when upper(trim(a.name)) LIKE  'ФЕРМЕР%' AND upper(trim(a.name)) LIKE '%ГОСП%' then '02' 
     when (upper(trim(a.name)) LIKE  'ПРИВАТ%' OR  upper(trim(a.name)) LIKE  '%ПРИВАТ%') AND upper(trim(a.name)) LIKE '%ПІДПР%' then '03' 
     when upper(trim(a.name)) LIKE 'КОЛЕКТИВ%' AND upper(trim(a.name)) LIKE '%ПІДПР%' then '04' 
     when upper(trim(a.name)) LIKE 'ДЕРЖ%' AND upper(trim(a.name)) LIKE '%ПІДПР%' then '05' 
     when (upper(trim(a.name)) LIKE  'КОМУНАЛЬНЕ%' AND upper(trim(a.name)) LIKE '%ПІДПР%') then '07' 
     when ((upper(trim(a.name)) LIKE 'ДОЧІРНЄ%' OR upper(trim(a.name)) LIKE 'ДОЧІРНЕ%') AND upper(trim(a.name)) LIKE '%ПІДПР%') then '08' 
     when upper(trim(a.name)) LIKE  'РЕЛІГ%' or  upper(trim(a.name)) LIKE '%РЕЛІГ%' then '10' 
     when upper(trim(a.name)) LIKE  'ПІДПР%' AND  upper(trim(a.name)) LIKE '%СПОЖИВ%' AND  upper(trim(a.name)) LIKE '%КООП%' then '11' 
     when (upper(trim(a.name)) LIKE  'АКЦІОНЕРНЕ ТОВАРИСТВО%' or ((upper(trim(a.name)) LIKE  'ПУБЛІЧНЕ%' OR upper(trim(a.name)) LIKE  'ПРИВАТНЕ%') and  upper(trim(a.name)) LIKE  '%АКЦІОНЕРНЕ%' and upper(trim(a.name)) LIKE  '%ТОВАРИСТВО%')) then '17' 
     when upper(trim(a.name)) LIKE 'ВІДКРИТЕ АКЦІОНЕРНЕ ТОВАРИСТВО%' then '18' 
     when upper(trim(a.name)) LIKE 'ЗАКРИТЕ%' AND upper(trim(a.name)) LIKE  '%АКЦІОНЕР%' AND  upper(trim(a.name)) LIKE '%ТОВ%' then '19' 
     when (upper(trim(a.name)) LIKE  'ТОВ%' AND upper(trim(a.name)) LIKE '%ОБМЕЖ%' AND upper(trim(a.name))  LIKE '%ВІДП%') OR upper(trim(a.name)) LIKE  'ТОВ %' then '21' 
     when upper(trim(a.name)) LIKE  'ТОВ%' AND upper(trim(a.name)) LIKE '%ДОД%' AND upper(trim(a.name))  LIKE '%ВІДП%' then '22'
     when upper(trim(a.name)) LIKE  'ПОВНЕ%' AND upper(trim(a.name)) LIKE '%ТОВ%' then '23' 
     when upper(trim(a.name)) LIKE  'КОМАНДИТНЕ%' AND upper(trim(a.name)) LIKE '%ТОВ%' then '24' 
     when upper(trim(a.name)) like 'АВТОКООПЕРАТИВ%'  OR upper(trim(a.name)) like '%АВТОКООПЕРАТИВ%' OR (upper(trim(a.name))  like 'АВТО%' AND upper(trim(a.name))  like '%КООПЕРАТИВ%') then '25' 
     when upper(trim(a.name)) LIKE  'ВИРОБНИЧ%' AND upper(trim(a.name)) LIKE '%КООП%' then '26' 
     when upper(trim(a.name)) LIKE  'ОБСЛУГОВ%' AND upper(trim(a.name)) LIKE '%КООП%' then '27'   
     WHEN (upper(trim(a.name)) like 'ДЕРЖАВНИЙ%' AND upper(trim(a.name)) like '%ЗАКЛАД%') OR (upper(trim(a.name))  like 'ДЕРЖАВНА%' AND upper(trim(a.name)) like '%УСТАНОВА%') OR (upper(trim(a.name))  like 'ДЕРЖАВНА%' AND upper(trim(a.name)) like '%ОРГАНІЗАЦІЯ%') THEN '35'
     WHEN (upper(trim(a.name)) like 'КОМУНАЛЬНИЙ%' AND upper(trim(a.name)) like '%ЗАКЛАД%') OR (upper(trim(a.name))  like 'КОМУНАЛЬНА%' AND upper(trim(a.name)) like '%УСТАНОВА%') OR (upper(trim(a.name))  like 'КОМУНАЛЬНА%' AND upper(trim(a.name)) like '%ОРГАНІЗАЦІЯ%') THEN '36'
     WHEN (upper(trim(a.name)) like 'ПРИВАТНИЙ%' AND upper(trim(a.name)) like '%ЗАКЛАД%') OR (upper(trim(a.name))  like 'ПРИВАТНА%' AND upper(trim(a.name)) like '%УСТАНОВА%') OR (upper(trim(a.name))  like 'ПРИВАТНА%' AND upper(trim(a.name)) like '%ОРГАНІЗАЦІЯ%') THEN '37'
     when upper(trim(a.name)) LIKE  'ГРОМАДСЬКА%' AND upper(trim(a.name)) LIKE '%ОРГ%' then '38' 
     when (upper(trim(a.name)) LIKE  'КОРПОРАЦІЯ%' OR upper(trim(a.name)) LIKE 'КООРПОРАЦІЯ%') then '43' 
     when upper(trim(a.name)) LIKE  'КОНЦЕРН%' AND upper(trim(a.name)) LIKE '%КОНЦЕРН%' then '45' 
     else '01'
     end
else '' 
end as LEGAL_ENTY,
case when coalesce(a.id_state,0) in (80,49)  then substring(replace(a.dt_close::varchar, '-',''),1,8) else '' end as LIQUID_DAT,
''::char(4) as ZFILCODE,
'' as ZFILHEAD,
case when coalesce(b.FLAG_JUR,0)= 0 then  'X' else '' end as ZPROCIND,
'' as ZCODEFORMOWN,
'' as ZCODESPODU,
'' as ZCODEBANKROOT,
'' as ZCODELICENSE,
case when length(trim(a.name))> 160 then trim(a.name) else '' end as ZNAMEALL,
replace(replace(replace(trim(a.short_name),'   ',' '),'  ',' '),'''','’') as ZZ_NAMESHORT,
b.doc_ground as ZZ_DOCUMENT,
'' as ADEXT_ADDR,
'I' as CHIND_ADDR,
'' as POST_CODE2,
'' as PO_BOX,
am.building as HOUSE_NUM1,
am.office as HOUSE_NUM2,
'UA' as COUNTRY,
case when substring(trim(b.phone),1,30) <> '' then 'I' else '' end as CHIND_TEL,
case when position(',' in trim(b.phone))>0 then substr(trim(b.phone),1,position(',' in trim(b.phone))-1) else
case when length(regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g')) =10 then
		regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g')
		 else '' end end as TEL_NUMBER,
'' as CHIND_FAX,
'' as FAX_NUMBER,
case when trim(a.email) <>'' then 'I' else '' end as CHIND_SMTP,
trim(a.email) as SMTP_ADDR,

case when length(regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g')) =10 then
	case when regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '039%'
	or	
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '050%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '063%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '066%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '067%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '068%'
        or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '073%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '091%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '092%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '093%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '094%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '095%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '096%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '097%'
	or
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '098%'
	or 
	regexp_replace(regexp_replace(trim(b.phone), '-.*?$', '') , '[^0-9]', '','g') like '099%'
	then '3'
	else '1' end

	else '' end as TEL_MOBILE,
	'CEKPOST' as ADR_KIND,
	'X' as XDFADU,
	case when (length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 and trim(coalesce (a.code_okpo, b.okpo_num))<>'0000000000')
	   then trim(coalesce (a.code_okpo, b.okpo_num)) 
	   when length(trim(coalesce (a.code_okpo, b.okpo_num)))=8 then trim(coalesce (a.code_okpo, b.okpo_num))
	   end as IDNUMBER,
	   case when coalesce(b.FLAG_JUR,0)= 1 and length(trim(coalesce (a.code_okpo, b.okpo_num)))=8 then 'EDRPOU'
	    when (coalesce(b.FLAG_JUR,0)= 0 and length(trim(coalesce (a.code_okpo, b.okpo_num)))=10) then  'FS0001' 
	    when coalesce(b.FLAG_JUR,0)= 1 and length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 then  'FS0001'
	    else '' end as ID_TYPE,
kt.shot_name||' '||t.name as town,b2.post_index,ks.shot_name||' '||s.name as street,am.building as house,am.office as flat,
b.phone,b.e_mail,
const.id_res,const.swerk,const.stort,const.ver,const.begru,const.region,ads.town as town_sap,
ads.street as street_sap,ads.reg,ads.numobl,
u.town as town_wo,u.street as street_wo,u.ind as ind_wo,u.numobl as numobl_wo,u.reg as reg_wo,u.id_client as id_wo
 from clm_client_tbl a
        left join clm_statecl_tbl b on
        a.id=b.id_client
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town
       -- LEFT JOIN addr_sap ads on ads.town=kt.shot_name||' '||t.name and ads.type_street||' '||get_street(ads.street)=ks.shot_name||' '||s.name
       LEFT JOIN addr_sap ads on trim(ads.town)=trim(kt.shot_name)||' '||trim(t.name) 
       
       and (trim(ads.street)=get_typestreet1(trim(ks.shot_name))||' '||trim(s.name) or 
        case when ks.shot_name='шосе' and trim(s.name)='Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)||' шосе'
             when ks.shot_name='шосе' and trim(s.name)<>'Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)
         end)
       
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end 
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Грузьке' and $res='05' then trim(ads.reg)='DNP' else 1=1 end 
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Червоне' and $res='05' then trim(ads.reg)='DNP' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='07' then trim(ads.rnobl)='Новомосковський район' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Степове' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Камянка' and $res='06' then trim(ads.reg)='DNP' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Високе' and $res='01' then trim(ads.reg)='VIN' else 1=1 end   
         and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Миколаївка' and $res='01' then trim(ads.reg)='DNP' else 1=1 end  
       -- LEFT JOIN post_index_sap b2 on ads.numtown=b2.numtown and b2.post_index::integer=am.post_index
        LEFT JOIN (select distinct numtown,min(post_index) as post_index from (
       select distinct trim(numtown) as numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) 
       b20 group by 1) b2
         on trim(ads.numtown)=trim(b2.numtown) --and b2.post_index::integer=am.post_index
        LEFT JOIN  sap_wo_adr u on ((coalesce(trim(ks.shot_name||' '||trim(s.name)),'')=coalesce(trim(trim(chr(13) from trim(chr(10) from u.street))),'')
        and coalesce(trim(kt.shot_name||' '||trim(t.name)),'') = coalesce(trim(trim(chr(13) from trim(chr(10) from u.town))),'')) or (a.id=u.id_client))
        and u.res=$rem
        inner join sap_const const on
        1=1
        WHERE
        (a.code>999 or  a.code=900) AND coalesce(a.idk_work,0)<>0 
	     and  a.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')
	    ) u
	    --where u.town_wo is not null
	   	    group by coalesce(town,''),coalesce(post_index,''),
		coalesce(street,''),coalesce(house,''),stort,ver,begru,region,swerk,
		case when coalesce(street,'')='' and coalesce(house,'')='' then name end,
		town_sap,reg,street_sap,numobl,id,town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo
	order by id     
   ";

        $sql = "select min(id) as id,town,post_index,
street,house,stort,ver,begru,region,swerk,str_suppl1,
str_suppl2, house_num2,town_sap,reg,street_sap,numobl,
 town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo 
from  (
    select min(id) as id,
coalesce(town_sap,'') as town,coalesce(post_index,'') as post_index,
coalesce(street_sap,'') as street,
coalesce(house,'') as house,  
stort,ver,begru,region,swerk,
case when coalesce(street,'')='' and coalesce(house,'')='' then name end as str_suppl1,
' '::char(30) as str_suppl2,''::char(20) as house_num2,town_sap,reg,street_sap,numobl,
 town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo from
    (select a.id,'' as pltxt,c.name,s.name as town_cek,ks.shot_name||' '||trim(s.name) as street_cek,
am.building as HOUSE_NUM1,
am.office as HOUSE_NUM2,
'UA' as COUNTRY,
kt.shot_name||' '||t.name as town,b2.post_index,ks.shot_name||' '||s.name as street,
-- am.building as house,
-- upper(coalesce(am.building,''))||coalesce(upper(am.building_add),'') as house, 
 f_get_number_house(am.building,am.building_add) as house,
am.office as flat,
const.id_res,const.swerk,const.stort,const.ver,const.begru,const.region,ads.town as town_sap,
ads.street as street_sap,ads.reg,ads.numobl,
u.town as town_wo,u.street as street_wo,u.ind as ind_wo,u.numobl as numobl_wo,u.reg as reg_wo,u.id_client as id_wo
 from eqm_equipment_tbl a
     left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
 
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town
       
       LEFT JOIN addr_sap ads on trim(ads.town)=trim(kt.shot_name)||' '||trim(t.name)

    and (trim(ads.street)=get_typestreet1(trim(ks.shot_name))||' '||trim(s.name) or 
        case when ks.shot_name='шосе' and trim(s.name)='Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)||' шосе'
             when ks.shot_name='шосе' and trim(s.name)<>'Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)
         end)
       
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Грузьке' and $res='05' then trim(ads.reg)='DNP' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Червоне' and $res='05' then trim(ads.reg)='DNP' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='07' then trim(ads.rnobl)='Новомосковський район' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Степове' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Камянка' and $res='06' then trim(ads.reg)='DNP' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Високе' and $res='01' then trim(ads.reg)='VIN' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Миколаївка' and $res='01' then trim(ads.reg)='DNP' else 1=1 end
    -- LEFT JOIN post_index_sap b2 on ads.numtown=b2.numtown and b2.post_index::integer=am.post_index
        LEFT JOIN (select distinct numtown,min(post_index) as post_index from (
        select distinct trim(numtown) as numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) 
       b20 group by 1) b2
         on trim(ads.numtown)=trim(b2.numtown) --and b2.post_index::integer=am.post_index
        LEFT JOIN  sap_wo_adr u on ((coalesce(trim(ks.shot_name||' '||trim(s.name)),'')=coalesce(trim(trim(chr(13) from trim(chr(10) from u.street))),'')
        and coalesce(trim(kt.shot_name||' '||trim(t.name)),'') = coalesce(trim(trim(chr(13) from trim(chr(10) from u.town))),'')) or (a.id=u.id_client))
        and u.res=$rem and u.connobj=1
        inner join sap_const const on
    1=1
        WHERE a.type_eqp=12 and substr(trim(a.num_eqp)::text,1,3)='62Z'  and
    (c.code>999 or c.code=900) AND coalesce(c.idk_work,0)<>0
    and  c.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001')
	    ) u
    --where u.town_wo is not null
	   	    group by coalesce(town,''),coalesce(post_index,''),
		coalesce(street,''),coalesce(house,''),stort,ver,begru,region,swerk,
		case when coalesce(street,'')='' and coalesce(house,'')='' then name end,
		town_sap,reg,street_sap,numobl,id,town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo
		
	order by id  
	) u 
	-- where town<>'' and street<>''  -- Потом это надо убрать
		group by town,post_index,
		street,house,stort,ver,begru,region,swerk,str_suppl1,
		str_suppl2, house_num2,town_sap,reg,street_sap,numobl,
		 town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo";


        if ($rem == '09')
            $sql = "select min(id) as id,town,post_index,street_cek,town_cek,
street,house,stort,ver,begru,region,swerk,str_suppl1,
str_suppl2, house_num2,town_sap,reg,street_sap,numobl,
 town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo 
from  (
    select min(id) as id,street_cek,town_cek,
coalesce(town_sap,'') as town,coalesce(post_index,'') as post_index,
coalesce(street_sap,'') as street,coalesce(house,'') as house,stort,ver,begru,region,swerk,
case when coalesce(street,'')='' and coalesce(house,'')='' then name end as str_suppl1,
' '::char(30) as str_suppl2,''::char(20) as house_num2,town_sap,reg,street_sap,numobl,
 town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo from
    (select a.id,'' as pltxt,c.name,s.name as town_cek,ks.shot_name||' '||trim(s.name) as street_cek,
am.building as HOUSE_NUM1,
am.office as HOUSE_NUM2,
'UA' as COUNTRY,
kt.shot_name||' '||t.name as town,b2.post_index,ks.shot_name||' '||s.name as street,am.building as house,am.office as flat,
const.id_res,const.swerk,const.stort,const.ver,const.begru,const.region,ads.town as town_sap,
ads.street as street_sap,ads.reg,ads.numobl,
u.town as town_wo,u.street as street_wo,u.ind as ind_wo,u.numobl as numobl_wo,u.reg as reg_wo,u.id_client as id_wo
 from eqm_equipment_tbl a
     left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
 
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town
       
       LEFT JOIN addr_sap ads on trim(ads.town)=trim(kt.shot_name)||' '||trim(t.name)

    and (trim(ads.street)=get_typestreet1(trim(ks.shot_name))||' '||trim(s.name) or 
        case when ks.shot_name='шосе' and trim(s.name)='Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)||' шосе'
             when ks.shot_name='шосе' and trim(s.name)<>'Запорізьке' then trim(ads.street)=trim(ks.shot_name)||' '||trim(s.name)
         end)
       
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Грузьке' and $res='05' then trim(ads.reg)='DNP' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Червоне' and $res='05' then trim(ads.reg)='DNP' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and $res='07' then trim(ads.rnobl)='Новомосковський район' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(t.name)='с. Степове' and $res='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Камянка' and $res='06' then trim(ads.reg)='DNP' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Високе' and $res='01' then trim(ads.reg)='VIN' else 1=1 end
    and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Миколаївка' and $res='01' then trim(ads.reg)='DNP' else 1=1 end
    -- LEFT JOIN post_index_sap b2 on ads.numtown=b2.numtown and b2.post_index::integer=am.post_index
        LEFT JOIN (select distinct numtown,min(post_index) as post_index from (
        select distinct trim(numtown) as numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) 
       b20 group by 1) b2
         on trim(ads.numtown)=trim(b2.numtown) --and b2.post_index::integer=am.post_index
        LEFT JOIN  sap_wo_adr u on ((coalesce(trim(ks.shot_name||' '||trim(s.name)),'')=coalesce(trim(trim(chr(13) from trim(chr(10) from u.street))),'')
        and coalesce(trim(kt.shot_name||' '||trim(t.name)),'') = coalesce(trim(trim(chr(13) from trim(chr(10) from u.town))),'')) or (a.id=u.id_client))
        and u.res=$rem and u.connobj=1
        inner join sap_const const on
    1=1
        WHERE a.type_eqp=12 and substr(trim(a.num_eqp)::text,1,3)='62Z'  and
    (c.code>999 or c.code=900) AND coalesce(c.idk_work,0)<>0
    and  c.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001')
	    ) u
    --where u.town_wo is not null
	   	    group by coalesce(town,''),coalesce(post_index,''),
		coalesce(street,''),coalesce(house,''),stort,ver,begru,region,swerk,
		case when coalesce(street,'')='' and coalesce(house,'')='' then name end,
		town_sap,reg,street_sap,numobl,id,town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo,
		street_cek,town_cek
		
	order by id  
	) u 
	-- where town<>'' and street<>''  -- Потом это надо убрать
		group by town,post_index,
		street,house,stort,ver,begru,region,swerk,str_suppl1,
		str_suppl2, house_num2,town_sap,reg,street_sap,numobl,
		 town_wo,street_wo,ind_wo,numobl_wo,reg_wo,id_wo,street_cek,town_cek";


        $sql_c = "select * from sap_export where objectsap='CONNOBJ' order by id_object";
        $zsql = 'delete from sap_co_eha';
        $zsql1 = 'delete from sap_co_adr';

        if (1 == 1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_dn_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_dn_energo->createCommand($zsql1)->execute();

                    break;

                case 2:
                    $data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_zv_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_zv_energo->createCommand($zsql1)->execute();

                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_vg_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_vg_energo->createCommand($zsql1)->execute();

                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_pv_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_pv_energo->createCommand($zsql1)->execute();

                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_krg_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_krg_energo->createCommand($zsql1)->execute();

                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_ap_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_ap_energo->createCommand($zsql1)->execute();

                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_gv_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_gv_energo->createCommand($zsql1)->execute();

                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_in_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_in_energo->createCommand($zsql1)->execute();

                    break;
            }
            $i = 0;
//            debug($data);
//            return;

            // Заполняем структуры
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_connobj($n_struct, $rem, $w);
                }
            }
        }
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = 'CONNOBJ_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . '_L' . '.txt';
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $i = 0;
        $sql = "select * from sap_co_eha";
        switch ($res) {
            case 1:
                $struct_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                break;
            case 2:
                $struct_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                break;
            case 3:
                $struct_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                break;
            case 4:
                $struct_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                break;
            case 5:
                $struct_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                break;
            case 6:
                $struct_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                break;
            case 7:
                $struct_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                break;
            case 8:
                $struct_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                break;
        }


        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $sql = "select * from $table_struct where oldkey='$old_key'";

                    switch ($res) {
                        case 1:
                            $cur_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                            break;
                        case 2:
                            $cur_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                            break;
                        case 3:
                            $cur_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                            break;
                        case 4:
                            $cur_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                            break;
                        case 5:
                            $cur_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                            break;
                        case 6:
                            $cur_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                            break;
                        case 7:
                            $cur_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                            break;
                        case 8:
                            $cur_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                            break;
                    }

                    foreach ($cur_data as $d1) {
                        $d1 = array_slice($d1, 0, 10);
//                        debug($d1);
//                        return;
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }

                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

// Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }

        // Получаем название подпрограммы
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);
        // проверка адреса  на соответствие его с названием в САП {
        $err = check_adres($fname, 1);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет адреса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка индекса  на соответствие его с названием в САП {
        $err = check_adres($fname, 2);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Нет индекса',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // проверка адреса  на соответствие его с названием в САП   }

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 3;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }

    // Формирование файла premise для САП для Юридических потребителей
    public function actionSap_premise($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС
        $dt = date('Y-m-d');

//       if (1==2) {
            $sql_old = "select distinct on (oldkey) * from (
select distinct const.begru_all as pltxt,'PREMISE' as name,
         cl1.id,cl1.code, eq.name_eqp,eq.id as id_eq,
            '04_C'||'$rem'||'P_'||case when length(eq.id::varchar)<8 then 
             (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(eq.id::varchar)::int)),(7-(length(eq.id::varchar)::int)))||eq.id::varchar)::int else eq.id end  as OLDKEY,
             dd.oldkey as HAUS,dd.house_num2,const.ver
             from eqm_area_tbl as eqa 
            join  eqm_equipment_tbl AS eq  on (eqa.code_eqp=eq.id) 
            join  eqm_equipment_h AS eqh  on (eqa.code_eqp=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id and dt_b < '2020-07-01' order by dt_b desc limit 1 ) ) 
            left join adv_address_tbl as a on (a.id=eq.id_addres) 
            left join adm_address_tbl as am on a.id=am.id
            join eqm_ground_tbl as g on (eq.id=g.code_eqp) 
            left join ( select code_eqp_inst, count(*)::integer as eqp_cnt from eqm_compens_station_inst_tbl group by code_eqp_inst order by code_eqp_inst) as u on (eq.id=u.code_eqp_inst) 
            left join clm_client_tbl as cl1 on (cl1.id=eqa.id_client) 
            left join clm_statecl_tbl as st on cl1.id = st.id_client
          --  left join sap_co_adr ref on substr(ref.oldkey,9)=cl1.id::text
           
        --left join sap_but020 c1 on c1.oldkey='04_C'||'05'||'P_'||cl1.id or (cl1.id::character varying=c1.str_supll2 and c1.str_supll2<>'~') 
         left join sap_co_adr dd on
       -- ((trim(c1.city1)=trim(dd.city1) and trim(c1.street)=trim(dd.street) and 
        --upper(trim(c1.house_num1))=upper(trim(dd.house_num1)) and trim(dd.city1)<>'') or (cl1.id::character varying=dd.str_suppl2 and dd.str_suppl2<>'~')) 
        --and 
        substr(dd.oldkey,9)::integer in (select  a.id from 
	eqm_equipment_tbl a
     left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
 
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town 
where  kt.shot_name||' '||t.name || ks.shot_name||' '||s.name ||
coalesce(am.building,'') || coalesce(am.office,'') in
(      
select kt.shot_name||' '||t.name || ks.shot_name||' '||s.name ||
coalesce(am.building,'') || coalesce(am.office,'') from 
eqm_equipment_tbl a
     left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
 
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town

        
where a.id in (
select id from eqm_equipment_tbl where id in
(select code_eqp from eqm_compens_station_inst_tbl where code_eqp_inst=eq.id) 
and type_eqp=12) 
       -- and substr(dd.oldkey,9)::integer=cl1.id
       -- and coalesce(trim(replace(c1.house_num2,'корп.','')),'~')=case when trim(dd.house_num2)='' then '~' ELSE coalesce(trim(dd.house_num2),'~') END
       -- and dd.str_suppl1='~') or (dd.str_suppl1<>'~' and trim(c1.str_suppl1)=trim(dd.str_suppl1) and trim(c1.str_suppl2)=trim(dd.str_suppl2))
       
            inner join sap_const const on
            1=1
            left join clm_statecl_h as sth on cl1.id = sth.id_client and 
            sth.mmgg_e is null and sth.mmgg_b = (SELECT mmgg_b FROM clm_statecl_h WHERE id_client = sth.id_client and mmgg_b < '2020-07-01' order by mmgg_b desc limit 1 )      
            where (eq.type_eqp = 11) and cl1.book = -1 and coalesce(cl1.id_state,0) not in(50,99,49) and coalesce(cl1.idk_work,0) not in (0) 
             and sth.mmgg_b is not null and st.doc_dat is not null  and st.id_section not in (205,206,207,208,209,218)  and sth.mmgg_b is not null and st.doc_dat is not null 
                 and cl1.id <> syi_resid_fun() 
                 and cl1.id <>999999999 and 
                  (cl1.code>999 or  cl1.code=900) AND coalesce(cl1.idk_work,0)<>0 
                 and  cl1.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                 '10999999','11000000','19999369','50999999','1000000','1000001')
            --and dd.oldkey is null     
            order by 7) e";

            $sql_f = "select f_for_premise('$rem','$dt')";
// Это старый запрос (правильный  - но медленный)
            $sql = "select distinct on (oldkey) * from (
select distinct const.begru_all as pltxt,'PREMISE' as name,
         cl1.id,cl1.code, eq.name_eqp,eq.id as id_eq,
            '04_C'||'$rem'||'P_'||case when length(eq.id::varchar)<8 then 
             (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(eq.id::varchar)::int)),(7-(length(eq.id::varchar)::int)))||eq.id::varchar)::int else eq.id end  as OLDKEY,
             dd.oldkey as HAUS,dd.house_num2,const.ver
             from eqm_area_tbl as eqa 
            join  eqm_equipment_tbl AS eq  on (eqa.code_eqp=eq.id) 
            join  eqm_equipment_h AS eqh  on (eqa.code_eqp=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id and dt_b < '$dt' order by dt_b desc limit 1 ) ) 
            left join adv_address_tbl as a on (a.id=eq.id_addres) 
            left join adm_address_tbl as am on a.id=am.id
            join eqm_ground_tbl as g on (eq.id=g.code_eqp) 
            left join ( select code_eqp_inst, count(*)::integer as eqp_cnt from eqm_compens_station_inst_tbl group by code_eqp_inst order by code_eqp_inst) as u on (eq.id=u.code_eqp_inst) 
            left join clm_client_tbl as cl1 on (cl1.id=eqa.id_client) 
            left join clm_statecl_tbl as st on cl1.id = st.id_client
         left join sap_co_adr dd on
        substr(dd.oldkey,9)::integer in(select a.id_tu from 
	    sap_premise_dop a where a.id_eq=eq.id)
            inner join sap_const const on
            1=1
            left join clm_statecl_h as sth on cl1.id = sth.id_client and 
            sth.mmgg_e is null and sth.mmgg_b = (SELECT mmgg_b FROM clm_statecl_h WHERE id_client = sth.id_client and mmgg_b < '$dt' order by mmgg_b desc limit 1 )      
            where (eq.type_eqp = 11) and cl1.book = -1 and coalesce(cl1.id_state,0) not in(50,99,49) and coalesce(cl1.idk_work,0) not in (0) 
             and sth.mmgg_b is not null and st.doc_dat is not null  and st.id_section not in (205,206,207,208,209,218)  and sth.mmgg_b is not null and st.doc_dat is not null 
                 and cl1.id <> syi_resid_fun() 
                 and cl1.id <>999999999 and 
                  (cl1.code>999 or  cl1.code=900) AND coalesce(cl1.idk_work,0)<>0 
                 and  cl1.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                 '10999999','11000000','19999369','50999999','1000000','1000001')
            --and dd.oldkey is null    
            and (select count(*) from eqm_compens_station_inst_tbl where code_eqp_inst=eq.id)>0
              order by 7) e";

            // Делаем выборку по новому для ускорения
            $sql = "select distinct on (oldkey) * from (
        select distinct const.begru_all as pltxt,'PREMISE' as name,
         cl1.id,cl1.code, eq.name_eqp,eq.id as id_eq,
            '04_C'||'$rem'||'P_'||case when length(eq.id::varchar)<8 then
    (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(eq.id::varchar)::int)),(7-(length(eq.id::varchar)::int)))||eq.id::varchar)::int else eq.id end  as OLDKEY,
             ''::char(40) as HAUS,''::char(10) as house_num2,const.ver
             from eqm_area_tbl as eqa 
            join  eqm_equipment_tbl AS eq  on (eqa.code_eqp=eq.id) 
            join  eqm_equipment_h AS eqh  on (eqa.code_eqp=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE eqm_equipment_h.id = eq.id and dt_b < '$dt' order by dt_b desc limit 1 ) ) 
            left join adv_address_tbl as a on (a.id=eq.id_addres) 
            left join adm_address_tbl as am on a.id=am.id
            join eqm_ground_tbl as g on (eq.id=g.code_eqp) 
            left join ( select code_eqp_inst, count(*)::integer as eqp_cnt from eqm_compens_station_inst_tbl group by code_eqp_inst order by code_eqp_inst) as u on (eq.id=u.code_eqp_inst) 
            left join clm_client_tbl as cl1 on (cl1.id=eqa.id_client) 
            left join clm_statecl_tbl as st on cl1.id = st.id_client
        --left join sap_co_adr dd on
    -- substr(dd.oldkey,9)::integer in(select a.id_tu from
    --  sap_premise_dop a where a.id_eq=eq.id and a.code=cl1.code)
            inner join sap_const const on
    1=1
            left join clm_statecl_h as sth on cl1.id = sth.id_client and
    sth.mmgg_e is null and sth.mmgg_b = (SELECT mmgg_b FROM clm_statecl_h WHERE id_client = sth.id_client and mmgg_b < '$dt' order by mmgg_b desc limit 1 )      
            where (eq.type_eqp = 11) and cl1.book = -1 and coalesce(cl1.id_state,0) not in(50,99,49) and coalesce(cl1.idk_work,0) not in (0)
    and sth.mmgg_b is not null and st.doc_dat is not null  and st.id_section not in (205,206,207,208,209,218)  and sth.mmgg_b is not null and st.doc_dat is not null
    and cl1.id <> syi_resid_fun()
    and cl1.id <>999999999 and
    (cl1.code>999 or  cl1.code=900) AND coalesce(cl1.idk_work,0)<>0
    and  cl1.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001')
    --and dd.oldkey is null
    and (select count(*) from eqm_compens_station_inst_tbl where code_eqp_inst=eq.id)>0 
            order by 7) e";


            $sql_c = "select * from sap_export where objectsap='PREMISE' order by id_object";
            $zsql = 'delete from sap_evbsd';
            $sql_q = "select * from  sap_premise_dop ";
            $sql_dd = "select * from  sap_co_adr";


            if (1 == 1) {
                // Получаем необходимые данные
                switch ($res) {
                    case 1:
                        $data1 = \Yii::$app->db_pg_dn_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_dn_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_dn_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_dn_energo->createCommand($zsql)->execute();
                        break;

                    case 2:
                        $data1 = \Yii::$app->db_pg_zv_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_zv_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_zv_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_zv_energo->createCommand($zsql)->execute();
                        break;
                    case 3:
                        $data1 = \Yii::$app->db_pg_vg_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_vg_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_vg_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_vg_energo->createCommand($zsql)->execute();
                        break;
                    case 4:
                        $data1 = \Yii::$app->db_pg_pv_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_pv_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_pv_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_pv_energo->createCommand($zsql)->execute();
                        break;
                    case 5:
                        $data1 = \Yii::$app->db_pg_krg_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_krg_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_krg_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_krg_energo->createCommand($zsql)->execute();
                        break;
                    case 6:
                        $data1 = \Yii::$app->db_pg_ap_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_ap_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_ap_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_ap_energo->createCommand($zsql)->execute();
                        break;
                    case 7:
                        $data1 = \Yii::$app->db_pg_gv_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_gv_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_gv_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_gv_energo->createCommand($zsql)->execute();
                        break;
                    case 8:
                        $data1 = \Yii::$app->db_pg_in_energo->createCommand($sql_f)->queryAll();
                        $data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                        $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                        $nd2 = \Yii::$app->db_pg_in_energo->createCommand($sql_q)->queryAll();
                        $nd_dd = \Yii::$app->db_pg_in_energo->createCommand($sql_dd)->queryAll();
                        // Удаляем данные в таблицах
                        Yii::$app->db_pg_in_energo->createCommand($zsql)->execute();
                        break;
                }
            }
            $i = 0;

//debug($cnt);
//            return;

//                debug($data);
//                return;

            // Заполнение ссылок в памяти
            foreach ($data as $key => $n1) {

                $n1_code = $n1['code'];
                $n1_id = $n1['id_eq'];
                $mas = [];
                $o = 0;
                foreach ($nd2 as $n2) {
                    if ($n2['id_eq'] == $n1_id && $n2['code'] == $n1_code) {
                        $mas[$o] = $n2['id_tu'];
                        $o++;
                    }
                }
                $haus = '';
                foreach ($nd_dd as $n3) {
                    $n1_co = substr(trim($n3['oldkey']), 8);

//                debug($n3);
//                debug($n1_id);
//                debug($mas);
//                return;
                    $flag = 0;
                    for ($oo = 0; $oo < $o; $oo++) {
                        if ($mas[$oo] == $n1_co) {
                            $haus = $n3['oldkey'];
                            $house_num2 = $n3['house_num2'];
//                            debug($haus);
//                            return;
                            $flag = 1;
                            break;
                        }
                    }
                    if ($flag == 1) {
                        $data[$key]['haus'] = $haus;
                        $data[$key]['house_num2'] = $house_num2;
                        break;
                    }
                }
            }


            // Заполняем структуры
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_premise($n_struct, $rem, $w);
                }
            }

//        return;
//        }   // end if 1==2


        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        //$ver = $data[0]['ver'];
        $ver = 8;
        if ($ver < 10) $ver = '0' . $ver;
        $fname = 'PREMISE_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . '_L' . '.txt';
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $i = 0;
        $sql = "select * from sap_evbsd";
        $sql_c = "select * from sap_export where objectsap='PREMISE' order by id_object";
        switch ($res) {
            case 1:
                $struct_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                break;
            case 2:
                $struct_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                break;
            case 3:
                $struct_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                break;
            case 4:
                $struct_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                break;
            case 5:
                $struct_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                break;
            case 6:
                $struct_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                break;
            case 7:
                $struct_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                break;
            case 8:
                $struct_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                break;
        }


        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $sql = "select * from $table_struct where oldkey='$old_key'";

                    switch ($res) {
                        case 1:
                            $cur_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                            break;
                        case 2:
                            $cur_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                            break;
                        case 3:
                            $cur_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                            break;
                        case 4:
                            $cur_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                            break;
                        case 5:
                            $cur_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                            break;
                        case 6:
                            $cur_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                            break;
                        case 7:
                            $cur_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                            break;
                        case 8:
                            $cur_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                            break;
                    }
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }

                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }


//        fputs($f, "\t&ENDE");
//        fputs($f, "\n");

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        // нет объекта высшего уровня {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
        if (!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
        // нет объекта высшего уровня }

        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }

        }
        // пустая ссылка }
        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }


    //формирование файлов идентификации в САП абонентов ЕНЕРГО структруры "премайс"
    //юридические лица
    public function actionIdfile_premise($res)
    {

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'PREMISE' as OM,a.oldkey,b.code,trim(a.zz_nameplvm),const.ver from sap_EVBSD as a 
                left join clm_client_tbl as b
                on case when a.haus='' then '0000000000000' else substr(a.haus,9) end::int=b.id
                join sap_const as const on 1=1
";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    //формирование файлов идентификации в САП абонентов ЕНЕРГО структруры "instln"
    //юридические лица
    public function actionIdfile_instln($res)
    {

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'INSTLN' as OM,a.oldkey,b.code,b.short_name,const.ver  as ver from 
(select distinct on(zz_eic) u.tarif_sap,case when qqq.oldkey is null then trim(yy.oldkey) else trim(qqq.oldkey) end as vstelle,
www.short_name as real_name,const.ver,const.begru,
'10' as sparte,qqq.* from
(select distinct on(q1.num_eqp) q1.id,x.oldkey,cc.short_name,
case when q.id_cl=2062 then rr.id_client else q.id_cl end as id_potr,
q1.num_eqp as zz_eic,q.* from
(select  distinct 'DATA' as DATA,c.id as id_cl,
case when p.voltage_max = 0.22 then '02'
     when p.voltage_max = 0.4 then '03'
     when p.voltage_max = 10.00 then '05' 
     when p.voltage_max = 6.0 then '04'
     when p.voltage_max = 27.5 then '06'
     when p.voltage_max = 35.0 then '07'
     when p.voltage_max = 110.0 then '08' else '' end as SPEBENE,
'0001' as ANLART,
'0002' as ABLESARTST,
p.name_eqp as ZZ_NAMETU,
'' as ZZ_FIDER,
' ' as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'  
     when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???' 
     else 
	case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???' 
	else '???' --tar_sap.id_sap_tar 
	end 
end  as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' then '0004' else '0002' end as AKLASSE,
     'PC01311' as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
     when tgr.ident in('tgr2') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
     when tgr.ident in('tgr6') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
     when tgr.ident in('tgr3') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
     when tgr.ident in('tgr4') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
     when tgr.ident in('tgr1') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999)  then '054'
     when tgr.ident in('tgr2') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
     when tgr.ident in('tgr6') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
     when tgr.ident in('tgr3') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
     when tgr.ident in('tgr4') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
     when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2'  and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
     when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
     when tgr.ident in('tgr8_10','tgr8_30') then '298'
     when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
     when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '352'
     when ((tgr.ident ~ 'tgr7_12') or (tgr.ident~ 'tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007)  in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)  and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521'  and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0  and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and  tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and  tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10  and tcl.ident='tcl1' then '604'
when c.idk_work=99 and p.voltage_min<=10 and tcl.ident='tcl2' then '606'
when tcl.ident='tcl1' and p.id_extra =1003 then '632'
when tcl.ident='tcl2' and p.id_extra =1003 then '634'
when tcl.ident='tcl1' and p.id_extra in (1001,1002,1012,1013) then '638'
when tcl.ident='tcl2' and p.id_extra in (1001,1002,1012,1013) then '640'
when tgr.ident in('tgr8_101') then '666'
 else '' end as ZZCODE4NKRE,
'' as ZZCODE4NKRE_DOP,
'' as ZZOTHERAREA,
'1' as sort 
from (select tr.name as vid_trf,dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts, dt.ldemandr,dt.ldemandg,dt.id_un, 
dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva, dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.is_owner, eq.dt_install, eqh.dt_b, tr.id_grouptarif --, ph.id_extra --, tr.id_classtarif
	from eqm_equipment_tbl as eq 
	join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id  order by dt_b desc limit 1 ) ) 
	join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
	left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) 
	left join cla_param_tbl as p on (dt.industry=p.id) 
	left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) 
	left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) 
	left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
	left join eqk_zone_tbl AS z on (dt.zone=z.id) 
	left join cla_param_tbl AS cla on (dt.id_depart=cla.id) 
	left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
	left join clm_position_tbl as cp on (cp.id = dt.id_position) ) as p 
join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
join eqm_tree_tbl as t on (t.id = tt.id_tree) 
join (select distinct id,code,idk_work from clm_client_tbl) as c on (c.id = t.id_client) 
left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
left join clm_statecl_tbl as st on (st.id_client = c2.id) 
left join aci_tarif_tbl as tar on (tar.id=p.id_tarif)
--left join sap_energo_tarif as tar_sap on tar_sap.id_tar = p.id_tarif
left join eqi_grouptarif_tbl as tgr on tgr.id= p.id_grouptarif
left join eqi_classtarif_tbl as tcl on (p.id_classtarif=tcl.id) 
--left join reading_controller as w on w.tabel_numb = p.num_tab
left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp) 
left join (select code_eqp, trim(sum(e.name||','),',') as energy from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en on (en.code_eqp = p.code_eqp) 
) q 
left join eqm_equipment_tbl q1 
on q.zz_nametu::text=q1.name_eqp::text and substr(q1.num_eqp::text,1,3)='62Z'
left join eqm_area_tbl ar on ar.code_eqp=q1.id
left join sap_evbsd x on substr(x.haus,9)::integer=q.id_cl
left join clm_client_tbl as cc on cc.id = q.id_cl
left join 
(select u.id_client,a.id from eqm_equipment_tbl a
   left join eqm_point_tbl tu1 on tu1.code_eqp=a.id 
   left JOIN eqm_compens_station_inst_tbl AS area ON (a.id=area.code_eqp)
   left JOIN eqm_equipment_tbl AS eq2 ON (area.code_eqp_inst=eq2.id)
   left join eqm_area_tbl u on u.code_eqp=area.code_eqp_inst
   left join clm_client_tbl u1 on u1.id=u.id_client) rr 
   on rr.id=q1.id and (x.oldkey is null or q.id_cl=2062)
where SPEBENE::text<>'' and q1.num_eqp is not null) qqq
left join tarif_sap_energo u on trim(u.name)=trim(qqq.vid_trf)
left join sap_evbsd yy on substr(yy.haus,9)::integer=qqq.id_potr
left join clm_client_tbl www on www.id=qqq.id_potr
inner join sap_const const on 1=1            
) x left join 
              sap_data as a on x.id=substr(a.oldkey,12)::int
                left join clm_client_tbl as b
                on x.id_potr=b.id
                join sap_const as const on 1=1
";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла connobj для САП для бытовых
    public function actionSap_premise_ind($res, $par = 0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

//        $sql = "select a.id,a.activ,'' as pltxt,b.tax_number,b.last_name,
//                b.name,b.patron_name,c.town,c.indx,c.street,
//                c.house,c.flat,b.mob_phone,b.e_mail,const.id_res,
//                const.swerk,const.stort,const.ver,const.begru,
//                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport,dd.oldkey as haus from clm_paccnt_tbl a
//        left join clm_abon_tbl b on
//        a.id=b.id
//        left join vw_address c on
//        a.id=c.id
//        left join sap_co_adr dd on
//        ((trim(lower(c.street))=trim(lower(get_sap_street(dd.street))) and dd.str_suppl1='~') or (trim(lower(c.street))=trim(lower(dd.str_suppl1)) and trim(dd.street)='~'))
//        and case when trim(lower(get_sap_street(dd.street)))='запорізьке шосе' then  lower(trim(c.type_street))='вул.'
//        else ((coalesce(lower(trim(c.type_street)),'')=coalesce(lower(trim(get_typestreet(b1.street))),'') and trim(dd.str_suppl1)='~')
//        or (1=1 and trim(dd.street)='~')) end
//         and case when dd.city1 is null then (trim(lower(dd.city1))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end
//          ||' '||trim(lower(c.town)))) and dd.city1 is not null) else 1=1 end
//          and ((upper(dd.house_num1)=
//		case when c.korp is null then upper(c.house) else
//                case when NOT(c.korp ~ '[0-9]+$')  then upper(trim(c.house))||trim(c.korp) else upper(trim(c.house))||'/'||c.korp end end
//                and dd.str_suppl1='~') or (upper(trim(dd.str_suppl2))=upper(trim(c.house)) and trim(dd.street)='~'))
//        inner join sap_const const on
//        1=1
//        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
//        trim(c.district)=d.region
//        where a.archive='0'
//        ";

        $sql = "select DISTINCT a.id,a.activ,'' as pltxt,b.tax_number,b.last_name,
                b.name,b.patron_name,c.town,c.indx,c.street,
                c.house,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.swerk,const.stort,const.ver,const.begru,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport,dd.oldkey as haus from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id_abon=b.id
        left join vw_address c on
        a.id=c.id
        left join sap_but020 c1 on c1.old_key='04_C'||'$rem'||'B_'||a.id
        left join sap_co_adr dd on
        (trim(c1.city1)=trim(dd.city1) and trim(c1.street)=trim(dd.street) and 
       upper(trim(c1.house_num1))=upper(trim(dd.house_num1))
        and coalesce(trim(replace(c1.house_num2,'корп.','')),'~')=case when trim(dd.house_num2)='' then '~' ELSE coalesce(trim(dd.house_num2),'~') END
        and dd.str_suppl1='~') or (dd.str_suppl1<>'~' and trim(c1.str_suppl1)=trim(dd.str_suppl1) and trim(c1.str_suppl2)=trim(dd.str_suppl2))
        inner join sap_const const on 1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region
        where a.archive='0' 
       -- limit 10
       ";
        $sql_c = "select * from sap_export where objectsap='PREMISE_IND' order by id_object";
        $zsql = 'delete from sap_evbsd';
        //$cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();

        if (1 == 1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_dn_abn->createCommand($zsql)->execute();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_zv_abn->createCommand($zsql)->execute();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_vg_abn->createCommand($zsql)->execute();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_pv_abn->createCommand($zsql)->execute();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_krg_abn->createCommand($zsql)->execute();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_ap_abn->createCommand($zsql)->execute();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_gv_abn->createCommand($zsql)->execute();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_abn->createCommand($sql_c)->queryAll();
                    Yii::$app->db_pg_in_abn->createCommand($zsql)->execute();
                    break;
            }

            // Удаляем данные в таблицах
//            $zsql = 'delete from sap_evbsd';
//            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();

            $i = 0;
            // Заполняем структуры
            $t_v = '';
            $y = count($data);
            $j = 0;
//            $fff=fopen('aaa_res.txt','w+');
            foreach ($data as $w) {
                $i = 0;
                $j++;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
//                    f_premise_ind($n_struct, $rem, $w);
                    if ($j < $y)
                        $t_v = $t_v . f_premise_ind_new($n_struct, $rem, $w) . ',';
                    else
                        $t_v = $t_v . f_premise_ind_new($n_struct, $rem, $w);
//                    fputs($fff,f_premise_ind_new($n_struct, $rem, $w));
//                    fputs($fff,"\n");
                }
            }
            $zapros = "insert into sap_evbsd(oldkey,dat_type,haus,haus_num2,lgzusatz,vbsart,begru) values " . $t_v;
//            debug($zapros);
//            return;
            $data1 = data_to_server($zapros, $res, 1);   // Запись данных на сервер

        }
        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        // $fname='PARTNER_04'.'_CK'.$rem.'_B'.$fd.'.txt';
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = 'PREMISE_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . '_R' . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $i = 0;
        $sql = "select * from sap_evbsd";
        //$struct_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();

        switch ($res) {
            case 1:
                $struct_data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                break;
            case 2:
                $struct_data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                break;
            case 3:
                $struct_data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                break;
            case 4:
                $struct_data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                break;
            case 5:
                $struct_data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                break;
            case 6:
                $struct_data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                break;
            case 7:
                $struct_data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                break;
            case 8:
                $struct_data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                break;
        }
        $yy = count($cnt);
//        debug($yy);
//        return;

        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;

            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $sql = "select * from $table_struct where oldkey='$old_key'";
//                    $cur_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();

                    switch ($res) {
                        case 1:
                            $cur_data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                            break;
                        case 2:
                            $cur_data = \Yii::$app->db_pg_zv_abn->createCommand($sql)->queryAll();
                            break;
                        case 3:
                            $cur_data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                            break;
                        case 4:
                            $cur_data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                            break;
                        case 5:
                            $cur_data = \Yii::$app->db_pg_krg_abn->createCommand($sql)->queryAll();
                            break;
                        case 6:
                            $cur_data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                            break;
                        case 7:
                            $cur_data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                            break;
                        case 8:
                            $cur_data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                            break;
                    }

                    foreach ($cur_data as $d1) {

                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }

                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }
        //fclose($f);


        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        // нет объекта высшего уровня {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
        if (!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
        // нет объекта высшего уровня }

        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }

        }
        // пустая ссылка }
        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }


//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//        else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

//        fputs($f, "\t&ENDE");
//        fputs($f, "\n");

//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//
//        return $this->render('info', [
//            'model' => $model]);
    }

    //формирование файлов идентификации в САП абонентов АБН структруры "премайс"
    //бытовые абоненты
    public function actionIdfile_premise_ind($res, $par = 0)
    {

        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'PREMISE' as OM,a.oldkey,b.code,a.haus_num2,const.ver from sap_EVBSD as a
                left join clm_paccnt_tbl as b
                on substr(a.oldkey,9)::int=b.id
                join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        deleterOM_ext($fname, $rem);
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        if ($par == 0)
            return $this->render('info', [
                'model' => $model]);
        else
            return 1;

    }


    // Форматирование файла partner для САП для юридических партнеров
    public function actionSap_account($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        $sql = "-- INIT
select s1.*,s2.*,s3.*,s4.*,s5.*,case when s1.vkona in(select c.code from eqm_meter_tbl m
 join eqm_equipment_tbl as eq on (m.code_eqp = eq.id)
  left join (select code as id,min(sap_cnt) as sap_meter_id from sap_meter_cnt where sap_cnt<>'' group by code) s on s.id::integer=m.id_type_eqp
  left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22) sd on s.sap_meter_id=sd.sap_meter_id
     left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client))) then '' else 'X' end as znodev,
     row_number() OVER() as id_str  
from
(select 'INIT' as struct,a.id,a.code as vkona,
case when a.code<>900 then const.vktyp else '44' end as vktyp,'04_C'||'$rem'||'P_'||a.id as gpart
from clm_client_tbl as a
left join clm_statecl_tbl as b on a.id = b.id_client
inner join sap_const const on 1=1
WHERE 
        --a.code_okpo<>'' and a.code_okpo<>'000000000'
       -- and a.code_okpo<>'0000000'
	    --and a.code_okpo<>'000000'
	       ((a.code>999 or  a.code=900) AND coalesce(a.idk_work,0)<>0 
	     and  a.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')) or  a.code in('10001306')  
	    ) s1
left join
--VK
(select 'VK' as struct,cl.id,
case when length((case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar)=1 
then '0'||(case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar 
else (case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar end   as ZDATEREP
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE 
      -- cl.code_okpo<>'' and cl.code_okpo<>'000000000'
       -- and cl.code_okpo<>'0000000'
	   -- and cl.code_okpo<>'000000'
	       ((cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0 
	     and  cl.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')) or  cl.code in('10001306')  
	   ) s2 on s1.id=s2.id
left join
-- VKP
(select distinct 'VKP' as struct,cl.id,vktyp as vktyp1,'04_C'||'$rem'||'P_'||cl.id as partner,const.opbuk,51 as ikey,13 as mahnv,
const.begru_all as begru,b.adext_addr as adrnb_ext,
'0005' as ZAHLKOND,'0002' as VERTYP,
case when (coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)=99) or cl.code=900  then '04' 
     when coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)<>99  then '02'
     when coalesce(st.flag_budjet,0)=1 then '03' 
     else '02' 
     end as KOFIZ_SD,
     case when trim(coalesce(zpay." . '"TYPE"' . ",'0'))='0' then '0' else '5' end as KZABSVER,
     const.opbuk as stdbk,
     case when coalesce(st.flag_budjet,0)=1 then
     case when st.id_budjet=1000510 or st.id_section =211 then '1'
          when st.id_budjet=1000521 or st.id_section =213 then '2'
          when st.id_budjet=1000522 or st.id_section =215 then '3'
          when st.id_budjet=1000523 or st.id_section =214 then '4'	
          when st.id_budjet=1000520 or st.id_section is null then
	  case when st.id_section=213 then '2'
	       when st.id_section=214 then '4'
	       when st.id_section=215 then '3'
	  else ''
	  end
     else '' end
else '5' end as FKRU_FIS,
case when st.id_section in(210,211) then '10'
     when st.id_section=212 then '20'
     when st.id_section=213 then '21'
     when st.id_section=214 then '22'
     when st.id_section=215 then '23'
     when st.id_section=203 then '30'
     when st.id_section=201 then '40'
     when st.id_section=202 then '60'
     when st.id_section=205 then '81'
     when st.id_section=207 then '82'
     when st.id_section=206 then '83'
     when st.id_section=204 then '50'
     else '' end as ZSECTOR,
    case when zz.code_budget is null then '' else 
    case when st.id_budjet=1000510 or st.id_section =211 then zz.code_budget else '' end end as ZZ_MINISTRY,
     replace((case when st.doc_dat<'2019-01-01' then '2019-01-01' else st.doc_dat end)::varchar ,'-','') as ZZ_START,
     '' as ZZ_END,''  as ZZ_BUDGET,ww.ZZ_TERRITORY as ZZ_TERRITORY,const.area_id as zz_area_id,
     case when upper(cntr.name) like '%ДНІПРОВСЬКІ ЕНЕРГЕТИЧНІ ПОСЛУГИ%' then '02'
             when upper(cntr.name) like '%УКРІНТЕРЕНЕРГО%' then '03'
             else '01' end as zz_distrib_type
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
left join sap_payment_scheme zpay on cl.code=zpay.vkont::int
left join (select distinct aa.id_client,bb.name from clm_contractor_tbl aa    
		left join cli_contractor_tbl bb on aa.id_contractor=bb.id where aa.dt_contr_end is null) cntr on cntr.id_client=cl.id
inner join sap_const const on 1=1
left join sap_but020 b on '04_C04P_'||cl.id=b.oldkey
left join (select distinct code,code_budget from code_budget) zz on trim(zz.code)=trim(cl.code::char(12))

left join
(select distinct id_potr,case when substr(trim(first_value(adr) over(partition by id_potr)),1,3)='м. ' then 1 else 2 end as zz_territory from
(
select p.*, c.code,c2.id as id_potr, c.short_name as name, c2.code as use_code, c2.name as use_name, area.area_name, en.energy , abonpar.doc_num
from ( select dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, dt.id_tg,
 p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, 
 dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts,
  dt.ldemandr,dt.ldemandg,dt.id_un, dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva,
   dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.id_addres,q.adr, eq.num_eqp as eis_cod, eq.is_owner, eq.dt_install from eqm_equipment_tbl as eq 
   join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
   left join adv_address_tbl q on (q.id=eq.id_addres) 
   left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) left join cla_param_tbl as p on (dt.industry=p.id)
   left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
   left join eqk_zone_tbl AS z on (dt.zone=z.id) left join cla_param_tbl AS cla on (dt.id_depart=cla.id) left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
   left join clm_position_tbl as cp on (cp.id = dt.id_position)) as p join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
   join eqm_tree_tbl as t on (t.id = tt.id_tree) 
   join clm_client_tbl as c on (c.id = t.id_client) 
   left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
   
   left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
   left join clm_statecl_tbl as abonpar on (abonpar.id_client = c2.id) 
   
   left join (select ins.code_eqp, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area
    on (area.code_eqp = p.code_eqp) left join (select code_eqp, trim(sum(e.name||','),',') as energy 
    from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en 
    on (en.code_eqp = p.code_eqp) where coalesce (use.id_client, t.id_client) <> syi_resid_fun() and (c2.id = NULL or NULL is null 
    and c2.idk_work not in (0,99) and coalesce(c2.id_state,0) not in (50,99) ) 
    order by c2.code, p.name_eqp
    ) w ) ww on ww.id_potr=cl.id 


WHERE 
       --cl.code_okpo<>'' and cl.code_okpo<>'000000000'
        --and cl.code_okpo<>'0000000'
	    --and cl.code_okpo<>'000000'
	      ((cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0 
	     and  cl.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')) or  cl.code in('10001306') 
	    ) s3 on s2.id=s3.id

left join
-- KVV
(select 'KVV' as struct,cl.id,'20200301' as date_from,'99991231' as date_to
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE 
        --cl.code_okpo<>'' and cl.code_okpo<>'000000000'
        --and cl.code_okpo<>'0000000'
	    --and cl.code_okpo<>'000000'
	     ((cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0 
	     and  cl.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')) or  cl.code in('10001306')  
	    ) s4 on s3.id=s4.id
left join
--ZSTAT
(select 'ZSTAT' as struct,cl.id,'CONT07' as obj,
case when ($rem='01' or  $rem='02') and 
(substr(cl.short_name,1,3)='РП '  or substr(cl.short_name,1,2)='Р ') then  'CON005' else 'CON003' end as status,
case when st.doc_dat is null then '20200101'::varchar else replace(st.doc_dat::varchar ,'-','') end as date_reg,
'99991231' as date_to,''::text as price,
''::text as COMMENTS,''::text as LOEVM,acc.cat_sap as zz_categ
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
left join sap_categ_acc acc on acc.id_cat::int=st.id_nkrekp
inner join sap_const const on 1=1
WHERE 
        -- cl.code_okpo<>'' and cl.code_okpo<>'000000000'
        -- and cl.code_okpo<>'0000000'
	    -- and cl.code_okpo<>'000000'
	     ((cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0 
	     and  cl.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')) or  cl.code in('10001306') 
	     
	    ) s5 on s4.id=s5.id  
	  -- where s1.id=162582
        order by kzabsver 
";
        



        $sql1 = " select * from (
            select s1.*,s2.*,s3.*,s4.*,s5.*,case when s1.vkona in(select c.code from eqm_meter_tbl m
 join eqm_equipment_tbl as eq on (m.code_eqp = eq.id)
  left join (select code as id,min(sap_cnt) as sap_meter_id from sap_meter_cnt where sap_cnt<>'' group by code) s on s.id::integer=m.id_type_eqp
  left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22) sd on s.sap_meter_id=sd.sap_meter_id
     left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client))) then '' else 'X' end as znodev,
     row_number() OVER() as id_str  
from
(select 'INIT'::text as struct,a.id,a.code as vkona,const.vktyp as vktyp,'04_C01P_'||a.id as gpart
from clm_client_tbl as a
left join clm_statecl_tbl as b on a.id = b.id_client
inner join sap_const const on 1=1
WHERE
--a.code_okpo<>'' and a.code_okpo<>'000000000'
    -- and a.code_okpo<>'0000000'
    --and a.code_okpo<>'000000'
	       (a.code>999 or  a.code=900) AND coalesce(a.idk_work,0)<>0
           and  a.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	    ) s1
left join
    --VK
    (select 'VK'::text as struct,cl.id,
case when length((case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar)=1 
then '0'||(case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar 
else (case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar end   as ZDATEREP
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE
-- cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    -- and cl.code_okpo<>'0000000'
    -- and cl.code_okpo<>'000000'
	       (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
           and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	   ) s2 on s1.id=s2.id
left join
    -- VKP
    (select distinct 'VKP'::text as struct,cl.id,vktyp as vktyp,'04_C04P_'||cl.id as partner,const.opbuk,51 as ikey,13 as mahnv,
const.begru_all as begru,b.adext_addr as adrnb_ext,
'0005' as ZAHLKOND,'0002' as VERTYP,
case when coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)=99  then '04' 
     when coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)<>99  then '02'
     when coalesce(st.flag_budjet,0)=1 then '03' 
     else '02' 
     end as KOFIZ_SD,
     '5' as KZABSVER,
     const.opbuk as stdbk,
     case when coalesce(st.flag_budjet,0)=1 then
     case when st.id_budjet=1000510 or st.id_section =211 then '1'
          when st.id_budjet=1000521 or st.id_section =213 then '2'
          when st.id_budjet=1000522 or st.id_section =215 then '3'
          when st.id_budjet=1000523 or st.id_section =214 then '4'	
          when st.id_budjet=1000520 or st.id_section is null then
	  case when st.id_section=213 then '2'
	       when st.id_section=214 then '4'
	       when st.id_section=215 then '3'
	  else ''
	  end
     else '' end
else '5' end as FKRU_FIS,
case when st.id_section in(210,211) then '10'
     when st.id_section=212 then '20'
     when st.id_section=213 then '21'
     when st.id_section=214 then '22'
     when st.id_section=215 then '23'
     when st.id_section=203 then '30'
     when st.id_section=201 then '40'
     when st.id_section=202 then '60'
     when st.id_section=205 then '81'
     when st.id_section=207 then '82'
     when st.id_section=206 then '83'
     when st.id_section=204 then '50'
     else '' end as ZSECTOR,
     ''  as ZZ_MINISTRY,
     replace((case when st.doc_dat<'2019-01-01' then '2019-01-01' else st.doc_dat end)::varchar ,'-','') as ZZ_START,
     '' as ZZ_END,''  as ZZ_BUDGET,ww.ZZ_TERRITORY as ZZ_TERRITORY
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
left join sap_but020 b on '04_C04P_'||cl.id=b.oldkey

left join
    (select distinct id_potr,case when substr(trim(first_value(adr) over(partition by id_potr)),1,3)='м. ' then 1 else 2 end as zz_territory from
    (
        select p.*, c.code,c2.id as id_potr, c.short_name as name, c2.code as use_code, c2.name as use_name, area.area_name, en.energy , abonpar.doc_num
from ( select dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, dt.id_tg,
 p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, 
 dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts,
  dt.ldemandr,dt.ldemandg,dt.id_un, dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva,
   dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.id_addres,q.adr, eq.num_eqp as eis_cod, eq.is_owner, eq.dt_install from eqm_equipment_tbl as eq 
   join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
   left join adv_address_tbl q on (q.id=eq.id_addres) 
   left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) left join cla_param_tbl as p on (dt.industry=p.id)
   left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
   left join eqk_zone_tbl AS z on (dt.zone=z.id) left join cla_param_tbl AS cla on (dt.id_depart=cla.id) left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
   left join clm_position_tbl as cp on (cp.id = dt.id_position)) as p join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
   join eqm_tree_tbl as t on (t.id = tt.id_tree) 
   join clm_client_tbl as c on (c.id = t.id_client) 
   left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
   
   left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
   left join clm_statecl_tbl as abonpar on (abonpar.id_client = c2.id) 
   
   left join (select ins.code_eqp, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area
    on (area.code_eqp = p.code_eqp) left join (select code_eqp, trim(sum(e.name||','),',') as energy 
    from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en 
    on (en.code_eqp = p.code_eqp) where coalesce (use.id_client, t.id_client) <> syi_resid_fun() and (c2.id = NULL or NULL is null
    and c2.idk_work not in (0,99) and coalesce(c2.id_state,0) not in (50,99) ) 
    order by c2.code, p.name_eqp
    ) w ) ww on ww.id_potr=cl.id 


WHERE
--cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    --and cl.code_okpo<>'0000000'
    --and cl.code_okpo<>'000000'
	      (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
          and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	    ) s3 on s2.id=s3.id

left join
    -- KVV
    (select 'KVV'::text as struct,cl.id,'20200301'::text as date_from,'99991231'::text as date_to
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE
--cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    --and cl.code_okpo<>'0000000'
    --and cl.code_okpo<>'000000'
	     (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
         and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	    ) s4 on s3.id=s4.id
left join
    --ZSTAT
    (select 'ZSTAT'::text as struct,cl.id,'CONT07'::text as obj,
case when ('01'='01' or  '01'='02') and
    (substr(cl.short_name,1,3)='РП '  or substr(cl.short_name,1,2)='Р ') then  'CON005' else 'CON003' end as status,
case when st.doc_dat is null then '20200101'::varchar else replace(st.doc_dat::varchar ,'-','') end as date_reg,
'99991231'::text as date_to,''::text as price,
''::text as COMMENTS,''::text as LOEVM
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE
-- cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    -- and cl.code_okpo<>'0000000'
    -- and cl.code_okpo<>'000000'
	     (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
         and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001')  
	     
	    ) s5 on s4.id=s5.id  
	    where (s1.id>=13060 and s1.id<=13070) or s1.id=13061
union all

select s1.*,s2.*,s3.*,s4.*,s5.*,case when s1.vkona in(select c.code from eqm_meter_tbl m
 join eqm_equipment_tbl as eq on (m.code_eqp = eq.id)
  left join (select code as id,min(sap_cnt) as sap_meter_id from sap_meter_cnt where sap_cnt<>'' group by code) s on s.id::integer=m.id_type_eqp
  left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22) sd on s.sap_meter_id=sd.sap_meter_id
     left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id) 
     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client))) then '' else 'X' end as znodev,
     row_number() OVER() as id_str  
from
(select 'INIT'::text as struct,a.id,a.code as vkona,const.vktyp as vktyp,'04_C01P_'||a.id as gpart
from clm_client_tbl as a
left join clm_statecl_tbl as b on a.id = b.id_client
inner join sap_const const on 1=1
WHERE
--a.code_okpo<>'' and a.code_okpo<>'000000000'
    -- and a.code_okpo<>'0000000'
    --and a.code_okpo<>'000000'
	       (a.code>999 or  a.code=900) AND coalesce(a.idk_work,0)<>0
           and  a.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	    ) s1
left join
    --VK
    (select 'VK'::text as struct,cl.id,
case when length((case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar)=1 
then '0'||(case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar 
else (case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar end   as ZDATEREP
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE
-- cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    -- and cl.code_okpo<>'0000000'
    -- and cl.code_okpo<>'000000'
	       (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
           and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	   ) s2 on s1.id=s2.id
left join
    -- VKP
    (select distinct 'VKP'::text as struct,cl.id,vktyp as vktyp,'04_C04P_'||cl.id as partner,const.opbuk,51 as ikey,13 as mahnv,
const.begru_all as begru,b.adext_addr as adrnb_ext,
'0005' as ZAHLKOND,'0002' as VERTYP,
case when coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)=99  then '04' 
     when coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)<>99  then '02'
     when coalesce(st.flag_budjet,0)=1 then '03' 
     else '02' 
     end as KOFIZ_SD,
     '5' as KZABSVER,
     const.opbuk as stdbk,
     case when coalesce(st.flag_budjet,0)=1 then
     case when st.id_budjet=1000510 or st.id_section =211 then '1'
          when st.id_budjet=1000521 or st.id_section =213 then '2'
          when st.id_budjet=1000522 or st.id_section =215 then '3'
          when st.id_budjet=1000523 or st.id_section =214 then '4'	
          when st.id_budjet=1000520 or st.id_section is null then
	  case when st.id_section=213 then '2'
	       when st.id_section=214 then '4'
	       when st.id_section=215 then '3'
	  else ''
	  end
     else '' end
else '5' end as FKRU_FIS,
case when st.id_section in(210,211) then '10'
     when st.id_section=212 then '20'
     when st.id_section=213 then '21'
     when st.id_section=214 then '22'
     when st.id_section=215 then '23'
     when st.id_section=203 then '30'
     when st.id_section=201 then '40'
     when st.id_section=202 then '60'
     when st.id_section=205 then '81'
     when st.id_section=207 then '82'
     when st.id_section=206 then '83'
     when st.id_section=204 then '50'
     else '' end as ZSECTOR,
     ''  as ZZ_MINISTRY,
     replace((case when st.doc_dat<'2019-01-01' then '2019-01-01' else st.doc_dat end)::varchar ,'-','') as ZZ_START,
     '' as ZZ_END,''  as ZZ_BUDGET,ww.ZZ_TERRITORY as ZZ_TERRITORY
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
left join sap_but020 b on '04_C04P_'||cl.id=b.oldkey

left join
    (select distinct id_potr,case when substr(trim(first_value(adr) over(partition by id_potr)),1,3)='м. ' then 1 else 2 end as zz_territory from
    (
        select p.*, c.code,c2.id as id_potr, c.short_name as name, c2.code as use_code, c2.name as use_name, area.area_name, en.energy , abonpar.doc_num
from ( select dt.power,dt.connect_power, dt.id_tarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, dt.id_tg,
 p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, dt.ldemand, dt.pdays, dt.count_itr, dt.itr_comment, 
 dt.cmp, dt.day_control, v.voltage_min, v.voltage_max, dt.zone, z.name as zname, dt.flag_hlosts, dt.id_depart, cla.name as department,dt.main_losts,
  dt.ldemandr,dt.ldemandg,dt.id_un, dt.lost_nolost, dt.id_extra,dt.reserv,cla2.name as extra,vun.voltage_min as un, cp.represent_name, dt.con_power_kva,
   dt.safe_category, dt.disabled, dt.code_eqp, eq.name_eqp, eq.id_addres,q.adr, eq.num_eqp as eis_cod, eq.is_owner, eq.dt_install from eqm_equipment_tbl as eq 
   join eqm_point_tbl AS dt on (dt.code_eqp= eq.id) 
   left join adv_address_tbl q on (q.id=eq.id_addres) 
   left join aci_tarif_tbl as tr on (tr.id=dt.id_tarif) left join cla_param_tbl as p on (dt.industry=p.id)
   left join eqk_tg_tbl as tg on (dt.id_tg=tg.id) left join eqk_voltage_tbl AS v on (dt.id_voltage=v.id) left join eqk_voltage_tbl AS vun on (dt.id_un=vun.id) 
   left join eqk_zone_tbl AS z on (dt.zone=z.id) left join cla_param_tbl AS cla on (dt.id_depart=cla.id) left join cla_param_tbl AS cla2 on (dt.id_extra=cla2.id) 
   left join clm_position_tbl as cp on (cp.id = dt.id_position)) as p join eqm_eqp_tree_tbl as tt on (p.code_eqp = tt.code_eqp) 
   join eqm_tree_tbl as t on (t.id = tt.id_tree) 
   join clm_client_tbl as c on (c.id = t.id_client) 
   left join eqm_eqp_use_tbl as use on (use.code_eqp = p.code_eqp) 
   
   left join clm_client_tbl as c2 on (c2.id = coalesce (use.id_client, t.id_client)) 
   left join clm_statecl_tbl as abonpar on (abonpar.id_client = c2.id) 
   
   left join (select ins.code_eqp, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area
    on (area.code_eqp = p.code_eqp) left join (select code_eqp, trim(sum(e.name||','),',') as energy 
    from eqd_point_energy_tbl as pe join eqk_energy_tbl as e on (e.id = pe.kind_energy) group by code_eqp ) as en 
    on (en.code_eqp = p.code_eqp) where coalesce (use.id_client, t.id_client) <> syi_resid_fun() and (c2.id = NULL or NULL is null
    and c2.idk_work not in (0,99) and coalesce(c2.id_state,0) not in (50,99) ) 
    order by c2.code, p.name_eqp
    ) w ) ww on ww.id_potr=cl.id 


WHERE
--cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    --and cl.code_okpo<>'0000000'
    --and cl.code_okpo<>'000000'
	      (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
          and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	    ) s3 on s2.id=s3.id

left join
    -- KVV
    (select 'KVV'::text as struct,cl.id,'20200301'::text as date_from,'99991231'::text as date_to
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE
--cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    --and cl.code_okpo<>'0000000'
    --and cl.code_okpo<>'000000'
	     (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
         and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001') 
	    ) s4 on s3.id=s4.id
left join
    --ZSTAT
    (select 'ZSTAT'::text as struct,cl.id,'CONT07'::text as obj,
case when ('01'='01' or  '01'='02') and
    (substr(cl.short_name,1,3)='РП '  or substr(cl.short_name,1,2)='Р ') then  'CON005' else 'CON003' end as status,
case when st.doc_dat is null then '20200101'::varchar else replace(st.doc_dat::varchar ,'-','') end as date_reg,
'99991231'::text as date_to,''::text as price,
''::text as COMMENTS,''::text as LOEVM
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE
-- cl.code_okpo<>'' and cl.code_okpo<>'000000000'
    -- and cl.code_okpo<>'0000000'
    -- and cl.code_okpo<>'000000'
	     (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0
         and  cl.code not in('20000556','20000565','20000753',
        '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
        '10999999','11000000','19999369','50999999','1000000','1000001')  
	     
	    ) s5 on s4.id=s5.id  
	    where (s1.id>=13060 and s1.id<=13070) or s1.id=13061	
	        ) w";


        $sql_c = "select * from sap_export where objectsap='ACCOUNT' order by id_object";
        $sql_err = "delete from sap_err where upload='ACCOUNT' and res=$res";

//        $zsql =  'delete from sap_vk';
//        $zsql1 = 'delete from sap_but000';
//        $zsql2 = 'delete from sap_ekun';
//        $zsql3 = 'delete from sap_but020';
//        $zsql4 = 'delete from sap_but0id';
//        $zsql5 = 'delete from sap_but021';


        if (1 == 1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);

                        Yii::$app->db_pg_dn_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_dn_energo->createCommand($sql_err)->execute();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);

                        Yii::$app->db_pg_zv_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_zv_energo->createCommand($sql_err)->execute();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);
                        Yii::$app->db_pg_vg_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_vg_energo->createCommand($sql_err)->execute();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);

                        Yii::$app->db_pg_pv_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_pv_energo->createCommand($sql_err)->execute();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);
                        Yii::$app->db_pg_krg_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_krg_energo->createCommand($sql_err)->execute();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);
                        Yii::$app->db_pg_ap_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_ap_energo->createCommand($sql_err)->execute();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);
                        Yii::$app->db_pg_gv_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_gv_energo->createCommand($sql_err)->execute();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v) {
                        if (trim($v['dattype']) == 'INIT')
                            $z = 'delete from sap_' . trim($v['dattype']) . '_acc';
                        else
                            $z = 'delete from sap_' . trim($v['dattype']);
                        Yii::$app->db_pg_in_energo->createCommand($z)->execute();
                    }
                    Yii::$app->db_pg_in_energo->createCommand($sql_err)->execute();
                    break;
            }
            $i = 0;

//            debug($data);
//            return;

            // Заполняем структуры
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_account($n_struct, $rem, $w);
                }
            }
        }
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $fname = 'ACCOUNT_04' . '_CK' . $rem . '_' . $fd . '_08' . '_L' . '.txt';
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $i = 0;

        $sql = "select * from sap_init_acc";
        switch ($res) {
            case 1:
                $struct_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                break;
            case 2:
                $struct_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                break;
            case 3:
                $struct_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                break;
            case 4:
                $struct_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                break;
            case 5:
                $struct_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                break;
            case 6:
                $struct_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                break;
            case 7:
                $struct_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                break;
            case 8:
                $struct_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                break;
        }


        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $sql = "select * from $table_struct where oldkey='$old_key'";

                    switch ($res) {
                        case 1:
                            $cur_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                            break;
                        case 2:
                            $cur_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                            break;
                        case 3:
                            $cur_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                            break;
                        case 4:
                            $cur_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                            break;
                        case 5:
                            $cur_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                            break;
                        case 6:
                            $cur_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                            break;
                        case 7:
                            $cur_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                            break;
                        case 8:
                            $cur_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                            break;
                    }
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }

                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }


//        fputs($f, "\t&ENDE");
//        fputs($f, "\n");
        fclose($f);

        // Проверка файла выгрузки
        echo '<br>';
        echo '<br>';;
        echo '<br>';
        echo '<br>';
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        $res = (int)$rem;
        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 5;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }

        // нет объекта высшего уровня {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
        if (!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
        // нет объекта высшего уровня }

        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // пустая ссылка }

        //
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
//        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }


    //формирование файла идентификации
    // Формирование файла account для САП для Юр.лиц
    public function actionIdfile_account($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'ACCOUNT' as OM,a.oldkey,b.code,b.short_name,const.ver from sap_init_acc as a
                left join  clm_client_tbl b 
                on a.vkona::int=b.code
                join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Формирование файла devloc для САП для Юридических потребителей
    public function actionSap_devloc($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        $sql_old = "select cl.id,b.haus as haus,b.oldkey as vstelle,const.swerk,
                  const.stort,const.begru_all as begru,const.ver
                from clm_client_tbl as cl
                left join clm_statecl_tbl as st on cl.id = st.id_client
                left join sap_evbsd b on b.haus='04_C'||$$$rem$$||'P_'||cl.id  
                inner join sap_const const on 1=1
                WHERE
                (cl.code>999 or  cl.code=900) AND coalesce(cl.idk_work,0)<>0 
                 and  cl.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                 '10999999','11000000','19999369','50999999','1000000','1000001')
                and b.oldkey is not null";

        $sql = "select a.id,b.haus as haus,b.oldkey as vstelle,const.swerk,
                  const.stort,const.begru_all as begru,const.ver
                from eqm_equipment_tbl a
		     left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
		     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
		     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
		     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                left join sap_evbsd b on b.haus='04_C'||'$rem'||'P_'||a.id  
                inner join sap_const const on 1=1
                WHERE a.type_eqp=12 and
                (c.code>999 or  c.code=900) AND coalesce(c.idk_work,0)<>0 
                 and  c.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                 '10999999','11000000','19999369','50999999','1000000','1000001')
                 and b.oldkey is not null";

        $sql_last_version = "select * from (
            select  distinct a.id*10+row_number() OVER (partition BY a.id,coalesce(b.oldkey,b1.oldkey)) as id,
                coalesce(b.haus,b1.haus) as haus,coalesce(b.oldkey,b1.oldkey) as vstelle,const.swerk,
                  const.stort,const.begru_all as begru,const.ver
                from eqm_equipment_tbl a
		     left join eqm_eqp_use_tbl as use on (use.code_eqp = a.id) 
		     left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = a.id
		     left join eqm_tree_tbl tr on tr.id = ttr.id_tree
		     left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client)) 
                left join sap_evbsd b on b.haus='04_C'||'$rem'||'P_'||a.id  
                left join (select distinct id_tu,id_eq,code,row_number() OVER (partition BY id_tu,code) as kol from sap_premise_dop) d 
                on d.id_tu=a.id and d.code=c.code and d.kol=1
                left join sap_evbsd b1 on b1.oldkey = ('04_C'||'$rem'||'P_'||'$res'||'0'||d.id_eq)
                inner join sap_const const on 1=1
                WHERE a.type_eqp=12 and
                (c.code>999 or  c.code=900) AND coalesce(c.idk_work,0)<>0 
                 and  c.code not in('20000556','20000565','20000753',
                 '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
                 '10999999','11000000','19999369','50999999','1000000','1000001')
                 --and b.oldkey is not null
                 order by 1) r
                 where haus is not null and vstelle is not null
                 ";

//        debug($sql);
//        return;

        $sql_c = "select * from sap_export where objectsap='DEVLOC' order by id_object";
        $zsql = 'delete from sap_egpld';


        if (1 == 1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_dn_energo->createCommand($zsql)->execute();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_zv_energo->createCommand($zsql)->execute();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_vg_energo->createCommand($zsql)->execute();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_pv_energo->createCommand($zsql)->execute();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_krg_energo->createCommand($zsql)->execute();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_ap_energo->createCommand($zsql)->execute();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_gv_energo->createCommand($zsql)->execute();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_in_energo->createCommand($zsql)->execute();
                    break;
            }
            $i = 0;

            // Заполняем структуры
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_devloc($n_struct, $rem, $w);
                }
            }
        }
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = 'DEVLOC_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . '_L' . '.txt';
        $f = fopen($fname, 'w+');
        // Считываем данные в файл с каждой таблицы
        $i = 0;
        $sql = "select * from sap_egpld";
        switch ($res) {
            case 1:
                $struct_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                break;
            case 2:
                $struct_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                break;
            case 3:
                $struct_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                break;
            case 4:
                $struct_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                break;
            case 5:
                $struct_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                break;
            case 6:
                $struct_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                break;
            case 7:
                $struct_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                break;
            case 8:
                $struct_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                break;
        }

//        $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();

        foreach ($struct_data as $d) {
            $old_key = trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s = implode("\t", $d);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i = 0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if ($i > 1) {
                    $sql = "select * from $table_struct where oldkey='$old_key'";

                    switch ($res) {
                        case 1:
                            $cur_data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                            break;
                        case 2:
                            $cur_data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                            break;
                        case 3:
                            $cur_data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                            break;
                        case 4:
                            $cur_data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                            break;
                        case 5:
                            $cur_data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                            break;
                        case 6:
                            $cur_data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                            break;
                        case 7:
                            $cur_data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                            break;
                        case 8:
                            $cur_data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                            break;
                    }

                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1 = implode("\t", $d1);
                        $s1 = str_replace("~", "", $s1);
                        $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
                        fputs($f, $s1);
                        fputs($f, "\n");
                    }

                }
            }
            fputs($f, $old_key . "\t&ENDE");
            fputs($f, "\n");
        }

//        fputs($f, "\t&ENDE");
//        fputs($f, "\n");

        // Проверка файла выгрузки
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла
        // Удаляем предыдущую информацию
        $res = (int)$rem;
        $sql_err = "delete from sap_err where upload='$filename' and res=$res";
        exec_on_server($sql_err, (int)$rem, $vid);

        // задвоения по oldkey  {
        $err = double_oldkey($fname);
        // Запись в таблицу ошибок
        if (count($err)) {
            foreach ($err as $v) {
                $z = "INSERT  INTO sap_err VALUES('$filename','$v','Задвоения по oldkey',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }
        }
        // задвоения по oldkey  }

        // задвоения структур {
//        $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $err = double_struct($fname);
        if ($err <> '') {

            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Задвоения структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // задвоения структур }

        // отсутствие структуры {
//         $fname='ACCOUNT_04_CK01_20200505_08_L.txt';
        $cnt = 2;
        $err = no_struct($fname, $cnt);
        if ($err <> '') {
            $z = "INSERT  INTO sap_err VALUES('$filename','$err','Отсутствие структуры',$res)";
            exec_on_server($z, (int)$rem, $vid);  // Запись в таблицу ошибок
        }
        // отсутствие структуры }
        // нет объекта высшего уровня {
        $sql = "SELECT * from sap_refer where upload='$filename'";
        $data_u = data_from_server($sql, $res, $vid);
        $refer = $data_u[0]['refer'];
        $refer = 'Нет объекта высшего уровня в выгрузке ' . $refer;
        if (!empty($data_u[0]['upload'])) {
            $err = no_refer($fname, $data_u);
            if (count($err)) {
                foreach ($err as $v) {
//                    debug($v);
                    $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$refer',$res)";
                    exec_on_server($z, (int)$rem, $vid);
                }
            }
        }
        // нет объекта высшего уровня }

        // пустая ссылка {
        $msg = 'Пустая ссылка';
        $err = empty_refer($fname, $data_u);
        if (count($err)) {
            foreach ($err as $v) {
//                    debug($v);
                $z = "INSERT  INTO sap_err
                        VALUES('$filename','$v','$msg',$res)";
                exec_on_server($z, (int)$rem, $vid);
            }

        }
        // пустая ссылка }
        //kol struckt{
        $col = count_str($fname);
        //kol struckt}
        fclose($f);


        $sql_err = "select * from sap_err where upload = '$filename'";


        $sql_ab = data_from_server($sql_err, $res, $vid);

        if (empty($sql_ab)) {

            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Файл сформовано." . $col;
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        } else {
            return $this->render('partner', ['sql_ab' => $sql_ab, 'col' => $col]);
        }
    }

    //формирование файла идентификации
    // Формирование файла devloc для САП для Юр.лиц
    public function actionIdfile_devloc($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 13));
        $filename = get_routine1($method);

        $sql = "select 'DEVLOC' as OM,a.oldkey,b.code,b.short_name,const.ver from sap_egpld as a
                left join clm_client_tbl as b
                on substr(a.haus,9)::int=b.id
                join sap_const as const on 1=1";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных
//        debug($data);
//        return;

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '_ext.txt';
        $f = fopen($fname, 'w+');

        foreach ($data as $d1) {
            $d1 = array_slice($d1, 0, 4);
            $d1 = array_map('trim', $d1);
            $s1 = implode("\t", $d1);
            $s1 = str_replace("~", "", $s1);
            $s1 = mb_convert_encoding($s1, 'CP1251', mb_detect_encoding($s1));
            fputs($f, $s1);
            fputs($f, "\n");
        }

        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл $routine сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);

    }

    // Отключения Disc_Doc (юрид. лица)
    public function actionSap_discdoc($res,$par=0)
    {
        $helper=0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method=__FUNCTION__;
        if(substr($method,-4)=='_ind') {
            $vid = 1;
            $_suffix = '_R';
        }
        else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select *,id1||'_'||row_number() over(partition by id1) as id from
               (select a.*,const.ver,
              case when a.vkonto<>'' then b.id else a.anlage::int end as id1
              from docoff a
              left join sap_const as const on 1=1
              left join clm_client_tbl b on
              case when a.vkonto<>'' then a.vkonto::int else 0 end = b.code
              and coalesce(b.idk_work,0)<>0
              ) f
              where id1 is not null
             ";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i=0;
        foreach ($data as $w) {
            $di_doc[$i]=f_discdoc1($rem,$w);
            $di_inf[$i]=f_discdoc2($rem,$w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
//        deleterOM($fname,$rem);
        $f = fopen($fname,'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i=0;
        $j=0;
        foreach ($di_doc as $key=>$d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $v=$di_inf[$key];

//            foreach ($di_inf as $v) {
            $d1 = array_map('trim', $v);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0]."\t".'&ENDE');
            fputs($f, "\n");
//
//                 break;
//            }
            $i++;
        }
        fclose($f);

//        if($par==0)
//            if (file_exists($fname)) {
//                return \Yii::$app->response->sendFile($fname);
//            }
//            else
//                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

//         Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл DISCDOC сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";
        return $this->render('info', [
            'model' => $model]);
    }


    public function actionSap_discdoc_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select a.id,a.code,max(b.dt_action),const.ver from clm_paccnt_tbl a
                join clm_switching_tbl b on a.id=b.id_paccnt
                left join sap_const as const on 1=1
                where a.archive ='0' and (a.activ = 'f' or a.activ is null)
                group by a.id,a.code,const.ver";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;
        foreach ($data as $w) {
            $di_doc[$i] = f_discdoc1_ind($rem, $w);
            $di_inf[$i] = f_discdoc2_ind($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        $j = 0;
        foreach ($di_doc as $key => $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $v = $di_inf[$key];


//            foreach ($di_inf as $v) {
            $d1 = array_map('trim', $v);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");
//
//                 break;
//            }
            $i++;
        }
        fclose($f);

        if ($par == 0)
            if (file_exists($fname)) {
                return \Yii::$app->response->sendFile($fname);
            } else
                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//        return $this->render('info', [
//            'model' => $model]);
    }


    public function actionSap_discorder_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select a.id,a.code,max(b.dt_action) as dat,const.ver from clm_paccnt_tbl a
                join clm_switching_tbl b on a.id=b.id_paccnt
                left join sap_const as const on 1=1
                where a.archive ='0' and (a.activ = 'f' or a.activ is null)
                group by a.id,a.code,const.ver";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;
        foreach ($data as $w) {
            $di_ord[$i] = f_discorder_ind($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($di_ord as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");

            $i++;
        }
        fclose($f);
        if ($par == 0)
            if (file_exists($fname)) {
                return \Yii::$app->response->sendFile($fname);
            } else
                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//        return $this->render('info', [
//            'model' => $model]);
    }


    // Выгрузка отключения discenter (юридические потребители)
    public function actionSap_discenter($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "
                select *,id1||'_'||row_number() over(partition by id1) as id from
(select a.*,case when a.vkonto<>'' then b.id else a.anlage::int end as id1,
                substr(a.date,7,4)||substr(a.date,4,2)||substr(a.date,1,2) as date_sap,const.ver,
              length(disctype) as vid_l  
                from docoff a
                left join clm_client_tbl b on
                case when a.vkonto<>'' then a.vkonto::int else 0 end = b.code
                and coalesce(b.idk_work,0)<>0
             left join sap_const as const on 1=1
) f         
where id1 is not null    
                ";

        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

//        debug($data);
//        return;

        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;
        foreach ($data as $w) {
            $di_ord[$i] = f_discenter($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
//        deleterOM($fname,$rem);
        $f = fopen($fname, 'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($di_ord as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");

            $i++;
        }
        fclose($f);

        // Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл DISCENTER сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";
        return $this->render('info', [
            'model' => $model]);
    }

    public function actionSap_discorder($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select *,id1||'_'||row_number() over(partition by id1) as id from
(select a.*,case when a.vkonto<>" . "''" .
            " then b.id else a.anlage::int end as id1,const.ver,
           substr(a.date,7,4)||substr(a.date,4,2)||substr(a.date,1,2) as date_sap
           from docoff a
left join clm_client_tbl b on
case when a.vkonto<>" . "''" .  " then a.vkonto::int else 0 end = b.code
and coalesce(b.idk_work,0)<>0
left join sap_const as const on 1=1
) f 
where id1 is not null  
";

//        debug($sql);
//        return;
//
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;
        foreach ($data as $w) {
            $di_ord[$i] = f_discorder($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
//        deleterOM($fname,$rem);
        $f = fopen($fname, 'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($di_ord as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");

            $i++;
        }
        fclose($f);


//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

        // Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл DISCORDER сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";
        return $this->render('info', [
            'model' => $model]);
    }

//            public function actionSap_discenter_ind($res, $par = 0)

    public function actionSap_discenter_ind($res, $par = 0)
    {
        $helper = 0; // Включение режима помощника для создания текстового файла для помощи в создании функции заполнения
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0' . $res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        // и название суффикса в имени файла
        $method = __FUNCTION__;
        if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method, 10));
        $filename = get_routine($method); // Получаем название подпрограммы для названия файла

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select a.id,a.code,max(b.dt_action) as dat,const.ver from clm_paccnt_tbl a
                join clm_switching_tbl b on a.id=b.id_paccnt
                left join sap_const as const on 1=1
                where a.archive ='0' and (a.activ = 'f' or a.activ is null)
                group by a.id,a.code,const.ver";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i = 0;
        foreach ($data as $w) {
            $di_ent[$i] = f_discenter_ind($rem, $w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $ver = $data[0]['ver'];
        if ($ver < 10) $ver = '0' . $ver;
        $fname = $filename . '_04' . '_CK' . $rem . '_' . $fd . '_' . $ver . $_suffix . '.txt';
        deleterOM($fname, $rem);
        $f = fopen($fname, 'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i = 0;
        foreach ($di_ent as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0] . "\t" . '&ENDE');
            fputs($f, "\n");

            $i++;
        }
        fclose($f);

        if ($par == 0)
            if (file_exists($fname)) {
                return \Yii::$app->response->sendFile($fname);
            } else
                return 1;

//        if (file_exists($fname)) {
//            return \Yii::$app->response->sendFile($fname);
//        }

        // Выдаем предупреждение на экран об окончании формирования файла
//        $model = new info();
//        $model->title = 'УВАГА!';
//        $model->info1 = "Файл сформовано.";
//        $model->style1 = "d15";
//        $model->style2 = "info-text";
//        $model->style_title = "d9";
//        return $this->render('info', [
//            'model' => $model]);
    }


    // Импорт готовой таблицы street в базы РЭСов
    public function actionImp_street_in_bd()
    {
        $sql = "select * from street";
        //echo $sql;
        //$data = \Yii::$app->db_pg_im_db->createCommand($sql)->queryAll();
        $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();

        //debug($data);
        $sql = "CREATE TABLE public.street
            (
              name text,
              citycode character varying,
              name_town character varying,
              streettypecode integer,
              thedistrictcode text,
              modify_time text,
              citykoid character varying,
              resid text,
              xstreetcode text,
              code integer 
            )";
        Yii::$app->db_pg_krg_energo->createCommand($sql)->execute();

        foreach ($data as $in) {
            $code = $in['code'];
            $name = $in['name'];
            $name_town = $in['name_town'];
            $citycode = $in['citycode'];
            $thedistrictcode = $in['thedistrictcode'];
            $streettypecode = $in['streettypecode'];
            $modify_time = $in['modify_time'];
            $citykoid = $in['citykoid'];
            $resid = $in['resid'];
            $xstreetcode = $in['xstreetcode'];

            $sql = "INSERT INTO street (code,name,citycode,thedistrictcode,streettypecode,
                    modify_time,citykoid,resid,xstreetcode,name_town)
            VALUES(" .
                $code . ',' . '$$' . $name . '$$' . "," . "'" . $citycode . "'" . "," . "'" . $thedistrictcode . "'" . "," . $streettypecode . "," .
                "'" . $modify_time . "'" . "," . "'" . $citykoid . "'" . "," . "'" . $resid . "'" . "," . "'" . $xstreetcode . "'" . "," . "$$" . $name_town . "$$" . ')';
            Yii::$app->db_pg_krg_energo->createCommand($sql)->execute();

            //debug($town);
        }

        echo "Інформацію записано";
    }

    // Закачка данных в справочник адресов САП
    public function actionAddr_from_sap()
    {
        $file = "street_sap.csv";
        $f = fopen($file, 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("~", $s);
            $contry = $data[0];
            $numstreet = $data[1];
            $numtown = $data[2];
            $town = $data[3];
            $pr = $data[4];
            $note = $data[5];
            $numobl = $data[6];
            $rnobl = $data[7];
            $type_street = $data[8];
            $street = $data[9];
            $street2 = $data[10];
            $short_street = $data[11];
//            if (trim($note)!='Дніпропетровська' and trim($note)!='Вінницька') {
            $sql = "INSERT INTO addr_sap (contry,numstreet,numtown,town,reg,note,numobl,rnobl,type_street,
                    street,street2,short_street)
                    VALUES(" .
                '$$' . $contry . '$$' . ',' . '$$' . $numstreet . '$$' . "," . "'" . $numtown . "'" . "," . "$$" . $town . "$$" . "," . '$$' . $pr . '$$' . "," .
                "$$" . $note . "$$" . "," . "$$" . $numobl . "$$" . "," . "$$" . $rnobl . "$$" . "," . "'" . $type_street . "'" . "," . "$$" . $street . "$$" .
                "," . "$$" . $street2 . "$$" . "," . "$$" . $short_street . "$$" .
                ')';
            Yii::$app->db_pg_in_energo->createCommand($sql)->execute();
//            }

            //debug($town);
        }

        echo "Інформацію записано";
    }

    // ЗЗапись данных по единицам считывания САП
    public function actionEd_sch()
    {
        $file = "ed_sch_kr.csv";
        $f = fopen($file, 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("~", $s);
//            debug($data);
//            return;

            $lic_sch = $data[1];
            $abonent = $data[2];
            $n_sch = $data[11];
            $type_sch = $data[12];
            $code_tu = $data[20];
            $inspector = $data[49];
            $ed_sch = $data[51];

//            if (trim($note)!='Дніпропетровська' and trim($note)!='Вінницька') {
            $sql = "INSERT INTO ed_sch (lic_sch,abonent,n_sch,type_sch,code_tu,inspector,ed_sch)
                    VALUES(" .
                $lic_sch . ',' . '$$' . $abonent . '$$' . "," . "'" . $n_sch . "'" . "," . "$$" . $type_sch . "$$" . "," . '$$' . $code_tu . '$$' . "," .
                "$$" . $inspector . "$$" . "," . "$$" . $ed_sch . "$$" .
                ')';
            Yii::$app->db_pg_krg_energo->createCommand($sql)->execute();
//            }

            //debug($town);
        }

        echo "Інформацію записано";
    }


    // Запись данных по измер. трансформаторам
    public function actionGet_data_tv()
    {
        $file = "izm_dn.csv";
        $f = fopen($file, 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("~", $s);
            $id = $data[1];
            if (!isset($data[25])) continue;
            $type_tr = $data[25];
            $code_i = $data[27];
            $numbers_i = str_replace(';', ',', $data[28]);
            $code_u = $data[35];
            $type_tr_u = $data[33];
            $numbers_u = str_replace(';', ',', $data[37]);
            $lic = $data[2];
            $name = str_replace('"', '', $data[3]);
            $n_cnt = $data[12];
            $type_cnt = $data[13];
            $power = $data[22];
            if (empty($power)) $power = 0;
            $level_u = $data[24];
            $ktp = $data[6];
            $carry = $data[17];

//            debug($data);
//            return;

            $sql = "INSERT INTO spr_izm_tv (id,lic,name,ktp,carry,n_cnt,type_cnt,power,level_u,
                    type_tr,code_i,numbers_i,type_tr_u,code_u,numbers_u)
                    VALUES(" .
                $id . ',' . '$$' . $lic . '$$' . "," . "$$" . $name . "$$" . "," . "$$" . $ktp . "$$" . "," . $carry . "," .
                "$$" . $n_cnt . "$$" . "," . "$$" . $type_cnt . "$$" . "," . $power . "," . "'" . $level_u . "'" . "," . "$$" . $type_tr . "$$" .
                "," . "$$" . $code_i . "$$" . "," . "$$" . $numbers_i . "$$" . "," . "$$" . $type_tr_u . "$$" . "," .
                "$$" . $code_u . "$$" . "," . "$$" . $numbers_u . "$$" .
                ')';
            Yii::$app->db_pg_dn_energo->createCommand($sql)->execute();


            //debug($town);
        }

        echo "Інформацію записано";
    }

    // Запись справочников  измер. трансформаторов САП
    public function actionSpr_data_tv()
    {
        $file = "sap_tv_u.csv";
        $f = fopen($file, 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("~", $s);
            $id = $data[0];
            $nazv = $data[1];
            $gr = $data[2];

            if (empty($id)) $id = 0;
//            debug($data);
//            return;

            $sql = "INSERT INTO sap_tv_u (id,nazv,gr)
                    VALUES(" .
                $id . ',' . '$$' . $nazv . '$$' . "," . "$$" . $gr . "$$" .
                ')';
            Yii::$app->db_pg_in_energo->createCommand($sql)->execute();


            //debug($town);
        }

        echo "Інформацію записано";
    }


    // Форматирование csv файла
    public function actionPrepare_csv()
    {
        $file = "person.csv";
        $f = fopen($file, 'r');
        $ff = fopen('copy_' . $file, 'w+');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode(";", $s);
//            $s = str_replace('"','',$s);
//            $p = strpos($s, ';');
            $d1 = '';
            $d2 = '';
            $d3 = '';
            $d4 = '';
            $d5 = '';
            $d6 = '';
            $d7 = '';
            $d8 = '';
            $d9 = '';
            $d10 = '';
            $d11 = '';
            $d12 = '';
            $d13 = '';
            $d14 = '';
            $d15 = '';
            $d16 = '';
            $d17 = '';
            $d18 = '';
            $d19 = '';
            $d20 = '';
            $d21 = '';
            if ($i > 1) {
                if (isset($data[0]))
                    $d1 = trim(str_replace('"', '', $data[0]));
                if (isset($data[1]))
                    $d2 = trim(str_replace('"', '', $data[1]));
                if (isset($data[2]))
                    $d3 = trim(str_replace('"', '', $data[2]));
                if (isset($data[3]))
                    $d4 = trim(str_replace('"', '', $data[3]));
                if (isset($data[4]))
                    $d5 = trim(str_replace('"', '', $data[4]));
                if (isset($data[5]))
                    $d6 = trim(str_replace(' ', '', $data[5]));
                if (isset($data[6]))
                    $d7 = trim(str_replace('"', '', $data[6]));
                if (isset($data[7]))
                    $d8 = trim(str_replace('"', '', $data[7]));
                if (isset($data[8]))
                    $d9 = trim(str_replace('"', '', $data[8]));
                if (isset($data[9]))
                    $d10 = trim(str_replace('"', '', $data[9]));
                if (isset($data[10]))
                    $d11 = trim(str_replace('"', '', $data[10]));
                if (isset($data[11]))
                    $d12 = trim(str_replace('"', '', $data[11]));
                if (isset($data[12]))
                    $d13 = trim(str_replace('"', '', $data[12]));

                if (isset($data[13]))
                    $d14 = trim(str_replace('"', '', $data[13]));
                if (isset($data[14]))
                    $d15 = trim(str_replace('"', '', $data[14]));
                if (isset($data[15]))
                    $d16 = trim(str_replace('"', '', $data[15]));
                if (isset($data[16]))
                    $d17 = trim(str_replace('"', '', $data[16]));
                if (isset($data[17]))
                    $d18 = trim(str_replace('"', '', $data[17]));
                if (isset($data[18]))
                    $d19 = trim(str_replace('"', '', $data[18]));
                if (isset($data[19]))
                    $d20 = trim(str_replace('"', '', $data[19]));
                if (isset($data[20]))
                    $d21 = trim(str_replace('"', '', $data[20]));

                $s = $d1 . ';' . $d2 . ';' . $d3 . ';' . $d4 . ';' . $d5 . ';' .
                    $d6 . ';' . $d7 . ';' . $d8 . ';' . $d9 . ';' . $d10 . ';' .
                    $d11 . ';' . $d12 . ';' . $d13 . ';' . $d14 . ';' . $d15 . ';' .
                    $d16 . ';' . $d17 . ';' . $d18 . ';' . $d19 . ';' . $d20 . ';' . $d21 . ';' .
                    "\n";

            }
            echo $s . '<br>';
            fputs($ff, $s);
        }
        fclose($f);
        fclose($ff);
        echo "Файл " . $file . ' отформатирован.';
    }
    // --------------------------------------------------------------------------------------------------------

    // Импорт отчета по КиевСтар за ноябрь 2019 года для выявления штрафников
    public function actionImport_ks_0220()
    {
        /*
        $f = fopen('Rep01118.csv','r');
        $ff = fopen('Rep1118.csv','w+');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            fputs($ff,'+'.$s);

        }
        return;
        */

        $sql = "CREATE TABLE tmp_ks0220 (
              tel varchar(10) NOT NULL,
              cost_plan varchar(20) DEFAULT NULL,
              cost_all varchar(10) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('Rep0220.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
//            if($i==1) continue;
            $data = explode(";", $s);

            if (empty($data[0])) break;
            $data[0] = str_replace('"', '', $data[0]);
            $data[0] = str_replace('+380', '', $data[0]);
            $data[3] = str_replace('"', '', $data[3]);
            $data[9] = str_replace('"', '', $data[9]);
            $e = 1;

            $sql = "INSERT INTO tmp_ks0220 (tel,cost_plan,cost_all) VALUES(" .
                "'" . $data[0] . "'" . "," . "'" . $data[3] . "'" . "," . "'" . $data[9] . "'" . ')';

            Yii::$app->db_phone->createCommand($sql)->execute();
        }

        fclose($f);
    }

    // Импорт выгрузки из call-центра
    public function actionImport_call_c()
    {
        $sql = "CREATE TABLE acall_c (
              value_ind dec(14,4) ,
              dat_ind date ,
              id_zone integer,
              lic char(9) 
            ) ";
        Yii::$app->db_pg_zv_abn->createCommand($sql)->execute();

        // Добавляем записи в таблицу acall_c с csv файла

        $f = fopen('call_c.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(";", $s);

            $res = $data[9];
            $lic = substr($data[6], -9);
            $dat_ind = $data[2];
            $ind1 = $data[3];
            $ind2 = $data[4];
            $ind3 = $data[5];
            $zone = -1;
            if ($ind2 > 0 && $ind1 > 0) $zone = 1;
            if ($ind2 == 0 && $ind3 == 0 && $ind1 > 0) $zone = 0;
            if ($ind2 > 0 && $ind3 > 0 && $ind1 > 0) $zone = 2;

            if (trim($res) == 'ЖОВТІ ВОДИ') {
                if ($zone == 0) {
                    $sql = "INSERT INTO acall_c (lic,dat_ind,value_ind,id_zone) VALUES(" .
                        "'" . $lic . "'" . "," . "'" . $dat_ind . "'" . "," . $ind1 . "," . "0" . ')';

                    Yii::$app->db_pg_zv_abn->createCommand($sql)->execute();
                }


                if ($zone == 1) {
                    $sql = "INSERT INTO acall_c (lic,dat_ind,value_ind,id_zone) VALUES(" .
                        "'" . $lic . "'" . "," . "'" . $dat_ind . "'" . "," . $ind1 . "," . "10" . ')';

                    Yii::$app->db_pg_zv_abn->createCommand($sql)->execute();


                    $sql = "INSERT INTO acall_c (lic,dat_ind,value_ind,id_zone) VALUES(" .
                        "'" . $lic . "'" . "," . "'" . $dat_ind . "'" . "," . $ind2 . "," . "9" . ')';

                    Yii::$app->db_pg_zv_abn->createCommand($sql)->execute();
                }
                if ($zone == 2) {
                    $sql = "INSERT INTO acall_c (lic,dat_ind,value_ind,id_zone) VALUES(" .
                        "'" . $lic . "'" . "," . "'" . $dat_ind . "'" . "," . $ind1 . "," . "8" . ')';

                    Yii::$app->db_pg_zv_abn->createCommand($sql)->execute();


                    $sql = "INSERT INTO acall_c (lic,dat_ind,value_ind,id_zone) VALUES(" .
                        "'" . $lic . "'" . "," . "'" . $dat_ind . "'" . "," . $ind2 . "," . "7" . ')';

                    Yii::$app->db_pg_zv_abn->createCommand($sql)->execute();

                    $sql = "INSERT INTO acall_c (lic,dat_ind,value_ind,id_zone) VALUES(" .
                        "'" . $lic . "'" . "," . "'" . $dat_ind . "'" . "," . $ind2 . "," . "6" . ')';

                    Yii::$app->db_pg_zv_abn->createCommand($sql)->execute();
                }
            }
        }

        fclose($f);

    }


    // Импорт имен в тел. справочник
    public function actionImport_names()
    {

        $f = fopen('m_name.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            //if($i==1) continue;
            $data = explode(";", $s);

            if (empty($data[0])) break;

            $sql = "INSERT INTO man_name (name) VALUES(" .
                "'" . $data[0] . "'" . ')';

            Yii::$app->db_phone->createCommand($sql)->execute();
        }

        fclose($f);
    }

    // Импорт дневника в Info
    public function actionImport_diary()
    {

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('diary.txt', 'r');
        $i = 0;
        $flag = -1;
        $data = '';
        $cf = 0;
        while (!feof($f)) {
            $s = fgets($f);
            if (trim($s) == '') continue;
            $y = mb_strlen($s, 'UTF-8');
            $i++;
            $k = 10;

            if (mb_substr($s, 2, 1, 'UTF-8') == '.') {
                $flag = 0;
                $cf = $flag;
                $date = mb_substr($s, 0, $k, 'UTF-8');
                $data = '';
            } else {
                $flag = 1;
                $cf = $flag;
            }
            // echo $flag;
            if ($flag >= 1 && $i > 1) {
                $c = mb_substr(trim($s), 0, 1, 'UTF-8');
                if (mb_substr($s, 1, 1, 'UTF-8') == '.' && ctype_digit($c)) {
                    $flag = 3;
                    $data = '';
                } else {
                    $flag = 2;
                }
                if ($flag == 3 && $cf == 3) $flag = 4;
                if ($flag == 3 || $flag == 4)
                    $data = mb_substr($s, 2, $y - 2, 'UTF-8');
                else {
                    $data = $data . ' ' . trim($s);
                }
                $date = date("Y-m-d", strtotime($date));

                if ($flag == 2 || $flag == 4) {
                    $cf = $flag;
                    $sql = "INSERT INTO diary (date,txt) VALUES(" .
                        "'" . $date . "'" . "," . "'" . $data . "'" . ')';
                    Yii::$app->db_info->createCommand($sql)->execute();
                }
                echo $i;
                echo '<br>';
            }
        }
        echo "Импорт завершен";
        fclose($f);
    }

    // Импорт списка новых работников во врем. таблицу
    public function actionImport_new()
    {

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('new_list1.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(";", $s);
            $data[1] = str_replace("'", '`', $data[1]);
            $date = date("Y-m-d", strtotime($data[2]));

            if (empty($data[0])) break;


            $sql = "INSERT INTO newlist (fio,date,spec,p1,p2,p3) VALUES(" .
                "'" . $data[1] . "'" . "," . "'" . $date . "'" . "," . "'" . $data[3] . "'" . "," .
                "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . ')';

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
        $f = fopen('list_works.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(",", $s);
            if (empty($data[0])) break;
            $data[3] = str_replace('"', ' ', $data[3]);
            $e = 1;
            while ($e == 1) {
                $pos = strpos($data[1], "'");
                if (!$pos) {
                    $sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(" .
                        "'" . $data[1] . "'" . "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" .
                        "," . 'null' . "," . 'null' . ')';

                } else {
                    $sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(" .
                        '"' . $data[1] . '"' . "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" .
                        "," . 'null' . "," . 'null' . ')';
                    break;
                }

                $pos = strpos($data[5], "'");
                if (!$pos)
                    $sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(" .
                        "'" . $data[1] . "'" . "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" .
                        "," . 'null' . "," . 'null' . ')';
                else
                    $sql = "INSERT INTO tmp_works (fio,unit,in_unit,post,id_podr,id_name) VALUES(" .
                        "'" . $data[1] . "'" . "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'" . "," . '"' . $data[5] . '"' .
                        "," . 'null' . "," . 'null' . ')';
                $e = 0;
            }

            Yii::$app->db_phone->createCommand($sql)->execute();
        }

        fclose($f);
        // Делаем обновление полей id_podr и id_name проверяем совпадение строк по fio
        $sql = 'UPDATE tmp_works a,1c b SET a.id_podr=b.id_podr,a.id_name=b.id_name
                WHERE a.fio = b.Працівник ';
        Yii::$app->db_phone->createCommand($sql)->execute();
        $data = tmp_works::find()->where('id_name is not null')->orderby('id_name')->all();
        $i = 0;
        // Делаем чтобы все номера работников шли по порядку
        foreach ($data as $d) {
            $i++;
//            $d->id_sort = $i;
            $d->id_name = $i;
            $d->save();
        }

        $max = $i;  // Сдесь макс. последний номер работника
        $data = tmp_works::find()->where('id_name is null')->all();
        // Делаем чтобы все номера работников шли по порядку - тем которые null присваивается максимальный номер + 1
        foreach ($data as $d) {
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

    public function actionStrtest()
    {
        $data8 = 'Павлоградські РЕМ';
        $rrem = mb_substr($data8, mb_strlen($data8, 'UTF-8') - 3, 3, 'UTF-8');
        echo $rrem;
    }

// Генерация 32-битного случайного числа
    public function actionGen32()
    {
        echo gen16(32);
    }

    // Создание поля CHARG (SAP)
    public function actionCharg()
    {
        $all_tmc = all_tmc::findbysql('Select a.*,b.kol_gr from a_c_sklad_exp3 a 
        join q_gr1 b on a.zmaktx=b.zmaktx and a.charg1=b.charg order by a.zmaktx,a.charg1')->asArray()
            ->all();
        $y = count($all_tmc);
        $a = '';
        $b = '';
        $j = 1;
        for ($i = 1; $i <= $y; $i++) {
            $id = $all_tmc[$i]['ID'];
            if ($all_tmc[$i]['kol_gr'] == 1) {
                $a = '';
                $b = '';
                $charg = $all_tmc[$i]['charg'] . '000' . '1';
                $j = 1;
            } else {
                if ($all_tmc[$i]['zmaktx'] == $a && $all_tmc[$i]['charg1'] == $b) {
                    $j++;
                } else {
                    $j = 1;
                }
                $a = $all_tmc[$i]['zmaktx'];
                $b = $all_tmc[$i]['charg1'];

            }
            $z = "update a_c_sklad_exp3 set kol_gr=$j where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        // debug($all_tmc);
        echo "OK";
    }

    // Создание отв. лиц (SAP)
    public function actionLgort()
    {
        $otv = all_tmc::findbysql('Select a.lgort,a.ID from a_all_tmc a')->asArray()
            ->all();
        $y = count($otv);

        for ($i = 1; $i <= $y; $i++) {
            $id = $otv[$i]['ID'];
            $h = $otv[$i]['lgort'];
            switch ($h) {
                case 'ВгРЕМ АЗ-2':
                    $j = 'Горовой';
                    break;
                case 'ВЕБС АЗ-2':
                    $j = 'Пирлик';
                    break;
                case 'ДнРЭС АЗ-2':
                    $j = 'Олійник';
                    break;
                case 'ЖвРЭС АЗ-1':
                    $j = 'Буртовий';
                    break;
                case 'ЗпРЭС АЗ-2':
                    $j = 'Кондрашин';
                    break;
                case 'КрРЭС АЗ-1':
                    $j = 'Даценко';
                    break;
                case 'ПвРЭС АЗ-1':
                    $j = 'Качала';
                    break;
                case 'Центральный склад АЗ-1':
                    $j = 'Мамай';
                    break;
                default:
                    $w = mb_strlen($h, 'UTF-8');
                    $pos = strpos($h, ' ');

                    if (!$pos === false) {
                        $h = substr($h, 0, $pos);
                    }

                    $j = $h;
            }
            $z = "update a_all_tmc set lgort1='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        // debug($all_tmc);
        echo "OK";
    }

    // Преобразование таблицы инструмента
    public function actionDo_mshp()
    {
        $msp = all_tmc::findbysql('Select * from mshp')->asArray()
            ->all();
        $y = count($msp);
        $otv = '';
        for ($i = 1; $i <= $y; $i++) {
            $id = $msp[$i]['ID'];
            $h = $msp[$i]['tmc'];
            if (strpos($h, '"')) ;
            else {
                $fio = all_tmc::findbysql("Select * from kyivstar where fio=" . '"' . $h . '"')->asArray()
                    ->all();

                $yy = count($fio);
                if ($yy > 0) $otv = $h;
                else {
                    $fio = all_tmc::findbysql("Select * from 1c where fio=" . '"' . $h . '"')->asArray()
                        ->all();

                    $yy = count($fio);
                    if ($yy > 0) $otv = $h;

                }
            }
            $z = "update mshp set otv='$otv' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        // debug($all_tmc);
        echo "OK";
    }

    // Создание поля CHARG эксплуатация (SAP)
    public function actionCharg_e()
    {
        $all_tmc = all_tmc::findbysql('Select a.*,b.kol_gr from all_tmce a 
        join q_gr2 b on a.maktx_c=b.maktx_c and a.charg=b.charg order by a.maktx_c,a.charg')->asArray()
            ->all();
        $y = count($all_tmc);
        $a = '';
        $b = '';
        $j = 1;
        for ($i = 1; $i <= $y; $i++) {
            $id = $all_tmc[$i]['ID'];
            if ($all_tmc[$i]['kol_gr'] == 1) {
                $a = '';
                $b = '';
                $charg = $all_tmc[$i]['CHARG'] . '000' . '1';
                $j = 1;
            } else {
                if ($all_tmc[$i]['maktx_c'] == $a && $all_tmc[$i]['CHARG'] == $b) {
                    $j++;
                } else {
                    $j = 1;
                }
                $a = $all_tmc[$i]['maktx_c'];
                $b = $all_tmc[$i]['CHARG'];

            }
            $z = "update all_tmce set kol_gr=$j where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        // debug($all_tmc);
        echo "OK";
    }

    // Установка разрядности денег (SAP)
    public function actionRmoney()
    {
        $tmc = all_tmc::findbysql('Select a.* from a_c_sklad_exp3 a ')->asArray()
            ->all();
        $y = count($tmc);
        $a = '';
        $b = '';
        $j = 1;
//        debug($tmc);
//        return;
        for ($i = 0; $i < $y; $i++) {
            $id = $tmc[$i]['ID'];
            $e = $tmc[$i]['EXBWR'];
            $pos = strpos($e, ',');
            $y1 = strlen($e);
            $r = 0;
            if (!$pos === false) {
                $r = $y1 - $pos - 1;
                if ($r == 1)
                    $j = $e . str_repeat("0", $r);
                else
                    $j = $e;
            } else
                $j = $e . ',00';


            $z = "update a_c_sklad_exp3 set exbwr1='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }
        return;
    }

    // Установка даты для инструмента
    public function actionSet_date()
    {
        $tmc = all_tmc::findbysql('Select a.* from a_res_skl_mshp a ')->asArray()
            ->all();
        $y = count($tmc);
        $j = 0;
        $i = 10;
//        debug($tmc);
//        return;
        while (1 == 1) {
            $id = $tmc[$j]['ID'];
            $d = date('d.m.Y', strtotime("-$i days"));
            if ($j < $y && $i == 679) $i = 10;
            if ($j >= $y) break;

            $z = "update a_res_skl_mshp set ch_gr_date='$d' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
            $j++;
            $i++;
        }
        return;
    }

    // Закачка справочника материалов
    public function actionSpr_mat()
    {
        // Добавляем записи в таблицу other_tel с csv файла
        $f = fopen('spr_mat.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            $pos = strpos($data[2], '"');
            $data[2] = str_replace("'", '$', $data[2]);
            $data[3] = str_replace("'", '$', $data[3]);

            $data[2] = str_replace('"', '|', $data[2]);
            $data[3] = str_replace('"', '|', $data[3]);

            $data[2] = str_replace('\\', '@', $data[2]);
            $data[3] = str_replace('\\', '@', $data[3]);


//            if (!$pos === false)

            $sql = "INSERT INTO mater_prod1 (kod_sap,mater_s,mater_l,ed_izm,type_mat,descr_type,grup_mat,desc_gr)
                VALUES(" .
                "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'"
                . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" . "," . "'" . $data[8] . "'" . ')';
//            else
//                 $sql = "INSERT INTO mater_prod1 (kod_sap,mater_s,mater_l,ed_izm,type_mat,descr_type,grup_mat,desc_gr)
//                 VALUES(" .
//                    "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" .$data[3]."'"."," . "'".$data[4] . "'"
//                    ."," . "'".$data[5] . "'" . "," . "'".$data[6] . "'"."," . "'".$data[7] . "'".","  . "'".$data[8] . "'".')';

//            $pos1 = strpos($data[3],"'");
//
//            if (!$pos1 === false)
//
//                $sql = "INSERT INTO mater_prod1 (kod_sap,mater_s,mater_l,ed_izm,type_mat,descr_type,grup_mat,desc_gr)
//                VALUES(" .
//                    "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . '"' .$data[3].'"'."," . "'".$data[4] . "'"
//                    ."," . "'".$data[5] . "'" . "," . "'".$data[6] . "'"."," . "'".$data[7] . "'".","  . "'".$data[8] . "'".')';
//            else
//                $sql = "INSERT INTO mater_prod1 (kod_sap,mater_s,mater_l,ed_izm,type_mat,descr_type,grup_mat,desc_gr)
//                 VALUES(" .
//                    "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" .$data[3]."'"."," . "'".$data[4] . "'"
//                    ."," . "'".$data[5] . "'" . "," . "'".$data[6] . "'"."," . "'".$data[7] . "'".","  . "'".$data[8] . "'".')';

            Yii::$app->db_sap->createCommand($sql)->execute();

//            $sql = 'update mater_prod1
//            set mater_l=REPLACE(mater_l, "@", "\\"),mater_s=REPLACE(mater_s, "@", "\\")';
//
//            Yii::$app->db_sap->createCommand($sql)->execute();
//
//            $sql = "update mater_prod1
//            set mater_l=REPLACE(mater_l, '$', '\''),mater_s=REPLACE(mater_s, '$', '\'')";

//            Yii::$app->db_sap->createCommand($sql)->execute();

        }

        fclose($f);
        return;
    }

    // Закачка таблицы соответствия для служб
    public function actionWosootv()
    {

        $f = fopen('a_wosootv.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            if (!isset($data[2])) break;
//            $pos = strpos($data[2], "'");
//            $data[2] = str_replace("'", '$', $data[2]);
//
//            $data[2] = str_replace('"', '~', $data[2]);
//
            $data[5] = str_replace("'", '$', $data[5]);
            $data[6] = str_replace("'", '$', $data[6]);
//
//            $data[2] = str_replace('\\', '@', $data[2]);
//
//            $data[5] = str_replace('\\', '@', $data[5]);
//            $data[6] = str_replace('\\', '@', $data[6]);

            $sql = "INSERT INTO a_wo_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . "'" . $data[3] . "'"
                . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" .
                ',' . "'" . $data[8] . "'" . ')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);
    }

    // Закачка таблицы реквизитов поставщиков
    public function actionRekv_post()
    {
        $f = fopen('rekv_post.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("~", $s);

            $sql = "INSERT INTO rekv_post(id,partner_id,acc_id,post)
                    VALUES(" .
                $data[0] . ',' . $data[1] . ',' . "'" . $data[2] . "'" . ',' . "'" . $data[5] . "'"
                . ')';

            Yii::$app->db_pg_dn_energo->createCommand($sql)->execute();
        }
        fclose($f);
    }

    // Преобразование файла DEVICE
    public function actionCnv_dev()
    {
        $f = fopen('DEVICE_04_CK08_20200814_08_L.txt', 'r');
        $ff = fopen('DEVICE_04_CK08_20200814_08_L1.txt', 'w+');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("\t", $s);

            if ($data[1] == 'EQUI') {
                if (strpos($data[11], "s)"))
                    $data[11] = mb_strtoupper($data[11], 'CP-1251');
            }
            $ss = implode("\t", $data);
            fputs($ff, $ss);
        }


        fclose($f);
        fclose($ff);
    }
    // Закачка таблицы соответствия для служб

    // Закачка таблицы соответствия для служб

    public function actionSootv()
    {
        $sql = "delete from a_s1_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s1_sklad.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            if (!isset($data[2])) break;
            $pos = strpos($data[2], "'");
            $data[2] = str_replace("'", '$', $data[2]);

            $data[2] = str_replace('"', '~', $data[2]);

            $data[5] = str_replace("'", '$', $data[5]);
            $data[6] = str_replace("'", '$', $data[6]);

            $data[2] = str_replace('\\', '@', $data[2]);

            $data[5] = str_replace('\\', '@', $data[5]);
            $data[6] = str_replace('\\', '@', $data[6]);

            $sql = "INSERT INTO a_s1_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . "'" . $data[3] . "'"
                . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" .
                ',' . "'" . $data[8] . "'" . ',' . "'" . $data[9] . "'" . ',' . "'" . $data[10] . "'" . ')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s2_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s2_sklad.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            if (!isset($data[2])) break;
            $pos = strpos($data[2], "'");
            $data[2] = str_replace("'", '$', $data[2]);

            $data[2] = str_replace('"', '~', $data[2]);

            $data[5] = str_replace("'", '$', $data[5]);
            $data[6] = str_replace("'", '$', $data[6]);

            $data[2] = str_replace('\\', '@', $data[2]);

            $data[5] = str_replace('\\', '@', $data[5]);
            $data[6] = str_replace('\\', '@', $data[6]);

            $sql = "INSERT INTO a_s2_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . "'" . $data[3] . "'"
                . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" .
                ',' . "'" . $data[8] . "'" . ',' . "'" . $data[9] . "'" . ',' . "'" . $data[10] . "'" . ')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s3_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s3_sklad.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            if (!isset($data[2])) break;
            $pos = strpos($data[2], "'");
            $data[2] = str_replace("'", '$', $data[2]);

            $data[2] = str_replace('"', '~', $data[2]);

            $data[5] = str_replace("'", '$', $data[5]);
            $data[6] = str_replace("'", '$', $data[6]);

            $data[2] = str_replace('\\', '@', $data[2]);

            $data[5] = str_replace('\\', '@', $data[5]);
            $data[6] = str_replace('\\', '@', $data[6]);

            $sql = "INSERT INTO a_s3_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . "'" . $data[3] . "'"
                . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" .
                ',' . "'" . $data[8] . "'" . ',' . "'" . $data[9] . "'" . ',' . "'" . $data[10] . "'" . ')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s4_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s4_sklad.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            if (!isset($data[2])) break;
            $pos = strpos($data[2], "'");
            $data[2] = str_replace("'", '$', $data[2]);

            $data[2] = str_replace('"', '~', $data[2]);

            $data[5] = str_replace("'", '$', $data[5]);
            $data[6] = str_replace("'", '$', $data[6]);

            $data[2] = str_replace('\\', '@', $data[2]);

            $data[5] = str_replace('\\', '@', $data[5]);
            $data[6] = str_replace('\\', '@', $data[6]);

            $sql = "INSERT INTO a_s4_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . "'" . $data[3] . "'"
                . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" .
                ',' . "'" . $data[8] . "'" . ',' . "'" . $data[9] . "'" . ',' . "'" . $data[10] . "'" . ')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s5_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s5_sklad.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            if (!isset($data[2])) break;
            $pos = strpos($data[2], "'");
            $data[2] = str_replace("'", '$', $data[2]);

            $data[2] = str_replace('"', '~', $data[2]);

            $data[5] = str_replace("'", '$', $data[5]);
            $data[6] = str_replace("'", '$', $data[6]);

            $data[2] = str_replace('\\', '@', $data[2]);

            $data[5] = str_replace('\\', '@', $data[5]);
            $data[6] = str_replace('\\', '@', $data[6]);

            $sql = "INSERT INTO a_s5_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . "'" . $data[3] . "'"
                . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" .
                ',' . "'" . $data[8] . "'" . ',' . "'" . $data[9] . "'" . ',' . "'" . $data[10] . "'" . ')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s6_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s6_sklad.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$", $s);
            if (!isset($data[2])) break;
            $pos = strpos($data[2], "'");
            $data[2] = str_replace("'", '$', $data[2]);

            $data[2] = str_replace('"', '~', $data[2]);

            $data[5] = str_replace("'", '$', $data[5]);
            $data[6] = str_replace("'", '$', $data[6]);

            $data[2] = str_replace('\\', '@', $data[2]);

            $data[5] = str_replace('\\', '@', $data[5]);
            $data[6] = str_replace('\\', '@', $data[6]);

            $sql = "INSERT INTO a_s6_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . "'" . $data[3] . "'"
                . "," . "'" . $data[4] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[7] . "'" .
                ',' . "'" . $data[8] . "'" . ',' . "'" . $data[9] . "'" . ',' . "'" . $data[10] . "'" . ')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        echo "Все строки записаны!";
        return;

        // Дальше выполняем на сервере для каждой таблицы
        //update a_s4_sklad
        //set mater_l=REPLACE(mater_l, '@', "\\"),mater_s=REPLACE(mater_s, '@', "\\")
        //
        //update a_s4_sklad
        //set t_cek=REPLACE(t_cek, '@', "\\")
        //
        //update a_s4_sklad
        //set t_cek=REPLACE(t_cek, '$', "'")
        //
        //update a_s4_sklad
        //set t_cek=REPLACE(t_cek, '~', '"')
        //
        //update a_s4_sklad
        //set mater_l=REPLACE(mater_l, '$', "'"),mater_s=REPLACE(mater_s,'$', "'")

    }

    // Экспорт данных по складу в САП (сборка разных программ)
    public function actionSklad2sap()
    {
        $z = 'drop table if exists q_gr1';
        Yii::$app->db_sap->createCommand($z)->execute();

        $z = "create table q_gr1 as
        SELECT maktx,concat(substr(ch_gr_date,9),substr(ch_gr_date,4,2),substr(ch_gr_date,1,2)) as charg,count(*) as kol_gr 
        FROM a_all_tmc1 where maktx<>'' group by 1,2";
        Yii::$app->db_sap->createCommand($z)->execute();

        // Создание поля charg в правильном формате
        $all_tmc = all_tmc::findbysql('Select a.*,b.kol_gr from a_all_tmc1 a 
        join q_gr1 b on a.maktx=b.maktx and a.charg1=b.charg order by a.maktx,a.charg1')->asArray()
            ->all();
        $y = count($all_tmc);
        $a = '';
        $b = '';
        $j = 1;
        for ($i = 1; $i < $y; $i++) {
            $id = $all_tmc[$i]['ID'];
            if ($all_tmc[$i]['kol_gr'] == 1) {
                $a = '';
                $b = '';
                $charg = $all_tmc[$i]['charg'] . '000' . '1';
                $j = 1;
            } else {
                if ($all_tmc[$i]['maktx'] == $a && $all_tmc[$i]['charg1'] == $b) {
                    $j++;
                } else {
                    $j = 1;
                }
                $a = $all_tmc[$i]['maktx'];
                $b = $all_tmc[$i]['charg1'];

            }
            $z = "update a_all_tmc1 set kol_gr=$j where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        $z = "update a_all_tmc1
        set cgr=concat('000',kol_gr)";
        Yii::$app->db_sap->createCommand($z)->execute();

        $z = "update a_all_tmc1
        set cgr=right(cgr,4)";
        Yii::$app->db_sap->createCommand($z)->execute();

        $z = "update a_all_tmc1
        set charg=concat(charg,cgr)
        WHERE maktx is not null";

        Yii::$app->db_sap->createCommand($z)->execute();

        // Корректируем время
        $z = "update a_all_tmc1
        set time_c=cast(time_c as time)+INTERVAL cast(cgr as unsigned)SECOND 
        where cast(cgr as unsigned)>1";

        Yii::$app->db_sap->createCommand($z)->execute();

        // Установка разрядности единиц измерений
        $tmc = all_tmc::findbysql('Select a.*,b.razr from a_all_tmc1 a 
        join edizm b on a.meins=b.nazv order by a.ID')->asArray()
            ->all();
        $y = count($tmc);
        $a = '';
        $b = '';
        $j = 1;

        for ($i = 0; $i < $y; $i++) {
            $j = '';
            $id = $tmc[$i]['ID'];
            $razr = $tmc[$i]['razr'];
            $k = trim($tmc[$i]['erfmg']);
            $p = strpos($k, ',');
            if (is_null($p) || empty($p) || $p == false) $p = -1;
            if ($p > 0) {
                $kol = strlen($k) - $p - 1;
                if ($razr > 0) {
                    if ($kol > $razr) {
                        $e = substr($k, $p + 1, $razr);
                        $j = substr($k, 0, $p) . ',' . $e;
                    }
                    if ($kol < $razr) {
                        $e = $razr - $kol;
                        $j = $k . str_repeat("0", $e);
                    }
                    if ($kol == $razr) $j = $k;
                } else {
                    $j = intval($k);
                }
            } else {
                if ($razr > 0) {
                    $j = $k . ',' . str_repeat("0", $razr);
                }
            }


            $z = "update a_all_tmc1 set ZKZ='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        // Установка разрядности денег (SAP)
        $tmc = all_tmc::findbysql('Select a.* from a_all_tmc1 a ')->asArray()
            ->all();
        $y = count($tmc);
        $a = '';
        $b = '';
        $j = 1;

        for ($i = 0; $i < $y; $i++) {
            $id = $tmc[$i]['ID'];
            $e = $tmc[$i]['exbwr'];
            $pos = strpos($e, ',');
            $y1 = strlen($e);
            $r = 0;
            if (!$pos === false) {
                $r = $y1 - $pos - 1;
                if ($r == 1)
                    $j = $e . str_repeat("0", $r);
                else
                    $j = $e;
            } else
                $j = $e . ',00';


            $z = "update a_all_tmc1 set exbwr1='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }


        echo "OK";
    }


    // Установка разрядности единиц измерений (SAP)
    public function actionEdizm()
    {
        $tmc = all_tmc::findbysql('Select a.*,b.razr from a_c_skladzz a 
        join edizm b on a.meins=b.nazv order by a.ID')->asArray()
            ->all();
        $y = count($tmc);
        $a = '';
        $b = '';
        $j = 1;

        for ($i = 0; $i < $y; $i++) {
            $j = '';
//            if ($i>400) break;
            $id = $tmc[$i]['ID'];
            $razr = $tmc[$i]['razr'];
            $k = trim($tmc[$i]['ERFMG']);
            $p = strpos($k, ',');
            if (is_null($p) || empty($p) || $p == false) $p = -1;
            if ($p > 0) {
                $kol = strlen($k) - $p - 1;
                if ($razr > 0) {
                    if ($kol > $razr) {
                        $e = substr($k, $p + 1, $razr);
                        $j = substr($k, 0, $p) . ',' . $e;
                    }
                    if ($kol < $razr) {
                        $e = $razr - $kol;
                        $j = $k . str_repeat("0", $e);
                    }
                    if ($kol == $razr) $j = $k;
                } else {
                    $j = intval($k);
                }
            } else {
                if ($razr > 0) {
                    $j = $k . ',' . str_repeat("0", $razr);
                }
            }


            $z = "update a_c_skladzz set ZKZ='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        echo "OK";
    }

    // Установка id_lgort (инструмент) (SAP)
    public function actionId_lgort()
    {
        $fio = all_tmc::findbysql('Select a.fio from sklad_i a')->asArray()->all();
        $tmc = all_tmc::findbysql('Select a.* from tovar_i a')->asArray()->all();
        $y = count($tmc);
        $i = 0;
        foreach ($fio as $v) {
            $mas[$i] = $v['fio'];
            $i++;
        }

        if (in_array('Сивоконь Владислав Станіславович', $mas))
            echo 'Yes';
        else
            echo 'No';

        for ($i = 0; $i < $y; $i++) {
            $tf = $tmc[$i]['nazv'];

            $id_r = $tmc[$i]['ID'];
            if (in_array($tf, $mas)) {
                $id_f = $id_r;

            }
            $z = "update tovar_i set id_lgort=$id_f where ID=$id_r";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        echo "OK";
    }

    // Установка товара САП (SAP)
    public function actionSet_t_sap()
    {
        $tmc = all_tmc::findbysql('Select a.* from table_20 a where t_sap is null')->asArray()->all();
        $ost = all_tmc::findbysql('Select a.* from ost_104 a')->asArray()->all();
        $y = count($tmc);

        $pos = strpos('Разрядник РВС 35кВ РВТ-32 Ф"А" б/у,$t_cek', 'Разрядник РВС 35кВ');
        echo $pos;

        if ($pos === false) {
            echo 'НЕ Найдено';
        } else {
            echo 'Найдено';
        }

        for ($i = 0; $i < $y; $i++) {
            $t = $tmc[$i]['t_cek'];

            $id = $tmc[$i]['code'];
            $j = 0;
            foreach ($ost as $v) {
                $t_cek = $v['t_cek'];
                $t_sap = $v['t_sap'];
                $pos = strpos($t, $t_cek);

                if ($pos === false) ;
                else {
                    $z = "update table_20 set t_sap=concat('ZZZ '," . '"' . $t_sap . '"' . ") where code='$id'";
                    Yii::$app->db_sap->createCommand($z)->execute();
                    break;
                }
                $j++;
            }

        }

//        echo "OK";
    }

    // Установка товара САП (SAP) эксплуатация
    public function actionSet_t_sap_e()
    {
        $tmc = all_tmc::findbysql('Select a.* from a_sootv_exp a where t_sap<>""')->asArray()->all();
        $ost = all_tmc::findbysql('Select a.* from ost_104 a')->asArray()->all();
        $y = count($tmc);

        $pos = strpos('Разрядник РВС 35кВ РВТ-32 Ф"А" б/у,$t_cek', 'Разрядник РВС 35кВ');
        echo $pos;

        if ($pos === false) {
            echo 'НЕ Найдено';
        } else {
            echo 'Найдено';
        }

        for ($i = 0; $i < $y; $i++) {
            $t = $tmc[$i]['t_cek'];

            $id = $tmc[$i]['id'];
            $j = 0;
            foreach ($ost as $v) {
                $t_cek = $v['t_cek'];
                $t_sap = $v['t_sap'];
                $flag = 0;
                if (strpos('"', $t_sap) > 0) $flag = 1;
                $pos = strpos($t, $t_cek);

                if ($pos === false) ;
                else {
                    if ($flag == 0)
                        $z = "update a_sootv_exp set t_sap=concat('ZZZ '," . '"' . $t_sap . '"' . ") where id='$id'";
                    else
                        $z = "update a_sootv_exp set t_sap=concat('ZZZ '," . "'" . $t_sap . "'" . ") where id='$id'";

                    Yii::$app->db_sap->createCommand($z)->execute();
                    break;
                }
                $j++;
            }


        }

//        echo "OK";
    }

// Создание ключа САП
    public function actionCrt_key()
    {
        $e = 'Разрядник РВС 35кВ РВТ-32 Ф"А" б/у (dserf)';

        $tmc = all_tmc::findbysql('Select a.* from a_sootv_exp1 a')->asArray()->all();
        $y = count($tmc);

        for ($i = 0; $i < $y; $i++) {
            $t = $tmc[$i]['t_cek'];
            $id = $tmc[$i]['ID'];

            //$k=del_symb($t);
            $k = del_symb1($t);
            $z = "update a_sootv_exp1 set key_nazv3='$k' where id='$id'";
            Yii::$app->db_sap->createCommand($z)->execute();
        }
        echo "OK";
    }

    // Задача №1
    public function actionTask1()
    {

        $model = new input();

        if ($model->load(Yii::$app->request->post())) {

            //$arr['src'] = split ("\n", trim($model->number));
            $arr['src'] = explode("\n", trim($model->txt));

            $kol = count($arr['src']);
            $i = 0;
            $r = '';

            $mas = [];

            foreach ($arr['src'] as $v) {
                $mas[$i] = $v;
                $i++;
            }

            $model = new Pract1();
            $r = $model->task7($mas[0]
            );
            $header = 'Результат';
        } else {
            return $this->render('input', [
                'model' => $model
            ]);
        }

        return $this->render('res_task', ['r' => $r, 'header' => $header]);

    }

    // Проверка фактов [пром.]
    public function actionCheck_facts()
    {
        // Запись всех oldkey в массив
        $code=[];
        $result=[];
        $f = fopen('FACTS_04_CK01_20200831_08_L.txt', 'r');
        $ff = fopen('INSTLN_04_CK01_20200831_08_L.txt', 'r');
        $i = 0;
        while (!feof($f)) {
            $s = fgets($f);
            $data = explode("\t", $s);
           if(isset($data[1])) {
               if ($data[1] == '&ENDE') {
                   $code[$i] = $data[0];
                   $i++;
               }
           }
        }
        // Проверка oldkey в INSTLN файле
        $index=0;
        for($j=0;$j<$i;$j++){
            $k=$code[$j];
            $flag=0;
            $all=0;
            rewind($ff);
            while (!feof($ff)) {
                $all++;
                $s = fgets($ff);
                $data = explode("\t", $s);
//                if(($all%2)==0)
//                    debug($data);
                if(isset($data[1]) ) {
                    if (($all%2)==0) {
//                        debug($code[$j]);
//                        debug($data[0]);
//                        return;

                        if (trim($code[$j]) == trim($data[0])) {
                            $flag = 1;
                            break 1;
                        }
                    }
                }
            }
            if($flag == 0) {
                $result[$index]=$code[$j];
                $index++;
            }
        }
        echo 'Результат: ';
        debug($result);

    }

    // Задача №5 (Рекурсия)
    public function actionTask5()
    {
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        $model = new Pract1();
        for ($i = 1; $i < 10; $i++) {
            $r = $model->task5($i);
            echo $r;
            echo '<br>';

        }
        return $this->render('res_task', ['r' => $r]);

    }

    // Задача №6 (Рекурсия)
    public function actionTask6()
    {
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        $model = new Pract1();
        $s = '12345';
        $r = $model->task6($s, strlen($s));

        return $this->render('res_task', ['r' => $r]);

    }


    public function actionExml()
    {
        echo '<br>';
        echo '<br>';
        echo '<br>';

//        $f=fopen('Doc_20200805.xml','r');
        $s = file_get_contents('Doc_20200805.xml');
        $i = 0;
//        while (!feof($f)) {
//            $s=fgets($f);
        $p = xml_parser_create();
        xml_parse_into_struct($p, $s, $vals, $index);
        xml_parser_free($p);
//            $i++;
//            if($i==1) {
//                debug($index);
//                return;
//            }
//        }


        echo "Index array\n";
        debug($index);
        echo "\nVals array\n";
        debug($vals);
    }

    // Формирование вопросов для опросника
    public function actionForm_quest()
    {

        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
//        phpinfo();
//        return;
        // Yii::$app->db->active = false;

        $model = new addquestions();
        if ($model->load(Yii::$app->request->post())) {
            $sql = 'select ids from ws_polls where id=' . $model->theme;
            $ids = project_polls::findBySql($sql)->asarray()->all();
            $ids_polls = $ids[0]['ids'];
            // Запись вопроса
            $quest = new quest();
            $quest->question = $model->quest;
            $quest->id_polls = $model->theme;
            $quest->parent = $ids_polls;
            $ids = gen16(32);
            $quest->ids = $ids;
            $quest->deleted = 0;
            $quest->orderid = 1;
            $quest->save();
            // Запись ответов

            $sql = "select id from ws_quest where ids='$ids'";
            $qids = quest::findBySql($sql)->asarray()->all();

            $ids_quest = $qids[0]['id'];
            if ($model->a1) $q_all = 1;
            if ($model->a2) $q_all = 2;
            if ($model->a3) $q_all = 3;
            if ($model->a4) $q_all = 4;
            if ($model->a5) $q_all = 5;

            if (!empty($model->a1)) {
                $answer = new answer();

                $answer->answer = $model->a1;
                if (!empty($model->c1))
                    $answer->rightok = 1;
                else
                    $answer->rightok = 0;
                $answer->parent = $ids;
                $answer->ids = gen16(32);
                $answer->orderid = 0;
                $answer->deleted = 0;
                $answer->id_polls = $model->theme;
                $answer->id_quest = $ids_quest;
                $answer->weight = 0;
                $answer->save();
                unset($answer);
            }

            if (!empty($model->a2)) {
                $answer = new answer();
                $answer->answer = $model->a2;
                if (!empty($model->c2))
                    $answer->rightok = 1;
                else
                    $answer->rightok = 0;
                $answer->parent = $ids;
                $answer->ids = gen16(32);
                $answer->orderid = 0;
                $answer->deleted = 0;
                $answer->id_polls = $model->theme;
                $answer->id_quest = $ids_quest;
                $answer->weight = 0;
                $answer->save();
                unset($answer);
            }

            if (!empty($model->a3)) {
                $answer = new answer();

                $answer->answer = $model->a3;
                if (!empty($model->c3))
                    $answer->rightok = 1;
                else
                    $answer->rightok = 0;
                $answer->parent = $ids;
                $answer->ids = gen16(32);
                $answer->orderid = 0;
                $answer->deleted = 0;
                $answer->id_polls = $model->theme;
                $answer->id_quest = $ids_quest;
                $answer->weight = 0;
                $answer->save();
                unset($answer);
            }

            if (!empty($model->a4)) {
                $answer = new answer();

                $answer->answer = $model->a4;
                if (!empty($model->c4))
                    $answer->rightok = 1;
                else
                    $answer->rightok = 0;
                $answer->parent = $ids;
                $answer->ids = gen16(32);
                $answer->orderid = 0;
                $answer->deleted = 0;
                $answer->id_polls = $model->theme;
                $answer->id_quest = $ids_quest;
                $answer->weight = 0;
                $answer->save();
                unset($answer);
            }

            if (!empty($model->a5)) {
                $answer = new answer();
                $answer->answer = $model->a5;
                if (!empty($model->c5))
                    $answer->rightok = 1;
                else
                    $answer->rightok = 0;
                $answer->parent = $ids;
                $answer->ids = gen16(32);
                $answer->orderid = 0;
                $answer->deleted = 0;
                $answer->id_polls = $model->theme;
                $answer->id_quest = $ids_quest;
                $answer->weight = 0;
                $answer->save();
                unset($answer);
            }
            return $this->render('save_ok', ['v' => 1]);

        } else {
            return $this->render('addquestions', ['model' => $model]);
        }
    }

    public function actionForm_no()
    {
        return $this->render('save_ok', ['v' => 2]);
    }

    // Импорт списка рабочих в справочник телефонов для нового телефонного справочника
    public function actionImport_list_works_new()
    {
        $sql = "CREATE TABLE tmp_works (
              tab_nom varchar(255) NOT NULL,
              email varchar(255)  DEFAULT NULL,
              unit_1 varchar(255) NOT NULL,
              id_podr varchar(255) DEFAULT NULL,
              unit_2 varchar(255) DEFAULT NULL,
              post varchar(255) DEFAULT NULL,
              fio varchar(255) DEFAULT NULL,
              fio_ru varchar(255) DEFAULT NULL,
              fio_sound varchar(255) DEFAULT NULL,
              id_name int(11) DEFAULT NULL,
              main_unit varchar(255) DEFAULT NULL,
              date_b date DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('new_list_09_2019.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            //if($i==1) continue;
            $data = explode(";", $s);
            if (empty($data[0])) break;
            $data[5] = str_replace('"', ' ', $data[5]);
            $data[3] = date("Y-m-d", strtotime($data[3]));
            $data[1] = ltrim($data[1], '0');
            if (isset($data[6]))
                $data8 = trim($data[6]);
            else
                $data8 = '';

            $priz_rem = 0;
            $flag = 0;
            if (!empty($data8) && $data8 <> 'Група РЕМ') {
                $rrem = mb_substr($data8, mb_strlen($data8, 'UTF-8') - 3, 3, 'UTF-8');
                if ($rrem == 'РЕМ') $priz_rem = 1;
            }
            $e = 1;
            while ($e == 1) {
                $pos = strpos($data[2], "'");
                if ($data8 == 'Група РЕМ') {
                    $flag = 1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . "','" . $data[5] . "'" . ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[5] . "'" . ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[5] . "'" . ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . '"' . $data[5] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[5] . "'" . ')';
                }

                if ($data8 == 'Загальновиробничий персонал' || (empty($data8) && $data[6] <> 'Загальновиробничий персонал')) {
                    $flag = 1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . ",'" . "'" . ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . '"' . $data[5] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                }

                if (empty($data8) && $data[6] == 'Загальновиробничий персонал') {
                    $flag = 1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . ",'" . "'" . ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . '"' . $data[5] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                }

                if ($priz_rem == 1) {
                    $flag = 1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . ",'" . $data[6] . "'" . ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[6] . "'" . ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[6] . "'" . ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . "'" . "," . '"' . $data[6] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[6] . "'" . ')';
                }

                if ($flag == 0) {

                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . ' ' . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . "','" . "'" . ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6] . ' ' . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . ' ' . $data[4] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . ' ' . $data[4] . "'" . "," . '"' . $data[6] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'" . ')';
                }


                $e = 0;
            }

            Yii::$app->db_phone_loc->createCommand($sql)->execute();
        }

        fclose($f);
        return;
    }

    // Импорт списка рабочих в справочник телефонов для нового телефонного справочника
    public function actionImport_list_works_tel()
    {
        $sql = "CREATE TABLE tmp_works (
              tab_nom varchar(255) NOT NULL,
              unit_1 varchar(255) NOT NULL,
              unit_2 varchar(255) DEFAULT NULL,
              post varchar(255) DEFAULT NULL,
              fio varchar(255) DEFAULT NULL,
              main_unit varchar(255) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('list_works.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            //if($i==1) continue;
            $data = explode("~", $s);

            if (empty($data[0])) break;

            $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,main_unit) VALUES(" .
                "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" . "," . "'" . $data[3] . "'" .
                "," . "'" . $data[6] . "'" . ')';


            Yii::$app->db_phone_loc->createCommand($sql)->execute();
        }

        fclose($f);
        return;

        // Делаем обновление полей id_podr и id_name проверяем совпадение строк по fio
        $sql = 'UPDATE tmp_works a,1c b SET a.id_podr=b.id_podr,a.id_name=b.id_name,a.main_unit=b.main_unit
                WHERE a.fio = b.fio ';
        Yii::$app->db_phone_loc->createCommand($sql)->execute();
        $data = tmp_works_1::find()->where('id_name is not null')->orderby('id_name')->all();
        $i = 0;
        // Делаем чтобы все номера работников шли по порядку
        foreach ($data as $d) {
            $i++;
//            $d->id_sort = $i;
            $d->id_name = $i;
            $d->save();
        }

        $max = $i;  // Сдесь макс. последний номер работника
        $data = tmp_works_1::find()->where('id_name is null')->all();
        // Делаем чтобы все номера работников шли по порядку - тем которые null присваивается максимальный номер + 1
        foreach ($data as $d) {
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
            . " WHERE unit_1 LIKE 'Загальновиробничий персонал%'";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        $sql = "UPDATE 1c SET unit_1 = unit_2 "
            . " WHERE unit_1 LIKE 'Загальновиробничий персонал%'";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        $sql = "UPDATE 1c SET unit_2 = email "
            . " WHERE email LIKE 'Загальновиробничий персонал%'";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        $sql = "UPDATE 1c SET email = ''"
            . " WHERE email LIKE 'Загальновиробничий персонал%'";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        $sql = "update 1c
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


    // Импорт списка рабочих в справочник телефонов из других организаций
    public function actionImport_tel_vi()
    {
        $sql = "CREATE TABLE other_tel (
              fio varchar(255) DEFAULT NULL,
              post varchar(255) DEFAULT NULL,
              tel varchar(255) DEFAULT NULL,
              tel_town varchar(255) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();

        // Добавляем записи в таблицу other_tel с csv файла
        $f = fopen('Vinnitsa.csv', 'r');
        $i = 0;
        $pred = '';
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode(";", $s);
            $data[3] = str_replace('О', '0', $data[3]);

            if (empty($data[1])) $data[1] = $pred;
            $sql = "INSERT INTO other_tel (fio,post,tel,tel_town) VALUES(" .
                "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'" . ')';

            Yii::$app->db_phone_loc->createCommand($sql)->execute();
            $pred = $data[2];
        }

        fclose($f);
    }


    // Импорт списка рабочих из файла ОК во врем. табл.
    public function actionImport_list_new()
    {
        $sql = "DROP TABLE tmp_works";
//        Yii::$app->db_phone_loc->createCommand($sql)->execute();
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
        $f = fopen('list_work0220.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode("~", $s);
            if (empty($data[0])) break;
            $data[5] = str_replace('"', ' ', $data[5]);
            $data[5] = str_replace('i', 'і', $data[5]);
            $data[5] = str_replace('c', 'с', $data[5]);
            $data[6] = str_replace('i', 'і', $data[6]);
            $data[6] = str_replace('c', 'с', $data[6]);
            $e = 1;
            while ($e == 1) {
                $pos = strpos($data[2], "'");
                if (!$pos) {
                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(" .
                        "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" . "," . "'" . $data[3] . "'" .
                        "," . 'null' . "," . 'null' . "," . "'" . $data[7] . "'" . ')';

                } else {
                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(" .
                        '"' . $data[1] . '"' . "," . '"' . $data[2] . '"' . "," . '"' . $data[5] . '"' . "," . '"' . $data[4] . '"' . "," . '"' . $data[3] . '"' .
                        "," . 'null' . "," . 'null' . "," . '"' . $data[7] . '"' . ')';
                    break;
                }

//                $pos = strpos($data[1], "'");
//                if(!$pos)
//                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
//                        "'".$data[0]."'".","."'".$data[1]."'".","."'".$data[5]."'".","."'".$data[3]."'".","."'".$data[2]."'".
//                        ",".'null'.",".'null'.","."'".$data[4]."'".')';
//                else
//                    $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
//                        "'".$data[0]."'".",".'"'.$data[1].'"'.","."'".$data[5]."'".",".'"'.$data[3].'"'.","."'".$data[2]."'".
//                        ",".'null'.",".'null'.","."'".$data[4]."'".')';
                $e = 0;
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


    // Импорт населенных пунктов Украины по Днепропетровской области на MySql
    public function actionImport_towns()
    {
        // Добавляем записи в таблицу spr_towns с csv файла houses.csv
        // файл houses.csv взят с УкрПочты
        $f = fopen('houses.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(";", $s);
            $obl = mb_convert_encoding($data[0], "UTF-8", "Windows-1251");
            if ($obl <> 'Дніпропетровська') continue;

            $sql = "INSERT INTO spr_towns (obl,district,town,street) VALUES(" .
                '"' . $obl . '"' . "," . '"' .
                mb_convert_encoding($data[1], "UTF-8", "Windows-1251") . '"' . "," . '"' .
                mb_convert_encoding($data[2], "UTF-8", "Windows-1251") . '"' . "," . '"' .
                mb_convert_encoding($data[4], "UTF-8", "Windows-1251") . '"' . ')';


            Yii::$app->db_connect->createCommand($sql)->execute();
        }

        fclose($f);
        echo "Інформацію записано";
    }

    // Импорт населенных пунктов Украины по Днепропетровской области на PostGre
    public function actionImport_towns_pg()
    {
        // Добавляем записи в таблицу spr_towns с csv файла houses.csv
        // файл houses.csv взят с УкрПочты
        $f = fopen('houses.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(";", $s);
            $obl = mb_convert_encoding($data[0], "UTF-8", "Windows-1251");
            //if($obl<>'Дніпропетровська') continue;

            $sql = "INSERT INTO spr_towns (obl,district,town,ind,street,houses) VALUES(" .
                '$$' . $obl . '$$' . "," . '$$' .
                mb_convert_encoding($data[1], "UTF-8", "Windows-1251") . '$$' . "," . '$$' .
                mb_convert_encoding($data[2], "UTF-8", "Windows-1251") . '$$' . "," .
                mb_convert_encoding($data[3], "UTF-8", "Windows-1251") . "," . '$$' .
                mb_convert_encoding($data[4], "UTF-8", "Windows-1251") . '$$' . "," . "'" .
                mb_convert_encoding(trim($data[5]), "UTF-8", "Windows-1251") . "'" . ')';


            Yii::$app->db_pg_local_energo->createCommand($sql)->execute();
        }

        fclose($f);
        echo "Інформацію записано";
    }

    // Импорт точек учета в Energo
    public function actionImport_points()
    {
        $f = fopen('gv_energo.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode(";", $s);
            if (!isset($data[0])) exit;
            if (!isset($data[1])) exit;
            $code1 = $data[0];
            $code2 = $data[1];

            $sql = "select del_notrigger('eqm_equipment_tbl' ,
            'UPDATE eqm_equipment_tbl SET num_eqp=" . "''" . $code2 . "''" . " WHERE id=" . $code1 . "')";

            Yii::$app->db_pg_gv_energo->createCommand($sql)->execute();
            $sql = "insert into aa_p(id) values (" . $code1 . ")";
            //Yii::$app->db_pg_dn_energo->createCommand($sql)->execute();

            echo $i;
            echo '<br>';
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
        $f = fopen('lic.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            if ($i < 3 || ($i > 38 && $i < 53)) continue;
            $data = explode(";", $s);
            $s1 = $data[0];
            $s1 = substr($s1, 0, 1);
            $cod = ord($s1);

            // debug($data);

            if ($cod >= 48 && $cod < 58) {
                //echo $i.' '.$data[1].' '.$data[2].' '.$data[3].' '.$data[6]."\n";
                $work = str_replace("'", "`", $data[1]);
                $brig = $data[2];
                $stavka = str_replace(',', '.', $data[3]);
                $time = str_replace(',', '.', $data[6]);;
                $v = "'" . $work . "'" . "," . "'" . $brig . "'" . "," . $stavka . "," . $time;
            } else {
                //if($i==76) debug($data);
                //echo $i.' '.$data[2].' '.$data[3]."\n";
                $brig = $data[2];
                $stavka = str_replace(',', '.', $data[3]);;

                //$v = "'".$work."'".","."'".$brig."'".",".$stavka.",".$time;
            }
            if ($brig == '-') continue;
            if (empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3]) && $i <> 41) break;
            //echo $i.' '.$data[0].' '.$data[1].' '.$data[2].' '.$data[5]."\n";
            //echo $v."\n";
            $sql = "INSERT INTO tmp_works (work,brig,stavka,time_transp) VALUES(" . $v . ')';

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
        $f = fopen('work.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            if ($i < 6) continue;
            $data = explode(";", $s);
            //debug($data);
            $work = str_replace("'", "`", trim($data[1]));

            $cast_1 = del_space($data[2]);
            $cast_2 = del_space($data[4]);
            $cast_3 = del_space($data[6]);
            $cast_4 = del_space($data[8]);
            $cast_5 = del_space($data[10]);
            $cast_6 = del_space($data[12]);

            $cast_1 = str_replace(",", ".", $cast_1);
            $cast_2 = str_replace(",", ".", $cast_2);
            $cast_3 = str_replace(",", ".", $cast_3);
            $cast_4 = str_replace(",", ".", $cast_4);
            $cast_5 = str_replace(",", ".", $cast_5);
            $cast_6 = str_replace(",", ".", $cast_6);

            if (empty($cast_1)) $cast_1 = '0';
            if (empty($cast_2)) $cast_2 = '0';
            if (empty($cast_3)) $cast_3 = '0';
            if (empty($cast_4)) $cast_4 = '0';
            if (empty($cast_5)) $cast_5 = '0';
            if (empty($cast_6)) $cast_6 = '0';

            $v = "'" . $work . "'" . "," . $cast_1 . "," . $cast_2 . "," . $cast_3 . "," . $cast_4 . "," . $cast_5 . "," . $cast_6;

            if (empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3])) break;
            //echo $i.' '.$data[0].' '.$data[1].' '.$data[2].' '.$data[5]."\n";
            echo $v . "\n";
            $sql = "INSERT INTO tmp_notlic (work,cast_1,cast_2,cast_3,cast_4,cast_5,cast_6) VALUES(" . $v . ')';

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
        $f = fopen('tr_2020.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            //if($i<8) continue;
            $data = explode("~", $s);
            //debug($data);
            $transport = $data[1];
            $nomer = $data[2];
            $prostoy = $data[3];
            $proezd = $data[4];
            $rabota = $data[5];

            $prostoy = str_replace(",", ".", $prostoy);
            $proezd = str_replace(",", ".", $proezd);
            $rabota = str_replace(",", ".", $rabota);

            if (empty($rabota) || is_null($rabota) || $rabota == '' || ord($rabota) == 10) $rabota = 0;

            $v = "'" . $transport . "'" . "," . "'" . $nomer . "'" . "," . $prostoy . "," . $proezd . "," . $rabota;

            if (empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3])) break;
            //echo $i.' '.$data[0].' '.$data[1].' '.$data[2].' '.$data[5]."\n";
            //echo $v."\n";
            $sql = "INSERT INTO tmp_transport (transport,nomer,prostoy,proezd,rabota) VALUES(" . $v . ')';
            //echo $sql;
            Yii::$app->db->createCommand($sql)->execute();
        }

        fclose($f);

        echo "Інформацію записано";
    }

    // Импорт данных по транспорту детальная (для САП)
    // в справочник транспорта в 1Click
    public function actionImport_transport_detal()
    {
        $sql = "DROP TABLE tmp_transport_d";
        Yii::$app->db->createCommand($sql)->execute();

        $sql = "CREATE TABLE tmp_transport_d (
              model varchar(255)  NULL,
              nomer varchar(15)  NULL,
              place   varchar(45)  NULL,
              fuel  varchar(15)  NULL,  
              all_p varchar(35)  NULL,  
              oil_p varchar(35)  NULL,  
              wage varchar(35)  NULL,  
              esv varchar(35)  NULL,  
              amort varchar(35)  NULL,  
             all_move varchar(35)  NULL,  
             cost_92_move varchar(35)  NULL, 
             cost_95_move varchar(35)  NULL,
             cost_df_move varchar(35)  NULL,
             cost_g_move varchar(35)  NULL,
             cost_oil_move varchar(35) NULL, 
             wage_move varchar(35)  NULL,  
             wage_esv_move varchar(35)  NULL,
             amort_move varchar(35)  NULL,  
            all_work varchar(35)  NULL,  
            cost_92_work varchar(35)  NULL, 
             cost_95_work varchar(35)  NULL,
             cost_df_work varchar(35)  NULL,
             cost_g_work varchar(35)  NULL,
             cost_oil_work varchar(35)  NULL, 
             common varchar(35)  NULL 
                     
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db->createCommand($sql)->execute();
        $f = fopen('tr_2020_detal.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            //if($i<8) continue;
            $data = explode("~", $s);
            //debug($data);
            $model = $data[1];
            $nomer = $data[2];
            $place = $data[3];
            $fuel = $data[4];
            $all_p = $data[5];
            $oil_p = $data[7];
            $zp = $data[11];
            $esv = $data[12];
            $amort = $data[13];
            $common = $data[14];
            $all_move = $data[15];
            $cost_92_move = $data[16];
            $cost_95_move = $data[17];
            $cost_df_move = $data[18];
            $oil_move = $data[19];
            $cost_g_move = $data[20];
            $all_work = $data[25];
            $cost_92_work = $data[26];
            $cost_95_work = $data[27];
            $cost_df_work = $data[28];
            $cost_g_work = $data[30];

//            debug($zp);
//            return;

            $v = "'" . $model . "'" . "," . "'" . $nomer . "'" . "," . "'" . $place . "'" . "," . "'" . $fuel . "'" .
                "," . "'" . $all_p . "'" . "," . "'" . $oil_p . "'" . "," . "'" . $zp . "'" . "," . "'" . $esv . "'" .
                "," . "'" . $amort . "'" . "," . "'" . $common . "'" . "," . "'" . $all_move . "'" . "," . "'" . $cost_92_move . "'" .
                "," . "'" . $cost_95_move . "'" . "," . "'" . $cost_df_move . "'" . "," . "'" . $cost_g_move . "'" .
                "," . "'" . $all_work . "'" . "," . "'" . $cost_92_work . "'" . "," . "'" . $cost_95_work . "'" . "," . "'" . $cost_df_work . "'" .
                "," . "'" . $cost_g_work . "'";

            $sql = "INSERT INTO tmp_transport_d (model,nomer,place,fuel,all_p,oil_p,wage,esv,amort,common,
                                all_move,cost_92_move,cost_95_move,cost_df_move,cost_g_move,
                                all_work,cost_92_work,cost_95_work,cost_df_work,cost_g_work) VALUES(" . $v . ')';
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
        $f = fopen('mts.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode(",", $s);
            $tel = $data[0];
            $tarif = $data[1];
            $fio = $data[2];
            $post = $data[3];

            $v = "'" . $tel . "'" . "," . "'" . $tarif . "'" . "," . "'" . $fio . "'" . "," . "'" . $post . "'";

            if (empty($data[0]) && empty($data[1]) && empty($data[2]) && empty($data[3])) break;

            $sql = "INSERT INTO mts (tel,tarif,fio,post) VALUES(" . $v . ')';
            Yii::$app->db_phone_loc->createCommand($sql)->execute();
        }

        fclose($f);

        echo "Інформацію записано";
    }

    // Перенос данных по eerm [для юр. лиц]
    public function actionEerm2cnt()
    {
        $sql = "CREATE TABLE public.eerm2cnt
                (
                  cnt char(15),
                  eerm numeric(12,4)
                )";
        Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        $f = fopen('eerm_pv.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode("~", $s);
            if (!isset($data[1])) break;
            $cnt = $data[1];
            $eerm = str_replace(',', '.', $data[2]);
            $v = "$$$cnt$$" . "," . $eerm;
            $sql = "INSERT INTO eerm2cnt (cnt,eerm) VALUES(" . $v . ')';
            Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        }
        fclose($f);
        echo "Інформацію записано";
    }

    // Перенос данных по линиям [для юр. лиц]
    public function actionLines2sap()
    {
        $sql = "CREATE TABLE public.Sap_lines
                (
                  kod_res int,
                id int,
                  type char(40),
                 normative char(20),
                voltage_nom  char(20), 
                amperage_nom  char(20), 
                voltage_max  char(20), 
                amperage_max char(20), 
                cords char(10), 
                cover char(10),
                ro char(10),
               xo char(10),
               dpo char(10),
               show_def char(10),
               s_nom char(10),
               id_sap char(10)                 
                )";
        Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        $f = fopen('spr_line.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode("~", $s);
            if (!isset($data[1])) break;
            $v = "4" . "," . $data[0] . "," . "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" .
                "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'" .
                "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" .
                "," . "'" . $data[7] . "'" . "," . "'" . $data[8] . "'" .
                "," . "'" . $data[9] . "'" . "," . "'" . $data[10] . "'" .
                "," . "'" . $data[11] . "'" . "," . "'" . $data[12] . "'" .
                "," . "'" . $data[13] . "'" . "," . "'" . $data[14] . "'";

            $sql = "INSERT INTO Sap_lines (kod_res,id,type,normative,voltage_nom,
                       amperage_nom, voltage_max,amperage_max,cords,cover,ro,xo,dpo,show_def,s_nom,id_sap) 
                       VALUES(" . $v . ')';
            Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        }
        fclose($f);
        echo "Інформацію записано";
    }

    // Перенос данных по трансф [для юр. лиц]
    public function actionTrans2sap()
    {
        $sql = "CREATE TABLE public.Sap_transf
                (
                  kod_res int,
                 id int,
                  type char(40),
                 normative char(20),
                voltage_nom  char(20), 
                amperage_nom  char(20), 
                voltage_max  char(20), 
                amperage_max char(20), 
                phase char(10), 
                swathe char(10),
                hook_up char(10),
               power_nom_old char(10),
               amperage_no_load char(10),
               show_def char(10),
               power_nom char(10),
               id_sap char(10)                 
                )";
        Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        $f = fopen('spr_transf.csv', 'r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if ($i == 1) continue;
            $data = explode("~", $s);
            if (!isset($data[1])) break;
            $v = "4" . "," . $data[0] . "," . "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" .
                "," . "'" . $data[3] . "'" . "," . "'" . $data[4] . "'" .
                "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" .
                "," . "'" . $data[7] . "'" . "," . "'" . $data[8] . "'" .
                "," . "'" . $data[9] . "'" . "," . "'" . $data[10] . "'" .
                "," . "'" . $data[11] . "'" . "," . "'" . $data[12] . "'" .
                "," . "'" . $data[13] . "'" . "," . "'" . $data[14] . "'" .
                "," . "'" . $data[15] . "'" . "," . "'" . $data[16] . "'";

            $sql = "INSERT INTO Sap_transf (kod_res,id,type,normative,voltage_nom,
                       amperage_nom, voltage_max,amperage_max,phase,swathe,hook_up,power_nom_old
                       ,amperage_no_load,power_nom,show_def, id_sap) 
                       VALUES(" . $v . ')';
            Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        }
        fclose($f);
        echo "Інформацію записано";
    }

    // Транслитерация
    public function actionTranslit()
    {
        $f = fopen('adres.csv', 'r');
        $ff = fopen('result.txt', 'w+');
        $i = 0;
        while (!feof($f)) {
            $i++;
            if ($i == 1) continue;
            $s = trim(fgets($f));
            $ss = translit($s);
            if (!empty($s))
                $s = $s . ';' . $ss;
            fputs($ff, $s);
            fputs($ff, "\n");
        }
        fclose($f);
        fclose($ff);

        echo "Інформацію записано";
    }

    // Делает поиск на сервере PostGreSQL
    public function actionFind()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $model = new input_find_server();

        if ($model->load(Yii::$app->request->post())) {
            $data = $model->search();

            return $this->render('result_find', ['r' => $data]);

        } else {

            return $this->render('input_find_server', [
                'model' => $model,
            ]);
        }
    }

    // Test
    public function actionTest()
    {
        $mmgg = "'2019-07-01'";
        $mm = (int)substr($mmgg, 6, 2);

        $yy = (int)substr($mmgg, 1, 4);
        if ($mm == 1) {
            $mm = 12;
            $yy--;
        } else
            $mm--;
        if ($mm < 10)
            $mm = '0' . $mm;

        $hist_table = "spog_hist_" . $yy . '_' . $mm;
        echo $hist_table;
    }


    // Делает поиск на сервере MySQL
    public function actionFind_mysql()
    {
        $model = new input_find_server_mysql();

        if ($model->load(Yii::$app->request->post())) {
            $data = $model->search();

            return $this->render('result_find', ['r' => $data]);

        } else {

            return $this->render('input_find_server_mysql', [
                'model' => $model,
            ]);
        }
    }


    // Делает ввод данных и преобразование чисел
    public function actionConvert()
    {
        //phpinfo();
        $model = new index();

        if ($model->load(Yii::$app->request->post())) {

            //$arr['src'] = split ("\n", trim($model->number));
            $arr['src'] = explode("\n", trim($model->number));

            $kol = count($arr['src']);
            $i = 0;


            foreach ($arr['src'] as $v) {
                if (empty($v) || !isset($v)) continue;

                if (empty($model->sys_res)) {
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
                } else {
                    switch ($model->sys_res) {
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
                    switch ($model->sys) {
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
                    switch ($model->sys_res) {
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


            return $this->render('result', ['arr' => $arr, 'q' => $q, 'r' => $r, 'k' => $k, 'kol' => $kol]);
        } else {

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

        if ($model->load(Yii::$app->request->post())) {
            $r = $model->str;
            $p = $model->passwd;
            return $this->render('result_code', ['r' => $r, 'p' => $p]);
        } else {

            return $this->render('symbol_code', [
                'model' => $model, 'vid' => 2
            ]);
        }
    }

    //    Операции с множествами
    public function actionOper_sets()
    {
        $model = new sets();

        if ($model->load(Yii::$app->request->post())) {
            $a = $model->a;
            $b = $model->b;
            $mas_a = explode(",", $a);
            $mas_b = explode(",", $b);
            $oper = $model->oper;
            $key = $model->prepare($mas_a, $mas_b);
            if ($oper == 1)
                $data = $model->union($key);
            if ($oper == 2)
                $data = $model->cross($key);
            if ($oper == 3)
                $data = $model->a_m_b($key);
            if ($oper == 4)
                $data = $model->b_m_a($key);
            if ($oper == 5)
                $data = $model->uncross($key);
            $model->finish();
            return $this->render('result_set', ['data' => $data]);
        } else {

            return $this->render('oper_sets', [
                'model' => $model, 'vid' => 2
            ]);
        }
    }

    //    Кодирование файла
    public function actionCode_file()
    {
        $model = new code_file();


        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isPost)
                $model->file = UploadedFile::getInstance($model, 'file');
            $p = $model->passwd;
            $file = $model->file;
            $model->file->saveAs('./' . $file->name);
            return $this->render('result_code_file', ['file' => $file, 'p' => $p, 'mode' => 1]);
        } else {

            return $this->render('file_code', [
                'model' => $model, 'vid' => 1
            ]);
        }
    }

    //    Декодирование файла
    public function actionDecode_file()
    {
        $model = new decode_file();


        if ($model->load(Yii::$app->request->post())) {
            if (Yii::$app->request->isPost)
                $model->file = UploadedFile::getInstance($model, 'file');
            $p = $model->passwd;
            $file = $model->file;
            $model->file->saveAs('./' . $file->name);
            return $this->render('result_code_file', ['file' => $file, 'p' => $p, 'mode' => 2]);
        } else {

            return $this->render('file_code', [
                'model' => $model, 'vid' => 2
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
//        echo phpinfo();
        $model = new symbol();

        if ($model->load(Yii::$app->request->post())) {

            return $this->render('symbol_result', ['model' => $model]);
        } else {

            return $this->render('symbol', [
                'model' => $model, 'vid' => 1
            ]);
        }
    }

    // Проверка строк на различие
    public function actionCmp_str()
    {
        $model = new cmp_str();

        if ($model->load(Yii::$app->request->post())) {

            return $this->render('symbol_result_str', ['model' => $model]);
        } else {

            return $this->render('cmp_str', [
                'model' => $model, 'vid' => 1
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

        if ($model->load(Yii::$app->request->post())) {

            //$arr['src'] = split ("\n", trim($model->number));

            $str = trim($model->number);
            $y = strlen($str);
            $flag = 0;
            $s = '';
            $j = 0;
            $k = 0;
            $p = 1;
            for ($i = 0; $i < $y; $i++) {
                $c = substr($str, $i, 1);
                if ($i == ($y - 1)) $s .= $c;
                if ($c != "\n" && $i != ($y - 1)) {
                    $s .= $c;
                } else {
                    if (strlen($s) == 1 || $s == '') {
                        $flag = 1;
                        $s = '';
                        $p++;
                        $k = 0;
                        continue;
                    }
                    if ($flag == 0) {
                        $arr['dat1'][$j] = $s;
                        $j++;

                    }
                    if ($flag == 1) {
                        $arr['dat' . $p][$k] = $s;
                        $k++;

                    }

                    $s = '';
                }

            }
            $kol = 0;
            $i = 0;
            $k = count($arr);
//            for($i=0;$i<$k;$i++)
//                echo $arr[$i];
//            debug(count($arr));
//            return;

            return $this->render('result_task', ['arr' => $arr, 'kol' => $kol]);
        } else {

            return $this->render('input_data', [
                'model' => $model,
            ]);
        }
    }


//Ввести строку и вывести на экран перевернутую строку и строку со всеми большими символами

    public function actionStroka()
    {
        return $this->render('stroka');
    }

//Ввести свой день рождения и посчитать сколько прожито дней - вывести результат в рамке.

    public function actionBirthday()
    {
        return $this->render('birthday');
    }

//Ввести число и вывести таблицу умножения этого числа от 1 до 20. Результат вывести в таблице.

    public function actionTable()
    {
        $model = new TableForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            return $this->render('table2', compact('model'));
        } else {
            return $this->render('table', compact('model'));
        }
    }


//Проверка файлв на пустые поля. Юр

    public function actionUpload()
    {

        $model = new UploadForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            return $this->render('upload2', compact('model'));
        } else {
            return $this->render('upload', compact('model'));
        }

    }


    //Проверка файлв на пустые поля. Быт

    public function actionUploadbyt()
    {

        $model = new UploadBytForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $model->file = UploadedFile::getInstance($model, 'file');
            return $this->render('uploadbytt', compact('model'));
        } else {
            return $this->render('uploadbyt', compact('model'));
        }

    }


    public function actionPower_outages()
    {
        $model = new Power_outages();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $sql = "SELECT descr, encode, accbegin_date as date_begin,
case WHEN acctypeid = 1 then 'Плановые' else 'Аварийные' END as type_otkl,
case WHEN acctypeid = 1 then planend_date else factend_date END as date_end
FROM cc_crash 
where issubmit = 1";
            if (!empty($model->begin_date)) {
                $sql = $sql . ' and accbegin_date >=' . "'" . $model->begin_date . "'";
            }
            if (!empty($model->end_date)) {
                $sql = $sql . ' and factend_date <=' . "'" . $model->end_date . "'";
            }
            if (!empty($model->type)) {
                if ($model->type != 3)
                    $sql = $sql . ' and acctypeid =' . "'" . $model->type . "'";
            }
            if (!empty($model->pidrozdil)) {
                if ($model->pidrozdil == 1)
                    $res = 'Днепропетровский РЭС';
                if ($model->pidrozdil == 2)
                    $res = 'Ингулецкий РЭС';
                if ($model->pidrozdil == 3)
                    $res = 'Желтоводский РЭС';
                if ($model->pidrozdil == 4)
                    $res = 'Гвардейский  РЭС';
                if ($model->pidrozdil == 5)
                    $res = 'Апостоловский РЭС';
                if ($model->pidrozdil == 6)
                    $res = 'Криворожский РЭС';
                if ($model->pidrozdil == 7)
                    $res = 'Вольногорский РЭС';
                if ($model->pidrozdil == 8)
                    $res = 'Павлоградский РЭС';
                $sql = $sql . ' and encode =' . "'" . $res . "'";
            }
            $sql = $sql . ' ORDER BY 1';
//            debug($model);
//            return;
            $data = Off_site::findbysql($sql)->asArray()
                ->all();
//            debug($data);
//            return;
            return $this->render('result_power_outage', compact('data'));
        } else {
            return $this->render('power_outages', compact('model'));
        }
    }
}


