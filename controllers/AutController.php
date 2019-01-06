<?php
namespace app\controllers;

use app\models\AutForm;
use app\models\AutreForm;
use app\models\ContactForm;
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


class AutController extends Controller
{

    public function actionIndex()
    {
        if (Yii::$app->user->isGuest) {
            $model = new AutreForm();
            if ($model->load(Yii::$app->request->post()) && $model->login()) {
                return $this->redirect('/tablic2/home');
            }

            return $this->render('index', [
                'model' => $model
            ]);

        }
        else
        {
            $this->redirect('/tablic2/home');
        }
    }

    public function actionCreateNewUser()
    {
        $model = new AutForm();
        $newlogin = new Users();
        if ($model->load(Yii::$app->request->post())) {
            $newlogin->setPassword($model->password_hash);
            $newlogin->login = $model->login;
            $newlogin->auth_key = Yii::$app->security->generateRandomString(32);
            if ($model->validate()) {
                if ($newlogin->save()) {
                    return $this->redirect('/aut/index');
                }
                else {
                    print_r($newlogin->errors);
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
            if($model->load(Yii::$app->request->post())&& $model->login()){
                return $this->redirect('/tablic2/home');
            }
        return $this->render('index',[
            'model'=> $model
        ]);
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/aut/index');
    }
    public function actionContact()
    {


    }
}
