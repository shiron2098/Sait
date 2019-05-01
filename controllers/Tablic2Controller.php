<?php
namespace app\controllers;


use app\controllers\AutController;
use app\controllers\Secure\SecureController;
use app\models\Auti;
use app\models\AutreForm;
use app\models\NewForm1;
use app\models\Users;
use app\models\Yifraem;
use Psr\Log\InvalidArgumentException;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;

class Tablic2Controller extends SecureController
{
    public function actionIndex()
    {
        $userid=$_SESSION['__id'];
        $model= new NewForm1();
        if($model->load(Yii::$app->request->post())) {
            if($model->validate()){
                $newtask= new Yifraem();
                $newtask->time = date('H:i:s');
                $newtask->date = date('d.m.Y');
                $newtask->setAttributes($model->attributes);
                $newtask->userid = $userid;
                if (!$newtask->save()) {
                    return $this->render('Create', [
                        'model' => $model
                    ]);

                }
                else{
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
        if (!Yii::$app->user->isGuest) {
            $userid = $_SESSION['__id'];
            $model = Yifraem::find()->where('userid=:userid', [':userid' => $userid])->all();
            return $this->render('/tablic2/Tab', [
                'lol' => $model
            ]);
        } else

            return $this->redirect('/aut/index');
    }
    public function actionUpdate($id)
    {

        $model= $this->FindModel($id);

       if ($model->load(Yii::$app->request->post())&& $model->save()){
               return $this->redirect('home');
            }
        return $this->render('Create', [
            'model' => $model
        ]);
    }
    public function FindModel($id)
    {
        if (($model = Yifraem::findOne($id)) !== null) {
            return $model;
        }
    }
    public function actionDelete ($id){
        $model=$this->FindModel($id);
        $model->delete();
        return $this->redirect('home');

    }

}