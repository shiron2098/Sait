<?php

namespace app\models;

use Yii;
use yii\base\Model;


class AutreForm extends Model
{
    public $login;
    public $password_hash;
    public $auth_key;
    public $rememberMe = true;


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['login', 'password_hash'], 'required'],
            ['rememberMe', 'boolean'],
            ['password_hash', 'validatePassword'],
        ];
    }
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors())
        {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password_hash))
            {
                $this->addError($attribute, 'Пароль или пользователь неверный');
            }
            return true;

        }
    }
   public function login()
    {
        if ($this->validate()) {
            return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600*24*30 : 0);
        }
        return false;
    }

    public function getUser()
    {
        return Users::FindOne(['login'=>$this->login]);

    }
}