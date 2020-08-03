<?php


namespace app\models;

//use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Форма ввода данных для решения разных задач
 */
class Input extends Model
{
    public $txt='' ;
    public $number ;
    
    public function attributeLabels()
    {
        return [

            'txt' => 'Входные данные:',
            'number' => 'Введите числа:',
        ];
    }

    public function rules()
    {
        return [
           
            [['txt'], 'required'],

            
        ];
    }
 
}

