<?php


namespace app\models;

//use Yii;
use yii\base\Model;

/**
 * Форма ввода данных для проверки 2-х строк
 */
class Cmp_str extends Model
{
    public $str1='' ;
    public $str2='' ;

    
    public function attributeLabels()
    {
        return [
            'str1' => 'Введите 1-ю строку:',
            'str2' => 'Введите 2-ю строку:',

        ];
    }

    public function rules()
    {
        return [
           
            [['str1','str2'], 'required'],
                      
        ];
    }
 
}

