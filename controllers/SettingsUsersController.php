<?php
namespace app\controllers;

/** То где хранятся пользователи */
/*echo "<pre>";
print_r(Yii::$app->user->identity);*/

use app\commands\SMSRU;
use app\controllers\Secure\SecureController;
use app\models\NameAndContactSettings;
use app\models\Photo;
use app\models\UploadForm;
use app\models\Users;
use yii\web\UploadedFile;
use yii;
use yii\helpers\Json;
use yii\helpers\FileHelper;

class SettingsUsersController extends SecureController
{
    function __construct($id,$module)
    {
        parent::__construct($id, $module);
        $this->FindUserAndTimeZone();
    }
    public function actionIndex ()
    {
/*        $model = new NameAndContactSettings();
        $arr = json_decode('someparam', true);
        json_decode('Somevalue',true);
        echo $arr;
        return $this->render('index', [
            'model' => $model
        ]);*/

    }
    /** Загрузка новых фоток  и отображения старых*/
    public function actionUpdatePhoto($model)
    {
        if ($model->ImagePath = UploadedFile::getInstance($model, 'ImagePath'))
        {
            $name = $model->ImagePath->name;
            $model->ImageName = $name;
        }
            $subdir = Yii::$app->user->identity->login;
            $folder = '/Upload/' . $subdir . '/';
            $model->ImagePath = $folder;
        return $model;
    }



    public function FindModel($Userid)
    {
        if (($model = NameAndContactSettings::find()->where('userid=:userid', [':userid' => $Userid])->one()) !== null)
        {
            return $model;
        }
    }
    public function actionUpload()
    {
        $model = new NameAndContactSettings();
        $fileName = 'file';
        $uploadPath = 'web/upload';

        if (isset($_FILES[$fileName])) {
            $file = \yii\web\UploadedFile::getInstanceByName($fileName);

            //Print file data
            //print_r($file);

            if ($file->saveAs($uploadPath . '/' . $file->name)) {
                //Now save file data to database

                echo \yii\helpers\Json::encode($file);
            }
        }else
        {
            return $this->render('index',[
                'model'=> $model]);
        }

        return false;
    }
}