<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use yii\web\Controller;
use yii\console\ExitCode;
use yii\db\Exception;
use Yii;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class TimeZoneController extends controller
{
    public function TimeZoneUserRegisterAndSettings()
    {
        /** Проверка тайм зоны через модел */
        /** нахождения ип адреса юзера */
        $ip =$this->IpAdresUserTimeZone();
        $data = Yii::$app->geoData->getDataIp('178.121.195.140');
        $time= $data['region']['timezone'];
        return date_default_timezone_set($time);
    }

    public function IpAdresUserTimeZone()
    {
        $ip = Yii::$app->request->userIP;
        return $ip;
    }

    function ExceptionHandler($handler){
        try {
            throw new exception($handler);
        } catch (exception $e) {
            echo $e->getMessage();
        }
       $error =  Yii::$app->session->setFlash('error',$handler);
        return $error;

    }

}
/*public function AutTimeZoneRegister()
{
    $data=$this->IpAdresUser();
    $time= $data['region']['timezone'];
    return date_default_timezone_set($time);
}

public function IpAdresUser()
{
    $ip = Yii::$app->request->userIP;
    return $ip;
}*/