<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "auti".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $auth_key
 *
 * @property Yifraem[] $yifraems
 */
class Auti extends \yii\db\ActiveRecord implements IdentityInterface
{

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['login','unique'],
            [['login', 'password'], 'required'],
            [['login', 'password', 'auth_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password' => 'Password',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getYifraems()
    {
        return $this->hasMany(Yifraem::className(), ['userid' => 'id']);
    }


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }
    public static function findIdentityByAccessToken($token, $type = null)
    {
    }
    public static function findByUsername($login)
    {
        /*return static::findOne(['login' => $login]);*/
    }
    public function getId()
    {
        return $this->id;
    }
    public function getAuthKey()
    {
       return $this->auth_key;
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }
 /*   public function setPassword($password){
        $this->password = Yii::$app->security->generatePasswordHash($password);
        $this->generateAuthKey();
    }
    private function generateAuthKey(){
        $this->auth_key = Yii::$app->security->generateRandomString();
    }*/
    public function validatePassword($password){
/*        print_r($this->password);
        print_r($password);*/
        return  $this->password === $password;
    }
}
