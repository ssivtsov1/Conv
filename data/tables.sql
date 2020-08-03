------------------- TAbles ------------------------------------

CREATE TABLE public.sap_auto
(
  oldkey character varying(40),
  dat_type character varying(40),
  scat character(30),
  scode character varying(50),
  status character(1),
  color character(1),
  utmas character(40),
  dpurch character(8),
  reper character(40),
  dissue character(8),
  matnr character(80),
  sernr character(18),
  place character(8),
  dinst character(8)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_auto
  OWNER TO postgres;

CREATE TABLE public.sap_auto1
(
  oldkey character varying(40),
  dat_type character varying(40),
  matnr character(80),
  sernr character(18),
  instdate character(8),
  employee character(80),
  instreason character(1),
  pliers character(20)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_auto1
  OWNER TO postgres;

CREATE TABLE public.sap_auto_zlines
(
  oldkey character varying(40),
  dat_type character varying(10),
  anlage character varying(40),
  linum character varying(40),
  frdat character varying(10),
  frtim character varying(6),
  lityp character varying(40),
  length character varying(12),
  voltage character varying(10),
  state character varying(1),
  wxshr character varying(3),
  fshar character varying(10),
  xnegp character varying(10),
  text character varying(40),
  element_id character varying(6)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_auto_zlines
  OWNER TO local;

---------------------------------------------------------------


CREATE TABLE public.sap_auto_ztransf
(
  oldkey character varying(40),
  dat_type character varying(10),
  anlage character varying(40),
  linum character varying(40),
  frdat character varying(10),
  frtim character varying(6),
  trcat character varying(40),
  trtyp character varying(40),
  trsta character varying(12),
  xnegp character varying(10),
  text character varying(40),
  element_id character varying(6)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_auto_ztransf
  OWNER TO local;


CREATE TABLE public.sap_but000
(
  oldkey character varying(40),
  dat_type character varying(40),
  bu_sort1 character varying(20),
  bu_sort2 character varying(20),
  source character varying(4),
  augrp character varying(4),
  name_org1 character varying(40),
  name_org2 character varying(40),
  name_org3 character varying(40),
  name_org4 character varying(40),
  legal_enty character varying(2),
  liquid_dat character varying(8),
  zfilcode character varying(4),
  zfilhead character varying(30),
  zprocind character varying(1),
  zcodeformown character varying(4),
  zcodespodu character varying(4),
  zcodebankroot character varying(4),
  zcodelicense character varying(4),
  znameall character varying(255),
  zz_nameshort character varying(80),
  zz_document character varying(200)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_but000
  OWNER TO local;


CREATE TABLE public.sap_but020
(
  oldkey character varying(40),
  dat_type character varying(40),
  adext_addr character varying(20),
  chind_addr character varying(1),
  city1 character varying(40),
  post_code1 character varying(10),
  post_code2 character varying(10),
  po_box character varying(10),
  street character varying(60),
  house_num1 character varying(10),
  house_num2 character varying(10),
  str_supll1 character varying(40),
  str_supll2 character varying(40),
  roomnumber character(10),
  region character varying(3),
  chind_tel character varying(1),
  tel_number character varying(30),
  chind_fax character varying(1),
  fax_number character varying(30),
  chind_smtp character varying(1),
  smtp_addr character varying(241),
  tel_mobile character varying(1),
  iuru_pro character varying(5)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_but020
  OWNER TO local;


CREATE TABLE public.sap_but021
(
  oldkey character varying(40),
  dat_type character varying(40),
  adext_advw character varying(20),
  adr_kind character varying(10),
  xdfadu character varying(1)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_but021
  OWNER TO local;


CREATE TABLE public.sap_but0id
(
  oldkey character varying(40),
  dat_type character varying(40),
  idnumber character varying(60),
  id_type character varying(6)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_but0id
  OWNER TO local;

  CREATE TABLE public.sap_co_adr
(
  oldkey character varying(40),
  dat_type character varying(40),
  city1 character varying(40),
  post_code1 character varying(10),
  street character varying(60),
  house_num1 character varying(10),
  str_suppl1 character varying(40),
  str_suppl2 character varying(40),
  region character varying(3),
  iuru_pro character varying(5),
  house_num2 character(10)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_co_adr
  OWNER TO local;


CREATE TABLE public.sap_co_eha
(
  oldkey character varying(40),
  dat_type character varying(40),
  pltxt character varying(40),
  begru character varying(4),
  swerk character varying(4),
  stort character varying(6)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_co_eha
  OWNER TO local;


CREATE TABLE public.sap_const
(
  id_res character(2),
  region character(6),
  swerk character(4),
  stort character(6),
  ver integer,
  begru character(4),
  vktyp character(2),
  opbuk character(4),
  begru_all character(4),
  begru_b character(4),
  stdbk character(4)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_const
  OWNER TO postgres;  

CREATE TABLE public.sap_data
(
  oldkey character(255),
  dat_type character(10),
  vstelle character(255),
  spebene character(2),
  anlart character(4),
  ablesartst character(4),
  zz_nametu character(200),
  zz_fider character(4),
  ab character(8),
  tariftyp character(80),
  branche character(2),
  aklasse character(4),
  ableinh character(80),
  zzcode4nkre character(3),
  zzcode4nkre_dop character(8),
  zzotherarea character(8),
  begru character(6),
  zz_eic character(16)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_data
  OWNER TO postgres;


CREATE TABLE public.sap_device22
(
  sap_meter_id character varying(32767),
  sap_meter_name character varying(32767),
  sap_phese character varying(32767),
  group_schet character varying(32767),
  vid_izm character varying(32767),
  vid_spog character varying(32767),
  time_proverki character varying(32767),
  u_nom character varying(32767),
  i_nom character varying(32767),
  i_max character varying(32767)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_device22
  OWNER TO local;


CREATE TABLE public.sap_egerh
(
  oldkey character varying(40),
  dat_type character varying(40),
  ab character varying(8),
  zwgruppe character varying(40),
  wgruppe character varying(40)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_egerh
  OWNER TO local;


CREATE TABLE public.sap_egers
(
  oldkey character varying(40),
  dat_type character varying(40),
  bgljahr character varying(40)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_egers
  OWNER TO local;


CREATE TABLE public.sap_egpld
(
  oldkey character varying(40),
  dat_type character varying(40),
  haus character varying(30),
  vstelle character varying(30),
  swerk character varying(10),
  stort character varying(10),
  begru character varying(10),
  pltxt character varying(12)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_egpld
  OWNER TO local;


CREATE TABLE public.sap_ekun
(
  oldkey character varying(40),
  dat_type character varying(40),
  fkua_rsd character varying(1),
  fkua_ris character varying(1)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_ekun
  OWNER TO local;



CREATE TABLE public.sap_equi
(
  oldkey character varying(40),
  dat_type character varying(40),
  begru character(4),
  eqart character(10),
  baujj character(4),
  datab character(10),
  eqktx character(40),
  swerk character(4),
  stort character(10),
  kostl character(10),
  bukrs character(4),
  matnr character varying(80),
  sernr character varying(80),
  zz_pernr character(18),
  cert_date character(10)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_equi
  OWNER TO local;


CREATE TABLE public.sap_evbsd
(
  oldkey character(18),
  dat_type character(18),
  haus character(18),
  haus_num2 character(10),
  lgzusatz character(40),
  vbsart character(5),
  begru character(4),
  zz_nameplvm character(200)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_evbsd
  OWNER TO local;


CREATE SEQUENCE public.sap_export_id_seq
  INCREMENT 1
  MINVALUE 1
  MAXVALUE 9223372036854775807
  START 57
  CACHE 1;
ALTER TABLE public.sap_export_id_seq
  OWNER TO postgres;


 CREATE TABLE public.sap_export
(
  id integer NOT NULL DEFAULT nextval('sap_export_id_seq'::regclass),
  dattype character(30),
  objectsap character(30),
  id_object integer,
  CONSTRAINT sap_export_pkey PRIMARY KEY (id)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_export
  OWNER TO postgres;


CREATE TABLE public.sap_facts
(
  oldkey character(30),
  pole1 character(30),
  pole2 character(30),
  pole3 character(30),
  pole4 character(30),
  pole5 character(30)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_facts
  OWNER TO postgres;

CREATE TABLE public.sap_init
(
  oldkey character varying(40),
  dat_type character varying(40),
  bu_type character varying(1),
  bu_group character varying(4),
  bpkind character varying(4),
  role1 character varying(6),
  role2 character varying(6),
  valid_from_1 character varying(8),
  chind_1 character varying(1),
  valid_from_2 character varying(8),
  chind_2 character varying(1)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_init
  OWNER TO local;


CREATE TABLE public.sap_init_acc
(
  oldkey character varying(40),
  dat_type character varying(40),
  gpart character varying(30),
  vktyp character varying(2),
  vkona character varying(20)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_init_acc
  OWNER TO local;


CREATE TABLE public.sap_kvv
(
  oldkey character varying(40),
  dat_type character varying(40),
  date_from date,
  date_to date
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_kvv
  OWNER TO local;

CREATE TABLE public.sap_lines
(
  kod_res integer,
  id integer,
  type character(40),
  normative character(20),
  voltage_nom character(20),
  amperage_nom character(20),
  voltage_max character(20),
  amperage_max character(20),
  cords character(10),
  cover character(10),
  ro character(10),
  xo character(10),
  dpo character(10),
  show_def character(10),
  s_nom character(10),
  id_sap character(10)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_lines
  OWNER TO local;


CREATE TABLE public.sap_meter
(
  id character varying(32767),
  name character varying(32767),
  "напряжение" character varying(32767),
  "ток" character varying(32767),
  "фазы" character varying(32767),
  "разрядность" character varying(32767),
  "зоны" character varying(32767),
  sap_meter_id character varying(32767)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_meter
  OWNER TO local;


 CREATE TABLE public.sap_meter_cnt
(
  code character varying(32767),
  name character varying(32767),
  sap_cnt character varying(32767)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_meter_cnt
  OWNER TO local;


CREATE TABLE public.sap_meter_part1
(
  code character varying(32767),
  name character varying(32767),
  sap_cnt character varying(32767)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_meter_part1
  OWNER TO local;


CREATE TABLE public.sap_meter_part2
(
  code character varying(32767),
  name character varying(32767),
  sap_cnt character varying(32767)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_meter_part2
  OWNER TO local;


CREATE TABLE public.sap_meter_prom
(
  code character varying(32767),
  name character varying(32767),
  sap_meter_id character varying(32767)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_meter_prom
  OWNER TO local;

CREATE TABLE public.sap_transf
(
  id character varying(32767),
  type character varying(32767),
  normative character varying(32767),
  voltage_nom character varying(32767),
  amperage_nom character varying(32767),
  voltage_max character varying(32767),
  amperage_max character varying(32767),
  voltage2_nom character varying(32767),
  amperage2_nom character varying(32767),
  phase character varying(32767),
  swathe character varying(32767),
  hook_up character varying(32767),
  power_nom_old character varying(32767),
  amperage_no_load character varying(32767),
  power_nom character varying(32767),
  show_def character varying(32767),
  id_sap character varying(32767),
  kod_res integer
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_transf
  OWNER TO postgres;


CREATE TABLE public.sap_type_tr_2w_tbl
(
  trtyp character varying(10),
  id_type integer,
  type_tr character varying(100),
  npwsh character varying(10),
  hgvlt character varying(10),
  lwvlt character varying(10),
  alspx character varying(10),
  alspk character varying(10),
  scvuk character varying(10),
  idlxx character varying(10),
  text character varying(100)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_type_tr_2w_tbl
  OWNER TO postgres;


CREATE TABLE public.sap_type_tr_i_tbl
(
  pr1 character varying(20),
  id_type integer,
  type_tr character varying(255),
  type_tr_sap character varying(255),
  ktc character varying(15),
  ktcc character varying(15),
  vid integer,
  group_ob character varying(20),
  vid_pov integer,
  srok integer,
  pover character varying(10),
  nig_porog character varying(10),
  clas character varying(10),
  min_nag integer
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_type_tr_i_tbl
  OWNER TO postgres;


CREATE TABLE public.sap_vk
(
  oldkey character varying(40),
  dat_type character varying(40),
  zdaterep numeric(2,0),
  znodev character varying(1)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_vk
  OWNER TO local;


CREATE TABLE public.sap_vkp
(
  oldkey character varying(40),
  dat_type character varying(40),
  partner character varying(30),
  opbuk character varying(4),
  ebvty character varying(4),
  abvty character varying(4),
  abwvk character varying(12),
  ikey character varying(2),
  mahnv character varying(2),
  begru character varying(4),
  adrnb_ext character varying(20),
  zahlkond character varying(4),
  vertyp character varying(4),
  kofiz_sd character varying(2),
  kzabsver character varying(1),
  stdbk character varying(4),
  fkru_fis character varying(10),
  zsector character varying(10),
  zz_ministry character varying(10),
  zz_start character varying(10),
  zz_end character varying(10),
  zz_budget character varying(1),
  zz_territory character varying(1)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_vkp
  OWNER TO local;


CREATE TABLE public.sap_zstat
(
  oldkey character varying(40),
  dat_type character varying(40),
  id numeric(5,0),
  obj character varying(6),
  status character varying(6),
  date_reg character varying(10),
  date_to character varying(10),
  price character varying(18),
  comments character varying(255),
  loevm character varying(6)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.sap_zstat
  OWNER TO local;



CREATE TABLE public.tarif_sap_energo
(
  id character varying(32767),
  name character varying(32767),
  tarif_sap character varying(32767)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.tarif_sap_energo
  OWNER TO local;  

CREATE TABLE public.eerm2cnt
(
  cnt character(15),
  eerm numeric(12,4)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.eerm2cnt
  OWNER TO local;


create table cabels_soed (
id_rem int,
type_cab int,
id_en int,id_sap char(20)
)

CREATE TABLE cabels
(
  a character varying(5),
  b character varying(3),
  c character varying(3),
  d character varying(20),
  e character varying(20),
  f character varying(20),
  g character varying(20),
  h character varying(20),
  i character varying(20),
  j character varying(20),
  k character varying(20),
  l character varying(100),
  m character varying(20)
);
  

---------------------- VIEWS ------------------------------------


CREATE OR REPLACE VIEW public.eqv_pnt_trans_met AS 
 SELECT DISTINCT e.id AS id_point,
    e.name_eqp AS name_point,
    met.id_meter,
    met.num_eqp,
    met.type AS type_met,
    met.carry AS carry_met,
        CASE
            WHEN t1.conversion = 1 THEN t1.code_eqp::character varying
            ELSE
            CASE
                WHEN t2.conversion = 1 THEN t2.code_eqp::character varying
                ELSE ''::character varying
            END
        END AS code_tt,
        CASE
            WHEN t1.conversion = 1 THEN t1.name_eqp
            ELSE
            CASE
                WHEN t2.conversion = 1 THEN t2.name_eqp
                ELSE NULL::character varying
            END
        END AS name_tt,
        CASE
            WHEN t1.conversion = 1 THEN btrim(regexp_split_to_table(t1.num_eqp::text, '[,]'::text))::character varying
            ELSE
            CASE
                WHEN t2.conversion = 1 THEN btrim(regexp_split_to_table(t2.num_eqp::text, '[,]'::text))::character varying
                ELSE NULL::character varying
            END
        END AS num_tt,
        CASE
            WHEN t1.conversion = 1 THEN t1.type
            ELSE
            CASE
                WHEN t2.conversion = 1 THEN t2.type
                ELSE NULL::character varying
            END
        END AS type_tt,
        CASE
            WHEN t1.conversion = 1 THEN
            CASE
                WHEN t1.amperage2_nom <> 0 THEN t1.amperage_nom / t1.amperage2_nom
                ELSE 1
            END
            ELSE
            CASE
                WHEN t2.amperage2_nom <> 0 THEN t2.amperage_nom / t2.amperage2_nom
                ELSE 1
            END
        END AS koef_tt,
        CASE
            WHEN t2.conversion = 2 THEN t2.code_eqp::character varying
            ELSE
            CASE
                WHEN t1.conversion = 2 THEN t1.code_eqp::character varying
                ELSE ''::character varying
            END
        END AS code_tu,
        CASE
            WHEN t2.conversion = 2 THEN t2.name_eqp
            ELSE
            CASE
                WHEN t1.conversion = 2 THEN t1.name_eqp
                ELSE NULL::character varying
            END
        END AS name_tu,
        CASE
            WHEN t2.conversion = 2 THEN t2.num_eqp
            ELSE
            CASE
                WHEN t1.conversion = 2 THEN t1.num_eqp
                ELSE NULL::character varying
            END
        END AS num_tu,
        CASE
            WHEN t2.conversion = 2 THEN t2.type
            ELSE
            CASE
                WHEN t1.conversion = 2 THEN t1.type
                ELSE NULL::character varying
            END
        END AS type_tu,
        CASE
            WHEN t2.conversion = 2 THEN
            CASE
                WHEN t2.voltage2_nom <> 0::numeric THEN round(t2.voltage_nom / t2.voltage2_nom, 0)
                ELSE 1::numeric
            END
            ELSE
            CASE
                WHEN t1.voltage2_nom <> 0::numeric THEN round(t1.voltage_nom / t1.voltage2_nom, 0)
                ELSE 1::numeric
            END
        END AS koef_tu
   FROM ( SELECT e_1.id,
            e_1.type_eqp,
            e_1.num_eqp,
            e_1.id_addres,
            e_1.dt_install,
            e_1.dt_change,
            e_1.loss_power,
            e_1.id_department,
            e_1.name_eqp,
            e_1.is_owner,
            e_1.id_client
           FROM ( SELECT e_2.id,
                    e_2.type_eqp,
                    e_2.num_eqp,
                    e_2.id_addres,
                    e_2.dt_install,
                    e_2.dt_change,
                    e_2.loss_power,
                    e_2.id_department,
                    e_2.name_eqp,
                    e_2.is_owner,
                    et.id_client
                   FROM ( SELECT eqm_equipment_tbl.id,
                            eqm_equipment_tbl.type_eqp,
                            eqm_equipment_tbl.num_eqp,
                            eqm_equipment_tbl.id_addres,
                            eqm_equipment_tbl.dt_install,
                            eqm_equipment_tbl.dt_change,
                            eqm_equipment_tbl.loss_power,
                            eqm_equipment_tbl.id_department,
                            eqm_equipment_tbl.name_eqp,
                            eqm_equipment_tbl.is_owner
                           FROM eqm_equipment_tbl
                          WHERE eqm_equipment_tbl.type_eqp = 12) e_2,
                    ( SELECT e_3.id_tree,
                            e_3.id_department,
                            e_3.code_eqp,
                            e_3.code_eqp_e,
                            e_3.name,
                            e_3.tranzit,
                            e_3.lvl,
                            e_3.parents,
                            e_3.line_no,
                            et_1.id_client
                           FROM eqm_eqp_tree_tbl e_3,
                            eqm_tree_tbl et_1
                             LEFT JOIN clm_client_tbl cl ON cl.id = et_1.id_client
                          WHERE et_1.id = e_3.id_tree AND (COALESCE(cl.id_state, 0) <> ALL (ARRAY[50, 99]))) et
                  WHERE e_2.id = et.code_eqp
                UNION
                 SELECT e_2.id,
                    e_2.type_eqp,
                    e_2.num_eqp,
                    e_2.id_addres,
                    e_2.dt_install,
                    e_2.dt_change,
                    e_2.loss_power,
                    e_2.id_department,
                    e_2.name_eqp,
                    e_2.is_owner,
                    et.id_client
                   FROM ( SELECT eqm_equipment_tbl.id,
                            eqm_equipment_tbl.type_eqp,
                            eqm_equipment_tbl.num_eqp,
                            eqm_equipment_tbl.id_addres,
                            eqm_equipment_tbl.dt_install,
                            eqm_equipment_tbl.dt_change,
                            eqm_equipment_tbl.loss_power,
                            eqm_equipment_tbl.id_department,
                            eqm_equipment_tbl.name_eqp,
                            eqm_equipment_tbl.is_owner
                           FROM eqm_equipment_tbl
                          WHERE eqm_equipment_tbl.type_eqp = 12) e_2,
                    eqm_eqp_use_tbl et
                  WHERE e_2.id = et.code_eqp) e_1) e
     LEFT JOIN ( SELECT mp.id_point,
            mp.id_meter,
            mp.dt_b,
            mp.dt_e,
            e_1.num_eqp,
            m.id_type_eqp,
            mi.type,
            mi.carry
           FROM ( SELECT eqm_meter_point_h.id_point,
                    eqm_meter_point_h.id_meter,
                    eqm_meter_point_h.dt_b,
                    eqm_meter_point_h.dt_e
                   FROM eqm_meter_point_h
                  WHERE eqm_meter_point_h.dt_b <= now() AND COALESCE(eqm_meter_point_h.dt_e::timestamp with time zone, now()) >= now()) mp,
            ( SELECT eqm_equipment_h.id,
                    eqm_equipment_h.type_eqp,
                    eqm_equipment_h.num_eqp,
                    eqm_equipment_h.id_addres,
                    eqm_equipment_h.dt_install,
                    eqm_equipment_h.dt_change,
                    eqm_equipment_h.loss_power,
                    eqm_equipment_h.id_department,
                    eqm_equipment_h.dt_b,
                    eqm_equipment_h.dt_e,
                    eqm_equipment_h.mmgg,
                    eqm_equipment_h.dt,
                    eqm_equipment_h.name_eqp,
                    eqm_equipment_h.id_user,
                    eqm_equipment_h.is_owner
                   FROM eqm_equipment_h
                  WHERE eqm_equipment_h.dt_b <= now() AND COALESCE(eqm_equipment_h.dt_e::timestamp with time zone, now()) >= now()) e_1,
            ( SELECT eqm_meter_h.code_eqp,
                    eqm_meter_h.id_department,
                    eqm_meter_h.id_type_eqp,
                    eqm_meter_h.dt_control,
                    eqm_meter_h.d,
                    eqm_meter_h.nm,
                    eqm_meter_h.account,
                    eqm_meter_h.main_duble,
                    eqm_meter_h.class,
                    eqm_meter_h.code_group,
                    eqm_meter_h.count_lost,
                    eqm_meter_h.warm,
                    eqm_meter_h.industry,
                    eqm_meter_h.count_met,
                    eqm_meter_h.met_comment,
                    eqm_meter_h.dt_b,
                    eqm_meter_h.dt_e,
                    eqm_meter_h.mmgg,
                    eqm_meter_h.dt,
                    eqm_meter_h.warm_comment,
                    eqm_meter_h.id_user,
                    eqm_meter_h.magnet
                   FROM eqm_meter_h
                  WHERE eqm_meter_h.dt_b <= now() AND COALESCE(eqm_meter_h.dt_e::timestamp with time zone, now()) >= now()) m,
            eqi_meter_tbl mi
          WHERE e_1.id = mp.id_meter AND m.code_eqp = mp.id_meter AND mi.id = m.id_type_eqp
          ORDER BY mp.id_point) met ON met.id_point = e.id
     LEFT JOIN ( SELECT t.id_tree,
            t.id_department,
            t.code_eqp,
            t.code_eqp_e,
            t.name,
            t.tranzit,
            t.lvl,
            t.parents,
            t.line_no,
            e_1.id,
            e_1.type_eqp,
            e_1.num_eqp,
            e_1.id_addres,
            e_1.dt_install,
            e_1.dt_change,
            e_1.loss_power,
            e_1.id_department,
            e_1.name_eqp,
            e_1.is_owner,
            ei.type,
            ei.conversion,
            ei.voltage_nom,
            ei.voltage2_nom,
            ei.amperage_nom,
            ei.amperage2_nom
           FROM eqm_eqp_tree_tbl t,
            eqm_equipment_tbl e_1,
            eqm_compensator_i_tbl ec,
            eqi_compensator_i_tbl ei
          WHERE t.code_eqp = e_1.id AND e_1.type_eqp = 10 AND e_1.id = ec.code_eqp AND ec.id_type_eqp = ei.id) t1(id_tree, id_department, code_eqp, code_eqp_e, name, tranzit, lvl, parents, line_no, id, type_eqp, num_eqp, id_addres, dt_install, dt_change, loss_power, id_department_1, name_eqp, is_owner, type, conversion, voltage_nom, voltage2_nom, amperage_nom, amperage2_nom) ON t1.code_eqp_e = e.id
     LEFT JOIN ( SELECT t.id_tree,
            t.id_department,
            t.code_eqp,
            t.code_eqp_e,
            t.name,
            t.tranzit,
            t.lvl,
            t.parents,
            t.line_no,
            e_1.id,
            e_1.type_eqp,
            e_1.num_eqp,
            e_1.id_addres,
            e_1.dt_install,
            e_1.dt_change,
            e_1.loss_power,
            e_1.id_department,
            e_1.name_eqp,
            e_1.is_owner,
            ei.type,
            ei.conversion,
            ei.voltage_nom,
            ei.voltage2_nom,
            ei.amperage_nom,
            ei.amperage2_nom
           FROM eqm_eqp_tree_tbl t,
            eqm_equipment_tbl e_1,
            eqm_compensator_i_tbl ec,
            eqi_compensator_i_tbl ei
          WHERE t.code_eqp = e_1.id AND e_1.type_eqp = 10 AND e_1.id = ec.code_eqp AND ec.id_type_eqp = ei.id) t2(id_tree, id_department, code_eqp, code_eqp_e, name, tranzit, lvl, parents, line_no, id, type_eqp, num_eqp, id_addres, dt_install, dt_change, loss_power, id_department_1, name_eqp, is_owner, type, conversion, voltage_nom, voltage2_nom, amperage_nom, amperage2_nom) ON t2.code_eqp_e = t1.code_eqp
  ORDER BY e.id, (
        CASE
            WHEN t1.conversion = 1 THEN t1.code_eqp::character varying
            ELSE
            CASE
                WHEN t2.conversion = 1 THEN t2.code_eqp::character varying
                ELSE ''::character varying
            END
        END);

ALTER TABLE public.eqv_pnt_trans_met
  OWNER TO local;


CREATE OR REPLACE VIEW group_trans AS 
 SELECT ss.id_point,
    ss.id_meter,
    ss.code_tt,
    ss.code_tt::text || row_number() OVER (PARTITION BY ss.id_meter) AS code_t_new,
    ss.num_tt
   FROM ( SELECT DISTINCT eqv_pnt_trans_met.id_point,
            eqv_pnt_trans_met.id_meter,
                CASE
                    WHEN eqv_pnt_trans_met.code_tu::text <> ''::text THEN regexp_split_to_table((eqv_pnt_trans_met.code_tt::text || ','::text) || eqv_pnt_trans_met.code_tu::text, '[,]'::text)::character varying
                    ELSE eqv_pnt_trans_met.code_tt
                END AS code_tt,
                CASE
                    WHEN eqv_pnt_trans_met.code_tu::text <> ''::text THEN regexp_split_to_table((eqv_pnt_trans_met.num_tt::text || ','::text) || eqv_pnt_trans_met.num_tu::text, '[,]'::text)::character varying
                    ELSE eqv_pnt_trans_met.num_tt
                END AS num_tt
           FROM eqv_pnt_trans_met
          WHERE eqv_pnt_trans_met.code_tt::text <> ''::text
          ORDER BY eqv_pnt_trans_met.id_point) ss
  ORDER BY ss.id_point;

ALTER TABLE group_trans
  OWNER TO local;


-----------------------------------------------------------------------------
