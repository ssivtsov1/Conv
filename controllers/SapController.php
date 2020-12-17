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
    
              public function actionPlosh(){

        $sql = "select lic_schet,short_name,count(*)
as kol from
(select distinct on(zz_eic) u.tarif_sap,case when qqq.oldkey is null then trim(yy.oldkey) else trim(qqq.oldkey) end as vstelle,
www.short_name as real_name,www.code as lic_schet,const.ver,const.begru,
'10' as sparte,qqq.* from
(select distinct on(q1.num_eqp) q1.id,x.oldkey,cc.short_name,
case when q.id_cl=2062 then rr.id_client else q.id_cl end as id_potr,
q1.num_eqp as zz_eic,q.* from
(select distinct 'DATA' as DATA,c.id as id_cl,
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
'2020-01-01' as AB,
case when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 13 then 'CN_4HN1_01???'
when coalesce(c2.idk_work,0)=99 and p.id_classtarif = 14 then 'CN_4HN2_01???'
else
case when p.id_tarif in (27,28,150,900001,900002) then 'CN_2TH2_01???'
else '???' --tar_sap.id_sap_tar
end
end as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
when st.id_section = 202 then '50'
when st.id_section = 203 then '60'
when st.id_section in(210,211,213,214,215) then '68'
when c2.idk_work = 99 then '72'
else '67' end as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' then '0004' else '0002' end as AKLASSE,
'PC01311' as ABLEINH,
case when tgr.ident in('tgr1') and tcl.ident='tcl1' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '004'
when tgr.ident in('tgr2') and tcl.ident='tcl1' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '012'
when tgr.ident in('tgr6') and tcl.ident='tcl1' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '020'
when tgr.ident in('tgr3') and tcl.ident='tcl1' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '028'
when tgr.ident in('tgr4') and tcl.ident='tcl1' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '036'
when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl1' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '044'
when tgr.ident in('tgr1') and tcl.ident='tcl2' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '054'
when tgr.ident in('tgr2') and tcl.ident='tcl2' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '060'
when tgr.ident in('tgr6') and tcl.ident='tcl2' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '066'
when tgr.ident in('tgr3') and tcl.ident='tcl2' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '072'
when tgr.ident in('tgr4') and tcl.ident='tcl2' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '078'
when tgr.ident in('tgr5',' tgr8_62','tgr8_63') and tcl.ident='tcl2' and st.id_section not in (208,218) and tar.id not in (900001,999999) then '084'
when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) in (1009,1017,1018,1019,1020,1021,1001)then '286'
when tgr.ident in('tgr8_32','tgr8_4','tgr8_10','tgr8_30') and coalesce(st.id_section,1009) =1010 then '288'
when tgr.ident in('tgr8_10','tgr8_30') then '298'
when tgr.ident in('tgr8_12','tgr8_22','tgr8_32','tgr8_4') then '300'
when tgr.ident in('tgr7_1','tgr7_11','tgr7_21','tgr7_211','tgr7_21','tgr7_211') and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '352'
when ((tgr.ident='tgr7_12') or (tgr.ident='tgr7_22') or (tgr.ident= 'tgr7_13') or (tgr.ident = 'tgr7_23') or (tgr.ident= 'tgr8_101') or (tgr.ident = 'tgr8_61') ) and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '354'
when tgr.ident in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '384'
when (tgr.ident ~ 'tgr7_51') and tgr.ident not in ('tgr7_511','tgr7_514','tgr7_5141') and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '385'
when coalesce(st.id_section,1007) in (1007,1008) and (tgr.ident ~ 'tgr7_52') and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) and tar.id not in (900001,999999) then '391'
when tgr.ident~ 'tgr7_521' and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '392'
when tgr.ident ~ 'tgr7_522' and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '394'
when tgr.ident in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '402'
when (tgr.ident ~ 'tgr7_61') and tgr.ident not in ('tgr7_611','tgr7_614','tgr7_6141') and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '403'
when coalesce(st.id_section,1015) in (1015,1016,1007,1008) and (tgr.ident ~ 'tgr7_62') and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218)then '409'
when tgr.ident ~ 'tgr7_621' and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '410'
when tgr.ident ~ 'tgr7_622' and tcl.ident='tcl2' and c.idk_work <> 0 and st.id_section not in (208,218) then '412'
when tgr.ident in ( 'tgr7_15','tgr7_25','tgr7_35','tgr7_53','tgr7_63','tgr7_7') then '414'
when tcl.ident='tcl1' and st.id_section = 209 and tar.id not in (900001,999999) then '574'
when tcl.ident='tcl2' and st.id_section = 209 and tar.id not in (900001,999999) then '582'
when c.idk_work=99 and p.voltage_min>10 and tcl.ident='tcl1' then '604'
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
join eqm_equipment_h as eqh on (eq.id=eqh.id and eqh.dt_b = (SELECT dt_b FROM eqm_equipment_h WHERE id = eq.id order by dt_b desc limit 1 ) )
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
left join sap_evbsd yy on case when trim(yy.haus)='' then 0 else coalesce(substr(yy.haus,9)::integer,0) end=qqq.id_potr
left join clm_client_tbl www on www.id=qqq.id_potr
inner join sap_const const on 1=1
where --qqq.id_potr is not null and www.code<>999
--www.code<>999
--and
--qqq.id=116541
--and
(www.code>999 or www.code=900) AND coalesce(www.idk_work,0)<>0
and www.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')
and yy.oldkey is null
) obana
group by 1,2
having count(*)>1"; 
        
        $s = sap_connect::findBySql($sql)->asArray()->all();


        return $this->render('plosh', compact('s'));

    }
    
    
             public function actionYspoj(){
         
        $sql = "select town,street,id,code,name from (
select distinct a.code,a.id,a.name,a.code_okpo,b.okpo_num,b.tax_num,'2' AS BU_TYPE,b.FLAG_JUR,
case when substr(trim(a.name),1,4)='ФОП ' or substr(trim(a.name),1,3)='ФО ' or position('Фізична особа ' in a.name)>0 
then '03' else '02' end as BU_GROUP,
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
UPPER(am.building) as house,UPPER(am.office) as flat,
b.phone,get_email(b.e_mail) as e_mail,ads.reg,ads.numobl
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
       LEFT JOIN addr_sap ads on trim(ads.town)=trim(kt.shot_name)||' '||trim(t.name) and trim(ads.street)=get_typestreet1(trim(ks.shot_name))||' '||trim(s.name)
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and '07'='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end 
        and case when trim(kt.shot_name)||' '||trim(t.name)='с. Грузьке' and '07'='05' then trim(ads.reg)='DNP' else 1=1 end 
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Червоне' and '07'='05' then trim(ads.reg)='DNP' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Вільне' and '07'='07' then trim(ads.rnobl)='Новомосковський район' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(t.name)='с. Степове' and '07'='05' then trim(ads.rnobl)='Криворізький район' else 1=1 end
         and case when trim(kt.shot_name)||' '||trim(replace(t.name,chr(39),'')) = 'с. Камянка' and '07'='06' then trim(ads.reg)='DNP' else 1=1 end   
       -- LEFT JOIN post_index_sap b2 on ads.numtown=b2.numtown and b2.post_index::integer=am.post_index
        
       LEFT JOIN (select distinct numtown,first_value(post_index) over(partition by numtown) as post_index from  post_index_sap) b2
         on ads.numtown=b2.numtown --and b2.post_index::integer=am.post_index
        WHERE 
        (a.code>999 or  a.code=900) AND coalesce(a.idk_work,0)<>0 
	     and  a.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')
 and (trim(s.name)='' or trim(t.name)='' or s.name is null or t.name is null)
) v"; 
        
        $s = sap_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('yspoj', compact('s'));

    } 
    
             public function actionMissingaddres(){
         
        $sql = "SELECT row_number() OVER() as num,eq.id,c.code,c.name from eqm_equipment_tbl as eq
left join eqm_eqp_use_tbl as use on (use.code_eqp = eq.id)
left join eqm_eqp_tree_tbl ttr on ttr.code_eqp = eq.id
left join eqm_tree_tbl tr on tr.id = ttr.id_tree
left join clm_client_tbl as c on (c.id = coalesce (use.id_client, tr.id_client))
where eq.type_eqp=12 and
(c.code>999 or c.code=900) AND coalesce(c.idk_work,0)<>0
and c.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')
and (eq.id_addres is null or eq.id_addres=0)"; 
        $s = sap_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('missingaddres', compact('s'));

    } 
    
                 public function actionMissingarea(){
   /*
        $sql = "select a.code,a.name from clm_client_tbl a where a.code not in
(select code from
(select p.code_eqp as oldkey, area.id_area as VSTELLE,cl1.code,cl1.name
from eqm_point_tbl as p
left join (select ins.code_eqp, eq3.id as id_area
from eqm_compens_station_inst_tbl as ins
join eqm_equipment_tbl as eq3 on (eq3.id = ins.code_eqp_inst and eq3.type_eqp = 11) ) as area on (area.code_eqp = p.code_eqp)
join eqm_area_tbl as dt on dt.code_eqp=area.id_area
left join clm_client_tbl as cl1 on (cl1.id=dt.id_client)
where p.code_eqp in (select id from eqm_equipment_tbl where type_eqp = 12) --and area.id_area is null
and (cl1.code>999 or cl1.code=900) AND coalesce(cl1.idk_work,0)<>0
and cl1.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')
) x)
and (a.code>999 or a.code=900) AND coalesce(a.idk_work,0)<>0
and a.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')";
 */

                     // Получаем дату ab

                     $date_ab='2020-05-01';

   $sql="select row_number() over() as npp,ww.code,ww.name,qq.zz_nametu,qq.zz_eic,qq.id from (
select distinct on(zz_eic) u.tarif_sap,case when qqq.oldkey is null then trim(yy.oldkey) else trim(qqq.oldkey) end as vstelle,
www.short_name as real_name,const.ver,const.begru_all as begru,
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
end  as TARIFTYP,p.vid_trf,
case when st.id_section = 201 then '02'
     when st.id_section = 202 then '50'
     when st.id_section = 203 then '60'
     when st.id_section in(210,211,213,214,215) then '68'
     when c2.idk_work = 99 then '72'
     else '67' end  as BRANCHE,
--case when c2.idk_work = 99 then '0004' else '0002' end as AKLASSE,
case when c.code = '900' then '0004' else '0002' end as AKLASSE,
     'PC010131' as ABLEINH,
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
left join sap_evbsd yy on case when trim(yy.haus)='' then 0 else coalesce(substr(yy.haus,9)::integer,0) end=qqq.id_potr
left join clm_client_tbl www on www.id=qqq.id_potr
inner join sap_const const on 1=1
where qqq.id_potr is not null and www.code<>999 
and
(www.code>999 or  www.code=900) AND coalesce(www.idk_work,0)<>0 
	     and  www.code not in('20000556','20000565','20000753',
	     '20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
	     '10999999','11000000','19999369','50999999','1000000','1000001')
and id_cl<>2062 
-- and (yy.oldkey is not null or qqq.oldkey is not null)
) qq
left join (select eq.*,c.code,c.name,c.idk_work,c.id as id_cl,u.* from eqm_equipment_tbl eq
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
	) ww on ww.num_eqp=qq.zz_eic
