<?php


namespace app\models;

//use Yii;
use yii\base\Model;

/**
 * Форма ввода данных для проверки раскладки клавиатуры
 */
class Symbol extends Model
{
    public $str='' ;
    public $passwd='' ;

    
    public function attributeLabels()
    {
        return [
            'str' => 'Введите строку:',
            'passwd' => 'Введите пароль:',

        ];
    }

    public function rules()
    {
        return [
           
            [['str'], 'required'],
            [['passwd'], 'safe'],
            
        ];
    }
 
}

