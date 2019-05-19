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
        $userid = Yii::$app->user->identity->getId();
        if($model = $this->FindModel($userid))
        {
            $mo = $model->ImageName;
            if ($model->load(Yii::$app->request->post()))
            {
                if ($model->ImagePath = UploadedFile::getInstance($model, 'ImagePath'))
                {
                    if ($model->upload())
                    {
                        $this->actionUpdatePhoto($model);
                        $model->save();
                        Yii::$app->session->setFlash('success', 'Записи и картинка успешно обновленны');
                        return $this->redirect('index');
                    }
                    else
                    {
                        $text = ('Ошибка сохранения картинки и записей');
                        $this->ExceptionHandler($text);
                    }
                }
                else
                {

                    $this->actionUpdatePhoto($model);
                    $this->actionCheckboxTrue($model);
                    $model->ImageName = $mo;
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Записи успешно обновленны');
                }
            }
        }
        else
            {
            $model = new NameAndContactSettings();
            if ($model->load(Yii::$app->request->post()))
            {
                $model->Userid = $userid;
                $model->ImagePath = UploadedFile::getInstance($model, 'ImagePath');
                if ($model->upload())
                {
                    $this->actionUpdatePhoto($model);
                    $this->actionCheckboxTrue($model);
                    $model->save();
                    Yii::$app->session->setFlash('success', 'Настройки успешно сохраненны');
                }
                else
                {
                    $text = ('Ошибка сохранения настроек');
                    $this->ExceptionHandler($text);
                }

            }

/*                $subdir = Yii::$app->user->identity->login;
                $folder = '/Upload/' . $subdir . '/';
                $model->ImagePath = $folder;
                $model->ImageName = $name;
                $model->save();*/

        }


//        print_r($model->errors);
        return $this->render('index', [
            'model' => $model
        ]);

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
    public function actionUploadProfilePicture($id)
    {
        echo "<pre>";
        print_r(123);
        exit();
        $model = $this->findModel($id);
        $oldFile = $model->getProfilePictureFile();
        $oldProfilePic = $model->profile_pic;

        if ($model->load(Yii::$app->request->post())) {

            // process uploaded image file instance
            $image = $model->uploadProfilePicture();

            if($image === false && !empty($oldProfilePic)) {
                $model->profile_pic = $oldProfilePic;
            }

            if ($model->save()) {
                // upload only if valid uploaded file instance found
                if ($image !== false) { // delete old and overwrite
                    if(!empty($oldFile) && file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                    $path = $model->getProfilePictureFile();
                    $image->saveAs($path);
                }
                \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
                return $model->getProfilePictureUrl();
            }
        }
    }
}