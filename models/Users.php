<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $login
 * @property string $password_hash
 * @property string $auth_key
 */
class Users extends \yii\db\ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['login','unique'],
            [['login'], 'string', 'max' => 255],
            [['password_hash', 'auth_key'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Login',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
        ];
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
        return static::findOne(['login' => $login]);
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
   public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password_hash);

    }
    public function generationAuthKey(){
        $this->auth_key=Yii::$app->security->generateRandomString();
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }
}
