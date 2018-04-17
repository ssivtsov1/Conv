<?php


namespace app\models;

//use Yii;
use yii\base\Model;

/**
 * Форма ввода данных для проверки раскладки клавиатуры
 */
class Code_file extends Model
{
   
    public $passwd='' ;
    public $file;

    
    public function attributeLabels()
    {
        return [
            
            'passwd' => 'Введите пароль:',
            'file' => 'Выберите файл с расширением txt:',

        ];
    }

    public function rules()
    {
        return [
           
            [['file'],'file','extensions'=>'txt','message'=>'Выберите файл только с расширением txt'],
            [['passwd'], 'required','message'=>'Поле пароль должно быть заполнено'],
            
        ];
    }
 
}

