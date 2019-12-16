<?php
// Заявки пользователей
namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;


class All_tmc extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'all_tmc';
    }


    public function rules()
    {

        return [
            [['id','charg','charg1','maktx'], 'safe'],
        ];
    }


    public static function getDb()
    {
        return Yii::$app->get('db_sap');
    }

}

