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
            }
        }
        else {

            return $this->render('export_sap', [
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

        $sql = "select a.id,a.name,a.code_okpo,b.okpo_num,b.tax_num,'2' AS BU_TYPE,b.FLAG_JUR,
case when coalesce(b.FLAG_JUR,0)= 1  then '03' when coalesce(b.FLAG_JUR,0)= 1  then '03' when coalesce(b.FLAG_JUR,0)= 0 then  '02'  else '03' end as BU_GROUP,
case when coalesce(b.FLAG_JUR,0)= 1 then '0003' when coalesce(b.FLAG_JUR,0)= 0 then  '0002' else '0003' end as BPKIND,
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
b.phone,b.e_mail
 from clm_client_tbl a
        left join clm_statecl_tbl b on
        a.id=b.id_client
        LEFT JOIN adm_address_tbl am ON a.id_addres = am.id
        LEFT JOIN adi_street_tbl s ON s.id = am.id_street
        LEFT JOIN adi_town_tbl t ON t.id = s.id_town
        LEFT JOIN adk_street_tbl ks ON ks.id = s.idk_street
        LEFT JOIN adk_town_tbl kt ON kt.id = t.idk_town
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
                    $data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krr_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_krr_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_krr_energo->createCommand($zsql1)->execute();
                    Yii::$app->db_pg_krr_energo->createCommand($zsql2)->execute();
                    Yii::$app->db_pg_krr_energo->createCommand($zsql3)->execute();
                    Yii::$app->db_pg_krr_energo->createCommand($zsql4)->execute();
                    Yii::$app->db_pg_krr_energo->createCommand($zsql5)->execute();
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
                $struct_data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
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
                            $cur_data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
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

    public function actionCheck(){

        $last_name='(099) 164 3707                  ';
        preg_match_all('/[\d]+/', $last_name, $matches);
        $s='';
        foreach ($matches[0] as $v)
            $s.=$v;
        debug($s);

    }

    // Формирование файла partner для САП для бытовых
    public function actionSap_partner_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС


        $sql = "select a.id,a.activ,b.tax_number,b.last_name,
                b.name,b.patron_name,c.town,c.indx,c.street,
                c.house,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id=b.id
        left join vw_address c on
        a.id=c.id
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region";

        $sql_c = "select * from sap_export where objectsap='PARTNER_IND' order by id_object";
        $cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();

        if(1==1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_yv_abn->createCommand($sql)->queryAll();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krr_abn->createCommand($sql)->queryAll();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    break;
            }
            // Удаляем данные в таблицах
            $zsql = 'delete from sap_init';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();

            $zsql = 'delete from sap_but000';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();

            $zsql = 'delete from sap_ekun';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();

            $zsql = 'delete from sap_but020';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();

            $zsql = 'delete from sap_but0id';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();
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
        }
        // Формируем имя файла и создаем файл
        $fd=date('Ymd');
        $fname='PARTNER_04'.'_CK'.$rem.'_'.$fd.'_07'.'_R'.'.txt';
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
        $struct_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
        foreach ($struct_data as $d) {
            $old_key=trim($d['old_key']);
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
                    $sql = "select * from $table_struct where old_key='$old_key'";
                    $cur_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
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

    // Формирование файла connobj для САП для бытовых
    public function actionSap_connobj_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС


        $sql = "select a.id,a.activ,'CK04' as pltxt,b.tax_number,b.last_name,
                b.name,b.patron_name,c.town,c.indx,c.street,
                c.house,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.swerk,const.stort,const.ver,const.begru,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id=b.id
        left join vw_address c on
        a.id=c.id
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region";

        $sql_c = "select * from sap_export where objectsap='CONNOBJ_IND' order by id_object";
        $cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();

        if(1==1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_yv_abn->createCommand($sql)->queryAll();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krr_abn->createCommand($sql)->queryAll();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    break;
            }
            // Удаляем данные в таблицах
            $zsql = 'delete from sap_co_eha';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();

            $zsql = 'delete from sap_co_adr';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();


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
       // $fname='PARTNER_04'.'_CK'.$rem.'_B'.$fd.'.txt';
        $ver=$data[0]['ver'];
        if ($ver<10) $ver='0'.$ver;
        $fname='CONNOBJ_04'.'_CK'.$rem.'_'.$fd.'_'.$ver.'_R'.'.txt';
        $f = fopen($fname,'w+');
        // Считываем данные в файл с каждой таблицы
        $i=0;
        $sql = "select * from sap_co_eha";
        $struct_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
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
                    $cur_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
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

    // Формирование файла connobj для САП для Юридических потребителей
    public function actionSap_connobj($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС

        $sql = "select a.id,'CK04' as pltxt,a.name,a.code_okpo,b.okpo_num,b.tax_num,'2' AS BU_TYPE,b.FLAG_JUR,
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
                    $data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krr_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_krr_energo->createCommand($zsql)->execute();
                    Yii::$app->db_pg_krr_energo->createCommand($zsql1)->execute();

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
                $struct_data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
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
                            $cur_data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
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

        $sql = "select distinct 'CK04' as pltxt,'PREMISE' as name, cl1.id,cl1.code, eq.name_eqp,eq.id as id_eq,
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
                    $data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
                    $cnt = \Yii::$app->db_pg_krr_energo->createCommand($sql_c)->queryAll();
                    // Удаляем данные в таблицах
                    Yii::$app->db_pg_krr_energo->createCommand($zsql)->execute();
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
                $struct_data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
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
                            $cur_data = \Yii::$app->db_pg_krr_energo->createCommand($sql)->queryAll();
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


    // Формирование файла connobj для САП для бытовых
    public function actionSap_premise_ind($res)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 900);
        $rem = '0'.$res;  // Код РЭС


        $sql = "select a.id,a.activ,'CK04' as pltxt,b.tax_number,b.last_name,
                b.name,b.patron_name,c.town,c.indx,c.street,
                c.house,c.flat,b.mob_phone,b.e_mail,const.id_res,
                const.swerk,const.stort,const.ver,const.begru,
                const.region,d.kod_reg,b.s_doc||' '||b.n_doc as pasport from clm_paccnt_tbl a
        left join clm_abon_tbl b on
        a.id=b.id
        left join vw_address c on
        a.id=c.id
        inner join sap_const const on
        1=1
        left join (select kod_reg,trim(replace(region,'район','')) as region from reg) d on
        trim(c.district)=d.region";

        $sql_c = "select * from sap_export where objectsap='PREMISE_IND' order by id_object";
        $cnt = \Yii::$app->db_pg_pv_abn_test->createCommand($sql_c)->queryAll();

        if(1==1) {
            // Получаем необходимые данные
            switch ($res) {
                case 1:
                    $data = \Yii::$app->db_pg_dn_abn->createCommand($sql)->queryAll();
                    break;

                case 2:
                    $data = \Yii::$app->db_pg_yv_abn->createCommand($sql)->queryAll();
                    break;
                case 3:
                    $data = \Yii::$app->db_pg_vg_abn->createCommand($sql)->queryAll();
                    break;
                case 4:
                    $data = \Yii::$app->db_pg_pv_abn->createCommand($sql)->queryAll();
                    break;
                case 5:
                    $data = \Yii::$app->db_pg_krr_abn->createCommand($sql)->queryAll();
                    break;
                case 6:
                    $data = \Yii::$app->db_pg_ap_abn->createCommand($sql)->queryAll();
                    break;
                case 7:
                    $data = \Yii::$app->db_pg_gv_abn->createCommand($sql)->queryAll();
                    break;
                case 8:
                    $data = \Yii::$app->db_pg_in_abn->createCommand($sql)->queryAll();
                    break;
            }
            // Удаляем данные в таблицах
            $zsql = 'delete from sap_evbsd';
            Yii::$app->db_pg_pv_abn_test->createCommand($zsql)->execute();

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
        $struct_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
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
                    $cur_data = \Yii::$app->db_pg_pv_abn_test->createCommand($sql)->queryAll();
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
    
    // Импорт отчета по КиевСтар за август 2019 года для выявления штрафников
    public function actionImport_ks_0819()
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

        $sql = "CREATE TABLE tmp_ks0819 (
              tel varchar(10) NOT NULL,
              cost_plan varchar(20) DEFAULT NULL,
              cost_all varchar(10) DEFAULT NULL,
              id int(11) NOT NULL AUTO_INCREMENT,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8";
        Yii::$app->db_phone->createCommand($sql)->execute();

        // Добавляем записи в таблицу tmp_works с csv файла list_works.csv
        // файл list_works.csv нужно предварительно сформировать
        $f = fopen('Rep0819.csv','r');
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
             
                    $sql = "INSERT INTO tmp_ks0819 (tel,cost_plan,cost_all) VALUES(".
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
        $f = fopen('new_list1.csv','r');
        $i = 0;
        while (!feof($f)) {
            $i++;
            $s = fgets($f);
            
            if($i==1) continue;
            $s=substr($s,1);
            $data = explode(";",$s);
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
                        "'".$data[0]."'".","."'".$data[2]."'".","."'".$data[6]."'".","."'".$data[5]."'".","."'".$data[4]."'".
                        ",".'null'.",".'null'.","."'".""."'".')';

                    }
                else
                    {$sql = "INSERT INTO tmp_works (tab_nom,fio,unit_2,unit_1,post,id_podr,id_name,main_unit) VALUES(".
                        "'".$data[0]."'".",".'"'.$data[2].'"'.","."'".$data[6]."'".","."'".$data[5]."'".","."'".$data[4]."'".
                        ",".'null'.",".'null'.","."'".""."'".')';
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
            
            //if($i<8) continue;
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



