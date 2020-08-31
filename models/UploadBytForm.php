<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;



class UploadBytForm extends Model
{
    public $file;

    public function attributeLabels()
    {
        return [
            'file' => 'Бытовые потребители',
        ];
    }

    public function rules()
    {
        return [
            [['file'],'file', 'extensions'=>'txt'],
        ];
    }
}