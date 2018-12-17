<?php
namespace app\controllers;

use app\models\AutForm;
use app\models\Auti;
use app\models\AutreForm;
use app\models\CreateForm;
use app\models\NewForm1;
use app\models\Users;
use app\models\Yi;
use app\models\Yifraem;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\ContactForm;


class AutController extends Controller
{

    public function actionIndex()
    {
        $model=new AutreForm();
        if(Yii::$app->request->post('AutreForm')){
            $model->attributes = Yii::$app->request->post('AutreForm');
            if($model->validate()){
                Yii::$app->user->login($model->getUser());
                return $this->redirect('/tablic2/home');
            }
        }
        return $this->render('index',[
            'model'=> $model
        ]);
    }

    public function actionCreateNewUser()
    {
        $model = new AutForm();
        $newlogin = new Auti();
        if ($model->load(Yii::$app->request->post())) {
            $newlogin->setPassword($newlogin['password']);
            $newlogin->login = $model->login;
            if ($model->validate()) {
                if ($newlogin->save()) {
                    return $this->redirect('/aut/index');
                }

            }
        }
        return $this->render('/aut/Soxdat_new_user', [
            'model' => $model
        ]);
    }
    public function actionLogin()
    {
        $model=new AutreForm();
        if(Yii::$app->request->post('AutreForm')){
            $model->attributes = Yii::$app->request->post('AutreForm');
            if($model->validate()){
                Yii::$app->user->login($model->getUser());
                return $this->redirect('/tablic2/home');
            }
        }
        return $this->render('index',[
            'model'=> $model
        ]);
    }
}
