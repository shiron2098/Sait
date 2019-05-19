<?php
namespace app\controllers;
use app\commands\HelloController;
use app\commands\TimeZoneController;
use app\controllers\Secure\SecureController;
use app\models\AutForm;
use app\models\AutForm2;
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
use yii\db\Exception;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;


class AutController extends TimeZoneController
{
    function __construct($id,$module)
    {
        parent::__construct($id, $module);
        $this->TimeZoneUserRegisterAndSettings();
    }
    public function actionIndex()
    {
        if (Yii::$app->user->isGuest)
        {
            $model = new AutreForm();
            if ($model->load(Yii::$app->request->post()) && $model->login())
            {
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
        if ($model->load(Yii::$app->request->post()))
        {
           $model->time = date('H:i:s',time());
            $newlogin->setPassword($model->password_hash);
            $newlogin->login = $model->login;
            $newlogin->auth_key = Yii::$app->security->generateRandomString(32);
            $newlogin->email =$model->email;
            $newlogin->time = $model->time;
            if ($model->validate())
            {
                if ($newlogin->save())
                {
                    Yii::$app->session->setFlash('success','Поздравляем вы успешно зарегестрировались');
                    return $this->redirect('/aut/index');
                }
                else
                    {
                        $text = ('Ошибка данных записи в базу проверьте правильность вода данных');
                        $this->ExceptionHandler($text);
                }
            }
            else
            {
                $text = ('Ошибка данных записи в базу проверьте правильность вода данных');
                $this->ExceptionHandler($text);

            }
        }
        return $this->render('/aut/Soxdat_new_user', [
            'model' => $model,
        ]);
    }
/*    public function actionLogin()
    {
        $model = new AutreForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect('/tablic2/home');
        }
        return $this->render('index', [
            'model' => $model
        ]);
    }*/
    /**
     * Logout for user.
     */
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

        if ($model->load(Yii::$app->request->post()) && $model->validate())
        {
            if ($model->sendEmail())
            {
                Yii::$app->session->setFlash('success', 'На вашь эмейл отправленно письмо с инструкцией');
                return $this->goHome();
            }
            else
                {
                Yii::$app->session->setFlash('error', 'Извините но у нас нет пользователя с таким эмейлом');
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
        try
        {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e)
        {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword())
        {
            Yii::$app->session->setFlash('success', 'Новый пароль сохранен');
            return $this->goHome();
        }

        return $this->render('resetPasswordForm', [
            'model' => $model,
        ]);
    }
}