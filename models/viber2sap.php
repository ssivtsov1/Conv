<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use yii\data\ActiveDataProvider;


class Viber2sap extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'viber2sap';
    }

    public function attributeLabels()
    {
        return [
            'date_t' => 'Дата передачі',
            'lic' => 'Особовий рахунок:',
            'status' => 'Статус передачі:',
            'val11' => 'Однозонний ліч.',
            'val21' => '2 День',
            'val22' => '2 Ніч',
            'val31' => '3 Пік',
            'val32' => '3 Нпік',
            'val33' => '3 Ніч',
        ];
    }

    public function rules()
    {
        return [
            [[ 'status',
                'val11', 'val21', 'val22', 'val31', 'val32', 'val33','lic','date_t'], 'safe'],
        ];
    }

    public function search($params,$sql)
    {
        $query = Viber2sap::findBySql($sql);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_ASC
                ]
            ]

        ]);
        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }
        return $dataProvider;
    }

    public static function getDb()
    {
        return Yii::$app->get('db_pg_viber');
    }

}
