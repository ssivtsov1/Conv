<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\models;
use yii\db\ActiveRecord;
use Yii;
/**
 * Description of sap_connect
 *
 * @author root
 */
class sap_connect extends ActiveRecord {

        public static function tableName() {
        return 'clm_client_tbl';
    }

      public static function getDb()
    {
                $s=Yii::$app->request->hostInfo;
                $s= substr($s, 7);   

        if($s=='192.168.15.15')
            return Yii::$app->get('db_pg_dn_energo');
        if($s=='192.168.17.1')
            return Yii::$app->get('db_pg_gv_energo');
        if($s=='192.168.20.1')
            return Yii::$app->get('db_pg_vg_energo');
        if($s=='192.168.21.1')
            return Yii::$app->get('db_pg_pv_energo');
        if($s=='192.168.26.1')
            return Yii::$app->get('db_pg_zv_energo');
        if($s=='192.168.75.1')
            return Yii::$app->get('db_pg_krg_energo');
        if($s=='192.168.85.1')
            return Yii::$app->get('db_pg_in_energo');
        if($s=='localhost')
            return Yii::$app->get('db_pg_in_energo');
    }
    
}
