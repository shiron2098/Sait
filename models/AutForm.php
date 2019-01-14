<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AutForm extends Model
{
    public $login;
    public $password_hash;
    public $auth_key;
    public $email;

    public function rules()
    {
        return [
            [['login','password_hash'],'required'],
            ['login','string', 'min' => 6,'max'=> 12],
            ['login','unique',
                'targetClass' => '\app\models\Users',
                'targetAttribute' => 'login',
                'message' => 'Такой login уже занят'
            ],
            ['password_hash','integer', 'min' => 5,],
            ['email','email'],
            ['email','unique',
                'targetClass' => '\app\models\Users',
                'targetAttribute' => 'email',
                'message' => 'Такой email уже занят'
            ],
        ];
    }
}