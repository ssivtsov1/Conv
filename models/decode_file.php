<?php


namespace app\models;

//use Yii;
use yii\base\Model;

/**
 * Форма ввода данных для проверки раскладки клавиатуры
 */
class Decode_file extends Model
{
   
    public $passwd='' ;
    public $file;

    
    public function attributeLabels()
    {
        return [
            
            'passwd' => 'Введите пароль:',
            'file' => 'Выберите файл с расширением cod:',

        ];
    }

    public function rules()
    {
        return [
           
            [['file'],'file','extensions'=>'cod'],
            [['passwd'], 'required','message'=>'Поле пароль должно быть заполнено'],
           
            
        ];
    }
 
}

