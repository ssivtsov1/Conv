<?php
namespace app\models;
use yii\base\Model;
/**
 * Форма ввода данных чисел в массив
 */
class Input_array extends Model
{
    public $number ;
    
    public function attributeLabels()
    {
        return [
            'number' => 'Введите данные:',
        ];
    }

    public function rules()
    {
        return [
            [['number'], 'required'],
        ];
    }
 
}

