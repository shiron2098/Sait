<?php

namespace app\controllers\Secure;


use app\commands\TimezoneInterface;
use app\models\NameAndContactSettings;
use yii\web\Controller;
use yii;

class SecureController extends Controller implements TimezoneInterface
{
    function __construct($id,$module)
    {
        parent::__construct($id, $module);
        if(Yii::$app->user->IsGuest)
        {
               $this->redirect('aut/login');
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
    public function TimeZoneUserRegisterAndSettings()
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
    }
    /** Автоматическое выставление таймзоне в settings пользователем */
    public function actionCheckboxTrue($model)
    {
        if ($model->CityCheckboxAutoTimeZone == 1)
        {
            $CheckboxIp = $this->IpAdresUserTimeZone();
            $model->CityTime = $CheckboxIp['country']['timezone'];
            $model->City = $CheckboxIp['city']['name_ru'] . ',' . $CheckboxIp['country']['name_ru'];
            return $model;
        }
        else
        {
            return false;
        }
    }
    /** Проверка тайм зоны через модел */
    /** нахождения ип адреса юзера */
    public function IpAdresUserTimeZone()
    {
        $ip = Yii::$app->request->userIP;
        $data = Yii::$app->geoData->getDataIp('178.121.195.140');
        return $data;
    }

}