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


class Answer extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'ws_answer';
    }



    public function rules()
    {
        return [

            [['ids','id_quest', 'answer','parent','rightok'
               ], 'safe'],

        ];
    }


    public static function getDb()
    {

        return Yii::$app->get('db_pools');
    }

}
