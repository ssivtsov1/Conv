
CREATE OR REPLACE FUNCTION public.get_email(character)
  RETURNS character AS
$BODY$
DECLARE
    _arr text[];
    n int;
    c character varying;
    pos int;
BEGIN
    SELECT regexp_split_to_array($1, ',')
    INTO _arr;
    n = array_length(_arr, 1);
    pos=position(';' in $1);
    if pos>0 then
	SELECT regexp_split_to_array($1, ';')
	INTO _arr;
    end if;
return _arr[1];

end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.get_email(character)
  OWNER TO local;

-----------------------------------------------------------

CREATE OR REPLACE FUNCTION public.get_phone(character)
  RETURNS character AS
$BODY$
DECLARE
    _arr text[];
    n int;
    c character varying;
BEGIN
    SELECT regexp_split_to_array($1, ',')
    INTO _arr;
    n = array_length(_arr, 1);
    FOR i IN 1..n LOOP
	c=trim(_arr[i]);
	if length(c)=10 then
		return c;
	end if;		
    END LOOP;
    
return _arr[1];

end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.get_phone(character)
  OWNER TO local;

--------------------------------------------------------

CREATE OR REPLACE FUNCTION public.get_street(street character)
  RETURNS character AS
$BODY$
Declare
pos int;
res char(80);
begin
pos=position(' ' in $1);
res=substr($1,pos);

Return trim(res);
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.get_street(character)
  OWNER TO local;

----------------------------------------------------------------

CREATE OR REPLACE FUNCTION public.get_typestreet(street character)
  RETURNS character AS
$BODY$
Declare
pos int;
res char(10);
begin
pos=position(' ' in $1);
res=substr($1,1,pos);

Return res;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.get_typestreet(character)
  OWNER TO local;

--------------------------------------------------------------

CREATE OR REPLACE FUNCTION public.di_zw(
    integer,
    date)
  RETURNS boolean AS
$BODY$
Declare
   id_eqp       alias for $1;
   gperiod	alias for $2;
   struc record;
   id_eqp_c varchar;
begin

id_eqp_c = id_eqp::varchar;
--select * from DI_ZW_struc
drop table if exists DI_ZW_struc;
create temp table DI_ZW_struc(
OLDKEY character varying,
struc character varying(5),
KONDIGRE character varying(4),
ZWSTANDCE character varying,
pokaz numeric,
zone integer,
knde integer,
count_round integer,
ZWNABR character varying(1),
TARIFART character varying(15),
PERVERBR character varying,
value numeric,
EQUNRE character varying,
ANZDAYSOFPERIOD character varying(4),
PRUEFKLA character varying(5),
sort integer
);

insert into DI_ZW_struc
select  distinct 
 m.code_eqp::varchar as OLDKEY,
