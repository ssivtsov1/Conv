<?php

namespace app\models;

use yii\base\Model;

class conversion_model extends Model
{
    public $file;
    public $number;
    public $type;
    public $ip_address;
    public $base;
    public $table;
    public $delimiter;

    public function attributeLabels()
    {
        return [
            'file' => 'Файл',
            'number' => 'Количество полей',
            'type' => 'Тип сервера',
            'ip_address' => 'IP адрес',
            'base' => 'База',
            'table' => 'Таблица',
            'delimiter' => 'Символ разделитель',
        ];
    }
    public function rules()
    {
        return [
            [['file','number', 'type', 'ip_address', 'base', 'table', 'delimiter',
            ], 'safe'],
        ];
    }

}