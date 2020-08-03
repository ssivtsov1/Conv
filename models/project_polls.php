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


class Project_polls extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'ws_polls';
    }



    public function rules()
    {
        return [

            [['id','ins', 'title',
               ], 'safe'],

        ];
    }


    public static function getDb()
    {

        return Yii::$app->get('db_pools');
    }

}
