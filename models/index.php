<?php


namespace app\models;

//use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Форма ввода данных для конвертации чисел
 */
class Index extends Model
{
    public $sys=1 ;
    public $sys_res=2 ;
    public $number ;




    public function attributeLabels()
    {
        return [

            'sys' => 'Система (вход):',
            'sys_res' => 'Система (результат):',
            'number' => 'Введите числа:',
        ];
    }

    public function rules()
    {
        return [
           
            [['sys',  'number', 'sys_res'], 'required'],

            
        ];
    }
 
}

