<?php

namespace app\models;

use Yii;
use yii\base\Model;

class AutreForm extends Model
{
    public $login;
    public $password;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login', 'password'], 'required'],
            ['password', 'validatePassword'],
        ];
    }
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();

            if (!$user || !$user->validatePassword($this->password))
            {
                $this->addError($attribute, 'Пароль или пользователь неверный');
            }
        }
    }
/*    public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser());
        }
        return false;
    }*/

    public function getUser()
    {
        return Auti::FindOne(['login'=>$this->login]);
    }
}