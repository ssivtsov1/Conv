<?php

namespace app\models;

//use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Форма ввода данных для экспорта в САП
 */
class Export_sap extends Model
{
    public $rem ;
    public $id_oper ;

    public function attributeLabels()
    {
        return [
            'id_oper' => 'Формування файлу:',
            'rem' => 'РЕМ:',
        ];
    }

    public function rules()
    {
        return [
           
            [['rem',  'id_oper'], 'required'],

        ];
    }
 
}

