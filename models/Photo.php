<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "Photo".
 *
 * @property int $id
 * @property string $name
 * @property int $date
 * @property string $path
 * @property int $userid
 *
 * @property Users $user
 */
class Photo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'],'unique'],
            [['date'], 'integer'],
            [['userid'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['path'], 'file', 'extensions' => 'png, jpg'],
            [['userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['userid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function upload()
    {
        if ($this->validate()) {
            $id=$_SESSION['__id'];
            $users= users::findone($id);
            $subdir1 = $users->login;
            $folder = 'Upload/' . $subdir1 . '/';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $this->path->SaveAs($folder . $this->path->baseName . '.' . $this->path->extension);
            return true;
        } else {
            return false;
        }
    }
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date' => 'Date',
            'path' => 'Path',
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


public function rules()
{
    return [
        [['Name', 'Famiglia', 'Nickname', 'DateBrithday','Floor'],'required'],
        [['Name', 'Famiglia', 'Nickname'],'unique'],
        [['CityTime'], 'safe'],
        [['Telephone', 'Userid'], 'integer'],
        [['Name', 'Famiglia', 'Nickname', 'DateBrithday'], 'string', 'max' => 30],
        [['Floor'], 'string'],
        [['City'], 'string', 'max' => 50],
        [['ImagePath'], 'file', 'extensions' => 'png, jpg'],
        [['ImageName'], 'string', 'max' => 100],
        [['Userid'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['Userid' => 'id']],
    ];
}
public function upload()
{
    if ($this->validate()) {
        if(!empty($this->ImagePath)) {
            $subdir1 = Yii::$app->user->identity->login;
            $folder = 'Upload/' . $subdir1 . '/';
            if (!file_exists($folder)) {
                mkdir($folder, 0777, true);
            }
            $this->ImagePath->saveAs($folder . $this->ImagePath->baseName . '.' . $this->ImagePath->extension);
            return true;
        }
        else
        {
            return false;
        }
    }
    else
    {
        return false;
    }
}