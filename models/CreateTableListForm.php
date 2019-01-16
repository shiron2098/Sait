<?php

namespace app\models;

use Yii;
use yii\base\Model;

class CreateTableListForm extends Model
{
    public $name;
    public $email;
    public $password;

    public function rules()
    {
        return [
          [['name','email','password'],'required'],
            ['name','string', 'min' => 6,'max'=> 12],
            ['email','unique',
                'targetClass' => '\app\models\Yifraem',
                'targetAttribute' => 'email',
                'message' => 'Такой email уже занят'
                ],
            ['name','unique',
                'targetClass' => '\app\models\Yifraem',
                'targetAttribute' => 'name',
                'message' => 'Такой name уже занят'
            ],
            ['email','email'],
            ['password','integer', 'min' => 3],
        ];
    }
}