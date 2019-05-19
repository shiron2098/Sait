<?php

namespace app\controllers\Secure;


use app\commands\TimeZoneController;
use app\models\NameAndContactSettings;
use yii\web\Controller;
use yii;

class SecureController extends TimeZoneController
{
    function __construct($id,$module)
    {
        parent::__construct($id, $module);
        if(Yii::$app->user->IsGuest)
        {
               $this->redirect('aut/index');
        }
    }

    /**
     * @return \app\models\Users
     */
    public function ActionLoginName()
    {
        Yii::$app->user->identity;
    }
    /** Нахождения пользователя по ид и его таймзоны из бд */
    public function FindUserAndTimeZone()
    {
        if($userid = YII::$app->user->identity->getId())
        {
            if($task = NameAndContactSettings::find()->
            where('userid=:userid', [':userid' => $userid])->one())
            {
                $time = $task->CityTime;
                return date_default_timezone_set($time);
            }
        }
        else
        {
            $text=("Не найден пользовательский ид");
            $this->ExceptionHandler($text);
        }
    }
    /** Автоматическое выставление таймзоне в settings пользователем */
    public function actionCheckboxTrue($model)
    {
        if ($model->CityCheckboxAutoTimeZone == 1)
        {
            $CheckboxIp = $this->IpAdresUserTimeZone();
            $data = Yii::$app->geoData->getDataIp('178.121.195.140');
            $model->CityTime = $data['country']['timezone'];
            $model->City = $data['city']['name_ru'] . ',' . $data['country']['name_ru'];
            return $model;
        }
        else
        {
            return false;
        }
    }

}