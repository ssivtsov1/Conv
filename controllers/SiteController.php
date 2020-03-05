<?php

namespace app\controllers;

use app\models\Pract1;
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

    // Импорт бюджета
    public function actionImport_budget()
    {
        $f = fopen('budget_18.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode(";",$s);
            if(!isset($data[1])) continue;
            //if ($i==16832) {echo $i; echo "<br>";debug($data);return;}

            $data[9] = trim(str_replace('"',"'",$data[9]));
            $data[7] = trim(str_replace('"',"'",$data[7]));
            $data[5] = trim(str_replace('"',"'",$data[5]));


            if(is_null($data[8])  || $data[8]=='') $data[8]=0;
            if(is_null($data[12])  || $data[12]=='') $data[12]=0;
            if(is_null($data[13])  || $data[13]=='') $data[13]=0;
            $data[12] = trim(str_replace(',','.',$data[12]));
            if(is_null($data[14])  || $data[14]=='') $data[14]=0;
            $data[14] = trim(str_replace(',','.',$data[14]));
            if(is_null($data[15])  || $data[15]=='') $data[15]=0;
            if(is_null($data[16])  || $data[16]=='') $data[16]=0;
            $data[16] = trim(str_replace(',','.',$data[16]));
            if(is_null($data[17])  || $data[17]=='') $data[17]=0;
            if(is_null($data[18])  || $data[18]=='') $data[18]=0;
            if(is_null($data[19])  || $data[19]=='') $data[19]=0;
            if(is_null($data[20])  || $data[20]=='') $data[20]=0;
            $data[20] = trim(str_replace(',','.',$data[20]));
            if(is_null($data[21])  || $data[21]=='') $data[21]=0;
            if(is_null($data[22])  || $data[22]=='') $data[22]=0;
            $data[22] = trim(str_replace(',','.',$data[22]));
            if(is_null($data[23])  || $data[23]=='') $data[23]=0;
            if(is_null($data[24])  || $data[24]=='') $data[24]=0;
            $data[24] = trim(str_replace(',','.',$data[24]));
            if(is_null($data[25])  || $data[25]=='') $data[25]=0;
            if(is_null($data[26])  || $data[26]=='') $data[26]=0;
            if(is_null($data[27])  || $data[27]=='') $data[27]=0;
            if(is_null($data[28])  || $data[28]=='') $data[28]=0;
            $data[28] = trim(str_replace(',','.',$data[28]));
            if(is_null($data[29])  || $data[29]=='') $data[29]=0;
            if(is_null($data[30])  || $data[30]=='') $data[30]=0;
            $data[30] = trim(str_replace(',','.',$data[30]));
            if(is_null($data[31])  || $data[31]=='') $data[31]=0;
            if(is_null($data[32])  || $data[32]=='') $data[32]=0;
            $data[32] = trim(str_replace(',','.',$data[32]));
            if(is_null($data[33])  || $data[33]=='') $data[33]=0;
            if(is_null($data[34])  || $data[34]=='') $data[34]=0;
            if(is_null($data[35])  || $data[35]=='') $data[35]=0;
            if(is_null($data[36])  || $data[36]=='') $data[36]=0;
            $data[36] = trim(str_replace(',','.',$data[36]));
            if(is_null($data[37])  || $data[37]=='') $data[37]=0;
            if(is_null($data[38])  || $data[38]=='') $data[38]=0;
            $data[38] = trim(str_replace(',','.',$data[38]));
            if(is_null($data[39])  || $data[39]=='') $data[39]=0;
            if(is_null($data[40])  || $data[40]=='') $data[40]=0;
            $data[40] = trim(str_replace(',','.',$data[40]));
            if(is_null($data[41])  || $data[41]=='') $data[41]=0;
            if(is_null($data[42])  || $data[42]=='') $data[42]=0;
            if(is_null($data[43])  || $data[43]=='') $data[43]=0;
            if(is_null($data[44])  || $data[44]=='') $data[44]=0;
            if(is_null($data[45])  || $data[45]=='') $data[45]=0;

            $data[11] = trim(str_replace(',','.',$data[11]));
            $data[11] = preg_replace("/[^x\d|*\.]/", "", $data[11]);
            $data[13] = trim(str_replace(',','.',$data[13]));
            $data[13] = preg_replace("/[^x\d|*\.]/", "", $data[13]);
            $data[15] = trim(str_replace(',','.',$data[15]));
            $data[15] = preg_replace("/[^x\d|*\.]/", "", $data[15]);
            $data[17] = trim(str_replace(',','.',$data[17]));
            $data[17] = preg_replace("/[^x\d|*\.]/", "", $data[17]);
            $data[18] = trim(str_replace(',','.',$data[18]));
            $data[18] = preg_replace("/[^x\d|*\.]/", "", $data[18]);
            $data[19] = trim(str_replace(',','.',$data[19]));
            $data[19] = preg_replace("/[^x\d|*\.]/", "", $data[19]);

            $data[21] = trim(str_replace(',','.',$data[21]));
            $data[21] = preg_replace("/[^x\d|*\.]/", "", $data[21]);
            $data[23] = trim(str_replace(',','.',$data[23]));
            $data[23] = preg_replace("/[^x\d|*\.]/", "", $data[23]);
            $data[25] = trim(str_replace(',','.',$data[25]));
            $data[25] = preg_replace("/[^x\d|*\.]/", "", $data[25]);
            $data[26] = trim(str_replace(',','.',$data[26]));
            $data[26] = preg_replace("/[^x\d|*\.]/", "", $data[26]);
            $data[27] = trim(str_replace(',','.',$data[27]));
            $data[27] = preg_replace("/[^x\d|*\.]/", "", $data[27]);

            $data[29] = trim(str_replace(',','.',$data[29]));
            $data[29] = preg_replace("/[^x\d|*\.]/", "", $data[29]);
            $data[31] = trim(str_replace(',','.',$data[31]));
            $data[31] = preg_replace("/[^x\d|*\.]/", "", $data[31]);
            $data[33] = trim(str_replace(',','.',$data[33]));
            $data[33] = preg_replace("/[^x\d|*\.]/", "", $data[33]);
            $data[34] = trim(str_replace(',','.',$data[34]));
            $data[34] = preg_replace("/[^x\d|*\.]/", "", $data[34]);
            $data[35] = trim(str_replace(',','.',$data[35]));
            $data[35] = preg_replace("/[^x\d|*\.]/", "", $data[35]);

            $data[37] = trim(str_replace(',','.',$data[37]));
            $data[37] = preg_replace("/[^x\d|*\.]/", "", $data[37]);
            $data[39] = trim(str_replace(',','.',$data[39]));
            $data[39] = preg_replace("/[^x\d|*\.]/", "", $data[39]);
            $data[41] = trim(str_replace(',','.',$data[41]));
            $data[41] = preg_replace("/[^x\d|*\.]/", "", $data[41]);
            $data[42] = trim(str_replace(',','.',$data[42]));
            $data[42] = preg_replace("/[^x\d|*\.]/", "", $data[42]);
            $data[43] = trim(str_replace(',','.',$data[43]));
            $data[43] = preg_replace("/[^x\d|*\.]/", "", $data[43]);
            $data[44] = trim(str_replace(',','.',$data[44]));
            $data[44] = preg_replace("/[^x\d|*\.]/", "", $data[44]);
            $data[45] = trim(str_replace(',','.',$data[45]));
            $data[45] = preg_replace("/[^x\d|*\.]/", "", $data[45]);


            $sql = "INSERT INTO budget (type_act,vid_tmc,page,service,name_obj,dname_obj,vid_repair,
                    name_spec,lot,name_tmc,ed_izm,price,
                    q_1,p_1,q_2,p_2,q_3,p_3,aq_1,ap_1,q_4,p_4,q_5,p_5,q_6,p_6,aq_2,ap_2,
                    q_7,p_7,q_8,p_8,q_9,p_9,aq_3,ap_3,q_10,p_10,q_11,p_11,q_12,p_12,aq_4,ap_4,
                    year_q,year_p) VALUES(".
                "'".$data[0]."'".",". "'".$data[1]. "'".",".'"'.$data[2]. '"'.",'".$data[3]. "'".",". "'".$data[4]."',".
                '"'.$data[5]. '"'.",". "'".$data[6]. "'".",". '"'.$data[7]. '"'.",".$data[8].",". '"'
                .$data[9]. '",'. "'".$data[10]. "'".",".$data[11].",".$data[12].","
                .$data[13].",".$data[14].",".$data[15].",".$data[16].","
                .$data[17].",".$data[18].",".$data[19].",".$data[20].",".
                $data[21].",".$data[22].",".$data[23].",".$data[24].",".
                $data[25].",".$data[26].",".$data[27].",".$data[28].",".
                $data[29].",".$data[30].",".$data[31].",".$data[32].",".
                $data[33].",".$data[34].",".$data[35].",".$data[36].",".
                $data[37].",".$data[38].",".$data[39].",".$data[40].",".
                $data[41].",".$data[42].",".$data[43].",".$data[44].",".
                $data[45].
                ')';

            if ($i>19977)
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

    public function actionCorr_budget(){

        $sql='update budget
        set p_1=q_1*price/1000
        WHERE p_1=0 and q_1>0';

        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
        set p_2=q_2*price/1000
        WHERE p_2=0 and q_2>0';

        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
        set ap_2=aq_2*price/1000
        WHERE ap_2=0 and aq_2>0';

        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
        set p_3=q_3*price/1000
        WHERE p_3=0 and q_3>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
        set ap_3=aq_3*price/1000
        WHERE ap_3=0 and aq_3>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_4=q_4*price/1000
WHERE p_4=0 and q_4>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set ap_4=aq_4*price/1000
WHERE ap_4=0 and aq_4>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_5=q_5*price/1000
WHERE p_5=0 and q_5>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_6=q_6*price/1000
WHERE p_6=0 and q_6>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_7=q_7*price/1000
WHERE p_7=0 and q_7>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_8=q_8*price/1000
WHERE p_8=0 and q_8>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_9=q_9*price/1000
WHERE p_9=0 and q_9>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_10=q_10*price/1000
WHERE p_10=0 and q_10>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_11=q_11*price/1000
WHERE p_11=0 and q_11>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set p_12=q_12*price/1000
WHERE p_12=0 and q_12>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget
set year_p=year_q*price/1000
WHERE year_p=0 and year_q>0';
        Yii::$app->db_budget->createCommand($sql)->execute();
//-------------------------------------------------------------------------

        $sql='update budget 
        set q_1=p_1*1000/price
        WHERE p_1<>0 and q_1=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_2=p_2*1000/price
        WHERE p_2<>0 and q_2=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_3=p_3*1000/price
        WHERE p_3<>0 and q_3=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_4=p_4*1000/price
        WHERE p_4<>0 and q_4=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_5=p_5*1000/price
        WHERE p_5<>0 and q_5=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_6=p_6*1000/price
        WHERE p_6<>0 and q_6=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_7=p_7*1000/price
        WHERE p_7<>0 and q_7=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_8=p_8*1000/price
        WHERE p_8<>0 and q_8=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_9=p_9*1000/price
        WHERE p_9<>0 and q_9=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_10=p_10*1000/price
        WHERE p_10<>0 and q_10=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_11=p_11*1000/price
        WHERE p_11<>0 and q_11=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set q_12=p_12*1000/price
        WHERE p_12<>0 and q_12=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set aq_1=ap_1*1000/price
        WHERE ap_1<>0 and aq_1=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set aq_2=ap_2*1000/price
        WHERE ap_2<>0 and aq_2=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set aq_3=ap_3*1000/price
        WHERE ap_3<>0 and aq_3=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set aq_4=ap_1*1000/price
        WHERE ap_4<>0 and aq_4=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();

        $sql='update budget 
        set year_q=year_p*1000/price
        WHERE year_p<>0 and year_q=0 and price<>0';
        Yii::$app->db_budget->createCommand($sql)->execute();



        echo "Інформацію записано";
    }

    // Импорт бюджета за 2019 год
    public function actionImport_budget19()
    {
        $f = fopen('budget_19.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode(";",$s);
            //if(!isset($data[1])) continue;
            //if ($i==16832) {echo $i; echo "<br>";debug($data);return;}

            $data[9] = trim(str_replace('"',"'",$data[9]));
            $data[7] = trim(str_replace('"',"'",$data[7]));
            $data[5] = trim(str_replace('"',"'",$data[5]));


            if(is_null($data[8])  || $data[8]=='') $data[8]=0;
            if(is_null($data[11])  || $data[11]=='' || trim($data[11])=='-') $data[11]=0;
            if(is_null($data[12])  || $data[12]=='' || trim($data[12])=='-') $data[12]=0;

            if(is_null($data[13])  || $data[13]=='' || trim($data[13])=='-') $data[13]=0;
            $data[12] = trim(str_replace(',','.',$data[12]));
            if(is_null($data[14])  || $data[14]=='' || trim($data[14])=='-') $data[14]=0;
            $data[14] = trim(str_replace(',','.',$data[14]));

            if(is_null($data[15])  || $data[15]=='' || trim($data[15])=='-') $data[15]=0;
            if(is_null($data[16])  || $data[16]=='' || trim($data[16])=='-') $data[16]=0;
            $data[16] = trim(str_replace(',','.',$data[16]));
            if(is_null($data[17])  || $data[17]=='' || trim($data[17])=='-') $data[17]=0;
            if(is_null($data[18])  || $data[18]=='' || trim($data[18])=='-') $data[18]=0;
            if(is_null($data[19])  || $data[19]=='' || trim($data[19])=='-') $data[19]=0;
            if(is_null($data[20])  || $data[20]=='' || trim($data[20])=='-') $data[20]=0;
            $data[20] = trim(str_replace(',','.',$data[20]));
            if(is_null($data[21])  || $data[21]=='' || trim($data[21])=='-') $data[21]=0;
            if(is_null($data[22])  || $data[22]=='' || trim($data[22])=='-') $data[22]=0;
            $data[22] = trim(str_replace(',','.',$data[22]));
            if(is_null($data[23])  || $data[23]=='' || trim($data[23])=='-') $data[23]=0;
            if(is_null($data[24])  || $data[24]=='' || trim($data[24])=='-') $data[24]=0;
            $data[24] = trim(str_replace(',','.',$data[24]));
            if(is_null($data[25])  || $data[25]=='' || trim($data[25])=='-') $data[25]=0;
            if(is_null($data[26])  || $data[26]=='' || trim($data[26])=='-') $data[26]=0;
            if(is_null($data[27])  || $data[27]=='' || trim($data[27])=='-') $data[27]=0;
            if(is_null($data[28])  || $data[28]=='' || trim($data[28])=='-') $data[28]=0;
            $data[28] = trim(str_replace(',','.',$data[28]));
            if(is_null($data[29])  || $data[29]=='' || trim($data[29])=='-') $data[29]=0;
            if(is_null($data[30])  || $data[30]=='' || trim($data[30])=='-') $data[30]=0;
            $data[30] = trim(str_replace(',','.',$data[30]));
            if(is_null($data[31])  || $data[31]=='' || trim($data[31])=='-') $data[31]=0;
            if(is_null($data[32])  || $data[32]=='' || trim($data[32])=='-') $data[32]=0;
            $data[32] = trim(str_replace(',','.',$data[32]));
            if(is_null($data[33])  || $data[33]=='' || trim($data[33])=='-') $data[33]=0;
            if(is_null($data[34])  || $data[34]=='' || trim($data[34])=='-') $data[34]=0;
            if(is_null($data[35])  || $data[35]=='' || trim($data[35])=='-') $data[35]=0;
            if(is_null($data[36])  || $data[36]=='' || trim($data[36])=='-') $data[36]=0;
            $data[36] = trim(str_replace(',','.',$data[36]));
            if(is_null($data[37])  || $data[37]=='' || trim($data[37])=='-') $data[37]=0;
            if(is_null($data[38])  || $data[38]=='' || trim($data[38])=='-') $data[38]=0;
            $data[38] = trim(str_replace(',','.',$data[38]));
            if(is_null($data[39])  || $data[39]=='' || trim($data[39])=='-') $data[39]=0;
            if(is_null($data[40])  || $data[40]=='' || trim($data[40])=='-') $data[40]=0;
            $data[40] = trim(str_replace(',','.',$data[40]));
            if(is_null($data[41])  || $data[41]=='' || trim($data[41])=='-') $data[41]=0;
            if(is_null($data[42])  || $data[42]=='' || trim($data[42])=='-') $data[42]=0;
            if(is_null($data[43])  || $data[43]=='' || trim($data[43])=='-') $data[43]=0;
            if(is_null($data[44])  || $data[44]=='' || trim($data[44])=='-') $data[44]=0;
//            if(is_null($data[45])  || $data[45]=='') $data[45]=0;

            $data[10] = trim(str_replace(',','.',$data[10]));
            //$data[10] = trim(str_replace(' ','',$data[10]));
            $data[10] = preg_replace('/[^x\d|*\.]/', '', $data[10]);


//            $data[11] = preg_replace("/[^x\d|*\.]/", "", $data[11]);
            $data[11] = trim(str_replace(',','.',$data[11]));
            $data[11] = preg_replace("/[^x\d|*\.]/", "", $data[11]);
            $data[13] = trim(str_replace(',','.',$data[13]));
            $data[13] = preg_replace("/[^x\d|*\.]/", "", $data[13]);
            $data[15] = trim(str_replace(',','.',$data[15]));
            $data[15] = preg_replace("/[^x\d|*\.]/", "", $data[15]);
            $data[17] = trim(str_replace(',','.',$data[17]));
            $data[17] = preg_replace("/[^x\d|*\.]/", "", $data[17]);
            $data[18] = trim(str_replace(',','.',$data[18]));
            $data[18] = preg_replace("/[^x\d|*\.]/", "", $data[18]);
            $data[19] = trim(str_replace(',','.',$data[19]));
            $data[19] = preg_replace("/[^x\d|*\.]/", "", $data[19]);

            $data[21] = trim(str_replace(',','.',$data[21]));
            $data[21] = preg_replace("/[^x\d|*\.]/", "", $data[21]);
            $data[23] = trim(str_replace(',','.',$data[23]));
            $data[23] = preg_replace("/[^x\d|*\.]/", "", $data[23]);
            $data[25] = trim(str_replace(',','.',$data[25]));
            $data[25] = preg_replace("/[^x\d|*\.]/", "", $data[25]);
            $data[26] = trim(str_replace(',','.',$data[26]));
            $data[26] = preg_replace("/[^x\d|*\.]/", "", $data[26]);
            $data[27] = trim(str_replace(',','.',$data[27]));
            $data[27] = preg_replace("/[^x\d|*\.]/", "", $data[27]);

            $data[29] = trim(str_replace(',','.',$data[29]));
            $data[29] = preg_replace("/[^x\d|*\.]/", "", $data[29]);
            $data[31] = trim(str_replace(',','.',$data[31]));
            $data[31] = preg_replace("/[^x\d|*\.]/", "", $data[31]);
            $data[33] = trim(str_replace(',','.',$data[33]));
            $data[33] = preg_replace("/[^x\d|*\.]/", "", $data[33]);
            $data[34] = trim(str_replace(',','.',$data[34]));
            $data[34] = preg_replace("/[^x\d|*\.]/", "", $data[34]);
            $data[35] = trim(str_replace(',','.',$data[35]));
            $data[35] = preg_replace("/[^x\d|*\.]/", "", $data[35]);

            $data[37] = trim(str_replace(',','.',$data[37]));
            $data[37] = preg_replace("/[^x\d|*\.]/", "", $data[37]);
            $data[39] = trim(str_replace(',','.',$data[39]));
            $data[39] = preg_replace("/[^x\d|*\.]/", "", $data[39]);
            $data[41] = trim(str_replace(',','.',$data[41]));
            $data[41] = preg_replace("/[^x\d|*\.]/", "", $data[41]);
            $data[42] = trim(str_replace(',','.',$data[42]));
            $data[42] = preg_replace("/[^x\d|*\.]/", "", $data[42]);
            $data[43] = trim(str_replace(',','.',$data[43]));
            $data[43] = preg_replace("/[^x\d|*\.]/", "", $data[43]);
            $data[44] = trim(str_replace(',','.',$data[44]));
            $data[44] = preg_replace("/[^x\d|*\.]/", "", $data[44]);
//            $data[45] = trim(str_replace(',','.',$data[45]));
//            $data[45] = preg_replace("/[^x\d|*\.]/", "", $data[45]);
            if (empty($data[7]) || is_null($data[7])) $data[7]=0;

           // debug($data);
//            return;

            $sql = "INSERT INTO budget (vid_tmc1,page1,service1,name_obj1,dname_obj,vid_repair1,
                    name_spec1,lot,name_tmc,ed_izm1,price,
                    q_1,p_1,q_2,p_2,q_3,p_3,aq_1,ap_1,q_4,p_4,q_5,p_5,q_6,p_6,aq_2,ap_2,
                    q_7,p_7,q_8,p_8,q_9,p_9,aq_3,ap_3,q_10,p_10,q_11,p_11,q_12,p_12,aq_4,ap_4,
                    year_q,year_p) VALUES(".
                "'".$data[0]."'".",". '"'.$data[1]. '"'.",".'"'.$data[2]. '"'.",'".$data[3]. "'".",". '"'.$data[4].'",'.
                '"'.$data[5]. '"'.",". '"'.$data[6]. '"'.",". '"'.$data[7]. '"'.",".'"'.$data[8].'"'.",". '"'
                .$data[9]. '",'. $data[10]. ",".$data[11].",".$data[12].","
                .$data[13].",".$data[14].",".$data[15].",".$data[16].","
                .$data[17].",".$data[18].",".$data[19].",".$data[20].",".
                $data[21].",".$data[22].",".$data[23].",".$data[24].",".
                $data[25].",".$data[26].",".$data[27].",".$data[28].",".
                $data[29].",".$data[30].",".$data[31].",".$data[32].",".
                $data[33].",".$data[34].",".$data[35].",".$data[36].",".
                $data[37].",".$data[38].",".$data[39].",".$data[40].",".
                $data[41].",".$data[42].",".$data[43].",".$data[44].
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
        $f = fopen('obl.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            $data = explode(";",$s);
            if(!isset($data[1])) continue;

            $sql = "INSERT INTO _obl (smb,name) VALUES(".
                '$$'.$data[0].'$$'.",". '$$'.$data[1].'$$'.
                ')';

                Yii::$app->db_pg_in_energo->createCommand($sql)->execute();

        }

        fclose($f);

        echo "Інформацію записано";
    }

    // Импорт районов
    public function actionImp_region()
    {
        $f = fopen('region.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            $data = explode(";",$s);

            $sql = "INSERT INTO _region (smb,name_obl,id,name) VALUES(".
                '$$'.$data[0].'$$'.",". '$$'.$data[1].'$$'.",". $data[2].",".'$$'.$data[3].'$$'.
                ')';

            Yii::$app->db_pg_in_energo->createCommand($sql)->execute();

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
            $sql="CREATE TABLE tmp_street_e_in
                    (
                      town character varying(200),
                      id_city character varying(200),
                      type_street character varying(20),
                      streettypecode integer,
                      name_street character varying(200),
                      citycoid character varying(200)
                    )";
        //Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        $sql="CREATE TABLE tmp_street_e_ap
                    (
                      town character varying(200),
                      id_city character varying(200),
                      type_street character varying(20),
                      streettypecode integer,
                      name_street character varying(200),
                      citycoid character varying(200)
                    )";
        //Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        foreach($data_in as $in){
            $town = $in['town'];
            $id_city = $in['id_city'];
            $type_street = $in['type_street'];
            $streettypecode = $in['streettypecode'];
            $name_street = $in['name_street'];
            $citycoid = $in['citycoid'];
            $sql = "INSERT INTO tmp_street_e_in (town,id_city,type_street,streettypecode,name_street,citycoid) VALUES(".
                '$$'.$town.'$$'.","."'".$id_city."'".","."'".$type_street."'".",".$streettypecode.
                ",".'$$'.$name_street.'$$'.","."'".$citycoid."'".')';
            Yii::$app->db_pg_im_db->createCommand($sql)->execute();

            //debug($town);
        }
        foreach($data_ap as $ap){
            $town = $ap['town'];
            $id_city = $ap['id_city'];
            $type_street = $ap['type_street'];
            $streettypecode = $ap['streettypecode'];
            $name_street = $ap['name_street'];
            $citycoid = $ap['citycoid'];
            $sql = "INSERT INTO tmp_street_e_ap (town,id_city,type_street,streettypecode,name_street,citycoid) VALUES(".
                '$$'.$town.'$$'.","."'".$id_city."'".","."'".$type_street."'".",".$streettypecode.
                ",".'$$'.$name_street.'$$'.","."'".$citycoid."'".')';
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
        $sql="CREATE TABLE tmp_address_e_in
                    (
                      zip text,
                      streetcode integer,
                      locationhouse character varying(20),
                      locationapp character varying(20)
                    )";
       // Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        $sql="CREATE TABLE tmp_address_e_ap
                    (
                      zip text,
                      streetcode integer,
                      locationhouse character varying(20),
                      locationapp character varying(20)
                    )";
        //Yii::$app->db_pg_im_db->createCommand($sql)->execute();
        foreach($data_in as $in){
            $zip = $in['zip'];
            $streetcode = $in['streetcode'];
            if (is_null($streetcode)) $streetcode=0;
            $locationhouse = $in['locationhouse'];
            $locationapp = $in['locationapp'];

            $sql = "INSERT INTO tmp_address_e_in (zip,streetcode,locationhouse,locationapp) VALUES(".
                '$$'.$zip.'$$'.",".$streetcode.
                ",".'$$'.$locationhouse.'$$'.","."'".$locationapp."'".')';
           // Yii::$app->db_pg_im_db->createCommand($sql)->execute();

            //debug($town);
        }
        foreach($data_ap as $ap){
            $zip = $ap['zip'];
            $streetcode = $ap['streetcode'];
            if (is_null($streetcode)) $streetcode=0;
            $locationhouse = $ap['locationhouse'];
            $locationapp = $ap['locationapp'];

            $sql = "INSERT INTO tmp_address_e_ap (zip,streetcode,locationhouse,locationapp) VALUES(".
                '$$'.$zip.'$$'.",".$streetcode.
                ",".'$$'.$locationhouse.'$$'.","."'".$locationapp."'".')';
            Yii::$app->db_pg_im_db->createCommand($sql)->execute();

            //debug($town);
        }
        echo "Інформацію записано";
    }

    // Експорт в САП
    public function actionCek2sap()
    {
        $model = new export_sap();

        if ($model->load(Yii::$app->request->post()))
        {
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
                case 15:
                    return $this->redirect(['sap_seals2', 'res' => $model->rem]);
                    break;
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
            }
        }
        else {

            return $this->render('export_sap', [
                'model' => $model,
            ]);
        }
    }
    //формирование файлов индентификации данных ЦЕК в системе САП
public function actionIdfile()
        
    {
        $model = new export_sap();

        if ($model->load(Yii::$app->request->post()))
        {
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
            }
        }
        else {

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
        $rem = '0'.$res;  // Код РЭС

        $sql = "select distinct a.id,a.name,a.code_okpo,b.okpo_num,b.tax_num,'2' AS BU_TYPE,b.FLAG_JUR,
case when length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 then '03' else '02' end as BU_GROUP,
case when length(trim(coalesce (a.code_okpo, b.okpo_num)))=10 then '0003' else '0002' end as BPKIND,
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
UPPER(am.building) as HOUSE_NUM1,
UPPER(am.office) as HOUSE_NUM2,
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
	
kt.shot_name||' '||t.name as town,ads.town as town_sap,am.post_index,b2.post_index as post_index_sap,ks.shot_name||' '||s.name as street,ads.street as street_sap,
UPPER(am.building) as house,UPPER(am.office) as flat,
b.phone,b.e_mail
 from clm_client_tbl a
        left join clm_statecl_tbl b on
        a.id=b.id_client
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town
        LEFT JOIN addr_sap ads on ads.town=kt.shot_name||' '||t.name and ads.type_street||' '||get_street(ads.street)=ks.shot_name||' '||s.name
        LEFT JOIN post_index_sap b2 on ads.numtown=b2.numtown and b2.post_index::integer=am.post_index
        WHERE a.code_okpo<>'' and a.code_okpo<>'000000000'
        and a.code_okpo<>'0000000'
	    and a.code_okpo<>'000000'
   ";

        $sql_c = "select * from sap_export where objectsap='PARTNER' order by id_object";
        $zsql = 'delete from sap_init';
        $zsql1 = 'delete from sap_but000';
        $zsql2 = 'delete from sap_ekun';
        $zsql3 = 'delete from sap_but020';
        $zsql4 = 'delete from sap_but0id';
        $zsql5 = 'delete from sap_but021';


        if(1==1) {
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
        $fd=date('Ymd');
        $fname='PARTNER_04'.'_CK'.$rem.'_'.$fd.'_05'.'_L'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;
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

        $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();

        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
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
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }
        //формирование файла идентификации
        // Формирование файла partner для САП для юридических лиц
    public function actionIdfile_partner($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
        $filename = get_routine1($method);
        $sql = "select 'PARTER' as OM,oldkey,code,short_name,const.ver from sap_init as i 
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
                        $d1=array_slice($d1, 0, 4);                        
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
    
    
    

    public function actionCheck(){

        $r = hash('crc32', '111111111111111111111111111111111111111111111111111111111111111111111111111111111122');
        debug($r);
        $r = hash('crc32', '111111111111111111111111111111111111111111111111111111111111111111111111111111111121');
        debug($r);


    }

    // Формирование файла partner для САП для бытовых
    public function actionSap_partner_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '0');
        ini_set('upload_max_filesize', '0');
        ini_set('post_max_size', '1000M');
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
        if(substr($method,-4)=='_ind')
            $vid = 1;
        else
            $vid = 2;
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,10));

        $sql = "select a.id,a.activ,b.tax_number,b.last_name,
                b.name,b.patron_name,b1.town,c.town as town_cek,b2.post_index,c.indx as index_cek,
                case when b1.street is null then 'Неопределено' else b1.street end as street,c.street as street_cek,
                upper(c.house) as house,upper(c.korp) as korp,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id=b.id
        left join vw_address c on
        a.id=c.id
        left join addr_sap b1 on
        trim(lower(c.street))=trim(lower(get_sap_street(b1.street))) 
        and case when trim(lower(get_sap_street(b1.street)))='запорізьке шосе' then  lower(trim(c.type_street))='вул.'
        else lower(trim(c.type_street))=lower(trim(get_typestreet(b1.street))) end 
         and trim(lower(b1.town))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end ||' '||trim(lower(c.town))))
         left join post_index_sap b2 on b1.numtown=b2.numtown and b2.post_index=c.indx         
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region where a.archive='0'";

        $sql_c = "select * from sap_export where objectsap='PARTNER_IND' order by id_object";
        //$cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();
