<?php
/**
 * Created by PhpStorm.
 * User: Shiron
 * Date: 07.01.2019
 * Time: 23:42
 */

namespace app\models;


use yii\base\Model;
use yii;

class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * @inheritdoc
     */
    public function rules(){
        return[
            ['email','trim'],
            ['email','email'],
            ['email','required'],
            ['email', 'exist',
                'targetClass' => '\app\models\Users',
                'filter' => ['status' => Users::STATUS_ACTIVE],
                'message' => 'Данный эмейл не зарегистрирован.'],
        ];
    }
    public function sendEmail(){

        $users = Users::FindOne([
            'status'=> Users::STATUS_ACTIVE,
            'email' => $this->email,
        ]);
        if (!$users) {
            return false;
        }

        if (!Users::isPasswordResetTokenValid($users->acess_token)) {
            $users->generatePasswordResetToken();
            if (!$users->save()) {
                return false;
            }
        }
        return Yii::$app
            ->mailer
            ->compose(
                ['text' => 'passwordResetToken-text'],
                ['users' => $users]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . 'robot'])
            ->setTo($this->email)
            ->setSubject('Password reset for ' . Yii::$app->name)
            ->send();
    }

}