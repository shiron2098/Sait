<?php
namespace app\controllers;

use app\controllers\AutController;
use app\controllers\Secure\SecureController;
use app\models\Auti;
use app\models\AutreForm;
use app\models\Checkbox;
use app\models\NameAndContactSettings;
use app\models\NewForm1;
use app\models\Users;
use app\models\Yifraem;
use kartik\datecontrol\DateControl;
use Psr\Log\InvalidArgumentException;
use Yii;
use yii\bootstrap\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

class Tablic2Controller extends SecureController
{
    function __construct($id,$module)
    {
        parent::__construct($id, $module);
        $this->FindUserAndTimeZone();
    }
    public function actionIndex()
    {
        $userid= Yii::$app->user->identity->getId();
        $model= new NewForm1();
        if($model->load(Yii::$app->request->post()))
        {
            if($model->validate())
            {
                $newtask= new Yifraem();
                $newtask->setAttributes($model->attributes);
                $newtask->time = date('H:i:s',time());
                $newtask->date = date('d:m:Y',time());
                $newtask->userid = $userid;
                if (!$newtask->save())
                {
                    return $this->render('Create', [
                        'model' => $model
                    ]);
                }
                else
                    {
                    $task = Users::find()->
                    where('id=:id', [':id' => $userid])->one()->getYifraems()->all();
                    return $this->render('Tab', [
                        'lol' => $task
                    ]);
                }
            }
        }
        return $this->render('Create',[
            'model'=> $model
        ]);

    }
    public function actionHome()
    {

        Yii::$app->geoData->removeData();
        if (!Yii::$app->user->isGuest)
        {
            $userid = $_SESSION['__id'];
            $model = Yifraem::find()->where('userid=:userid', [':userid' => $userid])->all();
                    return $this->render('/tablic2/Tab', [
                        'lol' => $model
                    ]);
        }
        else

            return $this->redirect('/aut/index');
    }
    public function actionUpdate($id)
    {

        $model= $this->FindModel($id);

       if ($model->load(Yii::$app->request->post())&& $model->save())
       {
               return $this->redirect('home');
            }
        return $this->render('Create', [
            'model' => $model
        ]);
    }
    public function FindModel($id)
    {
        if (($model = Yifraem::findOne($id)) !== null)
        {
            return $model;
        }
    }
    public function actionDelete ($id)
    {
        $model=$this->FindModel($id);
        $model->delete();
        return $this->redirect('home');

    }
    public function actionDeleteMulti ()
    {
        if (isset($_GET['id']))
        {
            foreach ($_GET['id'] as $id)
            {
                $model=$this->FindModel($id);
                $model->delete();
            }
            return $this->redirect('/tablic2/home');
        }
    }
}