<?php
namespace app\controllers;

use app\models\AutForm;
use app\models\AutreForm;
use app\models\ContactForm;
use app\models\CreateForm;
use app\models\NewForm1;
use app\models\PasswordResetRequestForm;
use app\models\ResetPasswordForm;
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

        } else {
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
            $newlogin->email =$model->email;
            if ($model->validate()) {
                if ($newlogin->save()) {
                    return $this->redirect('/aut/index');
                } else {
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
        $model = new AutreForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/tablic2/home');
        }
        return $this->render('index', [
            'model' => $model
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect('/aut/index');
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
            }
        }

        return $this->render('passwordResetRequestForm', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен');
            return $this->goHome();
        }

        return $this->render('resetPasswordForm', [
            'model' => $model,
        ]);
    }
}