//        if(3==4) {
            // Получаем необходимые данные
            $data = data_from_server($sql, $res, $vid);
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
//        } // endif 3==4
        // Формируем имя файла и создаем файл
        $fname = date2file_Partner_ind($res,$vid);  // Быстрая функция для записи в файл

        if(1==2) {  // Так работала программа раньше - было существенно медленее
            $fd = date('Ymd');
            $fname = 'PARTNER_04' . '_CK' . $rem . '_' . $fd . '_07' . '_R' . '.txt';
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

        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл PARTNER_IND сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }

//        return $this->render('info', [
//            'model' => $model]);
    }
// Test
    public function actionTest_task(){
        $tel='0689732242 мама';
        $r=normal_tel($tel);
        echo $r;
    }
// Тестовая функция для записи в файл
    public function actionTest_recfile()
    {
        // Формируем имя файла и создаем файл
        $fd = date('Ymd');
        $fname = 'PARTNER_04_test.txt';
        $f = fopen($fname, 'w+');
        $i = 0;
        $vid=1;
        $res=4;
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
        $cnt = data_from_server($sql_c,$res,$vid);
// Тест
//        Получаем массивы полей всех структур
        $i=0;
        foreach ($cnt as $v) {
            $i++;
            $k=$i-1;
            $table_struct = 'sap_' . trim($v['dattype']);
            $z="select * from $table_struct limit 1";
            $mas = data_from_server($z,$res,$vid);
            $r='$struct'.$i.'=$mas[0];';
            eval($r);
        }

        $j=0;
//        debug($struct1);
//         debug($struct2);
//        debug($struct3);
//        debug($struct4);
//        debug($struct5);
//        return;

        foreach ($struct_data as $d) {
            $j=0;
            $old_key=$d['old_key'];
            foreach ($cnt as $v) {
                $j++;
                // Извлекаем список полей в структуре
                $data_p = extract_fields(${"struct".$j});
//                $d1 = array_map('trim', $data_p);
                $d1 = array_part($d,$data_p);
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

    public function actionIdfile_partner_ind($res,$par=0)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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

        if($par==0)
            return $this->render('info', [
                'model' => $model]);
//        else
//            return 1;
        
    }
    
    // Формирование файла пломб(seal) для САП для бытовых потребителей
    public function actionSap_seal_ind($res)
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
        $sql = "select distinct a.plomb_num as scode,coalesce(b.id_sap,'8') as place,coalesce(sp.short_name,'СЕЙФ-ПАКЕТ') as scat,a.id_type,a.dt_on,a.id,
                'I' as status,'3' as color,'C010099' as utmas,'C010099' as reper,
                substring(replace(a.dt_on::varchar, '-',''),1,8) as DPURCH,
                substring(replace(a.dt_on::varchar, '-',''),1,8) as dissue,
                substring(replace(a.dt_on::varchar, '-',''),1,8) as dinst,
                a.num_meter as sernr,d.matnr as matnr,const.ver,w.id_type_meter
                from clm_plomb_tbl a
                left join (select id_paccnt,num_meter,max(id_type_meter) as id_type_meter,max(work_period) as work_period 
                from clm_meterpoint_tbl group by id_paccnt,num_meter) w on w.id_paccnt=a.id_paccnt
                left join eqi_meter_tbl f on w.id_type_meter=f.id
                left join sap_plomb_place b on
                a.id_place=b.idcek::integer
                left join plomb_type c on
                a.id_type=c.id
                left join (select distinct id as id,sap_meter_id from sap_meter) s on s.id::integer=w.id_type_meter
                left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22 where sap_meter_id<>'') sd on s.sap_meter_id=sd.sap_meter_id
                left join sap_equi d on
                trim(w.num_meter)=trim(d.sernr) and trim(d.matnr)=trim(sd.sap_meter_name)
                inner join sap_const const on 1=1
                left join sap_plomb_name sp on sp.id_cek::integer=a.id_type
                where dt_off is null and length(a.plomb_num) <= 15 
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

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }
        else {
            // Выдаем предупреждение на экран об окончании формирования файла
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Erorr.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }
    }
    
     public function actionIdfile_seals_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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

        // Формирование файла пломб(seal) для САП для бытовых потребителей
        public function actionSap_instln_ind($res)
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
        $asd = [ "01" => 'BC010131',
                 "02" => 'BC010231',
                 "03" => 'BC010331',
                 "04" => 'BC010431',
                 "05" => 'BC010531',
                 "06" => 'BC010631',
                 "07" => 'BC010731',
                 "08" => 'BC010831', 
        ];
        // Получаем дату ab
        $sql_d="select (fun_mmgg() - interval '4 month')::date as mmgg_current";
        $data_d = data_from_server($sql_d,$res,$vid);
        $date_ab=$data_d[0]['mmgg_current'];
        // Главный запрос со всеми необходимыми данными
          $sql = "select a.id,'10' as sparte,'02' as spebene,'0002' as anlart,'0001' as ablesartst,
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
                ";

        if($helper==1)
            $sql = $sql.' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c,$res,$vid);  // Список структур

        // Включение режима помощника
        if($helper==1){
            $fhelper=$routine.'_HELPER'.'.txt';
            $ff = fopen($fhelper,'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var='$' . $k . '=$v'.'['."'".$k."']" ;
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i=0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var='if ($n_struct=='."'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "'." insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values .")".'";' ;
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
        $i=0;

        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_".strtolower($n_struct);
            exec_on_server($zsql,$res,$vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill='f_'.strtolower($routine).'($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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

    // Формирование файла монтажей INST_MGMT (юридические лица)
    public function actionSap_inst_mgmt($res)
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
//   Дальше идет плагиат - взято из выгрузки Чернигова
        $sql_p=" select (max(mmgg) + interval '1 month')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $period = $data_p[0]['mmgg'];  // Получаем текущий отчетный период
        $period = str_replace('-', '', $period);
    $sql="select distinct 'INST_MGMT' as name, c.id,c.code, eq.name_eqp,m.code_eqp as id_eq,
    '04_C'||'$rem'||'P_'||m.code_eqp as oldkey,const.ver
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
    and coalesce(c.id_state,0) not in (50,99,80,49,100)
    and sc.mmgg_b = (select max(mmgg_b) from clm_statecl_h as sc2 where sc2.id_client = sc.id_client and sc2.mmgg_b <= date_trunc('month', '$period'::date ) )  
    and sc.id_section not in (205,206,207,208,209,218) 
    and coalesce (use.id_client, tr.id_client) <> syi_resid_fun()
    and coalesce (use.id_client, tr.id_client)<>999999999
    order by 5";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
//        Формируем имя файла выгрузки
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');
        foreach($data as $v) {
//            fwrite($f, iconv("utf-8", "windows-1251", $v['name'] . "\t" .
//                    $v['oldkey'] . "\t" .
//                    $v['code'] . "\t" .
//                    $v['name_eqp'] . "\t" . "\n")
//            );
            $id_eq = $v['id_eq'];
            $id = $v['id'];
            $oldkey = $v['oldkey'];
            $sql_f = "select di_zw($id_eq , '$period')";
            $data_f = data_from_server($sql_f, $res, $vid);
            $sql_f = "select * from di_zw_struc order by knde,sort";
            $data_f = data_from_server($sql_f, $res, $vid);
            $devloc = '04_C04P_' . strtoupper(hash('crc32', $id));
            $sql_1 = "select distinct
                 '04_C'||'$rem'||'P_'||m.code_eqp::varchar  as oldkey,
                '$devloc' as devloc,
                'DI_INT' as struc,'$period' as eadat,
                 '04_C'||'$rem'||'P_01_'||eq.id::varchar as anlage,
                '01' as ACTION
                from eqm_meter_tbl as m
                join eqm_equipment_tbl as eq on (m.code_eqp = eq.id) 
                left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
                left join (select ins.code_eqp, eq3.id as id_area, eq3.name_eqp as area_name from eqm_compens_station_inst_tbl as ins join 
                eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = mp.id_point) 
                where m.code_eqp= $id_eq";
            $data_1 = data_from_server($sql_1, $res, $vid);
            // Запись в файл структуры DI_INT
            foreach ($data_1 as $v1) {
                fwrite($f, iconv("utf-8", "windows-1251", $v1['oldkey'] . "\t" .
                    $v1['struc'] . "\t" .
                    $v1['devloc'] . "\t" .
                    $v1['anlage'] . "\t" .
                    $v1['eadat'] . "\t" .
                    $v1['action'] . "\n"));
            }
            $c = 0;
            $c1 = '';
            // Запись в файл структуры DI_ZW


            foreach ($data_f as $v2) {
                $c = $c + 1;
                $c1 = '00' . "$c";
                fwrite($f, iconv("utf-8", "windows-1251", $oldkey . "\t" .
                    'DI_ZW' . "\t" . $c1 . "\t" .
                    $v2['kondigre'] . "\t" .
                    $v2['zwstandce'] . "\t" .
                    $v2['zwnabr'] . "\t" .
                    $v2['tarifart'] . "\t" .
                    $v2['perverbr'] . "\t" .
                    $v2['equnre'] . "\t" .
                    $v2['anzdaysofperiod'] . "\t" .
                    $v2['pruefkla'] . "\n"));
            }

            $sql_2 = "select distinct 
                '04_C'||'$rem'||'P_'||m.code_eqp::varchar  as oldkey,
                'DI_GER' as struc,
                case when grp.code_t_new is null then 
                    '04_C'||'$rem'||'P_'||m.code_eqp::text else  '04_C'||'$rem'||'P_'||grp.code_t_new end as EQUNRNEU,
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
                left join group_trans as grp on grp.id_meter=m.code_eqp
                where m.code_eqp= $id_eq and sti.id_comp is not null and grp.code_t_new is not null";
            $data_2 = data_from_server($sql_2, $res, $vid);
            // Запись в файл структуры DI_GER
            foreach ($data_2 as $v2) {
                fwrite($f, iconv("utf-8", "windows-1251", $v2['oldkey'] . "\t" .
                    $v2['struc'] . "\t" .
                    $v2['equnrneu'] . "\n"));
            }
            $sql_3 = "select distinct 
                    '04_C'||'$rem'||'P_'||m.code_eqp::varchar  as oldkey,
                    'DI_GER' as struc,
                    '04_C'||'$rem'||'P_'||m.code_eqp::text  as EQUNRNEU,
                    '04_C'||'$rem'||'P_'||grp.code_t_new as met_id,
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
                    left join group_trans as grp on grp.id_meter=m.code_eqp
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

        // Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл INST_MGMT сформовано.";
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

        $sql="select distinct 'DEVGRP' as name, c.id,c.code,e.name_eqp,eq.id_point as id_eq,const.ver
        from group_trans as eq
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
            where  c.book=-1 and c.idk_work not in (0) and coalesce(c.id_state,0) not in (50,99,80,49,100) and sc.id_section not in (205,206,207,208,209,218) and c.id <> syi_resid_fun() and c.id <>999999999 and eq.code_t_new is not null
            order by 5";
        // Получаем необходимые данные
        $data = data_from_server($sql, $res, $vid);
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
//        Формируем имя файла выгрузки
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');
        $oldkey_const='04_C'.$rem.'B_';
        foreach($data as $v) {
            $id_eq = $v['id_eq'];
            $id = $v['id'];
            $oldkey = $oldkey_const . $id;
            $oldkey1= '04_C'.$rem.'P_';
            $sql_1="select  distinct  eq.id_point ,
'EDEVGR' as n_struct,
case when coalesce(zz.clas,'')='0,38'  then '0002'  else '0003' end as devgrptyp,
'$period'  as keydate, 
'' as dop,
'1' as sort
from group_trans as eq
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
            (select mt.id_meter, type_tr.clas as clas from
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
                where type_tr.id_type is not null
) as zz on zz.id_meter=sti.id_meter
                where eq.id_point= $id_eq and eq.code_t_new is not null
    
union
--eq.code_t_new
select  distinct  eq.id_point,
'DEVICE' as n_struct,
'$oldkey1' || eq.code_t_new as devgrptyp,
 '' as  keydate, 
''  as dop,
'2' as sort
from group_trans as eq
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
                --left join sap_type_tr_u_tbl as type_tr_u on type_tr_u.id_type = sti.id_type_tr
               where eq.id_point = $id_eq and eq.code_t_new is not null
order by sort";

            $data_1 = data_from_server($sql_1, $res, $vid);

//            debug($data_1);
//            return;
            // Запись в файл структуры DI_INT
            foreach ($data_1 as $v1) {
                   $oldkey2 = $oldkey1 . $v1['id_point'];
                    fwrite($f, iconv("utf-8","windows-1251",$oldkey2."\t".
                    $v1['n_struct']."\t".
                    $v1['devgrptyp']."\t".
                    $v1['keydate']."\n") );

            }
            fwrite($f, $oldkey2."\t".
                $end."\n");
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
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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

        $sql_p=" select (max(mmgg) + interval '1 month')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $period = $data_p[0]['mmgg'];  // Получаем текущий отчетный период

        // Получаем дату ab
        $sql_d=" select (max(mmgg) - interval '3 month')::date as mmgg_current from sys_month_tbl";
        $data_d = data_from_server($sql_d,$res,$vid);
        $date_ab=$data_d[0]['mmgg_current'];

        // Главный запрос со всеми необходимыми данными
        $sql = "select distinct on(zz_eic) case when qqq.oldkey is null then trim(yy.oldkey) else trim(qqq.oldkey) end as vstelle,
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
'$date_ab' as AB,
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
from (select dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
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
left join sap_evbsd yy on substr(yy.haus,9)::integer=qqq.id_potr
left join clm_client_tbl www on www.id=qqq.id_potr
inner join sap_const const on 1=1";

        if($helper==1)
            $sql = $sql.' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c,$res,$vid);  // Список структур

        // Включение режима помощника
        if($helper==1){
            $fhelper=$routine.'_HELPER'.'.txt';
            $ff = fopen($fhelper,'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var='$' . $k . '=$v'.'['."'".$k."']" ;
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i=0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var='if ($n_struct=='."'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "'." insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values .")".'";' ;
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
        $i=0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_".strtolower($n_struct);
            exec_on_server($zsql,$res,$vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill='f_'.strtolower($routine).'($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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

    // Формирование файла линий(zlines) для САП для юридических потребителей
    public function actionSap_zlines($res)
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

        // Главный запрос со всеми необходимыми данными
        $sql = "select p.id_point, p2.name_point, p.code_eqp, p.name, p.lvl, p.type_eqp, RANK() OVER(PARTITION BY p.id_point ORDER BY p.lvl desc) as pnt, 
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
                left join sap_lines as v on v.id=cable.id and v.kod_res=$res
                inner join sap_const const on 1=1   
                where p.type_eqp not in (1,12,3,4,5,9,15,16,17) and p.loss_power=1  and  p.type_eqp<>2
                order by p.id_point, p.lvl desc";

        if($helper==1)
            $sql = $sql.' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c,$res,$vid);  // Список структур

        // Включение режима помощника
        if($helper==1){
            $fhelper=$routine.'_HELPER'.'.txt';
            $ff = fopen($fhelper,'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var='$' . $k . '=$v'.'['."'".$k."']" ;
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i=0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var='if ($n_struct=='."'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "'." insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values .")".'";' ;
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
        $i=0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_".strtolower($n_struct).'_zlines';

            exec_on_server($zsql,$res,$vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill='f_'.strtolower($routine).'($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct"."_zlines";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']).'_zlines';
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $model->info1 = "Файл ZLINES сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }

    // Формирование файла трансформаторов (ztransf) для САП для юридических потребителей
    public function actionSap_ztransf($res)
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

        // Главный запрос со всеми необходимыми данными
        $sql = "select p.id_point, p2.name_point, p.code_eqp, p.name, p.lvl, p.type_eqp, RANK() OVER(PARTITION BY p.id_point ORDER BY p.lvl desc) as pnt, 
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
                left join sap_transf as v on (v.id::int=eqk.id and v.kod_res=$res)
                inner join sap_const const on 1=1   
                where p.type_eqp not in (1,12,3,4,5,9,15,16,17) and p.loss_power=1 and  p.type_eqp=2
                order by p.id_point, p.lvl desc";

        if($helper==1)
            $sql = $sql.' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c,$res,$vid);  // Список структур

        // Включение режима помощника
        if($helper==1){
            $fhelper=$routine.'_HELPER'.'.txt';
            $ff = fopen($fhelper,'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var='$' . $k . '=$v'.'['."'".$k."']" ;
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i=0;

            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var='if ($n_struct=='."'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "'." insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values .")".'";' ;
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
        $i=0;
         foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_".strtolower($n_struct).'_ztransf';
            exec_on_server($zsql,$res,$vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill='f_'.strtolower($routine).'($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct".'_ztransf';
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']).'_ztransf';
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $model->info1 = "Файл ZTRANSF сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }

    // Формирование файла facts для САП для юридических потребителей
    public function actionSap_facts($res)
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

        // Главный запрос со всеми необходимыми данными
        if(1==2) {
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

        $sql = "select distinct eq2.num_eqp as ncnt,p.num_eqp,eerm.eerm,p.code_eqp as id,p.name_eqp,
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

        if($helper==1)
            $sql = $sql.' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массив $facts
        $i=0;
        foreach ($data as $w) {
                $facts[$i]=f_facts($rem,$w);
                $i++;
         }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

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

    // Формирование файла facts для САП для бытовых потребителей
    public function actionSap_facts_ind($res)
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
        $asd = [ "01" => 'BC010131',
            "02" => 'BC010231',
            "03" => 'BC010331',
            "04" => 'BC010431',
            "05" => 'BC010531',
            "06" => 'BC010631',
            "07" => 'BC010731',
            "08" => 'BC010831',
        ];
        // Получаем дату ab
        $sql_d="select (fun_mmgg() - interval '4 month')::date as mmgg_current";
        $data_d = data_from_server($sql_d,$res,$vid);
        $date_ab=$data_d[0]['mmgg_current'];

        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select facts.id,facts.power,max(facts.plita) as plita,max(facts.opal) as opal,max(facts.mmgg) as mmgg,
max(facts.mmgg_end) as mmgg_end,facts.ver,max(facts.dem_0) as dem_0,max(facts.dem_9) as dem_9,
max(facts.dem_10) as dem_10,max(facts.dem_6) as dem_6,max(facts.dem_7) as dem_7,max(facts.dem_8) as dem_8 from
(select distinct id,power,plita,opal,max(mmgg-interval '0 month')::date as mmgg,
(mmgg_end-interval '0 month')::date as mmgg_end,ver,sum(dem_0) as dem_0,sum(dem_9) as dem_9,
sum(dem_10) as dem_10,sum(dem_6) as dem_6,sum(dem_7) as dem_7,sum(dem_8) as dem_8 from
(select q.* from (
select a.id_paccnt as id,b.dt_b,case when a.id_zone=0 then demand end as dem_0,
case when a.id_zone=9 then demand end as dem_9,
case when a.id_zone=10 then demand end as dem_10,
case when a.id_zone=6 then demand end as dem_6,
case when a.id_zone=7 then demand end as dem_7,
case when a.id_zone=8 then demand end as dem_8,
max(a.mmgg) OVER (PARTITION BY a.id_paccnt,a.id_zone) as mmgg,(max(a.mmgg) OVER (PARTITION BY a.id_paccnt,a.id_zone)+interval '1 month'-interval '1 day') as mmgg_end,b.power,
case when c.id_gtar in(3,5,16) then 1 end as plita,
case when c.id_gtar in(4,6,14) then 1 end as opal,const.ver
from clm_meterpoint_tbl b 
left join clm_plandemand_tbl a on a.id_paccnt=b.id_paccnt
join clm_paccnt_tbl c on c.id=a.id_paccnt and c.archive='0'
left join (select (fun_mmgg() - interval '1 month')::date as mmgg_current) w1
on 1=1
inner join (select id_paccnt,max(mmgg) as mmgg,id_zone,max(dat_ind) as dat_ind from acm_indication_tbl 
group by id_paccnt,id_zone) j on j.id_paccnt=a.id_paccnt --and j.mmgg=w1.mmgg_current
 and j.id_zone=a.id_zone
inner join sap_const const on 1=1
--where a.mmgg=w1.mmgg_current 
order by a.id_paccnt
) q
left join 
(select (fun_mmgg() - interval '1 month')::date as mmgg_current) w
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
                where a.archive='0') instln on
                facts.id=instln.id
                group by facts.id,facts.power,facts.ver
                order by facts.id
";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массив $facts
        $i=0;
        foreach ($data as $w) {
            $facts[$i]=f_facts_ind($rem,$w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

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
        fclose($f);
        // Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }

//        return $this->render('info', [
//            'model' => $model]);
    }
    
        //выгрузка ид фалов сап факты , для бытовых потребителей
        public function actionIdfile_facts_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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
    public function actionSap_inst_mgmt_ind($res)
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
        $sql = "select id,sum(value_0) as value_0,
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
(select distinct a.id_paccnt as id,
case when a.id_zone=0 then a.value else 0.0000 end as value_0,
case when a.id_zone=9 then a.value else 0.0000 end as value_9,
case when a.id_zone=10 then a.value else 0.0000 end as value_10,
case when a.id_zone=6 then a.value else 0.0000 end as value_6,
case when a.id_zone=7 then a.value else 0.0000 end as value_7,
case when a.id_zone=8 then a.value else 0.0000 end as value_8,
a.dat_ind,
'04_C'||$$$rem$$||'B_'||a.id_paccnt as devloc,'04_C'||$$$rem$$||'B_01_'||a.id_paccnt as anlage,
'04_C'||$$$rem$$||'B_'||m.id as equnre,
'01' as action,
 case when a.id_zone=0 then p.demand else 0 end demand_0,
 case when a.id_zone=9 then p.demand else 0 end demand_9,
  case when a.id_zone=10 then p.demand else 0 end demand_10,
  case when a.id_zone=6 then p.demand else 0 end demand_6,
  case when a.id_zone=7 then p.demand else 0 end demand_7,
  case when a.id_zone=8 then p.demand else 0 end demand_8,
 (w1.mmgg_current + interval '1 month')::date as  eadat,const.ver,
 case when a.id_zone=0 then 0 
 when a.id_zone in(9,10) then 9
 when a.id_zone in(6,7,8) then 6
 end as zone
 from acm_indication_tbl a 
inner join
(select max(dat_ind) as dat_ind,id_paccnt,id_zone,id_typemet from acm_indication_tbl group by id_paccnt,id_zone,id_typemet) b on
a.id_paccnt=b.id_paccnt and a.id_zone=b.id_zone and a.dat_ind=b.dat_ind
inner join (select  b.id_zone,a.id_paccnt,a.id_type_meter from clm_meterpoint_tbl a
left join clm_meter_zone_h b on a.id=b.id_meter) d  on d.id_paccnt=b.id_paccnt and d.id_type_meter=b.id_typemet and d.id_zone=b.id_zone
inner join clm_paccnt_tbl c on a.id_paccnt=c.id and c.archive='0'
--left join sap_egpld devloc on devloc.oldkey='04_C04B_'||a.id_paccnt
left join (select (fun_mmgg() - interval '1 month')::date as mmgg_current) w1
on 1=1
left join clm_meterpoint_tbl m on m.id_paccnt=a.id_paccnt 
left join clm_plandemand_tbl p on p.id_paccnt=a.id_paccnt and p.id_zone=a.id_zone and p.mmgg=w1.mmgg_current 
inner join sap_const const on 1=1
where a.id_operation<>5 order by 1) t
group by 1,9,10,11,12,13,20,21,22
order by 1";
        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i=0;
        foreach ($data as $w) {
            $di_int[$i]=f_inst_mgmt1_ind($rem,$w);
            $di_zw[$i]=f_inst_mgmt2_ind($rem,$w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с массивов $di_int и $di_zw
        $i=0;
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
        fclose($f);

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
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
    }

    // Формирование файла imove_in для САП для бытовых потребителей
    public function actionSap_move_in_ind($res)
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
        $sql = "select a.id,b.num_agreem as vrefer,'01' as kofiz,1 as gemfakt,const.begru as bukrs,const.begru_b as begru,const.ver,
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
left join (select (fun_mmgg() - interval '1 month')::date as mmgg_current) w1 on 1=1
where a.archive='0'		       
";
        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i=0;
        foreach ($data as $w) {
            $ever[$i]=f_move_in_ind($rem,$w);
//            $ever1[$i]=f_move_in_ind1($rem,$w);
            $i++;
        }

//        debug($ever);
//        return;

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с массивов $di_int и $di_zw
        $i=0;
        foreach ($ever as $d) {
            $d1 = array_map('trim', $d);
//            debug($d1);
//            return;
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0]."\t".'&ENDE');
            fputs($f, "\n");
        }

        fclose($f);

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
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
    }


// Формирование файла move_in для САП для юрид. потребителей
    public function actionSap_move_in($res)
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

        $sql_p=" select (max(mmgg) + interval '1 month')::date as mmgg from sys_month_tbl";
        $data_p = data_from_server($sql_p, $res, $vid);
        $period = str_replace('-','',$data_p[0]['mmgg']);  // Получаем текущий отчетный период
        //  Главный запрос со всеми необходимыми данными из PostgerSQL SERVER
        $sql = "select const.opbuk as bukrs,stt.doc_num as vrefer,
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
(select distinct on(zz_eic) case when qqq.oldkey is null then trim(yy.oldkey) else trim(qqq.oldkey) end as vstelle,
www.short_name as real_name,const.ver,const.begru,
'10'::text as sparte,qqq.* from
(select distinct on(q1.num_eqp) q1.id,x.oldkey,cc.short_name,
case when q.id_cl=2062 then rr.id_client else q.id_cl end as id_potr,
q1.num_eqp as zz_eic,q.* from
(select  distinct 'DATA' as DATA,c.id as id_cl,p.dt_b,
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
from (select dt.power,dt.connect_power, dt.id_tarif, tr.id_classtarif, dt.industry,dt.count_lost, dt.in_lost,dt.d, dt.wtm,dt.share,dt.id_position, cp.num_tab, dt.id_tg, p.val as kwedname,p.kod as kwedcode, tr.name as tarifname , tg.name as tgname, dt.id_voltage, 
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
left join sap_evbsd yy on substr(yy.haus,9)::integer=qqq.id_potr
left join clm_client_tbl www on www.id=qqq.id_potr
inner join sap_const const on 1=1) tt
left join clm_statecl_tbl as stt on (stt.id_client = tt.id_cl) 
left join clm_client_tbl as cc2 on (tt.id_cl = cc2.id) 
left join (select * from clm_contractor_tbl where dt_contr_end is null) ct on ct.id_client=cc2.id
left join cli_contractor_tbl ci on ci.id=ct.id_contractor and ci.edrpou_contr is not null 
inner join sap_const const on 1=1
order by 8,zz_point_num,zz_plosch_num,zz_object_num
";
        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i=0;
        foreach ($data as $w) {
            $ever[$i]=f_move_in($rem,$w);
//            $ever1[$i]=f_move_in_ind1($rem,$w);
            $i++;
        }

//        debug($ever);
//        return;

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с массивов $di_int и $di_zw
        $i=0;
        foreach ($ever as $d) {
            $d1 = array_map('trim', $d);
//            debug($d1);
//            return;
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0]."\t".'&ENDE');
            fputs($f, "\n");
        }

        fclose($f);

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }

        // Выдаем предупреждение на экран об окончании формирования файла
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл MOVE_IN сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";
        return $this->render('info', [
            'model' => $model]);
    }

    //выгрузка ид фалов сап imove_in , для бытовых потребителей
        public function actionIdfile_move_in_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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
        for ($i = 0; $i < 2; $i++) {
           // $this->redirect([$actions[$i], 'res' => $res]);
            $r=Yii::$app->response->redirect([$actions[$i],  'res' => $res,'par' => 1])->send();
            fputs($f,'Сформирован файл ' . $actions[$i] . '_ext');
            fputs($f,"\n");
        }
        fclose($f);
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файли _ext сформовано.";
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
        $sql = "select distinct 
        p.id,'AUTO' as AUTO, 
        p.id_type as SCAT,
        --t_p.kateg_sap as SCAT,
        trim(p.plomb_num) as SCODE,
        'I' as STATUS,
        '3' as COLOR,
        '' as UTMAS, 
        substring(replace(p.dt_b::varchar, '-',''),1,8) as DPURCH,
        '' as REPER,
        substring(replace(p.dt_b::varchar, '-',''),1,8) as DISSUE,
        u.matnr as MATNR,
        u.sernr as SERNR,
        --coalesce(obj.id_sap,8) as PLACE,
        left(p.object_name,8) as PLACE,
        substring(replace(p.dt_b::varchar, '-',''),1,8) as DINST,const.ver
        from clm_plomb_tbl as p 
        left join cli_plomb_type_tbl as t on (t.id = p.id_type) 
        left join clm_position_tbl as cp on (cp.id = p.id_position) 
        left join clm_position_tbl as cp2 on (cp2.id = p.id_person) 
        left join clm_client_tbl as c on (c.id = p.id_client ) 
        left join clm_statecl_tbl as st on st.id_client = c.id
        left join eqm_equipment_h as eq on (eq.id = p.id_point) 
        left join adv_address_tbl as adr on (adr.id = eq.id_addres ) 
         inner join sap_const const on 1=1
         left join (select oldkey,get_tu(substr(oldkey,9)::integer) as id_tu,matnr,sernr from sap_equi) u on u.id_tu=eq.id
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
        $i=0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_".strtolower($n_struct);
            exec_on_server($zsql,$res,$vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill='f_'.strtolower($routine).'($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
    
    
public function actionIdfile_seals($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
        $filename = get_routine1($method);

        $sql = "select 'SEALS' as OM,oldkey,p.code,p.short_name as name_tu,const.ver from sap_AUTO as a
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
                        $d1=array_slice($d1, 0, 4);                        
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

        if($helper==1)
            $sql = $sql.' LIMIT 1';

        // Запрос для получения списка необходимых
        // для экспорта структур

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c,$res,$vid);  // Список структур

        // Включение режима помощника
        if($helper==1){
            $fhelper=$routine.'_HELPER'.'.txt';
            $ff = fopen($fhelper,'w+');
            // Создание переменных
            foreach ($data as $v) {
                foreach ($v as $k => $v1) {
                    $var='$' . $k . '=$v'.'['."'".$k."']" ;
                    fputs($ff, $var);
                    fputs($ff, "\n");

                }
            }
            $i=0;
            foreach ($cnt as $v) {
                $i++;
                $n_struct = trim($v['dattype']);
                fputs($ff, "\n");
                $var='if ($n_struct=='."'$n_struct') {";
                fputs($ff, $var);
                fputs($ff, "\n");
                //Создание строки INSERT
                $columns = gen_column_insert('sap_' . strtolower($n_struct), (int)$rem, 1);
                $values = gen_column_values('sap_' . strtolower($n_struct), (int)$rem, 1);
//                $z = "        insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . " values(" . $values . ")";
                $z = '     $z = "'." insert into sap_" . strtolower($n_struct) . "(" . $columns . ")" . "  values(" . $values .")".'";' ;
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
        $i=0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_".strtolower($n_struct);
            exec_on_server($zsql,$res,$vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill='f_'.strtolower($routine).'($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
                        $d1=array_slice($d1, 0, 4);                        
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
    public function actionSap_connobj_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
        if(substr($method,-4)=='_ind')
            $vid = 1;
        else
            $vid = 2;

        // Главный запрос со всеми необходимыми данными
        $sql = "select min(a.id) as id,
                c.town,b1.town as town_sap,c.street,
                case when b1.street is null then 'Неопределено' else b1.street end as street_sap,c.type_street,
                case when c.korp is null then upper(c.house) else 
                case when NOT(c.korp ~ '[0-9]+$')  then upper(trim(c.house))||trim(c.korp) 
--               else c.house||'/'||c.korp end end as house
                else c.house end end as house
                ,const.id_res,
                const.swerk,const.stort,const.ver,const.begru,
                const.region,d.kod_reg,
                case when b1.street is null then c.street else '' end as str_supl1,
                case when b1.street is null then c.house else '' end as str_supl2,
                case when NOT(c.korp ~ '[0-9]+$') then '' else c.korp end as korp,
                c.korp 
                 from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id=b.id
        left join vw_address c on
        a.id=c.id
        left join addr_sap b1 on
         trim(lower(c.street))=trim(lower(get_sap_street(b1.street))) 
        and case when trim(lower(get_sap_street(b1.street)))='запорізьке шосе' then  lower(trim(c.type_street))='вул.'
        else lower(trim(c.type_street))=lower(trim(get_typestreet(b1.street))) end 
         and trim(lower(b1.town))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end ||' '||trim(lower(c.town))))
         
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region
        where a.archive='0' -- and a.id=100033028 --and  b1.street is null
        group by 2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18 
        order by 5,7
        ";

//    debug($sql);
//    return;

        $sql_c = "select * from sap_export where objectsap='CONNOBJ_IND' order by id_object";

        if(1==1) {
            // Получаем необходимые данные
            $data = data_from_server($sql,$res,$vid);
            $cnt = data_from_server($sql_c,$res,$vid);

            // Удаляем данные в таблицах
            $zsql = 'delete from sap_co_eha';
            $zsql1 = 'delete from sap_co_adr';
            exec_on_server($zsql,$res,$vid);
            exec_on_server($zsql1,$res,$vid);

            $i = 0;
            // Заполняем структуры
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
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='CONNOBJ_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_R'.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_co_eha";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                      $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос

                    foreach ($cur_data as $d1) {
                        if(strtolower($table_struct)=='sap_co_adr')
                            $d1=array_slice($d1, 0, 10);
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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

    // Формирование файла account для САП для бытовых
    public function actionSap_account_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 4000);
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

        // Главный запрос со всеми необходимыми данными
        $sql = "select s1.*,s2.*
                from
                --INIT
                (select 'INIT' as struct,a.id,a.code as vkona,
                const.vktyp as vktyp,'04_C'||$$$rem$$||'B_'||a.id as gpart,const.ver
                from clm_paccnt_tbl as a
                left join clm_abon_tbl as b on a.id = b.id
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
                left join clm_abon_tbl as b on a.id = b.id
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
";

            // Запрос для получения списка необходимых
            // для экспорта структур
            $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

            // Получаем необходимые данные
            $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных
            $cnt = data_from_server($sql_c,$res,$vid);  // Список структур

            // Удаляем данные в таблицах
            $zsql = 'delete from sap_init_acc';
            $zsql1 = 'delete from sap_vkp';
            $zsql2 = 'delete from sap_vk';
            exec_on_server($zsql,$res,$vid);
            exec_on_server($zsql1,$res,$vid);
            exec_on_server($zsql2,$res,$vid);

            // Заполняем структуры
            foreach ($data as $w) {
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    f_account_ind($n_struct, $rem, $w, $vid);  // Функция заполнения структур
                }
            }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_init_acc";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос

        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }
//        return $this->render('info', [
//            'model' => $model]);
    }
    
    //формирование файла идентификации
        // Формирование файла account для САП для бытовых абонентов
    public function actionIdfile_account_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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
        $day=((int) date('d'))-1;  // УЧЕСТЬ!!!! ДАЛЬШЕ
        $datab = date('Ymd', strtotime("-$day day")); // УЧЕСТЬ!!!! ДАЛЬШЕ

     // Получаем дату datab
        $sql_d=" select (max(mmgg) - interval '3 month')::date as mmgg_current from sys_month_tbl";
        $data_d = data_from_server($sql_d,$res,$vid);
        $date_ab=$data_d[0]['mmgg_current'];
        // Главный запрос со всеми необходимыми данными
        $sql = "select * from 
(select distinct m.code_eqp as id,id_type_eqp,s.sap_meter_id,case when length(m.code_eqp::varchar)<8 then 
                 (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(m.code_eqp::varchar)::int)),(7-(length(m.code_eqp::varchar)::int)))||m.code_eqp::varchar)::int else m.code_eqp end  as OLDKEY,
                'EQUI' as EQUI,
                case when eq.is_owner = 1 then '4002' else '4001' end   EQART, 
                 substring(m.dt_control::varchar,1,4) as BAUJJ, 
                '$date_ab' as datab,
                 '' as EQKTX,
                case when m.dt_control is null then '2005' else substring(m.dt_control::varchar,1,4)  end as bgljahr,
                case  when coalesce(eq.is_owner,0) = 0 then 'CCNN232820' else '' end as KOSTL, 
                 trim(eq.num_eqp) as SERNR,
                 'CK_RANDOM' as zz_pernr,
                  substring(replace(m.dt_control::varchar,'-',''),1,8) as CERT_DATE,
                  sd.sap_meter_name as matnr,
                 case when en1.kind_energy =1 then case when eqz1.zone in (4,5,9,10) then '2' when eqz1.zone in (1,2,3,6,7,8) then '3' when  eqz1.zone = 0 then '1' else '0' end ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||'0'::varchar||')' else '0_(000)' end||
case when en2.kind_energy =3 then case when eqz2.zone in (4,5,9,10) then '2' when eqz2.zone in (1,2,3,6,7,8) then '3' when  eqz2.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||'0'::varchar||')' else '0_(000)' end||
case when en3.kind_energy =2 then case when eqz3.zone in (4,5,9,10) then '2' when eqz3.zone in (1,2,3,6,7,8) then '3' when  eqz3.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||'0'::varchar||')' else '0_(000)' end||
case when en4.kind_energy =4 then case when eqz4.zone in (4,5,9,10) then '1' when eqz4.zone in (1,2,3,6,7,8) then '1' when  eqz4.zone = 0 then '1' else '0' end  ||'_(' || case when t.carry<10 then '0' else '1' end ||case when t.carry< 10 then t.carry::varchar else '0' end ||'0'::varchar||')' else '0_(000)' end as ZWGRUPPE,
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
                left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy=1 and dt_e is null) as en1 on en1.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy=3 and dt_e is null) as en2 on en2.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy in(2,5) and dt_e is null) as en3 on en3.code_eqp = m.code_eqp
		left join (select kind_energy, code_eqp from eqd_meter_energy_h where kind_energy in(6,4) and dt_e is null) as en4 on en4.code_eqp = m.code_eqp
                inner join sap_const const on 1=1
union                

select distinct gr.code_t_new::int as id,0 as id_type_eqp,'' as sap_meter_id,c.code_eqp as OLDKEY,
                'EQUI' as EQUI,
                case when eq.is_owner = 1 then '4002' else case when ic.conversion=1 then  '4004' else '4006' end  end EQART,
                '' as BAUJJ, 
                '' as datab,
                 '' as EQKTX,
                 '' as bgljahr,
                case  when coalesce(eq.is_owner,0) = 0 then 'CCNN232820' else '' end as KOSTL, 
                 --trim(eq.num_eqp) as SERNR,
                  get_element_str(trim(eq.num_eqp),row_number() OVER (PARTITION BY c.code_eqp)::int) as sernr,
                 'CK_RANDOM' as zz_pernr,
                  '' as CERT_DATE,
                  upper(type_tr.type_tr_sap) as MATNR,
                  '' as zwgruppe,
                  type_tr.group_ob as WGRUPPE,
                  const.swerk,const.stort,const.ver,const.begru_b as begru,2 as tzap
                 from group_trans as gr
                 join eqm_compensator_i_tbl as c on c.code_eqp=gr.code_tt::int
		    join eqm_equipment_tbl as eq on (eq.id =c.code_eqp ) 
		    left join eqm_equipment_h as hm on (hm.id = c.code_eqp) and hm.dt_b = (
		    select dt_b from eqm_equipment_h where id = eq.id 
		    and trim(coalesce(num_eqp,'')) = trim(coalesce(eq.num_eqp,''))  and dt_e is null order by dt_b desc limit 1 )
		    join eqi_compensator_i_tbl as ic on (ic.id = c.id_type_eqp) 
		    left join sap_type_tr_i_tbl as type_tr on type_tr.id_type = ic.id 
                    inner join sap_const const on 1=1 ) x
order by tzap   
";

        // Запрос для получения списка необходимых
        // для экспорта структур
        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных
        $cnt = data_from_server($sql_c,$res,$vid);  // Список структур

//debug($data);
//return;

        // Удаляем данные в таблицах структур
        $i=0;
        foreach ($cnt as $v) {
            $i++;
            $n_struct = trim($v['dattype']);
            if($i==1) $first_struct=trim($n_struct);   // Узнаем имя таблицы первой структуры
            $zsql = "delete from sap_".strtolower($n_struct);
            exec_on_server($zsql,$res,$vid);
        }

        // Заполняем структуры
        foreach ($data as $w) {
            foreach ($cnt as $v) {
                $n_struct = trim($v['dattype']);
                $func_fill='f_'.strtolower($routine).'($n_struct, $rem, $w, $vid);'; // Функция заполнения структур
                eval($func_fill);
            }
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');

        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_$first_struct";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос
                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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

    //формирование файла идентификации
        // Формирование файла device для САП для ЮР.лиц
    public function actionIdfile_device($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
        $filename = get_routine1($method);

        $sql = "select om,oldkey,sernr,qui.code,const.ver from (
                select f.*,u1.code from (
                select 'DEVICE' as OM,a.oldkey,a.sernr,get_tu(eq.id) as tu from sap_equi as a
                join eqm_equipment_tbl as eq on (substr(a.oldkey,9)::int = eq.id)
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
                        $d1=array_slice($d1, 0, 4);                        
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
    public function actionSap_devloc_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
        if(substr($method,-4)=='_ind')
            $vid = 1;
        else
            $vid = 2;
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,10));

        // Главный запрос со всеми необходимыми данными
        $sql = "select a.id,b.haus as haus,b.oldkey as vstelle,const.swerk,
                  const.stort,const.begru_b as begru,const.ver
                from clm_paccnt_tbl as a
                left join sap_evbsd b on b.oldkey='04_C'||$$$rem$$||'B_'||a.id
                inner join sap_const const on 1=1
                where a.archive='0' ";

        $sql_c = "select * from sap_export where objectsap='$routine' order by id_object";

        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);
        $cnt = data_from_server($sql_c,$res,$vid);

        // Удаляем данные в таблицах
        $zsql = 'delete from sap_egpld';
        exec_on_server($zsql,$res,$vid);

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
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='DEVLOC_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_R'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $sql = "select * from sap_egpld";
        $struct_data = data_from_server($sql,$res,$vid); // Выполняем запрос
        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
                    $all=gen_column($table_struct,$res,$vid); // Получаем все колонки таблицы
                    $sql = "select $all from $table_struct where oldkey='$old_key'";
                    $cur_data = data_from_server($sql,$res,$vid); // Выполняем запрос

                    foreach ($cur_data as $d1) {
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }
        else {
            // Выдаем предупреждение на экран об окончании формирования файла
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Erorr.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }
    }
    
    //формирование файла идентификации
        // Формирование файла devloc для САП для бытовых абонентов
    public function actionIdfile_devloc_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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
    public function actionSap_device_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', -1);
        $rem = '0'.$res;  // Код РЭС
        $day=((int) date('d'))-1;
        $datab = date('Ymd', strtotime("-$day day"));
        //phpversion()
//        $baujj=random_int(1979, 2006);
        $baujj=mt_rand(1970, 1993);

        $sql = "select distinct w1.mmgg_current,(w1.mmgg_current- interval '4 month')::date as datab,a.id,'4001' as eqart,'$baujj' as baujj,
                const.kostl as kostl,a.num_meter as sernr,'00000334' as zz_pernr,
                replace(a.dt_control::char(10),'-','') as cert_date,b.id as id_meter,
                date_part('year', a.dt_control) as bgljahr,get_gen_cq(a.id_paccnt,a.carry) as zwgruppe,
                const.swerk,const.stort,const.ver,const.begru_b as begru,sd.sap_meter_name as matnr
                from clm_meterpoint_tbl a
                left join (select distinct id from eqi_meter_tbl) b on a.id_type_meter=b.id
                inner join sap_const const on
                1=1
                left join (select distinct id as id,sap_meter_id from sap_meter) s on s.id::integer=a.id_type_meter
                left join (select distinct sap_meter_id,sap_meter_name,group_schet from sap_device22 where sap_meter_id<>'') sd on s.sap_meter_id=sd.sap_meter_id
                left join (select (fun_mmgg())::date as mmgg_current) w1 on 1=1
                left join clm_paccnt_tbl p on p.id=a.id_paccnt
		        where p.archive='0'
                order by sd.sap_meter_name
                ";

        $sql_c = "select * from sap_export where objectsap='DEVICE_IND' order by id_object";
//        $cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();

        if(1==1) {
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
        $fd=date('Ymd');
        // $fname='PARTNER_04'.'_CK'.$rem.'_B'.$fd.'.txt';
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='DEVICE_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_R'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;
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
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
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
                        if(strtolower($table_struct)=='sap_co_adr')
                            $d1=array_slice($d1, 0, 9);
                        $d1 = array_map('trim', $d1);
//                        $d1['oldkey']=substr($d1['oldkey'],0,10);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }
        else {
            // Выдаем предупреждение на экран об окончании формирования файла
            $model = new info();
            $model->title = 'УВАГА!';
            $model->info1 = "Erorr.";
            $model->style1 = "d15";
            $model->style2 = "info-text";
            $model->style_title = "d9";

            return $this->render('info', [
                'model' => $model]);
        }


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
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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
        $rem = '0'.$res;  // Код РЭС

        $sql = "select a.id,'' as pltxt,a.name,a.code_okpo,b.okpo_num,b.tax_num,'2' AS BU_TYPE,b.FLAG_JUR,
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
kt.shot_name||' '||t.name as town,am.post_index,ks.shot_name||' '||s.name as street,am.building as house,am.office as flat,
b.phone,b.e_mail,
const.id_res,const.swerk,const.stort,const.ver,const.begru,const.region
 from clm_client_tbl a
        left join clm_statecl_tbl b on
        a.id=b.id_client
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town
        inner join sap_const const on
        1=1
        WHERE a.code_okpo<>'' and a.code_okpo<>'000000000'
        and a.code_okpo<>'0000000'
	    and a.code_okpo<>'000000'
   ";

        $sql_c = "select * from sap_export where objectsap='CONNOBJ' order by id_object";
        $zsql = 'delete from sap_co_eha';
        $zsql1 = 'delete from sap_co_adr';


        if(1==1) {
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
//            debug($cnt);
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
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='CONNOBJ_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_L'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;
        $sql = "select * from sap_co_eha";
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

        $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();

        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
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
                        $d1=array_slice($d1, 0, 9);
//                        debug($d1);
//                        return;
                        $d1 = array_map('trim', $d1);
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
     }

    // Формирование файла premise для САП для Юридических потребителей
    public function actionSap_premise($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС
        $dt=date('Y-m-d');

        $sql = "select distinct const.begru as pltxt,'PREMISE' as name, cl1.id,cl1.code, eq.name_eqp,eq.id as id_eq,
            '04_C'||'" . $rem . "'||'P_'||case when length(eq.id::varchar)<8 then 
             (substring(trim(getsysvarn('kod_res')::varchar),1,2)||substr('000000',(7-(length(eq.id::varchar)::int)),(7-(length(eq.id::varchar)::int)))||eq.id::varchar)::int else eq.id end  as OLDKEY,
             ref.oldkey as HAUS,ref.house_num2,const.ver
             from eqm_area_tbl as eqa 
            join  eqm_equipment_tbl AS eq  on (eqa.code_eqp=eq.id) 
            join  eqm_equipment_h AS eqh  on (eqa.code_eqp=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id and dt_b < '$dt' order by dt_b desc limit 1 ) ) 
            left join adv_address_tbl as a on (a.id=eq.id_addres) 
            left join adm_address_tbl as am on a.id=am.id
            join eqm_ground_tbl as g on (eq.id=g.code_eqp) 
            left join ( select code_eqp_inst, count(*)::integer as eqp_cnt from eqm_compens_station_inst_tbl group by code_eqp_inst order by code_eqp_inst) as u on (eq.id=u.code_eqp_inst) 
            left join clm_client_tbl as cl1 on (cl1.id=eqa.id_client) 
            left join clm_statecl_tbl as st on cl1.id = st.id_client
            left join sap_co_adr ref on substr(ref.oldkey,9)=cl1.id::text
            inner join sap_const const on
            1=1
            left join clm_statecl_h as sth on cl1.id = sth.id_client and 
            sth.mmgg_e is null and sth.mmgg_b = (SELECT mmgg_b FROM clm_statecl_h WHERE id_client = sth.id_client and mmgg_b < '$dt' order by mmgg_b desc limit 1 )      
            where (eq.type_eqp = 11) and cl1.book = -1 and coalesce(cl1.id_state,0) not in(50,99,80,49,100) and coalesce(cl1.idk_work,0) not in (0) 
             and sth.mmgg_b is not null and st.doc_dat is not null  and st.id_section not in (205,206,207,208,209,218)  and sth.mmgg_b is not null and st.doc_dat is not null 
                 and cl1.id <> syi_resid_fun() 
                 and cl1.id <>999999999
            order by 5 ";

//        debug($sql);
//        return;

        $sql_c = "select * from sap_export where objectsap='PREMISE' order by id_object";
        $zsql = 'delete from sap_evbsd';


        if(1==1) {
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

//            debug($data);
//            return;

            // Заполняем структуры
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_premise($n_struct, $rem, $w);
                }
            }
        }
//        return;

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='PREMISE_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_L'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;
        $sql = "select * from sap_evbsd";
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

        $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();

        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
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
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }
    
    //формирование файлов идентификации в САП абонентов ЕНЕРГО структруры "премайс"
    //юридические лица
    public function actionIdfile_premise ($res){
        
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
        $filename = get_routine1($method);

        $sql = "select 'PREMISE' as OM,a.oldkey,b.code,trim(a.zz_nameplvm),const.ver from sap_EVBSD as a 
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
                        $d1=array_slice($d1, 0, 4);                        
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
    public function actionSap_premise_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        $sql = "select a.id,a.activ,'' as pltxt,b.tax_number,b.last_name,
                b.name,b.patron_name,c.town,c.indx,c.street,
                c.house,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.swerk,const.stort,const.ver,const.begru,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport,dd.oldkey as haus from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id=b.id
        left join vw_address c on
        a.id=c.id
        left join sap_co_adr dd on
        ((trim(lower(c.street))=trim(lower(get_sap_street(dd.street))) and dd.str_suppl1='~') or (trim(lower(c.street))=trim(lower(dd.str_suppl1)) and trim(dd.street)='~')) 
        and case when trim(lower(get_sap_street(dd.street)))='запорізьке шосе' then  lower(trim(c.type_street))='вул.'
        else ((lower(trim(c.type_street))=lower(trim(get_typestreet(dd.street))) and trim(dd.str_suppl1)='~') 
        or (1=1 and trim(dd.street)='~')) end 
         and case when dd.city1 is null then (trim(lower(dd.city1))=trim(lower(case when c.type_city='смт.' then 'смт' else lower(c.type_city) end
          ||' '||trim(lower(c.town)))) and dd.city1 is not null) else 1=1 end
          and ((upper(dd.house_num1)=upper(c.house) and dd.str_suppl1='~') or (upper(trim(dd.str_suppl2))=upper(trim(c.house)) and trim(dd.street)='~'))
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region
        where a.archive='0'
        ";

        $sql = "select DISTINCT a.id,a.activ,'' as pltxt,b.tax_number,b.last_name,
                b.name,b.patron_name,c.town,c.indx,c.street,
                c.house,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.swerk,const.stort,const.ver,const.begru,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport,dd.oldkey as haus from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id=b.id
        left join vw_address c on
        a.id=c.id
        left join sap_but020 c1 on c1.old_key='04_C'||'$rem'||'B_'||a.id
        left join sap_co_adr dd on
        (trim(c1.city1)=trim(dd.city1) and trim(c1.street)=trim(dd.street) and trim(c1.house_num1)=trim(dd.house_num1)
        and coalesce(trim(replace(c1.house_num2,'корп.','')),'~')=case when trim(dd.house_num2)='' then '~' ELSE coalesce(trim(dd.house_num2),'~') END
        and dd.str_suppl1='~') or (dd.str_suppl1<>'~' and trim(c1.str_suppl1)=trim(dd.str_suppl1) and trim(c1.str_suppl2)=trim(dd.str_suppl2))
        inner join sap_const const on 1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region
        where a.archive='0' 
       ";
        $sql_c = "select * from sap_export where objectsap='PREMISE_IND' order by id_object";
        $zsql = 'delete from sap_evbsd';
        //$cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();

        if(1==1) {
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
            foreach ($data as $w) {
                $i = 0;
                foreach ($cnt as $v) {
                    $n_struct = trim($v['dattype']);
                    $i++;
                    f_premise_ind($n_struct, $rem, $w);
                }
            }
        }
        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        // $fname='PARTNER_04'.'_CK'.$rem.'_B'.$fd.'.txt';
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='PREMISE_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_R'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;
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

        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
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
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
        }

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
    public function actionIdfile_premise_ind ($res,$par=0){
        
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
        $f = fopen($fname, 'w+');

                    foreach ($data as $d1) {
                        $d1=array_slice($d1, 0, 4);                        
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

        if($par==0)
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
        $rem = '0'.$res;  // Код РЭС

        $sql = "-- INIT
select s1.*,s2.*,s3.*,s4.*,s5.*
from
(select 'INIT' as struct,a.id,a.code as vkona,const.vktyp as vktyp,'04_C04P_'||a.id as gpart
from clm_client_tbl as a
left join clm_statecl_tbl as b on a.id = b.id_client
inner join sap_const const on 1=1
WHERE a.code_okpo<>'' and a.code_okpo<>'000000000'
        and a.code_okpo<>'0000000'
	    and a.code_okpo<>'000000') s1
left join
--VK
(select 'VK' as struct,cl.id,
case when length((case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar)=1 
then '0'||(case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar 
else (case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar end   as ZDATEREP
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE cl.code_okpo<>'' and cl.code_okpo<>'000000000'
        and cl.code_okpo<>'0000000'
	    and cl.code_okpo<>'000000') s2 on s1.id=s2.id
left join
-- VKP
(select distinct 'VKP' as struct,cl.id,vktyp as vktyp,'04_C04P_'||cl.id as partner,const.opbuk,51 as ikey,13 as mahnv,
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
     '' as ZZ_END,''  as ZZ_BUDGET,'' as ZZ_TERRITORY
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
left join sap_but020 b on '04_C04P_'||cl.id=b.oldkey
WHERE cl.code_okpo<>'' and cl.code_okpo<>'000000000'
        and cl.code_okpo<>'0000000'
	    and cl.code_okpo<>'000000') s3 on s2.id=s3.id

left join
-- KVV
(select 'KVV' as struct,cl.id,'20200501' as date_from,'99991231' as date_to
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE cl.code_okpo<>'' and cl.code_okpo<>'000000000'
        and cl.code_okpo<>'0000000'
	    and cl.code_okpo<>'000000') s4 on s3.id=s4.id
left join
--ZSTAT
(select 'ZSTAT' as struct,cl.id,'' as obj,'CON003' as status,
'20200501' as date_reg,'99991231' as date_to,'' as price,
'' as COMMENTS,'' as LOEVM
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE cl.code_okpo<>'' and cl.code_okpo<>'000000000'
        and cl.code_okpo<>'0000000'
	    and cl.code_okpo<>'000000') s5 on s4.id=s5.id
";

        $sql_c = "select * from sap_export where objectsap='ACCOUNT' order by id_object";
//        $zsql =  'delete from sap_vk';
//        $zsql1 = 'delete from sap_but000';
//        $zsql2 = 'delete from sap_ekun';
//        $zsql3 = 'delete from sap_but020';
//        $zsql4 = 'delete from sap_but0id';
//        $zsql5 = 'delete from sap_but021';


        if(1==1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_dn_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);

                        Yii::$app->db_pg_dn_energo->createCommand($z)->execute();
                    }
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_zv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_zv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);

                        Yii::$app->db_pg_zv_energo->createCommand($z)->execute();
                    }
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_vg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);
                        Yii::$app->db_pg_vg_energo->createCommand($z)->execute();
                    }
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);

                        Yii::$app->db_pg_pv_energo->createCommand($z)->execute();
                    }
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krg_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krg_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);
                        Yii::$app->db_pg_krg_energo->createCommand($z)->execute();
                    }
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_ap_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);
                        Yii::$app->db_pg_ap_energo->createCommand($z)->execute();
                    }
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_gv_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);
                        Yii::$app->db_pg_gv_energo->createCommand($z)->execute();
                    }
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_in_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    foreach ($cnt as $v){
                        if(trim($v['dattype'])=='INIT')
                            $z='delete from sap_'.trim($v['dattype']).'_acc';
                        else
                            $z='delete from sap_'.trim($v['dattype']);
                        Yii::$app->db_pg_in_energo->createCommand($z)->execute();
                    }
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
        $fd=date('Ymd');
        $fname='ACCOUNT_04'.'_CK'.$rem.'_'.$fd.'_08'.'_L'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;

        $sql = "select * from sap_init_acc";
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

        $cnt = \Yii::$app->db_pg_pv_energo->createCommand($sql_c)->queryAll();

        foreach ($struct_data as $d) {
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
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
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }

    //формирование файла идентификации
        // Формирование файла account для САП для Юр.лиц
    public function actionIdfile_account($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
                        $d1=array_slice($d1, 0, 4);                        
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
        $rem = '0'.$res;  // Код РЭС

        $sql = "select cl.id,'04_C04P_'||cl.id as haus,b.oldkey as vstelle,const.swerk,
                  const.stort,const.begru_all as begru,const.ver
                from clm_client_tbl as cl
                left join clm_statecl_tbl as st on cl.id = st.id_client
                left join sap_evbsd b on b.haus='04_C04P_'||cl.id
                inner join sap_const const on 1=1
                WHERE cl.code_okpo<>'' and cl.code_okpo<>'000000000'
                        and cl.code_okpo<>'0000000'
                        and cl.code_okpo<>'000000'
                and b.oldkey is not null";

        $sql_c = "select * from sap_export where objectsap='DEVLOC' order by id_object";
        $zsql = 'delete from sap_egpld';


        if(1==1) {
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
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='DEVLOC_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_L'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;
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
            $old_key=trim($d['oldkey']);
            $d = array_map('trim', $d);
            $s=implode("\t", $d);
            $s=str_replace("~","",$s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            $i=0;
            foreach ($cnt as $v) {
                $table_struct = 'sap_' . trim($v['dattype']);
                $i++;
                if($i>1) {
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
                        $s1=implode("\t", $d1);
                        $s1=str_replace("~","",$s1);
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
        $model = new info();
        $model->title = 'УВАГА!';
        $model->info1 = "Файл сформовано.";
        $model->style1 = "d15";
        $model->style2 = "info-text";
        $model->style_title = "d9";

        return $this->render('info', [
            'model' => $model]);
    }

        //формирование файла идентификации
        // Формирование файла devloc для САП для Юр.лиц
    public function actionIdfile_devloc($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        // Определяем тип базы 1-abn, 2-energo
        $method=__FUNCTION__;
      if (substr($method, -4) == '_ind') {
            $vid = 1;
            $_suffix = '_R';
        } else {
            $vid = 2;
            $_suffix = '_L';
        }
        // Получаем название подпрограммы
        $routine = strtoupper(substr($method,13));
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
                        $d1=array_slice($d1, 0, 4);                        
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
    
public function actionSap_discdoc_ind($res)
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
        $sql = "select a.id,a.code,max(b.dt_action),const.ver from clm_paccnt_tbl a
                join clm_switching_tbl b on a.id=b.id_paccnt
                left join sap_const as const on 1=1
                where a.archive ='0' and (a.activ = 'f' or a.activ is null)
                group by a.id,a.code,const.ver";
        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i=0;
        foreach ($data as $w) {
            $di_doc[$i]=f_discdoc1_ind($rem,$w);
            $di_inf[$i]=f_discdoc2_ind($rem,$w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
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

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
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
    }
    
    public function actionSap_discorder_ind($res)
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
        $sql = "select a.id,a.code,max(b.dt_action) as dat,const.ver from clm_paccnt_tbl a
                join clm_switching_tbl b on a.id=b.id_paccnt
                left join sap_const as const on 1=1
                where a.archive ='0' and (a.activ = 'f' or a.activ is null)
                group by a.id,a.code,const.ver";
        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i=0;
        foreach ($data as $w) {
            $di_ord[$i]=f_discorder_ind($rem,$w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i=0;
        foreach ($di_ord as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0]."\t".'&ENDE');
            fputs($f, "\n");            
            
            $i++;
        }
        fclose($f);

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
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
    }
    
    public function actionSap_discenter_ind($res)
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
        $sql = "select a.id,a.code,max(b.dt_action) as dat,const.ver from clm_paccnt_tbl a
                join clm_switching_tbl b on a.id=b.id_paccnt
                left join sap_const as const on 1=1
                where a.archive ='0' and (a.activ = 'f' or a.activ is null)
                group by a.id,a.code,const.ver";
        // Получаем необходимые данные
        $data = data_from_server($sql,$res,$vid);   // Массив всех необходимых данных

        // Заполняем массивы структур: $di_int и $di_zw
        $i=0;
        foreach ($data as $w) {
            $di_ent[$i]=f_discenter_ind($rem,$w);
            $i++;
        }

        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname=$filename.'_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.$_suffix.'.txt';
        $f = fopen($fname,'w+');
//        debug($di_inf);
//        return;
        // Считываем данные в файл с массивов $di_int и $di_zw
        $i=0;
        foreach ($di_ent as $d) {
            $d1 = array_map('trim', $d);
            $s = implode("\t", $d1);
            $s = str_replace("~", "", $s);
            $s = mb_convert_encoding($s, 'CP1251', mb_detect_encoding($s));
            fputs($f, $s);
            fputs($f, "\n");
            fputs($f, $d1[0]."\t".'&ENDE');
            fputs($f, "\n");            
            
            $i++;
        }
        fclose($f);

        if (file_exists($fname)) {
            return \Yii::$app->response->sendFile($fname);
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
    }
    
    
    // Импорт готовой таблицы street в базы РЭСов
    public function actionImp_street_in_bd()
    {
        $sql = "select * from street";
        //echo $sql;
        //$data = \Yii::$app->db_pg_im_db->createCommand($sql)->queryAll();
        $data = \Yii::$app->db_pg_pv_energo->createCommand($sql)->queryAll();

        //debug($data);
        $sql="CREATE TABLE public.street
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

        foreach($data as $in){
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
            VALUES(".
                $code.','.'$$'.$name.'$$'.","."'".$citycode."'".","."'".$thedistrictcode."'".",".$streettypecode.",".
                "'".$modify_time."'".","."'".$citykoid."'".","."'".$resid."'".","."'".$xstreetcode."'".","."$$".$name_town."$$".')';
            Yii::$app->db_pg_krg_energo->createCommand($sql)->execute();

            //debug($town);
        }

        echo "Інформацію записано";
    }


    // Форматирование csv файла
    public function actionPrepare_csv()
    {
        $file = "person.csv";
        $f = fopen($file,'r');
        $ff=fopen('copy_'.$file,'w+');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode(";",$s);
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
            if($i>1) {
                if(isset($data[0]))
                    $d1 = trim(str_replace('"','',$data[0]));
                if(isset($data[1]))
                    $d2 = trim(str_replace('"','',$data[1]));
                if(isset($data[2]))
                    $d3 = trim(str_replace('"','',$data[2]));
                if(isset($data[3]))
                    $d4 = trim(str_replace('"','',$data[3]));
                if(isset($data[4]))
                    $d5 = trim(str_replace('"','',$data[4]));
                if(isset($data[5]))
                    $d6 = trim(str_replace(' ','',$data[5]));
                if(isset($data[6]))
                    $d7 = trim(str_replace('"','',$data[6]));
                if(isset($data[7]))
                    $d8 = trim(str_replace('"','',$data[7]));
                if(isset($data[8]))
                    $d9 = trim(str_replace('"','',$data[8]));
                if(isset($data[9]))
                    $d10 = trim(str_replace('"','',$data[9]));
                if(isset($data[10]))
                    $d11 = trim(str_replace('"','',$data[10]));
                if(isset($data[11]))
                    $d12 = trim(str_replace('"','',$data[11]));
                if(isset($data[12]))
                    $d13 = trim(str_replace('"','',$data[12]));

                if(isset($data[13]))
                    $d14 = trim(str_replace('"','',$data[13]));
                if(isset($data[14]))
                    $d15 = trim(str_replace('"','',$data[14]));
                if(isset($data[15]))
                    $d16 = trim(str_replace('"','',$data[15]));
                if(isset($data[16]))
                    $d17 = trim(str_replace('"','',$data[16]));
                if(isset($data[17]))
                    $d18 = trim(str_replace('"','',$data[17]));
                if(isset($data[18]))
                    $d19 = trim(str_replace('"','',$data[18]));
                if(isset($data[19]))
                    $d20 = trim(str_replace('"','',$data[19]));
                if(isset($data[20]))
                    $d21 = trim(str_replace('"','',$data[20]));

                $s = $d1.';'.$d2.';'.$d3.';'.$d4.';'.$d5.';'.
                     $d6.';'.$d7.';'.$d8.';'.$d9.';'.$d10.';'.
                     $d11.';'.$d12.';'.$d13.';'.$d14.';'.$d15.';'.
                     $d16.';'.$d17.';'.$d18.';'.$d19.';'.$d20.';'.$d21.';'.
                    "\n";

            }
            echo $s.'<br>';
            fputs($ff, $s);
        }
        fclose($f);
        fclose($ff);
        echo "Файл ".$file.' отформатирован.';
    }
    // --------------------------------------------------------------------------------------------------------
    
    // Импорт отчета по КиевСтар за ноябрь 2019 года для выявления штрафников
    public function actionImport_ks_1119()
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

        $sql = "CREATE TABLE tmp_ks1119 (
              tel varchar(10) NOT NULL,
              cost_plan varchar(20) DEFAULT NULL,
              cost_all varchar(10) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('Rep1119.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode(";",$s);
            
            if(empty($data[0])) break;
            $data[0] = str_replace('"','',$data[0]);
            $data[0] = str_replace('+380','',$data[0]);
            $data[3] = str_replace('"','',$data[3]);
            $data[9] = str_replace('"','',$data[9]);
            $e=1;
             
                    $sql = "INSERT INTO tmp_ks1119 (tel,cost_plan,cost_all) VALUES(".
                        "'".$data[0]."'".","."'".$data[3]."'".","."'".$data[9]."'".')';

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

        $f = fopen('m_name.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            //if($i==1) continue;
            $data = explode(";",$s);

            if(empty($data[0])) break;

            $sql = "INSERT INTO man_name (name) VALUES(".
                "'".$data[0]."'".')';

            Yii::$app->db_phone->createCommand($sql)->execute();
        }

        fclose($f);
    }
    // Импорт дневника в Info
    public function actionImport_diary()
    {

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('diary.txt','r');
        $i = 0;
        $flag=-1;
        $data='';
        $cf=0;
        while (!feof($f)) {
            $s = fgets($f);
            if(trim($s)=='') continue;
            $y=mb_strlen($s,'UTF-8');
            $i++;
            $k=10;

            if(mb_substr($s,2,1,'UTF-8')=='.') {
                $flag=0;
                $cf=$flag;
                $date = mb_substr($s,0,$k,'UTF-8');
                $data='';
            }
            else {
                $flag=1;
                $cf=$flag;
            }
           // echo $flag;
            if($flag>=1 && $i>1) {
                $c=mb_substr(trim($s),0,1,'UTF-8');
                if(mb_substr($s,1,1,'UTF-8')=='.' && ctype_digit($c))
                {$flag=3; $data='';}
                else{
                    $flag=2;
                }
                if($flag==3 && $cf==3) $flag=4;
                if($flag==3 || $flag==4)
                    $data = mb_substr($s,2,$y-2,'UTF-8');
                else
                {
                    $data = $data.' '.trim($s);
                }
                $date=date("Y-m-d", strtotime($date));

                if($flag==2 || $flag==4) {
                    $cf=$flag;
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
        $f = fopen('new_list1.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
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

    public function actionStrtest(){
        $data8='Павлоградські РЕМ';
        $rrem = mb_substr($data8,mb_strlen($data8,'UTF-8')-3,3,'UTF-8');
        echo $rrem;
    }

// Генерация 32-битного случайного числа
    public function actionGen32(){
           echo gen16(32);
    }

    // Создание поля CHARG (SAP)
    public function actionCharg(){
        $all_tmc = all_tmc::findbysql('Select a.*,b.kol_gr from a_c_sklad_exp3 a 
        join q_gr1 b on a.zmaktx=b.zmaktx and a.charg1=b.charg order by a.zmaktx,a.charg1')->asArray()
            ->all();
        $y=count($all_tmc);
        $a='';
        $b='';
        $j=1;
        for($i=1;$i<=$y;$i++){
            $id=$all_tmc[$i]['ID'];
            if($all_tmc[$i]['kol_gr']==1)
            { $a='';
              $b='';
              $charg=$all_tmc[$i]['charg'].'000'.'1';
              $j=1;
            }
            else
            {
              if($all_tmc[$i]['zmaktx']==$a && $all_tmc[$i]['charg1']==$b){
                  $j++;
              }
              else{
                  $j=1;
              }
              $a=$all_tmc[$i]['zmaktx'];
              $b=$all_tmc[$i]['charg1'];

            }
            $z="update a_c_sklad_exp3 set kol_gr=$j where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

       // debug($all_tmc);
        echo "OK";
    }

    // Создание отв. лиц (SAP)
    public function actionLgort(){
        $otv = all_tmc::findbysql('Select a.lgort,a.ID from a_all_tmc a')->asArray()
            ->all();
        $y=count($otv);

        for($i=1;$i<=$y;$i++){
            $id=$otv[$i]['ID'];
            $h=$otv[$i]['lgort'];
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
                    $w=mb_strlen($h,'UTF-8');
                    $pos = strpos($h, ' ');

                    if (!$pos === false) {
                        $h=substr($h,0,$pos);
                    }

                    $j=$h;
            }
            $z="update a_all_tmc set lgort1='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        // debug($all_tmc);
        echo "OK";
    }

    // Преобразование таблицы инструмента
    public function actionDo_mshp(){
        $msp = all_tmc::findbysql('Select * from mshp')->asArray()
            ->all();
        $y=count($msp);
        $otv='';
        for($i=1;$i<=$y;$i++){
            $id=$msp[$i]['ID'];
            $h=$msp[$i]['tmc'];
            if(strpos($h,'"')) ;
            else {
                $fio = all_tmc::findbysql("Select * from kyivstar where fio=" . '"' . $h . '"')->asArray()
                    ->all();

                $yy = count($fio);
                if ($yy > 0) $otv = $h;
                else
                {
                    $fio = all_tmc::findbysql("Select * from 1c where fio=" . '"' . $h . '"')->asArray()
                    ->all();

                    $yy = count($fio);
                    if ($yy > 0) $otv = $h;

                }
            }
            $z="update mshp set otv='$otv' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        // debug($all_tmc);
        echo "OK";
    }

    // Создание поля CHARG эксплуатация (SAP)
    public function actionCharg_e(){
        $all_tmc = all_tmc::findbysql('Select a.*,b.kol_gr from all_tmce a 
        join q_gr2 b on a.maktx_c=b.maktx_c and a.charg=b.charg order by a.maktx_c,a.charg')->asArray()
            ->all();
        $y=count($all_tmc);
        $a='';
        $b='';
        $j=1;
        for($i=1;$i<=$y;$i++){
            $id=$all_tmc[$i]['ID'];
            if($all_tmc[$i]['kol_gr']==1)
            { $a='';
                $b='';
                $charg=$all_tmc[$i]['CHARG'].'000'.'1';
                $j=1;
            }
            else
            {
                if($all_tmc[$i]['maktx_c']==$a && $all_tmc[$i]['CHARG']==$b){
                    $j++;
                }
                else{
                    $j=1;
                }
                $a=$all_tmc[$i]['maktx_c'];
                $b=$all_tmc[$i]['CHARG'];

            }
            $z="update all_tmce set kol_gr=$j where ID=$id";
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
        for($i=0;$i<$y;$i++) {
            $id=$tmc[$i]['ID'];
            $e=$tmc[$i]['EXBWR'];
            $pos = strpos($e, ',');
            $y1=strlen($e);
            $r=0;
            if (!$pos === false) {
                $r = $y1 - $pos - 1;
                if($r==1)
                    $j = $e . str_repeat("0", $r);
                else
                    $j = $e;
            }
            else
                $j=$e.',00';


            $z="update a_c_sklad_exp3 set exbwr1='$j' where ID=$id";
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
        $i=10;
//        debug($tmc);
//        return;
        while (1==1)
        {
            $id=$tmc[$j]['ID'];
            $d=date('d.m.Y', strtotime("-$i days"));
            if($j<$y && $i==679) $i=10;
            if($j>=$y) break;

            $z="update a_res_skl_mshp set ch_gr_date='$d' where ID=$id";
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
        $f = fopen('spr_mat.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$",$s);
            $pos = strpos($data[2],'"');
            $data[2]=str_replace("'",'$',$data[2]);
            $data[3]=str_replace("'",'$',$data[3]);

            $data[2]=str_replace('"','|',$data[2]);
            $data[3]=str_replace('"','|',$data[3]);

            $data[2]=str_replace('\\','@',$data[2]);
            $data[3]=str_replace('\\','@',$data[3]);



//            if (!$pos === false)

                $sql = "INSERT INTO mater_prod1 (kod_sap,mater_s,mater_l,ed_izm,type_mat,descr_type,grup_mat,desc_gr)
                VALUES(" .
                "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" .$data[3]."'"."," . "'".$data[4] . "'"
                   ."," . "'".$data[5] . "'" . "," . "'".$data[6] . "'"."," . "'".$data[7] . "'".","  . "'".$data[8] . "'".')';
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


        // Закачка таблицы соответствия для служб
    public function actionSootv()
    {
        $sql = "delete from a_s1_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s1_sklad.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$",$s);
            if(!isset($data[2])) break;
            $pos = strpos($data[2],"'");
            $data[2]=str_replace("'",'$',$data[2]);

            $data[2]=str_replace('"','~',$data[2]);

            $data[5]=str_replace("'",'$',$data[5]);
            $data[6]=str_replace("'",'$',$data[6]);

            $data[2]=str_replace('\\','@',$data[2]);

            $data[5]=str_replace('\\','@',$data[5]);
            $data[6]=str_replace('\\','@',$data[6]);

            $sql = "INSERT INTO a_s1_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' .$data[2].'"'."," . "'".$data[3] . "'"
                ."," . "'".$data[4] . "'" . "," . "'".$data[5] . "'"."," . "'".$data[6] . "'".","  . "'".$data[7] . "'".
                ','."'".$data[8]."'".','."'".$data[9]."'".','."'".$data[10]."'".')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s2_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s2_sklad.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$",$s);
            if(!isset($data[2])) break;
            $pos = strpos($data[2],"'");
            $data[2]=str_replace("'",'$',$data[2]);

            $data[2]=str_replace('"','~',$data[2]);

            $data[5]=str_replace("'",'$',$data[5]);
            $data[6]=str_replace("'",'$',$data[6]);

            $data[2]=str_replace('\\','@',$data[2]);

            $data[5]=str_replace('\\','@',$data[5]);
            $data[6]=str_replace('\\','@',$data[6]);

            $sql = "INSERT INTO a_s2_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' .$data[2].'"'."," . "'".$data[3] . "'"
                ."," . "'".$data[4] . "'" . "," . "'".$data[5] . "'"."," . "'".$data[6] . "'".","  . "'".$data[7] . "'".
                ','."'".$data[8]."'".','."'".$data[9]."'".','."'".$data[10]."'".')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s3_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s3_sklad.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$",$s);
            if(!isset($data[2])) break;
            $pos = strpos($data[2],"'");
            $data[2]=str_replace("'",'$',$data[2]);

            $data[2]=str_replace('"','~',$data[2]);

            $data[5]=str_replace("'",'$',$data[5]);
            $data[6]=str_replace("'",'$',$data[6]);

            $data[2]=str_replace('\\','@',$data[2]);

            $data[5]=str_replace('\\','@',$data[5]);
            $data[6]=str_replace('\\','@',$data[6]);

            $sql = "INSERT INTO a_s3_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' .$data[2].'"'."," . "'".$data[3] . "'"
                ."," . "'".$data[4] . "'" . "," . "'".$data[5] . "'"."," . "'".$data[6] . "'".","  . "'".$data[7] . "'".
                ','."'".$data[8]."'".','."'".$data[9]."'".','."'".$data[10]."'".')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s4_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s4_sklad.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$",$s);
            if(!isset($data[2])) break;
            $pos = strpos($data[2],"'");
            $data[2]=str_replace("'",'$',$data[2]);

            $data[2]=str_replace('"','~',$data[2]);

            $data[5]=str_replace("'",'$',$data[5]);
            $data[6]=str_replace("'",'$',$data[6]);

            $data[2]=str_replace('\\','@',$data[2]);

            $data[5]=str_replace('\\','@',$data[5]);
            $data[6]=str_replace('\\','@',$data[6]);

            $sql = "INSERT INTO a_s4_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                    "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' .$data[2].'"'."," . "'".$data[3] . "'"
                    ."," . "'".$data[4] . "'" . "," . "'".$data[5] . "'"."," . "'".$data[6] . "'".","  . "'".$data[7] . "'".
                    ','."'".$data[8]."'".','."'".$data[9]."'".','."'".$data[10]."'".')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s5_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s5_sklad.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$",$s);
            if(!isset($data[2])) break;
            $pos = strpos($data[2],"'");
            $data[2]=str_replace("'",'$',$data[2]);

            $data[2]=str_replace('"','~',$data[2]);

            $data[5]=str_replace("'",'$',$data[5]);
            $data[6]=str_replace("'",'$',$data[6]);

            $data[2]=str_replace('\\','@',$data[2]);

            $data[5]=str_replace('\\','@',$data[5]);
            $data[6]=str_replace('\\','@',$data[6]);

            $sql = "INSERT INTO a_s5_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' .$data[2].'"'."," . "'".$data[3] . "'"
                ."," . "'".$data[4] . "'" . "," . "'".$data[5] . "'"."," . "'".$data[6] . "'".","  . "'".$data[7] . "'".
                ','."'".$data[8]."'".','."'".$data[9]."'".','."'".$data[10]."'".')';

            Yii::$app->db_sap->createCommand($sql)->execute();
        }

        fclose($f);

        $sql = "delete from a_s6_sklad";
        Yii::$app->db_sap->createCommand($sql)->execute();
        $f = fopen('./base/a_s6_sklad.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode("$",$s);
            if(!isset($data[2])) break;
            $pos = strpos($data[2],"'");
            $data[2]=str_replace("'",'$',$data[2]);

            $data[2]=str_replace('"','~',$data[2]);

            $data[5]=str_replace("'",'$',$data[5]);
            $data[6]=str_replace("'",'$',$data[6]);

            $data[2]=str_replace('\\','@',$data[2]);

            $data[5]=str_replace('\\','@',$data[5]);
            $data[6]=str_replace('\\','@',$data[6]);

            $sql = "INSERT INTO a_s6_sklad(kod_cek,mtart,t_cek,edizm_cek,kod_sap,mater_s,mater_l,edizm_sap,
                    mtart_sap,oei,add_sap)
                    VALUES(" .
                "'" . $data[0] . "'" . "," . '"' . $data[1] . '"' . "," . '"' .$data[2].'"'."," . "'".$data[3] . "'"
                ."," . "'".$data[4] . "'" . "," . "'".$data[5] . "'"."," . "'".$data[6] . "'".","  . "'".$data[7] . "'".
                ','."'".$data[8]."'".','."'".$data[9]."'".','."'".$data[10]."'".')';

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
    public function actionSklad2sap(){
        $z='drop table if exists q_gr1';
        Yii::$app->db_sap->createCommand($z)->execute();

        $z="create table q_gr1 as
        SELECT maktx,concat(substr(ch_gr_date,9),substr(ch_gr_date,4,2),substr(ch_gr_date,1,2)) as charg,count(*) as kol_gr 
        FROM a_all_tmc1 where maktx<>'' group by 1,2";
        Yii::$app->db_sap->createCommand($z)->execute();

         // Создание поля charg в правильном формате
        $all_tmc = all_tmc::findbysql('Select a.*,b.kol_gr from a_all_tmc1 a 
        join q_gr1 b on a.maktx=b.maktx and a.charg1=b.charg order by a.maktx,a.charg1')->asArray()
            ->all();
        $y=count($all_tmc);
        $a='';
        $b='';
        $j=1;
        for($i=1;$i<$y;$i++){
            $id=$all_tmc[$i]['ID'];
            if($all_tmc[$i]['kol_gr']==1)
            { $a='';
                $b='';
                $charg=$all_tmc[$i]['charg'].'000'.'1';
                $j=1;
            }
            else
            {
                if($all_tmc[$i]['maktx']==$a && $all_tmc[$i]['charg1']==$b){
                    $j++;
                }
                else{
                    $j=1;
                }
                $a=$all_tmc[$i]['maktx'];
                $b=$all_tmc[$i]['charg1'];

            }
            $z="update a_all_tmc1 set kol_gr=$j where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        $z="update a_all_tmc1
        set cgr=concat('000',kol_gr)";
        Yii::$app->db_sap->createCommand($z)->execute();

        $z="update a_all_tmc1
        set cgr=right(cgr,4)";
        Yii::$app->db_sap->createCommand($z)->execute();

        $z="update a_all_tmc1
        set charg=concat(charg,cgr)
        WHERE maktx is not null";

        Yii::$app->db_sap->createCommand($z)->execute();

        // Корректируем время
        $z="update a_all_tmc1
        set time_c=cast(time_c as time)+INTERVAL cast(cgr as unsigned)SECOND 
        where cast(cgr as unsigned)>1";

        Yii::$app->db_sap->createCommand($z)->execute();

        // Установка разрядности единиц измерений
        $tmc = all_tmc::findbysql('Select a.*,b.razr from a_all_tmc1 a 
        join edizm b on a.meins=b.nazv order by a.ID')->asArray()
            ->all();
        $y=count($tmc);
        $a='';
        $b='';
        $j=1;

        for($i=0;$i<$y;$i++){
            $j='';
            $id=$tmc[$i]['ID'];
            $razr=$tmc[$i]['razr'];
            $k=trim($tmc[$i]['erfmg']);
            $p=strpos($k,',');
            if(is_null($p) || empty($p) || $p==false) $p=-1;
            if($p>0){
                $kol=strlen($k)-$p-1;
                if($razr>0)
                {
                    if($kol>$razr){
                        $e=substr($k,$p+1,$razr);
                        $j=substr($k,0,$p).','.$e;
                    }
                    if($kol<$razr){
                        $e=$razr-$kol;
                        $j=$k.str_repeat("0", $e);
                    }
                    if($kol==$razr) $j=$k;
                }
                else
                {
                    $j=intval($k);
                }
            }
            else
            {
                if($razr>0){
                    $j=$k.','.str_repeat("0", $razr);
                }
            }


            $z="update a_all_tmc1 set ZKZ='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

           // Установка разрядности денег (SAP)
           $tmc = all_tmc::findbysql('Select a.* from a_all_tmc1 a ')->asArray()
                ->all();
            $y = count($tmc);
            $a = '';
            $b = '';
            $j = 1;

            for($i=0;$i<$y;$i++) {
                $id=$tmc[$i]['ID'];
                $e=$tmc[$i]['exbwr'];
                $pos = strpos($e, ',');
                $y1=strlen($e);
                $r=0;
                if (!$pos === false) {
                    $r = $y1 - $pos - 1;
                    if($r==1)
                        $j = $e . str_repeat("0", $r);
                    else
                        $j = $e;
                }
                else
                    $j=$e.',00';


                $z="update a_all_tmc1 set exbwr1='$j' where ID=$id";
                Yii::$app->db_sap->createCommand($z)->execute();
            }



        echo "OK";
    }


    // Установка разрядности единиц измерений (SAP)
    public function actionEdizm(){
        $tmc = all_tmc::findbysql('Select a.*,b.razr from a_c_skladzz a 
        join edizm b on a.meins=b.nazv order by a.ID')->asArray()
            ->all();
        $y=count($tmc);
        $a='';
        $b='';
        $j=1;

        for($i=0;$i<$y;$i++){
            $j='';
//            if ($i>400) break;
            $id=$tmc[$i]['ID'];
            $razr=$tmc[$i]['razr'];
            $k=trim($tmc[$i]['ERFMG']);
            $p=strpos($k,',');
            if(is_null($p) || empty($p) || $p==false) $p=-1;
            if($p>0){
                $kol=strlen($k)-$p-1;
                if($razr>0)
                {
                if($kol>$razr){
                    $e=substr($k,$p+1,$razr);
                    $j=substr($k,0,$p).','.$e;
                }
                if($kol<$razr){
                    $e=$razr-$kol;
                    $j=$k.str_repeat("0", $e);
                }
                if($kol==$razr) $j=$k;
                }
                else
                {
                    $j=intval($k);
                }
            }
            else
            {
                if($razr>0){
                    $j=$k.','.str_repeat("0", $razr);
                }
            }


            $z="update a_c_skladzz set ZKZ='$j' where ID=$id";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        echo "OK";
    }

    // Установка id_lgort (инструмент) (SAP)
    public function actionId_lgort(){
        $fio = all_tmc::findbysql('Select a.fio from sklad_i a')->asArray()->all();
        $tmc = all_tmc::findbysql('Select a.* from tovar_i a')->asArray()->all();
        $y=count($tmc);
        $i=0;
        foreach($fio as $v) {
            $mas[$i] = $v['fio'];
            $i++;
        }

        if(in_array('Сивоконь Владислав Станіславович',$mas))
            echo 'Yes';
        else
            echo 'No';

        for($i=0;$i<$y;$i++){
            $tf=$tmc[$i]['nazv'];

            $id_r=$tmc[$i]['ID'];
            if(in_array($tf, $mas)) {
                $id_f=$id_r;

            }
            $z = "update tovar_i set id_lgort=$id_f where ID=$id_r";
            Yii::$app->db_sap->createCommand($z)->execute();
        }

        echo "OK";
    }

    // Установка товара САП (SAP)
    public function actionSet_t_sap(){
        $tmc = all_tmc::findbysql('Select a.* from table_20 a where t_sap is null')->asArray()->all();
        $ost = all_tmc::findbysql('Select a.* from ost_104 a')->asArray()->all();
        $y=count($tmc);

        $pos = strpos('Разрядник РВС 35кВ РВТ-32 Ф"А" б/у,$t_cek','Разрядник РВС 35кВ');
        echo $pos;

        if ($pos === false) {
            echo 'НЕ Найдено';
        }
        else{
            echo 'Найдено';
        }

        for($i=0;$i<$y;$i++){
            $t=$tmc[$i]['t_cek'];

            $id=$tmc[$i]['code'];
            $j=0;
            foreach($ost as $v) {
                $t_cek = $v['t_cek'];
                $t_sap = $v['t_sap'];
                $pos = strpos($t,$t_cek);

                if ($pos === false) ;
                else
                {
                    $z = "update table_20 set t_sap=concat('ZZZ ',".'"'.$t_sap.'"'.") where code='$id'";
                    Yii::$app->db_sap->createCommand($z)->execute();
                    break;
                }
                $j++;
            }

        }

//        echo "OK";
    }

    // Установка товара САП (SAP) эксплуатация
    public function actionSet_t_sap_e(){
        $tmc = all_tmc::findbysql('Select a.* from a_sootv_exp a where t_sap<>""')->asArray()->all();
        $ost = all_tmc::findbysql('Select a.* from ost_104 a')->asArray()->all();
        $y=count($tmc);

        $pos = strpos('Разрядник РВС 35кВ РВТ-32 Ф"А" б/у,$t_cek','Разрядник РВС 35кВ');
        echo $pos;

        if ($pos === false) {
            echo 'НЕ Найдено';
        }
        else{
            echo 'Найдено';
        }

        for($i=0;$i<$y;$i++){
            $t=$tmc[$i]['t_cek'];

            $id=$tmc[$i]['id'];
            $j=0;
            foreach($ost as $v) {
                $t_cek = $v['t_cek'];
                $t_sap = $v['t_sap'];
                $flag=0;
                if(strpos('"',$t_sap)>0) $flag=1;
                $pos = strpos($t,$t_cek);

                if ($pos === false) ;
                else
                {
                    if($flag==0)
                        $z = "update a_sootv_exp set t_sap=concat('ZZZ ',".'"'.$t_sap.'"'.") where id='$id'";
                    else
                        $z = "update a_sootv_exp set t_sap=concat('ZZZ ',"."'".$t_sap."'".") where id='$id'";

                    Yii::$app->db_sap->createCommand($z)->execute();
                    break;
                }
                $j++;
            }



        }

//        echo "OK";
    }

// Создание ключа САП
    public function actionCrt_key(){
        $e='Разрядник РВС 35кВ РВТ-32 Ф"А" б/у (dserf)';

        $tmc = all_tmc::findbysql('Select a.* from a_sootv_exp1 a')->asArray()->all();
        $y=count($tmc);

        for($i=0;$i<$y;$i++){
            $t=$tmc[$i]['t_cek'];
            $id=$tmc[$i]['ID'];

            //$k=del_symb($t);
            $k=del_symb1($t);
            $z = "update a_sootv_exp1 set key_nazv3='$k' where id='$id'";
            Yii::$app->db_sap->createCommand($z)->execute();
        }
        echo "OK";
    }

    // Задача №1
    public function actionTask1(){

        $model = new input();

        if ($model->load(Yii::$app->request->post()))
        {

            //$arr['src'] = split ("\n", trim($model->number));
            $arr['src'] = explode("\n", trim($model->txt));

            $kol = count($arr['src']);
            $i=0;
            $r='';

            $mas=[];

            foreach ($arr['src'] as $v)
            {
                $mas[$i]=$v;
                $i++;
            }

            $model=new Pract1();
            $r=$model->task7($mas[0]
        );
            $header='Результат';
        }
        else
        {
            return $this->render('input', [
                'model' => $model
            ]);
        }

        return $this->render('res_task',['r' => $r,'header' => $header]);

    }

    // Задача №3
    public function actionTask3(){

        $x = 50;
        $i = 0;
        while ($x > 0){
            if ($x % 2 <> 0) {
                $arr[$i]=$x;
                $i++;
            }
            $x--;
        }
        echo '<pre>';
        print_r($arr);
        echo '</pre>';

//        return $this->render('res_task',['r' => $r]);

    }
    // Задача №5 (Рекурсия)
    public function actionTask5(){
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        $model=new Pract1();
        for($i=1;$i<10;$i++) {
            $r = $model->task5($i);
            echo $r;
            echo '<br>';

        }
        return $this->render('res_task',['r' => $r]);

    }
    // Задача №6 (Рекурсия)
    public function actionTask6(){
        echo '<br>';
        echo '<br>';
        echo '<br>';
        echo '<br>';
        $model=new Pract1();
            $s='12345';
            $r = $model->task6($s,strlen($s));

        return $this->render('res_task',['r' => $r]);

    }
    // Формирование вопросов для опросника
    public function actionForm_quest(){

        Yii::$app->db->createCommand('SET SESSION wait_timeout = 28800;')->execute();
//        phpinfo();
//        return;
       // Yii::$app->db->active = false;

        $model = new addquestions();
        if ($model->load(Yii::$app->request->post())) {
            $sql = 'select ids from ws_polls where id='.$model->theme;
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
            if($model->a1) $q_all=1;
            if($model->a2) $q_all=2;
            if($model->a3) $q_all=3;
            if($model->a4) $q_all=4;
            if($model->a5) $q_all=5;

            if(!empty($model->a1)) {
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

            if(!empty($model->a2)) {
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

            if(!empty($model->a3)) {
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

            if(!empty($model->a4)) {
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

            if(!empty($model->a5)) {
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

        }
        else {
            return $this->render('addquestions', ['model' => $model]);
        }
    }

    public function actionForm_no(){
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
        $f = fopen('new_list_09_2019.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            //if($i==1) continue;
            $data = explode(";",$s);
            if(empty($data[0])) break;
            $data[5] = str_replace('"',' ',$data[5]);
            $data[3]=date("Y-m-d", strtotime($data[3]));
            $data[1] = ltrim($data[1],'0');
            if(isset($data[6]))
                $data8=trim($data[6]);
            else
                $data8='';

            $priz_rem=0;
            $flag=0;
            if(!empty($data8) && $data8<>'Група РЕМ'){
                $rrem = mb_substr($data8,mb_strlen($data8,'UTF-8')-3,3,'UTF-8');
                if($rrem=='РЕМ') $priz_rem=1;
            }
            $e=1;
            while($e==1)
            {
                $pos = strpos($data[2], "'");
                if($data8=='Група РЕМ') {
                    $flag=1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . "','" . $data[5] . "'". ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[5] . "'". ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[5] . "'". ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . '"' . $data[5] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[5] . "'". ')';
                }

                if($data8=='Загальновиробничий персонал' || (empty($data8) && $data[6]<>'Загальновиробничий персонал')) {
                    $flag=1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . ",'" . "'". ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'". ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" .  "'". ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . '"' . $data[5] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" .  "'". ')';
                }

                if(empty($data8) && $data[6]=='Загальновиробничий персонал') {
                    $flag=1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . ",'" . "'". ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . "'". ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" .  "'". ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6] . "'" . "," . '"' . $data[5] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" .  "'". ')';
                }

                if($priz_rem==1) {
                    $flag=1;
                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . ",'" . $data[6] . "'". ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[6] . "'". ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[6] . "'". ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5] . "'" . "," . '"' . $data[6] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','" . $data[6] . "'". ')';
                }

                if($flag==0) {

                    if (!$pos) {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[6].' '.$data[5] . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "'" . "','"  . "'". ')';

                    } else {
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . '"' . $data[2] . '"' . "," . "'" . $data[6].' '.$data[5]  . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','"  . "'". ')';
                        break;
                    }

                    $pos = strpos($data[6], "'");
                    if (!$pos)
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5].' '.$data[4]  . "'" . "," . "'" . $data[6] . "'" . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','"  . "'". ')';
                    else
                        $sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,date_b,main_unit) VALUES(" .
                            "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" . $data[5].' '.$data[4]  . "'" . "," . '"' . $data[6] . '"' . "," . "'" . $data[4] . "'" .
                            "," . 'null' . "," . 'null' . ",'" . $data[3] . "','"  . "'". ')';
                }



                $e=0;
            }

            Yii::$app->db_phone_loc->createCommand($sql)->execute();
        }

        fclose($f);
        return;
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
        $f = fopen('Vinnitsa.csv','r');
        $i = 0;
        $pred = '';
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode(";",$s);
            $data[3] = str_replace('О','0',$data[3]);

            if(empty($data[1])) $data[1]=$pred;
            $sql = "INSERT INTO other_tel (fio,post,tel,tel_town) VALUES(" .
                "'" . $data[1] . "'" . "," . "'" . $data[2] . "'" . "," . "'" .$data[3]."'"."," . "'".$data[4] . "'" .')';

            Yii::$app->db_phone_loc->createCommand($sql)->execute();
            $pred = $data[2];
        }

        fclose($f);
    }



    // Импорт списка рабочих из файла ОК во врем. табл.
    public function actionImport_list_new()
    {
        $sql = "DROP TABLE tmp_works";
        Yii::$app->db_phone_loc->createCommand($sql)->execute();
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
        $f = fopen('new_list_02_2020.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            $data = explode("~",$s);
            if(empty($data[0])) break;
            $data[5] = str_replace('"',' ',$data[5]);
            $data[5] = str_replace('i','і',$data[5]);
            $data[5] = str_replace('c','с',$data[5]);
            $data[6] = str_replace('i','і',$data[6]);
            $data[6] = str_replace('c','с',$data[6]);
            $e=1;
            while($e==1)
            {
                $pos = strpos($data[2], "'");
                if(!$pos)
                    {$sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
                        "'".$data[1]."'".","."'".$data[2]."'".","."'".$data[5]."'".","."'".$data[4]."'".","."'".$data[3]."'".
                        ",".'null'.",".'null'.","."'". $data[6] ."'".')';

                    }
                else
                    {$sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
                        '"'.$data[1].'"'.",".'"'.$data[2].'"'.",".'"'.$data[5].'"'.",".'"'.$data[4].'"'.",".'"'.$data[3].'"'.
                        ",".'null'.",".'null'.",".'"'. $data[6] .'"'.')';
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

    
    // Импорт населенных пунктов Украины по Днепропетровской области на MySql
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

    // Импорт населенных пунктов Украины по Днепропетровской области на PostGre
    public function actionImport_towns_pg()
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
            //if($obl<>'Дніпропетровська') continue;

            $sql = "INSERT INTO spr_towns (obl,district,town,ind,street,houses) VALUES(".
                '$$'.$obl.'$$'.",".'$$'.
                mb_convert_encoding($data[1],"UTF-8","Windows-1251").'$$'.",".'$$'.
                mb_convert_encoding($data[2],"UTF-8","Windows-1251").'$$'.",".
                mb_convert_encoding($data[3],"UTF-8","Windows-1251").",".'$$'.
                mb_convert_encoding($data[4],"UTF-8","Windows-1251").'$$'.","."'".
                mb_convert_encoding(trim($data[5]),"UTF-8","Windows-1251")."'".')';


            Yii::$app->db_pg_local_energo->createCommand($sql)->execute();
        }

        fclose($f);
        echo "Інформацію записано";
    }

    // Импорт точек учета в Energo
    public function actionImport_points()
    {
        $f = fopen('gv_energo.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            $data = explode(";",$s);
            if (!isset($data[0])) exit;
            if (!isset($data[1])) exit;
            $code1 = $data[0];
            $code2 = $data[1];

            $sql = "select del_notrigger('eqm_equipment_tbl' ,
            'UPDATE eqm_equipment_tbl SET num_eqp="."''".$code2."''"." WHERE id=".$code1."')";

            Yii::$app->db_pg_gv_energo->createCommand($sql)->execute();
            $sql = "insert into aa_p(id) values (".$code1.")";
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
               
               //$v = "'".$work."'".","."'".$brig."'".",".$stavka.",".$time;
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
        $f = fopen('tr_2020.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            
            //if($i<8) continue;
            $data = explode("~",$s);
            //debug($data);
            $transport = $data[1];
            $nomer = $data[2];
            $prostoy = $data[3];
            $proezd = $data[4];
            $rabota = $data[5];
           
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

    // Импорт данных по транспорту детальная (для САП)
    // в справочник транспорта в 1Click
    public function actionImport_transport_detal()
    {
        $sql = "CREATE TABLE tmp_transport_d (
              transport varchar(255) NOT NULL,
              nomer varchar(15) NOT NULL,
              place   varchar(45) NOT NULL,
              fuel  varchar(15) NOT NULL,  
              all_p varchar(35) NOT NULL,  
              oil_p varchar(35) NOT NULL,  
              wage varchar(35) NOT NULL,  
              esv varchar(35) NOT NULL,  
              amort varchar(35) NOT NULL,  
             all_move varchar(35) NOT NULL,  
             cost_92_move varchar(35) NOT NULL, 
             cost_95_move varchar(35) NOT NULL,
             cost_df_move varchar(35) NOT NULL,
             cost_g_move varchar(35) NOT NULL,
             cost_oil_move varchar(35) NOT NULL, 
             wage_move varchar(35) NOT NULL,  
             wage_esv_move varchar(35) NOT NULL,
             amort_move varchar(35) NOT NULL,  
              cost_92_work varchar(35) NOT NULL, 
             cost_95_work varchar(35) NOT NULL,
             cost_df_work varchar(35) NOT NULL,
             cost_g_work varchar(35) NOT NULL,
             cost_oil_work varchar(35) NOT NULL, 
             common varchar(35) NOT NULL, 
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db->createCommand($sql)->execute();
        $f = fopen('tr_2020.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);

            //if($i<8) continue;
            $data = explode("~",$s);
            //debug($data);
            $transport = $data[1];
            $nomer = $data[2];
            $prostoy = $data[3];
            $proezd = $data[4];
            $rabota = $data[5];

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

    // Перенос данных по eerm [для юр. лиц]
    public function actionEerm2cnt()
    {
        $sql = "CREATE TABLE public.eerm2cnt
                (
                  cnt char(15),
                  eerm numeric(12,4)
                )";
        Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        $f = fopen('eerm_pv.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode("~",$s);
            if(!isset($data[1])) break;
            $cnt =  $data[1];
            $eerm = str_replace(',','.',$data[2]);
            $v = "$$$cnt$$".",".$eerm;
            $sql = "INSERT INTO eerm2cnt (cnt,eerm) VALUES(".$v.')';
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
        $f = fopen('spr_line.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode("~",$s);
            if(!isset($data[1])) break;
            $v = "4".",".$data[0].","."'".$data[1]."'".","."'".$data[2]."'".
                ","."'".$data[3]."'".","."'".$data[4]."'".
                ","."'".$data[5]."'".","."'".$data[6]."'".
                ","."'".$data[7]."'".","."'".$data[8]."'".
                ","."'".$data[9]."'".","."'".$data[10]."'".
                ","."'".$data[11]."'".","."'".$data[12]."'".
                ","."'".$data[13]."'".","."'".$data[14]."'";

            $sql = "INSERT INTO Sap_lines (kod_res,id,type,normative,voltage_nom,
                       amperage_nom, voltage_max,amperage_max,cords,cover,ro,xo,dpo,show_def,s_nom,id_sap) 
                       VALUES(".$v.')';
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
        $f = fopen('spr_transf.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            if($i==1) continue;
            $data = explode("~",$s);
            if(!isset($data[1])) break;
            $v = "4".",".$data[0].","."'".$data[1]."'".","."'".$data[2]."'".
                ","."'".$data[3]."'".","."'".$data[4]."'".
                ","."'".$data[5]."'".","."'".$data[6]."'".
                ","."'".$data[7]."'".","."'".$data[8]."'".
                ","."'".$data[9]."'".","."'".$data[10]."'".
                ","."'".$data[11]."'".","."'".$data[12]."'".
                ","."'".$data[13]."'".","."'".$data[14]."'".
                ","."'".$data[15]."'".","."'".$data[16]."'";

            $sql = "INSERT INTO Sap_transf (kod_res,id,type,normative,voltage_nom,
                       amperage_nom, voltage_max,amperage_max,phase,swathe,hook_up,power_nom_old
                       ,amperage_no_load,power_nom,show_def, id_sap) 
                       VALUES(".$v.')';
            Yii::$app->db_pg_pv_energo->createCommand($sql)->execute();
        }
        fclose($f);
        echo "Інформацію записано";
    }

    // Транслитерация
    public function actionTranslit()
    {
        $f = fopen('adres.csv','r');
        $ff = fopen('result.txt','w+');
        $i = 0;
        while (!feof($f)) {
            $i++;
            if($i==1) continue;
            $s = trim(fgets($f));
            $ss = translit($s);
            if(!empty($s))
                $s=$s.';'.$ss;
            fputs($ff,$s);
            fputs($ff,"\n");
        }
        fclose($f);
        fclose($ff);

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

    // Test
    public function actionTest()
    {
        $mmgg="'2019-07-01'";
        $mm=(int) substr($mmgg,6,2);

        $yy=(int) substr($mmgg,1,4);
        if($mm==1) {
            $mm = 12;
            $yy--;
        }
        else
            $mm--;
        if($mm<10)
            $mm='0'.$mm;

        $hist_table="spog_hist_".$yy.'_'.$mm;
        echo $hist_table;
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
        //phpinfo();
        $model = new index();

        if ($model->load(Yii::$app->request->post()))
        {

            //$arr['src'] = split ("\n", trim($model->number));
            $arr['src'] = explode("\n", trim($model->number));

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



