<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use Yii;
use app\models\sap_connect;
use yii\data\ActiveDataProvider;
use app\models\abn_connect;
/**
 * Description of SapController
 *
 * @author root
 */
class SapController extends AppController {
    
    public $layout = 'sap_vid';
    
    public function actionGeneral(){ //головна сторінка
        $i= '';
        return $this->render('general', compact('i'));
    }
    
    
     public function actionInn(){ //головна сторінка
//        $s=Yii::$app->request->hostInfo;
//        $s= substr($s, 7,11);
         
        $sql = 'select * from clm_client_tbl where check_inn(code_okpo)= 0 and length(trim(code_okpo)) = 10';
        $s = sap_connect::findBySql($sql)->asArray()->all();
        
//        $dataProvider = new ActiveDataProvider([
//            'query' => sap_connect::findBySql($sql),
//                'pagination' => [
//                    'pageSize' => 500,
//                     ],
//            ]);
        
        
        return $this->render('inn', compact('s'));
//        return $this->render('inn',['s' => $s,'dataProvider' => $dataProvider]);
    }
    
         public function actionOkpo(){
         
        $sql = "select * from clm_client_tbl as a where code_okpo is null or length(trim(code_okpo)) < 8 or length(trim(code_okpo)) > 12
and
        (a.code>999 or  a.code=900) AND coalesce(a.idk_work,0)<>0 
	     and  a.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')
	     AND (a.code_okpo is null or trim(a.code_okpo)='')";
        $s = sap_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('okpo', compact('s'));

    }
    
      public function actionPhone(){
         
        $sql = "select p.code,length(mob_phone),mob_phone from clm_abon_tbl as a
                join clm_paccnt_tbl as p on a.id=p.id_abon
                where length(trim(mob_phone))<>10 and trim(mob_phone) <> '' "; 
        
        $s = abn_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('phone', compact('s'));

    }
    
          public function actionDoublemeter(){
         
        $sql = "select eq.name,z.code,a.id_paccnt,b.* from (
select id_type_meter,trim(num_meter) as num_meter,count(*)


from clm_meterpoint_tbl as m
join clm_paccnt_tbl as p on p.id=m.id_paccnt
where p.archive = 0
group by id_type_meter,trim(num_meter) having count(*)


>1) b
join clm_meterpoint_tbl as a
on a.id_type_meter=b.id_type_meter and trim(a.num_meter)=trim(b.num_meter)
join clm_paccnt_tbl as z
on z.id=a.id_paccnt
left join eqi_meter_tbl eq on eq.id=a.id_type_meter
where archive = 0 and a.id_type_meter not in (300000010 ,200000005,999)
order by num_meter"; 
        $s = abn_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('doublemeter', compact('s'));

    }
    
    
    
    
}
