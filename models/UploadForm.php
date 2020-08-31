<?php

namespace app\models;

use yii\base\Model;
use yii\web\UploadedFile;


class UploadForm extends Model
{
    public $file;


    public function attributeLabels()
    {
        return [
            'file' => 'Юридические потребители',
        ];
    }

    public function rules()
    {
        return [
            [['file'],'file', 'extensions'=>'txt'],
        ];
    }
}