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


class Works extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return '1c';
    }



    public function rules()
    {
        return [

            [['Входит в подразделение', 'id_podr',
                'id_name', 'Працівник','Посада','Підрозділ організації'], 'safe'],

        ];
    }

//    public function getId()
//    {
//        return $this->getPrimaryKey();
//    }

    public static function getDb()
    {

        return Yii::$app->get('db_phone');
    }

}
