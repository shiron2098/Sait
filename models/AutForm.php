<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AutForm extends Model
{
    public $login;
    public $password;

    public function rules()
    {
        return [
            [['login','password'],'required'],
            ['login','string', 'min' => 6,'max'=> 12],
            ['login','unique',
                'targetClass' => '\app\models\Auti',
                'targetAttribute' => 'login',
                'message' => 'Такой login уже занят'
            ],
            ['password','integer', 'min' => 5],
        ];
    }
}