'DI_ZW' as struc,
'0001' as KONDIGRE,
replace((case when eqd.kind_energy=1 and eqz1.zone = 0 then round(ind1.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (5,10) then round(ind12d.value, 2) 	
	      when eqd.kind_energy=1 and eqz1.zone in (4,9) then round(ind12n.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (1,6) then round(ind13n.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (2,7) then round(ind13np.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (3,8) then round(ind13p.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone = 0 then round(ind4.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (5,10) then round(ind42d.value, 2) 	
	      when eqd.kind_energy=3 and eqz2.zone in (4,9) then round(ind42n.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (1,6) then round(ind43n.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (2,7) then round(ind43np.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (3,8) then round(ind43p.value, 2) 
	      when eqd.kind_energy in (2,5) and eqz3.zone = 0 then round(ind2.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (5,10) then round(ind22d.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (4,9) then round(ind22n.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (1,6) then round(ind23n.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (2,7) then round(ind23np.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (3,8) then round(ind23p.value, 2)   
	      
	      when eqd.kind_energy in (4,6) and eqz4.zone = 0  then round(ind3.value, 2)    
	      when eqd.kind_energy in (4,6) and eqz4.zone in (4,9)  then round(ind32n.value, 2) 
	      when eqd.kind_energy in (4,6) and eqz4.zone in (1,6)  then round(ind33n.value, 2) 
	      end)::varchar,'.',',') as ZWSTANDCE,
              
	 case when eqd.kind_energy=1 and eqz1.zone = 0 then round(ind1.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (5,10) then round(ind12d.value, 2) 	
	      when eqd.kind_energy=1 and eqz1.zone in (4,9) then round(ind12n.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (1,6) then round(ind13n.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (2,7) then round(ind13np.value, 2) 
	      when eqd.kind_energy=1 and eqz1.zone in (3,8) then round(ind13p.value, 2) 
	      
	      when eqd.kind_energy=3 and eqz2.zone = 0 then round(ind4.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (5,10) then round(ind42d.value, 2) 	
	      when eqd.kind_energy=3 and eqz2.zone in (4,9) then round(ind42n.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (1,6) then round(ind43n.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (2,7) then round(ind43np.value, 2) 
	      when eqd.kind_energy=3 and eqz2.zone in (3,8) then round(ind43p.value, 2) 
	      
	      when eqd.kind_energy in (2,5) and eqz3.zone = 0 then round(ind2.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (5,10) then round(ind22d.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (4,9) then round(ind22n.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (1,6) then round(ind23n.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (2,7) then round(ind23np.value, 2)   
	      when eqd.kind_energy in (2,5) and eqz3.zone in (3,8) then round(ind23p.value, 2)   
	      
	      when eqd.kind_energy in (4,6) and eqz4.zone = 0  then round(ind3.value, 2)    
	      when eqd.kind_energy in (4,6) and eqz4.zone in (4,9)  then round(ind32n.value, 2) 
	      when eqd.kind_energy in (4,6) and eqz4.zone in (1,6)  then round(ind33n.value, 2) 
	      end as pokaz,
              case when eqz1.zone is not null and eqd.kind_energy=1 then  eqz1.zone 
                   when eqz2.zone is not null and eqd.kind_energy=3 then eqz2.zone 
                   when eqz3.zone is not null and eqd.kind_energy in (2,5) then eqz3.zone  
                   when eqz4.zone is not null and eqd.kind_energy in (4,6) then eqz4.zone   
                   else null end as zone, --,eqz2.zone,eqz3.zone,eqz4.zone,eqd.kind_energy,

                   case when eqd.kind_energy=1 then 1 when eqd.kind_energy in (2,5)then 2 when eqd.kind_energy=3 then 3 when eqd.kind_energy in (4,6) then 4 else null end as knde,
               2,
'' as ZWNABR,
case when eqd.kind_energy=1 and eqz1.zone = 0 then 'А_1З' 
     when eqd.kind_energy=1 and eqz1.zone in (5,10)  then 'А_2ЗД' 
     when eqd.kind_energy=1 and eqz1.zone in (4,9)  then 'А_2ЗН' 
     when eqd.kind_energy=1 and eqz1.zone in (1,6)  then 'А_3ЗН' 
     when eqd.kind_energy=1 and eqz1.zone in (2,7)  then 'А_3ЗНП' 
     when eqd.kind_energy=1 and eqz1.zone in (3,8)  then 'А_3ЗП' 

     when eqd.kind_energy=3 and eqz2.zone = 0 then 'А-_1З' 
     when eqd.kind_energy=3 and eqz2.zone in (5,10)  then 'А-_2ЗД' 
     when eqd.kind_energy=3 and eqz2.zone in (4,9)  then 'А-_2ЗН' 
     when eqd.kind_energy=3 and eqz2.zone in (1,6)  then 'А-_3ЗН' 
     when eqd.kind_energy=3 and eqz2.zone in (2,7)  then 'А-_3ЗНП' 
     when eqd.kind_energy=3 and eqz2.zone in (3,8)  then 'А-_3ЗП' 
     
     when eqd.kind_energy in (2,5) and eqz3.zone = 0 then  'Р_1З'         
     when eqd.kind_energy in (2,5) and eqz3.zone in(5,10) then  'Р_2ЗД' 
     when eqd.kind_energy in (2,5) and eqz3.zone in (4,9) then 'Р_2ЗН'     
     when eqd.kind_energy in (2,5) and eqz3.zone in (1,6) then  'Р_3ЗН' 
     when eqd.kind_energy in (2,5) and eqz3.zone in (2,7) then  'Р_3ЗНП' 
     when eqd.kind_energy in (2,5) and eqz3.zone in (3,8) then 'Р_3ЗП' 

     when eqd.kind_energy in (4,6) and eqz4.zone = 0 then 'Г_1З'  
     when eqd.kind_energy in (4,6) and eqz4.zone in (4,9)  then 'Г_2ЗН'  
     when eqd.kind_energy in (4,6) and eqz4.zone in (1,6) then 'Г_3ЗН'    
     end as TARIFART,
replace(coalesce((case when eqd.kind_energy=1 and eqz1.zone = 0 then round(ind1.value_dem,0)  
		       when eqd.kind_energy=1 and eqz1.zone in (5,10) then round(ind12d.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (4,9)  then round(ind12n.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (1,6) then round(ind13n.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (2,7) then round(ind13np.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (3,8) then round(ind13p.value_dem,0) 
		       
		       when eqd.kind_energy in (2,5) and eqz3.zone = 0 then round(ind2.value_dem,0)  
		       when eqd.kind_energy in (2,5) and eqz3.zone in (5,10) then round(ind22d.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (4,9) then round(ind22n.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (1,6) then round(ind23n.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (2,7) then round(ind23np.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (3,8) then round(ind23p.value_dem,0)
		       
		       when eqd.kind_energy in (4,6) and eqz4.zone = 0  then round(ind3.value_dem,0) 
		       when eqd.kind_energy in (4,6) and eqz4.zone in (4,9) then round(ind32n.value_dem,0) 
		       when eqd.kind_energy in (4,6) and eqz4.zone in (1,6) then round(ind33n.value_dem,0) 

		          when eqd.kind_energy =3 and eqz2.zone = 0 then round(ind4.value_dem,0)  
		       when eqd.kind_energy =3 and eqz2.zone in (5,10) then round(ind42d.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (4,9) then round(ind42n.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (1,6) then round(ind43n.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (2,7) then round(ind43np.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (3,8) then round(ind43p.value_dem,0)
		       
		       end),0)::varchar,'.',',') as PERVERBR,

		       coalesce((case when eqd.kind_energy=1 and eqz1.zone = 0 then round(ind1.value_dem,0)  
		       when eqd.kind_energy=1 and eqz1.zone in (5,10) then round(ind12d.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (4,9)  then round(ind12n.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (1,6) then round(ind13n.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (2,7) then round(ind13np.value_dem,0) 
		       when eqd.kind_energy=1 and eqz1.zone in (3,8) then round(ind13p.value_dem,0) 
		       
		       when eqd.kind_energy in (2,5) and eqz3.zone = 0 then round(ind2.value_dem,0)  
		       when eqd.kind_energy in (2,5) and eqz3.zone in (5,10) then round(ind22d.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (4,9) then round(ind22n.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (1,6) then round(ind23n.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (2,7) then round(ind23np.value_dem,0) 
		       when eqd.kind_energy in (2,5) and eqz3.zone in (3,8) then round(ind23p.value_dem,0)
		       
		       when eqd.kind_energy in (4,6) and eqz4.zone = 0  then round(ind3.value_dem,0) 
		       when eqd.kind_energy in (4,6) and eqz4.zone in (4,9) then round(ind32n.value_dem,0) 
		       when eqd.kind_energy in (4,6) and eqz4.zone in (1,6) then round(ind33n.value_dem,0) 

		          when eqd.kind_energy =3 and eqz2.zone = 0 then round(ind4.value_dem,0)  
		       when eqd.kind_energy =3 and eqz2.zone in (5,10) then round(ind42d.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (4,9) then round(ind42n.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (1,6) then round(ind43n.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (2,7) then round(ind43np.value_dem,0) 
		       when eqd.kind_energy =3 and eqz2.zone in (3,8) then round(ind43p.value_dem,0)
		       
		       end),0) as value,
 m.code_eqp::varchar as EQUNRE,
'30' as ANZDAYSOFPERIOD,
'0002' as PRUEFKLA,
case when eqd.kind_energy=1 and eqz1.zone = 0 then 1 
     when eqd.kind_energy=1 and eqz1.zone in (5,10)  then 2
     when eqd.kind_energy=1 and eqz1.zone in (4,9)  then 3 
     when eqd.kind_energy=1 and eqz1.zone in (1,6)  then 6 
     when eqd.kind_energy=1 and eqz1.zone in (2,7)  then 5 
     when eqd.kind_energy=1 and eqz1.zone in (3,8)  then 4 

     when eqd.kind_energy=3 and eqz2.zone = 0 then 7 
     when eqd.kind_energy=3 and eqz2.zone in (5,10)  then 8
     when eqd.kind_energy=3 and eqz2.zone in (4,9)  then 9
     when eqd.kind_energy=3 and eqz2.zone in (1,6)  then 12
     when eqd.kind_energy=3 and eqz2.zone in (2,7)  then 11
     when eqd.kind_energy=3 and eqz2.zone in (3,8)  then 10
     
     when eqd.kind_energy in (2,5) and eqz3.zone = 0 then  13        
     when eqd.kind_energy in (2,5) and eqz3.zone in(5,10) then  14 
     when eqd.kind_energy in (2,5) and eqz3.zone in (4,9) then 15     
     when eqd.kind_energy in (2,5) and eqz3.zone in (1,6) then  18
     when eqd.kind_energy in (2,5) and eqz3.zone in (2,7) then  17 
     when eqd.kind_energy in (2,5) and eqz3.zone in (3,8) then 16

     when eqd.kind_energy in (4,6) and eqz4.zone = 0 then 19 
     when eqd.kind_energy in (4,6) and eqz4.zone in (4,9)  then 20 
     when eqd.kind_energy in (4,6) and eqz4.zone in (1,6) then 21   
     end as sort
from eqm_meter_tbl as m
join eqm_equipment_tbl as eq on (m.code_eqp = eq.id)  
left join eqd_meter_energy_h as eqd on (eqd.code_eqp = m.code_eqp and dt_e is null)
left join eqd_meter_zone_h as eqz1 on (eqz1.code_eqp = m.code_eqp and eqz1.dt_e is null and eqz1.kind_energy =1)
left join eqd_meter_zone_h as eqz2 on (eqz2.code_eqp = m.code_eqp and eqz2.dt_e is null and eqz2.kind_energy =3)
left join eqd_meter_zone_h as eqz3 on (eqz3.code_eqp = m.code_eqp and eqz3.dt_e is null and eqz3.kind_energy in(2,5))
left join eqd_meter_zone_h as eqz4 on (eqz4.code_eqp = m.code_eqp and eqz4.dt_e is null and eqz4.kind_energy in(4,6))
left join eqm_meter_point_h as mp on (mp.id_meter = eq.id and mp.dt_e is null) 
left join eqm_point_tbl as pp on (pp.code_eqp = mp.id_point ) 
--left join sap_type_meter_tbl as typ on typ.id_type_meter = m.id_type_eqp
left join eqi_meter_tbl as t on t.id = m.id_type_eqp
left join (select * from acd_indication_tbl as ind1 where ind1.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =1 and id_zone = 0 and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind1 on ind1.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind1 where ind1.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =1 and id_zone in (5,10) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind12d on ind12d.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind1 where ind1.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =1 and id_zone in (4,9) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind12n on ind12n.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind1 where ind1.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =1 and id_zone in (1,6) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind13n on ind13n.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind1 where ind1.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =1 and id_zone in (2,7) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind13np on ind13np.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind1 where ind1.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =1 and id_zone in (3,8) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind13p on ind13p.id_meter = m.code_eqp 

left join (select * from acd_indication_tbl as ind2 where ind2.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (2,5) and id_zone = 0 and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind2 on ind2.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind2 where ind2.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (2,5) and id_zone in (5,10) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind22d on ind22d.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind2 where ind2.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (2,5) and id_zone in (4,9) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind22n on ind22n.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind2 where ind2.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (2,5) and id_zone in (1,6) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind23n on ind23n.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind2 where ind2.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (2,5) and id_zone in (2,7) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind23np on ind23np.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind2 where ind2.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (2,5) and id_zone in (3,8) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind23p on ind23p.id_meter = m.code_eqp 

left join (select * from acd_indication_tbl as ind3 where ind3.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (4,6) and id_zone = 0 and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind3 on ind3.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind3 where ind3.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (4,6) and id_zone in (4,9) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind32n on ind32n.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind3 where ind3.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy in (4,6) and id_zone in (1,6) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind33n on ind33n.id_meter = m.code_eqp 

left join (select * from acd_indication_tbl as ind4 where ind4.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =3 and id_zone = 0 and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind4 on ind4.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind4 where ind4.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =3 and id_zone in (5,10) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind42d on ind42d.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind4 where ind4.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =3 and id_zone in (4,9) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind42n on ind42n.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind4 where ind4.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =3 and id_zone in (1,6) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind43n on ind43n.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind4 where ind4.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =3 and id_zone in (2,7) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind43np on ind43np.id_meter = m.code_eqp 
left join (select * from acd_indication_tbl as ind4 where ind4.id =(SELECT id FROM acd_indication_tbl WHERE  mmgg< gperiod and kind_energy =3 and id_zone in (3,8) and id_meter=id_eqp order by dat_ind desc limit 1 ) ) as ind43p on ind43p.id_meter = m.code_eqp 
where m.code_eqp = id_eqp
order by 14;


insert into DI_ZW_struc
select  '','DI_ZW ','',  replace(sum(pokaz)::varchar,'.',','),null,null,knde,null,'X','','',null,
id_eqp_c::varchar,null,'',null 
from DI_ZW_struc
where zone<>0
group by knde;

                            
return true;
  end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.di_zw(integer, date)
  OWNER TO postgres;


CREATE OR REPLACE FUNCTION public.get_num_cnt(character)
  RETURNS character AS
$BODY$
Declare
code Alias for $1;
i integer;
r char(1);
result char(25);
y integer;
flag integer;
begin
i:=1;
result='';
flag=0;
y=length(trim($1));

while i<=y  loop
	r=substr($1,i,1);
	if (i=1 and r<>'0') then
		result=trim($1);
		exit;
	end if;	
		
	if (flag=0 and r='0') then
		flag=0;
	else
		flag=1;
	end if;

	if flag=1 then
		result=result||r;
	end if;	
										
	i=i+1;
	
end loop;

Return result;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.get_num_cnt(character)
  OWNER TO postgres;


CREATE OR REPLACE FUNCTION public.get_tp(integer)
  RETURNS integer AS
$BODY$
Declare
code Alias for $1;
t integer;
r integer;
c1 integer;
c2 integer;
begin
t:=1;
--select  into t type_eqp from eqm_eqp_tree_tbl a
--	join eqm_equipment_tbl b on a.code_eqp=b.id
--	where b.id=$1; 
select  into c1 code_eqp_e from eqm_eqp_tree_tbl a
	join eqm_equipment_tbl b on a.code_eqp=b.id
	where b.id=$1; 
--c1 = $1;	
while t<>2  loop
	r=c1;
	
	select type_eqp into t from eqm_eqp_tree_tbl a
	join eqm_equipment_tbl b on a.code_eqp=b.id
	where a.code_eqp=c1; 
	select code_eqp_e into c1 from eqm_eqp_tree_tbl a
	join eqm_equipment_tbl b on a.code_eqp=b.id
	where a.code_eqp=c1; 
end loop;

Return r;
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.get_tp(integer)
  OWNER TO postgres;

CREATE OR REPLACE FUNCTION public.get_element_str(
    character,
    integer)
  RETURNS character AS
$BODY$
DECLARE
    _arr text[];
BEGIN
    SELECT regexp_split_to_array($1, ',')
    INTO _arr;
return _arr[$2];
end;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.get_element_str(character, integer)
  OWNER TO local;




