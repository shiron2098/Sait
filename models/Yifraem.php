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
 * @property Users $user
 */
class Yifraem extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'Yifraem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['time'], 'safe'],
            [['userid',], 'integer'],
            [['date', 'email'], 'string', 'max' => 32],
            [['name', 'password'], 'string', 'max' => 60],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
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
        return $this->hasOne(Users::className(), ['id' => 'userid']);
    }
}
