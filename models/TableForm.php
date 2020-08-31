<?php


namespace app\models;
use yii\gii\generators\model;


class TableForm extends \yii\base\Model {

    public $name;

    public function attributeLabels()
    {
        return [
          'name' => 'Введите число:',
        ];
    }

    public function rules()
    {
        return [
          ['name', 'required', 'message' => 'Поле обязательно'],
//            ['name', 'string', 'min' => 1],
//            ['name', 'string', 'max' => 4, 'tooLong' => 'Максимальная длина поля 4 символа'],
            ['name', 'string', 'length' => [1,4], 'tooLong' => 'Максимальная длина поля 4 символа'],
        ];
    }

}