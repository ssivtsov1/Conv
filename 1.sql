select a.zp,a.common_minus,a.time_transp,a.tmc,a.repair,a.usluga,a.other, b.* from costwork a left join a_transport b on trim(a.work)=trim(b.number) where a.work like "%Фрез%" 

select * from a_transport where number='Обслуговування ПЛ 35кВ  (1 опора) ТОВ "Фрезія" (ПС 35/10 кВ та ПЛ 35кВ)'

update `1c` 
set main_unit = trim(BOTH ord(13) FROM main_unit)
