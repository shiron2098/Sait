<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Yifraem".
 *
 * @property int $id
 * @property string $time
 * @property string $date
 * @property string $name
 * @property string $email
 * @property string $password
 * @property int $userid
 *
 * @property Auti $user
 */
class Yifraem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            ['email', 'email'],
            ['name', 'string'],
            ['password', 'number'],
            ['name','unique'],
            ['email','unique'],
            [['time', 'date', 'name', 'email', 'password', 'userid'], 'required'],
            [['userid'], 'integer'],
            [['time', 'date', 'name', 'email', 'password'], 'string', 'max' => 255],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Auti::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'time' => 'Time',
            'date' => 'Date',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'userid' => 'Userid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Auti::className(), ['id' => 'userid']);
    }

}