where qq.vstelle is null ";

        $s = sap_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('missingarea', compact('s'));

    }
    
    public function actionDownloadsap() {
        
        
        $arr_upload = ['ACCOUNT', 'CONNOBJ','DEVGRP','DEVICE','DEVLOC','DISCDOC','DISCENTER','DISCORDER','DOCUMENT','FACTS','INST_MGMT','INSTLN','INSTLNCHA','MOVE_IN','PARTNER','PREMISE','SEALS','ZLINES','ZPAY_CA','ZSIGN_CA','ZTRANSF'];
        $dn = 'DOCUMENT_POST';
        $rem = [1=>'192.168.15.15',2=> 'Zv',3=> 'Vg',4=> 'Pv',5=> 'Kr',6=> 'Ap',7=> 'Gv',8=> 'In'];
        $a = '04';
        // date_default_timezone_set('UTC');
        // $c = date ('Ymd');
        $c1 = '20201106';
        $d = '08_L.txt';
        $i = 0;
        $g = 0;
        $k = 0;
        $m = 0;
        $n = 0;
        $o = 0;
        $e = 0;
        $t = 0;
        $r = 0;
        $count1=0;
        $count2=0;
        $count3=0;
        $count4=0;
        $count5=0;
        $count6=0;
        $count7=0;
        $count8=0;
        for ($j=1;$j<9;$j++){
            $b = 'CK0'.$j;
        if ($j==1){
            while ($i < count($arr_upload)) {
                $file = file_get_contents($rem[1].chr(47).'var/www/html/Conv/web'.chr(47). $arr_upload[$i].'_'.$a.'_'.$b.'_'.$c1.'_'.$d);
                
                $folder = $rem[1].chr(47).'var/www/html/Conv/web'.chr(47).$arr_upload[$i].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                file_put_contents($folder, $file);
//                        debug($file);
//                        debug($folder);
//                      return;
//                echo copy($file,$folder);
                $i++;
                $count1++;
            }
        }
         die;
        if ($j==2){
            while ($g < count($arr_upload)) {
                $file = ''. chr(92).$rem[2]. chr(92).$arr_upload[$g].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                $folder = ''. chr(92).$arr_upload[$g].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                echo copy($file,$folder);
                $g++;
                $count2++;
            }
        }
        if ($j==3){
            while ($k < count($arr_upload)) {
                $file = ''. chr(92).$rem[3]. chr(92).$arr_upload[$k].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                $folder = ''. chr(92).$arr_upload[$k].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                echo copy($file,$folder);
                $k++;
                $count3++;
            }
        }
        if ($j==4){
            while ($m < count($arr_upload)) {
                $file = ''. chr(92).$rem[4]. chr(92).$arr_upload[$m].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                $folder = ''. chr(92).$arr_upload[$m].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                echo copy($file,$folder);
                $m++;
                $count4++;
            }
        }
        if ($j==5){
            while ($n < count($arr_upload)) {
                $file = ''. chr(92).$rem[5]. chr(92).$arr_upload[$n].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                $folder = ''. chr(92).$arr_upload[$n].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                if ( copy($file,$folder) == true) $count5++;
                $n++;
            }
        }
        if ($j==6){
            while ($o < count($arr_upload)) {
                $file = ''. chr(92).$rem[6]. chr(92).$arr_upload[$o].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                $folder = ''. chr(92).$arr_upload[$o].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                if ( copy($file,$folder) == true) $count6++;
                $o++;
            }
        }
        if ($j==7){
            while ($e < count($arr_upload)) {
                $file = ''. chr(92).$rem[7]. chr(92).$arr_upload[$e].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                $folder = ''. chr(92).$arr_upload[$e].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                echo copy($file,$folder);
                $e++;
                $count7++;
            }
        }
        if ($j==8){
            while ($t < count($arr_upload)) {
                $file = ''. chr(92).$rem[8]. chr(92).$arr_upload[$t].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                $folder = ''. chr(92).$arr_upload[$t].'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
                if ( copy($file,$folder) == true) $count8++;
                $t++;
            }
        }
        }
        $file = ''. chr(92).$rem[1].chr(92).$dn.'_'.$a.'_'.'CK01'.'_'.$c1.'_'.$d;
        $folder = ''. chr(92).$dn.'_'.$a.'_'.$b.'_'.$c1.'_'.$d;
        // echo copy($file,$folder);
        $r = $count1+$count2+$count3+$count4+$count5+$count6+$count7+$count8+1;
        

         return $this->render('downloadsap', compact('r'));

    }


    
    
    
    public function actionMissingcategory(){
   
   // $date_ab='2020-05-01';

    $sql="select vkona,zz.name from (
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
(select 'INIT' as struct,a.id,a.code as vkona,const.vktyp as vktyp,'04_C'||''||'P_'||a.id as gpart
from clm_client_tbl as a
left join clm_statecl_tbl as b on a.id = b.id_client
inner join sap_const const on 1=1
WHERE
--a.code_okpo<>'' and a.code_okpo<>'000000000'
-- and a.code_okpo<>'0000000'
--and a.code_okpo<>'000000'
(a.code>999 or a.code=900) AND coalesce(a.idk_work,0)<>0
and a.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')
) s1
left join
--VK
(select 'VK' as struct,cl.id,
case when length((case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar)=1
then '0'||(case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar
else (case when st.dt_indicat=31 then '01' else (st.dt_indicat+ 1) end )::varchar end as ZDATEREP
from clm_client_tbl as cl
left join clm_statecl_tbl as st on cl.id = st.id_client
inner join sap_const const on 1=1
WHERE
-- cl.code_okpo<>'' and cl.code_okpo<>'000000000'
-- and cl.code_okpo<>'0000000'
-- and cl.code_okpo<>'000000'
(cl.code>999 or cl.code=900) AND coalesce(cl.idk_work,0)<>0
and cl.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')
) s2 on s1.id=s2.id
left join
-- VKP
(select distinct 'VKP' as struct,cl.id,vktyp as vktyp,'04_C'||''||'P_'||cl.id as partner,const.opbuk,51 as ikey,13 as mahnv,
const.begru_all as begru,b.adext_addr as adrnb_ext,
'0005' as ZAHLKOND,'0002' as VERTYP,
case when coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)=99 then '04'
when coalesce(st.flag_budjet,0)=0 and coalesce(cl.idk_work,0)<>99 then '02'
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
'' as ZZ_MINISTRY,
replace((case when st.doc_dat<'2019-01-01' then '2019-01-01' else st.doc_dat end)::varchar ,'-','') as ZZ_START,
'' as ZZ_END,'' as ZZ_BUDGET,ww.ZZ_TERRITORY as ZZ_TERRITORY
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
(cl.code>999 or cl.code=900) AND coalesce(cl.idk_work,0)<>0
and cl.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')
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
(cl.code>999 or cl.code=900) AND coalesce(cl.idk_work,0)<>0
and cl.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')
) s4 on s3.id=s4.id
left join
--ZSTAT
(select 'ZSTAT' as struct,cl.id,'CONT07' as obj,
case when ('04'='01' or '04'='02') and
(substr(cl.short_name,1,3)='РП ' or substr(cl.short_name,1,2)='Р ') then 'CON005' else 'CON003' end as status,
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
(cl.code>999 or cl.code=900) AND coalesce(cl.idk_work,0)<>0
and cl.code not in('20000556','20000565','20000753',
'20555555','20888888','20999999','30999999','40999999','41000000','42000000','43000000',
'10999999','11000000','19999369','50999999','1000000','1000001')

) s5 on s4.id=s5.id
-- where s1.id>=13060 and s1.id<=13075
) z
left join clm_client_tbl zz on zz.code=z.vkona
where zz_categ is null";

        $s = sap_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('missingcategory', compact('s'));

    }
    
    
              public function actionExsistmeter(){
         
        $sql = "select p.code,mm.id_type_meter,e.name from (select SUBSTRING(oldkey,9)::int as id_paccnt from sap_EGPLD) as z
left join clm_paccnt_tbl as p on p.id=z.id_paccnt
left join clm_meterpoint_tbl as mm on mm.id_paccnt=p.id
left join eqi_meter_tbl as e on e.id=mm.id_type_meter
where z.id_paccnt not in 
(select c.id_paccnt from sap_EGERS d join clm_meterpoint_tbl c on SUBSTRING(d.oldkey,9)::int = c.id)"; 
        $s = abn_connect::findBySql($sql)->asArray()->all();
   
        return $this->render('exsistmeter', compact('s'));

    }
    
}
