<?php
/**
 * Created by PhpStorm.
 * User: ssivtsov
 * Date: 21.06.2017
 * Time: 9:49
 */
namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;


class Tmp_works_1 extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'tmp_works';
    }



    public function rules()
    {
        return [

            [['in_unit', 'id_podr',
                'id_name', 'fio','post','unit'], 'safe'],

        ];
    }

//    public function getId()
//    {
//        return $this->getPrimaryKey();
//    }

    public static function getDb()
    {

        return Yii::$app->get('db_phone_loc');
    }

}
