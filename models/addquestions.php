<?php


namespace app\models;

//use Yii;
use yii\base\Model;
use yii\db\ActiveRecord;

/**
 * Форма ввода данных для ввода вопросов в опросник
 */
class Addquestions extends Model
{
    public $theme ;
    public $quest ;
    public $a1 ;
    public $a2 ;
    public $a3 ;
    public $a4 ;
    public $a5 ;
    public $c1=0 ;
    public $c2=0 ;
    public $c3=0 ;
    public $c4=0 ;
    public $c5=0 ;
    
    public function attributeLabels()
    {
        return [

            'theme' => 'Тема:',
            'quest' => 'Вопрос:',
            'a1' => 'Ответ 1:',
            'a2' => 'Ответ 2:',
            'a3' => 'Ответ 3:',
            'a4' => 'Ответ 4:',
            'a5' => 'Ответ 5:',
            'c1' => '',
            'c2' => '',
            'c3' => '',
            'c4' => '',
            'c5' => '',
        ];
    }

    public function rules()
    {
        return [
           
            [['theme',  'quest','a1'], 'required'],
            [['a2','a3','a4','a5',
                'c1','c2','c3','c4','c5'],'safe']

            
        ];
    }
 
}

