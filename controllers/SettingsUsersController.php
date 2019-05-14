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

class SettingsUsersController extends SecureController
{
    function __construct($id,$module)
    {
        parent::__construct($id, $module);
        $this->TimeZoneUserRegisterAndSettings();
    }
    public function actionIndex ()
    {
        $userid = Yii::$app->user->identity->getId();
        if($model = $this->FindModel($userid)) {
            $mo = $model->ImageName;
            if ($model->load(Yii::$app->request->post())) {
                if ($model->ImagePath = UploadedFile::getInstance($model, 'ImagePath'))
                {
                    if ($model->upload())
                    {
                        $this->actionUpdatePhoto($model);
                        $model->save();
                        return $this->redirect('index');
                    }
                    else
                    {
                        Yii::$app->session->setFlash('error', 'Возникла ошибка при регистрации.');
                    }
                }
                else
                {

                    $this->actionUpdatePhoto($model);
                    $this->actionCheckboxTrue($model);
                    $model->ImageName = $mo;
                    $model->save();
                }
            }
        }
        else
            {
            $model = new NameAndContactSettings();
            if ($model->load(Yii::$app->request->post())) {
                $model->Userid = $userid;
                $model->ImagePath = UploadedFile::getInstance($model, 'ImagePath');
                if ($model->upload()) {
                    $this->actionUpdatePhoto($model);
                    $this->actionCheckboxTrue($model);
                    $model->save();
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
        if ($model->ImagePath = UploadedFile::getInstance($model, 'ImagePath')) {
            $name = $model->ImagePath->name;
            $model->ImageName = $name;
        }
            $subdir = Yii::$app->user->identity->login;
            $folder = '/Upload/' . $subdir . '/';
            $model->ImagePath = $folder;
        return $model;
    }
    public function actionD()
    {

    }



    public function FindModel($Userid)
    {
        if (($model = NameAndContactSettings::find()->where('userid=:userid', [':userid' => $Userid])->one()) !== null) {
            return $model;
        }
    }
}