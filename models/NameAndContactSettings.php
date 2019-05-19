<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "nameandcontactsettings".
 *
 * @property int $Id
 * @property string $Name
 * @property string $Famiglia
 * @property string $Nickname
 * @property string $DateBrithday
 * @property string $Floor
 * @property string $City
 * @property string $CityTime
 * @property int $CityCheckboxAutoTimeZone
 * @property string $Telephone
 * @property string $ImagePath
 * @property string $ImageName
 * @property int $Userid
 *
 * @property Users $user
 */
class NameAndContactSettings extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nameandcontactsettings';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['DateBrithday','Floor'],'required'],
            [['CityTime'], 'safe'],
            [['Telephone', 'Userid','CityCheckboxAutoTimeZone'], 'integer'],
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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'Id' => 'ID',
            'Name' => 'Имя',
            'Famiglia' => 'Фамилия',
            'Nickname' => 'Nickname',
            'DateBrithday' => 'Date Brithday',
            'Floor' => 'Floor',
            'City' => 'City',
            'CityTime' => 'City Time',
            'CityCheckboxAutoTimeZone' => 'City Checkbox Auto Time Zone',
            'Telephone' => 'Telephone',
            'ImagePath' => 'Image Path',
            'ImageName' => 'Image Name',
            'Userid' => 'Userid',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'Userid']);
    }

}
