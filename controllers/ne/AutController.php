<?php
namespace app\controllers;

use app\models\CreateForm;
use app\models\AutreForm;
use app\models\CreateForm;
use app\models\CreateTableListForm;
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
        $model=new AutreForm();
        if(Yii::$app->request->post('AutreForm')){
            $model->attributes = Yii::$app->request->post('AutreForm');
            if($model->validate()) {
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
        $model = new CreateForm();
        $newlogin = new Users();
        if ($model->load(Yii::$app->request->post())) {
            $newlogin->setPassword($model['password']);
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
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/aut/index');
    }
}
