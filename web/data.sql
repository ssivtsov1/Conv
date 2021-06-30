1. Новые работники:

SELECT cast(a.tab_nom as dec(4,0)) as tnom,a.* FROM tmp_works_new a 
where cast(a.tab_nom as dec(4,0)) not in(select tab_nom from 1c)

2. Уволенные:

SELECT a.* FROM 1c a 
where a.tab_nom not in(select cast(tab_nom as dec(4,0)) from tmp_works_new)

3. Переведенные:

SELECT a.* FROM vw_phone a 
where a.tab_nom not in(select cast(tab_nom as dec(4,0)) from tmp_works_new)
and a.fio in(
SELECT b.fio FROM tmp_works_new b 
where cast(b.tab_nom as dec(4,0)) not in(select tab_nom from 1c))

SELECT distinct * FROM `spr_towns` 
order by obl,district,town,street


update tmp_works_new a,1c 
set a.main_unit=1c.main_unit
where a.unit_1=1c.unit_1


SELECT a.* FROM `tmp_works_new` a, `tmp_works` b WHERE a.tab_nom=b.tab_nom and a.unit_1<>b.unit_1 and a.unit_1 not like '%РЕМ%' 

insert into 1c (tab_nom,unit_1,id_podr,unit_2,post,fio,remark,id_name,main_unit)
SELECT tab_nom,unit_1,id_podr,unit_2,post,fio,remark,id_name,main_unit FROM `tmp_works_new` 
