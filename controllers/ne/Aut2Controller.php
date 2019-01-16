<?php
namespace app\controllers;

use app\models\Auti;
use app\models\CreateTableListForm;
use app\models\Yi;
use app\models\Yifraem;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;


class AutController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }
    public function actionCreateNew(){
        /*print_r(Yii::$app->request->get());*/
        return $this->render('Soxdat_new_user');
    }
    public function actionCreateNewUser($name,$password){
        $userid = $session['id'] = rand(1,9999);
        if(!empty ($name) && ($password)) {
            /** @var  $tabusers */
            $tabusers = Auti::FindLoginOne($name)->one();
            if ($tabusers['login'] !== $name) {
                $newlogin= new auti();
                $newlogin->login=$name;
                $newlogin->password=$password;
                $newlogin->useridaut=$userid;
                $newlogin->save();
                return $this->render('index');
            }
            else{
                return 'dannoe ima zanato';
            }
        }
    }
    public function actionVxodUsers($name,$password){
        if(!empty ($name) && ($password)) {
            $newlogin = auti::find()->all();
            foreach($newlogin as $user) {
                if ($name === $user['login'] && $password === $user['password']) {
                    $_SESSION['login'] = $user['login'];
                    $_SESSION['login_in'] = true;
                    $_SESSION['id'] = $user['id'];
                    $model = Yifraem::find()->where('userid=:userid',[':userid' =>$_SESSION['id']])->all();
                    return $this->render('/tablic2/Tab',[
                        'lol' => $model
                    ]);
                }
            }
            if($name !== $user['login']&& $password !== $user['password']) {
                echo 'vedite vernyi ima i parol';
                exit();
            }
        }
        else{
            echo 'pol9 ne mogyt byt pystymi';
            exit();
        }
    }
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->render('/aut/index');
    }
}